<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">CETAK LAPORAN TRANSAKSI PENJUALAN</h4>
        </div>
        <div class="modal-body">
        	<form action="cetak/cetaklaporan.php" name="modal_popup" method="POST" target="_blank">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Cetak Semua Laporan
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="cetak_semua">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak Semua
                    </button>
	            </div>
            </form>
        </div>
        <div class="modal-body">
        	<form action="cetak/cetaklaporanperiode.php" name="modal_popup" method="POST" target="_blank">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Cetak Per-periode Laporan</b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="tanggal1">Dari Tanggal</label>
                    <div class="input-group date tanggal" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="tanggal1" class="form-control">
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="tanggal1">Sampai Tanggal</label>
                    <div class="input-group date tanggal" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="tanggal2" class="form-control">
                    </div>
                </div>
	            <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak Per-periode
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