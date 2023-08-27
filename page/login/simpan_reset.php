<?php 
  
  include "../../inc/config.php";

  $email            = $_POST['email'];   
  $password         = md5($_POST['password']);
  $password2        = md5($_POST['password2']); 


  if ($password!=$password2){
    //kode siswa sudah terdaftar
    echo "<script>document.location.href='reset_password.php?act=ps&em=$email'</script>";
  }  else { 

        $result   = $mysqli->query("UPDATE SET 
                  password='$password'
                  WHERE email='$email'");
 
     
  }
 
      echo "<script>document.location.href='../../index.php?act=bp'</script>";
    
  
  
  
  mysql_close();

 ?>