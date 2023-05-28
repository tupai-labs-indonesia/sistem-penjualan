<?php
require_once "../../_config/config.php";
$query=mysqli_query($con, "DELETE FROM tb_posisi WHERE kd_posisi = '$_GET[id]'");
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