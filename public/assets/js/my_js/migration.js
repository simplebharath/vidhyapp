$('#old_a_year_id').on('change', function () {
    var academic_year_id = document.getElementById("old_a_year_id").value;
    console.log(academic_year_id);
    //alert(academic_year_id);
    $.ajax({
        type: 'GET',
        url: '/get-f-a-y-classes',
        data: {'academic_year_id': academic_year_id
        },
        dataType: 'json',
        success: function (data, status) {
           // alert(data.transport_fees[0].route_title);
            var option1 = "";
            var option2 = "";
            var option3 = "";
            var option4 = "";
            var option5 = "";

            for (i = 0; i < data.transport_fees.length; i++) {
                option5 += "<option value='" + data.transport_fees[i].id + "'>" + ' ' + data.transport_fees[i].route_title + ' ( ' + data.transport_fees[i].stop_name + ' ) ' + data.transport_fees[i].transport_fee + ' - ' + data.transport_fees[i].fee_name + "</option>";
            }
            for (i = 0; i < data.staff.length; i++) {
                option4 += "<option value='" + data.staff[i].id + "'>" + data.staff[i].first_name + ' ' + data.staff[i].last_name + ' ( ' + data.staff[i].d_title + ' ) ' + "</option>";
            }
            for (i = 0; i < data.classes.length; i++) {
                option2 += "<option value='" + data.classes[i].c_id + "'>" + data.classes[i].class_name + ' ' + data.classes[i].section_name + "</option>";
            }
            for (i = 0; i < data.timings.length; i++) {
                option1 += "<option value='" + data.timings[i].id + "'>" + data.timings[i].class_start + ' to  ' + data.timings[i].class_end + ' ( ' + data.timings[i].title + ' ) ' + "</option>";
            }
            option3 += "<option value=''>-------------- select new academic year  -----------</option>";
            for (i = 0; i < data.new_years.length; i++) {
                option3 += "<option value='" + data.new_years[i].id + "'>" + data.new_years[i].year1 + ' - ' + data.new_years[i].year2 + ' ( ' + data.new_years[i].from_year + ' to ' + data.new_years[i].to_year + ' ) ' + "</option>";
            }
            $('#old_a_y_classes').html(option2);
            $('#old_timings').html(option1);
            $('#new_a_y').html(option3);
            $('#staff_to_migrate').html(option4);
            $('#transport_fee').html(option5);
        }
    });
});
$('#new_a_y').on('change', function () {
    var new_a_y = document.getElementById("new_a_y").value;
    console.log(new_a_y);
    $.ajax({
        type: 'GET',
        url: '/get-t-a-y-classes',
        data: {'academic_year_id': new_a_y},
        dataType: 'json',
        success: function (data, status) {
            //alert(data.transport_fees[0].route_title);
            if (data) {
                var option1 = "";
                var option2 = "";
                var option4 = "";
                var option3 = "";

                for (i = 0; i < data.transport_fees.length; i++) {
                    option3 += "<option value='" + data.transport_fees[i].id + "'>" + ' ' + data.transport_fees[i].route_title + ' ( ' + data.transport_fees[i].stop_name + ' ) ' + data.transport_fees[i].transport_fee + ' - ' + data.transport_fees[i].fee_name + "</option>";
                }
                for (i = 0; i < data.staff.length; i++) {
                    option4 += "<option value='" + data.staff[i].id + "'>" + data.staff[i].first_name + ' ' + data.staff[i].last_name + ' ( ' + data.staff[i].d_title + ' ) ' + "</option>";
                }
                for (i = 0; i < data.classes.length; i++) {
                    option2 += "<option value='" + data.classes[i].id + "'>" + data.classes[i].class_name + ' ' + data.classes[i].section_name + "</option>";
                }
                for (i = 0; i < data.timings.length; i++) {
                    option1 += "<option value='" + data.timings[i].id + "'>" + data.timings[i].class_start + ' to  ' + data.timings[i].class_end + ' ( ' + data.timings[i].title + ' ) ' + "</option>";
                }
                $('#new_classes').html(option2);
                $('#new_timings').html(option1);
                $('#migrated_staff').html(option4);
                $('#migrated_transport_fee').html(option3);
            }
        }
    });
});
