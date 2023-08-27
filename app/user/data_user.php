
<!-- Page Content Start -->
<!-- ================== -->

<div class="wraper container-fluid">
<div class="page-title"> 
    <h3 class="title"><i class="fa fa-home"></i> <?php echo strtoupper('data user') ?></h3> 
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="./">
                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                </a>

                <a href="?mod=user&pg=data_user">
                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data user</button>
                </a>
                
                
            </div>
            
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
              <?php
                if ($level=='ADMIN'){
              ?>
               <a href="?mod=user&pg=form_input_user">
               <button class="btn btn-success btn-lg m-b-5"> <i class="fa fa-plus"></i> <span><?php echo strtoupper('input user') ?></span> </button>
               </a>
              <?php
                }
              ?>
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
                                    <th>No</th>  
                                    <th>Nama User</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                     
                            <tbody>
                            	<?php
                                if ($level=='ADMIN'){
                                  $cari = " ";
                                } else {
                                  $cari = " AND c.id_user=$id_user ";
                                }
                            		$result = $mysqli->query("SELECT b.nama_level,
                                              c.*  
                                              FROM tbl_level b,tbl_user c
                                              WHERE b.id_level=c.id_level ".$cari);
                                    $no = 1;
                            		while($data = $result->fetch_array()){
                                  $id_user        = $data['id_user']; 
                                  $nama_level     = $data['nama_level'];
                                  $nama           = $data['nama'];
                                  $no_hp          = $data['no_hp'];
                                  $email          = $data['email'];
                            	?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $nama ?></td>
                                    <td><?php echo $no_hp ?></td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $nama_level ?></td>
                                    <td>
                                        <a href="?mod=user&pg=form_edit_user&id_user=<?php echo $id_user;?>"><button class="btn btn-icon btn-info btn-sm"> <i class="fa fa-edit"></i> </button></a>
                                        <?php
                                          if ($level=='ADMIN'){
                                        ?>
                                        <a href="user/hapus_user.php?id_user=<?php echo $id_user;?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?') ";><button class="btn btn-icon btn-danger btn-sm"> <i class="fa fa-remove"></i> </button></a> 
                                        <?php } ?>
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

