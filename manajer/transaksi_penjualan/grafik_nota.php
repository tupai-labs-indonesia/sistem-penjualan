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
                        	<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Data Transaksi Penjualan > Grafik Penjualan Nota
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-12">
						<div id="container">
							
						</div>
					</div>
				</div>

				<?php
				$tahun= "2022";
				$awal="1";
				$akhir="31";
				$gab1="[";
				$gab2="[";

				for($i=1;$i<=12;$i++) {
					$per1=$tahun."-".$i."-".$awal;
					$per2=$tahun."-".$i."-".$akhir;
						$sql_nota = mysqli_query($con, "SELECT count(nonota) as jum FROM penjualan where tanggal between '$per1' and '$per2'") or die (mysqli_error($con));
						$d = mysqli_fetch_array($sql_nota);

						$jum=intval($d["jum"]+0);

						if($i==1) { $per="Januari $tahun"; }
						else if($i==2) { $per="Februari $tahun"; }
						else if($i==3) { $per="Maret $tahun"; }
						else if($i==4) { $per="April $tahun"; }
						else if($i==5) { $per="Mei $tahun"; }
						else if($i==6) { $per="juni $tahun"; }
						else if($i==7) { $per="Juli $tahun"; }
						else if($i==8) { $per="Agustus $tahun"; }
						else if($i==9) { $per="September $tahun"; }
						else if($i==10) { $per="Oktober $tahun"; }
						else if($i==11) { $per="November $tahun"; }
						else if($i==12) { $per="Desember $tahun"; }

						$gab1.="$jum,";
						$gab2.="'$per',";
				}
						$gab1.="]";
						$gab2.="]";

						$gab1=str_replace(",]","]",$gab1);
						$gab2=str_replace(",]","]",$gab2);

				?>




				<script src="<?=base_url('_assets/libs/highcharts/highcharts.js')?>"></script>
				<script src="<?=base_url('_assets/libs/highcharts/exporting.js')?>"></script>

				<script>

				Highcharts.chart('container', {
				    chart: {
				        type: 'area'
				    },
				    title: {
				        text: 'Grafik Penjualan Nota Per-bulan'
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
				            text: 'Jumlah Nota'
				        },
				        labels: {
				            formatter: function () {
				                return this.value / 1000;
				            }
				        }
				    },
				    tooltip: {
				        split: true,
				        valueSuffix: ' Nota'
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
				        data: <?php echo $gab1; ?>
				    }]
				});
</script>

				





<?php include_once('../_footer.php');?>