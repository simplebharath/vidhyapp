var path = [location.protocol, '//', location.host, location.pathname].join('');



$(document).ready(function () {

    $("#student_details_div").show();
    $("#parent_details_div").show();
    $("#upload_documents_div").hide();
    $("#add_documents_div").hide();
    $("#remarks_div").hide();
    $("#add_remarks_div").hide();
    $("#marks_div").hide();
    $("#view_attendance_div").hide();
    $("#student_fee_div").hide();
    $("#payment_details_div").hide();
    $("#add_parent_details_div").hide();
    $("#edit_parent_div").hide();
    $("#fee_add_div").hide();
    $("#trasport_fee_div").hide();
    $("#view_transport_div").hide();
    $("#add_marks_div").hide();
    $("#edit_student_div").hide();
    $("#edit_bus_route_div").hide();
    $("#do_payment_form").hide();
    $("#summary_div").hide();
    $("#payment_history_div").hide();
    $("#search_attendance_div").hide();
    $("#marks_search_div").hide();

    $("#student_profile_nav li a").click(function () {
        $("#student_profile_nav li").removeClass("active");
        $(this).parent().addClass("active");
    });



    $("#student_details").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#add_remarks_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#edit_student").click(function () {

        $("#student_details_div").show();
        $("#edit_student_div").show();
        $("#parent_details_div").hide();
        $("#add_remarks_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#parent_details").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").show();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#upload_documents").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").show();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#upload_documents1").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").show();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#upload_documents_button").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").show();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });

    $("#remarks").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").show();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#view_marks").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").show();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#view_attendance").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").show();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
//        var student_id=($(this).data("value"));
//         $.ajax({
//        type: 'GET',
//        url: '/attendance_view/'+student_id,
//        dataType: 'json',
//        success: function (data, status) {
//             var trHTML = '';
//                $('#attendance_table tbody').html("");
//                var weekday = new Array(7);
//                weekday[0] = "Monday";
//                weekday[1] = "Tuesday";
//                weekday[2] = "Wednesday";
//                weekday[3] = "Thursday";
//                weekday[4] = "Friday";
//                weekday[5] = "Saturday";
//                weekday[6] = "Sunday";
//                for (i = 0; i < data.length; i++) {
//                    var date= new Date(data[i].attendance_date);    
//                var newdate= date.getDate()+ '-' + (date.getMonth() + 1) + '-' +  date.getFullYear();
//                    if (data[i].subject == null) {
//                        trHTML += '<tr><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
//                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
//                      } else {
//                        trHTML += '<tr><td>' + data[i].subject + '</td><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
//                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
//                    }
//                }
//                $('#attendance_table tbody').append(trHTML);
//                
//                 $("#student_details_div").show();
//        $("#edit_student_div").hide();
//        $("#parent_details_div").hide();
//        $("#upload_documents_div").hide();
//        $("#add_documents_div").hide();
//        $("#remarks_div").hide();
//        $("#marks_div").hide();
//        $("#view_attendance_div").show();
//        $("#student_fee_div").hide();
//        $("#payment_details_div").hide();
//        $("#add_parent_details_div").hide();
//        $("#edit_parent_div").hide();
//        $("#add_remarks_div").hide();
//        $("#fee_add_div").hide();
//        $("#trasport_fee_div").hide();
//        $("#view_transport_div").hide();
//        $("#add_marks_div").hide();
//        $("#edit_bus_route_div").hide();
//        $("#do_payment_form").hide();
//        $("#summary_div").hide();
//        $("#payment_history_div").hide();
//        $("#search_attendance_div").hide();
//        $("#marks_search_div").hide();
//
//
//            },
//            error: function (data) {
////location.href = path + "?parameter=attendance_search";
//            }
//        
//        
//       
//    });
    });
    $("#student_fee").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").show();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#payment_details").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").show();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#add_parent_details_button").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").show();
        $("#edit_parent_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#edit_parent").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").show();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#add_remarks_button").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").show();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#payment_history_div").hide();
        $("#summary_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#fee_add_button").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").show();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#trasport_details").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").show();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#view_transport_details").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").show();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();

    });
    $("#add_marks_button").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").show();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();

    });
    $("#edit_bus_route_button").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").show();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();

    });
    $("#summary").click(function () {
        $("#student_details_div").hide();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#summary_div").show();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
    });
    $("#payment_history").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#add_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#add_parent_details_div").hide();
        $("#do_payment_form").hide();
        $("#edit_parent_div").hide();
        $("#add_remarks_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#summary_div").hide();
        $("#payment_history_div").show();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();

    });

    $("form#form_sumbit").on('submit', function (e) {
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
            //data: $(this).serialize() + "&profile_pic="+profile_pic,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, Response) {
                //window.location.reload(true); // then reload the page.(3)
                $.each(data.errors, function (key, value) {
                    console.log(value);
                    errorString += '<li>' + value + '</li>';
                });
                $('#add_parent_validation_error').html(errorString);
            },
            error: function (data)
            {
                location.href = path + "?parameter=add_parent";
            }
        });
    });
    $('#edit_parent_form_submit').on('submit', function (e) {
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
            //data: $(this).serialize() + "&profile_pic="+profile_pic,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, Response) {
                //window.location.reload(true); // then reload the page.(3)
                $.each(data.errors, function (key, value) {
                    console.log(value);
                    errorString += '<li>' + value + '</li>';
                });
                $('#edit_parent_errors').html(errorString);

                location.href = path + "?parameter=edit_parent";

            },
            error: function (data, response) {
                location.href = path + "?parameter=edit_parent";

            }
        });
    });
    $('#form_remarks_add').on('submit', function (e) {
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

            },
            error: function (data) {
                // window.location.reload();
                location.href = path + "?parameter=remarks";

            }
        });
    });

    $('#fee_form_submit').on('submit', function (e) {
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
            },
            error: function (data) {
                location.href = path + "?parameter=add_fee";
            }
        });
    });
    $('#transport_fee_form_submit').on('submit', function (e) {
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

            },
            error: function (data) {
                location.href = path + "?parameter=add_transport_fee";
            }
        });
    });

    $('#add_marks_form_submit').on('submit', function (e) {
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
            },
            error: function (data) {
                location.href = path + "?parameter=add_marks";
            }
        });
    });
    $('#edit_student_form_sumbit').on('submit', function (e) {
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
            //data: $(this).serialize() + "&profile_pic="+profile_pic,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, Response) {
                //window.location.reload(true); // then reload the page.(3)
                $.each(data.errors, function (key, value) {
                    console.log(value);
                    errorString += '<li>' + value + '</li>';
                });
                $('#edit_student_validation_errors').html(errorString);

            },
            error: function (status) {
//                 $.each(data.errors, function (key, value) {
//                    console.log(value);
//                    errorString += '<li>' + value + '</li>';
//                });
//                $('#edit_student_validation_errors').html(errorString);
                console.log(status);
                location.href = path + "?parameter=edit_student";

            }
        });
    });
    $('#add_documents_sumbit').on('submit', function (e) {
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
                location.href = path + "?parameter=add_document";
            }
        });
    });
    $('#transport_edit_form_submit').on('submit', function (e) {
        e.preventDefault(e);
        var data1 = new FormData(this);
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
                location.href = path + "?parameter=transport_edit";
            }
        });
    });
    $('.remark_delete').click(function () {
        // e.preventDefault(e);
        var remarks_id = $(this).attr('id');
        var baseUrl = document.location.origin;

        // alert(baseUrl);
        //alert(remarks_id);
        //var $form = $(this),
        //       url = $form.attr("action");
        $.ajaxSetup(
                {
                    headers:
                            {
                                'X-CSRF-Token': $('input[name="_token"]').val()
                            }
                });
        $.ajax({
            type: "GET",
            url: baseUrl + '/student_remarks_delete/' + remarks_id,
            //data: $(this).serialize() + "&profile_pic="+profile_pic,

            dataType: 'json',
            success: function (data) {

            },
            error: function (data) {
                location.href = path + "?parameter=remarks_delete";
            }
        });
    });
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
            url: baseUrl + '/student_document_delete/' + document_id,
            dataType: 'json',
            success: function (data) {
            },
            error: function (data) {
                location.href = path + "?parameter=delete_document";
            }
        });
    });
    $('#attendance_search').on('submit', function (e) {
        e.preventDefault(e);
        var data1 = new FormData(this);
        // alert(data1);
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
                //location.href = path + "?parameter=attendance_search";
                //$("#result").append(data);
                var trHTML = '';
                $('#attendance_search_table tbody').html("");
                var weekday = new Array(7);
                weekday[0] = "Monday";
                weekday[1] = "Tuesday";
                weekday[2] = "Wednesday";
                weekday[3] = "Thursday";
                weekday[4] = "Friday";
                weekday[5] = "Saturday";
                weekday[6] = "Sunday";
                for (i = 0; i < data.length; i++) {
                    var subject = data[i].subject;
                    if (data[i].subject == null) {
                        trHTML += '<tr><td>' + data[i].attendance_date + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                    } else {
                        trHTML += '<tr><td>' + data[i].subject + '</td><td>' + data[i].attendance_date + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                    }
                }

                $('#attendance_search_table tbody').append(trHTML);
                $('#view_attendance_div').hide();
                $('#search_attendance_div').show();


            },
            error: function (data) {
//location.href = path + "?parameter=attendance_search";
            }
        });
    });
    $('#attendance_search_form').on('submit', function (e) {
        e.preventDefault(e);
        var data1 = new FormData(this);
        // alert(data1);
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
                var trHTML = '';
                $('#attendance_search_table tbody').html("");
                var weekday = new Array(7);
                weekday[0] = "Monday";
                weekday[1] = "Tuesday";
                weekday[2] = "Wednesday";
                weekday[3] = "Thursday";
                weekday[4] = "Friday";
                weekday[5] = "Saturday";
                weekday[6] = "Sunday";
                for (i = 0; i < data.length; i++) {
                    var subject = data[i].subject;
                    if (data[i].subject == null) {
                        trHTML += '<tr><td>' + data[i].attendance_date + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                    } else {
                        trHTML += '<tr><td>' + data[i].subject + '</td><td>' + data[i].attendance_date + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                    }
                }

                $('#attendance_search_table tbody').append(trHTML);
                $('#view_attendance_div').hide();
                $('#search_attendance_div').show();


            },
            error: function (data) {
//location.href = path + "?parameter=attendance_search";
            }
        });
    });
    $('#student_summary_download').click(function () {

    });
    $('#route_id').on('change', function () {
        var data1 = document.getElementById("route_id").value;

        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get_route_stops',
            data: {'data1': data1},
            dataType: 'json',
            success: function (data, status) {

                console.log(data);
                var option = "";
                option += "<option value=''>Select Stop</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].bus_stop_id + "'>" + data[i].bus_stop_name + "</option>";
                }
                $('#bus_stop_div').html(option);
            }
        });
    });
    $('#bus_route_id').on('change', function () {
        var data1 = document.getElementById("bus_route_id").value;

        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get_route_stops',
            data: {'data1': data1},
            dataType: 'json',
            success: function (data, status) {

                console.log(data);
                var option = "";
                option += "<option value=''>Select Stop</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].bus_stop_id + "'>" + data[i].bus_stop_name + "</option>";
                }
                $('#bus_stop_div1').html(option);
            }
        });
    });



});
function attendance_daywise_withsubject(ids) {
    var id = ids.split('/');
    var student_id = id[0];
    var subject_id = id[1];
    var month = id[2];
    $.ajax({
        type: 'GET',
        url: '/attendance_daywise_withsubject/' + student_id + '/' + subject_id + '/' + month,
        dataType: 'json',
        success: function (data, status) {
            var trHTML = '';
            $('#attendance_daywise_table tbody').html("");
            for (i = 0; i < data.length; i++) {              
                    trHTML += '<tr><td>' + data[i].subject_name + '</td><td>' + data[i].attendance_date + '</td><td>' + data[i].day_name + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                }
            
            $('#attendance_daywise_table tbody').append(trHTML);

            $("#student_details_div").show();
            $("#edit_student_div").hide();
            $("#parent_details_div").hide();
            $("#upload_documents_div").hide();
            $("#add_documents_div").hide();
            $("#remarks_div").hide();
            $("#marks_div").hide();
            $("#view_attendance_div").hide();
            $("#student_fee_div").hide();
            $("#payment_details_div").hide();
            $("#add_parent_details_div").hide();
            $("#edit_parent_div").hide();
            $("#add_remarks_div").hide();
            $("#fee_add_div").hide();
            $("#trasport_fee_div").hide();
            $("#view_transport_div").hide();
            $("#add_marks_div").hide();
            $("#edit_bus_route_div").hide();
            $("#do_payment_form").hide();
            $("#summary_div").hide();
            $("#payment_history_div").hide();
            $("#search_attendance_div").show();
            $("#marks_search_div").hide();
        },
        error: function (data) {
//location.href = path + "?parameter=attendance_search";
        }



    });
}
function attendance_daywise_without_subject(ids) {
                 
    var id = ids.split('/');
    var student_id = id[0];
    var month = id[1];
   alert('withought subject'+id[1]);
    $.ajax({
        type: 'GET',
        url: '/attendance_daywise_without_subject/' + student_id + '/' + month,
        
        dataType: 'json',
        success: function (data, status) {
            var trHTML = '';
            alert('withought subject');
        $('#attendance_daywise_table tbody').html("");
        alert('withought subject');
            for (i = 0; i < data.length; i++) {              
                    trHTML += '<tr><td>' + data[i].attendance_date + '</td><td>' + data[i].day_name + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                }
            $('#attendance_daywise_table tbody').append(trHTML);

            $("#student_details_div").show();
            $("#edit_student_div").hide();
            $("#parent_details_div").hide();
            $("#upload_documents_div").hide();
            $("#add_documents_div").hide();
            $("#remarks_div").hide();
            $("#marks_div").hide();
            $("#view_attendance_div").hide();
            $("#student_fee_div").hide();
            $("#payment_details_div").hide();
            $("#add_parent_details_div").hide();
            $("#edit_parent_div").hide();
            $("#add_remarks_div").hide();
            $("#fee_add_div").hide();
            $("#trasport_fee_div").hide();
            $("#view_transport_div").hide();
            $("#add_marks_div").hide();
            $("#edit_bus_route_div").hide();
            $("#do_payment_form").hide();
            $("#summary_div").hide();
            $("#payment_history_div").hide();
            $("#search_attendance_div").show();
            $("#marks_search_div").hide();


        },
        error: function (data) {
//location.href = path + "?parameter=attendance_search";
        }



    });
}

if (window.location.search.indexOf('parameter=remarks') > -1) {
    jQuery(function () {
        jQuery('#remarks').click();

    });
}

if (window.location.search.indexOf('parameter=payment_details') > -1) {
    jQuery(function () {
        jQuery('#payment_details').click();

    });
}

if (window.location.search.indexOf('parameter=edit_parent') > -1) {
    jQuery(function () {
        jQuery('#parent_details').click();
    });
}
if (window.location.search.indexOf('parameter=add_parent') > -1) {
    jQuery(function () {
        jQuery('#parent_details').click();
    });
}
if (window.location.search.indexOf('parameter=edit_student') > -1) {
    jQuery(function () {
        jQuery('#student_details').click();
    });
}
if (window.location.search.indexOf('parameter=add_document') > -1) {
    jQuery(function () {
        jQuery('#upload_documents').click();
    });
}
if (window.location.search.indexOf('parameter=delete_document') > -1) {
    jQuery(function () {
        jQuery('#upload_documents').click();
    });
}
if (window.location.search.indexOf('parameter=add_marks') > -1) {
    jQuery(function () {
        jQuery('#view_marks').click();
    });
}
if (window.location.search.indexOf('parameter=remarks_delete') > -1) {
    jQuery(function () {
        jQuery('#remarks').click();
    });
}
if (window.location.search.indexOf('parameter=add_fee') > -1) {
    jQuery(function () {
        jQuery('#student_fee').click();
    });
}
if (window.location.search.indexOf('parameter=transport_edit') > -1) {
    jQuery(function () {
        jQuery('#view_transport_details').click();
    });
}
if (window.location.search.indexOf('parameter=add_transport_fee') > -1) {
    jQuery(function () {
        jQuery('#view_transport_details').click();
    });
}














