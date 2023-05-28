  <?php
    include_once('../../_config/config.php');
    $query = "SELECT max(kd_jenis) as maxkd_jenis FROM tb_jenis";
    $hasil = mysqli_query($con, $query);
    $data  = mysqli_fetch_array($hasil);
    $kd_jenis = $data['maxkd_jenis'];

    // mengambil angka atau bilangan dalam kode anggota terbesar,
    // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
    // misal 'BRG001', akan diambil '001'
    // setelah substring bilangan diambil lantas dicasting menjadi integer
    $noUrut = (int) substr($kd_jenis, 1, 2);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $noUrut++;

    // membentuk kode anggota baru
    // perintah sprintf("%05s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
    // misal sprintf("%05s", 12); maka akan dihasilkan '00012'
    // atau misal sprintf("%05s", 1); maka akan dihasilkan string '00001'
    $char = "J";
    $newID = $char . sprintf("%02s", $noUrut);
  ?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">INPUT DATA JENIS</h4>
        </div>
        <div class="modal-body">
        	<form action="proses.php" name="modal_popup" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Kode Jenis : <b><em><u><?=$newID?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="jenis">Jenis</label>
                    <input type="hidden" readonly name="kd_jenis" id="kd_jenis" class="form-control" value="<?=$newID?>">
                    <input type="text" name="jenis" id="jenis" class="form-control" required autofocus>
                </div>
	            <div class="modal-footer">
	            	<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                    <button type="submit" class="btn btn-success" name="add1">
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