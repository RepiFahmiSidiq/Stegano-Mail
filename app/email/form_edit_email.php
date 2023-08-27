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
?>
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="ion-email"></i> <?php echo strtoupper('edit email') ?></h3> 
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
                    <a href="?mod=email&pg=data_email_keluar">
                   <button class="btn btn-success"> <i class="fa fa-arrow-left"></i> <span>Back </span> </button>
                   </a>
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
                        ukuran file lebih dari 10 MB
                      </div>
                      <?php 
                      } else if ($act=='ukm'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        ukuran file minimal 100 KB
                      </div>
                      <?php 
                      } else if ($act=='db'){
                      ?>
                      <div class="alert alert-success" id="MessageNotSent">
                         Email berhasil dikirim <a href="?mod=email&pg=data_email"><u>Lihat</u></a>
                      </div>
                      <?php 
                      } else if ($act=='dg') {
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Data gagal disimpan
                      </div>
                    <?php } ?>
                    </span>
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="email/edit_email.php" >
                    <input type="hidden" name="id_email" value="<?php echo $id_email?>">    
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                              <input type="email" class="form-control" name="email" value="<?php echo $email?>" required="" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Subjek</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="judul" value="<?php echo $judul?>" required="">
                            </div>
                        </div>

                         
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">File (jpg dan jpeg)</label>
                            <div class="col-sm-6">
                              <input type="hidden" class="form-control" name="file_lama" value="<?php echo $file?>" required="">
                              <input type="file" class="form-control" name="file" value="" required="">
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-success"> Ubah</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    
</div>

