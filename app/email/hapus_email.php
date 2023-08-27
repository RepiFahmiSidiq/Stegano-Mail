<?php 

    include "../../inc/config.php";

    $file       = $_GET['file'];
    $id_email   = $_GET['id_email'];

    unlink('../../file/email/'.$file);
    $sql   = "DELETE FROM tbl_email WHERE id_email=$id_email";
    $query = $mysqli->query($sql);

    echo "<script>document.location.href='../?mod=email&pg=data_email&act=dh'</script>";
 ?>