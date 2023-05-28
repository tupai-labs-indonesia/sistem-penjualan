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
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Jenis dan Kategori Menu
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-4">
						<ol class="breadcrumb">
							<div style="margin-bottom: 20px;">
									<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
									<a href="#" class="modal_add_jenis btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
							</div>
							<div class="table-responsive">
								<form method="post" name="proses">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>Kode Jenis</th>
												<th>Jenis</th>
												<th><center>Opsi</center></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$sql_jenis = mysqli_query($con, "SELECT * FROM tb_jenis") or die (Mysqli_error($con));
										 	while($data = mysqli_fetch_array($sql_jenis)) { ?>
										 			<tr>
										 				<td><?=$no++?>.</td>
										 				<td><?=$data['kd_jenis']?></td>
										 				<td><?=$data['jenis']?></td>
										 				<td align="center">
										 					<a href="#" class="modal_edit_jenis btn btn-warning btn-xs" id="<?=$data['kd_jenis']?>"><i class="glyphicon glyphicon-edit"></i></a>
										 					<a href="del_jenis.php?id=<?=$data['kd_jenis']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
										 				</td>
										 			</tr>
										 	<?php
										 	}
											?>
										</tbody>
									</table>
								</form>
							</div>
						</ol>
					</div>
					<div class="col-md-8">
						<ol class="breadcrumb">
							<div style="margin-bottom: 20px;">
									<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
									<a href="#" class="modal_add_kategori btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
							</div>
							<div class="table-responsive">
							<form method="post" name="proses">
									<table class="table table-striped table-bordered table-hover" id="datatables">
										<thead>
											<tr>
												<th>No.</th>
												<th>Kode Kategori</th>
												<th>Kategori</th>
												<th>Jenis</th>
												<th><center>Opsi</center></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$sql_kategori = mysqli_query($con, "SELECT a.kd_kategori, a.kategori, b.jenis FROM tb_kategori a, tb_jenis b WHERE a.kd_jenis = b.kd_jenis") or die (Mysqli_error($con));
										 	while($data = mysqli_fetch_array($sql_kategori)) { ?>
										 			<tr>
										 				<td><?=$no++?>.</td>
										 				<td><?=$data['kd_kategori']?></td>
										 				<td><?=$data['kategori']?></td>
										 				<td><?=$data['jenis']?></td>
										 				<td align="center">
										 					<a href="#" class="modal_edit_kategori btn btn-warning btn-xs" id="<?=$data['kd_kategori']?>"><i class="glyphicon glyphicon-edit"></i></a>
										 					<a href="del_kategori.php?id=<?=$data['kd_kategori']?>" onclick="return confirm('Yakin akan menghapus data?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
										 				</td>
										 			</tr>
										 	<?php
										 	}
											?>
										</tbody>
									</table>
								</form>
							</div>
						</ol>
					</div>
				</div>

		<!-- Modal Popup--> 
		<div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

	   <script type="text/javascript">
	   	$(document).ready(function () {
           $(".modal_edit_kategori").click(function(e) {
              var m = $(this).attr("id");
               $.ajax({
                     url: "edit_kategori.php",
                     type: "GET",
                     data : {kd_kategori: m,},
                     success: function (ajaxData){
                       $("#Modal").html(ajaxData);
                       $("#Modal").modal('show',{backdrop: 'true'});
                     }
                   });
                });
              });
	   	$(document).ready(function () {
           $(".modal_edit_jenis").click(function(e) {
              var m = $(this).attr("id");
               $.ajax({
                     url: "edit_jenis.php",
                     type: "GET",
                     data : {kd_jenis: m,},
                     success: function (ajaxData){
                       $("#Modal").html(ajaxData);
                       $("#Modal").modal('show',{backdrop: 'true'});
                     }
                   });
                });
              });
           $(document).ready(function () {
           $(".modal_add_jenis").click(function(e) {
              var m = $(this).attr("id");
               $.ajax({
                     url: "add_jenis.php",
                     type: "GET",
                     success: function (ajaxData){
                       $("#Modal").html(ajaxData);
                       $("#Modal").modal('show',{backdrop: 'true'});
                     }
                   });
                });
              });
           $(document).ready(function () {
           $(".modal_add_kategori").click(function(e) {
              var m = $(this).attr("id");
               $.ajax({
                     url: "add_kategori.php",
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
			    		"targets": [0, 4]
			    	}
			    	],
			    	"order": [1, "asc"]
		    });
		    });
        </script>

<?php include_once('../_footer.php');?>