<?php include_once('../_header.php'); ?>

<div class="row" style="padding-top: 30px;">
	<div class="col-lg-12">
		<h1 class="page-header">
			<div class="row">
				<div class="col-md-4">
					<strong>ANALISIS ASOSIASI</strong>
				</div>
				<?php include_once('../jam&tanggal.php'); ?>
			</div>
		</h1>
		<div class="alert alert-info" role="alert" style="font-size: 18px; font-family: cursive;">
			<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Analisis Asosiasi > Pola Kombinasi Apriori
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div style="margin-bottom: 20px;">
			<a href="data.php" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a>
			<a href="cetak/cetakkombinasi.php" target="_BLANK" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-file"></i> Buat laporan</a>
		</div>
	</div>

	<div class="col-md-6">
		<div style="margin-bottom: 20px;" class="pull-right">
			Klik untuk mengupdate aturan assosiasi &nbsp;&nbsp; <span class="glyphicon glyphicon-arrow-right"></span>
			<a href="#" class="modal_assosiasi btn btn-success btn-sm"><i class="glyphicon glyphicon-refresh"></i> Association rules</a>
			<span class="glyphicon glyphicon-arrow-left"></span>
		</div>
	</div>
</div>



<?php
if (isset($_POST["Proses"])) {
	$awal = microtime(true); //awal baca waktu proses execute

	$tanggal1 = $_POST["tanggal1"];
	$tanggal2 = $_POST["tanggal2"];
	$mins = $_POST["minsup"];

	$sql = "truncate tb_kombinasi";
	$sql1 = "truncate tb_eliminasi";
	$sql2 = "truncate temp_data";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	$q1 = mysqli_query($con, $sql1) or die(Mysqli_error($con));
	$q2 = mysqli_query($con, $sql2) or die(Mysqli_error($con));

	$sql = "SELECT distinct(nonota) FROM tb_praproses where tanggal between '$tanggal1' and '$tanggal2'";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	$jumTX = mysqli_num_rows($q) or die(Mysqli_error($con));

	$sql_menu = mysqli_query($con, "SELECT kd_menu, menu FROM tb_menu") or die(Mysqli_error($con));

	$e = 0;
	while ($d = mysqli_fetch_array($sql_menu)) {
		$kdmenu = $d["kd_menu"];
		$menu = $d["menu"];
		$sc = getSCE($con, $kdmenu, $tanggal1, $tanggal2);
		$s = ($sc / $jumTX) * 100;

		if ($s < $mins) {
			$arK[$e] = $kdmenu;
			$arM[$e] = $menu;
			mysimpaneliminasi($con, $kdmenu, $menu, $sc, bulat($s));
			$e++;
		}
	}

	$sql_menu = mysqli_query($con, "SELECT kd_menu, menu FROM tb_menu") or die(Mysqli_error($con));

	$i = 0;
	while ($d = mysqli_fetch_array($sql_menu)) {
		$kdmenu = $d["kd_menu"];
		$menu = $d["menu"];
		$sc = getSC($con, $kdmenu, $tanggal1, $tanggal2);
		$s = ($sc / $jumTX) * 100;
		if ($s >= $mins) {
			$arK[$i] = $kdmenu;
			$arM[$i] = $menu;
			mysimpan($con, $kdmenu, $menu, "L1", $sc, bulat($s));
			$i++;
		}
	}

	// save all data
	$sql_menu2 = mysqli_query($con, "SELECT kd_menu, menu FROM tb_menu") or die(Mysqli_error($con));
	$loop = 0;
	while ($datax = mysqli_fetch_array($sql_menu2)) {
		$kdmenu = $datax["kd_menu"];
		$menu = $datax["menu"];
		$sc = getSC($con, $kdmenu, $tanggal1, $tanggal2);
		$s = ($sc / $jumTX) * 100;
			$arK[$loop] = $kdmenu;
			$arM[$loop] = $menu;
			mysimpan_temp_data($con, $kdmenu, $menu, $sc, bulat($s));
			$loop++;
		}
	

	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	$b1 = $i;
	$x = 0;

	for ($i = 0; $i < $b1 - 1; $i++) {
		$k1 = $arK[$i];
		$m1 = $arM[$i];
		$sc1 = getSC($con, $k1, $tanggal1, $tanggal2);
		$s1 = ($sc1 / $jumTX) * 100;

		if ($s1 >= $mins) {
			for ($j = $i + 1; $j < $b1; $j++) {
				$k2 = $arK[$j];
				$m2 = $arM[$j];
				$sc2 = getSC2($con, $k1, $k2, $tanggal1, $tanggal2);
				$s2 = ($sc2 / $jumTX) * 100;

				if ($s2 >= $mins) {
					$arK3[$x] = $k1 . ", " . $k2;
					$arM3[$x] = $m1 . ", " . $m2;
					$arSC3[$x] = $sc2;
					$arS3[$x] = bulat($s2);
					mysimpan($con, $arK3[$x], $arM3[$x], "L2", $arSC3[$x], $arS3[$x]);
					$x++;
				}
			}
		}
	}

	$x = 0;
	for ($i = 0; $i < $b1 - 2; $i++) {
		$k1 = $arK[$i];
		$m1 = $arM[$i];
		$sc1 = getSC($con, $k1, $tanggal1, $tanggal2);
		$s1 = ($sc1 / $jumTX) * 100;

		if ($s1 >= $mins) {
			for ($j = $i + 1; $j < $b1 - 1; $j++) {
				$k2 = $arK[$j];
				$m2 = $arM[$j];
				$sc2 = getSC2($con, $k1, $k2, $tanggal1, $tanggal2);
				$s2 = ($sc2 / $jumTX) * 100;
				if ($s2 >= $mins) {
					for ($k = $j + 1; $k < $b1; $k++) {
						$k3 = $arK[$k];
						$m3 = $arM[$k];
						$sc3 = getSC3($con, $k1, $k2, $k3, $tanggal1, $tanggal2);
						$s3 = ($sc3 / $jumTX) * 100;

						if ($s3 >= $mins) {
							$arK4[$x] = $k1 . ", " . $k2 . ", " . $k3;
							$arM4[$x] = $m1 . ", " . $m2 . ", " . $m3;
							$arSC4[$x] = $sc3;
							$arS4[$x] = bulat($s3);
							mysimpan($con, $arK4[$x], $arM4[$x], "L3", $arSC4[$x], $arS4[$x]);
							$x++;
						}
					}
				}
			}
		}
	}

	//$x = 0;
	//for ($i = 0; $i < $b1 - 3; $i++) {
	//	$k1 = $arK[$i];
	//	$m1 = $arM[$i];
	//	$sc1 = getSC($con, $k1, $tanggal1, $tanggal2);
	//	$s1 = ($sc1 / $jumTX) * 100;

//		if ($s1 >= $mins) {
//			for ($j = $i + 1; $j < $b1 - 2; $j++) {
///				$k2 = $arK[$j];
	//			$m2 = $arM[$j];
	//			$sc2 = getSC2($con, $k1, $k2, $tanggal1, $tanggal2);
	//			$s2 = ($sc2 / $jumTX) * 100;
//
//				if ($s2 >= $mins) {
//					for ($k = $j + 1; $k < $b1 - 1; $k++) {
//						$k3 = $arK[$k];
//						$m3 = $arM[$k];
//						$sc3 = getSC3($con, $k1, $k2, $k3, $tanggal1, $tanggal2);
//						$s3 = ($sc3 / $jumTX) * 100;

//						if ($s3 >= $mins) {
//							for ($l = $k + 1; $l < $b1; $l++) {
//								$k4 = $arK[$l];
//								$m4 = $arM[$l];
//								$sc4 = getSC4($con, $k1, $k2, $k3, $k4, $tanggal1, $tanggal2);
//								$s4 = ($sc4 / $jumTX) * 100;

//								if ($s4 >= $mins) {
//									$arK5[$x] = $k1 . ", " . $k2 . ", " . $k3 . ", " . $k4;
//									$arM5[$x] = $m1 . ", " . $m2 . ", " . $m3 . ", " . $m4;
//									$arSC5[$x] = $sc4;
//									$arS5[$x] = bulat($s4);
//									mysimpan($con, $arK5[$x], $arM5[$x], "L4", $arSC5[$x], $arS5[$x]);
//									$x++;
//								}
//							}
//						}
//					}
//				}
//			}
//		}
//	}
	$akhir = microtime(true); //akhir baca waktu proses execute
	$lama = $akhir - $awal;

	//simpan lama waktu program mengeksekusi proses algoritma apriori
	$exe = bulat($lama);
	$sql_record = mysqli_query($con, "SELECT * FROM tb_praproses where tanggal between '$tanggal1' and '$tanggal2'") or die(Mysqli_error($con));
	$record = mysqli_num_rows($sql_record);
	echo "$record";
	mysqli_query($con, "INSERT INTO tb_execute (id, lama, record, support) VALUES ('', '$exe', '$record','$mins')") or die(mysqli_error($con));
} //isset

// all data
$sql_exe = mysqli_query($con, "SELECT * FROM tb_execute order by id desc limit 1") or die(Mysqli_error($con));
while ($execute = mysqli_fetch_array($sql_exe)) {
	$tampil = $execute["lama"];
	$record = $execute["record"];
	$support = $execute["support"];
	echo "Lama waktu eksekusi proses pencarian kombinasi adalah <strong>" . $tampil . "</strong> detik, dengan banyak data yang diproses adalah <strong>" . $record . "</strong> data dan minimum support adalah <strong>" . $support . "%</strong>.";
}

echo "<div class='row'>";
echo "<div class='col-md-6'>";
echo "<ol class='breadcrumb'>";
echo "<h1>Data Keseluruhan</h1>";
echo "<div class='table-responsive'>";
echo "<form method='post'>";
echo "<table class='table table-striped table-bordered table-hover' id='datatables2'>";
echo "<thead><tr><th>No.</th><th>Itemset</th><th>Support Count</th><th>Support</th></tr></thead>";
echo "<tbody>";
$no = 0;
$sql_menu = mysqli_query($con, "SELECT * FROM temp_data order by support desc") or die(Mysqli_error($con));
while ($d = mysqli_fetch_array($sql_menu)) {
	$no++;
	$itemset = $d["itemset"];
	$item = $d["item"];
	$supcount = $d["supcount"];
	$support = $d["support"];
	echo "<tr><td>$no</td><td>" . $item . "<td>" . $supcount . "<td>" . $support . " %</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "</ol>";
echo "</div>";
// =======

$sql_exe = mysqli_query($con, "SELECT * FROM tb_execute order by id desc limit 1") or die(Mysqli_error($con));
while ($execute = mysqli_fetch_array($sql_exe)) {
	$tampil = $execute["lama"];
	$record = $execute["record"];
	$support = $execute["support"];
	// echo "Lama waktu eksekusi proses pencarian kombinasi adalah <strong>" . $tampil . "</strong> detik, dengan banyak data yang diproses adalah <strong>" . $record . "</strong> data dan minimum support adalah <strong>" . $support . "%</strong>.";
}

echo "<div class='row'>";
echo "<div class='col-md-6'>";
echo "<ol class='breadcrumb'>";
echo "<h1>L1</h1>";
echo "<div class='table-responsive'>";
echo "<form method='post'>";
echo "<table class='table table-striped table-bordered table-hover' id='datatables'>";
echo "<thead><tr><th>No.</th><th>Itemset</th><th>Support Count</th><th>Support</th></tr></thead>";
echo "<tbody>";
$no = 0;
$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L1' order by support desc") or die(Mysqli_error($con));
while ($d = mysqli_fetch_array($sql_menu)) {
	$no++;
	$itemset = $d["itemset"];
	$item = $d["item"];
	$supcount = $d["supcount"];
	$support = $d["support"];
	echo "<tr><td>$no</td><td>" . $item . "<td>" . $supcount . "<td>" . $support . " %</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "</ol>";
echo "</div>";

echo "<div class='col-md-7'>";
echo "<ol class='breadcrumb'>";
echo "<h1>L2</h1>";
echo "<div class='table-responsive'>";
echo "<form method='post'>";
echo "<table class='table table-striped table-bordered table-hover' id='datatabless'>";
echo "<thead><tr><th>No.</th><th>Itemset</th><th>Support Count</th><th>Support</th></tr></thead>";
echo "<tbody>";
$no = 0;
$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L2' order by support desc") or die(Mysqli_error($con));
while ($d = mysqli_fetch_array($sql_menu)) {
	$no++;
	$itemset = $d["itemset"];
	$item = $d["item"];
	$supcount = $d["supcount"];
	$support = $d["support"];
	echo "<tr><td>$no</td><td>" . $item . "<td>" . $supcount . "<td>" . $support . " %</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "</ol>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col-lg-12'>";
echo "<ol class='breadcrumb'>";
echo "<h1>L3</h1>";
echo "<div class='table-responsive'>";
echo "<form method='post'>";
echo "<table class='table table-striped table-bordered table-hover' id='datatablesss'>";
echo "<thead><tr><th>No.</th><th>Itemset</th><th>Support Count</th><th>Support</th></tr></thead>";
echo "<tbody>";
$no = 0;
$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L3' order by support desc") or die(Mysqli_error($con));
while ($d = mysqli_fetch_array($sql_menu)) {
	$no++;
	$itemset = $d["itemset"];
	$item = $d["item"];
	$supcount = $d["supcount"];
	$support = $d["support"];
	echo "<tr><td>$no</td><td>" . $item . "<td>" . $supcount . "<td>" . $support . " %</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</form>";
echo "</div>";
echo "</ol>";
echo "</div>";
echo "</div>";

//echo "<div class='row'>";
//echo "<div class='col-lg-12'>";
//echo "<ol class='breadcrumb'>";
//echo "<h1>L4</h1>";
//echo "<div class='table-responsive'>";
//echo "<form method='post'>";
//echo "<table class='table table-striped table-bordered table-hover' id='datatablessss'>";
//echo "<thead><tr><th>No.</th><th>Itemset</th><th>Support Count</th><th>Support</th></tr></thead>";
//echo "<tbody>";
//$no = 0;
//$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L4' order by support desc") or die(Mysqli_error($con));
//while ($d = mysqli_fetch_array($sql_menu)) {
	//$no++;
	//$itemset = $d["itemset"];
	//$item = $d["item"];
	//$supcount = $d["supcount"];
	//$support = $d["support"];
	//echo "<tr><td>$no</td><td>" . $item . "<td>" . $supcount . "<td>" . $support . " %</tr>";
//}
//echo "</tbody>";
//echo "</table>";
//echo "</form>";
//echo "</div>";
//echo "</ol>";
//echo "</div>";
//echo "</div>";
?>

<br>
<hr>

<?php
function getSCE($con, $kode, $t1, $t2)
{
	$sql = "SELECT nonota FROM tb_praproses where itemset like '%$kode%' and tanggal between '$t1' and '$t2'";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	$jum = mysqli_num_rows($q);
	return $jum;
}

function getSC($con, $kode, $t1, $t2)
{
	$sql = "SELECT nonota FROM tb_praproses where itemset like '%$kode%' and tanggal between '$t1' and '$t2'";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	$jum = mysqli_num_rows($q);
	return $jum;
}

function getSC2($con, $kode, $kode2, $t1, $t2)
{
	$sql = "SELECT nonota FROM tb_praproses where (itemset like '%$kode%' and itemset like '%$kode2%') and (tanggal between '$t1' and '$t2')";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	$jum = mysqli_num_rows($q);
	return $jum;
}

function getSC3($con, $kode, $kode2, $kode3, $t1, $t2)
{
	$sql = "SELECT nonota FROM tb_praproses where (itemset like '%$kode%' and itemset like '%$kode2%' and itemset like '%$kode3%') and tanggal between '$t1' and '$t2'";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	$jum = mysqli_num_rows($q);
	return $jum;
}

//function getSC4($con, $kode, $kode2, $kode3, $kode4, $t1, $t2)
//{
	//$sql = "SELECT nonota FROM tb_praproses where (itemset like '%$kode%' and itemset like '%$kode2%' and itemset like '%$kode3%' and itemset like '%$kode4%') and tanggal between '$t1' and '$t2'";
	//$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	//$jum = mysqli_num_rows($q);
	//return $jum;
//}

function bulat($v)
{
	return round($v, 2);
}
?>

<!-- Modal Popup untuk assosiasi-->
<div id="MODAL" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#datatables').DataTable({
			scrollY: '370px',
			columnDefs: [{
				"searchable": false,
				"orderable": false
			}],
			"order": [0, "asc"]
		});
	});

	$(document).ready(function() {
		$('#datatables2').DataTable({
			scrollY: '370px',
			columnDefs: [{
				"searchable": false,
				"orderable": false
			}],
			"order": [0, "asc"]
		});
	});
	$(document).ready(function() {
		$('#datatabless').DataTable({
			scrollY: '370px',
			columnDefs: [{
				"searchable": false,
				"orderable": false
			}],
			"order": [0, "asc"]
		});
	});
	$(document).ready(function() {
		$('#datatablesss').DataTable({
			scrollY: '370px',
			columnDefs: [{
				"searchable": false,
				"orderable": false
			}],
			"order": [0, "asc"]
		});
	});
	$(document).ready(function() {
		$('#datatablessss').DataTable({
			scrollY: '370px',
			columnDefs: [{
				"searchable": false,
				"orderable": false
			}],
			"order": [0, "asc"]
		});
	});
	$(document).ready(function() {
		$(".modal_assosiasi").click(function(e) {
			var m = $(this).attr("id");
			$.ajax({
				url: "modal_assosiasi.php",
				type: "GET",
				success: function(ajaxData) {
					$("#MODAL").html(ajaxData);
					$("#MODAL").modal('show', {
						backdrop: 'true'
					});
				}
			});
		});
	});
</script>

<?php include_once('../_footer.php'); ?>

<?php
function mysimpan($con, $itemset, $item, $level, $sc, $support)
{
	$sql = "INSERT INTO `tb_kombinasi` (`id`, `itemset`, `item`, `level`, `supcount`, `support`) VALUES ('', '$itemset', '$item', '$level', '$sc', '$support')";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	return 1;
}

function mysimpan_temp_data($con, $itemset, $item, $sc, $support)
{
	$sql = "INSERT INTO `temp_data` (`id`, `itemset`, `item`, `supcount`, `support`) VALUES ('', '$itemset', '$item', '$sc', '$support')";
	$q = mysqli_query($con, $sql) or die(Mysqli_error($con));
	return 1;
}

function mysimpaneliminasi($con, $itemset, $item, $sc, $support)
{
	$sql1 = "INSERT INTO `tb_eliminasi` (`id`, `itemset`, `item`, `supcount`, `support`) VALUES ('', '$itemset', '$item', '$sc', '$support')";
	$q1 = mysqli_query($con, $sql1) or die(Mysqli_error($con));
	return 1;
}
?>