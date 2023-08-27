<?php 
  
  include "../../inc/config.php"; 


  $id_user       = $_POST['id_user']; 
  $id_email      = $_POST['id_email']; 
  $jenis_decrypt = "File";
  $kode_encrypt  = $_POST['kode_encrypt']; 
  $file          = $_POST['file']; 
  //PRESES LSB -> 1.  Memilih file gambar atau covert image yang akan di-extract
  $file_tmp      = '../../file/email/'.$file;

  $INTEGER_BITS = 32;
  $src    = $file_tmp;
  $image  = imagecreatefrompng($src);

  $size   = getimagesize($src);
  $width  = $size[0];
  $height = $size[1];

  // Returns the message length in bits as an integer.
  function decodeMessageLength($image, $width, $height) {
      // We need to process the first 32 LSB's of the image to retrieve the int.
      //PROSES AES -> 1.  PreRoud Ciphertxt, Di XOR dengan AddRoundKey:
      $numOfBits = 32;
      $bitIndex = 0;
      $binaryMessageLength = 0;
      for($y = 0; $y < $height; $y++) {
          for($x = 0; $x < $width; $x++) {
              //PROSES AES -> 2. Proses InvShiftRow ini merupakan kebalikan dari ShiftRow.
              $rgb = imagecolorat($image, $x, $y);
              // We extract each component's LSB by simply ANDing with 1.
              $r = ($rgb >> 16) & 1;
              $g = ($rgb >> 8) & 1;
              $b = $rgb & 1;

              $binaryMessageLength = ($bitIndex++ < $numOfBits) ? (($binaryMessageLength << 1) | $r) : $binaryMessageLength;
              $binaryMessageLength = ($bitIndex++ < $numOfBits) ? (($binaryMessageLength << 1) | $g) : $binaryMessageLength;
              $binaryMessageLength = ($bitIndex++ < $numOfBits) ? (($binaryMessageLength << 1) | $b) : $binaryMessageLength;

              if($bitIndex >= $numOfBits) {
                  return $binaryMessageLength;
              }
          }
      }
  }

  function decodeBinaryMessage($image, $width, $height, $offset, $messageLength) {
      $offsetRemainder = $offset % 3;
      // We get 3 bits for each pixel, so the offset needs to be divided by 3.
      $offset /= 3;
      // Instead of looping through all the pixels, an offset is used for the starting indices.
      $line = $offset / $width;
      $col = $offset % $width;
      $binaryMessage = '';
      $bitIndex = 0;
      for($y = $line; $y < $height; $y++) {
          for($x = $col; $x < $width; $x++) { 
              $rgb = imagecolorat($image, $x, $y);
              // We extract each component's LSB by simply ANDing with 1.
              //PROSES AES -> 3. Proses InvSubBytes sebenarnya sama dengan proses SubByte hanya saja tabel yang digunakan yaitu tabel InvSubBytes
              $r = ($rgb >> 16) & 1;
              $g = ($rgb >> 8) & 1;
              $b = $rgb & 1;

              // Depending on the remainder, we will start with a different LSB.
              //PROSES AES -> 4. Dari hasil InvSubBytes kemudian di XOR dengan AddRoundKey
              if($offsetRemainder == 1) {
                  $binaryMessage .= $g;
                  $binaryMessage .= $b;
                  $offsetRemainder = 0;
                  $bitIndex += 2;
              } else if($offsetRemainder == 2) {
                  $binaryMessage .= $b;
                  $offsetRemainder = 0;
                  $bitIndex++;
              } else {
                  // As long as the bit index is lower than the length of the message, concatenate each component's LSB to the message.
                  $binaryMessage = ($bitIndex++ < $messageLength) ? ($binaryMessage.$r) : $binaryMessage;
                  $binaryMessage = ($bitIndex++ < $messageLength) ? ($binaryMessage.$g) : $binaryMessage;
                  $binaryMessage = ($bitIndex++ < $messageLength) ? ($binaryMessage.$b) : $binaryMessage;

                  //PROSES AES -> 5. InvMixColumns
                  if($bitIndex >= $messageLength) {
                      return $binaryMessage;
                  }
              }
          }
      }
  }

  //PRESES LSB -> 2.  Memasukan key file
  $decodedMessageLength = decodeMessageLength($image, $width, $height);
  $decodedBinaryMessage = decodeBinaryMessage($image, $width, $height, $INTEGER_BITS, $decodedMessageLength);
  //PRESES LSB -> 3.  Menampilkan hasil pembacaan pesan
  $decodedMessage = implode(array_map('chr', array_map('bindec', str_split($decodedBinaryMessage, 8))));
  $decrypt        = $decodedMessage;
  $c              = base64_decode($decrypt);
  $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
  $iv             = substr($c, 0, $ivlen);
  $hmac           = substr($c, $ivlen, $sha2len=32);
  $ciphertext_raw = substr($c, $ivlen+$sha2len);
  $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $kode_encrypt, $options=OPENSSL_RAW_DATA, $iv);
  $calcmac = hash_hmac('sha256', $ciphertext_raw, $kode_encrypt, $as_binary=true);
  // timing attack safe comparison
  //if (hash_equals($hmac, $calcmac)){ KALO VERSI PHP DIATAS 5.6 BISA PAKE FUNGSI INI

  if ($hmac == $calcmac){
    $result   = $mysqli->query("INSERT INTO tbl_decrypt VALUES(null,$id_user,'$jenis_decrypt',
                '$kode_encrypt','$original_plaintext')"); 
    echo "<script>document.location.href='../?mod=decrypt&pg=data_decrypt&act=db'</script>";
  } else {
    echo "<script>document.location.href='../?mod=decrypt&pg=form_input_decryptemail&act=dg&id_email=$id_email'</script>";
  } 
 
  imagedestroy($image);
 
 

 ?>