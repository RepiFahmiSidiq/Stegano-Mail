<script type="text/javascript">

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'GRAFIK PENDATAPAN TAHUN 2019'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Pendapatan'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:,.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>Total Pendapatan {point.y:.0f}</b> of total<br/>'
    },

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
          <?php  
          /*
              $bulan = $_POST['bulan'];
              $tahun = $_POST['tahun'];
              if (empty($tahun)){
                $cari = ' AND MONTH(tbl_transaksi.tgl_transaksi)=07
                          AND YEAR(tbl_transaksi.tgl_transaksi)=2019';
              } else {
                $cari = " AND MONTH(tbl_transaksi.tgl_transaksi)='".$bulan."'
                          AND YEAR(tbl_transaksi.tgl_transaksi)='".$tahun."'
                        ";
              }
            */
              $sql = "SELECT MONTH(c.`tgl_jurnalkgn`), 
                      SUM(d.jumlah_kredit)
                      FROM tbl_akunkgn a,tbl_subkgn b,tbl_jurnalkgn c,tbl_bbkgn d
                      WHERE a.`id_akunkgn`=b.`id_akunkgn`
                      AND b.`id_subkgn`=d.`id_subkgn`
                      AND d.`no_bukti`=c.`no_bukti`
                      AND a.`lap_keuangan`='Laba'
                      AND YEAR(c.tgl_jurnalkgn)=2019
                      GROUP BY MONTH(c.`tgl_jurnalkgn`) ";
              
              $query = $mysqli->query($sql);
              while( $data = $query->fetch_row()){
                      
                $bulan         = $data[0]; 
                if ($bulan==1){
                  $nama_bulan = 'Januari';
                }
                else if ($bulan==2){
                  $nama_bulan = 'Februari';
                } else if ($bulan==3){
                  $nama_bulan = 'Maret';
                } else if ($bulan==4){
                  $nama_bulan = 'April';
                } else if ($bulan==5){
                  $nama_bulan = 'Mei';
                } else if ($bulan==6){
                  $nama_bulan = 'Juni';
                } else if ($bulan==7){
                  $nama_bulan = 'Juli';
                } else if ($bulan==8){
                  $nama_bulan = 'Agustus';
                } else if ($bulan==9){
                  $nama_bulan = 'September';
                } else if ($bulan==10){
                  $nama_bulan = 'Oktober';
                } else if ($bulan==11){
                  $nama_bulan = 'November';
                } else {
                  $nama_bulan = 'Desember';
                } 
                $jumlah_debet     = $data[1];
            ?>
            {
              name: '<?php echo $nama_bulan; ?>',
              y: <?php echo $jumlah_debet; ?>,
              drilldown: '<?php echo $nama_bulan; ?>'
            }, 

          <?php } ?>]
      }],
      
  });
    </script>

