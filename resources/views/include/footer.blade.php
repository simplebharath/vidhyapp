<div id="shortcut">
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<script src="{{ URL::asset('assets/js/app.config.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script> 
<script src="{{ URL::asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/notification/SmartNotification.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/smartwidgets/jarvis.widget.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/fastclick/fastclick.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/speech/voicecommand.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/smart-chat-ui/smart.chat.ui.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/smart-chat-ui/smart.chat.manager.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/extensions/export/bootstrap-table-export.js"></script>
<script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="{{ URL::asset('assets/js/bootstsrap_table/ga.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.datetimepicker.full.js') }}"></script>
<link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        pageSetUp();
    })

</script>

<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/tableExport.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/jquery.base64.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/html2canvas.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/jspdf/libs/sprintf.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/jspdf/jspdf.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/tableExport/jspdf/libs/base64.js') }}"></script>
<script src="{{ URL::asset('assets/js/html5lightbox/html5lightbox.js') }}"></script>

<script src="{{ URL::asset('assets/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/superbox/superbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/chartjs/chart.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugin/fullcalendar/jquery.fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/my_js/datatables.js') }}"></script>
<script src="{{ URL::asset('assets/js/my_js/student_fee.js') }}"></script>
<script src="{{ URL::asset('assets/js/my_js/all_js.js') }}"></script>
<script src="{{ URL::asset('assets/js/my_js/migration.js') }}"></script>


<script>
    $(function () {
        $('.datepicker').datepicker('setDate', new Date());

    });
    $(function () {
        $('.datepicker1').datepicker({
        });

    });
    $(function () {
        $('#timepicker').timepicker();
        showInputs: false;
    });
    $(function () {
        $('#timepicker1').timepicker();
        showInputs: false;
    });
    $(function () {
        $('#timepicker2').timepicker();
        showInputs: false;
    });
    $(function () {
        $('#timepicker3').timepicker();
        showInputs: false;
    });
    $(function () {
        $('#timepicker4').timepicker();
        showInputs: false;
    });
    $(function () {
        $('#timepicker5').timepicker();
        showInputs: false;
    });
    $(function () {
        $('.datetimepicker').datetimepicker();

    });

</script>
<script>
    $(document).on("change", "#academic_year_session", function () {
    var academic_year_id = $(this).val();
    var url='academic-year-session';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#token').val()
        }
    });
    $.ajax({
        url: url,
        type: 'POST',
        data: { 'academic_year_id': academic_year_id},
        dataType: 'JSON',
        success: function (data) {
            if (data) {
                top.location.href="admin-dashboard";
               // window.location.reload();
              } else {
                alert('Some thing went wrong.Please, try again!');
            }
        }
    });
    });
</script>
<script>
    $(document).on("change", "#startdate", function () {
    var attendance_date = $(this).val();
  //alert(attendance_date);
    var url='change-date-session';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#_token').val()
        }
    });
    $.ajax({
        url: url,
        type: 'POST',
        data: { 'startdate': attendance_date},
        dataType: 'JSON',
        success: function (data) {
            //alert(data);
            if (data) {
               // alert('success');
                //location.reload();
                //window.stop();
                // top.location.href="admin-dashboard";
              } else {
                alert('Some thing went wrong.Please, try again!');
            }
        }
    });
    });
</script>

</body>

</html>
