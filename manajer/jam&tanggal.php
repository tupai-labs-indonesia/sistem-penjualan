<script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
    var waktu = new Date();            //membuat object date berdasarkan waktu saat 
    var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
    var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
    var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss) + " WIB" ;
    }
</script>

<div class="col-md-4 col-md-offset-4">
    <p class="text-right" style="color: #31708F; font-size: 18px; padding-top: 10px;"><b>
    <span class="glyphicon glyphicon-time" aria-hidden="true" style="padding-right: 15px; color: blue;"></span>
    <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
        <font style="padding-right: 15px;"><span id="clock"></span></font> 
    </body>
        <span class="glyphicon glyphicon-calendar" aria-hidden="true" style="color: blue;"></span>
        <font style="padding-left: 15px;">
        <?php
        $hari = date('l');
        /*$new = date('l, F d, Y', strtotime($Today));*/
        if ($hari=="Sunday") {
         echo "Minggu";
        }elseif ($hari=="Monday") {
         echo "Senin";
        }elseif ($hari=="Tuesday") {
         echo "Selasa";
        }elseif ($hari=="Wednesday") {
         echo "Rabu";
        }elseif ($hari=="Thursday") {
         echo("Kamis");
        }elseif ($hari=="Friday") {
         echo "Jum'at";
        }elseif ($hari=="Saturday") {
         echo "Sabtu";
        }
        ?>,
            <?php
            $tgl =date('d');
            echo $tgl;
            $bulan =date('F');
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
            $tahun=date('Y');
            echo $tahun;
            ?>    
        </font>
    </b></p>
</div>