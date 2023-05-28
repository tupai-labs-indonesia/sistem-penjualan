<?php include_once('../_header.php'); ?>

<div class="row" style="padding-top: 30px;">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="row">
                <div class="col-md-4">
                    <strong>TRANSAKSI PENJUALAN</strong>
                </div>
                <?php include_once('../jam&tanggal.php'); ?>
            </div>
        </h1>
        <div class="alert alert-success" role="alert" style="font-size: 18px; font-family: cursive;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-info-circle"></i> Hello <strong><?= $_SESSION['username']; ?></strong>, anda berhasil masuk kedalam sistem sebagai <strong><?= $_SESSION['hak_akses']; ?></strong>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div style="margin-bottom: 20px;">
            <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="<?= base_url('manajer/tambah_transaksi_penjualan/add.php') ?>" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
        </div>
        <div class="table-responsive">
            <form method="post" name="proses">
                <table class="table table-striped table-bordered table-hover" id="datatables">
                    <thead>
                        <tr>
                            <th>Nota</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>
                                <center>Opsi</center>
                            </th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
</div>

<div id="Modalnota" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
</div>

<div id="ModalLaporan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".modal_laporan").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "laporan.php",
                type: "GET",
                success: function(ajaxData) {
                    $("#ModalLaporan").html(ajaxData);
                    $("#ModalLaporan").modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "transaksi-serverside.php",
            columnDefs: [{
                "searchable": false,
                "orderable": false,
                "targets": [3],
                "render": function(data, type, row) {
                    var btn = "<center><a href=\"#\" class=\"edit_data btn btn-success btn-xs\" id=\"" + data + "\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> <strong>Edit</strong></a> <a href=\"#\" class=\"delete_data btn btn-danger btn-xs\" id=\"" + data + "\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> <strong>Delete</strong></a> <a href=\"#\" class=\"modal_view btn btn-info btn-xs\" id=\"" + data + "\"><span class=\"glyphicon glyphicon-open-file\" aria-hidden=\"true\"></span> <strong>Cek Nota</strong></a></center>";
                    return btn;
                }
            }],
            "order": [0, "desc"],
            "initComplete": function(settings, json) {

                $('#datatables').click(function(e) {
                    let buttonElement = null;

                    if (e.target.tagName == 'STRONG' || e.target.tagName == 'SPAN') {
                        buttonElement = e.target.parentElement;
                    } else {
                        buttonElement = e.target;
                    }

                    if (buttonElement) {
                        if (buttonElement.classList.contains('modal_view')) {
                            var m = buttonElement.getAttribute("id");
                            $.ajax({
                                url: "ceknota.php",
                                type: "GET",
                                data: {
                                    nonota: m,
                                },
                                success: function(ajaxData) {
                                    $("#Modalnota").html(ajaxData);
                                    $("#Modalnota").modal('show', {
                                        backdrop: 'true'
                                    });
                                }
                            });
                        } else if (buttonElement.classList.contains('delete_data')) {
                            var m = buttonElement.getAttribute("id");
                            $.ajax({
                                url: "delete.php",
                                type: "GET",
                                data: {
                                    nonota: m,
                                },
                                success: function(ajaxData) {
                                    window.location.reload();
                                }
                            });
                        } else if (buttonElement.classList.contains('edit_data')) {
                            var m = buttonElement.getAttribute("id");
                            $.ajax({
                                url: "edit.php",
                                type: "GET",
                                data: {
                                    nonota: m,
                                },
                                success: function(ajaxData) {
                                    window.location = '/penjualan-apriori-ord/manajer/tambah_transaksi_penjualan/edit.php?nonota=' + m;
                                }
                            });
                        }
                    }
                })
            }
        });
    });
</script>

<?php include_once('../_footer.php'); ?>