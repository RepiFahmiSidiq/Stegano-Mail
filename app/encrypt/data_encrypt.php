
<!-- Page Content Start -->
<!-- ================== -->

<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="fa fa-home"></i> <?php echo strtoupper('data encrypt') ?></h3> 
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=encrypt&pg=data_encrypt">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data encrypt</button>
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
                   <a href="?mod=encrypt&pg=form_input_encrypt">
                   <button class="btn btn-success"> <i class="fa fa-plus"></i> <span><?php echo strtoupper('input data encrypt') ?></span> </button>
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
                         Data berhasil diubah  
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
                                        <th width="10%">No</th>
                                        <th width="20%">Nama User</th>
                                        <?php
                                          if ($level=='USER'){   
                                        ?>
                                        <th width="15%">Kode Encrypt</th>
                                        <th width="20%">File</th> 
                                        <?php
                                          }
                                        ?>
                                        <th width="35%">Aksi</th>
                                    </tr>
                                </thead>
                         
                                <tbody>
                                	<?php 
                                    if ($level=='ADMIN'){ 
                                      $cari = " ";
                                    } else {
                                      $cari = " AND tbl_encrypt.id_user=$id_user ";
                                    }
                                		$result = $mysqli->query("SELECT tbl_encrypt.*,
                                              tbl_user.nama
                                              FROM tbl_encrypt,tbl_user 
                                              WHERE tbl_encrypt.id_user=tbl_user.id_user 
                                              ".$cari."
                                              ORDER BY tbl_encrypt.id_encrypt DESC");
                                        $no = 1;
                                		while($data = $result->fetch_array()){
                                      $id_encrypt   = $data['id_encrypt'];
                                      $kode_encrypt = $data['kode_encrypt'];
                                      $file         = $data['file'];  
                                      $nama         = $data['nama'];  
                                	?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $nama ?></td>
                                        <?php
                                          if ($level=='USER'){   
                                        ?>
                                        <td><?php echo $kode_encrypt ?></td>
                                        <td><?php echo $file ?></td> 
                                        <?php
                                          }
                                        ?>
                                        <td>
                                            <?php
                                              if ($level=='USER'){  
                                               
                                            ?>
                                            <a href="?mod=email&pg=form_kirim_email&id_encrypt=<?php echo $id_encrypt?>" ><button class="btn btn-icon btn-success btn-sm"> <i class="fa fa-send"></i> Kirim Email</button></a>

                                            <a href="encrypt/download_encrypt.php?file=<?php echo $file?>" ><button class="btn btn-icon btn-warning btn-sm"> <i class="fa fa-download"></i> Download File </button></a>

                                            <a href="?mod=encrypt&pg=form_edit_encrypt&id_encrypt=<?php echo $id_encrypt;?>"><button class="btn btn-icon btn-info btn-sm"> <i class="fa fa-edit"></i> </button></a>
                                            <?php
                                              }
                                            ?>
                                            <a href="encrypt/hapus_encrypt.php?id_encrypt=<?php echo $id_encrypt;?>&file=<?php echo $file?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?') ";><button class="btn btn-icon btn-danger btn-sm"> <i class="fa fa-remove"></i> </button></a> 
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

