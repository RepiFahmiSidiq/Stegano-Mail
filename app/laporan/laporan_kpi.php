<?php 
  @$id_guru          = $_POST['id_guru'];
  if (!empty($id_guru)){
    $result           = $mysqli->query("SELECT a.nip,a.nama
                        FROM tbl_guru a 
                        WHERE a.id_guru=$id_guru");
    $data             = $result->fetch_assoc();  
    $nip              = $data['nip'];
    $nama             = $data['nama'];
  }
?>
<div class="wraper container-fluid">
<div class="page-title"> 
    <h3 class="title"><i class="fa fa-file"></i> <?php echo strtoupper('LAPORAN PENILAIAN KPI') ?></h3> 
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="./">
                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home </button>
                </a> 
                <a href="?mod=kaskgn&pg=data_bulankgn">
                <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data KPI</button>
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
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="" >
                          
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nama Guru</label>
                            <div class="col-sm-6"> 
                              <select class="select2" name="id_guru" autofocus>
                                <?php
                                  if (empty($id_guru)){
                                ?>
                                <option value="">--Pilih--</option>
                                <?php
                                  } else {
                                ?>
                                <option value="<?php echo $id_guru;?>"><?php echo $nip." - ".$nama?></option>
                                <?php
                                  }
                                ?>
                                <?php
                                  $result1  = $mysqli->query("SELECT id_guru,nip,nama 
                                              FROM tbl_guru                                              
                                              ORDER BY id_guru DESC");
                                  $no = 1;
                                  while($data1    = $result1->fetch_row()){
                                   $id_guru1      = $data1[0];
                                   $nip1          = $data1[1];
                                   $nama1         = $data1[2];
                                ?>
                                <option value="<?php echo $id_guru1;?>"><?php echo $nip1." - ".$nama1?></option>
                                <?php
                                  }
                                ?>
                              </select>
                            </div> 
                            <?php
                              if (!empty($id_guru)){
                            ?>
                            <div class="col-sm-3">
                                  <a href="?mod=laporan&pg=laporan_guru"> 
                                  <button type="button" class="btn btn-danger"><i class="fa fa-spin fa-refresh"></i> Bersih</button>
                                  </a> 
                              
                            </div>
                            <?php
                              }
                            ?> 
                        </div>
 
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-2 col-sm-9">
                              <button type="submit" class="btn btn-info "><i class="fa fa-search"></i> Cari</button>

                              <a href="cetak/excel_kpi.php?id_guru=<?php echo $id_guru?>" target="_blank">
                              <button type="button" class="btn btn-success "><i class="fa fa-file-excel-o"></i> Excel</button>
                              </a> 

                            </div>
                        </div>
                        <br>
                        <div class="alert alert-warning" id="MessageNotSent">
                        * catatan = untuk mencetak perguru, silahkan pilih nama terlebih dahulu, kemudian tekan tombol cari dan klik tombol cetak 
                        </div>
                    </form>
                    <div class="box-body table-responsive"> 
                        <table id="laporan_kpi" class="table table-striped table-bordered" style="font-size: 11px">
                              <thead>
                                  <tr>
                                    <th width="5%">No</th> 
                                    <th width="7%">NIP</th> 
                                    <th width="22%">Nama</th>   
                                    <th width="18%">Skor Akhir</th>     
                                    <th width="10%">Aksi</th>    
                                  </tr>
                              </thead> 
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- End Row -->



</div>

