<?php 
  $id_email       = $_GET['id_email'];
  $result         = $mysqli->query("SELECT * FROM tbl_email WHERE id_email=$id_email");
  $data           = $result->fetch_assoc(); 
  @$kode_encrypt  = $data['kode_encrypt'];
  @$pesan         = $data['pesan'];
  $prefix         = $kode_encrypt." - ";
  if (substr($pesan, 0, strlen($prefix)) === $prefix) {
    $pesan = substr($pesan, strlen($prefix));
  }
  @$email         = $data['email'];
  @$judul         = $data['judul'];
  @$file          = $data['file'];
  @$waktu         = $data['waktu'];
?>
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="ion-android-mail"></i>  <?php echo strtoupper('decrypt email') ?></h3> 
    </div>

    <div class="row">
        <!-- Horizontal form -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=decrypt&pg=data_decrypt">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data decrypt</button>
                    </a>

                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Input decrypt</button> 
                    
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    
                    </h3>
                </div>
                <div class="panel-body">
                    <span class="block-title-2"> 
                    <?php 
                        @$act = $_GET['act'];
                        if ($act=='ks'){ 
                        ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Kode encrypt tidak ditemukan
                      </div>
                      <?php 
                        } else if ($act=='ts'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Tipe file hanya berupa jpg dan jpeg
                      </div>
                      <?php 
                      } else if ($act=='uk'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        ukuran file lebih dari 20 MB
                      </div>
                      <?php 
                      } else if ($act=='ukm'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        ukuran file minimal 1 MB
                      </div>
                      <?php 
                      } else if ($act=='db'){
                      ?>
                      <div class="alert alert-success" id="MessageNotSent">
                         Data berhasil didecrypt <a href="?mod=decrypt&pg=data_decrypt"><u>Lihat</u></a>
                      </div>
                      <?php 
                      } else if ($act=='dg') {
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Kode encrypt tidak sesuai
                      </div>
                    <?php } ?>
                    </span>
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="decrypt/simpan_decryptemail.php" >
                    <input type="hidden" name="id_user" value="<?php echo $id_user?>">    
                    <input type="hidden" name="id_email" value="<?php echo $id_email?>">    
                    <input type="hidden" name="file" value="<?php echo $file?>">    
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Kode Encrypt</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" name="kode_encrypt" value="<?php echo $kode_encrypt?>" required="" autofocus>
                            </div>
                        </div>  

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-info">Decrypt</button>
                              <button type="reset" class="btn btn-info">Bersih</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    
</div>

