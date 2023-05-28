<?php
require_once "../../_config/config.php";

if (!isset($_SESSION['username'])) {
  echo "<script>window.location='" . base_url('_auth/login.php') . "';</script>";
} else if ($_SESSION['hak_akses'] != "manajer") {
  echo "<script>window.location='" . base_url() . "';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aplikasi - APOTEK</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('_assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('_assets/libs/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('_assets/libs/alert/css/sweetalert.css') ?>" rel="stylesheet">
    <link href="<?= base_url('_assets/libs/datepicker/css/bootstrap-datepicker.css') ?>" rel="stylesheet">
    <link href="<?= base_url('_assets/libs/DataTables/datatables.min.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('_assets/apotek.jpg') ?>">
    <script src="<?= base_url('_assets/js/jquery.js') ?>"></script>
    <script src="<?= base_url('_assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('_assets/libs/alert/js/sweetalert.min.js') ?>"></script>
    <script src="<?= base_url('_assets/libs/alert/js/qunit-1.18.0.js') ?>"></script>
    <script src="<?= base_url('_assets/libs/datepicker/js/bootstrap-datepicker.js') ?>"></script>
    <script src="<?= base_url('_assets/libs/DataTables/datatables.min.js') ?>"></script>
    <script type="text/javascript" src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/select2/select2/master/dist/css/select2.min.css">

</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('manajer/tambah_transaksi_penjualan/index.php') ?>"
                    style="color: #5BC0DE;"><strong><em>APOTEK MITRA SEHAT</em></strong></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="<?= base_url('manajer/tambah_transaksi_penjualan/data.php') ?>""><i class=" fa fa-fw
                            fa-shopping-cart"></i>&nbsp; Transaksi Penjualan <span class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="<?= base_url('manajer/analisis_asosiasi/data.php') ?>""><span class=" glyphicon
                            glyphicon-stats" aria-hidden="true"></span>&nbsp; Analisis Asosiasi <span
                                class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-fw fa-table"></i> Master Data <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('manajer/menu/data.php') ?>"><i class="fa fa-fw fa-book"></i> Data
                                    Menu</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= base_url('manajer/transaksi_penjualan/data.php') ?>"><i
                                        class="fa fa-fw fa-shopping-cart"></i> Data Transaksi Penjualan</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= base_url('manajer/data_pegawai/data.php') ?>"><i
                                        class="fa fa-fw fa-group"></i> Data Pegawai</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-fw fa-gear"></i> Lainnya <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('manajer/jenis_kategori/data.php') ?>"><i
                                        class="fa fa-fw fa-edit"></i> Jenis dan Kategori Menu</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= base_url('manajer/posisi_pegawai/data.php') ?>"><i
                                        class="fa fa-fw fa-edit"></i> Posisi Pegawai</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?= base_url('manajer/data_akun/data.php') ?>"><i class="fa fa-fw fa-user"></i>
                                    Data Akun</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #5BC0DE;"><i
                                class="fa fa-user"></i> &nbsp;<?= $_SESSION['username']; ?> as
                            <?= $_SESSION['hak_akses']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" id="<?= $_SESSION['username']; ?>" data-target="#ModalPass"
                                    data-toggle="modal"><i class="fa fa-fw fa-key"></i> Ubah Password</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= base_url('_auth/logout.php') ?>"><i class="fa fa-fw fa-power-off"></i>
                                    Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container-fluid">