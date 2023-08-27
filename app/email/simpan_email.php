<?php 
  
  include "../../inc/config.php";
  include "../../inc/functions.php";


  $id_user        = $_POST['id_user']; 
  $email          = $_POST['email']; 
  $judul          = $_POST['judul'];  
  $waktu          = date('Y-m-d H:i:s');  
  
  $file_type     = array('jpg','jpeg'); 
  $post_max_size = 20000000; // 20MB 
  $post_min_size = 100000; // 100KB 
  $file_name     = $_FILES['file']['name'];  
  $file_tmp      = $_FILES['file']['tmp_name'];  
  $file_size     = $_FILES['file']['size'];  
  //cari extensi file dengan menggunakan fungsi explode
  $explode       = explode('.',$file_name);
  $extensi       = $explode[count($explode)-1];
  $datein        = "encrypt-".date("Y-M-DHis");
  $file_simpan   = $datein.'.'.$extensi;
  
  //check apakah type file sudah sesuai
  if(!in_array($extensi,$file_type)){
    @$eror    = true;
    @$act    .= 'ts';
  }
  //check ukuran file apakah lebih dari 10 MB
  if($file_size > $post_max_size){
    @$eror   = true;
    @$act    .= 'uk';
  }
  //check ukuran file apakah kurang dari 1 MB
  if($file_size < $post_min_size){
    @$eror   = true;
    @$act    .= 'ukm';
  }

  if(@$eror == true){
    echo "<script>document.location.href='../?mod=email&pg=form_input_email&email=$email&judul=$judul&kode_encrypt=$kode_encrypt&pesan=$message&act=$act'</script>";
  } else {
    move_uploaded_file($file_tmp,'../../file/email/'.$file_simpan);
    $result   = $mysqli->query("INSERT INTO tbl_email VALUES(null,$id_user,'$waktu','$email','$judul',
                '$file_simpan',1)");    
  } 

  if ($result){
    echo "<script>document.location.href='../?mod=email&pg=form_input_email&act=db'</script>";
  }
  else {
      echo "<script>document.location.href='../?mod=email&pg=form_input_email&act=dg'</script>";
  }
 
 
   
?>