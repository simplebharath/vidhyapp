
$(document).ready(function () {

    $("#student_details_div").hide();
    $("#parent_details_div").show();
    $("#upload_documents_div").hide();
    $("#remarks_div").hide();
    $("#add_remarks_div").hide();
    $("#marks_div").hide();
    $("#view_attendance_div").hide();
    $("#student_fee_div").hide();
    $("#payment_details_div").hide();
    $("#fee_add_div").hide();
    $("#trasport_fee_div").hide();
    $("#view_transport_div").hide();
    $("#do_payment_form").hide();
    $("#summary_div").hide();
    $("#payment_history_div").hide();
    $("#search_attendance_div").hide();
    $("#marks_search_div").hide();
    $("#timetable_div").hide();
    $("#assignments_div").hide();
    $("#events_div").hide();
    $("#gallery_div").hide();
    $("#view_images_div").hide();
    $("#search_attendance_nosubject_div").hide();
    $("#messages_div").hide();
    $("#send_message_form_div").hide();

    $("#parent_login_nav li a").click(function () {
        $("#parent_login_nav li").removeClass("active");
        $(this).parent().addClass("active");
    });



    $("#student_details").click(function () {
        $("#student_details_div").show();
        $("#edit_student_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });

    $("#parent_details").click(function () {
        $("#student_details_div").hide();
        $("#parent_details_div").show();
        $("#upload_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#upload_documents").click(function () {
        $("#student_details_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").show();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#upload_documents1").click(function () {
        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#upload_documents_button").click(function () {
        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });

    $("#remarks").click(function () {
        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#view_marks").click(function () {
        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#view_attendance").click(function () {
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
//                     var date= new Date(data[i].attendance_date);    
//                var newdate= date.getDate()+ '-' + (date.getMonth() + 1) + '-' +  date.getFullYear();
//                    if (data[0].subject == null) {
//                        
//                     trHTML += '<tr><td>' + data[i].subject + '</td><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
//                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
//                      } else {
//                       trHTML += '<tr><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
//                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
//                    }
//                }
        //  $('#attendance_table tbody').append(trHTML);

        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#student_fee").click(function () {
        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#payment_details").click(function () {
        $("#student_details_div").hide();
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
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });

    $("#trasport_details").click(function () {
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
        $("#trasport_fee_div").show();
        $("#view_transport_div").hide();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $("#view_transport_details").click(function () {
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
        $("#view_transport_div").show();
        $("#add_marks_div").hide();
        $("#edit_bus_route_div").hide();
        $("#do_payment_form").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });

    $("#payment_history").click(function () {
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
        $("#summary_div").hide();
        $("#payment_history_div").show();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#events_div").hide();
        $("#assignments_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();

    });
    $('#timetable').click(function () {
        $('#daywise_table_total').show();
        $('#daywise_table').hide();
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
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").show();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $('#assignments').click(function () {
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
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").show();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $('#events').click(function () {
        $("#student_details_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").show();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    })
    $('#gallery').click(function () {
        $("#student_details_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").show();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").hide();
    });
    $('#messages').click(function () {
        $("#student_details_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").show();
        $("#send_message_form_div").hide();
    });
    $('#send_message_form').click(function () {
        $("#student_details_div").hide();
        $("#parent_details_div").hide();
        $("#upload_documents_div").hide();
        $("#remarks_div").hide();
        $("#marks_div").hide();
        $("#view_attendance_div").hide();
        $("#student_fee_div").hide();
        $("#payment_details_div").hide();
        $("#fee_add_div").hide();
        $("#trasport_fee_div").hide();
        $("#view_transport_div").hide();
        $("#summary_div").hide();
        $("#payment_history_div").hide();
        $("#search_attendance_div").hide();
        $("#marks_search_div").hide();
        $("#timetable_div").hide();
        $("#assignments_div").hide();
        $("#events_div").hide();
        $("#gallery_div").hide();
        $("#view_images_div").hide();
        $("#search_attendance_nosubject_div").hide();
        $("#messages_div").hide();
        $("#send_message_form_div").show();
    });
    $('#save_comment').on('submit', function (e) {
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

                $('#send_message_form_div').html("");
                var trHTML = '';
                for (i = 0; i < data.length; i++) {
                    trHTML += '<tr><td>' + data[i].comment + '</td><td>' + data[i].created_at + '</td></tr>';

                }
                $('#messages_table1 tbody').append(trHTML);
                $('#messages_table').hide();
                $('#messages_table1').show();
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
                $("#do_payment_form").hide();
                $("#summary_div").hide();
                $("#payment_history_div").hide();
                $("#search_attendance_nosubject_div").hide();
                $("#marks_search_div").hide();
                $("#search_attendance_div").hide();
                $("#messages_div").show();
            },
            error: function (data, status) {
                alert(data);

            }
        });
    });

});
function view_images(id) {
    var baseUrl = document.location.origin;
    $.ajax({
        type: 'GET',
        url: '/view_images_student/' + id,
        dataType: 'json',
        success: function (data, status) {
            var trHTML = '';
            $('#image_div').html("");
            for (i = 0; i < data.length; i++) {
                trHTML += '<a href=' + baseUrl + '/uploads/' + data[i].foldername + '/' + data[i].images + ' class=html5lightbox data-group=mygroup  title=""><img style=height:160px; width:240px; src=' + baseUrl + '/uploads/' + data[i].foldername + '/' + data[i].images + '></a>';

            }
            $('#image_div').append(trHTML);
            $("#gallery_div").hide();
            $("#view_images_div").show();


        }
    });
}
function attendance_daywise(ids) {
    var id = ids.split('/');
    var student_id = id[0];
    var subject_id = id[1];
    var month = id[2];
    $.ajax({
        type: 'GET',
        url: '/attendance_daywise/' + student_id + '/' + subject_id + '/' + month,
        dataType: 'json',
        success: function (data, status) {
            var trHTML = '';
            $('#attendance_daywise_table tbody').html("");
            var weekday = new Array(7);
            weekday[0] = "Monday";
            weekday[1] = "Tuesday";
            weekday[2] = "Wednesday";
            weekday[3] = "Thursday";
            weekday[4] = "Friday";
            weekday[5] = "Saturday";
            weekday[6] = "Sunday";
            for (i = 0; i < data.length; i++) {
                var date = new Date(data[i].attendance_date);
                var newdate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                if (data[i].subject_name == null) {
                    trHTML += '<tr><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                } else {
                    alert('insidesubject');
                    trHTML += '<tr><td>' + data[i].subject_name + '</td><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';
                }
            }
            $('#attendance_daywise_table tbody').append(trHTML);

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
            $("#do_payment_form").hide();
            $("#summary_div").hide();
            $("#payment_history_div").hide();
            $("#search_attendance_div").show();
            $("#search_attendance_nosubject_div").hide();
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
    var month = id[2];
    $.ajax({
        type: 'GET',
        url: '/attendance_daywise_nosubject/' + student_id + '/' + month,
        dataType: 'json',
        success: function (data, status) {
            var trHTML = '';
            $('#attendance_daywise_nosubject_table tbody').html("");
            var weekday = new Array(7);
            weekday[0] = "Monday";
            weekday[1] = "Tuesday";
            weekday[2] = "Wednesday";
            weekday[3] = "Thursday";
            weekday[4] = "Friday";
            weekday[5] = "Saturday";
            weekday[6] = "Sunday";
            for (i = 0; i < data.length; i++) {
                var date = new Date(data[i].attendance_date);
                var newdate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                trHTML += '<tr><td>' + newdate + '</td><td>' + data[i].day + '</td><td>' + data[i].attendance_status + '</td>\n\
                               <td>' + data[i].reason + '</td><td>' + data[i].user_name + '</td></tr>';

            }
            $('#attendance_daywise_nosubject_table tbody').append(trHTML);

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
            $("#do_payment_form").hide();
            $("#summary_div").hide();
            $("#search_attendance_div").hide();
            $("#payment_history_div").hide();
            $("#search_attendance_nosubject_div").show();
            $("#marks_search_div").hide();


        },
        error: function (data) {
//location.href = path + "?parameter=attendance_search";
        }



    });
}







