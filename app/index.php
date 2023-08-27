<?php 
ini_set('display_errors',0);
error_reporting(E_ERROR|E_WARNING|E_PARSE);
include "../inc/config.php";
include "../inc/function.php";

if(empty($_SESSION["id_user"])){
		echo "<script>document.location.href='../';</script>";
}else{

 @$id_user    = $_SESSION['id_user']; 
 $level       = $_SESSION['nama_level']; 
 $email_user  = $_SESSION['email'];
 include "../inc/sidebar-admin.php";
 include "../inc/header-admin.php";
   
if(empty($_GET['pg'])) { 
    include ('beranda/beranda.php');
  } else {
        $mod=$_GET['mod'];
        $pg = $_GET['pg'];
        include  $mod."/". $pg . ".php";
  } 
	include "../inc/footer-admin.php";
}

?>


       