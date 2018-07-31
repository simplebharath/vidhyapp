var path = [location.protocol, '//', location.host, location.pathname].join('');

$(document).ready(function () {
    $("#staff_profile_nav li a").click(function () {
        $("#staff_profile_nav li").removeClass("active");
        $(this).parent().addClass("active");
    });


//get section
    $('#cid').on('change', function () {
        var data1 = document.getElementById("cid").value;

        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get_staff_section',
            data: {'data1': data1},
            dataType: 'json',
            success: function (data, status) {
                if (data.length !== 0) {
                    var option = "";
                    option += "<option value=''>--Select Section--</option>";
                    for (i = 0; i < data.length; i++) {

                        option += "<option value='" + data[i].section_id + "'>" + data[i].section_name + "</option>";
                    }
                    //get section  withought subject                    
                    $('#section').html(option);
                } else {
                    $.ajax({
                        type: 'GET',
                        url: '/getstaff_subject_without_section',
                        data: {'data1': data1},
                        dataType: 'json',
                        success: function (data, status) {
                            var option = "";
                            option += "<option value=''>--Select Subject--</option>";
                            for (i = 0; i < data.length; i++) {
                                option += "<option value='" + data[i].subject_id + "'>" + data[i].subject_name + "</option>";
                            }
                            $('#subject').html(option);


                        }
                    });
                }
            }
        });
    });
    //start get subject   
    $('#section').on('change', function () {
        var data2 = $('#section').val();

        console.log(data2);
        $.ajax({
            type: 'GET',
            url: '/get_staff_subject',
            data: {'data2': data2},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].subject_id + "'>" + data[i].subject_name + "</option>";
                }
                $('#subject').html(option);
            }
        });
    });
    //staff_details       
    $("#staff_details_div").show();
    $("#staff_subject_details_div").show();
    $("#upload_documents_div").hide();
    $("#uploads_div").hide();
    $("#assign_subject_div").hide();
    $("#edit_staff_div").hide();
    $("#add_salary_div").hide();
    $("#edit_salary_div").hide();
    $("#view_salary_div").hide();
    $("#view_attendance_div").hide();
    $("#staff_attendaance_daywise_div").hide();

    $("#staff_details").click(function () {
        $("#staff_details_div").show();
        $("#staff_subject_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });

    $("#uploads").click(function () {
        $("#staff_details_div").show();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").hide();
        $("#uploads_div").show();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();

    });
    $("#upload_documents").click(function () {
        $("#staff_details_div").show();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").show();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#uploads_view").click(function () {
        $("#staff_details_div").show();
        $("#staff_subject_details_div").hide();
        $("#upload_documents_div").show();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#assign_subject").click(function () {
        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").show();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#view_assigned_subjects").click(function () {
        $("#staff_subject_details_div").show();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });

    $("#staff_subject_details").click(function () {
        $("#staff_subject_details_div").show();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#attendance").click(function () {
        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();

    });
    $("#add_salary").click(function () {
        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").show();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#edit_salary").click(function () {

        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").show();
        $("#view_salary_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#view_salary").click(function () {
        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").show();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();
    });
    $("#edit_staff").click(function () {
        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").show();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").hide();
        $("#staff_attendaance_daywise_div").hide();

    });
    $("#view_attendance").click(function () {
        $("#staff_subject_details_div").hide();
        $("#staff_details_div").show();
        $("#upload_documents_div").hide();
        $("#uploads_div").hide();
        $("#assign_subject_div").hide();
        $("#edit_staff_div").hide();
        $("#add_salary_div").hide();
        $("#edit_salary_div").hide();
        $("#view_salary_div").hide();
        $("#view_attendance_div").show();
        $("#staff_attendaance_daywise_div").hide();
    });


//edit staff profile
    $('#edit_staff_form_submit').on('submit', function (e) {
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
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $("#result").append(data);

            },
            error: function (data) {
                location.href = location.href + "?parameter=edit_staff";
            }
        });
    });


//assign subject 
    $('#assign_subject_form_submit').on('submit', function (e) {
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
                location.href = location.href + "?parameter=assign_subjects";
            }
        });
    });

    //delete subject
    $('.subject_delete').click(function () {
        var document_id = $(this).attr('id');
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
            url: baseUrl + '/delete_staff_subject/' + document_id,
            dataType: 'json',
            success: function (data) {
            },
            error: function (data) {
                location.href = path + "?parameter=delete_subject";
            }
        });
    });
    //upload document 
    $('#upload_documents_submit').on('submit', function (e) {
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
                location.href = location.href + "?parameter=add_documents";
                $("#result").append(data);

            },
            error: function (data) {
                location.href = location.href + "?parameter=add_documents";
            }
        });
    });

//delete document 
    $('.document_delete').click(function () {
        var document_id = $(this).attr('id');
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
            url: baseUrl + '/delete_uploded_document/' + document_id,
            dataType: 'json',
            success: function (data) {
            },
            error: function (data) {
                location.href = path + "?parameter=delete_document";
            }
        });
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
    $('.salary_delete').click(function () {
        var document_id = $(this).attr('id');
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
            url: baseUrl + '/delete_staff_salary/' + document_id,
            dataType: 'json',
            success: function (data) {
            },
            error: function (data) {
                location.href = path + "?parameter=salary_delete";
            }
        });
    });

});
function staff_attendance_day(ids) {
    var id = ids.split('/');
    var month = id[0];
    var staff_id = id[1];
    $.ajax({
        type: 'GET',
        url: '/staff_attendance_day/' + staff_id + '/' + month,
        dataType: 'json',
        success: function (data, status) {
            var trHTML = '';
            $('#attendance_daywise_table tbody').html("");
            $('#head_div').html("");
            for (i = 0; i < data.length; i++) {
                var date = new Date(data[i].attendance_date);
                var newdate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                trHTML += '<tr><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';

            }
            var head = '';
            head += '' + data[0].month_name + ' Attendance';
            $('#head_div').append(head);
            $('#attendance_daywise_table tbody').append(trHTML);
            $("#staff_subject_details_div").hide();
            $("#staff_details_div").show();
            $("#upload_documents_div").hide();
            $("#uploads_div").hide();
            $("#assign_subject_div").hide();
            $("#edit_staff_div").hide();
            $("#add_salary_div").hide();
            $("#edit_salary_div").hide();
            $("#view_salary_div").hide();
            $("#view_attendance_div").hide();
            $("#staff_attendaance_daywise_div").show();

        },
        error: function (data) {
//location.href = path + "?parameter=attendance_search";
        }



    });
}


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
if (window.location.search.indexOf('parameter=assign_subjects') > -1) {
    jQuery(function () {
        jQuery('#staff_details').click();
    });
}
if (window.location.search.indexOf('parameter=delete_subject') > -1) {
    jQuery(function () {
        jQuery('#staff_subject_details').click();
    });
}
if (window.location.search.indexOf('parameter=add_documents') > -1) {
    jQuery(function () {
        jQuery('#upload_documents').click();
    });
}
if (window.location.search.indexOf('parameter=add_salary') > -1) {
    jQuery(function () {
        jQuery('#view_salary').click();
    });
}
if (window.location.search.indexOf('parameter=salary_delete') > -1) {
    jQuery(function () {
        jQuery('#view_salary').click();
    });
}









