<?php

include "../../inc/config.php";
include "../../inc/function.php";
## Read value
 
@$id_user           = $_SESSION['id_user'];
@$level             = $_SESSION['nama_level']; 
@$id_guru           = $_GET['id_guru'];
## Read value 
$draw               = $_POST['draw'];
$row                = $_POST['start'];
$rowperpage         = $_POST['length']; // Rows display per page
$columnIndex        = $_POST['order'][0]['column']; // Column index
$columnName         = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder    = $_POST['order'][0]['dir']; // asc or desc
$searchValue        = $_POST['search']['value']; // Search value
$no_urut            = $row;

## Search 
$searchQuery = " ";
if($searchValue != ''){
  $searchQuery = " AND (a.nama LIKE '%".$searchValue."%' )";
}

$cari = " ";
if (!empty($id_guru)){
  $cari = " AND a.id_guru=$id_guru ";
} else {
  $cari = " ";
}
 
## Total number of records without filtering
$sel          = $mysqli->query("SELECT COUNT(a.id_guru)
                FROM tbl_guru a 
                WHERE 1 ".$cari);
$records      = $sel->fetch_row();
$totalRecords = $records[0];

## Total number of records with filtering
$sel                    = $mysqli->query("SELECT COUNT(a.id_guru)
                          FROM tbl_guru a  
                          WHERE 1 ".$cari." ".$searchQuery);
$records                = $sel->fetch_row();
$totalRecordwithFilter  = $records[0];

## Fetch records
$empQuery   = "SELECT a.* 
              FROM tbl_guru a 
              WHERE 1 ".$cari." ".$searchQuery." 
              ORDER BY ".$columnName." ".$columnSortOrder." 
              LIMIT ".$row.",".$rowperpage;
$empRecords = $mysqli->query($empQuery); 
$data = array(); 
$no   = 1;
while ($row = $empRecords->fetch_row()) {
  $id_guru          = $row[0];     
  $nip              = $row[2];  
  $nama             = $row[3];  
  $tempat_lahir     = $row[4];   
  $tgl_lahir        = $row[5];
  $jk               = $row[6];
  $agama            = $row[7];
  $kewarganegaraan  = $row[8];
  $alamat           = $row[9];
  $no_hp            = $row[10];
   

  $data[] = array(   
    "id_guru"         => $no++,   
    "nip"             => $nip,   
    "nama"            => $nama,   
    "tempat_lahir"    => $tempat_lahir.", ".$tgl_lahir,   
    "jk"              => $jk,     
    "agama"           => $agama,     
    "kewarganegaraan" => $kewarganegaraan,     
    "alamat"          => $alamat,     
    "no_hp"           => $no_hp,     
  ); 
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
