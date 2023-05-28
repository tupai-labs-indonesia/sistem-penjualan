  <?php 
  include_once('../../_config/config.php');
  $kd_posisi = $_GET['kd_posisi'];
  $query_mysql = mysqli_query($con, "SELECT * FROM tb_posisi WHERE kd_posisi='$kd_posisi'") or die (mysqli_error($con));
  $nomor = 1;
  while($r = mysqli_fetch_array($query_mysql)){
  ?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">EDIT DATA POSISI PEGAWAI</h4>
        </div>
        <div class="modal-body">
        	<form action="proses.php" name="modal_popup" method="POST">
              <div class="row">
                  <div class="col-lg-12">
                      <ol class="breadcrumb alert-info">
                          <li class="active" style="font-size: 16px;"">
                              <i class="fa fa-info-circle"></i> Kode Posisi : <b><em><u><?php echo $r['kd_posisi']; ?></u></em></b>
                          </li>
                      </ol>
                  </div>
              </div>
              <div class="form-group" style="padding-bottom: 20px;">
              	<label for="posisi">Posisi</label>
                <input type="hidden" readonly name="kd_posisi" id="kd_posisi"  class="form-control" value="<?php echo $r['kd_posisi']; ?>" >
                <input type="text" name="posisi" id="posisi"  class="form-control" value="<?php echo $r['posisi']; ?>" >
              </div>
	            <div class="modal-footer">
	            	<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                </button>
                <button type="submit" class="btn btn-success" name="edit">
                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                </button>
	            </div>
          </form>
          <?php } ?>
        </div>      
    </div>
</div>