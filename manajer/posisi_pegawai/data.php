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
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Posisi Pegawai
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
										<th>Kode Posisi</th>
										<th>Nama Posisi</th>
										<th><center>Opsi</center></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$sql_posisi = mysqli_query($con, "SELECT * FROM tb_posisi") or die (mysqli_error($con));
								 	while($data = mysqli_fetch_array($sql_posisi)) { ?>
								 			<tr>
								 				<td><?=$no++?>.</td>
								 				<td><?=$data['kd_posisi']?></td>
								 				<td><?=$data['posisi']?></td>
								 				<td align="center">
								 					<a href="#" class="modal_edit btn btn-warning btn-xs" id="<?=$data['kd_posisi']?>"><i class="glyphicon glyphicon-edit"></i></a>
								 					<a href="del.php?id=<?=$data['kd_posisi']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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

		<!-- Modal Popup untuk Edit--> 
		<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		<!-- Modal Popup untuk Add--> 
		<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		   <script type="text/javascript">
		   	//java script modal edit harus diatas dari javascript datatables
		   	$(document).ready(function () {
	           $(".modal_edit").click(function(e) {
	              var m = $(this).attr("id");
	               $.ajax({
	                     url: "edit.php",
	                     type: "GET",
	                     data : {kd_posisi: m,},
	                     success: function (ajaxData){
	                       $("#ModalEdit").html(ajaxData);
	                       $("#ModalEdit").modal('show',{backdrop: 'true'});
	                     }
	                   });
	                });
	              });
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
			    		"targets": [0, 3]
			    	}
			    	],
			    	"order": [1, "asc"]
		    });
		    });
	        </script>

<?php include_once('../_footer.php');?>