<?php 

    include "../../inc/config.php";

    $file       = $_GET['file'];
    $id_encrypt = $_GET['id_encrypt'];

    unlink('../../file/encrypt/'.$file);
    $sql   = "DELETE FROM tbl_encrypt WHERE id_encrypt=$id_encrypt";
    $query = $mysqli->query($sql);

    echo "<script>document.location.href='../?mod=encrypt&pg=data_encrypt&act=dh'</script>";
 ?>