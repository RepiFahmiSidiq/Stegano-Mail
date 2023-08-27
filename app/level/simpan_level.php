<?php 
  
  include "../../inc/config.php";

  $kode_level  = $_POST['kode_level'];
  $nama_level  = $_POST['nama_level'];

  $result1        = $mysqli->query("SELECT kode_level FROM tbl_level WHERE kode_level='$kode_level'");
  $data1          = $result1->num_rows;

  $result2        = $mysqli->query("SELECT nama_level FROM tbl_level WHERE nama_level='$nama_level'");
  $data2          = $result2->num_rows;

  if ($data1>0){
    //kode level sudah terdaftar
    echo "<script>document.location.href='../?mod=level&pg=form_input_level&kode_level=$kode_level&nama_level=$nama_level&act=ks'</script>";
  } else if ($data2>0){
    // nama level sudah terdaftar
    echo "<script>document.location.href='../?mod=level&pg=form_input_level&kode_level=$kode_level&nama_level=$nama_level&act=ns'</script>";
  } else {
    $result   = $mysqli->query("INSERT INTO tbl_level VALUES(null,'$kode_level','$nama_level')");
    if ($result){
      echo "<script>document.location.href='../?mod=level&pg=form_input_level&act=db'</script>";
    } else {
      echo "<script>document.location.href='../?mod=level&pg=form_input_level&act=dg'</script>";
    }
  }
  
  mysql_close();

 ?>