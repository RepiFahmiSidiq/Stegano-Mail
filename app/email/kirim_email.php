<?php 
  
  include "../../inc/config.php"; 

  $id_user = $_POST['id_user'];  
  $waktu   = date("Y-m-d H:i:s");  
  $email   = $_POST['email']; 
  $judul   = $_POST['judul'];  
  $file    = $_POST['file']; 

  $dari    = '../../file/encrypt/'.$file;
  $ke      = '../../file/email/'.$file;
  copy($dari, $ke); 
   

  $result   = $mysqli->query("INSERT INTO tbl_email VALUES(null,$id_user,'$waktu','$email','$judul',
              '$file',1)");  
  if ($result){
      echo "<script>document.location.href='../?mod=email&pg=data_email_keluar&act=db'</script>"; 
  } else {
    echo "<script>document.location.href='../?mod=email&pg=data_email_keluar&act=dg'</script>";
  }
 
?>