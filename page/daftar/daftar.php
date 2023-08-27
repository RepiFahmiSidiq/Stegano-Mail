<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/velonic/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Oct 2015 06:33:25 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="../../assets/back-end/img/favicon.ico">

        <title>Aplikasi pengiriman pesan Email dalam gambar menggunakan kombinasi Algoritma Advanced Encryption standar 128 bit dan LSB.</title>

        <!-- Google-Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>


        <!-- Bootstrap core CSS -->
        <link href="../../assets/back-end/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/back-end/css/bootstrap-reset.css" rel="stylesheet">

        <!--Animation css-->
        <link href="../../assets/back-end/css/animate.css" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="../../assets/back-end/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="../../assets/back-end/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../../assets/morris/morris.css">


        <!-- Custom styles for this template -->
        <link href="../../assets/back-end/css/style.css" rel="stylesheet">
        <link href="../../assets/back-end/css/helper.css" rel="stylesheet">
        <link href="../../assets/back-end/css/style-responsive.css" rel="stylesheet" />

<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-62751496-1', 'auto');
          ga('send', 'pageview');

        </script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>


    <body style="background: linear-gradient(#000046, #1cb5e0);">

        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">
            <span class="block-title-2"> 
            
            </span>
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"><strong>Daftar Akun</strong> <p>&nbsp;</p><img src="../../assets/back-end/img/logo.png" width="150px" height="150px"> </h3>
                </div> 
                <?php
                    error_reporting(0);
                    $nama      = $_GET['nama'];
                    $no_hp     = $_GET['no_hp']; 
                    $email     = $_GET['email'];
                ?>
                
                <form class="form-horizontal m-t-40" action="simpan_daftar.php" method="POST">
                    <span class="block-title-2"> 
                    <?php   
                        $act = @$_GET['act'];
                        if ($act=='es'){ 
                        ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Email sudah terdaftar
                      </div>
                      <div id="MessageNotSent">
                        &nbsp;
                      </div>
                    <?php } elseif ($act=='ps'){ 
                        ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Password tidak sesuai
                      </div>
                      <div id="MessageNotSent">
                        &nbsp;
                      </div>
                    <?php } elseif ($act=='db'){ 
                        ?>
                      <div class="alert alert-success" id="MessageNotSent">
                        Berhasil mendaftar silahkan <a href="../../"><u>login</u> </a>
                      </div>
                      <div id="MessageNotSent">
                        &nbsp;
                      </div>
                    <?php } ?>
                    </span>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Nama" name="nama" required="" value="<?php echo $nama?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="No HP" name="no_hp" required="" value="<?php echo $no_hp?>">
                        </div>
                    </div>  
                    <div class="form-group "> 
                        <div class="col-xs-12">
                            <input class="form-control" type="email" placeholder="Email" name="email" required="" value="<?php echo $email?>">
                        </div> 
                    </div>
                    <div class="form-group "> 
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password" required="" >
                        </div> 
                    </div> 
                    <div class="form-group "> 
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Konfirmasi Password" name="password1" required="" >
                        </div> 
                    </div> 
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-purple w-md" type="submit">Daftar</button>
 
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="col-sm-7">
                             
                        </div>
                        <div class="col-sm-5 text-right">
                            <a href="../../index.php">Login</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../../assets/back-end/js/jquery.js"></script>
        <script src="../../assets/back-end/js/bootstrap.min.js"></script>
        <script src="../../assets/back-end/js/pace.min.js"></script>
        <script src="../../assets/back-end/js/wow.min.js"></script>
        <script src="../../assets/back-end/js/jquery.nicescroll.js" type="text/javascript"></script>
            

        <!--common script for all pages-->
        <script src="../../assets/back-end/js/jquery.app.js"></script>

    
    </body>

<!-- Mirrored from coderthemes.com/velonic/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Oct 2015 06:33:25 GMT -->
</html>
