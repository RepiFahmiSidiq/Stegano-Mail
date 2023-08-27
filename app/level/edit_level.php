<?php 
  
  include "../../inc/config.php";

  $id_level    = $_POST['id_level'];
  $kode_level  = $_POST['kode_level'];
  $nama_level  = $_POST['nama_level'];

  $result1        = $mysqli->query("SELECT COUNT(kode_level) 
                    FROM tbl_level 
                    WHERE kode_level='$kode_level'
                    AND id_level!=$id_level");
  $data1          = $result1->fetch_row();
  $jumlah_kode    = $data1[0];

  $result2        = $mysqli->query("SELECT nama_level 
                    FROM tbl_level 
                    WHERE nama_level='$nama_level'
                    AND id_level!=$id_level");
  $data2          = $result2->fetch_row();
  $jumlah_nama    = $data2[0];

  if ($jumlah_kode>0){
    //kode level sudah terdaftar
    echo "<script>document.location.href='../?mod=level&pg=form_edit_level&act=ks&id_level=$id_level'</script>";
  } else if ($jumlah_nama>0){
    // nama level sudah terdaftar
    echo "<script>document.location.href='../?mod=level&pg=form_edit_level&act=ns&id_level=$id_level'</script>";
  } else {
    $result   = $mysqli->query("UPDATE tbl_level SET kode_level='$kode_level',nama_level='$nama_level'
                WHERE id_level=$id_level");
    if ($result){
      echo "<script>document.location.href='../?mod=level&pg=data_level&act=db'</script>";
    } else {
      echo "<script>document.location.href='../?mod=level&pg=form_edit_level&act=dg&id_level=$id_level'</script>";
    }
  }
  
  mysql_close();

 ?>