var path = [location.protocol, '//', location.host, location.pathname].join('');
$(document).ready(function () {
    var assignment_id;
    //staff_details       
    $("#staff_details_div").show();
    $("#staff_subject_details_div").hide();
    $("#upload_documents_div").hide();
    $("#view_salary_div").hide();
    $("#staff_details").click(function () {
        $("#staff_details_div").show();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_student_staff_div').hide();
        $('#view_images').hide();
    });
    $("#student_login_nav li a").click(function () {
        $("#student_login_nav li").removeClass("active");
        $(this).parent().addClass("active");
    });
    $("#upload_documents").click(function () {
        $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").show();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_student_staff_div').hide();
        $('#view_images').hide();
    });
    $("#staff_subject_details").click(function () {
        $("#staff_details_div").hide();
        $("#staff_subject_details_div").show();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_student_staff_div').hide();
        $('#view_images').hide();
    });
    $("#view_salary").click(function () {
        $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").show();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_student_staff_div').hide();
        $('#view_images').hide();
    });
    $("#view_events").click(function () {
        $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').show();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_student_staff_div').hide();
        $('#view_images').hide();
    });
    $("#view_albums").click(function () {
        $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').show();
        $('#view_remarks_div').hide();
        $('#view_student_staff_div').hide();
        $('#view_images').hide();
    });
    $('#add_assignment_form').click(function () {
        $('#assignment_view_table').hide();
        $("#assignment_div").show();
    });
//add staff salary
    $('#add_staff_salary_submit').on('submit', function (e) {
        e.preventDefault(e);
        var $form = $(this),
                url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "POST",
            url: url,
            //data: $(this).serialize() + "&profile_pic="+profile_pic,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $("#result").append(data);
            },
            error: function (data) {
                location.href = location.href + "?parameter=add_salary";
            }
        });
    });
//delete salary 
//    $('.add_student_attendance').click(function () {
//        alert('add attendance');
//        //  var document_id = $(this).attr('id');
//        var baseUrl = document.location.origin;
//        $.ajaxSetup(
//                {
//                    headers:
//                            {
//                                'X-CSRF-Token': $('input[name="_token"]').val()
//                            }
//                });
//        $.ajax({
//            type: "GET",
//            url: baseUrl + '/student_attendance_add_by_staff/' + document_id,
//            dataType: 'json',
//            success: function (data) {
//                alert('data' + data);
//            },
//            error: function (data) {
//                location.href = path + "?parameter=salary_delete";
//            }
//        });
//    });
    $('.exam_list_select').on('change', function () {
        var e = document.getElementById("exams_list");
        var selected_value = e.options[e.selectedIndex].value;
        console.log(selected_value);
        alert(selected_value);
        $.ajax({
            type: 'GET',
            url: '/students_list_for_marks',
            data: {'data1': selected_value},
            dataType: 'json',
            success: function (data, status) {
                var trHTML = '';
                $('#marks_add_table tbody').html("");
                $('#marks_add_header').html("");
                for (i = 0; i < data.length; i++) {
                    trHTML += '<tr><td>' + data[i].roll_number + '</td><td>' + data[i].first_name + '</td><td>' + data[i].last_name + '</td>\n\
                               <td>' + data[i].class_name + '</td><td>' + data[i].section_name + '</td><td>' + data[i].subject_name + '</td><td>' + data[i].max_marks + '</td>\n\
                               <td><input type="text" name=obtained_marks[' + data[i].exam_class_subject_id + '_' + data[i].student_id + '] ></td>\n\
                               <td><input type="text" name=comments[' + data[i].exam_class_subject_id + '_' + data[i].student_id + '] ></td></tr>';
                }
                var header='';
                header +='Adding Marks to '+ data[0].class_name +' Class-'+data[0].section_name+' Section-'+data[0].subject_name+' Subject';
                $('#marks_add_header').append(header);
                $('#marks_add_table tbody').append(trHTML);
                $('#exam_select_div').hide();
                $('#students_marks_div').show();
            }
        });
    });
    $('#save_marks').on('submit', function (e) {
        e.preventDefault(e);
        var errorString = '';
        var $form = $(this),
                url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, Response) {
                $('#exam_select_div').hide();
                $('#students_marks_div').hide();
                $("#staff_subject_details_div").show();
            },
            error: function (data, response) {
                $('#exam_select_div').hide();
                $('#students_marks_div').hide();
                $("#staff_subject_details_div").show();
            }
        });
    });
    $('#save_Remark').on('submit', function (e) {
        e.preventDefault(e);
        var errorString = '';
        var $form = $(this),
                url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, Response) {
               view_remarks();
            },
            error: function (data, response) {
                $('#exam_select_div').hide();
                $('#students_marks_div').hide();
                $("#staff_subject_details_div").show();
            }
        });
    });
    $('#save_assignment').on('submit', function (e) {
        e.preventDefault(e);
        var errorString = '';
        var $form = $(this),
                url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, status) {
                 $("#assignment_div").hide();
            var trHTML = '';
            var header='';
            var button='';
            $('#assignment_view_table tbody').html("");
            $('#assignment_view_table tbody').html("");
            $('#view_assignment_header h3').html("");
            $('#add_button').html("");
            for (i = 0; i < data.assignments.length; i++) {
                trHTML += '<tr><td>' + data.assignments[i].class_name + '</td><td>' + data.assignments[i].section_name + '</td><td>' + data.assignments[i].subject_name + '</td>\n\
                              <td>' + data.assignments[i].assignment_title + '</td><td>' + data.assignments[i].assignment_description + '</td><td>' + data.assignments[i].last_date + '</td>\n\
                              <td><button class="btn btn-primary btn-xs edit_assignment" onclick=edit_assignment(this.id) id=' + data.assignments[i].assignment_id + '><span class="glyphicon glyphicon-pencil"></span></button>\n\
                              <button class="btn btn-danger btn-xs" onclick=delete_assignment(this.id) id=' + data.assignments[i].assignment_id + '><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            
            }
            button +='<button class=btn btn-primary btn-xs id='+data.details[0].class_name+'-'+data.details[0].section_name+'-'+data.details[0].subject_name+'-'+data.details[0].class_id+'-'+data.details[0].section_id+'-'+data.details[0].subject_id+'  onclick="add_assignment(this.id)">Add Assignments</button>';
            header +='View Assignments of '+data.details[0].class_name+' Class-'+data.details[0].section_name+' Section-'+data.details[0].subject_name+' Subject';
            $('#add_button').append(button);
            $('#view_assignment_header h3').append(header);
            $('#assignment_view_table tbody').append(trHTML);
            $("#staff_subject_details_div").hide();
            $('#assignment_view_table').show();
            },
            error: function (data, status) {
                alert(data);
            }
        });
    });
    $('#edit_assignment_save').on('submit', function (e) {
        e.preventDefault(e);
        var errorString = '';
        var $form = $(this),
                url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, status) {
                 $("#assignment_div").hide();
            var trHTML = '';
            var header='';
            var button='';
            $('#assignment_view_table tbody').html("");
            $('#assignment_view_table tbody').html("");
            $('#view_assignment_header h3').html("");
            $('#add_button').html("");
            for (i = 0; i < data.assignments.length; i++) {
                trHTML += '<tr><td>' + data.assignments[i].class_name + '</td><td>' + data.assignments[i].section_name + '</td><td>' + data.assignments[i].subject_name + '</td>\n\
                              <td>' + data.assignments[i].assignment_title + '</td><td>' + data.assignments[i].assignment_description + '</td><td>' + data.assignments[i].last_date + '</td>\n\
                              <td><button class="btn btn-primary btn-xs edit_assignment" onclick=edit_assignment(this.id) id=' + data.assignments[i].assignment_id + '><span class="glyphicon glyphicon-pencil"></span></button>\n\
                              <button class="btn btn-danger btn-xs" onclick=delete_assignment(this.id) id=' + data.assignments[i].assignment_id + '><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            
            }
            button +='<button class=btn btn-primary btn-xs id='+data.details[0].class_name+'-'+data.details[0].section_name+'-'+data.details[0].subject_name+'-'+data.details[0].class_id+'-'+data.details[0].section_id+'-'+data.details[0].subject_id+'  onclick="add_assignment(this.id)">Add Assignments</button>';
            header +='View Assignments of '+data.details[0].class_name+' Class-'+data.details[0].section_name+' Section-'+data.details[0].subject_name+' Subject';
            $('#add_button').append(button);
            $('#view_assignment_header h3').append(header);
            $('#assignment_view_table tbody').append(trHTML);
            $("#staff_subject_details_div").hide();
            $("#edit_assignment_div").hide();
            $('#assignment_view_table').show();
            },
            error: function (data, status) {
                alert(data);
            }
        });
    });
    $('#save_attendance').on('submit', function (e) {
        e.preventDefault(e);
        var errorString = '';
        var $form = $(this),
                url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "POST",
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, status) {

                $("#students_attendance_div").hide();
                $("#staff_subject_details_div").show();
            },
            error: function (data, status) {
                $("#students_attendance_div").hide();
                $("#staff_subject_details_div").show();
            }
        });
    });
});
if (window.location.search.indexOf('parameter=delete_document') > -1) {
    jQuery(function () {
        jQuery('#upload_documents').click();
    });
}
if (window.location.search.indexOf('parameter=edit_staff') > -1) {
    jQuery(function () {
        jQuery('#staff_details').click();
    });
}
function add_attendance(id) {
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/student_attendance_add_by_staff/' + id,
        dataType: 'json',
        success: function (data) {
            var trHTML = '';
            $('#attendance_add_table tbody').html("");
            $('#students_attendance_header').html("");
            for (i = 0; i < data.length; i++) {
                trHTML += '<tr><td>' + data[i].roll_number + '</td><td>' + data[i].first_name + '</td><td>' + data[i].last_name + '</td>\n\
                <td>' + data[i].class_name + '</td><td>' + data[i].section_name + '</td><td><input type="radio" checked=checked value=present name=student_attendance[' + data[i].staff_subject_id + '_' + data[i].student_id + '] <?php if (isset($attendance_status) && $gender == present)  ?> </td>\n\
                <td><input type="radio" value=absent name=student_attendance[' + data[i].staff_subject_id + '_' + data[i].student_id + '] <?php if (isset($attendance_status) && $gender == absent) ?>  </td>\n\
                <td><input type="text" name=reason[' + data[i].staff_subject_id + '_' + data[i].student_id + ']></td></tr>';
            }
            var header='';
            header +='Adding Attendance to '+ data[0].class_name +' Class-'+data[0].section_name+' Section';
            $('#students_attendance_header').append(header);
            $('#attendance_add_table tbody').append(trHTML);
            $('#students_attendance_div').show();
            $("#staff_subject_details_div").hide();
        },
        error: function (data) {

        }
    });
}
function add_remark_staff(id) {
    //alert(id);
    var ids = id.split('-');
    var class_id = ids[0];
    var section_id = ids[1];
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/add_remark_staff/' + class_id + '/' + section_id,
        dataType: 'json',
        success: function (data) {
            var trHTML = '';
            var heading='';
            $('#students_list_remark tbody').html("");
            $('#remark_heading h3').html("");
            for (i = 0; i < data.length; i++) {
                trHTML += '<tr><td><img src=' + baseUrl + '/uploads/student/' + data[i].profile_pic + ' class=img-rounded height=75 width=75></td><td>' + data[i].first_name + ' ' + data[i].last_name + '</td>\n\
                <td><input type=hidden name=student_id[] value=' + data[i].student_id + '>' + data[i].admission_number + '</td><td>' + data[i].class_name + '-' + data[i].section_name + '</td><td>' + data[i].roll_number + '</td><td><input type="text" name=remark_title[]> </td>\n\
                <td><textarea rows=3 col=20 name=remark_description[]></textarea></td>\n\
                </tr>';
            }
            heading +='Adding Remarks to '+data[0].class_name+' Class-'+data[0].section_name+' Section Students';
            $('#remark_heading h3').append(heading);
            $('#students_list_remark tbody').append(trHTML);
            $('#student_list_remark_div').show();
            $("#staff_subject_details_div").hide();
        },
        error: function (data) {

        }
    });
}
function add_marks(id) {
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/exams_list/' + id,
        dataType: 'json',
        success: function (data) {
            var option = "";
            $('#exams_list').html("");
            $('#exam_select_header').html("");
            option += "<option value=''>--Select Exam--</option>";
            var header='';
            header +='Adding Marks to '+data.details[0].class_name+' Class-'+data.details[0].section_name+' Section-'+data.details[0].subject_name+' Subject';
            for (i = 0; i < data.exams.length; i++) {
                option += "<option value='" + data.exams[i].exam_class_subject_id + "'>" + data.exams[i].exam_title + "</option>";
            }
            $('#exams_list').append(option);
            $('#exam_select_header').append(header);
            $("#staff_subject_details_div").hide();
            $('#exam_select_div').show();
             $('#view_student_staff_div').hide();
             $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_images').hide();
        },
        error: function (data) {

        }
    });
}
function view_assignments(staff_subject_id) {
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/view_assignments/'+staff_subject_id,
        dataType: 'json',
        success: function (data) {
            $("#assignment_div").hide();
            var trHTML = '';
            var header='';
            var button='';
            $('#assignment_view_table tbody').html("");
            $('#assignment_view_table tbody').html("");
            $('#view_assignment_header h3').html("");
            $('#add_button').html("");
            for (i = 0; i < data.assignments.length; i++) {
                trHTML += '<tr><td>' + data.assignments[i].class_name + '</td><td>' + data.assignments[i].section_name + '</td><td>' + data.assignments[i].subject_name + '</td>\n\
                              <td>' + data.assignments[i].assignment_title + '</td><td>' + data.assignments[i].assignment_description + '</td><td>' + data.assignments[i].last_date + '</td>\n\
                              <td><button class="btn btn-primary btn-xs edit_assignment" onclick=edit_assignment(this.id) id=' + data.assignments[i].assignment_id + '><span class="glyphicon glyphicon-pencil"></span></button>\n\
                              <button class="btn btn-danger btn-xs" onclick=delete_assignment(this.id) id=' + data.assignments[i].assignment_id + '><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            
            }
            button +='<button class=btn btn-primary btn-xs id='+data.details[0].class_name+'-'+data.details[0].section_name+'-'+data.details[0].subject_name+'-'+data.details[0].class_id+'-'+data.details[0].section_id+'-'+data.details[0].subject_id+'  onclick="add_assignment(this.id)">Add Assignments</button>';
            header +='View Assignments of '+data.details[0].class_name+' Class-'+data.details[0].section_name+' Section-'+data.details[0].subject_name+' Subject';
            $('#add_button').append(button);
            $('#view_assignment_header h3').append(header);
            $('#assignment_view_table tbody').append(trHTML);
            $("#staff_subject_details_div").hide();
            $('#assignment_view_table').show();
             $('#view_student_staff_div').hide();
             $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_images').hide();
        },
        error: function (data) {

        }
    });
}
function edit_assignment(id) {
    console.log('inside script of edit assignments' + id);
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/edit_assignment/' + id,
        dataType: 'json',
        success: function (data) {
            var option = "";
            $('#edit_form_div').html("");
            for (i = 0; i < data.length; i++) {
                //var assignment_id=data[i].assignment_id; 
                option += "<div class='form-group' ><label class='col-sm-3 control-label no-padding-right'>Title</label>\n\
                          <div class='col-sm-9 id_div'><input type=text  class='col-xs-10 col-sm-5 col-md-9 col-lg-9'  name=assignment_title value=" + data[i].assignment_title + "></div>\n\
                          <label class='col-sm-3 control-label no-padding-right'>Description</label>\n\
                          <div class='col-sm-9'><textarea cols=43 maxlength=160 class='col-xs-10 col-sm-5 col-md-9 col-lg-9'  name=assignment_description >" + data[i].assignment_description + "</textarea></div>\n\
                          <label class='col-sm-3 control-label no-padding-right'>Last Date</label>\n\
                          <div class='col-sm-9'><input type=text max=100 class='col-xs-10 col-sm-5 col-md-9 col-lg-9 datepicker'  name=last_date value=" + data[i].last_date + "></div>\n\
                          </div>";
            }
            $('#edit_form_div').append(option);
            $('#assignment_view_table').hide();
            $('#edit_assignment_div').show();
        },
        error: function (data) {

        }
    });
}
function delete_assignment(id) {
    console.log('inside script of edit assignments' + id);
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/delete_assignment/' + id,
        dataType: 'json',
        success: function (data) {
            $("#assignment_div").hide();
            var trHTML = '';
            $('#assignment_view_table tbody').html("");
            for (i = 0; i < data.length; i++) {
                trHTML += '<tr><td>' + data[i].class_name + '</td><td>' + data[i].section_name + '</td><td>' + data[i].subject_name + '</td>\n\
                              <td>' + data[i].assignment_title + '</td><td>' + data[i].assignment_description + '</td><td>' + data[i].last_date + '</td>\n\
                              <td><button class="btn btn-primary btn-xs edit_assignment" onclick=edit_assignment(this.id) id=' + data[i].assignment_id + '><span class="glyphicon glyphicon-pencil"></span></button>\n\
                              <button class="btn btn-danger btn-xs" onclick=delete_assignment(this.id) id=' + data[i].assignment_id + '><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
            }

            $('#assignment_view_table tbody').append(trHTML);
            $('#assignment_view_table').show();
        },
        error: function (data) {

        }
    });
}
function view_remarks() {
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/view_remarks_staff',
        dataType: 'json',
        success: function (data) {
            $("#assignment_div").hide();
            var trHTML = '';
            $('#remarks_view_table tbody').html("");
            for (i = 0; i < data.length; i++) {
                trHTML += '<tr><td><img src=' + baseUrl + '/uploads/student/' + data[i].profile_pic + ' class=img-rounded height=75 width=75></td><td>' + data[i].first_name + ' ' + data[i].first_name + '</td>\n\
                           <td>' + data[i].admission_number + '</td><td>' + data[i].class_name + '-' + data[i].section_name + '</td><td>' + data[i].roll_number + '</td>\n\
                              <td>' + data[i].remark_title + '</td><td>' + data[i].remark_description + '</td>\n\
                              <td><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" id=' + data[i].student_remarks_id + ' onclick=remark_delete(this.id)><span class="glyphicon glyphicon-trash"></span></button></td>\n\
                              </tr>';
            }

            $('#remarks_view_table tbody').append(trHTML);
            $("#student_list_remark_div").hide();
            $('#view_remarks_div').show();
             $('#view_student_staff_div').hide();
             $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_images').hide();
        },
        error: function (data) {

        }
    });
}
function remark_delete(id) {
    if (confirm('Do you want to Delete Remark?')) {
        var baseUrl = document.location.origin;
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "GET",
            url: baseUrl + '/delete_remark_staff/' + id,
            dataType: 'json',
            success: function (data) {
                $("#assignment_div").hide();
                var trHTML = '';
                $('#remarks_view_table tbody').html("");
                for (i = 0; i < data.length; i++) {
                    trHTML += '<tr><td><img src=' + baseUrl + '/uploads/student/' + data[i].profile_pic + ' class=img-rounded height=75 width=75></td><td>' + data[i].first_name + ' ' + data[i].first_name + '</td>\n\
                           <td>' + data[i].admission_number + '</td><td>' + data[i].class_name + '-' + data[i].section_name + '</td><td>' + data[i].roll_number + '</td>\n\
                              <td>' + data[i].remark_title + '</td><td>' + data[i].remark_description + '</td>\n\
                              <td><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" id=' + data[i].student_remarks_id + ' onclick=remark_delete(this.id)><span class="glyphicon glyphicon-trash"></span></button></td>\n\
                              </tr>';
                }

                $('#remarks_view_table tbody').append(trHTML);
                $("#student_list_remark_div").hide();
                $('#view_remarks_div').show();
            },
            error: function (data) {

            }
        });
    } else {

    }
}
function get_images(id) {
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/view_images_staff/' + id,
        dataType: 'json',
        success: function (data) {
            var option = "";
            option +="<div class=col-md-3>";
            $('#images_div tbody').html("");
           for (i = 0; i < data.length; i++) {
                option += "<tr><td><a style = height:500px; width:500px; href="+ baseUrl + "/uploads/" + data[i].foldername + "/" + data[i].images + " target=_blank><img style = height:160px; width:240px; src=" + baseUrl + "/uploads/" + data[i].foldername + "/" + data[i].images + " ></td></tr>\n\
                ";
            }
            option +="</div>";
            $('#images_div tbody').append(option);
            $('#view_images').show();
            $('#view_albums_div').hide();
        },
          error: function (data) {

        }
    });
}
function add_assignment(id){
    var baseUrl = document.location.origin;
    $('#add_assignment_header h2').html("");
    $('#form_id').html("");
    var ids = id.split('-');
    var class_name = ids[0];
    var section_name = ids[1];
    var subject_name=ids[2];
    var class_id=ids[3];
    var section_id=ids[4];
    var subject_id=ids[5];
    var form='Adding Assignment To '+class_name+' Class-'+section_name+' Section-'+subject_name+' Subject';
    var form1='<input type=hidden name=hidden_values value='+class_id+'/'+section_id+'/'+subject_id+' >';
    alert(id);
    $('#form_id').append(form1);
    $('#add_assignment_header h2').append(form);
    $('#assignment_view_table').hide();
        $("#assignment_div").show();
}
function view_students_staff(id){
    var ids = id.split('-');
    var class_id = ids[0];
    var section_id = ids[1];
    var baseUrl = document.location.origin;
    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });
    $.ajax({
        type: "GET",
        url: baseUrl + '/view_students_staff/'+class_id+'/'+section_id,
        dataType: 'json',
        success: function (data) {
            $("#assignment_div").hide();
            var trHTML = '';
            $('#view_student_staff_table tbody').html("");
            $('#view_student_staff_heading h3').html("");
            for (i = 0; i < data.length; i++) {
                trHTML += '<tr><td><img src=' + baseUrl + '/uploads/student/' + data[i].profile_pic + ' class=img-rounded height=75 width=75></td><td>' + data[i].first_name + ' ' + data[i].last_name + '</td>\n\
                           <td>' + data[i].admission_number + '</td><td>' + data[i].class_name + '-' + data[i].section_name + '</td><td>' + data[i].roll_number + '</td>\n\
                              <td>' + data[i].emergency_number + '</td><td><img src=' + baseUrl + '/uploads/parent/' + data[i].parent_pic + ' class=img-rounded height=75 width=75></td><td>' + data[i].parent_first_name +'-'+data[i].parent_last_name+ '</td><td>' + data[i].address + '</td>\n\
                              </tr>';
            }
            var header='';
            header +='Students Are '+ data[0].class_name +' Class-'+data[0].section_name+' Section';
            $('#view_student_staff_heading h3').append(header);
            $('#view_student_staff_table tbody').append(trHTML);
            $("#student_list_remark_div").hide();
            $('#view_student_staff_div').show();
             $("#staff_details_div").hide();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#view_salary_div").hide();
        $('#assignment_view_table').hide();
        $('#edit_assignment_div').hide();
        $("#assignment_div").hide();
        $('#exam_select_div').hide();
        $('#students_marks_div').hide();
        $('#students_attendance_div').hide();
        $('#student_list_remark_div').hide();
        $('#view_events_div').hide();
        $('#view_albums_div').hide();
        $('#view_remarks_div').hide();
        $('#view_images').hide();
        },
        error: function (data) {

        }
    });
}












