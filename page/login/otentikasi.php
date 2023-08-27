<?php
include('../../inc/config.php');
 
@$email	    = $_POST['email'];
@$password 	= md5(trim($_POST['password']));

//untuk mencegah sql injection
//kita gunakan mysql_real_escape_string

$email = $mysqli->real_escape_string($email);
$password = $mysqli->real_escape_string($password);
// query cek
$result   = $mysqli->query("SELECT a.id_user,a.nama,a.email,a.password,b.nama_level
            FROM tbl_user a, tbl_level b 
            WHERE a.id_level=b.id_level
            AND a.email='$email' 
            AND a.password='$password'");

// tampil data

if(mysqli_num_rows($result)>0){
	$data = $result->fetch_assoc();
	$_SESSION['email']    	  = $email;
	$_SESSION['id_user'] 	 		= $data["id_user"];
	$_SESSION['nama']   	    = $data["nama"]; 
	$_SESSION['password']	 		= $data['password'];
	$_SESSION['nama_level']		= $data['nama_level'];
	
// kode levelisasi
	if($_SESSION['nama_level']=='ADMIN') {
    echo "<script>document.location.href='../../app/'</script>"; 
  } else{
    echo "<script>document.location.href='../../app/'</script>"; 
  }
} else{
  echo "<script>document.location.href='../../?act=1'</script>"; 
} 
	 
?>