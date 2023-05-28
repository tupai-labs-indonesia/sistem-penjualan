<?php include_once('../_header.php');?>

                <div class="row" style="padding-top: 30px;">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>MASTER DATA</strong>
                                </div>
                                <?php include_once('../jam&tanggal.php');?>
                            </div>
                        </h1>
                        <div class="alert alert-info" role="alert"  style="font-size: 18px; font-family: cursive;">
                        	<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Data Pegawai
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-bottom: 20px;">
								<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" class="modal_add btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
						</div>
						<div class="table-responsive">
							<form method="post" name="proses">
								<table class="table table-striped table-bordered table-hover" id="datatables">
									<thead>
										<tr>
											<th>No.</th>
											<th>Kode Pegawai</th>
											<th>Nama</th>
											<th>Tanggal Lahir</th>
											<th>Kelamin</th>
											<th>Alamat</th>
											<th>No. Telepon</th>
											<th>E-mail</th>
											<th>Posisi</th>
											<th><center>Opsi</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$sql_pegawai = mysqli_query($con, "SELECT a.kd_pegawai, a.nama, a.tgl_lahir, a.gender, a.alamat, a.telp, a.email, b.posisi FROM tb_pegawai a, tb_posisi b WHERE a.kd_posisi = b.kd_posisi") or die (Mysqli_error($con));
									 	while($data = mysqli_fetch_array($sql_pegawai)) {
									 	$tgl = $data['tgl_lahir'];
										$tanggal = date('d', strtotime($tgl));
										$bulann = date('F', strtotime($tgl));
										$tahunn = date('Y', strtotime($tgl)); ?>
									 			<tr>
									 				<td><?=$no++?>.</td>
									 				<td><?=$data['kd_pegawai']?></td>
									 				<td><?=$data['nama']?></td>
									 				<td><?= $tanggal;
												            $bulan = $bulann;
												            if ($bulan=="January") {
												             echo " Januari ";
												            }elseif ($bulan=="February") {
												             echo " Februari ";
												            }elseif ($bulan=="March") {
												             echo " Maret ";
												            }elseif ($bulan=="April") {
												             echo " April ";
												            }elseif ($bulan=="May") {
												             echo " Mei ";
												            }elseif ($bulan=="June") {
												             echo " Juni ";
												            }elseif ($bulan=="July") {
												             echo " Juli ";
												            }elseif ($bulan=="August") {
												             echo " Agustus ";
												            }elseif ($bulan=="September") {
												             echo " September ";
												            }elseif ($bulan=="October") {
												             echo " Oktober ";
												            }elseif ($bulan=="November") {
												             echo " November ";
												            }elseif ($bulan=="December") {
												             echo " Desember ";
												            }
												            $tahun = $tahunn;
												            echo $tahun;?></td>
									 				<td><?=$data['gender']?></td>
									 				<td><?=$data['alamat']?></td>
									 				<td><?=$data['telp']?></td>
									 				<td><?=$data['email']?></td>
									 				<td><?=$data['posisi']?></td>
									 				<td align="center">
									 					<a href="#" class="modal_edit btn btn-warning btn-xs" id="<?=$data['kd_pegawai']?>"><i class="glyphicon glyphicon-edit"></i></a>
									 					<a href="del.php?id=<?=$data['kd_pegawai']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
				</div>

		<!-- Modal Popup untuk--> 
		<div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		   <script type="text/javascript">
		   	$(document).ready(function(){
	           $(".modal_edit").click(function(e) {
	              var m = $(this).attr("id");
	               $.ajax({
	                     url: "edit.php",
	                     type: "GET",
	                     data : {kd_pegawai: m,},
	                     success: function (ajaxData){
	                       $("#Modal").html(ajaxData);
	                       $("#Modal").modal('show',{backdrop: 'true'});
	                     }
	                   });
	                });
      			 });
			$(document).ready(function(){
	           $(".modal_add").click(function(e) {
	              var m = $(this).attr("id");
	               $.ajax({
	                     url: "add.php",
	                     type: "GET",
	                     success: function (ajaxData){
	                       $("#Modal").html(ajaxData);
	                       $("#Modal").modal('show',{backdrop: 'true'});
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
			    		"targets": [0, 5, 6, 7, 8, 9]
			    	}
			    	],
			    	"order": [1, "asc"]
		   		});
		    });
	        </script>

<?php include_once('../_footer.php');?>