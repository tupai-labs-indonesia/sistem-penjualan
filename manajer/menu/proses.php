<?php
require_once "../../_config/config.php";

if (isset($_POST['add']))
{
	$kd_menu = trim(mysqli_real_escape_string($con, $_POST['kd_menu']));
	$menu = trim(mysqli_real_escape_string($con, $_POST['menu']));
	$sejakk = $_POST['sejak'];
	$sejak = date('Y-m-d', strtotime($sejakk));
	$harga = trim(mysqli_real_escape_string($con, $_POST['harga']));
	$kd_kategori = trim(mysqli_real_escape_string($con, $_POST['kd_kategori']));

		mysqli_query($con, "INSERT INTO tb_menu (kd_menu, menu, harga, sejak, kd_kategori) VALUES ('$kd_menu', '$menu', '$harga', '$sejak', '$kd_kategori')") or die (mysqli_error($con));
		echo "<script>alert('Data berhasil diinput'); window.location='data.php';</script>";

}

else if (isset($_POST['edit']))

{
	$kd_menu = $_POST['kd_menu'];
	$menu = trim(mysqli_real_escape_string($con, $_POST['menu']));
	$sejakk = $_POST['sejak'];
	$sejak = date('Y-m-d', strtotime($sejakk));
	$harga = trim(mysqli_real_escape_string($con, $_POST['harga']));
	$kd_kategori = trim(mysqli_real_escape_string($con, $_POST['kd_kategori']));

		mysqli_query($con, "UPDATE tb_menu SET menu = '$menu', harga = '$harga', sejak = '$sejak', kd_kategori = '$kd_kategori' WHERE kd_menu = '$kd_menu'") or die (mysqli_error($con));
		echo "<script>alert('Data berhasil di ubah'); window.location='data.php';</script>";
}

?>