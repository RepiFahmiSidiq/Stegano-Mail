<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Oct 2015 06:31:20 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="../assets/back-end/img/favicon.ico">

    <title>Aplikasi pengiriman pesan Email dalam gambar menggunakan kombinasi Algoritma Advanced Encryption standar dan LSB.</title>

    <!-- Google-Fonts -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>-->

    <!-- Bootstrap core CSS -->
    <link href="../assets/back-end/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/back-end/css/bootstrap-reset.css" rel="stylesheet">

    <!--Animation css-->
    <link href="../assets/back-end/css/animate.css" rel="stylesheet">

    <!--Icon-fonts css-->
    <link href="../assets/back-end/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/back-end/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />

    <link href="../assets/back-end/assets/nestable/jquery.nestable.css" rel="stylesheet" />

    <link href="../assets/back-end/assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="../assets/back-end/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="../assets/back-end/assets/jquery-multi-select/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="../assets/back-end/assets/select2/select2.css" />
    <!--Data tables css-->
    <link href="../assets/back-end/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> 

    
    <link href="../assets/back-end/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" />
    <link href="../assets/back-end/assets/summernote/summernote.css" rel="stylesheet" />

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../assets/back-end/assets/morris/morris.css">

    <!-- sweet alerts -->
    <link href="../assets/back-end/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/back-end/css/style.css" rel="stylesheet">
    <link href="../assets/back-end/css/helper.css" rel="stylesheet">
    <link href="../assets/back-end/css/style-responsive.css" rel="stylesheet" />
     
</head>


<body>
  <!-- Aside Start-->
  <aside class="left-panel">

      <!-- brand -->
       <div class="logo">
          <a href="index-2.html" class="logo-expanded">
              <img src="../assets/back-end/img/logo.png" width="120px" height="100px" alt="logo">
          </a>
      </div>
      <!-- / brand -->
      <?php


        @$mod = $_GET['mod'];                  
        @$pg  = $_GET['pg'];                  
        if ($mod == 'user') {
            $user = 'active'; 
        } else if ($mod == 'encrypt' || $mod == 'file'|| $mod == 'rincian') {
            $encrypt = 'active';
            if ($mod=='encrypt' || $mod=='rincian'){
                $sub_encrypt = 'active';
            }   
        } else if ($mod == 'decrypt') {
            $decrypt = 'active';
            if ($mod=='encrypt'){
                $sub_decrypt = 'active';
            }   
        } else if ($mod == 'email') {
            $email = 'active';
            if ($pg=='form_input_email'){
                $form_input_email = 'active';
            } else if ($pg=='data_email_masuk'){
                $data_email_masuk = 'active';
            } else if ($pg=='data_email_keluar'){
                $data_email_keluar = 'active';
            }   
        } else {
            $dashboard = 'active';
        }
      ?>
      <!-- Navbar Start -->
      <nav class="navigation">
          <ul class="list-unstyled"> 
              <li class="has-submenu <?php echo $dashboard?>"><a href="./"><i class="ion-home">    </i> <span class="nav-label">DASHBOARD</span></a>
              </li>  
              <li class="has-submenu <?php echo $user?>"><a href="?mod=user&pg=data_user"><i class="ion-person">    </i> <span class="nav-label">USER</span></a>
              </li>

              <li class="has-submenu <?php echo $encrypt?>"><a href="?mod=encrypt&pg=data_encrypt"><i class="ion-locked">    </i> <span class="nav-label">ENCRYPT</span></a>
              </li>  
              <li class="has-submenu <?php echo $decrypt?>"><a href="?mod=decrypt&pg=data_decrypt"><i class="ion-unlocked">    </i> <span class="nav-label">DECRYPT</span></a>
              </li>  

              <li class="has-submenu <?php echo $email?>"><a href="#"><i class="ion-android-mail"></i> <span class="nav-label">EMAIL</span></a>
                        <ul class="list-unstyled">
                            <li class="<?php echo $form_input_email?>"><a href="?mod=email&pg=form_input_email">Tulis Email</a></li>
                            <?php
                              $query1 = $mysqli->query("SELECT COUNT(status) as jum FROM tbl_email
                                        WHERE email='$email_user'
                                        AND status=1");
                              $data1  = $query1->fetch_assoc();
                              $jum    = $data1['jum'];
                            ?>
                            <li class="<?php echo $data_email_masuk?>"><a href="?mod=email&pg=data_email_masuk">Kotak Masuk <span class="badge badge-sm up bg-pink count"><?php echo $jum?></span></a></li>
                            <li class="<?php echo $data_email_keluar?>"><a href="?mod=email&pg=data_email_keluar">Kotak Keluar</a></li> 
                        </ul>
              </li> 
 
          </ul>
      </nav>   
  </aside>
  <!-- Aside Ends-->