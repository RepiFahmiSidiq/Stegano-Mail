<?php 

    include "../../inc/config.php";

    $id_user = $_GET['id_user'];

    $sql   = "DELETE FROM tbl_user WHERE id_user='$id_user'";
    $query = mysql_query($sql);

    echo "<script>document.location.href='../index.php?mod=user&pg=data_user'</script>";
 ?>