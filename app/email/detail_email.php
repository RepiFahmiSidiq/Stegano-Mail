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
        <h3 class="title"><i class="ion-email"></i> <?php echo strtoupper('lihat email') ?></h3> 
    </div>

    <div class="row">
        <!-- Horizontal form -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=email&pg=data_email">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Email</button>
                    </a>

                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Tulis Email</button> 
                    
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <a href="?mod=encrypt&pg=data_encrypt">
                   <button class="btn btn-success"> <i class="fa fa-arrow-left"></i> <span>Back </span> </button>
                   </a>
                    </h3>
                </div>
                <div class="panel-body"> 
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="email/edit_email.php" >
                    <input type="hidden" name="id_email" value="<?php echo $id_email?>">   
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Waktu Pengiriman</label>
                            <div class="col-sm-6">
                              <?php echo $waktu?> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                              <?php echo $email?> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Subjek</label>
                            <div class="col-sm-6">
                              <?php echo $judul?> 
                            </div>
                        </div>

                         
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">File (jpg/jpeg)</label>
                            <div class="col-sm-6">
                              <a href="../file/email/<?php echo $file?>" target="_blank">
                              <img src="../file/email/<?php echo $file?>" width="100px" height="100px">
                              </a>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Kirim</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    
</div>

