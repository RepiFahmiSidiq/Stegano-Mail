        
<!-- Footer Start -->
<br>
<br>
<br>
<footer class="footer">
  2023 © Repi Fahmi Sidiq
</footer>
<!-- Footer Ends -->



</section>
<!-- Main Content Ends -->


<!-- js placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="../assets/back-end/js/jquery.js"></script> 
<script type="text/javascript" src="../assets/back-end/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="../assets/back-end/js/ajax.js"></script> 
<script type="text/javascript" src="../assets/back-end/js/highcharts.js"></script>
<script type="text/javascript" src="../assets/back-end/js/data.js"></script>
<script type="text/javascript" src="../assets/back-end/js/drilldown.js"></script>
<script type="text/javascript" src="../assets/back-end/js/exporting.js"></script>  
 

  <script>

    $(document).ready(function(){ 
  //umum
  $('#datatable').dataTable();
});            



    $(function(){ 

      $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
      }).on('changeDate', function(e){
        $(this).datepicker('hide');
      });

      $('#datepicker1').datepicker({
        format: 'yyyy-mm-dd',
      }).on('changeDate', function(e){
        $(this).datepicker('hide');
      });

      $('#datepicker2').datepicker({
        format: 'yyyy-mm-dd',
      }).on('changeDate', function(e){
        $(this).datepicker('hide');
      });

    });

    jQuery(document).ready(function(){ 
      $('.wysihtml5').wysihtml5();

      $('.summernote').summernote({
        height: 200,                 // set editor height

        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor

        focus: true                 // set focus to editable area after initializing summernote
      });

    });


    /* ==============================================
    Counter Up
    =============================================== */
    jQuery(document).ready(function($) {
    $('.counter').counterUp({
      delay: 100,
      time: 1200
    });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){

    $("#startdate").datepicker({
      todayBtn:  1,
      autoclose: true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      $('#enddate').datepicker('setStartDate', minDate);
      $(this).datepicker('hide');
    });

    $("#enddate").datepicker()
    .on('changeDate', function (selected) {
      var maxDate = new Date(selected.date.valueOf());
      $('#startdate').datepicker('setEndDate', maxDate);
      $(this).datepicker('hide');
    });

    });
</script>
<script src="../assets/back-end/js/modernizr.min.js"></script>
<script src="../assets/back-end/js/pace.min.js"></script>
<script src="../assets/back-end/js/wow.min.js"></script>
<script src="../assets/back-end/js/jquery.scrollTo.min.js"></script>
<script src="../assets/back-end/js/jquery.nicescroll.js" type="text/javascript"></script>

<script src="../assets/back-end/assets/chat/moment-2.2.1.js"></script>

<script src="../assets/back-end/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="../assets/back-end/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>

<script src="../assets/back-end/assets/timepicker/bootstrap-datepicker.js"></script>
<script src="../assets/back-end/assets/summernote/summernote.min.js"></script>

<!-- Counter-up -->
<script src="../assets/back-end/js/waypoints.min.js" type="text/javascript"></script>
<script src="../assets/back-end/js/jquery.counterup.min.js" type="text/javascript"></script>

<!-- EASY PIE CHART JS -->
<script src="../assets/back-end/assets/easypie-chart/easypiechart.min.js"></script>
<script src="../assets/back-end/assets/easypie-chart/jquery.easypiechart.min.js"></script>
<script src="../assets/back-end/assets/easypie-chart/example.js"></script>


<!--C3 Chart-->
<script src="../assets/back-end/assets/c3-chart/d3.v3.min.js"></script>
<script src="../assets/back-end/assets/c3-chart/c3.js"></script>

<!--Morris Chart-->
<script src="../assets/back-end/assets/morris/morris.min.js"></script>
<script src="../assets/back-end/assets/morris/raphael.min.js"></script>

<!-- sparkline --> 
<script src="../assets/back-end/assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="../assets/back-end/assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

<!-- sweet alerts -->
<script src="../assets/back-end/assets/sweet-alert/sweet-alert.min.js"></script>
<script src="../assets/back-end/assets/sweet-alert/sweet-alert.init.js"></script>
<script src="../assets/back-end/assets/select2/select2.min.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() { 
      // Select2
      jQuery(".select2").select2({
        width: '100%'
      });
    });
  </script>
  <script src="../assets/back-end/js/jquery.app.js"></script>

  <script src="../assets/back-end/assets/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/back-end/assets/datatables/dataTables.bootstrap.js"></script>
  <!-- Chat -->
  <script src="../assets/back-end/js/jquery.chat.js"></script>
  <!-- Dashboard -->
  <script src="../assets/back-end/js/jquery.dashboard.js"></script>

  <!-- Todo -->
  <script src="../assets/back-end/js/jquery.todo.js"></script>

  <script src="../assets/back-end/assets/nestable/jquery.nestable.js"></script>
  <script src="../assets/back-end/assets/nestable/nestable.js"></script>



</body>

<!-- Mirrored from coderthemes.com/velonic/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Oct 2015 06:31:53 GMT -->
</html>
