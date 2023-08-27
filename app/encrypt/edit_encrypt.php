<?php 
  
  include "../../inc/config.php";
  include "../../inc/functions.php";


  $id_encrypt     = $_POST['id_encrypt']; 
  $kode_encrypt   = $_POST['kode_encrypt']; 
  $file_lama      = $_POST['file_lama'];
  $pesan          = $_POST['pesan'];
  
  $result1        = $mysqli->query("SELECT COUNT(kode_encrypt) 
                    FROM tbl_encrypt 
                    WHERE kode_encrypt='$kode_encrypt'
                    AND id_encrypt!=$id_encrypt");
  $data1          = $result1->fetch_row();
  $jumlah_kode    = $data1[0];

  if ($jumlah_kode>0){
    //kode encrypt sudah terdaftar
    echo "<script>document.location.href='../?mod=encrypt&pg=form_edit_encrypt&id_encrypt=$id_encrypt&act=ks'</script>";
  } else {


    //PRESES LSB -> 1.  Menentukan citra gambar yang akan menjadi media penyisipan ciphertext (cover image) 
    $file_type     = array('jpg','jpeg'); 
    $post_max_size = 20000000; // 20MB 
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
    else if($file_size > $post_max_size){
      @$eror   = true;
      @$act    .= 'uk';
    }
    //check ukuran file apakah kurang dari 1 MB
    else if($file_size < $post_min_size){
      @$eror   = true;
      @$act    .= 'ukm';
    }
    

    if(@$eror == true){
      echo "<script>document.location.href='../?mod=encrypt&pg=form_edit_encrypt&id_encrypt=$id_encrypt&act=$act'</script>";
    } else {
      //---------------------------------------------------------------------------------------
      //PROSES AES 128 CBC
      //PROSES AES -> 1. Transformasi AddRoundKey pada proses enkripsi pertama kali pada round = 0 
      $key            = $kode_encrypt;
      $plaintext      = $pesan;
      //PROSES AES -> 2. SubBytes merupakan transformasi byte dimana setiap elemen pada state akan dipetakan dengan menggunakan sebuah tabel substitusi ( S-Box ).  Untuk setiap byte pada array state.
      $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
      //PROSES AES -> 3. Transformasi Shiftrows pada dasarnya adalah proses pergeseran bit dimana bit paling kiri akan dipindahkan menjadi bit paling kanan ( rotasi bit ). 
      $iv             = openssl_random_pseudo_bytes($ivlen);  
      $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
      //PROSES AES -> 4. MixColumns mengoperasikan setiap elemen yang berada dalam satu kolom pada state, jika bit sesuai maka masuk kedalam mixColumns
      $hmac           = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
      //PROSES AES -> 5. AddRoundKey: melakukan XOR antara state sekarang dengan round key
      $ciphertext     = base64_encode( $iv.$hmac.$ciphertext_raw );
      //---------------------------------------------------------------------------------------

      // Number of bytes in an integer.
      $INTEGER_BYTES = 4;
      $BYTE_BITS = 8;

      //PRESES LSB -> 2. Memasukkan pesan informasi sebagai ciphertext untuk disisipkan  
      $message = $ciphertext;

      //PRESES LSB -> 3. Menentukan key file yang akan digunakan sebagai password dalam proses extract 
      $binaryMessage = toBinary($message);
      // The number of bits contained in the message, aka the size of the payload as an integer.
      $messageLength = strlen($binaryMessage);
      // Convert the length to binary as well and make sure to pad it with 32 0's.
      $binaryMessageLength = str_pad(decbin($messageLength), $INTEGER_BYTES * $BYTE_BITS, "0", STR_PAD_LEFT);
 
      // The payload will incorporate the length and the message.
      $payload = $binaryMessageLength.$binaryMessage;

      //PRESES LSB -> 4.  Penyisipan file ke dalam gambar 
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
        //PRESES LSB -> 5.  Memetakan menjadi citra baru / memasukkan citra baru kedalam database
        $result   = $mysqli->query("UPDATE tbl_encrypt SET kode_encrypt='$kode_encrypt',pesan='$pesan',
                  ciphertext='$ciphertext',file='$file_simpan'
                  WHERE id_encrypt=$id_encrypt");
        echo "<script>document.location.href='../?mod=encrypt&pg=data_encrypt&act=db'</script>"; 
      } else {
        echo "<script>document.location.href='../?mod=encrypt&pg=data_encrypt&act=dg'</script>";
      }
      unlink('../../file/encrypt/'.$file_lama);
      imagepng($image, '../../file/encrypt/'.$file_simpan);
      imagedestroy($image);
       
    }
  }

 ?>