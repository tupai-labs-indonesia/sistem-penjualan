  <?php
    include_once('../../_config/config.php');
    $query = "SELECT max(kd_pegawai) as maxkd_pegawai FROM tb_pegawai";
    $hasil = mysqli_query($con, $query);
    $data  = mysqli_fetch_array($hasil);
    $kd_pegawai = $data['maxkd_pegawai'];

    // mengambil angka atau bilangan dalam kode anggota terbesar,
    // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
    // misal 'BRG001', akan diambil '001'
    // setelah substring bilangan diambil lantas dicasting menjadi integer
    $noUrut = (int) substr($kd_pegawai, 4, 7);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $noUrut++;

    // membentuk kode anggota baru
    // perintah sprintf("%05s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
    // misal sprintf("%05s", 12); maka akan dihasilkan '00012'
    // atau misal sprintf("%05s", 1); maka akan dihasilkan string '00001'
    $char = "PGPS";
    $newID = $char . sprintf("%07s", $noUrut);
  ?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">INPUT DATA PEGAWAI</h4>
        </div>
        <div class="modal-body">
        	<form action="proses.php" name="modal_popup" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Kode Pegawai : <b><em><u><?=$newID?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="nama">Nama</label>
                    <input type="hidden" readonly name="kd_pegawai" id="kd_pegawai" class="form-control" value="<?=$newID?>">
                    <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <div class="input-group date tgl_lahir" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="gender">Kelamin</label>
                    <select type="option" name="gender" class="form-control" required>
		                <option  value='' selected>- Pilih Jenis Kelamin -</option>
		                <option>Laki-laki</option>
		                <option>Perempuan</option>
	           		</select>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="telp">No. Telepon</label>
                    <input type="number" name="telp" id="telp" class="form-control" required>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="kd_posisi">Kode Posisi</label>
                    <?php
                      echo "<select name='kd_posisi' class='form-control' required>";
                      $tampil=mysqli_query($con, "SELECT * FROM tb_posisi") or die  (Mysqli_error($con));;
                      echo "<option value='' selected>- Pilih Kode Posisi -</option>";

                      while($w=mysqli_fetch_array($tampil))
                      {
                          echo "<option>$w[kd_posisi]</option>";        
                      }
                       echo "</select>";
                    ?>
                </div>
	            <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                    <button type="submit" class="btn btn-success" name="add">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                    </button>
	            </div>
            </form>
        </div>  
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.tgl_lahir').datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        });
    });
</script>