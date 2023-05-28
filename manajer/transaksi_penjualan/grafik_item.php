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
                        	<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Data Transaksi Penjualan > Grafik Penjualan Produk
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-12">
						<div id="statistik">
							
						</div>
					</div>
				</div>
            <?php
            $tahun="2022";
            $awal="1";
            $ahir="31";
            $gab1="[";
            $gab2="[";

            for($i=1;$i<=12;$i++) {//for
                $per1=$tahun."-".$i."-".$awal;
                $per2=$tahun."-".$i."-".$ahir;
                    $sql_jenis = mysqli_query($con, "SELECT sum(detailpenjualan.jumlah) as jum FROM penjualan,detailpenjualan where penjualan.tanggal between '$per1' and '$per2' and penjualan.nonota=detailpenjualan.nonota") or die (Mysqli_error($con));
                    $d = mysqli_fetch_array($sql_jenis); 
                    
                    $jum=intval($d["jum"]+0);

                    if($i==1) { $per="Januari $tahun"; }
                    else if($i==2) { $per="Februari $tahun"; }
                    else if($i==3) { $per="Maret $tahun"; }
                    else if($i==4) { $per="April $tahun"; }
                    else if($i==5) { $per="Mei $tahun"; }
                    else if($i==6) { $per="Juni $tahun"; }
                    else if($i==7) { $per="July $tahun"; }
                    else if($i==8) { $per="Agustus $tahun"; }
                    else if($i==9) { $per="September $tahun"; }
                    else if($i==10) { $per="Oktober $tahun"; }
                    else if($i==11) { $per="November $tahun"; }
                    else if($i==12) { $per="Desember $tahun"; }
                    

                       $gab1.="$jum,";
                       $gab2.="'$per',";
                        
                    } //for
                       $gab1.="]";
                       $gab2.="]";
                    
                     $gab1=str_replace(",]","]",$gab1);
                     $gab2=str_replace(",]","]",$gab2);

//echo $gab1."<br>";
//echo $gab2."<br>";

            ?>


<script src="<?=base_url('_assets/libs/highcharts/exporting.js')?>"></script>
<script src="<?=base_url('_assets/libs/highcharts/highcharts.js')?>"></script>
<script type="text/javascript">
Highcharts.chart('statistik', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Grafik Penjualan Produk per-bulan'
    },
    subtitle: {
        text: 'Source: APOTEK MITRA SEHAT'
    },
    xAxis: {
        categories: <?php echo $gab2;?>,
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Jumlah Produk'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ' Produk'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [{
        name: 'Penjualan',
        data: <?php echo $gab1;?>
    }]
});
</script>

<?php include_once('../_footer.php');?>