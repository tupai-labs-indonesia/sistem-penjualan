  <?php 
  include_once('../../_config/config.php');
  $kd_pegawai = $_GET['kd_pegawai'];
  $query_mysql = mysqli_query($con, "SELECT * FROM tb_pegawai WHERE kd_pegawai='$kd_pegawai'") or die (mysqli_error($con));
  $nomor = 1;
  while($r = mysqli_fetch_array($query_mysql)){
  ?>
<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">EDIT DATA PEGAWAI</h4>
        </div>
        <div class="modal-body">
        	<form action="proses.php" name="modal_popup" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Kode Pegawai : <b><em><u><?php echo $r['kd_pegawai'];?></u></em></b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="nama">Nama</label>
                    <input type="hidden" readonly name="kd_pegawai" id="kd_pegawai" class="form-control" value="<?php echo $r['kd_pegawai'];?>">
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $r['nama'];?>" required autofocus>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <div class="input-group date tgl_lahir" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?php echo $r['tgl_lahir'];?>" required>
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="gender">Kelamin</label>
                    <select type="option" name="gender" class="form-control" required>
		                <option  value="<?php echo $r['gender']; ?>" selected>Data yang dipilih sebelumnya [ <?php echo $r['gender']; ?> ]</option>
		                <option>Laki-laki</option>
		                <option>Perempuan</option>
	           		</select>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required><?php echo $r['alamat'];?></textarea>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="telp">No. Telepon</label>
                    <input type="number" name="telp" id="telp" class="form-control" value="<?php echo $r['telp'];?>" required>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="email">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $r['email'];?>" required>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="kd_posisi">Kode Posisi</label>
                    <select type="option" name="kd_posisi" class="form-control" required>
		                <option  value="<?php echo $r['kd_posisi']; ?>" selected>Data yang dipilih sebelumnya [ <?php echo $r['kd_posisi']; ?> ]</option>
		                <?php
	                      $tampil=mysqli_query($con, "SELECT * FROM tb_posisi");
	                      while($w=mysqli_fetch_array($tampil))
	                      {
	                          echo "<option>$w[kd_posisi]</option>";        
	                      }
	                       echo "</select>";
	                    ?>
	           		</select>
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
                $('.tgl_lahir').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });
        </script>