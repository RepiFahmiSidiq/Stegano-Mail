<?php
  $result1        = $mysqli->query("SELECT id_user FROM tbl_user");
  $data_user      = $result1->num_rows;

  $result1        = $mysqli->query("SELECT id_encrypt FROM tbl_encrypt");
  $data_encrypt   = $result1->num_rows;
  
  $result1        = $mysqli->query("SELECT id_decrypt FROM tbl_decrypt");
  $data_decrypt   = $result1->num_rows;

  $result1        = $mysqli->query("SELECT id_email FROM tbl_email");
  $data_email     = $result1->num_rows;
  
?>
 <div class="wraper container-fluid">
    <div class="page-title"> 
        <h5 class="title" style="font-size:25px;text-align: center;">Stegano-Mail : Aplikasi Pengiriman Surat Elektronik Melalui Citra Digital Menggunakan Kombinasi Algoritma Advanced Encryption standar dan LSB.</h5> 
    </div>
    <?php
      if ($level=='ADMIN'){
    ?>
    <div class="row"> 
        <a href="?mod=user&pg=data_user">
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-pink" style="height: 150px">
                <i class="ion-person"></i>  
                <h2 class="m-0 counter"><?php echo $data_user ?></h2>
                <div>Data User</div>
            </div>
        </div>
        </a>

        <a href="?mod=encrypt&pg=data_encrypt">
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-info" style="height: 150px">
                <i class="ion-locked"></i>  
                <h2 class="m-0 counter"><?php echo $data_encrypt ?></h2>
                <div>Data Enkrip</div>
            </div>
        </div>
        </a>  

        <a href="?mod=decrypt&pg=data_decrypt">
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-purple" style="height: 150px">
                <i class="ion-unlocked"></i> 
                <h2 class="m-0 counter"><?php echo $data_decrypt ?></h2> 
                <div>Data Decrypt</div>
            </div>
        </div>
        </a>
         
        <a href="?mod=email&pg=data_email">
        <div class="col-lg-3 col-sm-6">
            <div class="widget-panel widget-style-2 bg-success" style="height: 150px">
                <i class="ion-email"></i> 
                <h2 class="m-0 counter"><?php echo $data_email ?></h2> 
                <div>Data Email</div>
            </div>
        </div> 
      
    </div> <!-- end row -->
    <?php
      }
    ?>
   
</div>
<!-- Page Content Ends -->
<!-- ================== -->
