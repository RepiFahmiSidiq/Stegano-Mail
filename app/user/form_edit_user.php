<?php 
  $id_user    = $_GET['id_user'];
  $result     = $mysqli->query("SELECT b.nama_level,
                c.*  
                FROM tbl_level b,tbl_user c
                WHERE b.id_level=c.id_level
                AND c.id_user=$id_user"); 
  $data       = $result->fetch_array();   
  $id_level   = $data['id_level'];
  $nama_level = $data['nama_level'];
  $nama       = $data['nama'];
  $no_hp      = $data['no_hp'];
  $email      = $data['email'];
 ?>
           
 
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="fa fa-plus"></i> <?php echo strtoupper('edit user') ?></h3> 
    </div>

    <div class="row">
        <!-- Horizontal form -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=user&pg=data_user">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data user</button>
                    </a>

                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Edit user</button> 
                    
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <a href="?mod=user&pg=data_user">
                   <button class="btn btn-success btn-lg m-b-5"> <i class="fa fa-arrow-left"></i> <span>Back </span> </button>
                   </a>
                    </h3>
                </div>
                <div class="panel-body">
                    <span class="block-title-2"> 
                    <?php 
                        @$act = $_GET['act'];
                        if ($act=='us'){ 
                        ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        email sudah terdaftar
                      </div>
                      <?php 
                        } else if ($act=='ps'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Password tidak sesuai
                      </div> 
                    <?php } ?>
                    </span>
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="user/edit_user.php" >
                    <input type="hidden" class="form-control" name="id_user" value="<?php echo $id_user ?>" required="">    
                         
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">No HP</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="no_hp" value="<?php echo $no_hp ?>" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="email" value="<?php echo $email ?>" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password1" value="" >
                            </div>
                        </div>
                        <?php
                          if ($level=='ADMIN'){
                        ?>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="id_level" required="">
                                <?php
                                  if (empty($id_level)){
                                ?>
                                <option value="">--Pilih--</option>
                                <?php
                                  } else {
                                ?>
                                <option value="<?php echo $id_level?>"><?php echo $nama_level ?></option>
                                <?php
                                  }
                                ?>
                                <?php
                                  $result2 = $mysqli->query("SELECT id_level,nama_level 
                                             FROM tbl_level");
                                  while($data2=$result2->fetch_assoc()){
                                    $id_level    = $data2['id_level'];
                                    $nama_level  = $data2['nama_level'];
                                ?>
                                <option value="<?php echo $id_level?>"><?php echo $nama_level ?></option>
                                <?php
                                  } 
                                ?>
                              </select>
                            </div>
                        </div>
                        <?php
                          } 
                        ?>
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-2 col-sm-9">
                              <button type="submit" class="btn btn-info">Ubah</button> 
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    
</div>


           
