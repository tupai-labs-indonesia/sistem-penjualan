<?php 
include_once('../../_config/config.php');
$nonota = $_GET['nonota'];
$query_mysql = mysqli_query($con, "SELECT b.kd_menu, c.menu, e.jenis, d.kategori, b.harga, b.jumlah, b.subtotal FROM penjualan a, detailpenjualan b, tb_menu c, tb_kategori d, tb_jenis e WHERE a.nonota = b.nonota AND b.kd_menu = c.kd_menu AND c.kd_kategori = d.kd_kategori AND d.kd_jenis = e.kd_jenis AND a.nonota='$nonota'") or die (mysqli_error($con));
$total= mysqli_fetch_array (mysqli_query($con, "SELECT * FROM penjualan WHERE nonota = '$nonota'"));
$tgl = $total['tanggal'];
$tanggal = date('d F Y', strtotime($tgl));
?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">DETAIL NOTA PENJUALAN</h4>
        </div>
        <div class="modal-body">
        	<form action="#" method="POST" target="_blank">
                <div class="container-fluid">
                    <div class="row" style="padding-left: 15px;">
                        <div class="col-md-4"><label><p style="font-size: 17px;"> Nomor Nota </p></label></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <ol class="breadcrumb">
                                <li class="active" style="font-size: 17px;">
                                    <strong><?php echo $total['nonota'];?></strong>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <ol class="breadcrumb">
                                <li class="active" style="font-size: 17px;">
                                    <strong><?php echo $tanggal;?></strong>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>Kode Menu</td>
                                    <td>Nama</td>
                                    <td>Jenis</td>
                                    <td>Kategori</td>
                                    <td>Harga</td>
                                    <td>Jumlah</td>
                                    <td>Subtotal</td>
                                </tr>
                            </thead>
                            <?php while($r = mysqli_fetch_array($query_mysql)) { ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $r['kd_menu'];?></td>
                                    <td><?php echo $r['menu'];?></td>
                                    <td><?php echo $r['jenis'];?></td>
                                    <td><?php echo $r['kategori'];?></td>
                                    <td>Rp. <?php echo number_format($r['harga'], 2, ",", ".");?></td>
                                    <td><?php echo $r['jumlah'];?></td>
                                    <td>Rp. <?php echo number_format($r['subtotal'], 2, ",", ".");?></td>
                                </tr> <?php } ?>
                                <tr>
                                    <td colspan='4'><h4 align='right'>Total</h4></td>
                                    <td colspan='5'><h4>Rp. <?php echo number_format($total['total'], 2, ",", ".");?></h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                       <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                </div>
            </form>
        </div>        
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        });
    });
</script>