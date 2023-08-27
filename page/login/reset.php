<?php
  $email = $_POST['email'];; 

  include "../../inc/PHPmailer/class.phpmailer.php";
  //Create a new PHPMailer instance
  $mail = new PHPMailer;
   
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
   
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 1;
   
  //Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
   
  //Set the hostname of the mail server
  $mail->Host = 'mail.stegano-mail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6
   
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 26;
   
  //Set the encryption system to use - ssl (deprecated) or tls
  //$mail->SMTPSecure = 'tls';
   
  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;
   
  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = 'admin@stegano-mail.com';
   
  //Password to use for SMTP authentication
  $mail->Password = '10november2018';
   
  //Set who the message is to be sent from
  $mail->setFrom('admin@stegano-mail.com', 'Stegano Mail');
   
  //Set an alternative reply-to address
  $mail->addReplyTo('admin@stegano-mail.com', 'Stegano Mail');
   
  //Set who the message is to be sent to
  $nama     = "User";
  $emailnya = $email;
  $mail->addAddress($emailnya,$nama);

  //Set the subject line
  $mail->Subject = 'Reset password';
   
  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  //kalo mau upload pake html
  //$mail->msgHTML(file_get_contents('index.html'), dirname(__FILE__));

  
  $mail->AddEmbeddedImage('../../inc/PHPmailer/logo.png', 'logoimg'); // attach file logo.jpg, and later link to it using identfier logoimg
  /* 
  $mail->AddEmbeddedImage('../../images/tw.gif', 'logotwit'); // attach file logo.jpg, and later link to it using identfier logoimg
  $mail->AddEmbeddedImage('../../images/fb.gif', 'logofb'); // attach file logo.jpg, and later link to it using identfier logoimg
  $mail->AddEmbeddedImage($alamatfile1, 'fotopromosi'); // attach file logo.jpg, and later link to it using identfier logoimg
  */
  $mail->Body = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>  
      <tr>
        <td style='padding: 10px 0 30px 0;'>
          <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #cccccc; border-collapse: collapse;'>
            <tr>
              <td align='center' bgcolor='#70bbd9' style='padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
                <img src=\"cid:logoimg\" alt='Creating Email Magic' width='100' height='100' style='display: block;' />
              </td>
            </tr>
            <tr>
              <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%'> 
                  <tr>
                    <td style='padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                      Reset password ".$email." agar dapat login kedalam sistem Stegano-mail
                    </td>
                  </tr> 
                  <tr style='text-align:center'>
                    <td style='font-family: Arial, sans-serif; font-size: 12px; line-height: 20px;text-align:center'>
                      <a href='http://stegano-mail.com/page/login/reset_password.php?em=".$email."'> <button type='button' style='background-color: #008CBA; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;'>Klik Disini</button></a>
                    </td>
                  </tr>
                   
                </table>
              </td>
            </tr> 
          </table>
        </td>
      </tr>
    </table>";

  //Replace the plain text body with one created manually
  $mail->AltBody = 'This is a new email, please open';
  if ($mail->Send()){
    echo "<script>document.location.href='../../index.php?act=ck'</script>";
  }
?>