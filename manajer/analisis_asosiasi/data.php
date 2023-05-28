<?php include_once('../_header.php');?>

<div class="row" style="padding-top: 30px;">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="row">
                <div class="col-md-4">
                    <strong>ANALISIS ASOSIASI</strong>
                </div>
                <?php include_once('../jam&tanggal.php');?>
            </div>
        </h1>
        <div class="alert alert-success" role="alert"  style="font-size: 18px; font-family: cursive;">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-info-circle"></i> Hello <strong><?=$_SESSION['username']; ?></strong>, anda berhasil masuk kedalam sistem sebagai <strong><?=$_SESSION['hak_akses']; ?></strong>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div style="margin-bottom: 20px;">
			Klik untuk mengupdate tabel praproses data &nbsp;&nbsp; <span class="glyphicon glyphicon-arrow-right"></span>
				<a href="?mnu=generate"  class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-refresh"></i> Generate Praproses data</a>
				<span class="glyphicon glyphicon-arrow-left"></span>
		</div>
	</div>
	<div class="col-md-6">
		<div style="margin-bottom: 20px;" class="pull-right">
			Klik untuk mengupdate pola kombinasi apriori baru &nbsp;&nbsp; <span class="glyphicon glyphicon-arrow-right"></span>
				<a href="#" class="modal_apriori btn btn-success btn-sm"><i class="glyphicon glyphicon-refresh"></i> Generate Apriori</a>
				<span class="glyphicon glyphicon-arrow-left"></span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
	</div>
	<div class="col-md-6">
		<div style="margin-bottom: 20px;" class="pull-right">
			Klik untuk melihat pola kombinasi apriori terakhir yang diupdate &nbsp;&nbsp; <span class="glyphicon glyphicon-arrow-right"></span>
				<a href="kombinasi_apriori.php" class="btn btn-info btn-sm" target="_BLANK"><i class="fa fa-eye" aria-hidden="true"></i> Pola Kombinasi Apriori</a>
				<span class="glyphicon glyphicon-arrow-left"></span>
		</div>
	</div>
</div>

<?php
if(isset($_GET["mnu"])){
	$sql_menu = mysqli_query($con, "SELECT tanggal,nonota FROM penjualan order by nonota asc") or die (Mysqli_error($con));
	
	while($d= mysqli_fetch_array($sql_menu)) { 
		$nonota=$d["nonota"];
		$tanggal=$d["tanggal"];
		$gab="";
		$gab2="";
				
		$sql_menu2 = mysqli_query($con, "SELECT detailpenjualan.kd_menu,tb_menu.menu FROM detailpenjualan,tb_menu where  detailpenjualan.kd_menu=tb_menu.kd_menu and detailpenjualan.nonota ='$nonota'") or die (Mysqli_error($con));

		while($d2= mysqli_fetch_array($sql_menu2)) { 
			$kd_menu=$d2["kd_menu"];
			$menu=$d2["menu"];				
			$gab.="$kd_menu, ";
			$gab2.="$menu, ";
		}//while
	
		$sq="INSERT INTO tb_praproses (nonota, tanggal, itemset, item) VALUES ('$nonota', '$tanggal', '$gab', '$gab2');";
		mysqli_query($con, $sq);		
	}//while
}
?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<div style="margin-bottom: 20px;">
                <h4><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> TABEL PRAPROSES DATA</h4>
			</div>
			<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="praproses">
						<thead>
							<tr>
								<th>Nota</th>
								<th>Itemset</th>
								<th>Tanggal</th>
							</tr>
						</thead>
					</table>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#praproses').DataTable({
						scrollY : '374px',
						"processing": true,
						"serverSide": true,
						"ajax": "praproses-serverside.php",
						columnDefs: [{
							"searchable": false,
							"orderable": false,
							"targets": [1]
						}]
					});
				});
			</script>>
		</ol>
	</div>
</div>

<!-- Modal Popup untuk apriori--> 
<div id="MODAL" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


<script type="text/javascript">
$(document).ready(function() {
	$(".modal_apriori").click(function(e) {
	  	var m = $(this).attr("id");
		$.ajax({
	         url: "modal_apriori.php",
	         type: "GET",
	         success: function (ajaxData){
	           $("#MODAL").html(ajaxData);
	           $("#MODAL").modal('show',{backdrop: 'true'});
	         }
	    });
	});
});
</script>

<?php include_once('../_footer.php');?>