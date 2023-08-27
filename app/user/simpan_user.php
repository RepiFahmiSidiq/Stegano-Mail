<?php 
  
  include "../../inc/config.php";
  
  $id_level       = $_POST['id_level'];
  $nama           = $_POST['nama'];
  $no_hp          = $_POST['no_hp'];
  $email          = $_POST['email'];
  $password       = md5($_POST['password']);
  $password1      = md5($_POST['password1']);

  $result1        = $mysqli->query("SELECT email FROM tbl_user WHERE email='$email'");
  $data1          = $result1->num_rows;
 
  if ($data1>0){
    //kode user sudah terdaftar
    echo "<script>document.location.href='../?mod=user&pg=form_input_user&id_level=$id_level&nama=$nama&no_hp=$no_hp&email=$email&act=us'</script>";
  } else if ($password!=$password1){
    // nama user sudah terdaftar
    echo "<script>document.location.href='../?mod=user&pg=form_input_user&id_level=$id_level&nama=$nama&no_hp=$no_hp&email=$email&act=ps'</script>";
  } else {
    $result   = $mysqli->query("INSERT INTO tbl_user VALUES(null,$id_level,'$nama','$no_hp','$email',
                '$password')");
    if ($result){
      echo "<script>document.location.href='../?mod=user&pg=form_input_user&act=db'</script>";
    } else {
      echo "<script>document.location.href='../?mod=user&pg=form_input_user&act=dg'</script>";
    }
  }
  
  mysql_close();

 ?>