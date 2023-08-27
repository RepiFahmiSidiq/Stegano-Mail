<?php 
  
  include "../../inc/config.php";
 
  $id_level       = 7;
  $nama           = $_POST['nama'];
  $no_hp          = $_POST['no_hp'];
  $email          = $_POST['email'];
  $password       = md5($_POST['password']);
  $password1      = md5($_POST['password1']);

  $result1        = $mysqli->query("SELECT email FROM tbl_user WHERE email='$email'");
  $data1          = $result1->num_rows;
 
  if ($data1>0){
    //kode email sudah terdaftar
    echo "<script>document.location.href='../daftar/daftar.php?nama=$nama&no_hp=$no_hp&email=$email&act=es'</script>";
  } else if ($password!=$password1){
    // nama user sudah terdaftar
    echo "<script>document.location.href='../daftar/daftar.php?nama=$nama&no_hp=$no_hp&email=$email&act=ps'</script>";
  } else {
    $result   = $mysqli->query("INSERT INTO tbl_user VALUES(null,$id_level,'$nama','$no_telp','$email',
                '$password')");
    if ($result){
      echo "<script>document.location.href='../daftar/daftar.php?act=db'</script>";
    } else {
      echo "<script>document.location.href='../daftar/daftar.php?nama=$nama&no_hp=$no_hp&email=$email&act=dg'</script>";
    }
  }
  
  mysql_close();

 ?>