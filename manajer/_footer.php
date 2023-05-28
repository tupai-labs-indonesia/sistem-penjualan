	</div>

	<!-- Modal Popup untuk Ubah Password-->
	<div id="ModalPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <?php 
		  $username = $_SESSION['username'];
		  $query_mysql = mysqli_query($con, "SELECT * FROM tb_akun WHERE username='$username'") or die (mysqli_error($con));
		  $nomor = 1;
		  while($r = mysqli_fetch_array($query_mysql)) {
		 ?>
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myModalLabel"><strong>UBAH PASSWORD</strong></h4>
	            </div>
	            <div class="modal-body">
	                <form action="" name="modal_popup" method="POST">

	                    <div class="form-group" style="padding-bottom: 20px;">
	                        <label>Username</label>
	                        <input type="hidden" name="kd_akun" id="kd_akun" class="form-control"
	                            value="<?=$r['kd_akun'];?>">
	                        <input type="text" readonly="" name="username" id="username" class="form-control"
	                            value="<?=$r['username'];?>">
	                    </div>

	                    <div class="form-group" style="padding-bottom: 20px;">
	                        <label>Password Lama</label>
	                        <input type="password" name="password_lama" id="password_lama" class="form-control" required>
	                    </div>

	                    <div class="form-group" style="padding-bottom: 20px;">
	                        <label>Password Baru</label>
	                        <input type="password" name="password_baru" id="password_baru" class="form-control" required>
	                    </div>

	                    <div class="form-group" style="padding-bottom: 20px;">
	                        <label>Konfirmasi Password</label>
	                        <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control"
	                            required>
	                    </div>

	                    <div class="modal-footer">
	                        <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">
	                            <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
	                        </button>
	                        <button class="btn btn-success btn-sm" type="submit" name="submit" data-toggle="modal"
	                            data-target="#contohModalKecil">
	                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Ubah
	                        </button>
	                    </div>

	                </form>

	                <?php } ?>

	            </div>
	        </div>
	    </div>
	</div>

	<?php
	//proses jika tombol rubah di klik
	if(isset($_POST['submit'])) {
		//membuat variabel untuk menyimpan data inputan yang di isikan di form
		$password_lama			= $_POST['password_lama'];
		$password_baru			= $_POST['password_baru'];
		$konfirmasi_password	= $_POST['konfirmasi_password'];
		
		//cek dahulu ke database dengan query SELECT
		//kondisi adalah WHERE (dimana) kolom password adalah $password_lama di encrypt m5
		//encrypt -> md5($password_lama)
		$password_lama	= md5($password_lama);
		$cek 			= $con->query("SELECT password FROM tb_akun WHERE password='$password_lama'");
		if(mysqli_num_rows($cek)) {
			//kondisi ini jika password lama yang dimasukkan sama dengan yang ada di database
			//membuat kondisi minimal password adalah 5 karakter
			if(strlen($password_baru) >= 5){
				//jika password baru sudah 5 atau lebih, maka lanjut ke bawah
				//membuat kondisi jika password baru harus sama dengan konfirmasi password
				if($password_baru == $konfirmasi_password){
					//jika semua kondisi sudah benar, maka melakukan update kedatabase
					//query UPDATE SET password = encrypt md5 password_baru
					//kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
					$password_baru 	= md5($password_baru);
					$username 		= $_SESSION['username']; //ini dari session saat login
					
					$update 		= mysqli_query($con, "UPDATE tb_akun SET password='$password_baru' WHERE username='$username'") or die (mysqli_error($con));

					if($update) {
						//kondisi jika proses query UPDATE berhasil
							echo "
								  <script type='text/javascript'>
									setTimeout(function () { 	
										swal({
											title: 'Password berhasil diubah',
											type: 'success',
											timer: 3000,
											showConfirmButton: true
										});		
									},10);	
									window.setTimeout(function(){ 
										window.location.replace('index.php');
									} ,3000);	
								  </script>";
					} else {
						//kondisi jika proses query gagal
						echo "
						  <script type='text/javascript'>
							setTimeout(function () { 	
								swal({
									title: 'Password gagal diubah',
									type: 'error',
									timer: 3000,
									showConfirmButton: true
								});		
							},10);	
							window.setTimeout(function(){ 
								window.location.replace('index.php');
							} ,3000);	
						  </script>";
					}					
				} else {
					//kondisi jika password baru beda dengan konfirmasi password
					echo "
						  <script type='text/javascript'>
							setTimeout(function () { 	
								swal({
									title: 'Konfirmasi password salah',
									type: 'error',
									timer: 3000,
									showConfirmButton: true
								});		
							},10);	
							window.setTimeout(function(){ 
								window.location.replace('index.php');
							} ,3000);	
						  </script>";
				}
			} else {
				//kondisi jika password baru yang dimasukkan kurang dari 5 karakter
				echo "
						  <script type='text/javascript'>
							setTimeout(function () { 	
								swal({
									title: 'Minimal 5 karakter password',
									type: 'error',
									timer: 3000,
									showConfirmButton: true
								});		
							},10);	
							window.setTimeout(function(){ 
								window.location.replace('index.php');
							} ,3000);	
						  </script>";
			}
		}else{
			//kondisi jika password lama tidak cocok dengan data yang ada di database
			echo "
						  <script type='text/javascript'>
							setTimeout(function () { 	
								swal({
									title: 'Password lama salah',
									type: 'error',
									timer: 3000,
									showConfirmButton: true
								});		
							},10);	
							window.setTimeout(function(){ 
								window.location.replace('index.php');
							} ,3000);	
						  </script>";
		}
	}
	?>

	<script type="text/javascript">
$(document).ready(function() {
    $('#username').on('submit', function(e) {
        $.ajax({
            url: '',
            data: $(this).serialize(),
            type: 'POST',
            success: function(data) {
                console.log(data);
                swal("Success!", "Message sent!", "success");
            },
            error: function(data) {
                swal("Oops...", "Something went wrong :(", "error");
            }
        });
        e.preventDefault();
    });
});
	</script>
	<script>
$('.exampleSelect').select2({
    placeholder: 'Select a month'
});
	</script>
	</body>

	</html>