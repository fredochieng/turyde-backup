<!-- js -->
<script src="<?php echo ADMINROOT;?>assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/moment-with-locales.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/pace.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/viewportchecker.js" type="text/javascript"></script> 
<script src="<?php echo ADMINROOT;?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/img-upload.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/scripts.js" type="text/javascript"></script>
<script src="assets/js/daterangepicker.js" type="text/javascript"></script>


<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" type="text/javascript"></script>



        <!--graph js-->
        <?php if($pageName == 'dashboard'){?>
<script src="<?php echo ADMINROOT;?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo ADMINROOT;?>assets/js/exporting.js" type="text/javascript"></script>
        <script src="<?php echo ADMINROOT;?>assets/js/export-data.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            /*--------------------------------
             Last 6 Months Activity :: Start
             --------------------------------*/

            Highcharts.chart('container1', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Downloads'
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Downloads'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} Downloads</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Android',
                        color: '#0d3a61',
                        data: [1340, 1560, 4300, 8854, 5600, 4378, 1340, 1560, 4300, 8854, 5600, 4378, ]
                    }, {
                        name: 'IOS',
                        color: '#2196F3',
                        data: [943, 1232, 543, 2498, 4590, 7609, 454, 1324, 4300, 8854, 5600, 4378, ]
                    }]
            });
        </script>
        <?php } ?>
        <script type="text/javascript">
          $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
        });
        </script>
    </body>
</html>