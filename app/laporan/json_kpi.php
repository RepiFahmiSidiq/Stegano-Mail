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
$sel          = $mysqli->query("SELECT COUNT(DISTINCT a.id_guru) 
                FROM tbl_guru a, tbl_kpi b, tbl_kriteria c
                WHERE a.id_guru=b.id_guru
                AND b.id_kriteria=c.id_kriteria ".$cari);
$records      = $sel->fetch_row();
$totalRecords = $records[0];

## Total number of records with filtering
$sel                    = $mysqli->query("SELECT COUNT(DISTINCT a.id_guru) 
                          FROM tbl_guru a, tbl_kpi b, tbl_kriteria c
                          WHERE a.id_guru=b.id_guru
                          AND b.id_kriteria=c.id_kriteria ".$cari." ".$searchQuery);
$records                = $sel->fetch_row();
$totalRecordwithFilter  = $records[0];

## Fetch records
$empQuery   = "SELECT COUNT(DISTINCT a.id_guru),a.id_guru,a.nip,a.nama,
              SUM(b.skor_akhir) AS skor_akhir
              FROM tbl_guru a, tbl_kpi b, tbl_kriteria c
              WHERE a.id_guru=b.id_guru
              AND b.id_kriteria=c.id_kriteria ".$cari." ".$searchQuery." 
              GROUP BY a.id_guru
              ORDER BY ".$columnName." ".$columnSortOrder." 
              LIMIT ".$row.",".$rowperpage;
$empRecords = $mysqli->query($empQuery); 
$data = array(); 
$no   = 1;
while ($row = $empRecords->fetch_row()) {
  $id_guru          = $row[1];     
  $nip              = $row[2];  
  $nama             = $row[3];  
  $skor_akhir       = $row[4];

  $detail = "<a href='?mod=laporan&pg=data_kpi&id_guru=".$id_guru."'><button class='btn btn-icon btn-success btn-sm'> <i class='fa fa-eye'></i> </button></a>";

  $data[] = array(   
    "id_guru"         => $no++,   
    "nip"             => $nip,   
    "nama"            => $nama,   
    "skor_akhir"      => $skor_akhir,        
    "aksi"            => $detail,     
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
