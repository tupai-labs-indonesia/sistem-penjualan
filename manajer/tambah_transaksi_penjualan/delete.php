<?php
include_once('../../_config/config.php');
$nonota = $_GET['nonota'];



$sql = "DELETE FROM penjualan WHERE nonota='$nonota'";
$sqlDetail = "DELETE FROM detailpenjualan WHERE nonota='$nonota'";
$del = mysqli_query($con, $sql);
$delDetail = mysqli_query($con, $sqlDetail);
return "success";
