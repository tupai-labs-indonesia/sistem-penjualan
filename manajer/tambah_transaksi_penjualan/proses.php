<?php
require_once "../../_config/config.php";
$op = isset($_GET['op']) ? $_GET['op'] : null;
if ($op == 'tampilkodemenu') {
    $data = mysqli_query($con, "select a.kd_menu, a.menu, a.harga, c.jenis, b.kategori from tb_menu a, tb_kategori b, tb_jenis c WHERE a.kd_kategori = b.kd_kategori AND b.kd_jenis = c.kd_jenis order by kd_menu asc");
    echo "<option>Cari Nama Obat</option>";
    while ($r = mysqli_fetch_array($data)) {
        echo "<option value='$r[kd_menu]'>$r[menu]</option>";
    }
} else if ($op == 'ambildata') {
    $kode = $_GET['kode'];
    $dt = mysqli_query($con, "select a.kd_menu, a.menu, a.harga, c.jenis, b.kategori from tb_menu a, tb_kategori b, tb_jenis c WHERE a.kd_kategori = b.kd_kategori AND b.kd_jenis = c.kd_jenis AND kd_menu='$kode'");
    $d = mysqli_fetch_array($dt);
    echo $d['menu'] . "|" . $d['harga'] . "|" . $d['jenis'] . "|" . $d['kategori'];
} else if ($op == 'menu') {
    $brg = mysqli_query($con, "select a.kd_menu, d.menu, a.harga, c.jenis, b.kategori, a.jumlah, a.subtotal from tblsementara a, tb_kategori b, tb_jenis c, tb_menu d WHERE a.kd_menu = d.kd_menu AND d.kd_kategori = b.kd_kategori AND b.kd_jenis = c.kd_jenis");
    echo "<thead>
            <tr>
                <td>Kode Menu</td>
                <td>Nama</td>
                <td>Jenis</td>
                <td>Kategori</td>
                <td>Harga</td>
                <td>Jumlah Beli</td>
                <td>Subtotal</td>
                <td>Tools</td>
            </tr>
        </thead>";
    $total = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));
    while ($r = mysqli_fetch_array($brg)) {
        echo "<tr>
                <td>$r[kd_menu]</td>
                <td>$r[menu]</td>
                <td>$r[jenis]</td>
                <td>$r[kategori]</td>
                <td>Rp. " . number_format($r[harga]) . "</td>
                <td>$r[jumlah]</td>
                <td>Rp. " . number_format($r[subtotal]) . "</td>
                <td><a href='proses.php?op=hapus&kd_menu=$r[kd_menu]' id='hapus'>Hapus</a></td>
            </tr>";
    }
    echo "<tr>
        <td colspan='4'>Total</td>
        <td colspan='4'>Rp. " . number_format($total[total]) . "</td>
    </tr>";
} else if ($op == 'tambahmenu') {
    $kd_menu = $_GET['kode'];
    $harga = $_GET['harga'];
    $jumlah = $_GET['jumlah'];
    $subtotal = $harga * $jumlah;

    $tambah = mysqli_query($con, "INSERT into tblsementara (kd_menu, harga, jumlah, subtotal)
                        values ('$kd_menu', '$harga','$jumlah','$subtotal')");

    if ($tambah) {
        echo "sukses";
    } else {
        echo "ERROR";
    }
} else if ($op == 'hapus') {
    $kode = $_GET['kd_menu'];
    $del = mysqli_query($con, "delete from tblsementara where kd_menu='$kode'");
    if ($del) {
        echo "<script>window.location='add.php';</script>";
    } else {
        echo "<script>alert('Hapus Data Berhasil');
            window.location='add.php';</script>";
    }
} elseif ($op == 'proses') {
    $nota = $_GET['nota'];
    $tanggal = $_GET['tanggal'];
    $to = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));
    $tot = $to['total'];
    // delete Penjualan
    $a = "DELETE FROM penjualan where nonota='$nota'";
    $deleteA = mysqli_query($con, $a);

    $simpan = mysqli_query($con, "insert into penjualan(nonota,tanggal,total)
                        values ('$nota','$tanggal','$tot')");
    if ($simpan) {
        // delete detail old
        $delete = "DELETE FROM detailpenjualan where nonota='$nota'";
        $deleteData = mysqli_query($con, $delete);
        $query = mysqli_query($con, "select * from tblsementara");
        while ($r = mysqli_fetch_row($query)) {
            mysqli_query($con, "insert into detailpenjualan(nonota,kd_menu,harga,jumlah,subtotal)
                        values('$nota','$r[0]','$r[1]','$r[2]','$r[3]')");
        }
        //hapus seluruh isi tabel sementara
        mysqli_query($con, "truncate table tblsementara");
        echo "sukses";
    } else {
        echo "ERROR";
    }
}
