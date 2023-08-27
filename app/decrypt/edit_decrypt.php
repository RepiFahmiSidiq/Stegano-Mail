 <?php 
  
  include "../../inc/config.php";
  include "../../inc/functions.php";


  $id_decrypt     = $_POST['id_decrypt']; 
  $kode_decrypt   = $_POST['kode_decrypt']; 
  $file_lama      = $_POST['file_lama']; 
  
  $result1        = $mysqli->query("SELECT COUNT(kode_decrypt) 
                    FROM tbl_decrypt 
                    WHERE kode_decrypt='$kode_decrypt'
                    AND id_decrypt!=$id_decrypt");
  $data1          = $result1->fetch_row();
  $jumlah_kode    = $data1[0];

  if ($jumlah_kode>0){
    //kode decrypt sudah terdaftar
    echo "<script>document.location.href='../?mod=decrypt&pg=form_edit_decrypt&id_decrypt=$id_decrypt&act=ks'</script>";
  } else {
    $file_type     = array('jpg','jpeg'); 
    $post_max_size = 20000000; // 20MB 
    $file_name     = $_FILES['file']['name'];  
    $file_size     = $_FILES['file']['size'];  
    //cari extensi file dengan menggunakan fungsi explode
    $explode       = explode('.',$file_name);
    $extensi       = $explode[count($explode)-1];
    $datein        = "decrypt-".date("Y-M-DHis");
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
      echo "<script>document.location.href='../?mod=decrypt&pg=form_edit_decrypt&id_decrypt=$id_decrypt&act=$act'</script>";
    } else {
      // Number of bytes in an integer.
      $INTEGER_BYTES = 4;
      $BYTE_BITS = 8;

      $message = $_POST['pesan'];
      $binaryMessage = toBinary($message);
      // The number of bits contained in the message, aka the size of the payload as an integer.
      $messageLength = strlen($binaryMessage);
      // Convert the length to binary as well and make sure to pad it with 32 0's.
      $binaryMessageLength = str_pad(decbin($messageLength), $INTEGER_BYTES * $BYTE_BITS, "0", STR_PAD_LEFT);


      // The payload will incorporate the length and the message.
      $payload = $binaryMessageLength.$binaryMessage;
      $src    = dirname(__FILE__).'/'.$file_name;
      $image  = imagecreatefromjpeg($src);

      $size   = getimagesize($src);
      $width  = $size[0];
      $height = $size[1];

      function encodePayload(string $payload, $image, $width, $height) {
          $payloadLength = strlen($payload);
          // We are able to store 128 bits per pixel (1 LSB for each color channel) times the width, times the height.
          if($payloadLength > $width * $height * 128) {
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

      unlink('../../file/decrypt/'.$file_lama);
      imagepng($image, '../../file/decrypt/'.$file_simpan);
      imagedestroy($image);
      $result   = $mysqli->query("UPDATE tbl_decrypt SET kode_decrypt='$kode_decrypt',pesan='$message',
                  file='$file_simpan'
                  WHERE id_decrypt=$id_decrypt");
      if ($result){
        echo "<script>document.location.href='../?mod=decrypt&pg=data_decrypt&act=db'</script>";
      } else {
        echo "<script>document.location.href='../?mod=decrypt&pg=data_decrypt&act=dg'</script>";
      }
       
    }
  }

 ?>