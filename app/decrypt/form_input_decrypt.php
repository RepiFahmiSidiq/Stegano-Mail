<?php
  @$kode_encrypt   = $_GET['kode_encrypt']; 
  @$jenis_decrypt  = $_GET['jenis_decrypt']; 
  @$key            = $_GET['key']; 
?>
<div class="wraper container-fluid">
    <div class="page-title"> 
        <h3 class="title"><i class="fa fa-plus"></i> <?php echo strtoupper('input decrypt') ?></h3> 
    </div>

    <div class="row">
        <!-- Horizontal form -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="./">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-home"></i> Home</button>
                    </a>

                    <a href="?mod=decrypt&pg=data_decrypt">
                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Data decrypt</button>
                    </a>

                    <button type="button" class="btn btn-primary m-b-5"><i class="fa fa-hand-o-down"></i> Input decrypt</button> 
                    
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    Decrypt
                    </h3>
                </div>
                <div class="panel-body">
                    <span class="block-title-2"> 
                    <?php 
                        @$act = $_GET['act'];
                        if ($act=='ts'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Tipe file hanya berupa jpg dan jpeg
                      </div>
                      <?php 
                      } else if ($act=='uk'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        ukuran file lebih dari 20 MB
                      </div>
                      <?php 
                      } else if ($act=='ukm'){
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        ukuran file minimal 1 MB
                      </div>
                      <?php 
                      } else if ($act=='db'){
                      ?>
                      <div class="alert alert-success" id="MessageNotSent">
                         Data berhasil didecrypt 
                      </div>
                      <?php 
                      } else if ($act=='dg') {
                      ?>
                      <div class="alert alert-danger" id="MessageNotSent">
                        Kode encrypt tidak ditemukan
                      </div>
                    <?php } ?>
                    </span>
                    <form class="form-horizontal" name="form1" method="POST" enctype="multipart/form-data" action="decrypt/simpan_decrypt.php" >
                    <input type="hidden" name="id_user" value="<?php echo $id_user?>">    
                        <div class="form-group"> 
                            <label for="inputPassword3" class="col-sm-3 control-label">Jenis Decrypt</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="jenis_decrypt" id="jenis_decrypt" required="" onChange="check();">
                                <?php 
                                  if (empty($jenis_decrypt)){
                                    echo "<option value=''>--Pilih--</option>";
                                  } else {
                                    echo "<option value='$jenis_decrypt'>$jenis_decrypt</option>";
                                  }
                                ?>
                                <option value="File">File</option>
                                <option value="Ciphertext">Ciphertext</option> 
                              </select>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Kode Encrypt</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="kode_encrypt" value="<?php echo $kode_encrypt?>" required="" autofocus>
                            </div>
                        </div> 
                        
                        <div class="form-group" id="ciphertext" visible="false" style="display: none;">
                            <label for="inputPassword3" class="col-sm-3 control-label">Ciphertext : </label>
                            <div class="col-sm-9">
                              <textarea class="form-control" placeholder="Kode Ciphertext" style="height: 200px" name="ciphertext"></textarea>  
                            </div>
                        </div>

                        <div class="form-group" id="file" visible="false" style="display: none;">
                            <label for="inputPassword3" class="col-sm-3 control-label">File (jpg/jpeg)</label>
                            <div class="col-sm-9">
                              <input type="file" class="form-control" name="file" value=""  >
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-info"><i class="fa fa-unlock"></i> Decrypt</button>
                              <button type="reset" class="btn btn-info"><i class="fa fa-edit"></i> Bersih</button> 
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    Hasil Decrypt
                    </h3>
                </div>
                <div class="panel-body">
                    <?php 
                      $result = $mysqli->query("SELECT *
                                FROM tbl_decrypt 
                                WHERE kode_encrypt='$key'
                                ORDER BY id_decrypt DESC
                                LIMIT 1"); 
                      $data   = $result->fetch_array();
                      $id_decrypt   = $data['id_decrypt'];
                      $jenis_decrypt= $data['jenis_decrypt'];
                      $kode_encrypt = $data['kode_encrypt'];
                      $plaintext    = $data['plaintext'];  
                    ?> 
                    <form class="form-horizontal">    
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4" style="text-align: right;">Jenis Decrypt : </label>
                            <div class="col-sm-8">
                               <?php echo $jenis_decrypt ?>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4" style="text-align: right;">Kode Encrypt : </label>
                            <div class="col-sm-8">
                               <?php echo $kode_encrypt ?>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Plaintext : </label>
                            <div class="col-sm-8">
                              <textarea class="form-control" placeholder="" style="height: 200px" name="pesan"><?php echo $plaintext?></textarea>  
                            </div>
                        </div>
                           
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    
</div>
<script type="text/javascript">
  function check() {
    var el = document.getElementById("jenis_decrypt");
    var str = el.options[el.selectedIndex].text;
    if(str == "File") {
        show();
    }else {
        hide();
    }

    if(str == "Ciphertext") {
        show2();
    }else {
        hide2();
    }

  }
  function hide(){
      document.getElementById('file').style.display='none';
  }
  function show(){
      document.getElementById('file').style.display='inline';
  }

  function hide2(){
      document.getElementById('ciphertext').style.display='none';
  }
  function show2(){
      document.getElementById('ciphertext').style.display='inline';
  }


</script>