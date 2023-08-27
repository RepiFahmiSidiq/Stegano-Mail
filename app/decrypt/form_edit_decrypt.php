<?php 
    $id_decrypt     = $_GET['id_decrypt'];
    $result         = $mysqli->query("SELECT * FROM tbl_decrypt WHERE id_decrypt=$id_decrypt");
    $data           = $result->fetch_assoc();
    $kode_decrypt   = $data['kode_decrypt'];
    $pesan          = $data['pesan']; 
    $file           = $data['file']; 
?>
           
             <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title"><i class="fa fa-edit"></i> <?php echo strtoupper('edit decrypt') ?></h3> 
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
 
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Edit decrypt</button> 
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a href="?mod=decrypt&pg=data_decrypt">
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
                                  Kode decrypt sudah terdaftar
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
                                  Data gagal disimpan
                                </div>
                              <?php } ?>
                                </span>
                                <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="decrypt/edit_decrypt.php" >
                                <input type="hidden" class="form-control" name="id_decrypt" required="" value="<?php echo $data['id_decrypt']?>">

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">Kode decrypt</label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" name="kode_decrypt" required="" value="<?php echo $kode_decrypt?>" autofocus>
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">Pesan</label>
                                        <div class="col-sm-9">
                                          <textarea type="text" class="form-control" name="pesan" required=""><?php echo $pesan?></textarea>
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
           
