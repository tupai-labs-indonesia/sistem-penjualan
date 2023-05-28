<?php
require_once "../_config/config.php";
if (isset($_SESSION['username'])) {
    echo "<script>window.location='" . base_url() . "';</script>";
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masuk - Apotek Mitra Sehat</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?= base_url('_auth/assets/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('_auth/assets/font-awesome/css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('_auth/assets/css/form-elements.css') ?>">
        <link rel="stylesheet" href="<?= base_url('_auth/assets/css/style.css') ?>">
        <link rel="icon" href="<?= base_url('_assets/apotek.jpg') ?>">
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1 style="color: #5BC0DE;"><strong>Apotek Mitra Sehat</strong></h1>
                            <div class="description">
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['login'])) {
                        $username = trim(mysqli_real_escape_string($con, $_POST['username']));
                        $password = md5(trim(mysqli_real_escape_string($con, $_POST['password'])));
                        $sql = mysqli_query($con, "SELECT * FROM tb_akun WHERE username = '$username' AND password = '$password'") or die(mysqli_error($con));
                        if (mysqli_num_rows($sql) > 0) {
                            $qry = mysqli_fetch_array($sql);
                            $_SESSION['username'] = $qry['username'];
                            $_SESSION['kd_pegawai'] = $qry['kd_pegawai'];
                            $_SESSION['kd_akun'] = $qry['kd_akun'];
                            $_SESSION['hak_akses'] = $qry['hak_akses'];

                            if ($qry['hak_akses'] == "manajer") {
                                echo "<script>window.location='" . base_url() . "';</script>";
                            } else if ($qry['hak_akses'] == "admin") {
                                echo "<script>window.location='" . base_url() . "';</script>";
                            }
                        } else {
                    ?>
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <strong>LOGIN GAGAL!</strong> Username / Password salah
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>INFO</h3>
                                    <p>hak akses pada web ini, berupa hak akses sebagai admin</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only">Username</label>
                                        <input type="text" name="username" placeholder="Username..." class="form-username form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control">
                                    </div>
                                    <button type="submit" name="login" class="btn">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="<?= base_url('_auth/assets/js/jquery-1.11.1.min.js') ?>"></script>
        <script src="<?= base_url('_auth/assets/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('_auth/assets/js/jquery.backstretch.min.js') ?>"></script>
        <script src="<?= base_url('_auth/assets/js/scripts.js') ?>"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

    </html>
<?php
}
?>