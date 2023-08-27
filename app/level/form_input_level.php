            <?php
              @$kode_level  = $_GET['kode_level'];
              @$nama_level  = $_GET['nama_level'];
            ?>
            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title"><i class="fa fa-plus"></i> <?php echo strtoupper('input level') ?></h3> 
                </div>

                <div class="row">
                    <!-- Horizontal form -->
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="./">
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                                </a>

                                <a href="?mod=level&pg=data_level">
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data level</button>
                                </a>
 
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Input level</button> 
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                <a href="?mod=level&pg=data_level">
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
                                    Kode level sudah terdaftar
                                  </div>
                                  <?php 
                                    } else if ($act=='ns'){
                                  ?>
                                  <div class="alert alert-danger" id="MessageNotSent">
                                    Nama level sudah terdaftar
                                  </div>
                                  <?php 
                                  } else if ($act=='db'){
                                  ?>
                                  <div class="alert alert-success" id="MessageNotSent">
                                     Data berhasil disimpan <a href="?mod=level&pg=data_level"><u>Lihat</u></a>
                                  </div>
                                  <?php 
                                  } else if ($act=='dg') {
                                  ?>
                                  <div class="alert alert-danger" id="MessageNotSent">
                                    Data gagal disimpan
                                  </div>
                                <?php } ?>
                                </span>
                                <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="level/simpan_level.php" >
                                    
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Kode level</label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" name="kode_level" value="<?php echo $kode_level?>" required="" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Nama level</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="nama_level" value="<?php echo $nama_level?>" required="">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-2 col-sm-9">
                                          <button type="submit" class="btn btn-info">Simpan</button>
                                          <button type="reset" class="btn btn-info">Bersih</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div> <!-- col -->

                </div>
                
            </div>
           
