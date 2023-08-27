<?php
function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
  return $hasil_rupiah;
 
}

function simpan_debet($jumlah_debet){ 
    $urutan_koma        = strpos($jumlah_debet, ',', 1);
    $jumlah_titik       = substr_count($jumlah_debet, ".");
    $urutan_desimal     = $urutan_koma + 1; 
    $urutan_bulat       = $urutan_koma - $jumlah_titik;  
    //mengubah string menjadi angka
    $bilangan_bulat     = preg_replace("/[^0-9]/", "", $jumlah_debet); 
    //mengambil 2 angka di belakang koma
    $desimal      = substr($jumlah_debet,$urutan_desimal,2);
    $angka        = substr($bilangan_bulat,0,$urutan_bulat); 
    // JIKA DESIMAL ATAU TIDAK YANG DIGUNAKAN UNTUK DOLAR
    if ($urutan_koma>0){
      $debet = $angka.".".$desimal; 
    } else {
      $debet = $bilangan_bulat; 
    } 
}

function simpan_kredit($jumlah_kredit){ 
    $urutan_koma        = strpos($jumlah_kredit, ',', 1);
    $jumlah_titik       = substr_count($jumlah_kredit, ".");
    $urutan_desimal     = $urutan_koma + 1; 
    $urutan_bulat       = $urutan_koma - $jumlah_titik;  
    //mengubah string menjadi angka
    $bilangan_bulat     = preg_replace("/[^0-9]/", "", $jumlah_kredit); 
    //mengambil 2 angka di belakang koma
    $desimal      = substr($jumlah_kredit,$urutan_desimal,2);
    $angka        = substr($bilangan_bulat,0,$urutan_bulat); 
    // JIKA DESIMAL ATAU TIDAK YANG DIGUNAKAN UNTUK DOLAR
    if ($urutan_koma>0){
      $kredit = $angka.".".$desimal; 
    } else {
      $kredit = $bilangan_bulat; 
    } 
}

function render_nilai($jumlah_nilai){
	//DEBET     
	  $debet = number_format($jumlah_nilai,2,",",".");  
	  //mencari urutan koma pada string dan ditambah satu
	  $urutan_koma        = strpos($debet, ',', 1); 
	  $urutan_desimal     = $urutan_koma + 1;   
	  //mengambil 2 angka di belakang koma
	  $desimal      = substr($debet,$urutan_desimal,2); 
      
	  if ($desimal>0){
	    $debet = "Rp ".number_format($jumlah_nilai,2,",","."); 
	  } else {
	    $debet = "Rp ".number_format($jumlah_nilai,0,",",".");   
	  }
     

	  //JIKA NILAI DEBET 0
      if ($jumlah_nilai>0){
        $debet = $debet; 
      } else {
        $debet = ""; 
      }
 
	  return $debet;
	  
}


?> 