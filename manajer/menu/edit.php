  <?php 
  include_once('../../_config/config.php');
  $kd_menu = $_GET['kd_menu'];
  $query_mysql = mysqli_query($con, "SELECT * FROM tb_menu WHERE kd_menu='$kd_menu'") or die (mysqli_error($con));
  $nomor = 1;
  while($r = mysqli_fetch_array($query_mysql)){
  ?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">EDIT DATA MENU</h4>
        </div>
        <div class="modal-body" id="modal-edit">
        	<form action="proses.php" name="modal_popup" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;">
                                <i class="fa fa-info-circle"></i> Kode Menu : <b><em><u><?php echo $r['kd_menu'];?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="menu">Menu</label>
                    <input type="hidden" readonly name="kd_menu" id="kd_menu" class="form-control" value="<?php echo $r['kd_menu'];?>">
                    <input type="text" name="menu" id="menu" class="form-control" value="<?php echo $r['menu'];?>" required autofocus>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="sejak">Sejak</label>
                    <div class="input-group date sejak" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="sejak" id="sejak" class="form-control" value="<?php echo $r['sejak'];?>" required>
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="kd_kategori">Kode Kategori</label>
                    <select type="option" name="kd_kategori" class="form-control" required>
		                <option  value="<?php echo $r['kd_kategori']; ?>" selected>Data yang dipilih sebelumnya [ <?php echo $r['kd_kategori']; ?> ]</option>
		                <?php
	                      $tampil=mysqli_query($con, "SELECT * FROM tb_kategori");
	                      while($w=mysqli_fetch_array($tampil))
	                      {
	                          echo "<option>$w[kd_kategori]</option>";        
	                      }
	                       echo "</select>";
	                    ?>
	           		</select>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="<?php echo $r['harga'];?>" required>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.sejak').datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        });
    });
</script>