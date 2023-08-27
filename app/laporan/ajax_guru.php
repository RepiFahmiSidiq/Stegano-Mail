<?php
  @$id_guru = $_POST['id_guru'];
?> 
<script type="text/javascript">
  //SELURUH PERbulankgn
$(document).ready(function(){

    $('#laporan_guru').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'laporan/json_guru.php?id_guru=<?php echo $id_guru?>'
        },
        'order':[0,'desc'],
        'columns': [   
            { data: 'id_guru' },     
            { data: 'nip' },     
            { data: 'nama' },     
            { data: 'tempat_lahir' },       
            { data: 'jk' },     
            { data: 'agama' },     
            { data: 'kewarganegaraan' },     
            { data: 'alamat' },     
            { data: 'no_hp' },        
        ],
        'aLengthMenu': [[10, 25, 50, 100, 2000], [10, 25, 50, 100, "All"]], 

    }); 
});
</script>