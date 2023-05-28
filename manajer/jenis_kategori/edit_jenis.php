<?php 
include_once('../../_config/config.php');
$kd_jenis = $_GET['kd_jenis'];
$query_mysql = mysqli_query($con, "SELECT * FROM tb_jenis WHERE kd_jenis='$kd_jenis'") or die (mysqli_error($con));
$nomor = 1;
while($r = mysqli_fetch_array($query_mysql)){
?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">EDIT DATA JENIS</h4>
        </div>
        <div class="modal-body">
        	<form action="proses.php" name="modal_popup" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Kode Jenis : <b><em><u><?php echo $r['kd_jenis'];?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="jenis">Jenis</label>
                    <input type="hidden" readonly name="kd_jenis" id="kd_jenis" class="form-control" value="<?php echo $r['kd_jenis'];?>">
                    <input type="text" name="jenis" id="jenis" class="form-control" value="<?php echo $r['jenis'];?>" required autofocus>
                </div>
	            <div class="modal-footer">
	            	<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                    <button type="submit" class="btn btn-success" name="edit1">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                    </button>
	            </div>
            </form>
            <?php } ?>
        </div>        
    </div>
</div>