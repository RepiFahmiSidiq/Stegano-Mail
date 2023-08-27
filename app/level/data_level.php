
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title"><i class="fa fa-home"></i> <?php echo strtoupper('data level') ?></h3> 
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="./">
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                                </a>

                                <a href="?mod=level&pg=data_level">
                                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data level</button>
                                </a>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <a href="?mod=level&pg=form_input_level">
                               <button class="btn btn-success btn-lg m-b-5"> <i class="fa fa-plus"></i> <span><?php echo strtoupper('input level') ?></span> </button>
                               </a>
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
                                                    <th width="20%">Kode level</th>
                                                    <th width="50%">Nama level</th>
                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                     
                                            <tbody>
                                            	<?php 
                                            		$result = $mysqli->query("SELECT * FROM tbl_level");
                                                    $no = 1;
                                            		while($data = $result->fetch_array()){
                                            	?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $data['kode_level'] ?></td>
                                                    <td><?php echo $data['nama_level'] ?></td>
                                                    <td>
                                                        <a href="?mod=level&pg=form_edit_level&id_level=<?php echo $data['id_level'];?>"><button class="btn btn-icon btn-info m-b-5"> <i class="fa fa-edit"></i> </button></a>
                                                        
                                                        <a href="level/hapus_level.php?id_level=<?php echo $data['id_level'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?') ";><button class="btn btn-icon btn-danger m-b-5"> <i class="fa fa-remove"></i> </button></a> 
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

           