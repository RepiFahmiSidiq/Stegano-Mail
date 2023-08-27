<?php 
    $id_encrypt     = $_GET['id_encrypt'];
    $result         = $mysqli->query("SELECT * FROM tbl_encrypt WHERE id_encrypt=$id_encrypt");
    $data           = $result->fetch_assoc();
    $kode_encrypt   = $data['kode_encrypt'];
    $pesan          = $data['pesan']; 
    $file           = $data['file']; 
?>
           
             <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title"><i class="fa fa-edit"></i> <?php echo strtoupper('edit encrypt') ?></h3> 
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
 
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Edit encrypt</button> 
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a href="?mod=encrypt&pg=data_encrypt">
                               <button class="btn btn-success btn-lg m-b-5"> <i class="fa fa-arrow-left"></i> <span>Back </span> </button>
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
                                   Data berhasil diencrypt <a href="?mod=encrypt&pg=data_encrypt"><u>Lihat</u></a>
                                </div>
                                <?php 
                                } else if ($act=='dg') {
                                ?>
                                <div class="alert alert-danger" id="MessageNotSent">
                                  Data gagal disimpan
                                </div>
                              <?php } ?>
                                </span>
                                <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="encrypt/edit_encrypt.php" >
                                <input type="hidden" class="form-control" name="id_encrypt" required="" value="<?php echo $data['id_encrypt']?>">

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">Kode Encrypt</label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" name="kode_encrypt" required="" value="<?php echo $kode_encrypt?>" autofocus>
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
                                          <input type="hidden" class="form-control" name="file_lama" value="<?php echo $file?>" required="">
                                          <input type="file" class="form-control" name="file" value="" required="">
                                        </div>
                                    </div>

                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                          <button type="submit" class="btn btn-info">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->

                </div>
                
            </div>
           
