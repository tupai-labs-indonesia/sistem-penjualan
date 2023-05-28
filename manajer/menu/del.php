<?php
require_once "../../_config/config.php";
$sql = mysqli_query($con, "SELECT kd_menu, menu, harga, kd_kategori FROM tb_menu WHERE kd_menu = '$_GET[id]'") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);
$query=mysqli_query($con, "DELETE FROM tb_menu WHERE kd_menu = '$_GET[id]'");
if($query)
{
    echo "<script>alert('Data yang anda pilih berhasil dihapus!');
 	window.location='data.php';</script>"; 
}
else
{
    echo "<script>alert('Data yang anda pilih gagal dihapus. dikarenakan data tersebut, data induk yang memiliki relasi dengan tabel lainnya.');
 	window.location='data.php';</script>";
}
?>