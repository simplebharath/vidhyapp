$(document).ready(function () {
    $(".edit_marks").on('click', function () {
        var edit_button_parts = $(this).attr('id').split('_');
        var db_marks = $('#obtained_' + edit_button_parts[1] + '_' + edit_button_parts[2] + '_' + edit_button_parts[3] + '_' + edit_button_parts[4]).html();
        var dynamic_input = '<input type="text" name="marks_obtained" id="marks_' + edit_button_parts[1] + '_' + edit_button_parts[2] + '_' + edit_button_parts[3] + '_' + edit_button_parts[4] + '" value=' + db_marks + '\n\
                        <span class="savemarks" id="save_' + edit_button_parts[1] + '_' + edit_button_parts[2] + '_' + edit_button_parts[3] + '_' + edit_button_parts[4] + '"><i class="fa fa-save"></i></span>';
        $('#obtained_' + edit_button_parts[1] + '_' + edit_button_parts[2] + '_' + edit_button_parts[3] + '_' + edit_button_parts[4]).html(dynamic_input);
        return false;
    });

});
$(document).on("click", ".savemarks", function () {
    var edit_marks_parts = $(this).attr('id').split('_');
    var edit_marks = $('#marks_' + edit_marks_parts[1] + '_' + edit_marks_parts[2] + '_' + edit_marks_parts[3] + '_' + edit_marks_parts[4]).val();
    var student_id = edit_marks_parts[1];
    var exam_id = edit_marks_parts[2];
    var class_section_id = edit_marks_parts[3];
    var subject_id = edit_marks_parts[4];
    var url = 'save-individual-marks';
    var edit = '<i class="edit_marks fa fa-pencil" id="marks_' + student_id + '_' + exam_id + '_' + class_section_id + '_' + subject_id + '"></i>';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#token').val()
        }
    });
    $.ajax({
        url: url,
        type: 'POST',
        data: {'student_id': student_id, 'marks': edit_marks, 'exam_id': exam_id, 'class_section_id': class_section_id, 'subject_id': subject_id},
        dataType: 'JSON',
        success: function (data) {
            if (data) {
                $('#obtained_' + edit_marks_parts[1] + '_' + edit_marks_parts[2] + '_' + edit_marks_parts[3] + '_' + edit_marks_parts[4]).html(edit_marks);
                $('#marks_' + edit_marks_parts[1] + '_' + edit_marks_parts[2] + '_' + edit_marks_parts[3] + '_' + edit_marks_parts[4]).html(edit);
            } else {
                alert('Some thing went wrong.Please, try again!');
            }
        }
    });
});
$(document).ready(function () {
    $('#fee_discount_id').on('change', function () {
        var fee_id = document.getElementById("fee_discount_id").value;
        var class_section_id = $('#student_class').val();
        var student_id = $('#student_ids').val();

        console.log(fee_id);
        $.ajax({
            type: 'GET',
            url: '/get-student-total-fee/' + class_section_id,
            data: {'fee_id': fee_id, 'student_id': student_id},
            dataType: 'json',
            success: function (data, status) {

                $('#fee_types').val(data[0].fee_name + ' - ' + data[0].fee);
                $('#total_amount').val(data[0].total_amount);

            }
        });
    });
    $('#edit_exam').on('change', function () {
        var exam_id = document.getElementById("edit_exam").value;

        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/edit-exam-class',
            data: {'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select class--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' ' + data[i].section_name + "</option>";
                }
                $('#view_exam_classes').html(option);
            }
        });
    });
    $('#view_exam_classes').on('change', function () {
        var class_section_id = document.getElementById("view_exam_classes").value;
        var exam_id = $('#edit_exam').val();
        console.log(class_section_id);
        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/edit-exam-subjects',
            data: {'class_section_id': class_section_id,
                'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#edit_exam_subject').html(option);
            }
        });
    });
    $('.staff_view_exam_classes').on('change', function () {
        var class_section_id = document.getElementById("view_exam_classes").value;
        var exam_id = $('#edit_exam').val();
        console.log(class_section_id);
        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/staff-edit-exam-subjects',
            data: {'class_section_id': class_section_id,
                'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#staff_edit_exam_subject').html(option);
            }
        });
    });
});
$(document).ready(function () {
    $('#book_section_id').on('change', function () {
        var class_section_id = document.getElementById("book_section_id").value;
        console.log(class_section_id);
        $.ajax({
            type: 'GET',
            url: '/get-student',
            data: {'class_section_id': class_section_id},
            dataType: 'json',
            success: function (data, status) {

                var option = "";
                option += "<option value=''>--Select Student--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].first_name + "</option>";
                }
                $('#student_id').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#exam').on('change', function () {
        var exam_id = document.getElementById("exam").value;

        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/get-exam-class',
            data: {'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select class--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' ' + data[i].section_name + "</option>";
                }
                $('#class_section').html(option);
            }
        });
    });
    $('#staff_exam').on('change', function () {
        var exam_id = document.getElementById("staff_exam").value;

        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/staff-get-exam-class',
            data: {'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select class--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' ' + data[i].section_name + "</option>";
                }
                $('#staff_class_section').html(option);
            }
        });
    });
    $('#remark_classes').on('change', function () {
        var class_section_id = document.getElementById("remark_classes").value;
        console.log(class_section_id);

        $.ajax({
            type: 'GET',
            url: '/remark-class-subjects',
            data: {'class_section_id': class_section_id
            },
            dataType: 'json',
            success: function (data, status) {

                var option1 = "";
                var option2 = "";
                option1 += "<option value=''>--select --</option>";
                for (i = 0; i < data.subjects.length; i++) {
                    option1 += "<option value='" + data.subjects[i].id + "'>" + data.subjects[i].subject_name + "</option>";
                }
                option2 += "<option value=''>--select --</option>";
                for (i = 0; i < data.students.length; i++) {

                    option2 += "<option value='" + data.students[i].student_id + "'>" + data.students[i].first_name + ' ' + data.students[i].last_name + "<img src='{{URL::asset('uploads/students/profile_photos/'" + data.students[i].photo + ")}}'></option>";
                }
                $('#remark_subject').html(option1);
                $('#remark_student').html(option2);
            }
        });
    });
    $('.academic_year_id').on('change', function () {
        var academic_year_id = document.getElementById("academic_year_id").value;
        console.log(academic_year_id);
        $.ajax({
            type: 'GET',
            url: '/academic-year-classes',
            data: {'academic_year_id': academic_year_id},
            dataType: 'json',
            success: function (data, status) {
                if (data) {
                    var option = "";
                    option += "<option value=''>--select class--</option>";
                    for (i = 0; i < data.length; i++) {
                        option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' ' + data[i].section_name + "</option>";
                    }
                    $('#migrate_student_class').html(option);
                }
            }
        });
    });
    $('#migrated_year').on('change', function () {
        var migrated_year = document.getElementById("migrated_year").value;
        console.log(migrated_year);
        $.ajax({
            type: 'GET',
            url: '/to-academic-year-classes',
            data: {'academic_year_id': migrated_year},
            dataType: 'json',
            success: function (data, status) {
                if (data) {
                    var option = "";
                    option += "<option value=''>--select class--</option>";
                    for (i = 0; i < data.length; i++) {
                        option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' ' + data[i].section_name + "</option>";
                    }
                    $('#migrated_class').html(option);
                }
            }
        });
    });
    $('#migrated_class').on('change', function () {
        var to_class_section_id = document.getElementById("migrated_class").value;
        var migrated_year = $('#migrated_year').val();
        console.log(migrated_year);
        console.log(to_class_section_id);
        //(to_class_section_id);
        $.ajax({
            type: 'GET',
            url: '/migrated_class_students',
            data: {'academic_year_id': migrated_year, 'class_section_id': to_class_section_id},
            dataType: 'json',
            success: function (data, status) {
               // alert(data.class_schedule);
                if (data) {
                    var option2 = "";
                    var option1 = "";
                    var option3 = "";
                for (i = 0; i < data.class_fees.length; i++) {
                    option3 += "<option value='" + data.class_fees[i].id + "'>" + '' + data.class_fees[i].fee_title + ' - '+ data.class_fees[i].fee_name + ' - ' + data.class_fees[i].fee_amount  + "</option>";
                }
                    for (i = 0; i < data.class_schedule.length; i++) {
                        option1 += "<option value='" + data.class_schedule[i].id + "'>" + '' + data.class_schedule[i].subject_name + ' - ' + data.class_schedule[i].day_title + ' ( ' + data.class_schedule[i].class_start + ' - ' + data.class_schedule[i].class_end + ' ) ' + "</option>";
                    }
                    for (i = 0; i < data.students.length; i++) {
                        option2 += "<option value='" + data.students[i].id + "'>" + '( ' + data.students[i].unique_id + ' ) ' + data.students[i].first_name + ' ' + data.students[i].last_name + "</option>";
                    }
                    $('#migrated_students').html(option2);
                    $('#migrated_class_subjects').html(option1);
                    $('#migrated_class_fees').html(option3);
                }
            }
        });
    });
    $('#migrate_student_class').on('change', function () {
        var class_section_id = document.getElementById("migrate_student_class").value;
        var academic_year_id = $('#academic_year_id').val();
        console.log(class_section_id);
        console.log(academic_year_id);
        $.ajax({
            type: 'GET',
            url: '/migrated-students',
            data: {'class_section_id': class_section_id, 'academic_year_id': academic_year_id
            },
            dataType: 'json',
            success: function (data, status) {
              
                var option1 = "";
                var option2 = "";
                var option3 = "";
                var option4 = "";
                for (i = 0; i < data.class_fees.length; i++) {
                    option4 += "<option value='" + data.class_fees[i].id + "'>" + '' + data.class_fees[i].fee_title + ' - '+ data.class_fees[i].fee_name + ' - ' + data.class_fees[i].fee_amount  + "</option>";
                }
                for (i = 0; i < data.class_schedules.length; i++) {
                    option1 += "<option value='" + data.class_schedules[i].id + "'>" + '' + data.class_schedules[i].subject_name + ' - ' + data.class_schedules[i].day_title + ' ( ' + data.class_schedules[i].class_start + ' - ' + data.class_schedules[i].class_end + ' ) ' + "</option>";
                }

                for (i = 0; i < data.students.length; i++) {
                    option2 += "<option value='" + data.students[i].student_id + "'>" + '( ' + data.students[i].unique_id + ' ) ' + data.students[i].first_name + ' ' + data.students[i].last_name + "</option>";
                }
                option3 += "<option value=''>------------- select new academic year  -----------</option>";
                for (i = 0; i < data.new_years.length; i++) {
                    option3 += "<option value='" + data.new_years[i].id + "'>" + data.new_years[i].year1 + ' - ' + data.new_years[i].year2 + ' ( ' + data.new_years[i].from_year + ' to ' + data.new_years[i].to_year + ' ) ' + "</option>";
                }
                $('#migrated_class_students').html(option2);
                $('#class_subjects').html(option1);
                $('#migrated_year').html(option3);
                $('#class_fees').html(option4);
            }
        });
    });

    $('#staff_class_section').on('change', function () {
        var class_section_id = document.getElementById("staff_class_section").value;
        var exam_id = $('#staff_exam').val();
        console.log(class_section_id);
        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/staff-get-exam-subjects',
            data: {'class_section_id': class_section_id,
                'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#staff_exam_subject').html(option);
            }
        });
    });
    $('#class_section').on('change', function () {
        var class_section_id = document.getElementById("class_section").value;
        var exam_id = $('#exam').val();
        console.log(class_section_id);
        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/get-exam-subjects',
            data: {'class_section_id': class_section_id,
                'exam_id': exam_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#exam_subject').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#cid').on('change', function () {
        var data1 = document.getElementById("cid").value;

        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get_sections',
            data: {'data1': data1},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Section--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].section_name + "</option>";
                }
                $('#section').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#class_section_id').on('change', function () {
        var class_section_id = document.getElementById("class_section_id").value;
        var day_id = $('#day_id').val();
        console.log(class_section_id);
        console.log(day_id);
        $.ajax({
            type: 'GET',
            url: '/get_subjects',
            data: {'class_section_id': class_section_id,
                'day_id': day_id
            },
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#subject_id').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#staff_id').on('change', function () {
        var staff_id = document.getElementById("staff_id").value;
        console.log(staff_id);
        $.ajax({
            type: 'GET',
            url: '/get-staff-salary',
            data: {'staff_id': staff_id},
            dataType: 'json',
            success: function (data, status) {
                $('#total_salary').val(data[0].total_salary);
            }
        });
    });
    $('#staff_id').on('change', function () {
        var staff_id = document.getElementById("staff_id").value;
        console.log(staff_id);
        $.ajax({
            type: 'GET',
            url: '/get-staff-months',
            data: {'staff_id': staff_id},
            dataType: 'json',
            success: function (data, status) {

                var option = "";
                option += "<option value=''>--Select month--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].month + "</option>";
                }
                $('#month_id').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#month_id').on('change', function () {
        var month_id = document.getElementById("month_id").value;
        var total_salary = $('#total_salary').val();
        var staff_id = $('#staff_id').val();
        console.log(month_id);
        console.log(staff_id);
        console.log(total_salary);
        $.ajax({
            type: 'GET',
            url: '/get-staff-working-days',
            data: {'month_id': month_id,
                'staff_id': staff_id,
                'total_salary': total_salary
            },
            dataType: 'json',
            success: function (data, status) {
                $('#working_days').val('WD (' + data.working_days + ') | Present  (' + data.present + ') | Absent  (' + data.absent + ') | CL / month  ( ' + data.casual_leaves + ') | salary cut for  (' + data.salary_cut_days + ' D)');
                $('#gross_salary').val(data.gross_salary);
                $('#deducted_salary').val(data.deducted_salary);
            }
        });
    });
});

$(document).ready(function () {
    $('#staff_type_id').on('change', function () {
        var staff_type_id = document.getElementById("staff_type_id").value;

        console.log(staff_type_id);
        $.ajax({
            type: 'GET',
            url: '/get-department',
            data: {'staff_type_id': staff_type_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''> --- select department --- </option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].title + "</option>";
                }
                $('#staff_department_id').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#staff_department_id').on('change', function () {
        var staff_department_id = document.getElementById("staff_department_id").value;
        var staff_type_id = $('#staff_type_id').val();
        console.log(staff_department_id);
        console.log(staff_type_id);
        $.ajax({
            type: 'GET',
            url: '/get-staff',
            data: {'staff_department_id': staff_department_id,
                'staff_type_id': staff_type_id, },
            dataType: 'json',
            success: function (data, status) {
                var option1 = "";
                option1 += "<option value=''>--Select staff--</option>";
                for (i = 0; i < data.length; i++) {
                    option1 += "<option value='" + data[i].id + "'>" + data[i].first_name + ' ' + data[i].last_name + ' ( ' + data[i].employee_id + ' ) ' + "</option>";
                }
                $('#staff_id').html(option1);
            }
        });
    });
});

$(document).ready(function () {
    $('#state').on('change', function () {
        var data1 = $('#state').val();
        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get-city',
            data: {'data1': data1},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select City--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].city_name + "</option>";
                }
                $('#city').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#c_s_id').on('change', function () {
        var class_section_id = document.getElementById("c_s_id").value;
        console.log(class_section_id);
        $.ajax({
            type: 'GET',
            url: '/get-staff-subjects',
            data: {'class_section_id': class_section_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#subject_id').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#c_section_id').on('change', function () {
        var class_section_id = document.getElementById("c_section_id").value;
        //alert(class_section_id);
        $.ajax({
            type: 'GET',
            url: '/get-student-subjects',
            data: {'class_section_id': class_section_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Subject--</option>";
                option +="<option value='" + "s" + "'>" + "All Subjects" + "</option>";
                for (i = 0; i < data.length; i++) {    
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#sub_id').html(option);
            }
        });
    });
});
$(document).ready(function () {
    $('#staff_c_section_id').on('change', function () {
        var class_section_id = document.getElementById("staff_c_section_id").value;
        console.log(class_section_id);
        $.ajax({
            type: 'GET',
            url: '/staff-get-student-subjects',
            data: {'class_section_id': class_section_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Subject--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].subject_name + "</option>";
                }
                $('#su_id').html(option);
            }
        });

    });
    $('.staff_c_section_id').on('change', function () {
        var class_section_id = document.getElementById("staff_c_section_id").value;
        $.ajax({
            type: 'GET',
            url: '/staff-remark-class-students',
            data: {'class_section_id': class_section_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select student--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].unique_id + ' - ' + data[i].first_name + "</option>";
                }
                $('#s_id').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#subject_id').on('change', function () {
        var subject_id = document.getElementById("subject_id").value;
        var day_id = $('#day_id').val();
        var class_section_id = $('#class_section_id').val();
        console.log(subject_id);
        console.log(day_id);
        console.log(class_section_id);
        $.ajax({
            type: 'GET',
            url: '/get_timings',
            data: {'subject_id': subject_id,
                'day_id': day_id,
                'class_section_id': class_section_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select timings--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].title + ' - ' + data[i].class_start + '   to   ' + data[i].class_end + ' ( ' + data[i].duration + ' ) ' + "</option>";
                }
                $('#institute_timing_id').html(option);
                $('#class_start').val(data[0].class_start);
                $('#class_end').val(data[0].class_end);
            }
        });
    });
});

$(document).ready(function () {
    $('#state').on('change', function () {
        var data1 = $('#state').val();
        console.log(data1);
        $.ajax({
            type: 'GET',
            url: '/get-city',
            data: {'data1': data1},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select City--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].city_name + "</option>";
                }
                $('#city').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#fee_id').on('change', function () {
        var fee_id = $('#fee_id').val();
        console.log(fee_id);
        $.ajax({
            type: 'GET',
            url: '/get-fee-classes',
            data: {'fee_id': fee_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select classes--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' ' + data[i].section_name + "</option>";
                }
                $('#fee-classes').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#vehicle_route').on('change', function () {
        var vehicle_route_id = $('#vehicle_route').val();
        console.log(vehicle_route_id);
        $.ajax({
            type: 'GET',
            url: '/get-route-stops',
            data: {'vehicle_route_id': vehicle_route_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--select stop(s)--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].stop_name + '  ( Pickup Time : ' + data[i].pickup_time + ' - Drop Time : ' + data[i].drop_time + ' )' + "</option>";
                }
                $('#stops').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#class_section_exam_id').on('change', function () {
        var exam_id = document.getElementById("class_section_exam_id").value;

        console.log(exam_id);
        $.ajax({
            type: 'GET',
            url: '/get_class_section',
            data: {'exam_id': exam_id,
            },
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select Class-Section--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].class_name + ' - ' + data[i].section_name + "</option>";
                }
                $('#class_name').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#student_class').on('change', function () {
        var class_section_id = document.getElementById("student_class").value;

        console.log(class_section_id);
        $.ajax({
            type: 'GET',
            url: '/get-class-students',
            data: {'class_section_id': class_section_id,
            },
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select student--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].unique_id + ' - ' + data[i].first_name + "</option>";
                }
                $('#students').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#vehicletypeid').on('change', function () {
        var vehicle_type_id = document.getElementById("vehicletypeid").value;

        console.log(vehicle_type_id);
        $.ajax({
            type: 'GET',
            url: '/get-vehicles',
            data: {'vehicle_type_id': vehicle_type_id,
            },
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select vehicle--</option>";
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].vehicle_number + ' - ' + data[i].owner_name + "</option>";
                }
                $('#vehicles').html(option);
            }
        });
    });
});

$(document).ready(function () {
    $('#student_type_id').on('change', function () {
        var student_type_id = document.getElementById("student_type_id").value;
        if (student_type_id == '1') {
            $.ajax({
                type: 'GET',
                url: '/student-transport-routes',
                data: {'student_type_id': student_type_id},
                dataType: 'json',
                success: function (data, status) {
                    var option = "";
                    option += "<option value=''>--Select route--</option>";
                    for (i = 0; i < data.length; i++) {
                        option += "<option value='" + data[i].id + "'>" + data[i].route_from + ' - ' + data[i].route_to + "</option>";
                    }
                    $('#routes').html(option);
                }
            });

        } else {
            $('#routes').html('<option>--Slect student as transport to see routes--</option>');
        }
    });
});

$(document).ready(function () {
    $('#routes').on('change', function () {
        var route_id = document.getElementById("routes").value;
        //alert(route_id);
        $.ajax({
            type: 'GET',
            url: '/student-route-stops',
            data: {'route_id': route_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
                option += "<option value=''>--Select stop--</option>";
                if(data){
                for (i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].stop_name + ' - P : ' + data[i].pickup_time + ' D: ' + data[i].drop_time + "</option>";
                }}
                $('#stop_id').html(option);
            }
        });
    });
});
