<?php
require_once "../../_config/config.php";
if (isset($_POST['add'])) {
	$kd_akun = trim(mysqli_real_escape_string($con, $_POST['kd_akun']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$enkripsi = $_POST['password'];
	$kd_pegawai = trim(mysqli_real_escape_string($con, $_POST['kd_pegawai']));
	$hak_akses = trim(mysqli_real_escape_string($con, $_POST['hak_akses']));

	$cek 			= $con->query("SELECT kd_pegawai FROM tb_akun a WHERE kd_pegawai='$kd_pegawai'");

	if (mysqli_num_rows($cek)) {
		echo "<script>alert('1 pegawai hanya bisa memiliki 1 akun!');
		window.location='data.php';</script>";
	}
	elseif (strlen($enkripsi) >= 5) {
		$password = md5($enkripsi);
		mysqli_query($con, "INSERT INTO tb_akun (kd_akun, username, password, kd_pegawai, hak_akses) VALUES ('$kd_akun', '$username', '$password', '$kd_pegawai', '$hak_akses')") or die (mysqli_error($con));
		echo "<script>alert('akun baru berhasil disimpan.'); window.location='data.php';</script>";
	} else {
		echo "<script>alert('minimal jumlah pasword adalah 5!');
		window.location='data.php';</script>";
		}
	}
?>