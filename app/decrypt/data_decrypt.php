
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title"><i class="fa fa-home"></i> <?php echo strtoupper('data decrypt') ?></h3>
                     
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="./">
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                                </a>

                                <a href="?mod=decrypt&pg=data_decrypt">
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data decrypt</button>
                                </a>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <?php
                                if ($level=='USER'){   
                              ?>
                               <a href="?mod=decrypt&pg=form_input_decrypt">
                               <button class="btn btn-success"> <i class="fa fa-plus"></i> <span><?php echo strtoupper('input data decrypt') ?></span> </button>
                               </a>
 
                              <?php } ?>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                  <?php 
                                    $act = @$_GET['act'];
                                     if ($act=='db'){
                                  ?>
                                  <div class="alert alert-success" id="MessageNotSent">
                                     Data berhasil di decrypt  
                                  </div>
                                  <?php 
                                  } else if ($act=='dh') {
                                  ?>
                                  <div class="alert alert-danger" id="MessageNotSent">
                                    Data berhasil diapus
                                  </div>
                                <?php } ?>
                                </span>
                                    <div class="box-body table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="20%">Nama User</th>
                                                    <?php
                                                      if ($level=='USER'){ 
                                                    ?>
                                                    <th width="15%">Kode Encrypt</th> 
                                                    <th width="40%">Pesan</th>
                                                    <?php
                                                      }
                                                    ?> 
                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                     
                                            <tbody>
                                            	<?php 
                                                if ($level=='ADMIN'){ 
                                                  $cari = " ";
                                                } else {
                                                  $cari = " AND tbl_decrypt.id_user=$id_user ";
                                                }
                                                $result = $mysqli->query("SELECT tbl_decrypt.*,
                                                          tbl_user.nama
                                                          FROM tbl_decrypt,tbl_user 
                                                          WHERE tbl_decrypt.id_user=tbl_user.id_user 
                                                          ".$cari." 
                                                          ORDER BY tbl_decrypt.id_decrypt DESC");
                                                    $no = 1;
                                            		while($data = $result->fetch_array()){
                                                  $id_decrypt   = $data['id_decrypt'];
                                                  $nama         = $data['nama'];
                                                  $kode_encrypt = $data['kode_encrypt'];
                                                  $plaintext    = $data['plaintext']; 
                                            	?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $nama ?></td>
                                                    <?php
                                                      if ($level=='USER'){ 
                                                    ?>
                                                    <td><?php echo $kode_encrypt ?></td> 
                                                    <td>
                                                      <?php  
                                                            echo $plaintext; 
                                                      ?>
                                                        
                                                    </td> 
                                                    <?php
                                                      }
                                                    ?>
                                                    <td>  
                                                        
                                                        <a href="decrypt/hapus_decrypt.php?id_decrypt=<?php echo $id_decrypt;?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?') ";><button class="btn btn-icon btn-danger btn-sm"> <i class="fa fa-remove"></i> </button></a> 
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                          </tbody> 
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

                

            </div>

           