<?php
require_once "../../_config/config.php";

if (isset($_POST['add1']))
{
	$kd_jenis = trim(mysqli_real_escape_string($con, $_POST['kd_jenis']));
	$jenis = trim(mysqli_real_escape_string($con, $_POST['jenis']));
	mysqli_query($con, "INSERT INTO tb_jenis (kd_jenis, jenis) VALUES ('$kd_jenis', '$jenis')") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
else if (isset($_POST['add2']))
{
	$kd_kategori = trim(mysqli_real_escape_string($con, $_POST['kd_kategori']));
	$kategori = trim(mysqli_real_escape_string($con, $_POST['kategori']));
	$kd_jenis = trim(mysqli_real_escape_string($con, $_POST['kd_jenis']));
	mysqli_query($con, "INSERT INTO tb_kategori (kd_kategori, kategori, kd_jenis) VALUES ('$kd_kategori', '$kategori', '$kd_jenis')") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
else if (isset($_POST['edit1']))
{
	$kd_jenis = $_POST['kd_jenis'];
	$jenis = trim(mysqli_real_escape_string($con, $_POST['jenis']));
	mysqli_query($con, "UPDATE tb_jenis SET kd_jenis = '$kd_jenis', jenis = '$jenis' WHERE kd_jenis = '$kd_jenis'") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
else if (isset($_POST['edit2']))
{
	$kd_kategori = $_POST['kd_kategori'];
	$kategori = trim(mysqli_real_escape_string($con, $_POST['kategori']));
	$kd_jenis = trim(mysqli_real_escape_string($con, $_POST['kd_jenis']));
	mysqli_query($con, "UPDATE tb_kategori SET kd_kategori = '$kd_kategori', kategori = '$kategori', kd_jenis = '$kd_jenis' WHERE kd_kategori = '$kd_kategori'") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
?>