<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPK SAW - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6"><br>
                                <center>
                                    <img src="<?= base_url(); ?>img/logoumb.png" width="50" height="50">
                                    <h2>Sistem Pendukung Keputusan dengan Metode SAW</h2>
                                    <hr>
                                    <h4>Dibuat oleh : Harry Witriyono, M.Kom</h4>
                                    <hr>
                                    <h5>Program Studi Teknik Informatika</h5>
                                    <h4>Universitas Muhammadiyah Bengkulu</h4>
                                    2020
                                </center>
                            </div>
                            <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang !</h1>
                                    </div>
                                    <?php if (!empty($pesannya)) { ?>
                                        <div class="text-center">
                                            <h2 class="h4 text-gray-900 mb-4"><?php echo $pesannya; ?></h2>
                                        </div> <?php }; ?>
                                    <form class="user" method="post" action="<?= base_url(); ?>pengguna/cekpengguna">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="idpengguna" aria-describedby="emailHelp" placeholder="Ketik id pengguna anda ..." name="idpengguna">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Ketik Password anda" name="password">
                                        </div>
                                        <input type="submit" name="bLogin" value="Login" class="btn btn-primary btn-user btn-block">
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>js/sb-admin-2.min.js"></script>

</body>

</html>