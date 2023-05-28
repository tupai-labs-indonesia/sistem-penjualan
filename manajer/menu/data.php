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
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Data Menu
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
											<th width="50px;">No.</th>
											<th width="130px;">Kode Menu</th>
											<th>Nama</th>
											<th width="100px;">Sejak</th>
											<th width="70px;">Jenis</th>
											<th width="170px;">Kategori</th>
											<th width="130px;">Harga</th>
											<th width="90px;"><center>Opsi</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$sql_menu = mysqli_query($con, "SELECT a.kd_menu, a.menu, a.sejak, c.jenis, b.kategori, a.harga FROM tb_menu a, tb_kategori b, tb_jenis c WHERE a.kd_kategori = b.kd_kategori AND b.kd_jenis = c.kd_jenis order by kd_menu asc") or die (Mysqli_error($con));
									 	while($data = mysqli_fetch_array($sql_menu)) {
									 	$tgl = $data['sejak'];
										$bulan = date('F', strtotime($tgl));
										$tahun = date('Y', strtotime($tgl));
							            if ($bulan=="January") { $bulann="Januari"; }
							            elseif ($bulan=="February") { $bulann="Februari"; }
							            elseif ($bulan=="March") { $bulann="Maret"; }
							            elseif ($bulan=="April") { $bulann="April"; }
							            elseif ($bulan=="May") { $bulann="Mei"; }
							            elseif ($bulan=="June") { $bulann="Juni"; }
							            elseif ($bulan=="July") { $bulann="Juli"; }
							            elseif ($bulan=="August") { $bulann="Agustus"; }
							            elseif ($bulan=="September") { $bulann="September"; }
							            elseif ($bulan=="October") { $bulann="Oktober"; }
							            elseif ($bulan=="November") { $bulann="November"; }
							            elseif ($bulan=="December") { $bulann="Desember"; } ?>
									 			<tr>
									 				<td><?=$no++?>.</td>
									 				<td><?=$data['kd_menu']?></td>
									 				<td><?=$data['menu']?></td>
									 				<td><?= $bulann;?> &nbsp; <?= $tahun; ?></td>
									 				<td><?=$data['jenis']?></td>
									 				<td><?=$data['kategori']?></td>
									 				<td>Rp. <?=number_format($data['harga'], 2, ",", ".")?></td>
									 			<td align="center">
									 				<a href="#" class="modal_edit btn btn-warning btn-xs" id="<?=$data['kd_menu']?>" gambar="<?=$data['gambar']?>"><i class="glyphicon glyphicon-edit"></i></a>
									 					<a href="del.php?id=<?=$data['kd_menu']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
	                     data : {kd_menu: m,},
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
	           $(".modal_view").click(function(e) {
	              var m = $(this).attr("id");
	               $.ajax({
	                     type: "GET",
	                     data : {kd_menu: m,},
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
			    		"targets": [0, 5, 6, 7]
			    	}
			    	],
			    	"order": [1, "asc"]
		   		});
		    });
	        </script>

<?php include_once('../_footer.php');?>