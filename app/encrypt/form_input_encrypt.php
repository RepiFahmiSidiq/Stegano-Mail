<?php
  @$kode_encrypt  = $_GET['kode_encrypt'];
  @$pesan         = $_GET['pesan'];
  @$key           = $_GET['key'];
  $prefix         = $kode_encrypt." - ";
  if (substr($pesan, 0, strlen($prefix)) === $prefix) {
    $pesan = substr($pesan, strlen($prefix));
  }

 
?>

<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="fa fa-plus"></i> <?php echo strtoupper('input encrypt') ?></h3> 
    </div>

    <div class="row">
        <!-- Horizontal form -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=encrypt&pg=data_encrypt">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data encrypt</button>
                    </a>

                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Input encrypt</button> 
                    
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                     Encrypt
                    </h3>
                </div>
                <div class="panel-body">
                    <span class="block-title-2"> 
                    <?php 
                        @$act = $_GET['act'];
                        if ($act=='ks'){ 
                        ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Kode encrypt sudah terdaftar
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
                        ukuran file minimal 100 kb
                      </div>
                      <?php 
                      } else if ($act=='db'){
                      ?>
                      <div class="alert alert-success" id="MessageNotSent">
                         Data berhasil diencrypt  
                      </div>
                      <?php 
                      } else if ($act=='dg') {
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Data gagal disimpan
                      </div>
                    <?php } ?>
                    </span>
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="encrypt/simpan_encrypt.php" >
                    <input type="hidden" name="id_user" value="<?php echo $id_user ?>">   
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Kode Encrypt</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="kode_encrypt" value="<?php echo $kode_encrypt?>" required="" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Pesan</label>
                            <div class="col-sm-9">
                              <textarea class="wysihtml5 form-control" placeholder="Message body" style="height: 200px" name="pesan"><?php echo $pesan?></textarea> 
                            </div>
                        </div>
 
                         
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">File (jpg/jpeg)</label>
                            <div class="col-sm-6">
                              <input type="file" class="form-control" name="file" value="" required="">
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-info"><i class="fa fa-lock"></i> Encrypt</button>
                              <button type="reset" class="btn btn-info"><i class="fa fa-edit"></i> Bersih</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    Hasil Encrypt
                    </h3>
                </div>
                <div class="panel-body">
                    <?php 
                      $result = $mysqli->query("SELECT tbl_encrypt.* 
                                FROM tbl_encrypt 
                                WHERE kode_encrypt='$key'
                                ORDER BY id_encrypt DESC
                                LIMIT 1"); 
                      $data   = $result->fetch_array();
                      $id_encrypt   = $data['id_encrypt'];
                      $kode_encrypt = $data['kode_encrypt'];
                      $pesan        = $data['pesan'];
                      $file         = $data['file']; 
                      $ciphertext   = $data['ciphertext']; 
                    ?>
                    <form class="form-horizontal">
                    <input type="hidden" name="id_user" value="<?php echo $id_user ?>">   
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4" style="text-align: right;">Kode Encrypt : </label>
                            <div class="col-sm-8">
                              <?php echo $kode_encrypt ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4" style="text-align: right;">Pesan : </label>
                            <div class="col-sm-8">
                              <?php echo $pesan ?> 
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Ciphertext : </label>
                            <div class="col-sm-8">
                              <textarea class="form-control" placeholder="Message body" style="height: 200px" name="pesan"><?php echo $ciphertext?></textarea>  
                            </div>
                        </div>
                         
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">File (jpg/jpeg) : </label>
                            <div class="col-sm-8">
                              <?php
                                if (!empty($file)){
                              ?>
                              <a href="../file/encrypt/<?php echo $file?>" target="_blank">
                              <img src="../file/encrypt/<?php echo $file?>" width="100px" height="100px"> 
                              <?php
                                }
                              ?>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <div class="col-sm-12">
                              <a href="?mod=decrypt&pg=form_input_decrypt">
                              <button type="button" class="btn btn-success"><i class="fa fa-unlock"></i> Decrypt</button> 
                              </a>
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    
</div>

