<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">ANALISA DENGAN ALGORITMA APRIORI</h4>
        </div>
        <div class="modal-body">
        	<form action="kombinasi_apriori.php" name="modal_popup" method="POST" target="_BLANK">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Minimum Support adalah nilai yang sekurang-kurangnya harus ada pada item. (berbentuk persen) </b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="nama">Minimum Support</label>
                    <input type="number" required name="minsup" class="form-control" placeholder="berbentuk persen" autofocus>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="tanggal1">Dari Tanggal</label>
                    <div class="input-group date tanggal" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="tanggal1" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 20px;">
                    <label for="tanggal1">Sampai Tanggal</label>
                    <div class="input-group date tanggal" data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" name="tanggal2" class="form-control" required>
                    </div>
                </div>
	            <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Tutup
                    </button>
                    <button type="submit" name="Proses" class="btn btn-success">
                       <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Proses
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