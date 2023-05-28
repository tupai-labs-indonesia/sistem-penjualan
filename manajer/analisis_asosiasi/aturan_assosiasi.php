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
        <div class="alert alert-info" role="alert"  style="font-size: 18px; font-family: cursive;">
            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Analisis Asosiasi > Pola Kombinasi Apriori > Aturan Assosiasi
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div style="margin-bottom: 20px;" class="pull-left">
			<a href="kombinasi_apriori.php"  class="btn btn-default btn-sm"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a>
			<a href="cetak/cetakassosiasi.php" target="_BLANK" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-file"></i> Buat laporan</a>
		</div>
	</div>
	<div class="col-md-6">
		<div style="margin-bottom: 20px;" class="pull-right">
			Klik untuk melihat produk yang kurang laku &nbsp;&nbsp; <span class="glyphicon glyphicon-arrow-right"></span>
			<a href="#"  class="modal_ket btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Produk Kurang Laku</a>
			<span class="glyphicon glyphicon-arrow-left"></span>
		</div>
	</div>
</div>


<?php
error_reporting(0);
$sql="truncate tb_assosiasi";
$q= mysqli_query($con, $sql) or die (Mysqli_error($con));

$mins=$_POST["minconf"];

$i=0;
$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L2' order by support desc") or die (Mysqli_error($con));
while($d= mysqli_fetch_array($sql_menu)) { 
	
	$itemset=$d["itemset"];//kode
	$item=$d["item"];//menu
	$supcount=$d["supcount"];
	$support=$d["support"];
	
	$ar1=explode(", ",$itemset);
	$ar2=explode(", ",$item);

	$kode1=$ar1[0];
	$kode2=$ar1[1];

	$menu1=$ar2[0];
	$menu2=$ar2[1];
				
	for($j=0;$j<2;$j++) {
							
		$itemsetnew=$kode1." THEN ".$kode2;
		$itemnew=$menu1." THEN ".$menu2;
		$kodekanan=$kode1;
		
		if($j==1) {
			
			$itemsetnew=$kode2." THEN ".$kode1;
			$itemnew=$menu2." THEN ".$menu1;
			$kodekanan=$kode2;
		
		}	

		$arKombinasi[$i]=$itemsetnew;
		$arMenu[$i]=$itemnew;	
			$conf1=getSupport($con,$itemset);//BB sama saja itemsetnew=itemset
			$conf2=getSupport($con,$kodekanan);
			$arC1[$i]=$conf1;
			$arC2[$i]=$conf2;
			$arC3[$i]=($conf1/$conf2)*100;
			$c3=$arC3[$i];
			if($c3>=$mins) {
			mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L2",$arC1[$i],$arC2[$i],bulat($c3));
			}
			$i++;	
	}
}

$i=0;
$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L3' order by support desc") or die (Mysqli_error($con));
while($d= mysqli_fetch_array($sql_menu)) { 
	
	$itemset=$d["itemset"];//kode
	$item=$d["item"];//menu
	$supcount=$d["supcount"];
	$support=$d["support"];
	
	$ar1=explode(", ",$itemset);
	$ar2=explode(", ",$item);

	$kode1=$ar1[0];
	$kode2=$ar1[1];
	$kode3=$ar1[2];

	$menu1=$ar2[0];
	$menu2=$ar2[1];
	$menu3=$ar2[2];
								
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode1.", ".$kode2." THEN ".$kode3;
	$itemnew=$menu1.", ".$menu2." THEN ".$menu3;
	$kodekanan=$kode1.", ".$kode2;
	$kodekanan2=$kode2.", ".$kode1;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {	
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L3",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++
	$itemsetnew=$kode3.", ".$kode1." THEN ".$kode2;
	$itemnew=$menu3.", ".$menu1." THEN ".$menu2;
	$kodekanan=$kode3.", ".$kode1;
	$kodekanan2=$kode1.", ".$kode3;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L3",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++
	$itemsetnew=$kode2.", ".$kode3." THEN ".$kode1;
	$itemnew=$menu2.", ".$menu3." THEN ".$menu1;
	$kodekanan=$kode2.", ".$kode3;
	$kodekanan2=$kode3.", ".$kode2;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L3",$arC1[$i],$arC2[$i],bulat($c3));
		}
			$i++;	
	//++++++++++++++++++++++++++++++++++++++		
}

$i=0;
$sql_menu = mysqli_query($con, "SELECT * FROM tb_kombinasi where level='L4' order by support desc") or die (Mysqli_error($con));
while($d= mysqli_fetch_array($sql_menu)) { 
	$itemset=$d["itemset"];//kode
	$item=$d["item"];//menu
	$supcount=$d["supcount"];
	$support=$d["support"];
	$ar1=explode(", ",$itemset);
	$ar2=explode(", ",$item);

	$kode1=$ar1[0];
	$kode2=$ar1[1];
	$kode3=$ar1[2];
	$kode4=$ar1[3];

	$menu1=$ar2[0];
	$menu2=$ar2[1];
	$menu3=$ar2[2];
	$menu4=$ar2[3];

							
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode1.", ".$kode2.", ".$kode3." THEN ".$kode4;
	$itemnew=$menu1.", ".$menu2.", ".$menu3." THEN ".$menu4;
	$kodekanan=$kode1.", ".$kode2.", ".$kode3;
	$kodekanan2=$kode3.", ".$kode1.", ".$kode2;
	$kodekanan3=$kode2.", ".$kode3.", ".$kode1;


	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}
		if($conf2==0){$conf2=getSupport($con,$kodekanan3)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode4.", ".$kode1.", ".$kode2." THEN ".$kode3;
	$itemnew=$menu4.", ".$menu1.", ".$menu2." THEN ".$menu3;
	$kodekanan=$kode4.", ".$kode1.", ".$kode2;
	$kodekanan2=$kode2.", ".$kode4.", ".$kode1;
	$kodekanan3=$kode1.", ".$kode2.", ".$kode4;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}
		if($conf2==0){$conf2=getSupport($con,$kodekanan3)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode3.", ".$kode4.", ".$kode1." THEN ".$kode2;
	$itemnew=$menu3.", ".$menu4.", ".$menu1." THEN ".$menu2;
	$kodekanan=$kode3.", ".$kode4.", ".$kode1;
	$kodekanan2=$kode1.", ".$kode3.", ".$kode4;
	$kodekanan3=$kode4.", ".$kode1.", ".$kode3;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}
		if($conf2==0){$conf2=getSupport($con,$kodekanan3)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode2.", ".$kode3.", ".$kode4." THEN ".$kode1;
	$itemnew=$menu2.", ".$menu3.", ".$menu4." THEN ".$menu1;
	$kodekanan=$kode2.", ".$kode3.", ".$kode4;
	$kodekanan2=$kode4.", ".$kode2.", ".$kode3;
	$kodekanan3=$kode3.", ".$kode4.", ".$kode2;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan);
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}
		if($conf2==0){$conf2=getSupport($con,$kodekanan3)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode1.", ".$kode2." THEN ".$kode3.", ".$kode4;
	$itemnew=$menu1.", ".$menu2." THEN ".$menu3.", ".$menu4;
	$kodekanan=$kode1.", ".$kode2;
	$kodekanan2=$kode2.", ".$kode1;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan)+0;
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}


		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode4.", ".$kode1." THEN ".$kode2.", ".$kode3;
	$itemnew=$menu4.", ".$menu1." THEN ".$menu2.", ".$menu3;
	$kodekanan=$kode4.", ".$kode1;
	$kodekanan2=$kode1.", ".$kode4;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan)+0;
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode3.", ".$kode4." THEN ".$kode1.", ".$kode2;
	$itemnew=$menu3.", ".$menu4." THEN ".$menu1.", ".$menu2;
	$kodekanan=$kode3.", ".$kode4;
	$kodekanan2=$kode4.", ".$kode3;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan)+0;
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode2.", ".$kode3." THEN ".$kode4.", ".$kode1;
	$itemnew=$menu2.", ".$menu3." THEN ".$menu4.", ".$menu1;
	$kodekanan=$kode2.", ".$kode3;
	$kodekanan2=$kode3.", ".$kode2;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan)+0;
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode1.", ".$kode3." THEN ".$kode2.", ".$kode4;
	$itemnew=$menu1.", ".$menu3." THEN ".$menu2.", ".$menu4;
	$kodekanan=$kode1.", ".$kode3;
	$kodekanan2=$kode3.", ".$kode1;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan)+0;
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
	//++++++++++++++++++++++++++++++++++++++				
	$itemsetnew=$kode2.", ".$kode4." THEN ".$kode1.", ".$kode3;
	$itemnew=$menu2.", ".$menu4." THEN ".$menu1.", ".$menu3;
	$kodekanan=$kode2.", ".$kode4;
	$kodekanan2=$kode4.", ".$kode2;

	$arKombinasi[$i]=$itemsetnew;
	$arMenu[$i]=$itemnew;	
		$conf1=getSupport($con,$itemset);
		$conf2=getSupport($con,$kodekanan)+0;
		if($conf2==0){$conf2=getSupport($con,$kodekanan2)+0;}

		$arC1[$i]=$conf1;
		$arC2[$i]=$conf2;
		$arC3[$i]=($conf1/$conf2)*100;
		$c3=$arC3[$i];
		if($c3>=$mins) {
		mysimpan($con,$arKombinasi[$i],$arMenu[$i],"L4",$arC1[$i],$arC2[$i],bulat($c3));
		}
		$i++;	
}

function getSupport($con,$kode) {
	$sql="SELECT support FROM tb_kombinasi where itemset like '$kode'";
	$q= mysqli_query($con, $sql) or die (Mysqli_error($con));
	$d=mysqli_fetch_array($q);
	return $d["support"];
}

function bulat($v) {
	return round($v,2);
}

function mysimpan($con,$itemset,$item,$level,$support1,$support2,$confidence) {
	$sql="INSERT INTO `tb_assosiasi` (`id`, `itemset`, `item`, `level`, `support1`, `support2`, `confidence`) VALUES ('', '$itemset', '$item', '$level', '$support1', '$support2', '$confidence')";
	$q= mysqli_query($con, $sql) or die (Mysqli_error($con));
	return 1;
}


echo"<div class='row'>";
	echo"<div class='col-lg-12'>";
	echo"<ol class='breadcrumb'>";
	echo"<h1>Kombinasi 2 Produk</h1>";
		echo"<div class='table-responsive'>";
			echo"<form method='post'>";
				echo"<table class='table table-striped table-bordered table-hover' id='datatables2'>";
					echo"<thead><tr><th>No.</th><th>Itemset { A U B }</th><th>support { A U B }</th><th>support { A }</th><th>Confidence</th></tr></thead>";
					echo"<tbody>";
					$no=0;
					$sql_menu = mysqli_query($con, "SELECT * FROM tb_assosiasi where level='L2' order by confidence desc") or die (Mysqli_error($con));
					while($d= mysqli_fetch_array($sql_menu)) { 
						$no++;
						$item=$d["item"];
						$support1=$d["support1"];
						$support2=$d["support2"];
						$confidence=$d["confidence"];
						echo"<tr><td>$no</td><td>".$item."<td>".$support1." %<td>".$support2." %<td>".$confidence." %</tr>";
					}
					echo"</tbody>";
				echo"</table>";
			echo"</form>";
		echo"</div>";
	echo"</ol>";
	echo"</div>";

	echo"<div class='col-lg-12'>";
	echo"<ol class='breadcrumb'>";
	echo"<h1>Kombinasi 3 Produk</h1>";
		echo"<div class='table-responsive'>";
			echo"<form method='post'>";
				echo"<table class='table table-striped table-bordered table-hover' id='datatables3'>";
					echo"<thead><tr><th>No.</th><th>Itemset { A U B }</th><th>support { A U B }</th><th>support { A }</th><th>Confidence</th></tr></thead>";
					echo"<tbody>";
					$no=0;
					$sql_menu = mysqli_query($con, "SELECT * FROM tb_assosiasi where level='L3' order by confidence desc") or die (Mysqli_error($con));
					while($d= mysqli_fetch_array($sql_menu)) { 
						$no++;
						$item=$d["item"];
						$support1=$d["support1"];
						$support2=$d["support2"];
						$confidence=$d["confidence"];
						echo"<tr><td>$no</td><td>".$item."<td>".$support1." %<td>".$support2." %<td>".$confidence." %</tr>";
					}
					echo"</tbody>";
				echo"</table>";
			echo"</form>";
		echo"</div>";
	echo"</ol>";
	echo"</div>";

	echo"<div class='col-lg-12'>";
	echo"<ol class='breadcrumb'>";
	echo"<h1>Kombinasi 4 Produk</h1>";
		echo"<div class='table-responsive'>";
			echo"<form method='post'>";
				echo"<table class='table table-striped table-bordered table-hover' id='datatables4'>";
					echo"<thead><tr><th>No.</th><th>Itemset { A U B }</th><th>support { A U B }</th><th>support { A }</th><th>Confidence</th></tr></thead>";
					echo"<tbody>";
					$no=0;
					$sql_menu = mysqli_query($con, "SELECT * FROM tb_assosiasi where level='L4' order by confidence desc") or die (Mysqli_error($con));
					while($d= mysqli_fetch_array($sql_menu)) { 
						$no++;
						$item=$d["item"];
						$support1=$d["support1"];
						$support2=$d["support2"];
						$confidence=$d["confidence"];
						echo"<tr><td>$no</td><td>".$item."<td>".$support1." %<td>".$support2." %<td>".$confidence." %</tr>";
					}
					echo"</tbody>";
				echo"</table>";
			echo"</form>";
		echo"</div>";
	echo"</ol>";
	echo"</div>";
?>


<br>

<!-- Modal Popup untuk info--> 
<div id="MODAL" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


<script type="text/javascript">
$(document).ready(function() {
	$(".modal_ket").click(function(e) {
	  	var m = $(this).attr("id");
		$.ajax({
	         url: "keterangan.php",
	         type: "GET",
	         success: function (ajaxData){
	           $("#MODAL").html(ajaxData);
	           $("#MODAL").modal('show',{backdrop: 'true'});
	         }
	    });
	});
});
$(document).ready(function(){
  $('#datatables2').DataTable({
  	scrollY : '370px',
	columnDefs: [
    	{
    		"searchable": false,
    		"orderable": false
    	}
    	],
    	"order": [0, "asc"]
		});
});
$(document).ready(function(){
  $('#datatables3').DataTable({
  	scrollY : '370px',
	columnDefs: [
    	{
    		"searchable": false,
    		"orderable": false
    	}
    	],
    	"order": [0, "asc"]
		});
});
$(document).ready(function(){
  $('#datatables4').DataTable({
  	scrollY : '370px',
	columnDefs: [
    	{
    		"searchable": false,
    		"orderable": false
    	}
    	],
    	"order": [0, "asc"]
		});
});
</script>

<?php include_once('../_footer.php');?>