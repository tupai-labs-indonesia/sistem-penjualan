<?php 
include_once('../../_config/config.php');
$kd_kategori = $_GET['kd_kategori'];
$query_mysql = mysqli_query($con, "SELECT * FROM tb_kategori WHERE kd_kategori='$kd_kategori'") or die (mysqli_error($con));
$nomor = 1;
while($r = mysqli_fetch_array($query_mysql)){
?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">EDIT DATA KATEGORI</h4>
        </div>
        <div class="modal-body">
        	<form action="proses.php" name="modal_popup" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Kode Kategori : <b><em><u><?php echo $r['kd_kategori'];?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="kategori">Kategori</label>
                    <input type="hidden" readonly name="kd_kategori" id="kd_kategori" class="form-control" value="<?php echo $r['kd_kategori'];?>">
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $r['kategori'];?>" required autofocus>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="kd_jenis">Kode Jenis</label>
                    <select type="option" name="kd_jenis" class="form-control" required>
                        <option  value="<?php echo $r['kd_jenis']; ?>" selected>Data yang dipilih sebelumnya [ <?php echo $r['kd_jenis']; ?> ]</option>
                        <?php
                          $tampil=mysqli_query($con, "SELECT * FROM tb_jenis");
                          while($w=mysqli_fetch_array($tampil))
                          {
                              echo "<option>$w[kd_jenis]</option>";        
                          }
                           echo "</select>";
                        ?>
                    </select>
                </div>
	            <div class="modal-footer">
	            	<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                    <button type="submit" class="btn btn-success" name="edit2">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                    </button>
	            </div>
            </form>
            <?php } ?>
        </div>        
    </div>
</div>