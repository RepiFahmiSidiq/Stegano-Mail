<?php 

    include "../../inc/config.php";

    $id_user = $_GET['id_user'];

    $sql   = "DELETE FROM tbl_user WHERE id_user=$id_user";
    $query = $mysqli->query($sql);

    echo "<script>document.location.href='../?mod=user&pg=data_user&act=dh'</script>";
 ?>