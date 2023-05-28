<?php include_once('../_header.php'); ?>
<script>
    //mendeksripsikan variabel yang akan digunakan
    var nota;
    var tanggal;
    var kode;
    var menu;
    var harga;
    var jenis;
    var kategori;
    var jumlah;
    var stok;
    $(function() {
        //meload file pk dengan operator ambil barang dimana nantinya
        //isinya akan masuk di combo box
        $("#kode").load("proses.php", "op=tampilkodemenu");
        //meload isi tabel
        $("#tabelmenu").load("proses.php", "op=menu");
        //mengkosongkan input text dengan masing2 id berikut
        $("#menu").val("");
        $("#harga").val("");
        $("#jenis").val("");
        $("#kategori").val("");
        $("#jumlah").val("");

        //jika ada perubahan di kode barang makanan

        $("#kode").change(function() {
            kode = $("#kode").val();

            //tampilkan status loading dan animasinya
            $("#status").html("loading. . .");
            $("#loading").show();

            //lakukan pengiriman data
            $.ajax({
                url: "proses.php",
                data: "op=ambildata&kode=" + kode,
                cache: false,
                success: function(msg) {
                    data = msg.split("|");

                    //masukan isi data ke masing - masing field
                    $("#menu").val(data[0]);
                    $("#harga").val(data[1]);
                    $("#jenis").val(data[2]);
                    $("#kategori").val(data[3]);
                    $("#jumlah").focus();
                    //hilangkan status animasi dan loading
                    $("#status").html("");
                    $("#loading").hide();
                }
            });
        });

        //jika tombol tambah di klik
        $("#tambah").click(function() {
            kode = $("#kode").val();
            jumlah = $("#jumlah").val();
            if (kode == "Kode Menu") {
                alert("Kode Menu Harus diisi");
                exit();
            } else if (jumlah < 1) {
                alert("Jumlah beli tidak boleh 0");
                $("#jumlah").focus();
                exit();
            }
            menu = $("#menu").val();
            harga = $("#harga").val();
            jenis = $("#jenis").val();
            kategori = $("#kategori").val();


            $("#status").html("sedang diproses. . .");
            $("#loading").show();

            $.ajax({
                url: "proses.php",
                data: "op=tambahmenu&kode=" + kode + "&harga=" + harga + "&jumlah=" + jumlah,
                cache: false,
                success: function(msg) {
                    if (msg == "sukses") {
                        $("#status").html("Berhasil disimpan. . .");
                    } else {
                        $("#status").html("ERROR. . .");
                    }
                    $("#loading").hide();
                    $("#menu").val("");
                    $("#jenis").val("");
                    $("#kategori").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#kode").load("proses.php", "op=tampilkodemenu");
                    $("#tabelmenu").load("proses.php", "op=menu");
                }
            });
        });

        //jika tombol proses diklik
        $("#proses").click(function() {
            nota = $("#nota").val();
            tanggal = $("#tanggal").val();

            $.ajax({
                url: "proses.php",
                data: "op=proses&nota=" + nota + "&tanggal=" + tanggal,
                cache: false,
                success: function(msg) {
                    if (msg == 'sukses') {
                        $("#status").html('Transaksi Pembelian berhasil');
                        alert('Transaksi Berhasil');
                        window.location.replace('index.php');
                        exit();
                    } else {
                        $("#status").html('Transaksi Gagal');
                        alert('Transaksi Gagal');
                        exit();
                    }
                    $("#kode").load("proses.php", "op=tampilkodemenu");
                    $("#tabelmenu").load("proses.php", "op=menu");
                    $("#loading").hide();
                    $("#menu").val("");
                    $("#jenis").val("");
                    $("#kategori").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                }
            })
        })
    });
</script>
<style>


</style>
<div class="row" style="padding-top: 30px;">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="row">
                <div class="col-md-4">
                    <strong>PENJUALAN</strong>
                </div>
                <?php include_once('../jam&tanggal.php'); ?>
            </div>
        </h1>
        <ol class="breadcrumb alert alert-info">
            <li class="active" style="font-size: 18px; font-family: cursive;">
                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Transaksi Penjualan > Edit Data
                Transaksi
            </li>
        </ol>
    </div>
</div>

<?php
include_once('../../_config/config.php');
$nonota = $_GET['nonota'];
$sql = "SELECT * FROM penjualan WHERE nonota='$nonota'";
$data = mysqli_query($con, $sql)->fetch_assoc();

// delete temp
$delete = "DELETE FROM tblsementara";
$deleteData = mysqli_query($con, $delete);

// insert dari detail
$detail = "SELECT * FROM detailpenjualan WHERE nonota='$nonota'";
$dataDetail = mysqli_query($con, $detail);


if ($dataDetail) {
    while ($row = mysqli_fetch_row($dataDetail)) {
        $kd_menu = $row[1];
        $harga = $row[2];
        $jumlah = $row[3];
        $subtotal = $row[4];

        $sq = "INSERT INTO tblsementara (kd_menu, harga, jumlah, subtotal) VALUES ('$kd_menu', '$harga', '$jumlah', '$subtotal');";
        mysqli_query($con, $sq);
    }
}

?>

<form>
    <div class="form-group">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"><label>Nota</label></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type='text' class='form-control' id='nota' value="<?= $data['nonota'] ?>" disabled>
                </div>
                <div class="col-md-2">
                    <input type='date' class='form-control' id='tanggal' value='<?= $data['tanggal'] ?>'>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-3">
                    <label>Pilih Menu</label>
                    <br>
                    <select id="kode" class="form-control exampleSelect"></select>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="menu" placeholder="Menu" disabled>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control" id="harga" placeholder="Harga" disabled>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="jenis" placeholder="Jenis" disabled>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="kategori" placeholder="Kategori" disabled>
                </div>
                <div class="col-md-2">
                    <input type="number" id="jumlah" class="form-control" placeholder="Jumlah Beli" class="span1">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" id="tambah">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah
                    </button>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <span id="status"></span>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-2"><label>Daftar Menu yang Dibeli</label></div>
            </div>
            <div class="table-responsive">
                <table id="tabelmenu" class="table table-striped table-bordered table-hover">

                </table>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="alert alert-success">
                    <button type="button" class="btn btn-success" id="proses">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>



<?php include_once('../_footer.php'); ?>