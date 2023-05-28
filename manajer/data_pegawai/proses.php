<?php
require_once "../../_config/config.php";

if (isset($_POST['add']))
{
	$kd_pegawai = trim(mysqli_real_escape_string($con, $_POST['kd_pegawai']));
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$tgl_lahirr = $_POST['tgl_lahir'];
	$tgl_lahir = date('Y-m-d', strtotime($tgl_lahirr));
	$gender = trim(mysqli_real_escape_string($con, $_POST['gender']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
	$email = trim(mysqli_real_escape_string($con, $_POST['email']));
	$kd_posisi = trim(mysqli_real_escape_string($con, $_POST['kd_posisi']));
	mysqli_query($con, "INSERT INTO tb_pegawai (kd_pegawai, nama, tgl_lahir, gender, alamat, telp, email, kd_posisi) VALUES ('$kd_pegawai', '$nama', '$tgl_lahir', '$gender', '$alamat', '$telp', '$email', '$kd_posisi')") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
else if (isset($_POST['edit']))
{
	$kd_pegawai = $_POST['kd_pegawai'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$tgl_lahirr = $_POST['tgl_lahir'];
	$tgl_lahir = date('Y-m-d', strtotime($tgl_lahirr));
	$gender = trim(mysqli_real_escape_string($con, $_POST['gender']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
	$email = trim(mysqli_real_escape_string($con, $_POST['email']));
	$kd_posisi = trim(mysqli_real_escape_string($con, $_POST['kd_posisi']));
	mysqli_query($con, "UPDATE tb_pegawai SET kd_pegawai = '$kd_pegawai', nama = '$nama', tgl_lahir = '$tgl_lahir', gender = '$gender', alamat = '$alamat', telp = '$telp', email = '$email', kd_posisi = '$kd_posisi' WHERE kd_pegawai = '$kd_pegawai'") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
?>