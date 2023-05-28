<?php
require_once "../../_config/config.php";

if (isset($_POST['add']))
{
	$kd_posisi = trim(mysqli_real_escape_string($con, $_POST['kd_posisi']));
	$posisi = trim(mysqli_real_escape_string($con, $_POST['posisi']));
	mysqli_query($con, "INSERT INTO tb_posisi (kd_posisi, posisi) VALUES ('$kd_posisi', '$posisi')") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
else if (isset($_POST['edit']))
{
	$kd_posisi = $_POST['kd_posisi'];
	$posisi = trim(mysqli_real_escape_string($con, $_POST['posisi']));
	mysqli_query($con, "UPDATE tb_posisi SET posisi = '$posisi' WHERE kd_posisi = '$kd_posisi'") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
?>