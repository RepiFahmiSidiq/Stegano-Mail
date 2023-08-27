<?php 

    include "../../inc/config.php";

    $id_level = $_GET['id_level'];

    $sql   = "DELETE FROM tbl_level WHERE id_level=$id_level";
    $query = $mysqli->query($sql);

    echo "<script>document.location.href='../?mod=level&pg=data_level&act=dh'</script>";
 ?>