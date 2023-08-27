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

  @$id_guru         = $_GET['id_guru']; 
  $result           = $mysqli->query("SELECT a.* 
                      FROM tbl_guru a 
                      WHERE a.id_guru=$id_guru");
  $data             = $result->fetch_assoc();  
  $id_guru          = $data['id_guru'];  
  $nip              = $data['nip'];
  $nama             = $data['nama']; 

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
  $objPHPExcel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai F1
  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14); // Set font size 15 untuk kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2',$alamat_perusahaan); 
  $objPHPExcel->getActiveSheet()->mergeCells('A2:G2'); // Set Merge Cell pada kolom A1 sampai F1
  $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(8); // Set font size 15 untuk kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Penilaian '.$nip." - ".$nama); 
  $objPHPExcel->getActiveSheet()->mergeCells('A3:G3'); // Set Merge Cell pada kolom A1 sampai F1
  $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
  $objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
  $objPHPExcel->getActiveSheet()->SetCellValue('A5',"Nama Kriteria",'UTF-8');
  $objPHPExcel->getActiveSheet()->SetCellValue('B5',"KPI",'UTF-8');
  $objPHPExcel->getActiveSheet()->SetCellValue('C5',"Bobot",'UTF-8');
  $objPHPExcel->getActiveSheet()->SetCellValue('D5',"Target",'UTF-8');
  $objPHPExcel->getActiveSheet()->SetCellValue('E5',"Nilai",'UTF-8');
  $objPHPExcel->getActiveSheet()->SetCellValue('F5',"Skor",'UTF-8');
  $objPHPExcel->getActiveSheet()->SetCellValue('G5',"Skor Akhir",'UTF-8'); 

  $sql    = "SELECT a.nama_kriteria,a.kpi,a.bobot,a.target,
            b.*
            FROM tbl_kriteria a, tbl_kpi b 
            WHERE a.id_kriteria=b.id_kriteria 
            AND b.id_guru=$id_guru ";
  $query  = $mysqli->query($sql);  
  $rows = array();
  while ($row = $query->fetch_assoc()) {
        $rows[] = $row;  
  } 

  $rowCount     = 6; 
  foreach ($rows as $key => $row) {
    $id_kpi           = $row['id_kpi'];   
    $bobot            = $row['bobot'];   
    $target           = $row['target'];
    $nilai            = $row['nilai'];
    $skor             = $row['skor'];  
    $skor_akhir       = $row['skor_akhir'];
    $total_skor      += $skor_akhir;
    $nama_kriteria    = $row['nama_kriteria'];
    $kpi              = $row['kpi'];
   
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$nama_kriteria,'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$kpi,'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$bobot,'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$target,'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$nilai,'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$skor,'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$skor_akhir,'UTF-8');  


    $rowCount++; 
  }
    
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount = $rowCount + 1," ",'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount," ",'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount," ",'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount," ",'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount," ",'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,"TOTAL SKOR",'UTF-8');  
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$total_skor,'UTF-8');
 
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(70); // Set width kolom A
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B 

    $objWriter  = new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Penilaian KPI '.$nip.' '.$nama.'.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');
?>