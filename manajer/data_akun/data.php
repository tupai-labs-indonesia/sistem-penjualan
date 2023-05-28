<?php include_once('../_header.php');?>

                <div class="row" style="padding-top: 30px;">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>LAINNYA</strong>
                                </div>
                                <?php include_once('../jam&tanggal.php');?>
                            </div>
                        </h1>
                        <div class="alert alert-info" role="alert"  style="font-size: 18px; font-family: cursive;">
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Kelola Akun
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom: 20px;">
								<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" class="modal_add btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
						</div>
						<form method="post" name="proses">
							<table class="table table-striped table-bordered table-hover" id="datatables">
								<thead>
									<tr>
										<th>No.</th>
										<th>Kode Akun</th>
										<th>Username</th>
										<th>Nama</th>
										<th>Hak Akses</th>
										<th><center>Opsi</center></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$sql_akun = mysqli_query($con, "SELECT a.kd_akun, a.username, b.nama, a.hak_akses FROM tb_akun a, tb_pegawai b WHERE a.kd_pegawai = b.kd_pegawai") or die (Mysqli_error($con));
								 	while($data = mysqli_fetch_array($sql_akun)) { ?>
								 			<tr>
								 				<td><?=$no++?>.</td>
								 				<td><?=$data['kd_akun']?></td>
								 				<td><?=$data['username']?></td>
								 				<td><?=$data['nama']?></td>
								 				<td><?=$data['hak_akses']?></td>
								 				<td align="center">
								 					<a href="del.php?id=<?=$data['kd_akun']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
								 				</td>
								 			</tr>
								 	<?php
								 	}
									?>
								</tbody>
							</table>
						</form>
					</div>
				</div>

		<!-- Modal Popup untuk Add--> 
		<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		   <script type="text/javascript">
		   	$(document).ready(function () {
	           $(".modal_add").click(function(e) {
	              var m = $(this).attr("id");
	               $.ajax({
	                     url: "add.php",
	                     type: "GET",
	                     success: function (ajaxData){
	                       $("#ModalAdd").html(ajaxData);
	                       $("#ModalAdd").modal('show',{backdrop: 'true'});
	                     }
	                   });
	                });
	              });
		    $(document).ready(function(){
		      $('#datatables').DataTable({
		      	scrollY : '270px',
		    	columnDefs: [
			    	{
			    		"searchable": false,
			    		"orderable": false,
			    		"targets": [0, 5]
			    	}
			    	],
			    	"order": [1, "asc"]
		    });
		    });
	        </script>

<?php include_once('../_footer.php');?>