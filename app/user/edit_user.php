<?php 
  
  include "../../inc/config.php";

  $id_user        = $_POST['id_user']; 
  $id_level       = $_POST['id_level'];
  $nama           = $_POST['nama'];
  $no_hp          = $_POST['no_hp'];
  $email          = $_POST['email'];
  $password       = md5($_POST['password']);
  $password1      = md5($_POST['password1']);
  $pass           = $_POST['password'];

  $result1        = $mysqli->query("SELECT email 
                    FROM tbl_user 
                    WHERE email='$email'
                    AND id_user!=$id_user");
  $data1          = $result1->num_rows;
 
  if ($data1>0){
    //kode user sudah terdaftar
    echo "<script>document.location.href='../?mod=user&pg=form_edit_user&id_user=$id_user&act=us'</script>";
  } else if ($password!=$password1){
    // nama user sudah terdaftar
    echo "<script>document.location.href='../?mod=user&pg=form_edit_user&id_user=$id_user&act=ps'</script>";
  } else {
    $result   = $mysqli->query("UPDATE tbl_user SET nama='$nama',no_hp='$no_hp',
                email='$email'
                WHERE id_user=$id_user");

    if (!empty($pass)){
      $result1   =  $mysqli->query("UPDATE tbl_user SET password='$password'
                    WHERE id_user=$id_user");
    }
    if ($result){
      echo "<script>document.location.href='../?mod=user&pg=data_user&act=db'</script>";
    } else {
      echo "<script>document.location.href='../?mod=user&pg=data_user&act=dg'</script>";
    }
  }
  
  mysql_close();

 ?>