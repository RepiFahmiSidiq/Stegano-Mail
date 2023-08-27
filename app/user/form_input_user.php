<?php 
  @$id_level       = $_GET['id_level'];
  if (!empty($id_level)){
    $result1         = $mysqli->query("SELECT nama_level 
                       FROM tbl_level
                       WHERE id_level=$id_level");
    $data1           = $result1->fetch_row();
    $nama_level      = $data1[0];
  } 
  @$nama      = $_GET['nama'];
  @$email       = $_GET['email'];
  @$password       = $_GET['password'];
  @$password1      = $_GET['password1'];
?>
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="fa fa-plus"></i> <?php echo strtoupper('input user') ?></h3> 
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

                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Input user</button> 
                    
                    
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
                      <?php 
                      } else if ($act=='db'){
                      ?>
                      <div class="alert alert-success" id="MessageNotSent">
                         Data berhasil disimpan <a href="?mod=user&pg=data_user"><u>Lihat</u></a>
                      </div>
                      <?php 
                      } else if ($act=='dg') {
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Data gagal disimpan
                      </div>
                    <?php } ?>
                    </span>
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="user/simpan_user.php" >
                         
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nama User</label>
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
                              <input type="password" class="form-control" name="password" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password1" value="" required="">
                            </div>
                        </div>
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

