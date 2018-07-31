@include('include.session')
                
<html lang="en-us" id="extr-page">
    <head>
        <meta charset="utf-8">
        <title> Vidhyapp</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-production-plugins.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-production.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-skins.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/your_style.css') }}" />
        <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ URL::asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <link rel="apple-touch-icon" href="{{ URL::asset('assets/img/splash/sptouch-icon-iphone.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets/img/splash/touch-icon-ipad.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('assets/img/splash/touch-icon-iphone-retina.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('assets/img/splash/touch-icon-ipad-retina.png') }}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)') }}">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)') }}">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)') }}">
    </head>
<style>
    .btn-group {
        white-space: nowrap;

    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
foreach ($students as $student) {
    $student_id = $student->student_id;
}
?>
<script src="{{ URL::asset('assets/js/student_details_script.js') }}"></script>
<script type="text/javascript">

$(document).ready(function () {

    $('#exam').on('change', function () {
        var data1 = document.getElementById("exam").value;
        var student_id = '<?php echo $student_id; ?>';

        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get_exam_subjects',
            data: {'data1': data1, 'student_id': student_id},
            dataType: 'json',
            success: function (data, status) {
                console.log(data);
                var option = "";

                for (i = 0; i < data.length; i++) {
                    option += "<div class='form-group'><label class='col-sm-3 control-label no-padding-right'>" + data[i].subject_name + "</label><div class='col-sm-9'><input type=text max=100 class='col-xs-10 col-sm-5 col-md-9 col-lg-9'  name=subject[" + data[i].subject_id + "_" + data[i].exam_class_subject_id + "] placeholder=max_marks" + data[i].max_marks + "></div></div>";
                }
                $('#subject').html(option);
            }
        });
    });

});
function tution_fee(button_id) {
    var id = button_id.split("/");
    var student_id = id[0];
    var fee_id = id[1];
//    alert("student_id"+student_id);
//    alert("fee_id"+fee_id);
    $.ajax({
        type: 'GET',
        url: '/payment_details',
        data: {'student_id': student_id, 'fee_id': fee_id},
        dataType: 'json',
        success: function (data, status) {
            var option = "";
            console.log(data);
            console.log(data[0].fee_title);
            var due_amount = data[0].fee_amount - data[0].payed_amount;
            console.log(due_amount);

            //var assignment_id=data[i].assignment_id; 
            $('#payment_add_div').html("");
            option += "<div class='form-group' style=margin-left:150px;>\n\
                         <label class='col-md-3  no-padding-right'>Fee Name:</label>\n\
                         <div class=''><input type=text  class='' id=" + data[0].fee_id + "  name=fee_title value=" + data[0].fee_title + " ></div>\n\
\n\                      <label class='col-md-3  no-padding-right'>Fee Type:</label>\n\
                         <div class=''><input type=text  class='' id=" + data[0].fee_type_id + "  name=fee_type_id value=" + data[0].fee_name + " ></div>\n\
                         <label class=' col-md-3  no-padding-right'>Total Amount:</label>\n\
                         <div class=''><input type=text  class=''  name=total_amount value=" + data[0].fee_amount + " ></div>\n\
                         <label class='col-md-3  no-padding-right'>Payed Amount:</label>\n\
                         <div class=''><input type=text max=100 class=''  name=payed_amount value=" + data[0].payed_amount + " ></div>\n\
\n\                      <label class='col-md-3  no-padding-right'>Due Amount:</label>\n\
                         <div class=''><input type=text max=100 class=''  name=due_amount  value=" + due_amount + "></div>\n\
\n\                      <label class='col-md-3  no-padding-right'>Amount to Pay:</label>\n\
                         <div class=''><input type=text max=100 class=''  name=amount ></div>\n\
                         </div>";

            $('#payment_add_div').append(option);
            $('#payment_details_div').hide();
            $('#do_payment_form').show();
        },
        error: function (data) {

        }

    });
}
function bus_fee(button_id) {
    var id = button_id.split("/");
    var student_id = id[0];
    var fee_id = id[1];
//    alert("student_id"+student_id);
//    alert("fee_id"+fee_id);
    $.ajax({
        type: 'GET',
        url: '/busfee_payment_details',
        data: {'student_id': student_id, 'fee_id': fee_id},
        dataType: 'json',
        success: function (data, status) {
            var option = "";
            console.log(data);
            console.log(data[0].fee_title);
            var due_amount = data[0].fee_amount - data[0].payed_amount;
            console.log(due_amount);

            //var assignment_id=data[i].assignment_id; 
            $('#payment_add_div').html("");
            option += "<div class='form-group' style=margin-left:150px;>\n\
                         <label class='col-md-3 no-padding-right'>Fee Name</label>\n\
                         <div class=''><input type=text  class='' id=" + data[0].fee_id + "  name=fee_title value=" + data[0].fee_title + " ></div>\n\
\n\                      <label class='col-md-3  no-padding-right'>Fee Type:</label>\n\
                         <div class=''><input type=text  class='' id=" + data[0].fee_type_id + "  name=fee_type_id value=" + data[0].fee_name + " ></div>\n\
                         <label class='col-md-3 no-padding-right'>Total Amount</label>\n\
                         <div class=''><input type=text  class=''  name=total_amount value=" + data[0].fee_amount + " ></div>\n\
                         <label class='col-md-3 no-padding-right'>Payed Amount</label>\n\
                         <div class=''><input type=text max=100 class=''  name=payed_amount value=" + data[0].payed_amount + " ></div>\n\
\n\                       <label class='col-md-3 no-padding-right'>Due Amount</label>\n\
                         <div class=''><input type=text max=100 class=''  name=due_amount  value=" + due_amount + "></div>\n\
\n\                       <label class='col-md-3 no-padding-right'>Amount to Pay</label>\n\
                         <div class=''><input type=text max=100 class=''  name=amount ></div>\n\
                         </div>";

            $('#payment_add_div').append(option);
            $('#payment_details_div').hide();
            $('#do_payment_form').show();
        },
        error: function (data) {

        }

    });
}
function others_fee(button_id) {
    var id = button_id.split("/");
    var student_id = id[0];
    var fee_id = id[1];
//    alert("student_id"+student_id);
//    alert("fee_id"+fee_id);
    $.ajax({
        type: 'GET',
        url: '/others_payment_details',
        data: {'student_id': student_id, 'fee_id': fee_id},
        dataType: 'json',
        success: function (data, status) {
            var option = "";
            console.log(data);
            console.log(data[0].fee_title);
            var due_amount = data[0].fee_amount - data[0].payed_amount;
            console.log(due_amount);

            //var assignment_id=data[i].assignment_id;
            $('#payment_add_div').html("");
            option += "<div class='form-group' style=margin-left:150px;>\n\
                         <label class='col-md-3  no-padding-right'>Fee Name</label>\n\
                         <div class=''><input type=text  class='' id=" + data[0].fee_id + "  name=fee_title value=" + data[0].fee_title + " ></div>\n\
                         <label class='col-md-3  no-padding-right'>Fee Type:</label>\n\
                         <div class=''><input type=text  class='' id=" + data[0].fee_type_id + "  name=fee_type_id value=" + data[0].fee_name + " ></div>\n\                         \n\
                         <label class=' col-md-3 no-padding-right'>Total Amount</label>\n\
                         <div class=''><input type=text  class=''  name=total_amount value=" + data[0].fee_amount + " ></div>\n\
                         <label class=' col-md-3 no-padding-right'>Payed Amount</label>\n\
                         <div class=''><input type=text max=100 class=''  name=payed_amount value=" + data[0].payed_amount + " ></div>\n\
\n\                       <label class=' col-md-3 no-padding-right'>Due Amount</label>\n\
                         <div class=''><input type=text max=100 class=''  name=due_amount  value=" + due_amount + "></div>\n\
\n\                       <label class=' col-md-3 no-padding-right'>Amount to Pay</label>\n\
                         <div class=''><input type=text max=100 class=''  name=amount ></div>\n\
                         </div>";

            $('#payment_add_div').append(option);
            $('#payment_details_div').hide();
            $('#do_payment_form').show();
        },
        error: function (data) {

        }

    });
}
function payment_history_print()
{
    var divToPrint = document.getElementById("print_basic_table");
    var divToPrint1 = document.getElementById("payment_history_table");
    $('table').css("border", "1px solid #000");
    $('table').css("border-collapse", "collapse");
    $('td').css("border", "1px solid #000");
    $('th').css("border", "1px solid #000");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write(divToPrint1.outerHTML);
    newWin.print();
    newWin.close();
}
function marks_print()
{
    var divToPrint = document.getElementById("print_basic_table");
    var divToPrint1 = document.getElementById("marks_table");
    $('table').css("border", "1px solid #000");
    $('table').css("border-collapse", "collapse");
    $('td').css("border", "1px solid #000");
    $('th').css("border", "1px solid #000");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write(divToPrint1.outerHTML);
    newWin.print();
    newWin.close();
}

function marks_search_print()
{
    var divToPrint = document.getElementById("print_basic_table");
    var divToPrint1 = document.getElementById("marks_search_table");
    $('table').css("border", "1px solid #000");
    $('table').css("border-collapse", "collapse");
    $('td').css("border", "1px solid #000");
    $('th').css("border", "1px solid #000");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write(divToPrint1.outerHTML);
    newWin.print();
    newWin.close();
}
function attendance_print()
{
    var divToPrint = document.getElementById("print_basic_table");
    var divToPrint1 = document.getElementById("attendance_table");
    $('table').css("border", "1px solid #000");
    $('table').css("border-collapse", "collapse");
    $('td').css("border", "1px solid #000");
    $('th').css("border", "1px solid #000");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write(divToPrint1.outerHTML);
    newWin.print();
    newWin.close();
}
function attendance_search_print()
{
    var divToPrint = document.getElementById("print_basic_table");
    var divToPrint1 = document.getElementById("attendance_search_table");
    $('table').css("border", "1px solid #000");
    $('table').css("border-collapse", "collapse");
    $('td').css("border", "1px solid #000");
    $('th').css("border", "1px solid #000");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write(divToPrint1.outerHTML);
    newWin.print();
    newWin.close();
}
'<?php foreach ($students as $student) { ?>';
    student_id = '<?php echo $student->student_id; ?>';
    '<?php } ?>';



$(document).ready(function () {
    $('#marks_search').on('change', function () {
        var exam_id = document.getElementById("marks_search").value;
        console.log("exam_id" + exam_id);
        $.ajax({
            type: 'GET',
            url: '/marks_search/' + student_id,
            data: {'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                console.log("marks_search" + data);
                var trHTML = '';
                var max_marks_total = 0;
                var obtained_marks_total = 0;
                $('#marks_search_table tbody').html("");
                for (i = 0; i < data.length; i++) {
                    trHTML += '<tr><td>' + data[i].exam_title + '</td><td>' + data[i].subject_name + '</td><td>' + data[i].max_marks + '</td>\n\
                               <td>' + data[i].marks_obtained + '</td><td>' + data[i].marks_obtained / data[i].max_marks * 100 + '%</td>\n\
                               <td>' + data[i].grade_value + '</td></tr>';
                    max_marks_total += parseInt(data[i].max_marks);
                    obtained_marks_total += parseInt(data[i].marks_obtained);
                }
                var percentage = obtained_marks_total / max_marks_total * 100;
                var grade;
                $.ajax({
                    type: 'GET',
                    url: '/marks_total_grade',
                    data: {'percentage': percentage},
                    dataType: 'json',
                    success: function (data, status) {
                        console.log("grade" + data);
                        grade = data[0].grade_value;
                        trHTML += '<tr><td colspan=2><b>Grand Total </b></td><td><b>' + max_marks_total + '</b></td>\n\
                               <td><b>' + obtained_marks_total + '</b></td><td><b>' + obtained_marks_total / max_marks_total * 100 + '%</b></td>\n\
                               <td><b>' + grade + '</b></td></tr>';
                                   $('#marks_search_table tbody').append(trHTML);
                $('#marks_div').hide();
                $('#marks_search_div').show();
                     }
                });
               }
        });
    });
    $('#marks_search1').on('change', function () {
        var exam_id = document.getElementById("marks_search1").value;
        //alert(exam_id);
        //var grade='';
        console.log("exam_id" + exam_id);
        $.ajax({
            type: 'GET',
            url: '/marks_search/' + student_id,
            data: {'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                console.log("marks_search" + data);
                var trHTML = '';
                var max_marks_total = 0;
                var obtained_marks_total = 0;
                $('#marks_search_table tbody').html("");
                for (i = 0; i < data.length; i++) {
                    trHTML += '<tr><td>' + data[i].exam_title + '</td><td>' + data[i].subject_name + '</td><td>' + data[i].max_marks + '</td>\n\
                               <td>' + data[i].marks_obtained + '</td><td>' + data[i].marks_obtained / data[i].max_marks * 100 + '%</td>\n\
                               <td>' + data[i].grade_value + '</td></tr>';
                    max_marks_total += parseInt(data[i].max_marks);
                    obtained_marks_total += parseInt(data[i].marks_obtained);
                }
                var percentage = obtained_marks_total / max_marks_total * 100;
                var grade;
                $.ajax({
                    type: 'GET',
                    url: '/marks_total_grade',
                    data: {'percentage': percentage},
                    dataType: 'json',
                    success: function (data, status) {
                        console.log("grade" + data);
                        grade = data[0].grade_value;
                        trHTML += '<tr><td colspan=2><b>Grand Total </b></td><td><b>' + max_marks_total + '</b></td>\n\
                               <td><b>' + obtained_marks_total + '</b></td><td><b>' + obtained_marks_total / max_marks_total * 100 + '%</b></td>\n\
                               <td><b>' + grade + '</b></td></tr>';
                                   $('#marks_search_table tbody').append(trHTML);
                $('#marks_div').hide();
                $('#marks_search_div').show();
                     }
                });
               }
        });
    });
});

</script>
<div id="main" role="main" >
    <!-- RIBBON -->
    
    <div id="content">
        <div class="navbar">
            <ul class="nav nav-tabs" id="student_profile_nav">
                <li class="active"><a href="javascript:;" id="student_details" >Profile</a></li>
                <li ><a href="javascript:;" id="parent_details" >Parent</a></li>
                <li ><a href="javascript:;" id="upload_documents" >Documents</a></li>
                <li ><a href="javascript:;" id="view_marks" >Marks</a></li>
                <li > <a href="javascript:;" data-value="{{ $student_id }}" id="view_attendance" >Attendance</a></li>
                <li ><a href="javascript:;" id="remarks" >Remarks</a></li>
                <li ><a href="javascript:;" id="student_fee" >Fees</a></li>
                <li ><a href="javascript:;" id="payment_details" >Payments</a></li>
                <li ><a href="javascript:;" id="payment_history" >Payment-History</a></li>
                <li ><a href="javascript:;" id="view_transport_details" >Transport</a></li>
                <li ><a href="{{url('view_students')}}">View Students</a></li>
                <li ><a href="{{ url('add_student') }}">Add Student</a></li>
            </ul>
        </div> 
        <div class="row">

            <!--            <div class="" style="margin-left:27px">
            
                            <button id="student_details" class="btn btn-primary btn-xs">Profile</button>
                            <button id="parent_details" class="btn btn-primary btn-xs">Parent</button>
                            <button id="upload_documents" class="btn btn-primary btn-xs">Documents</button>
                            <button id="view_marks" class="btn btn-primary btn-xs">Marks</button>
                            <button id="view_attendance" class="btn btn-primary btn-xs">Attendance</button>
                            <button id="remarks" class="btn btn-primary btn-xs">Remarks</button>
                            <button id="student_fee" class="btn btn-primary btn-xs">Fees</button>
                            <button id="payment_details" class="btn btn-primary btn-xs">Payments</button>
                            <button id="view_transport_details" class="btn btn-primary btn-xs">Transport</button>
                            <a href="{{url('view_students')}}"><button class="btn btn-primary btn-xs">Students List</button></a>
            
            
                        </div><br>-->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!--Student Profile  -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  toppad" id="student_details_div">
                    @if(Session::has('edit_student_message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('edit_student_message') }}
                    </div>
                    @endif
                    {{ Session::forget('edit_student_message') }}
                    <?php foreach ($students as $student) { ?>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $student->first_name . " " . $student->last_name; ?>
                                    <a href="{{ url('download_pdf/'.$student_id) }}" class="btn btn-primary btn-sm active pull-right" role="button">Download</a>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class=" " align="left|top"> <img src='{{ asset('uploads/student/'.$student->profile_pic) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/2016-09-23-15-04-17-icon1.jpg') }}'"  height="90" width="90" class="img-rounded img-responsive"> </div>
                                <button id="edit_student"  class="btn btn-xs btn-primary pull-right "><i class="ace-icon fa fa-pencil"></i>Edit</button>

                                <div class="row">

                                    <div class="  "> 
                                        <table class="table table-user-information">
                                            <tr><td>Student Name:  </td> <td style="color:blueviolet"><?php echo $student->first_name . " " . $student->last_name; ?></td></tr>
                                            <tr><td>Admission Number:   </td> <td style="color:blueviolet"><?php echo $student->admission_number; ?></td></tr>
                                            <tr><td>Class:   </td> <td style="color:blueviolet"><?php echo $student->class_name; ?></td></tr>
                                            <tr><td>Section:   </td> <td style="color:blueviolet"><?php echo $student->section_name; ?></td></tr>
                                            <tr><td>Roll Number:   </td> <td style="color:blueviolet"><?php echo $student->roll_number; ?></td></tr>
                                            <tr><td>Email Id:   </td> <td style="color:blueviolet"><?php echo $student->email_id; ?></td></tr>
                                            <tr><td>Date OF Birth:   </td> <td style="color:blueviolet"><?php echo $student->date_of_birth; ?></td></tr>
                                            <tr><td>Gender:   </td> <td style="color:blueviolet"><?php echo $student->gender; ?></td></tr>
                                            <tr><td>Contact Number:   </td> <td style="color:blueviolet"><?php echo $student->contact_number; ?></td></tr>
                                            <tr><td>Emergency Number:   </td> <td style="color:blueviolet"><?php echo $student->emergency_number; ?> </td></tr>
                                            <tr><td>Aadhar Number:   </td> <td style="color:blueviolet"><?php echo $student->aadhar_number; ?></td></tr>
                                            <tr><td>Identity Marks:   </td> <td style="color:blueviolet"><?php echo $student->identity_marks; ?></td></tr>
                                            <tr><td>Created By:   </td> <td style="color:blueviolet"><?php echo $student->user_name; ?></td></tr>
                                        </table>
                                    </div
                                </div>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8  toppad" >
                <div id="edit_student_div">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Profile</h3><br>
                        </div>
                        <div id="edit_student_validation_errors" style="color: red;">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 "> 
                                    <!--edit student content starts from here -->
                                    <div class="widget-body no-padding"><br>
                                        <div class="row">
                                            <?php foreach ($students as $student) { ?>
                                                <div class="">
                                                    <form  class="form-horizontal" id="edit_student_form_sumbit" role="form" method="POST" enctype="multipart/form-data" action="{{ url('edit_student/'.$student->student_id) }}">
                                                        {{ csrf_field() }}
                                                        <fieldset>
                                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"  id="form-field-1" placeholder="" name="first_name" value="{{ $student->first_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('first_name') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"  id="form-field-1" placeholder="" name="last_name" value="{{ $student->last_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('last_name') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="email"  id="form-field-1" placeholder="" name="email_id" value="{{ $student->email_id }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('email_id') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="tel" pattern="^\d{2}\d{4}\d{4}$"  id="form-field-1" placeholder="" name="contact_number" value="{{ $student->contact_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('contact_number') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Emergency Number<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="tel" pattern="^\d{2}\d{4}\d{4}$"  id="form-field-1" placeholder="" name="emergency_number" value="{{ $student->emergency_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('emergency_number') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date Of Birth<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"  id="form-field-1" placeholder="" name="date_of_birth" value="{{ $student->date_of_birth }}" class="datepicker col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('date_of_birth') }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Identification Marks</label>
                                                                    <div class="col-sm-9">
                                                                        <textarea cols="22" class="custom-scroll" placeholder="" name="identity_marks" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>{{ $student->identity_marks }}</textarea>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('identity_marks') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Profile Picture</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="file"  id="form-field-1"  name="profile_pic"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                                    </div>
                                                                    <img src='{{ asset('uploads/student/'.$student->profile_pic) }}' class="img-rounded" height="50" width="50"/>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('profile_pic') }}
                                                                    </div>
                                                                </div>



                                                            </div>

                                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <textarea cols="22" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>{{ $student->address }}</textarea>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('address') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Admission Number<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"  id="form-field-1" placeholder="" name="admission_number" value="{{ $student->admission_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('admission_number') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Academic Year</label>
                                                                    <div class="col-sm-9">
                                                                        <select  name="academic_year"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" disabled>

                                                                            <option value=""><?php echo $student->from_date . "-" . $student->to_date; ?></option>


                                                                        </select> 
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('academic_year') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class</label>
                                                                    <div class="col-sm-9">
                                                                        <select  aria-required="true" name="class" id="class"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" disabled>
                                                                            <option value=""><?php echo $student->class_name; ?></option>
                                                                        </select> 
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('class') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Section</label>
                                                                    <div class="col-sm-9">
                                                                        <select   name="section" id="section" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  disabled>
                                                                            <option value=""><?php echo $student->section_name; ?></option>
                                                                        </select>  
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('section') }}
                                                                    </div>
                                                                </div>
                                                                <!--                                                            <div class="form-group">
                                                                                                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Type<span class="error">* </span></label>
                                                                                                                                <div class="col-sm-9">
                                                                                                                                    <select   name="user_type" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" disabled>
                                                                
                                                                                                                                        <option value=""><?php echo $student->title; ?></option>
                                                                                                                                    </select> 
                                                                                                                                </div>
                                                                                                                                <div style="color: red;">
                                                                                                                                    {{ $errors->first('user_type') }}
                                                                                                                                </div>
                                                                                                                            </div>-->
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Roll Number<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"  id="form-field-1" placeholder="" name="roll_number" value="{{ $student->roll_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('roll_number') }}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date Of Joining<span class="error">* </span></label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text"  id="form-field-1" placeholder="" name="date_of_joining" value="{{ $student->date_of_joining }}" class="datepicker col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                                    </div>
                                                                    <div style="color: red;">
                                                                        {{ $errors->first('date_of_joining') }}
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-offset-5 col-md-9 col-lg-6 col-sm-12" >
                                                                <button class="btn btn-info" type="submit" name="submit">
                                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                                    Save
                                                                </button><div class="col-md-offset-1 col-md-9 col-lg-1 col-sm-1"></div>
                                                                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
                                                                <button class="btn btn-info" type="reset">
                                                                    <i class="fa fa-times bigger-110"></i>
                                                                    Cancel
                                                                </button>
                                                            </div></div>

                                                    </fieldset>    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--edit student content ends from here -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Parents-div-->
                <div class="" id="add_parent_details_div">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                            <h2>Add Parent</h2>
                        </header>
                        <div id="add_parent_validation_error" style="color: red;">
                        </div>
                        <div classs="">
                            <div class="widget-body no-padding"><br>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <?php foreach ($students as $student) { ?>
                                            <form  class="form-horizontal" id="form_sumbit" role="form" method="POST" enctype="multipart/form-data" name="myform" action="{{ url('add_parent_details/'.$student->student_id) }}">
                                                <!-- {{ Form::open( array('class'=>'form-horizontal', 'method'=>'POST','id'=>'form_sumbit', 'files' => true, 'name' =>'myform')) }}-->
                                            <?php } ?>
                                            {{ csrf_field() }}
                                            <fieldset>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="first_name" value="{{ old('first_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('first_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="last_name" value="{{ old('last_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('last_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="user_name" value="{{ old('user_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('user_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="email_id" value="{{ old('email_id') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('email_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Password<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="password"  id="form-field-1" placeholder="" name="password" value="{{ old('password') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Confirm Password<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="password"  id="form-field-1" placeholder="" name="password_confirmation" value="{{ old('password_confirmation') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('password_confirmation') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="tel" pattern="^\d{2}\d{4}\d{4}$"   id="form-field-1" placeholder="" name="contact_number" value="{{ old('contact_number') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('contact_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="tel" pattern="^\d{2}\d{4}\d{4}$"   id="form-field-1" placeholder="" name="emergency_number" value="{{ old('emergency_number') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('emergency_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Occupation <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="occupation" value="{{ old('occupation') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('occupation') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Profile Picture</label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="profile_pic"  name="profile_pic" value="{{ old('profile_pic') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('profile_pic') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="25" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>{{ old('address') }}</textarea>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('address') }}
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="form-group">
                                                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select UserType<span class="error">* </span></label>
                                                                                                            <div class="col-sm-9">
                                                                                                                <select   name="user_type" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>
                                                                                                                    <option value="">Select UserType</option> 
                                                    <?php foreach ($user_types as $user_type) { ?>
                                                                                                                                                <option value="<?php echo $user_type->user_type_id; ?>" @if (old('user_type') == $user_type->user_type_id) selected="selected" @endif><?php echo $user_type->title; ?></option>
                                                    <?php } ?>
                                                    
                                                                                                                </select> 
                                                                                                            </div>
                                                                                                            <div style="color: red;">
                                                                                                                {{ $errors->first('user_type') }}
                                                                                                            </div>
                                                                                                        </div>-->



                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-offset-5 col-md-9 col-lg-6 col-sm-12" >
                                                        <button  class="btn btn-info" type="submit" name="submit" value="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Save
                                                        </button><div class="col-md-offset-1 col-md-9 col-lg-1 col-sm-1"></div>
                                                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
                                                        <button class="btn btn-info" type="reset">
                                                            <i class="fa fa-times bigger-110"></i>
                                                            Cancel
                                                        </button>
                                                    </div></div>

                                            </fieldset>    
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="" id="parent_details_div">
                    <div class="panel panel-info">
                        @if(Session::has('add_parent_message'))
                        <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Success!</strong> {{ Session::get('add_parent_message') }}
                        </div>
                        @endif
                        {{ Session::forget('add_parent_message') }}
                        @if(Session::has('edit_parent_message'))
                        <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Success!</strong> {{ Session::get('edit_parent_message') }}
                        </div>
                        @endif
                        {{ Session::forget('edit_parent_message') }}
                        <div class="panel-heading">
                            <h3 class="panel-title">Parent Profile</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php if (count($parents) <= 0) { ?>

                                    <p>Parent Details are not at added Please add by below button</p>
                                    <div class="" align="right" style="margin-right: 30px">
                                        <button id="add_parent_details_button" align="right" class="btn btn-xs btn-primary"></i>Add</button></div>
                                    <?php
                                } else {
                                    foreach ($parents as $parent) {
                                        ?>
                                        <div class="" align="right" style="margin-right: 30px">
                                            <button id="edit_parent" align="right" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-pencil"></i>Edit</button></div>
                                        <div class=" " align="left|top" > <img src='{{ asset('uploads/parent/'.$parent->profile_pic) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/2016-09-23-15-04-17-icon1.jpg') }}'"  height="75" width="75" class="img-rounded img-responsive">

                                        </div>
                                        <div class="  "> 
                                            <table class="table table-user-information">
                                                <tr><td>Name:  </td> <td style="color:blueviolet"><?php echo $parent->first_name . " " . $parent->last_name; ?></td></tr>
                                                <tr><td>Email Id:   </td> <td style="color:blueviolet"><?php echo $parent->email_id; ?></td></tr>
                                                <tr><td>Occupation:   </td> <td style="color:blueviolet"><?php echo $parent->occupation; ?></td></tr>
                                                <tr><td>Contact Number:   </td> <td style="color:blueviolet"><?php echo $parent->contact_number; ?></td></tr>
                                                <tr><td>Emergency Number:   </td> <td style="color:blueviolet"><?php echo $parent->emergency_number; ?> </td></tr>
                                                <tr><td>Address:   </td> <td style="color:blueviolet"><?php echo $parent->address; ?></td></tr>
                                            </table>
                                        </div
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3"></div>
                    </div>

                </div>
            </div>
            <div class="" id="edit_parent_div">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                        <h2>Edit Parent</h2>
                    </header>
                    <div>
                        <div id="edit_parent_errors" style="color: red;">
                        </div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?php foreach ($parents as $parent) { ?>
                                        <form  class="form-horizontal" id="edit_parent_form_submit" role="form" method="POST" enctype="multipart/form-data" action="{{ url('edit_parent/'.$parent->parent_id) }}">
                                            {{ csrf_field() }}
                                            <?php
                                            $result = json_encode($user_types, true);
                                            $new_array = array();
                                            foreach ($user_types as $usertype) {
                                                $new_array[] = $usertype->title;
                                            }
                                            array_unshift($new_array, "Select UserType");
                                            array_unshift($new_array, "Select UserType");
                                            ?>
                                            <fieldset>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="first_name" value="{{ $parent->first_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('first_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="last_name" value="{{ $parent->last_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('last_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="email_id" value="{{ $parent->email_id }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('email_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="tel" pattern="^\d{2}\d{4}\d{4}$"  id="form-field-1" placeholder="" name="contact_number" value="{{ $parent->contact_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('contact_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile Number<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="tel" pattern="^\d{2}\d{4}\d{4}$" id="form-field-1" placeholder="" name="emergency_number" value="{{ $parent->emergency_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('emergency_number') }}
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Occupation<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="occupation" value="{{ $parent->occupation }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('occupation') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Profile Picture</label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="form-field-1"  name="profile_pic" value="" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                        </div>
                                                        <img src='{{ asset('uploads/parent/'.$parent->profile_pic) }}' class="img-rounded" height="50" width="50"/>
                                                        <div style="color: red;">
                                                            {{ $errors->first('profile_pic') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="25" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>{{ $parent->address }}</textarea>
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('address') }}
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="form-group">
                                                                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select UserType<span class="error">* </span></label>
                                                                                                            <div class="col-sm-9">
                                                    <?php $type = $parent->user_type_id; ?>
                                                                                                                {{ Form::select('user_type', $new_array, $type, ['class' => 'col-xs-10 col-sm-5 col-md-9 col-lg-9']) }}
                                                                                                            </div>
                                                                                                            <div style="color: red;">
                                                                                                                {{ $errors->first('user_type') }}
                                                                                                            </div>
                                                                                                        </div>-->
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-5 col-md-9 col-lg-6 col-sm-12" >
                                                    <button class="btn btn-info" type="submit" name="submit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Save
                                                    </button><div class="col-md-offset-1 col-md-9 col-lg-1 col-sm-1"></div>
                                                    <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
                                                    <button class="btn btn-info" type="reset">
                                                        <i class="fa fa-times bigger-110"></i>
                                                        Cancel
                                                    </button>
                                                </div></div>

                                        </fieldset>    
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Upload Documents      -->
            <div id="upload_documents_div" style="dispaly:none;">
                <div class="panel panel-info">
                    @if(Session::has('documents_upload'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('documents_upload') }}
                    </div>
                    @endif
                    {{ Session::forget('documents_upload') }}

                    @if(Session::has('delete_student_document_message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('delete_student_document_message') }}
                    </div>
                    @endif
                    {{ Session::forget('delete_student_document_message') }}

                    <div class="panel-heading">
                        <h3 class="panel-title">Uploaded Documents</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php if (count($documents) <= 0) { ?>

                                <p class="text-align-center">No Documents Available.To upload click on the Upload Button.</p>
                                <div class="form-group pull-right">
                                    <button id="upload_documents_button" name="" class= "btn btn-primary">Upload</button>
                                </div>
                            <?php } else {
                                ?>
                                <div class=" col-md-12 "> 
                                    <div class="form-group pull-right">
                                        <button id="upload_documents_button" name="" class=" btn btn-primary">Upload</button>
                                    </div>
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th data-sortable="true" class="col-md-1" >Document</th>
                                                <th data-sortable="true" class="col-md-1" >Created On</th>
                                                <th class="col-md-2" >Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($documents as $document) {
                                                 $newDate = date("d-m-Y H:i:s", strtotime($document->created_at));
                                                ?> 

                                                <tr class="">
                                                    <td><a href="{{ asset('uploads/student_uploads/'.$document->document) }}" target="_blank"><img src='{{ asset('uploads/student_uploads/'.$document->document) }}' class="img-rounded" height="75" width="75"/></td>
                                                    <td><?php echo $newDate; ?></td>
                                                    <td><div class="btn-group">
                                                            <button class="btn btn-danger btn-xs document_delete" id="{{ $document->student_upload_id }}" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="return confirm('Are you sure to delete Document?');"><span class="glyphicon glyphicon-trash">     
                                                                </span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody> </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="add_documents_div">
                <div class="panel panel-info">
                    <div class="panel-heading form-inline">
                        <div class="form-group">
                            <h3 class="panel-title">Upload Documents</h3><br>
                        </div>
                        <div class="form-group pull-right">
                            <button id="upload_documents1" name="" class=" btn btn-primary">View</button>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-12 col-lg-12 col-xs-12 col-sm-12 "> 
                                <!--form  uploads Starts form here -->
                                <div class="widget-body no-padding"><br>
                                    <div class="row">
                                        <div class="">
                                            <?php foreach ($students as $student) { ?>
                                                <form  class="form-horizontal" id="add_documents_sumbit" role="form" method="POST" enctype="multipart/form-data" action="{{ url('student_upload_documents'.'/'.$student->student_id) }}">
                                                    {{ csrf_field() }} <?php } ?>
                                                <fieldset>
                                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload1</label>
                                                            <div class="col-sm-9">
                                                                <input type="file"  id="form-field-1"  name="upload1" value="{{ old('upload1') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                            </div>
                                                            <div style="color: red;">
                                                                {{ $errors->first('upload1') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload2</label>
                                                            <div class="col-sm-9">
                                                                <input type="file"  id="form-field-1"  name="upload2" value="{{ old('upload2') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                            </div>
                                                            <div style="color: red;">
                                                                {{ $errors->first('upload2') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload3</label>
                                                            <div class="col-sm-9">
                                                                <input type="file"  id="form-field-1"  name="upload3" value="{{ old('upload3') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                            </div>
                                                            <div style="color: red;">
                                                                {{ $errors->first('upload3') }}
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload4</label>
                                                            <div class="col-sm-9">
                                                                <input type="file"  id="form-field-1"  name="upload4" value="{{ old('upload4') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                            </div>
                                                            <div style="color: red;">
                                                                {{ $errors->first('upload4') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload5</label>
                                                            <div class="col-sm-9">
                                                                <input type="file"  id="form-field-1"  name="upload5" value="{{ old('upload5') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                            </div>
                                                            <div style="color: red;">
                                                                {{ $errors->first('upload5') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload6</label>
                                                            <div class="col-sm-9">
                                                                <input type="file"  id="form-field-1"  name="upload6" value="{{ old('upload6') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                            </div>
                                                            <div style="color: red;">
                                                                {{ $errors->first('upload6') }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </fieldset>
                                                <div class="form-group">
                                                    <div class="col-md-offset-5 col-md-9 col-lg-6 col-sm-12" >
                                                        <button class="btn btn-info" type="submit" name="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Save
                                                        </button><div class="col-md-offset-1 col-md-9 col-lg-1 col-sm-1"></div>
                                                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
                                                        <button class="btn btn-info" type="reset">
                                                            <i class="fa fa-times bigger-110"></i>
                                                            Cancel
                                                        </button>
                                                    </div></div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!--form uploads Ends form here -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Remarks Div   -->               
            <div id="remarks_div">
                <div class="panel panel-info">

                    @if(Session::has('add_student_remarks_message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('add_student_remarks_message') }}
                    </div>
                    @endif
                    {{ Session::forget('add_student_remarks_message') }}

                    @if(Session::has('delete_student_remark'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('delete_student_remark') }}
                    </div>
                    @endif
                    {{ Session::forget('delete_student_remark') }}

                    <div class="panel-heading">
                        <h3 class="panel-title">View Remarks</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php if (count($remarks) <= 0) { ?>

                                <p>No Remarks For This Student</p>
                                <div class="" align="right" style="margin-right: 30px">
                                    <button id="add_remarks_button" align="right" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-plus"></i>Add</button></div>
                            <?php } else {
                                ?>
                                <div class=" col-md-12 col-lg-12 "> 
                                    <div class="" align="right" style="margin-right: 30px">
                                        <button id="add_remarks_button" align="right" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-plus"></i>Add</button></div>
                                    <table class="table ">
                                        <thead class="">
                                            <tr>
                                                <th data-sortable="true" class="col-md-3" >Title</th>
                                                <th data-sortable="true" class="col-md-6" >Description</th>
                                                <th class="col-md-2" >Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($remarks as $remark) {
                                                ?> 

                                                <tr class="">
                                                    <td><?php echo $remark->remark_title; ?></td>
                                                    <td><?php echo $remark->remark_description; ?></td>
                                                    <td><div class="btn-group">
                                                           <!-- <a href="{{ url('student_remarks_delete/'.$remark->student_remarks_id) }} " onclick="return confirm('Are you sure to delete Remark?');"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>-->

                                                            <button class="btn btn-danger btn-xs remark_delete" id="{{ $remark->student_remarks_id }}" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="return confirm('Are you sure to delete Remark?');"><span class="glyphicon glyphicon-trash">     
                                                                </span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody> </table>
                            </div>
                        </div>
                    </div></div></div>
            <div id="add_remarks_div">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Student Remarks</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="  "> 
                                <?php foreach ($students as $student) { ?>
                                    <form  class="form-horizontal" id="form_remarks_add" role="form" method="POST" action="{{ url('student_remarks/'.$student->student_id) }}">
                                        {{ csrf_field() }}
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Remark Title <span class="error">* </span></label>

                                        <div class="col-sm-9">
                                            <input type="text"  id="form-field-1" placeholder="" name="remark_title" class="col-sm-9" required/>
                                        </div>
                                        <div style="color: red;">
                                            {{ $errors->first('remark_title') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Remark Description<span class="error">* </span></label>

                                        <div class="col-sm-9">
                                            <textarea name="remark_description" maxlength="160" wrap="soft" rows="6" class="col-sm-9" required/></textarea>
                                        </div>
                                        <div style="color: red;">
                                            {{ $errors->first('remark_description') }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                            <button class="btn btn-info" type="submit" name="submit">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                Submit
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">

                                            <button class="btn btn-info" type="reset" name="">
                                                <i class="ace-icon fa fa-times bigger-110"></i>
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form> 


                            </div>

                        </div>
                        <!-- end widget div -->

                    </div>

                </div>
            </div>
            <!-- Marks-div -->               
            <div id="marks_div">
                <div class="panel panel-info">

                    @if(Session::has('add_student_marks_message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('add_student_marks_message') }}
                    </div>
                    @endif
                    {{ Session::forget('add_student_marks_message') }}

                    <div class="panel-heading">
                        <h3 class="panel-title">View Marks</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Exam:</label>
                            <div class="col-sm-6">
                                <select required aria-required="true" name="marks_search" id="marks_search"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                    <option value="">Select ExamType</option>
                                    <?php foreach ($exams as $exam) { ?>
                                        <option value="<?php echo $exam->exam_id; ?>"><?php echo $exam->exam_title; ?></option>
                                    <?php } ?>
                                </select> 
                            </div>

                        </div>

                        <div class="row">
                            <?php if (count($marks) <= 0) { ?>

                                <p>No Marks Added</p>
                                <div class="" align="right" style="margin-right: 30px">
                                    <button id="add_marks_button" align="right" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-plus"></i>Add</button></div>
                            <?php } else {
                                ?>
                                <div class="  "> 
                                    <div class="" align="right" style="margin-right: 30px">
                                        <button id="add_marks_button" align="right" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-plus"></i>Add</button>
                                        <a href="#" onclick="marks_print()"><button class="btn btn-xs btn-primary"> <i class="ace-icon fa fa-print"></i>&nbsp;Print</button></a></div><br>
                                    <table id="marks_table"data-toggle="table" class="col-md-12" 
                                           data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" >

                                        <thead class="">
                                            <tr>
                                                <th data-sortable="true" class="col-md-3" >Exam</th>
                                                <th data-sortable="true" class="col-md-6" >Subject</th>
                                                <th data-sortable="true" class="col-md-6" >Max.Marks</th>
                                                <th data-sortable="true" class="col-md-6" >Marks Obtained</th>
                                                <th data-sortable="true" class="col-md-6" >Percentage</th>
                                                <th data-sortable="true" class="col-md-6" >Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($marks as $mark) {
                                                ?> 

                                                <tr class="">
                                                    <td><?php echo $mark->exam_title; ?></td>
                                                    <td><?php echo $mark->subject_name; ?></td>
                                                    <td><?php echo $mark->max_marks; ?></td>
                                                    <td><?php echo $mark->marks_obtained; ?></td>
                                                    <td><?php echo $percentage = $mark->marks_obtained / $mark->max_marks * 100; ?>%</td>
                                                    <td><?php echo $mark->grade_value; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody> </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="add_marks_div">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                        <h2>Add Marks</h2>
                    </header>
                    <div classs="add_parent_errors">
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-horizontal col-xs-12">
                                    <form  class="form-horizontal" id="add_marks_form_submit" role="form" method="POST" action="{{ url('add_marks/'.$student_id) }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Exam<span class="error">* </span></label>
                                            <div class="col-sm-9">
                                                <select required aria-required="true" name="exam" id="exam"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                    <option value="">Select Exam Type</option>
                                                    <?php foreach ($exams as $exam) { ?>
                                                        <option value="<?php echo $exam->exam_id; ?>"><?php echo $exam->exam_title; ?></option>
                                                    <?php } ?>
                                                </select> 
                                            </div>
                                            <div style="color: red;">
                                                {{ $errors->first('exam') }}
                                            </div>
                                        </div>


                                        <div id="subject">


                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Comment <span class="error">* </span></label>
                                            <div  class="col-sm-9">
                                                <input type="text" name="comment" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required></input>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                <button class="btn btn-info" type="submit" name="submit" id="btnsubmit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Submit
                                                </button>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">

                                                <button class="btn btn-info" type="reset" name="">
                                                    <i class="ace-icon fa fa-times bigger-110"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  Attendance-div  -->
            <div id="view_attendance_div">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">View Attendance</h3>
                    </div><br>
                    <a href="#" onclick="attendance_print()"><button class="btn btn-xs btn-primary top-right pull-right"> <i class="ace-icon fa fa-print"></i>&nbsp;Print</button></a>
                    <form method="POST" id="attendance_search" action="{{ url('attendance_date_search/'.$student_id)}}">
                        <label for="from">From</label>
                        <input type="text" id="from" name="from" class="datepicker1" value="<?php
                        if (null !== (filter_input(INPUT_POST, 'submit'))) {
                            echo '';
                        }
                        ?>" >                
                        <label for="to">to</label>
                        <input type="text" id="to" name="to" class="datepicker" value="<?php
                        if (null !== (filter_input(INPUT_POST, 'submit'))) {
                            echo '';
                        }
                        ?>" >
                        <span style="color: red;">

                        </span>
                        <button class="btn btn-info btn-sm" type="submit" name="submit">
                            <i class="fa fa-eye"></i> View

                        </button>
                        <div style="color: red;">
                            {{ $errors->first('from') }} <br> {{ $errors->first('to') }}
                        </div>

                    </form>

                    <div class="panel-body">

                        <div class="row">
                            <div class="  "> 
                                <table id="attendance_table"data-toggle="table" class="" 
                                       data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle">

                                    <thead>
                                        <tr>
                                            <?php foreach ($attendance_settings as $attendance_setting) { ?>
                                                <?php if ($attendance_setting->attendance_type_id == 2) { ?>
                                                    <th data-sortable="true"  >Subject</th>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <th data-sortable="true"  >Date</th>
                                            <th data-sortable="true"  >Day</th>
                                            <th data-sortable="true"  >Attendance</th>
                                            <th data-sortable="true"  >Reason</th>
                                            <th data-sortable="true"  >Attendance Taken By</th>



                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody> </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fees-div  -->
            <div  id="student_fee_div">
                <div class="panel panel-info">
                    @if(Session::has('add_student_fee_message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('add_student_fee_message') }}
                    </div>
                    @endif
                    {{ Session::forget('add_student_fee_message') }}

                    <div class="panel-heading">
                        <h3 class="panel-title">Fee Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="  "> 
                                <div class="" align="right" style="margin-right: 30px">
                                    <button id="fee_add_button" align="right" class="btn btn-xs btn-primary"><i class="ace-icon fa fa-plus"></i>Add</button></div>
                                <table class="table table-user-information">
                                    <?php foreach ($fee_class as $fee_classes) { ?>
                                        <tr><td>{{ $fee_classes->fee_title }}  </td> <td>{{ $fee_classes->fee_amount }}</td></tr>
                                    <?php } ?>
                                    <?php foreach ($bus_fees as $bus_fee) { ?>
                                        <tr><td>{{ $bus_fee->fee_title }}  </td> <td>{{ $bus_fee->bus_fee_amount }}</td></tr>
                                    <?php } ?>
                                    <?php foreach ($other_fees as $other_fee) { ?>
                                        <tr><td>Others  </td> <td>{{ $other_fee->fee_amount }}</td></tr>
                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3"></div>
                </div>

            </div>
            <div id="fee_add_div">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Add Fee-to-Student</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php foreach ($students as $student) { ?>
                                            <form  class="form-horizontal" id="fee_form_submit" role="form" method="POST" action="{{ url('add_student_fee/'.$student->student_id) }}">
                                            <?php } ?>
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="fee" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  required>
                                                        <option value="">--Select Fee--</option>
                                                        <?php foreach ($fees as $fee) { ?>
                                                            <option value="<?php echo $fee->fee_id; ?>"><?php echo $fee->fee_title; ?></option>
                                                        <?php } ?>

                                                    </select> 
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('fee') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="fee_type" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  required>
                                                        <option value="">--Select Fee-type--</option>
                                                        <?php foreach ($fee_types as $fee_type) { ?>
                                                            <option value="<?php echo $fee_type->fee_type_id; ?>"><?php echo $fee_type->fee_name; ?></option>
                                                        <?php } ?>

                                                    </select> 
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('fee_type') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Amount<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <input type="text"  id="form-field-1" placeholder="" name="fee_amount" value="{{ old('fee_amount') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('fee_amount') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <textarea  id="form-field-1" placeholder="" name="fee_description" value="" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>{{ old('fee_amount') }}</textarea>
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('fee_description') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                    <button class="btn btn-info" type="submit" name="submit" id="btnsubmit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Submit
                                                    </button>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">

                                                    <button class="btn btn-info" type="reset" name="">
                                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Payments -->
            <div  id="payment_details_div">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Payments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            foreach ($tution_fees as $tution_fee) {
                                
                            }
                            ?>
                            <?php
                            foreach ($bus_fees1 as $bus_fee) {
                                $bus_total_fee = $bus_fee->bus_fee_amount;
                                $bus_payed_amount = $bus_fee->payed_amount;
                                $bus_due_amount = $bus_total_fee - $bus_payed_amount;
                            }
                            ?>
                            <?php
                            foreach ($other_fees1 as $other_fee) {
                                $other_fee_total = $other_fee->fee_amount;
                                $other_fee_payed = $other_fee->payed_amount;
                                $other_due_amount = $other_fee_total - $other_fee_payed;
                            }
                            ?>
                            <div class="  "> 
                                <table class="table table-user-information table-condensed table-striped bordered"> 
                                    <tr><th>Fees</th><th>Fee-Type</th><th>Total</th><th>Paid</th><th>Due</th><th>Paid Status</th><th>Actions</th></tr>
                                    <?php
                                    foreach ($tution_fees as $tution_fee) {
                                        $total_fee = $tution_fee->fee_amount;
                                        $payed_amount = $tution_fee->payed_amount;
                                        $due_amount = $total_fee - $payed_amount;
                                        ?>   
                                        <tr><td><?php echo $tution_fee->fee_title; ?>   </td>
                                            <td>{{ $tution_fee->fee_name }}</td>
                                            <td><?php echo $tution_fee->fee_amount; ?></td>
                                            <td><?php echo $tution_fee->payed_amount; ?></td>

                                            <td><?php echo $due_amount; ?></td>
                                            <td><?php
                                                if ($due_amount <= 0) {
                                                    echo "Total Paid";
                                                } elseif ($payed_amount == 0) {
                                                    echo "Not Paid";
                                                } elseif ($total_fee != $payed_amount && $total_fee != $due_amount) {
                                                    echo "Partially Paid";
                                                }
                                                ?></td>
                                            <td><button class=" btn btn-success btn-xs" name="tution_fee" onclick="tution_fee(this.id)" id="{{ $student_id.'/' }}{{$tution_fee->fee_id}}">Do Payment</button></a></td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach ($bus_fees1 as $bus_fee) { ?>  
                                        <tr><td>Bus Fee:   </td> 
                                            <td>{{ $bus_fee->fee_name }}</td>
                                            <td><?php echo $bus_fee->bus_fee_amount; ?></td>
                                            <td><?php echo $bus_fee->payed_amount; ?></td>
                                            <td><?php echo $bus_due_amount; ?></td>
                                            <td><?php
                                                if ($bus_due_amount <= 0) {
                                                    echo "Total Paid";
                                                } elseif ($payed_amount == '') {
                                                    echo "Not Paid";
                                                } elseif ($total_fee != $payed_amount && $total_fee != $bus_due_amount) {
                                                    echo "Partially Paid";
                                                }
                                                ?></td>
                                            <td><button class="btn btn-success btn-xs" onclick="bus_fee(this.id)" id="{{ $student_id.'/' }}{{$bus_fee->fee_id}}">Do Payment</button></a></td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach ($other_fees1 as $other_fee) { ?> 
                                        <tr><td>Other Fees[<?php echo $other_fee->fee_description; ?>]</td>
                                            <td>{{ $other_fee->fee_name }}</td>
                                            <td><?php echo $other_fee->fee_amount; ?></td>
                                            <td><?php echo $other_fee->payed_amount; ?></td>
                                            <td><?php echo $other_due_amount; ?></td>
                                            <td><?php
                                                if ($other_due_amount <= 0) {
                                                    echo "Total Paid";
                                                } elseif ($payed_amount == '') {
                                                    echo "Not Paid";
                                                } elseif ($total_fee != $payed_amount && $total_fee != $other_due_amount) {
                                                    echo "Partially Paid";
                                                }
                                                ?></td>
                                            <td><button class="btn btn-success btn-xs" onclick="others_fee(this.id)" id="{{ $student_id.'/' }}{{$other_fee->fee_id}}">Do Payment</button></a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3"></div>
                </div>

            </div>
            <!-- Transport div -->
            <div id="view_transport_div">
                <div class="panel panel-info">
                    @if(Session::has('add_student_transport_fee_message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('add_student_transport_fee_message') }}
                    </div>
                    @endif
                    {{ Session::forget('add_student_transport_fee_message') }}

                    @if(Session::has('route_update'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> {{ Session::get('route_update') }}
                    </div>
                    @endif
                    {{ Session::forget('route_update') }}

                    <div class="panel-heading">
                        <h3 class="panel-title">Bus Route</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php if (count($bus_route_fees) <= 0) { ?>

                                <p>No Such Routes Assigned.</p>
                                <div class="" align="right" style="margin-right: 30px">
                                    <button id="trasport_details" align="right" class="btn btn-xs btn-primary"></i>Add</button></div>
                                <?php
                            } else {
                                foreach ($bus_route_fees as $bus_route_fee) {
                                    ?>
                                    <div class="  ">
                                        <div class="" align="right" style="margin-right: 30px">
                                            <button id="edit_bus_route_button" align="right" class="btn btn-xs btn-primary"></i>Edit</button></div>

                                        <table class="table table-user-information">
                                            <tr><td>Route:  </td> <td><?php echo $bus_route_fee->route_from . "--" . $bus_route_fee->route_to; ?></td></tr>
                                            <tr><td>Stop:   </td> <td>{{ $bus_route_fee->bus_stop_name }}</td></tr>
                                            <tr><td>PickUp-Time:   </td> <td>{{ $bus_route_fee->pickup_time }}</td></tr>
                                            <tr><td>Drop-Time:   </td> <td>{{ $bus_route_fee->drop_time }}</td></tr>
                                            <tr><td>Fee Type:   </td> <td><?php echo $bus_route_fee->fee_name; ?></td></tr>
                                            <tr><td>Fee Amount:   </td> <td><?php echo $bus_route_fee->bus_fee_amount; ?></td></tr>
                                        </table>
                                    </div
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3"></div>
                </div>

            </div>
        </div>
        <div id="trasport_fee_div">
            <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-editbutton="true">
                <header>
                    <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                    <h2>Add Route-Fee</h2>
                </header>
                <div>
                    <div class="widget-body no-padding"><br>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php foreach ($students as $student) { ?>
                                        <form  class="form-horizontal" id="transport_fee_form_submit" role="form" method="POST" action="{{ url('add_bus_fee/'.$student->student_id) }}">
                                        <?php } ?>
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fees<span class="error">* </span></label>
                                            <div class="col-sm-9">
                                                <select  name="fee" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  >
                                                    <option value="">--Select Fee--</option>
                                                    <?php foreach ($fees1 as $fee) { ?>
                                                        <option value="<?php echo $fee->fee_id; ?>"><?php echo $fee->fee_title; ?></option>
                                                    <?php } ?>

                                                </select> 
                                            </div>
                                            <div style="color: red;">
                                                {{ $errors->first('bus_route_id') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus Route<span class="error">* </span></label>
                                            <div class="col-sm-9">
                                                <select  name="bus_route_fee_id" id="route_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  >
                                                    <option value="">--Select Bus Route--</option>
                                                    <?php foreach ($bus_routes as $bus_route) { ?>
                                                        <option value="<?php echo $bus_route->bus_route_fee_id; ?>"><?php echo $bus_route->route_from . "-- " . $bus_route->route_to; ?></option>
                                                    <?php } ?>

                                                </select> 
                                            </div>
                                            <div style="color: red;">
                                                {{ $errors->first('bus_route_id') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Stop<span class="error">* </span></label>
                                            <div class="col-sm-9">

                                                <select   name="stop_id" id="bus_stop_div" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                    <option> select Stop </option>  
                                                </select>
                                            </div>
                                            <div style="color: red;">
                                                {{ $errors->first('stop_id') }}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                <button class="btn btn-info" type="submit" name="submit" id="btnsubmit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Submit
                                                </button>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">

                                                <button class="btn btn-info" type="reset" name="">
                                                    <i class="ace-icon fa fa-times bigger-110"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div id="edit_bus_route_div">
            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                <header>
                    <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                    <h2>Edit Route-Fee</h2>
                </header>
                <div>
                    <div class="widget-body no-padding"><br>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form  id="transport_edit_form_submit" class="form-horizontal" role="form" method="POST" action="{{ url('student_route_edit/'.$student_id) }}">
                                        {{ csrf_field() }}
                                        <?php
                                        $new_array = array();
                                        foreach ($bus_routes as $route_fee) {
                                            $new_array[] = $route_fee->route_from . "- " . $route_fee->route_to;
                                        }
                                        array_unshift($new_array, "Select Bus Route");

                                        foreach ($bus_route_fees as $bus_route_fee) {
                                            ?>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus Route<span class="error">* </span></label>

                                                <div class="col-sm-9">

                                                    <?php $type = $bus_route_fee->bus_route_fee_id; ?>
                                                    {{ Form::select('bus_route_id', $new_array, $type, ['class' => 'col-xs-10 col-sm-5 col-md-9 col-lg-9','id'=>'bus_route_id']) }}

                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('bus_route_id') }}
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Stop<span class="error">* </span></label>
                                            <div class="col-sm-9">

                                                <select   name="stop_id" id="bus_stop_div1" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                    <option> select Stop </option>  
                                                </select>
                                            </div>
                                            <div style="color: red;">
                                                {{ $errors->first('stop_id') }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                <button class="btn btn-info" type="submit" name="submit" >
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Submit
                                                </button> 
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">

                                                <button class="btn btn-info" type="reset" name="">
                                                    <i class="ace-icon fa fa-times bigger-110"></i>
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="do_payment_form" style="display:none;">
            <article class=" col-sm-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Payment</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-sm-12 ">
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <form   class="form-horizontal" id="do_payment_submit" role="form" method="POST" action="{{ url('do_payment_submit/'.$student_id) }}" >
                                            {{ csrf_field() }}
                                            <div id="payment_add_div">

                                            </div>


                                            <div class="form-group">
                                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"></div>
                                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                    <button class="btn btn-info" type="submit"  name="submit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Submit
                                                    </button>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                                                    <button class="btn btn-info" type="reset" name="">
                                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div></article>
        </div>
        <div id="search_attendance_div" style="display:none;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">View Attendance</h3>
                </div><br>
                <a href="#" onclick="attendance_search_print()"><button class="btn btn-xs btn-primary top-right pull-right"> <i class="ace-icon fa fa-print"></i>&nbsp;Print</button></a>
                <form method="POST" id="attendance_search_form" action="{{ url('attendance_date_search/'.$student_id)}}">
                    <label for="from">From</label>
                    <input type="text" id="from" name="from" class="datepicker1" value="<?php
                    if (null !== (filter_input(INPUT_POST, 'submit'))) {
                        echo '';
                    }
                    ?>" >                
                    <label for="to">to</label>
                    <input type="text" id="to" name="to" class="datepicker1" value="<?php
                    if (null !== (filter_input(INPUT_POST, 'submit'))) {
                        echo '';
                    }
                    ?>" >
                    <span style="color: red;">

                    </span>
                    <button class="btn btn-info btn-sm" type="submit" name="submit">
                        <i class="fa fa-eye"></i> View

                    </button>
                    <div style="color: red;">
                        {{ $errors->first('from') }} <br> {{ $errors->first('to') }}
                    </div>
                </form>
                <div class="panel-body">
                    <div class="row">
                        <div class="  "> 
                            <table id="attendance_search_table" data-toggle="table" class="" 
                                   data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" >

                                <thead>
                                    <tr>
                                        <?php foreach ($attendance_settings as $attendance_setting) { ?>
                                            <?php if ($attendance_setting->attendance_type_id == 2) { ?>
                                                <th data-sortable="true"  >Subject</th>
                                            <?php }
                                        }
                                        ?>
                                        <th data-sortable="true"  >Date</th>
                                        <th data-sortable="true"  >Day</th>
                                        <th data-sortable="true"  >Attendance</th>
                                        <th data-sortable="true"  >Reason</th>
                                        <th data-sortable="true"  >UserName</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody> 

                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="payment_history_div" style="display:none;">
            <div class="panel panel-info">

                @if(Session::has('add_student_marks_message'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{ Session::get('add_student_marks_message') }}
                </div>
                @endif
                {{ Session::forget('add_student_marks_message') }}

                <div class="panel-heading">
                    <h3 class="panel-title">Payment History</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="  "> 
                            <table id="payment_history_table"
                                   data-toggle="table" class="col-md-12 table-striped" 
                                   data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="true" data-search="true" >
                                <a href="#" onclick="payment_history_print()"><img src = '{{ asset('uploads/icons/print.png') }}' width = "24px"> &nbsp;Print</a>
                                <thead class="">
                                    <tr>
                                        <th data-sortable="true" class="" >Receipt No.</th>
                                        <th data-sortable="true" class="" >Amount</th>
                                        <th data-sortable="true" class="" >Fee Name</th>
                                        <th data-sortable="true" class="" >Received By</th>
                                        <th data-sortable="true" class="" >Payment On</th>
                                        <th >Actions</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($payment_history as $history) {
                                        ?> 

                                        <tr class="">
                                            <td><?php echo $history->receipt_no; ?></td>
                                            <td><?php echo $history->payed_amount; ?></td>
                                            <td><?php echo $history->fee_title; ?></td>
                                            <td><?php echo $history->user_name; ?></td>
                                            <td><?php
                                                $newDate = date("d-m-Y", strtotime($history->payed_on));
                                                echo $newDate;
                                                ?></td>
                                            <td><a href="{{ url('payment_receipt_in_report/'.$history->payment_id) }} "><button class="btn btn-success btn-xs">Print-Receipt</button></a></td>

                                        </tr>
                                    <?php }
                                    ?>
                                </tbody> </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="marks_search_div" style="display:none;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">View Marks</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right" for="form-field-1">Exam:</label>
                            <div class="col-sm-6">
                                <select required aria-required="true" name="marks_search1" id="marks_search1"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                    <option value="">Select ExamType</option>
                                    <?php foreach ($exams as $exam) { ?>
                                        <option value="<?php echo $exam->exam_id; ?>"><?php echo $exam->exam_title; ?></option>
                                    <?php } ?>
                                </select> 
                            </div>

                        </div>

                    <div class="row">

                        <div class="  "> 
                            <div class="" align="right" style="margin-right: 30px">
                                <a href="#" onclick="marks_search_print()"><button class="btn btn-xs btn-primary"> <i class="ace-icon fa fa-print"></i>&nbsp;Print</button></a></div><br>
                            <table id="marks_search_table"data-toggle="table" class="col-md-12" 
                                   data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" >

                                <thead class="">
                                    <tr>
                                        <th data-sortable="true" class="col-md-3" >Exam</th>
                                        <th data-sortable="true" class="col-md-6" >Subject</th>
                                        <th data-sortable="true" class="col-md-6" >Max.Marks</th>
                                        <th data-sortable="true" class="col-md-6" >Marks Obtained</th>
                                        <th data-sortable="true" class="col-md-6" >Percentage</th>
                                        <th data-sortable="true" class="col-md-6" >Grade</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody> </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="" id="result">

        </div>
        <div id="print_basic_details" style="display:none;">
<?php foreach ($students as $student) { ?>

                <table id="print_basic_table" class="table table-user-information">
                    <div class=" " align="left|top"> <img src='{{ asset('uploads/student/'.$student->profile_pic) }}'  height="90" width="90" class="img-rounded img-responsive"> </div>
                    <tr><td>Student Name:  </td> <td style="color:blueviolet"><?php echo $student->first_name . " " . $student->last_name; ?></td>
                        <td>Admission Number:   </td> <td style="color:blueviolet"><?php echo $student->admission_number; ?></td></tr>
                    <tr><td>Class-section:   </td> <td style="color:blueviolet"><?php
                            echo $student->class_name . '-' . $student->section_name;
                            ;
                            ?></td>
                        <td>Roll Number:   </td> <td style="color:blueviolet"><?php echo $student->roll_number; ?></td></tr>

                </table>
<?php } ?>
        </div>
    </div>

</div>
</div>
</div>
</div>



 <script src="{{ URL::asset('assets/js/plugin/pace/pace.min.js')}}"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script> if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
    }</script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) {
        document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }</script>
        <script src="{{ URL::asset('assets/js/app.config.js')}}"></script>
        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
                <script src="{{ URL::asset('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script> -->
        <script src="{{ URL::asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>

        <script type="text/javascript"></script>
     </body>
</html>
   
