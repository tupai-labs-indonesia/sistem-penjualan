  <?php
    include_once('../../_config/config.php');
    $query = "SELECT max(kd_menu) as maxkd_menu FROM tb_menu";
    $hasil = mysqli_query($con, $query);
    $data  = mysqli_fetch_array($hasil);
    $kd_menu = $data['maxkd_menu'];

    // mengambil angka atau bilangan dalam kode anggota terbesar,
    // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
    // misal 'BRG001', akan diambil '001'
    // setelah substring bilangan diambil lantas dicasting menjadi integer
    $noUrut = (int) substr($kd_menu, 4, 7);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $noUrut++;

    // membentuk kode anggota baru
    // perintah sprintf("%05s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
    // misal sprintf("%05s", 12); maka akan dihasilkan '00012'
    // atau misal sprintf("%05s", 1); maka akan dihasilkan string '00001'
    $char = "KDMN";
    $newID = $char . sprintf("%07s", $noUrut);
  ?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">INPUT DATA MENU</h4>
        </div>
        <form action="proses.php" name="modal_popup" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Kode Menu : <b><em><u><?=$newID?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="menu">Menu</label>
                    <input type="hidden" readonly name="kd_menu" id="kd_menu" class="form-control" value="<?=$newID?>">
                    <input type="text" name="menu" id="menu" class="form-control" required autofocus>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="sejak">Sejak</label>
                    <div class="input-group date sejak" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="sejak" id="sejak" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="kd_kategori">Kode Kategori</label>
                    <?php
                      echo "<select id='kd_kategori' name='kd_kategori' class='form-control ' required>";
                      
                      $tampil=mysqli_query($con, "SELECT a.kd_kategori,a.kategori,b.jenis from tb_kategori a, tb_jenis b WHERE a.kd_jenis = b.kd_jenis") or die  (Mysqli_error($con));;
                    //   $tampil=mysqli_query($con, "SELECT * FROM tb_kategori") or die  (Mysqli_error($con));;
                      echo "<option value='' selected>- Pilih Kode Kategori -</option>";

                      while($w=mysqli_fetch_array($tampil))
                      {
                          echo "<option name='$w[kd_kategori]-$w[kategori]-$w[jenis]' >$w[kd_kategori]-$w[kategori]-$w[jenis]</option>";
                      }
                       echo "</select>";
                       
                       
                    ?>
                    
                </div>
              
                 <div class="form-group" style="padding-bottom: 20px;">
                	<label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
	            <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
	            	<button type="submit" class="btn btn-success" name="add">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                    </button>
	            </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.sejak').datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        });
    });
</script>