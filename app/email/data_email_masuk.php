
<!-- Page Content Start -->
<!-- ================== -->

<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="fa fa-home"></i> <?php echo strtoupper('Kotak Masuk') ?></h3> 
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=encrypt&pg=data_encrypt">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data Email</button>
                    </a>
                    
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> 
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
                            <table id="datatable" class="table table-striped table-bordered" style="font-size:10px">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Nama Pengirim</th>
                                        <th width="15%">Email Pengirim</th>
                                        
                                        <?php
                                          if ($level=='USER'){
                                        ?>
                                        <th width="15%">Waktu Kirim</th>
                                        <th width="15%">Subjek</th> 
                                        <th width="15%">File</th> 
                                        <?php
                                          }
                                        ?>  
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                         
                                <tbody>
                                	<?php 

                                    $mysqli->query("UPDATE tbl_email 
                                    SET status=0
                                    WHERE email='$email_user'");

                                		if ($level=='ADMIN'){ 
                                      $cari = " ";
                                    } else {
                                      $cari = " AND tbl_email.email='$email_user' ";
                                    }

                                    $result = $mysqli->query("SELECT tbl_email.*,
                                              tbl_user.nama,tbl_user.email AS pengirim
                                              FROM tbl_email,tbl_user 
                                              WHERE tbl_email.id_user=tbl_user.id_user 
                                              ".$cari."
                                              ORDER BY tbl_email.id_email DESC");
                                        $no = 1;
                                		while($data = $result->fetch_array()){
                                      $id_email     = $data['id_email'];
                                      $nama         = $data['nama'];
                                      $pengirim     = $data['pengirim'];
                                      $judul        = $data['judul'];
                                      $kode_encrypt = $data['kode_encrypt'];
                                      $pesan        = $data['pesan']; 
                                      $file         = $data['file']; 
                                      $waktu        = $data['waktu']; 
                                	?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $nama ?></td>
                                        <td><?php echo $pengirim ?></td>
                                        <?php
                                          if ($level=='USER'){
                                        ?>
                                        <td><?php echo $waktu ?></td>
                                        <td><?php echo $judul ?></td> 
                                        <td>
                                           <?php
                                              if (!empty($file)){
                                            ?>
                                            <a href="../file/email/<?php echo $file?>" target="_blank">
                                            <img src="../file/email/<?php echo $file?>" width="100px" height="100px"> 
                                            <?php
                                              }
                                            ?>
                                        </td> 
                                        <?php
                                          }
                                        ?> 
                                        <td>
                                            <?php
                                              if ($level=='USER'){
                                            ?>
                                            <a href="?mod=decrypt&pg=form_input_decryptemail&id_email=<?php echo $id_email;?>"><button class="btn btn-icon btn-success btn-sm"> <i class="fa fa-eye"></i> Kotak Masuk</button></a>
 
                                            <?php
                                              }
                                            ?>
                                            
                                            <a href="email/hapus_email.php?id_email=<?php echo $id_email;?>&file=<?php echo $file?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?') ";><button class="btn btn-icon btn-danger btn-sm"> <i class="fa fa-remove"></i> </button></a> 
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

