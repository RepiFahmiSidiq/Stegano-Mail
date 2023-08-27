<?php 
  $id_guru          = $_GET['id_guru'];
  $result           = $mysqli->query("SELECT a.* 
                      FROM tbl_guru a 
                      WHERE a.id_guru=$id_guru");
  $data             = $result->fetch_assoc();   
  $nip              = $data['nip'];
  $nama             = $data['nama'];  
?>
<div class="wraper container-fluid">
  <div class="page-title"> 
      <h3 class="title"><i class="fa fa-home"></i> <?php echo strtoupper('data penilaian KPI') ?></h3> 
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <a href="./">
                  <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                  </a>

                  <a href="?mod=kpi&pg=data_kpi">
                  <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data kpi</button>
                  </a>
                  
                  
              </div>
              
          </div>
      </div>
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading"> 
                 <a href="?mod=laporan&pg=laporan_kpi">
                 <button class="btn btn-success"> <i class="fa fa-arrow-left"></i> <span><?php echo strtoupper('kembali') ?></span> </button>
                 </a> 
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                   

                      <table  class="table table-striped" style="font-size: 11px">
                        <thead>
                            <tr> 
                              <th width="10%">NIP</th>   
                              <th width="10%">: <?php echo $nip?></th>   
                            </tr>
                            <tr> 
                              <th>Nama</th>   
                              <th>: <?php echo $nama?></th>   
                            </tr>
                        </thead>
                 
                         
                    </table>
                      <div class="box-body table-responsive">

                          <table id="data_kpi" class="table table-striped table-bordered" style="font-size: 11px">
                              <thead>
                                  <tr>
                                    <th width="5%">No</th> 
                                    <th width="10%">Nama Kriteria</th> 
                                    <th width="20%">KPI</th>   
                                    <th width="10%">Bobot</th>    
                                    <th width="10%">Target</th>    
                                    <th width="10%">Nilai</th>  
                                    <th width="10%">Skor</th>  
                                    <th width="10%">Skor Akhir</th>  
                                    <th width="15%">Aksi</th>  
                                  </tr>
                              </thead>
                              <tfoot> 
                              <tr> 
                                <th colspan="7" style="text-align: right">TOTAL SKOR AKHIR</th> 
                                <th id="total_skor" style="text-align: center;background-color: #0f486f;color:white;font-size: 14px"></th>
                                <th></th> 
                              </tr> 
                            </tfoot>
                               
                          </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
  </div> <!-- End Row -->

  

</div>

