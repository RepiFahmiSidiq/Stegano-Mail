<script type="text/javascript">
 $(function () {
    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'GRAFIK LABA RUGI TAHUN 2019'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [
          <?php

          
          //LABA             
          $sql_laba = "SELECT SUM(d.jumlah_kredit)
                      FROM tbl_akunkgn a,tbl_subkgn b,tbl_jurnalkgn c,tbl_bbkgn d
                      WHERE a.`id_akunkgn`=b.`id_akunkgn`
                      AND b.`id_subkgn`=d.`id_subkgn`
                      AND d.`no_bukti`=c.`no_bukti`
                      AND a.`lap_keuangan`='Laba'
                      AND YEAR(c.tgl_jurnalkgn)=2019";
              
          $query_laba = $mysqli->query($sql_laba);
          $data_laba  = $query_laba->fetch_row(); 
          $jumlah_laba= $data_laba[0];

          //RUGI             
          $sql_rugi = "SELECT SUM(d.jumlah_debet)
                      FROM tbl_akunkgn a,tbl_subkgn b,tbl_jurnalkgn c,tbl_bbkgn d
                      WHERE a.`id_akunkgn`=b.`id_akunkgn`
                      AND b.`id_subkgn`=d.`id_subkgn`
                      AND d.`no_bukti`=c.`no_bukti`
                      AND a.`lap_keuangan`='Rugi'
                      AND YEAR(c.tgl_jurnalkgn)=2019"; 
          $query_rugi = $mysqli->query($sql_rugi);
          $data_rugi  = $query_rugi->fetch_row(); 
          $jumlah_rugi= $data_rugi[0];
          ?>
                           
              [ 
                  
                  'Laba', <?php echo $jumlah_laba; ?>

              ],
              [ 
                  
                  'Rugi', <?php echo $jumlah_rugi; ?>

              ],
 

               
              ]
        }]
    });
});
</script>