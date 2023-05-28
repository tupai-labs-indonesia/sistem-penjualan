<?php
require_once "../_config/config.php";

unset($_SESSION['username']);
echo "<script>window.location='".base_url('_auth/login.php')."';</script>";
?>