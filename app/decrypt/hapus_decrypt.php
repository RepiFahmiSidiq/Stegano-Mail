<?php 

    include "../../inc/config.php";
 
    $id_decrypt = $_GET['id_decrypt'];
 
    $sql   = "DELETE FROM tbl_decrypt WHERE id_decrypt=$id_decrypt";
    $query = $mysqli->query($sql);

    echo "<script>document.location.href='../?mod=decrypt&pg=data_decrypt&act=dh'</script>";
 ?>