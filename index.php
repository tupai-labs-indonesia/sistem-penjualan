<?php
require_once "_config/config.php"; error_reporting(0);
if ($_SESSION['hak_akses']=="manajer")
{
	echo "<script>window.location='".base_url('manajer/tambah_transaksi_penjualan')."';</script>";
}
else
{
	echo "<script>window.location='".base_url('_auth/login.php')."';</script>";
}
?>