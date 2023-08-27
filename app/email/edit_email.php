<?php 
  
  include "../../inc/config.php";
  include "../../inc/functions.php";


  $id_email       = $_POST['id_email']; 
  $kode_encrypt   = $_POST['kode_encrypt']; 
  $email          = $_POST['email']; 
  $judul          = $_POST['judul']; 
  $file_lama      = $_POST['file_lama']; 
  $message        = $kode_encrypt." - ".$_POST['pesan'];
  
  $result1        = $mysqli->query("SELECT kode_encrypt FROM tbl_email 
                    WHERE kode_encrypt='$kode_encrypt'
                    AND id_email!=$id_email");
  $data1          = $result1->num_rows;

  if ($data1>0){
    //kode encrypt sudah terdaftar
    echo "<script>document.location.href='../?mod=email&pg=form_edit_email&id_email=$id_email&act=ks'</script>";
  } else {
    $file_type     = array('jpg','jpeg'); 
    $post_max_size = 10000000; // 10MB 
    $post_min_size = 100000; // 100KB 
    $file_name     = $_FILES['file']['name'];  
    $file_tmp      = $_FILES['file']['tmp_name'];  
    $file_size     = $_FILES['file']['size'];  
    //cari extensi file dengan menggunakan fungsi explode
    $explode       = explode('.',$file_name);
    $extensi       = $explode[count($explode)-1];
    $datein        = "encrypt-".date("Y-M-DHis");
    $file_simpan   = $datein.'.'.$extensi;
  
    //check apakah type file sudah sesuai
    if(!in_array($extensi,$file_type)){
      @$eror    = true;
      @$act    .= 'ts';
    }
    //check ukuran file apakah lebih dari 10 MB
    if($file_size > $post_max_size){
      @$eror   = true;
      @$act    .= 'uk';
    }
    //check ukuran file apakah kurang dari 1 MB
    if($file_size < $post_min_size){
      @$eror   = true;
      @$act    .= 'ukm';
    }

    if(@$eror == true){
      echo "<script>document.location.href='../?mod=email&pg=form_edit_email&id_email=$id_email&act=$act'</script>";
    } else {
      // Number of bytes in an integer.
      $INTEGER_BYTES = 4;
      $BYTE_BITS = 8;

      $message = $message;
      $binaryMessage = toBinary($message);
      // The number of bits contained in the message, aka the size of the payload as an integer.
      $messageLength = strlen($binaryMessage);
      // Convert the length to binary as well and make sure to pad it with 32 0's.
      $binaryMessageLength = str_pad(decbin($messageLength), $INTEGER_BYTES * $BYTE_BITS, "0", STR_PAD_LEFT);


      // The payload will incorporate the length and the message.
      $payload = $binaryMessageLength.$binaryMessage;

      $src    = $file_tmp;
      $image  = imagecreatefromjpeg($src);

      $size   = getimagesize($src);
      $width  = $size[0];
      $height = $size[1];

      function encodePayload(string $payload, $image, $width, $height) {
          $payloadLength = strlen($payload);
          // We are able to store 128 bits per pixel (1 LSB for each color channel) times the width, times the height.
          if($payloadLength > $width * $height * 3) {
              echo "Image not big enough to hold data.";
              return false;
          }
          $bitIndex = 0;
          for($y = 0; $y < $height; $y++) {
              for($x = 0; $x < $width; $x++) {
                  $rgb = imagecolorat($image, $x, $y);
                  // Each color channel's value is extracted from the original integer.
                  $r = ($rgb >> 16) & 0xFF;
                  $g = ($rgb >> 8) & 0xFF;
                  $b = $rgb & 0xFF;

                  // LSB's are cleared by ANDing with 0xFE and filled by ORing with the current payload bit, as long as the payload length isn't hit.
                  $r = ($bitIndex < $payloadLength) ? (($r & 0xFE) | $payload[$bitIndex++]) : $r;
                  $g = ($bitIndex < $payloadLength) ? (($g & 0xFE) | $payload[$bitIndex++]) : $g;
                  $b = ($bitIndex < $payloadLength) ? (($b & 0xFE) | $payload[$bitIndex++]) : $b;

                  $color = imagecolorallocate($image, $r, $g, $b);
                  imagesetpixel($image, $x, $y, $color);

                  if($bitIndex >= $payloadLength) {
                      return true;
                  }
              }
          }
      }

      if(encodePayload($payload, $image, $width, $height)) {
        $result   = $mysqli->query("UPDATE tbl_email SET email='$email',judul='$judul',
                    kode_encrypt='$kode_encrypt',pesan='$message',file='$file_simpan'
                    WHERE id_email=$id_email"); 
        echo "<script>document.location.href='../?mod=email&pg=data_email_keluar&act=db'</script>"; 
      } else {
        echo "<script>document.location.href='../?mod=email&pg=data_email_keluar&act=dg'</script>";
      }

      unlink('../../file/email/'.$file_lama);
      imagepng($image, '../../file/email/'.$file_simpan);
      imagedestroy($image);
       
    }
  }

 ?>