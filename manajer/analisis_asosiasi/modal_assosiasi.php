<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Aturan Assosiasi</h4>
        </div>
        <div class="modal-body">
        	<form action="aturan_assosiasi.php" name="modal_popup" method="POST" target="_BLANK">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb alert-info">
                            <li class="active" style="font-size: 16px;"">
                                <i class="fa fa-info-circle"></i> Minimum Confidence adalah nilai yang sekurang-kurangnya harus ada pada item yang dibeli secara bersamaan. (berbentuk persen)</b>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div class="form-group" style="padding-bottom: 20px;">
                	<label for="nama">Minimum Confidence</label>
                    <input type="number" required name="minconf" class="form-control" placeholder="berbentuk persen" value="30" autofocus>
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