<?php 
  include_once('../../inc/config.php'); 
  include('../../inc/PHPExcel.php'); 

  $objPHPExcel  = new PHPExcel();

  //format ribuan
  function format_ribuan ($nilai){
    return number_format($nilai, 0, ',', '.');
  }

  function rupiah($angka){ 
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah; 
  }

  @$id_guru       = $_GET['id_guru'];  

  $sql    = "SELECT * FROM tbl_perusahaan";
  $query  = $mysqli->query($sql);    
  $row    = $query->fetch_row();
  $nama_perusahaan      = $row[2];
  $alamat_perusahaan    = $row[3];
  $pimpinan_perusahaan  = $row[4];

  //untuk warna
  function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
      ));
  }
 
  
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', strtoupper($nama_perusahaan)); 
  $objPHPExcel->getActiveSheet()->mergeCells('A1:B1'); // Set Merge Cell pada kolom A1 sampai F1
  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2',$alamat_perusahaan); 
  $objPHPExcel->getActiveSheet()->mergeCells('A2:B2'); // Set Merge Cell pada kolom A1 sampai F1
  $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(8); // Set font size 15 untuk kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'LAPORAN DATA GURU'); 
  $objPHPExcel->getActiveSheet()->mergeCells('A3:B3'); // Set Merge Cell pada kolom A1 sampai F1
  $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 
  $sql = "SELECT a.* 
          FROM tbl_guru a 
          WHERE a.id_guru=$id_guru ";
  $query = $mysqli->query($sql);  
  $rows = array();
  while ($row = $query->fetch_row()) {
        $rows[] = $row;  
  } 

  $rowCount     = 6; 
  foreach ($rows as $key => $row) {
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
  

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount ,"NIP",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$nip,'UTF-8'); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"Nama",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$nama,'UTF-8');

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"Tempat Tgl Lahir",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$tempat_lahir.", ".$tgl_lahir,'UTF-8');

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"Jenis Kelamin",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$jk,'UTF-8');

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"Agama",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$agama,'UTF-8');

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"Kewarganegaraan",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$kewarganegaraan,'UTF-8');

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"Alamat",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$alamat,'UTF-8');

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1,"No HP",'UTF-8');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,": ".$no_hp,'UTF-8'); 


    $rowCount++; 
  }
       
 
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(70); // Set width kolom A
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B 

  $objWriter  = new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Data Guru '.$nip.' '.$nama.'.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');
?>