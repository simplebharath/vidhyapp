<?php

Route::get('/', function () {
    return view('users/login');
});
Route::post('academic-year-session', 'AdminLoginController@update_session');
//########################################### * INSTITUTE ADMIN SETTINGS * ############################################################
Route::get('settings/add-academic-year', 'SettingsController@add_academic_year');
Route::post('settings/do-add-academic-year', 'SettingsController@do_add_academic_year');
Route::post('settings/do-update-academic-year', 'SettingsController@do_update_academic_year');
Route::get('settings/edit-institution-details', 'SettingsController@edit_institution_details');
Route::post('settings/update-institution-details', 'SettingsController@update_institution_details');
//########################################### * INSTITUTE ADMIN SETTINGS * ############################################################

Route::get('admin-login', 'AdminLoginController@admin_login');
Route::post('admin-authenticate', 'AdminLoginController@admin_authenticate');
Route::get('admin-dashboard', 'DashboardController@admin_dashboard');
Route::get('admin-logout', 'AdminLoginController@admin_logout');

Route::get('dashboard-search', 'DashboardController@dashboard_search');
Route::get('get_events', 'DashboardController@get_events');
Route::get('attendance-chart', 'DashboardController@attendance_chart');
Route::post('change-date-session', 'DashboardController@change_date_session');
//########################################### * MANAGE CLASSES START * ############################################################
include('allRoutes/classes.php');
//########################################### * MANAGE CLASSES END * ############################################################
//########################################### * MANAGE STAFF * ############################################################
include('allRoutes/staff.php');
//########################################### * STAFF END * ############################################################
//########################################### * MANAGE STUDENTS * ############################################################
//***********************************/ STUDENT TYPES /**********************************************************

Route::get('add-student-type', 'StudentTypesController@add_student_type');
Route::post('do-add-student-type', 'StudentTypesController@do_add_student_type');
Route::get('view-student-types', 'StudentTypesController@view_student_types');
Route::get('edit-student-type/{student_type_id}', 'StudentTypesController@edit_student_type');
Route::post('do-edit-student-type/{student_type_id}', 'StudentTypesController@do_edit_student_type');
Route::get('delete-student-type/{student_type_id}', 'StudentTypesController@delete_student_type');
Route::get('make-active-student-type/{student_type_id}', 'StudentTypesController@make_active_student_type');
Route::get('make-inactive-student-type/{student_type_id}', 'StudentTypesController@make_inactive_student_type');

//**********************************/  STUDENTS DETAILS /***********************************************************

Route::get('add-student', 'StudentController@add_student');
Route::post('do-add-student', 'StudentController@do_add_student');
Route::get('view-students', 'StudentController@view_students');
Route::get('edit-student/{student_id}', 'StudentController@edit_student');
Route::post('do-edit-student/{student_id}', 'StudentController@do_edit_student');
//Route::get('delete-student/{student_id}', 'StudentController@delete_student');
Route::get('make-active-student/{student_id}', 'StudentController@make_active_student');
Route::get('make-inactive-student/{student_id}', 'StudentController@make_inactive_student');
Route::get('student-add-rights-make-no/{student_id}', 'StudentController@student_add_right_make_no');
Route::get('student-add-rights-make-yes/{student_id}', 'StudentController@student_add_right_make_yes');
Route::get('student-edit-rights-make-no/{student_id}', 'StudentController@student_edit_right_make_no');
Route::get('student-edit-rights-make-yes/{student_id}', 'StudentController@student_edit_right_make_yes');
Route::get('student-view-rights-make-yes/{student_id}', 'StudentController@student_view_right_make_yes');
Route::get('student-view-rights-make-no/{student_id}', 'StudentController@student_view_right_make_no');

Route::get('student-transport-routes', 'StudentController@student_transport_route');
Route::get('student-route-stops', 'StudentController@student_route_stops');

//**********************************/  PARENT DETAILS /***********************************************************
Route::get('add-parent/{student_id}', 'ParentController@add_parent');
Route::post('do-add-parent/{student_id}', 'ParentController@do_add_parent');
Route::get('view-parents', 'ParentController@view_parents');
Route::get('view-parent-profile/{student_id}/{parent_id}', 'ParentController@view_parent_profile');
Route::get('edit-parent/{parent_id}', 'ParentController@edit_parent');
Route::post('do-edit-parent/{parent_id}', 'ParentController@do_edit_parent');
//Route::get('delete-parent/{parent_id}', 'ParentController@delete_parent');
Route::get('make-active-parent/{parent_id}', 'ParentController@make_active_parent');
Route::get('make-inactive-parent/{parent_id}', 'ParentController@make_inactive_parent');
Route::get('parent-add-rights-make-no/{parent_id}', 'ParentController@parent_add_right_make_no');
Route::get('parent-add-rights-make-yes/{parent_id}', 'ParentController@parent_add_right_make_yes');
Route::get('parent-edit-rights-make-no/{parent_id}', 'ParentController@parent_edit_right_make_no');
Route::get('parent-edit-rights-make-yes/{parent_id}', 'ParentController@parent_edit_right_make_yes');
Route::get('parent-view-rights-make-yes/{parent_id}', 'ParentController@parent_view_right_make_yes');
Route::get('parent-view-rights-make-no/{parent_id}', 'ParentController@parent_view_right_make_no');

//**********************************/ STUDENT Qualification /***********************************************************
Route::get('add-student-education/{student_id}', 'StudentPreviousEducationController@add_student_education');
Route::post('do-add-student-education/{student_id}', 'StudentPreviousEducationController@do_add_student_education');
Route::get('view-student-educations/{student_id}', 'StudentPreviousEducationController@view_student_educations');
Route::get('edit-student-education/{student_id}/{q_id}', 'StudentPreviousEducationController@edit_student_education');
Route::post('do-edit-student-education/{student_id}/{q_id}', 'StudentPreviousEducationController@do_edit_student_education');
Route::get('delete-student-education/{student_id}/{q_id}', 'StudentPreviousEducationController@delete_student_education');

//**********************************/ STUDENT Documents /***********************************************************
Route::get('add-student-document/{student_id}', 'StudentDocumentsController@add_student_document');
Route::post('do-add-student-document/{student_id}', 'StudentDocumentsController@do_add_student_document');
Route::get('delete-student-document/{student_id}/{d_id}', 'StudentDocumentsController@delete_student_document');
//**********************************/ STUDENT Attendance /***********************************************************
Route::get('add-student-attendance', 'StudentAttendanceController@add_student_attendance');
Route::get('get-student-subjects', 'StudentAttendanceController@get_student_subjects');
Route::post('get_students_all', 'StudentAttendanceController@get_student_all');
Route::post('save-students-attendance', 'StudentAttendanceController@save_student_attendance');
Route::get('view-students-attendance', 'StudentAttendanceController@view_students_attendance');
Route::get('view-student-attendance/{student_id}', 'StudentAttendanceController@view_student_total_attendance');
Route::get('view-student-monthly-attendance/{month}/{student_id}', 'StudentAttendanceController@view_student_monthly_attendance');
Route::get('view-student-subject-attendance/{month}/{student_id}/{subject_id}', 'StudentAttendanceController@view_student_subject_attendance');

Route::get('edit-student-attendance', 'StudentAttendanceController@edit_student_attendance');
//**********************************/ STUDENT MARKS /***********************************************************
Route::get('get-students-marks', 'StudentMarksController@get_students_marks');
Route::get('get-exam-class', 'StudentMarksController@get_exam_class');
Route::get('get-exam-subjects', 'StudentMarksController@get_exam_subjects');
Route::get('get-exam-students', 'StudentMarksController@get_exam_students');
Route::post('save-students-marks', 'StudentMarksController@save_students_marks');
Route::get('view-students-marks', 'StudentMarksController@view_students_marks');
Route::get('edit-student-marks/{exam}/{class}/{subject}', 'StudentMarksController@edit_students_marks');
Route::post('update-students-marks/{exam}/{class}/{subject}', 'StudentMarksController@update_students_marks');

Route::get('get-student-exam-subject-marks', 'StudentMarksController@get_student_exam_subject_marks');
Route::post('update-student-all-ubject-marks', 'StudentMarksController@update_student_all_subject_marks');
Route::get('marks-added-students', 'StudentMarksController@marks_added_students');
Route::get('edit-exam-class', 'StudentMarksController@edit_exam_class');
Route::get('edit-exam-subjects', 'StudentMarksController@edit_exam_subjects');
Route::get('edit-student-subject-marks', 'StudentMarksController@edit_student_subject_marks');
Route::post('update-student-subject-marks', 'StudentMarksController@update_student_subject_marks');
Route::get('get-marks-added-students/{exam}/{class}/{subject}', 'StudentMarksController@get_marks_added_students');
Route::post('save-individual-marks', 'StudentMarksController@save_student_exam_subject_marks');
//**********************************/ STUDENT ReMARKS /***********************************************************
Route::get('get-students-remarks', 'StudentRemarksController@get_students_remarks');
Route::get('remark-class-subjects', 'StudentRemarksController@remark_class_subjects');
Route::post('add-remarks-students', 'StudentRemarksController@add_remarks_students');
Route::post('do-add-remarks-students', 'StudentRemarksController@do_add_student_remarks');
Route::get('view-students-remarks', 'StudentRemarksController@view_students_remarks');
Route::get('edit-remark/{remark_id}', 'StudentRemarksController@edit_remarks');
Route::post('do-edit-remark/{remark_id}', 'StudentRemarksController@do_edit_remarks');
Route::get('delete-remark/{remark_id}', 'StudentRemarksController@delete_remarks');
//**********************************/ STUDENT Assignments /***********************************************************
Route::get('get-students-assignments', 'StudentAssignmentController@get_students_assignments');
Route::get('get-assignment-students-list', 'StudentAssignmentController@get_assignment_students_list');
Route::post('do-add-assignment-class', 'StudentAssignmentController@do_add_assignment_class');
Route::get('view-class-assignments', 'StudentAssignmentController@view_class_assignments');
Route::get('edit-assignment/{assignment_id}', 'StudentAssignmentController@edit_assignment');
Route::post('do-edit-assignment-class/{assignment_id}', 'StudentAssignmentController@do_edit_assignment');
Route::get('delete-assignment/{assignment_id}', 'StudentAssignmentController@delete_assignment');
//**********************************/  STUDENTS Profile /***********************************************************
Route::get('view-student-profile/{student_id}', 'StudentProfileController@view_student_profile');
Route::get('view-student-profile', 'StudentProfileController@view_student_prof');
Route::get('view-student-timetable/{student_id}/{class_section_id}', 'StudentProfileController@view_student_timetable');
Route::get('view-student-documents/{student_id}', 'StudentProfileController@view_student_documents');
Route::get('view-student-fees/{student_id}', 'StudentProfileController@view_student_fees');
Route::get('view-student-payment-history/{student_id}', 'StudentProfileController@view_student_payment_history');
Route::get('view-student-assignments/{student_id}', 'StudentProfileController@view_student_assignments');
Route::get('view-student-remarks/{student_id}', 'StudentProfileController@view_student_remarks');
Route::get('view-student-exams/{student_id}', 'StudentProfileController@view_student_exams');
Route::get('view-student-exam-timetable/{exam_id}/{student_id}', 'StudentProfileController@view_student_exam_timetable');
Route::get('view-student-marks/{exam_id}/{student_id}', 'StudentProfileController@view_student_marks');
Route::get('view-student-transport/{route_id}/{stop_id}/{student_id}', 'StudentProfileController@view_student_transport');

Route::get('student-fee-discount/{student_id}/{fee_id}', 'FeeDiscountController@student_fee_discount');
Route::get('get-student-total-fee/{class_section_id}', 'FeeDiscountController@get_student_total_fee');
Route::get('view-fee-discounts/{student_id}', 'FeeDiscountController@view_fee_discounts');
Route::post('do-add-fee-discount/{student_id}', 'FeeDiscountController@do_add_fee_discount');
Route::get('edit-fee-discount/{d_id}', 'FeeDiscountController@edit_fee_discount');
Route::post('do-edit-fee-discount/{student_id}', 'FeeDiscountController@do_edit_fee_discount');
Route::get('view-all-student-fee-discounts', 'FeeDiscountController@view_all_student_fee_discounts');
//########################################### * MANAGE STUDENTS END * ############################################################
//########################################### * FINANCE/FEES * ##################################################################
//**********************************/ FEES /***********************************************************
Route::get('add-fee', 'FeeController@add_fee');
Route::post('do-add-fee', 'FeeController@do_add_fee');
Route::get('view-fees', 'FeeController@view_fee');
Route::get('edit-fee/{fee_id}', 'FeeController@edit_fee');
Route::post('do-edit-fee/{fee_id}', 'FeeController@do_edit_fee');
Route::get('delete-fee/{fee_id}', 'FeeController@delete_fee');
Route::get('make-active-fee/{fee_id}', 'FeeController@make_active_fee');
Route::get('make-inactive-fee/{fee_id}', 'FeeController@make_inactive_fee');

//**********************************/ Assign Fee types/***********************************************************
Route::get('add-fee-feetype', 'AssignFeetypesController@add_fee_feetype');
Route::post('do-add-fee-feetype', 'AssignFeetypesController@do_add_fee_feetype');
Route::get('view-fee-feetypes', 'AssignFeetypesController@view_fee_feetype');
Route::get('edit-fee-feetype/{fee_id}', 'AssignFeetypesController@edit_fee_feetype');
Route::post('do-edit-fee-feetype/{fee_id}', 'AssignFeetypesController@do_edit_fee_feetype');
Route::get('delete-fee-feetype/{fee_id}', 'AssignFeetypesController@delete_fee_feetype');
Route::get('make-active-fee-feetype/{fee_id}', 'AssignFeetypesController@make_active_fee_feetype');
Route::get('make-inactive-fee-feetype/{fee_id}', 'AssignFeetypesController@make_inactive_fee_feetype');
//**********************************/ Class FEES /***********************************************************
Route::get('add-class-fee', 'ClassFeesController@add_class_fee');
Route::get('get-fee-classes', 'ClassFeesController@get_fee_classes');
Route::post('do-add-class-fee', 'ClassFeesController@do_add_class_fee');
Route::get('view-class-fees', 'ClassFeesController@view_class_fee');
Route::get('edit-class-fee/{fee_id}', 'ClassFeesController@edit_class_fee');
Route::post('do-edit-class-fee/{fee_id}', 'ClassFeesController@do_edit_class_fee');
Route::get('delete-class-fee/{fee_id}', 'ClassFeesController@delete_class_fee');
Route::get('make-active-class-fee/{fee_id}', 'ClassFeesController@make_active_class_fee');
Route::get('make-inactive-class-fee/{fee_id}', 'ClassFeesController@make_inactive_class_fee');
//**********************************/ Transport FEES /***********************************************************
Route::get('add-transport-fee', 'TransportFeesController@add_transport_fee');
Route::get('get-route-stops', 'TransportFeesController@get_route_stops');
Route::post('do-add-transport-fee', 'TransportFeesController@do_add_transport_fee');
Route::get('view-transport-fees', 'TransportFeesController@view_transport_fee');
Route::get('edit-transport-fee/{fee_id}', 'TransportFeesController@edit_transport_fee');
Route::post('do-edit-transport-fee/{fee_id}', 'TransportFeesController@do_edit_transport_fee');
Route::get('delete-transport-fee/{fee_id}', 'TransportFeesController@delete_transport_fee');
Route::get('make-active-transport-fee/{fee_id}', 'TransportFeesController@make_active_transport_fee');
Route::get('make-inactive-transport-fee/{fee_id}', 'TransportFeesController@make_inactive_transport_fee');
//**********************************/ Payments /***********************************************************
Route::get('students-fee-payments', 'StudentFeePaymentsController@students_fee_payments');
Route::get('get-class-students', 'StudentFeePaymentsController@get_class_students');
Route::post('get-students-all', 'StudentFeePaymentsController@view_students_list');
Route::get('get-students-all/{student_id}', 'StudentFeePaymentsController@view_students_by_id');
Route::get('view-student-fee/{student_id}', 'StudentFeePaymentsController@view_student_fee');
Route::get('payment-history-institute', 'StudentFeePaymentsController@payment_history_institute');
//Route::get('get-student-payments/{student_id}/{fee_id}', 'StudentFeePaymentsController@get_student_payments');

Route::get('pay_student_fee', 'StudentFeePaymentsController@pay_student_fee');
Route::post('do-pay-fee/{student_id}', 'StudentFeePaymentsController@do_pay_fee_now');
//########################################### * FINANCE/FEES END * ##############################################################
//########################################### * TRANSPORT START * ############################################################
//*********************************/ Vehicle Types/************************************************************/
Route::get('add-vehicle-type', 'VehicleTypesController@add_vehicle_type');
Route::post('do-add-vehicle-type', 'VehicleTypesController@do_add_vehicle_type');
Route::get('view-vehicle-types', 'VehicleTypesController@view_vehicle_types');
Route::get('edit-vehicle-type/{vehicle_type_id}', 'VehicleTypesController@edit_vehicle_type');
Route::post('do-edit-vehicle-type/{vehicle_type_id}', 'VehicleTypesController@do_edit_vehicle_type');
Route::get('make-active-vehicle-type/{vehicle_type_id}', 'VehicleTypesController@make_active_vehicle_type');
Route::get('make-inactive-vehicle-type/{vehicle_type_id}', 'VehicleTypesController@make_inactive_vehicle_type');
Route::get('delete-vehicle-type/{vehicle_type_id}', 'VehicleTypesController@delete_vehicle_type');

//*********************************/ Vehicles/************************************************************/
Route::get('add-vehicle', 'VehiclesController@add_vehicle');
Route::post('do-add-vehicles', 'VehiclesController@do_add_vehicle');
Route::get('view-vehicles', 'VehiclesController@view_vehicle');
Route::get('edit-vehicle/{vehicle_id}', 'VehiclesController@edit_vehicle');
Route::post('do-edit-vehicle/{vehicle_id}', 'VehiclesController@do_edit_vehicle');
Route::get('delete-vehicle/{vehicle_id}', 'VehiclesController@delete_vehicle');
Route::get('make-active-vehicle/{vehicle_id}', 'VehiclesController@make_active_vehicle');
Route::get('make-inactive-vehicle/{vehicle_id}', 'VehiclesController@make_inactive_vehicle');


//*********************************/ Vehicles routes/************************************************************/
Route::get('add-vehicle-route', 'VehicleRoutesController@add_vehicle_route');
Route::post('do-add-vehicle-route', 'VehicleRoutesController@do_add_vehicle_route');
Route::get('view-vehicles-routes', 'VehicleRoutesController@view_vehicle_routes');
Route::get('delete-vehicle-route/{vehicle_route_id}', 'VehicleRoutesController@delete_vehicle_route');
Route::get('make-active-vehicle-route/{vehicle_route_id}', 'VehicleRoutesController@make_active_vehicle_route');
Route::get('make-inactive-vehicle-route/{vehicle_route_id}', 'VehicleRoutesController@make_inactive_vehicle_route');
Route::get('edit-vehicle-route/{vehicle_route_id}', 'VehicleRoutesController@edit_vehicle_route');
Route::post('do-edit-vehicle-route/{vehicle_route_id}', 'VehicleRoutesController@do_edit_vehicle_route');

//*********************************/  route stops/************************************************************/

Route::get('view-route-stops', 'RouteStopsController@view_route_stops');
Route::get('add-route-stop', 'RouteStopsController@add_route_stop');
Route::post('do-add-route-stop', 'RouteStopsController@do_aadd_route_stop');
Route::get('delete-route-stop/{route_stop_id}', 'RouteStopsController@delete_route_stop');
Route::get('make-active-route-stop/{route_stop_id}', 'RouteStopsController@make_active_route_stop');
Route::get('make-inactive-route-stop/{route_stop_id}', 'RouteStopsController@make_inactive_route_stop');
Route::get('edit-route-stop/{route_stop_id}', 'RouteStopsController@edit_route_stop');
Route::post('do-edit-route-stop/{route_stop_id}', 'RouteStopsController@do_edit_route_stop');

//*********************************/ vehicle drivers/************************************************************/
Route::get('add-vehicle-driver', 'VehicleDriversController@add_vehicle_driver');
Route::post('do-add-vehicle-driver', 'VehicleDriversController@do_add_vehicle_driver');
Route::get('view-vehicle-drivers', 'VehicleDriversController@view_vehicle_drivers');
Route::get('edit-vehicle-driver/{vehicle_driver_id}', 'VehicleDriversController@edit_vehicle_driver');
Route::post('do-edit-vehicle-driver/{vehicle_driver_id}', 'VehicleDriversController@do_edit_vehicle_driver');
Route::get('delete-vehicle-driver/{vehicle_driver_id}', 'VehicleDriversController@delete_vehicle_driver');
Route::get('make-active-vehicle-driver/{vehicle_driver_id}', 'VehicleDriversController@make_active_vehicle_driver');
Route::get('make-inactive-vehicle-driver/{vehicle_driver_id}', 'VehicleDriversController@make_inactive_vehicle_driver');

Route::get('get-vehicles', 'VehicleDriversController@get_vehicles');


//*********************************/ Meter Reading/************************************************************/
Route::get('view-meter-reading', 'MeterReadingController@view_meter_reading');
Route::get('add-meter-reading', 'MeterReadingController@add_meter_reading');
Route::post('do-add-meter-reading', 'MeterReadingController@do_add_meter_reading');
Route::get('edit-meter-reading/{meter_reading_id}', 'MeterReadingController@edit_meter_reading');
Route::post('do-edit-meter-reading/{meter_reading_id}', 'MeterReadingController@do_edit_meter_reading');
Route::get('delete-meter-reading/{meter_reading_id}', 'MeterReadingController@delete_meter_reading');
Route::get('make-active-meter-reading/{meter_reading_id}', 'MeterReadingController@make_active_meter_reading');
Route::get('make-inactive-meter-reading/{meter_reading_id}', 'MeterReadingController@make_inactive_meter_reading');


//*********************************/ Fuel /************************************************************/
Route::get('view-fuel', 'FuelController@view_fuel');
Route::get('add-fuel', 'FuelController@add_fuel');
Route::post('do-add-fuel', 'FuelController@do_add_fuel');
Route::get('edit-fuel/{fuel_id}', 'FuelController@edit_fuel');
Route::post('do-edit-fuel/{fuel_id}', 'FuelController@do_edit_fuel');
Route::get('delete-fuel/{fuel_id}', 'FuelController@delete_fuel');
Route::get('make-active-fuel/{fuel_id}', 'FuelController@make_active_fuel');
Route::get('make-inactive-fuel/{fuel_id}', 'FuelController@make_inactive_fuel');
Route::get('get-driver', 'FuelController@get_driver');
//########################################### * TRANSPORT END * ############################################################
//########################################### * EXAMS START* ############################################################
//*********************************/ exams/************************************************************/
Route::get('add-exam', 'ExamController@add_exam');
Route::post('do-add-exam', 'ExamController@do_add_exam');
Route::get('view-exams', 'ExamController@view_exams');
Route::get('edit-exam/{exam_id}', 'ExamController@edit_exam');
Route::post('do-edit-exam/{exam_id}', 'ExamController@do_edit_exam');
Route::get('delete-exam/{exam_id}', 'ExamController@delete_exam');
Route::get('make-active-exam/{exam_id}', 'ExamController@make_active_exam');
Route::get('make-inactive-exam/{exam_id}', 'ExamController@make_inactive_exam');


//*********************************/ class_exams/************************************************************/
Route::get('get_class_section', 'ClassExamsController@get_class_section');
Route::get('view-class-exams', 'ClassExamsController@view_class_exams');
Route::get('add-class-exam', 'ClassExamsController@add_class_exam');
Route::post('do-add-class-exam', 'ClassExamsController@do_add_class_exam');
Route::get('edit-class-exam/{class_section_exam_id}', 'ClassExamsController@edit_class_exam');
Route::post('do-edit-class-exam/{class_section_exam_id}', 'ClassExamsController@do_edit_class_exam');
Route::get('delete-class-exam/{class_section_exam_id}', 'ClassExamsController@delete_class_exam');
Route::get('make-active-class-exam/{class_section_exam_id}', 'ClassExamsController@make_active_class_exam');
Route::get('make-inactive-class-exam/{class_section_exam_id}', 'ClassExamsController@make_inactive_class_exam');
Route::get('add-schedule-exams', 'ClassExamsController@add_schedule_exams');

//*********************************/ Shedule_exams/************************************************************/

Route::get('view-schedule-exams', 'ScheduleExamsController@view_schedule_exams');
Route::get('add-schedule-exams/{exam_id}/{class_section_id}', 'ScheduleExamsController@add_schedule_exams');
Route::post('do-add-schedule-exams/{exam_id}/{class_section_id}', 'ScheduleExamsController@do_add_schedule_exams');
Route::get('edit-schedule-exams/{schedule_exams_id}', 'ScheduleExamsController@edit_schedule_exams');
Route::post('do-edit-schedule-exams/{schedule_exams_id}', 'ScheduleExamsController@do_edit_schedule_exams');
Route::get('delete-schedule-exams/{schedule_exams_id}', 'ScheduleExamsController@delete_schedule_exams');
Route::get('make-active-schedule-exam/{schedule_exams_id}', 'ScheduleExamsController@make_active_schedule_exam');
Route::get('make-inactive-schedule-exam/{schedule_exams_id}', 'ScheduleExamsController@make_inactive_schedule_exam');

//########################################### * EXAMS END * ################################################################
//########################################### * INVENTORY START * ############################################################
////*********************************/ Products/************************************************************/
Route::get('add-product', 'ProductsController@add_product');
Route::post('do-add-product', 'ProductsController@do_add_product');
Route::get('view-products', 'ProductsController@view_products');
Route::get('edit-product/{product_id}', 'ProductsController@edit_product');
Route::post('do-edit-product/{product_id}', 'ProductsController@do_edit_product');
Route::get('delete-product/{product_id}', 'ProductsController@delete_product');
Route::get('make-active-product/{product_id}', 'ProductsController@make_active_product');
Route::get('make-inactive-product/{product_id}', 'ProductsController@make_inactive_product');

//*********************************/ Products_Quantities/************************************************************/
Route::get('view-product-quantities', 'ProductQuantityController@view_products_quantities');
Route::get('add-product-quantity', 'ProductQuantityController@add_product_quantity');
Route::post('do-add-product-quantity', 'ProductQuantityController@do_add_product_quantity');
Route::get('edit-product-quantity/{product_quantity_id}', 'ProductQuantityController@edit_product_quantity');
Route::post('do-product-quantity/{product_quantity_id}', 'ProductQuantityController@do_edit_product_quantity');
Route::get('delete-product-quantity/{product_quantity_id}', 'ProductQuantityController@delete_product_quantity');
Route::get('make-active-product-quantity/{product_quantity_id}', 'ProductQuantityController@make_active_product_quantity');
Route::get('make-inactive-product-quantity/{product_quantity_id}', 'ProductQuantityController@make_inactive_product_quantity');
//########################################### * INVENTORY END * ############################################################
//########################################### * EXPENSES START * ############################################################
//*********************************/ Expense_type/************************************************************/
Route::get('add-expense-type', 'ExpenseTypesController@add_expense_type');
Route::post('do-add-expense-type', 'ExpenseTypesController@do_add_expense_type');
Route::get('view-expense-types', 'ExpenseTypesController@view_expense_types');
Route::get('edit-expense-type/{expense_type_id}', 'ExpenseTypesController@edit_expense_type');
Route::post('do-edit-expense-type/{expense_type_id}', 'ExpenseTypesController@do_edit_expense_type');
Route::get('delete-expense-type/{expense_type_id}', 'ExpenseTypesController@delete_expense_type');
Route::get('make-active-expense-type/{expense_type_id}', 'ExpenseTypesController@make_active_expense_type');
Route::get('make-inactive-expense-type/{expense_type_id}', 'ExpenseTypesController@make_inactive_expense_type');

//*********************************/ Expense/************************************************************/
Route::get('add-expense', 'ExpensesController@add_expense');
Route::post('do-add-expense', 'ExpensesController@do_add_expense');
Route::get('view-expenses', 'ExpensesController@view_expenses');
Route::get('edit-expense/{expense_id}', 'ExpensesController@edit_expense');
Route::post('do-edit-expense/{expense_id}', 'ExpensesController@do_edit_expense');
Route::get('delete-expense/{expense_id}', 'ExpensesController@delete_expense');
Route::get('make-active-expense/{expense_id}', 'ExpensesController@make_active_expense');
Route::get('make-inactive-expense/{expense_id}', 'ExpensesController@make_inactive_expense');
//########################################### * Expenses END * ############################################################
########################################### * EVENTS START * ############################################################
//*********************************/ Event-titles/************************************************************/
Route::get('view-event-titles', 'EventTitlesController@view_event_titles');
Route::get('add-event-title', 'EventTitlesController@add_event_title');
Route::post('do-add-event-title', 'EventTitlesController@do_add_event_title');
Route::get('edit-event-title/{event_title_id}', 'EventTitlesController@edit_event_title');
Route::post('do-edit-event-title/{event_title_id}', 'EventTitlesController@do_edit_event_title');
Route::get('delete-event-title/{event_title_id}', 'EventTitlesController@delete_event_title');
Route::get('make-active-event-title/{event_title_id}', 'EventTitlesController@make_active_event_title');
Route::get('make-inactive-event-title/{event_title_id}', 'EventTitlesController@make_inactive_event_title');

//*********************************/ Events/************************************************************/
Route::get('view-events', 'EventsController@view_events');
Route::get('add-event', 'EventsController@add_event');
Route::post('do-add-event', 'EventsController@do_add_event');
Route::get('edit-event/{event_id}', 'EventsController@edit_event');
Route::post('do-edit-event/{event_id}', 'EventsController@do_edit_event');
Route::get('delete-event/{event_id}', 'EventsController@delete_event');
Route::get('make-active-event/{event_id}', 'EventsController@make_active_event');
Route::get('make-inactive-event/{event_id}', 'EventsController@make_inactive_event');
//Route::get('add-event-album', 'EventsController@add_event_album');
//*********************************/ Event-Albums/************************************************************/
Route::get('view-event-albums', 'EventsAlbumController@view_event_albums');
Route::get('add-event-album/{event_title_id}', 'EventsAlbumController@add_event_album');
Route::post('do-add-event-album', 'EventsAlbumController@do_add_event_album');
Route::get('getimagesalls/{id}', 'EventsAlbumController@getimagesall');
Route::get('delete-images/{event_title_id}/{image_id}', 'EventsAlbumController@delete_image');
//*********************************/ Videos /************************************************************/
Route::get('add-video', 'VideosController@add_video');
Route::post('do-add-video', 'VideosController@do_add_video');
Route::get('view-videos', 'VideosController@view_videos');
Route::post('do-update-video/{id}', 'VideosController@do_update_video');
Route::get('delete-video/{id}', 'VideosController@delete_video');
Route::post('change-access-status/{id}', 'VideosController@change_access_status');
########################################### * EVENTS END * ############################################################
########################################### * LYBRARY SART * ############################################################
//*********************************/ Books /************************************************************/
Route::get('view-books', 'BooksController@view_books');
Route::get('add-book', 'BooksController@add_book');
Route::post('do-add-book', 'BooksController@do_add_book');
Route::get('edit-book/{book_id}', 'BooksController@edit_book');
Route::post('do-edit-book/{book_id}', 'BooksController@do_edit_book');
Route::get('delete-book/{book_id}', 'BooksController@delete_book');
Route::get('make-active-book/{book_id}', 'BooksController@make_active_book');
Route::get('make-inactive-book/{book_id}', 'BooksController@make_inactive_book');
Route::get('add-assign-book/{book_id}', 'BooksController@add_assign_book');
//*********************************/ Assign Books /************************************************************/
Route::get('view-assign-books', 'AssignBooksController@view_assign_books');
Route::get('add-assign-book/{book_id}', 'AssignBooksController@add_assign_book');
Route::get('get-student', 'AssignBooksController@get_student');
Route::post('do-add-assign-book/{book_id}', 'AssignBooksController@do_add_assign_book');
Route::get('edit-assign-book/{assign_book_id}', 'AssignBooksController@edit_assign_book');
Route::post('do-edit-assign-book/{assign_book_id}', 'AssignBooksController@do_edit_assign_book');
Route::get('delete-assign-book/{assign_book_id}', 'AssignBooksController@delete_assign_book');
Route::get('make-active-assign-book/{assign_book_id}', 'AssignBooksController@make_active_assign_book');
Route::get('make-inactive-assign-book/{assign_book_id}', 'AssignBooksController@make_inactive_assign_book');

//*********************************/ Return Books/************************************************************/
Route::get('view-return-books', 'ReturnBookController@view_return_books');
Route::get('add-return-book/{assign_book_id}', 'ReturnBookController@add_return_book');
Route::post('do-add-return-book/{assign_book_id}', 'ReturnBookController@do_add_return_book');
Route::get('make-active-return-book/{return_book_id}', 'ReturnBookController@make_active_return_book');
Route::get('make-inactive-return-book/{return_book_id}', 'ReturnBookController@make_inactive_return_book');
########################################### * Library END * ############################################################
########################################### * SETTINGS START * ############################################################
//*********************************/ ACADEMIC YEARS /************************************************************/

Route::get('add-academic-year', 'AcademicYearController@add_academic_year');
Route::post('do-add-academic-year', 'AcademicYearController@do_add_academic_year');
Route::get('view-academic-years', 'AcademicYearController@view_academic_years');
Route::get('edit-academic-year/{year_id}', 'AcademicYearController@edit_academic_year');
Route::post('do-edit-academic-year/{year_id}', 'AcademicYearController@do_edit_academic_year');
Route::get('delete-academic-year/{year_id}', 'AcademicYearController@delete_academic_year');
Route::get('make-active-academic-year/{year_id}', 'AcademicYearController@make_active_year');
Route::get('make-inactive-academic-year/{year_id}', 'AcademicYearController@make_inactive_year');

//***********************************/ MODULES /**********************************************************

Route::get('add-module', 'ModulesController@add_module');
Route::post('do-add-module', 'ModulesController@do_add_module');
Route::get('view-modules', 'ModulesController@view_modules');
Route::get('edit-module/{module_id}', 'ModulesController@edit_module');
Route::post('do-edit-module/{module_id}', 'ModulesController@do_edit_module');
Route::get('delete-module/{module_id}', 'ModulesController@delete_module');
Route::get('make-active-module/{module_id}', 'ModulesController@make_active_module');
Route::get('make-inactive-module/{module_id}', 'ModulesController@make_inactive_module');

//*********************************/ USER TYPES /************************************************************/
Route::get('add-user-types', 'UserTypesController@add_user_types');
Route::post('do-add-user-types', 'UserTypesController@do_user_types');
Route::get('view-user-types', 'UserTypesController@view_user_types');
Route::get('edit_user_types/{user_types_id}', 'UserTypesController@edit_user_types');
Route::post('do_edit_user_types/{user_types_id}', 'UserTypesController@do_edit_user_types');
Route::get('make-active-user-types/{user_types_id}', 'UserTypesController@make_active_user_types');
Route::get('make-inactive-user-types/{user_types_id}', 'UserTypesController@make_inactive_user_types');
Route::get('delete_user_types/{user_types_id}', 'UserTypesController@delete_user_types');

//**********************************/  USER TYPE - MODULES /***********************************************************/

Route::get('add-user-module/{user_module_id}', 'UserModulesController@add_user_module');
Route::post('do-add-user-module/{user_module_id}', 'UserModulesController@do_add_user_module');
Route::get('edit-user-module/{user_module_id}', 'UserModulesController@edit_user_module');
Route::post('do-edit-user-module/{user_module_id}', 'UserModulesController@do_edit_user_module');
Route::get('view-user-type-modules', 'UserModulesController@view_user_modules');
Route::get('make-active-user-module/{user_module_id}', 'UserModulesController@make_active_user_module');
Route::get('make-inactive-user-module/{user_module_id}', 'UserModulesController@make_inactive_user_module');
Route::get('delete-user-module/{user_module_id}', 'UserModulesController@delete_user_module');

//*********************************/ FEE TYPES /************************************************************/

Route::get('add-fee-types', 'FeeTypeController@add_fee_type');
Route::post('do-add-fee-types', 'FeeTypeController@do_fee_type');
Route::get('view-fee-types', 'FeeTypeController@view_fee_types');
Route::get('edit_fee_type/{fee_type_id}', 'FeeTypeController@edit_fee_type');
Route::post('do_edit_fee_type/{fee_type_id}', 'FeeTypeController@do_edit_fee_type');
Route::get('make-active-fee-type/{fee_type_id}', 'FeeTypeController@make_active_fee_type');
Route::get('make-inactive-fee-type/{fee_type_id}', 'FeeTypeController@make_inactive_fee_type');
Route::get('delete_fee_type/{fee_type_id}', 'FeeTypeController@delete_fee_type');

//*********************************/ GRADES /************************************************************/
Route::get('add-grade-type', 'GradeController@add_grade_type');
Route::post('do-add-grade-type', 'GradeController@do_grade_type');
Route::get('view-grade-types', 'GradeController@view_grade_types');
Route::get('edit-grade-type/{grade_type_id}', 'GradeController@edit_grade_type');
Route::post('do-edit-grade-type/{grade_type_id}', 'GradeController@do_edit_grade_type');
Route::get('make-active-grade-type/{grade_type_id}', 'GradeController@make_active_grade_type');
Route::get('make-inactive-grade-type/{grade_type_id}', 'GradeController@make_inactive_grade_type');
Route::get('delete-grade-type/{grade_type_id}', 'GradeController@delete_grade_type');
//*********************************/PERCENTAGE /************************************************************/

Route::get('add-percentage', 'PercentageController@add_percentage');
Route::post('do-add-percentage', 'PercentageController@do_add_percentage');
Route::get('view-percentages', 'PercentageController@view_percentages');
Route::get('edit-percentage/{percentage_id}', 'PercentageController@edit_percentage');
Route::post('do-edit-percentage/{percentage_id}', 'PercentageController@do_edit_percentage');
Route::get('make-active-percentage/{percentage_id}', 'PercentageController@make_active_percentage');
Route::get('make-inactive-percentage/{percentage_id}', 'PercentageController@make_inactive_percentage');
Route::get('delete-percentage/{percentage_id}', 'PercentageController@delete_percentage');

//*********************************/GRADE SETTINGS /************************************************************/
Route::get('add-grade-settings', 'GradeSettingsController@add_grade_settings');
Route::post('do-add-grade-settings', 'GradeSettingsController@do_grade_settings');
Route::get('view-grade-settings', 'GradeSettingsController@view_grade_settings');
Route::get('edit-grade-settings/{grade_settings_id}', 'GradeSettingsController@edit_grade_settings');
Route::post('do-edit-grade-settings/{grade_settings_id}', 'GradeSettingsController@do_edit_grade_settings');
Route::get('delete-grade-settings/{grade_settings_id}', 'GradeSettingsController@delete_grade_settings');
Route::get('make-active-settings/{grade_settings_id}', 'GradeSettingsController@make_active_grade_settings');
Route::get('make-inactive-settings/{grade_settings_id}', 'GradeSettingsController@make_inactive_grade_settings');

//*********************************/ USERS /************************************************************/

Route::get('add-user', 'UsersController@add_user');
Route::post('do-add-user', 'UsersController@do_add_user');
Route::get('edit-user/{user_id}', 'UsersController@edit_user');
Route::post('do-edit-user/{user_id}', 'UsersController@do_edit_user');
Route::get('view-user', 'UsersController@view_users');
Route::get('delete-user/{user_id}', 'UsersController@delete_user');
Route::get('make-active-user/{user_id}', 'UsersController@make_active_user');
Route::get('make-inactive-user/{user_id}', 'UsersController@make_inactive_user');
Route::get('delete-rights-make-no/{user_id}', 'UsersController@delete_right_make_no');
Route::get('delete-rights-make-yes/{user_id}', 'UsersController@delete_right_make_yes');
Route::get('add-rights-make-no/{user_id}', 'UsersController@add_right_make_no');
Route::get('add-rights-make-yes/{user_id}', 'UsersController@add_right_make_yes');
Route::get('edit-rights-make-no/{user_id}', 'UsersController@edit_right_make_no');
Route::get('edit-rights-make-yes/{user_id}', 'UsersController@edit_right_make_yes');
Route::get('view-rights-make-yes/{user_id}', 'UsersController@view_right_make_yes');
Route::get('view-rights-make-no/{user_id}', 'UsersController@view_right_make_no');

//*********************************/ INSTITUTE DETAILS /************************************************************/

Route::get('get-city', 'InstituteDetailsController@get_city');
Route::get('view-institution-details', 'InstituteDetailsController@view_institution_details');
Route::get('view-institution-profile', 'InstituteDetailsController@view_institution_profile');
Route::get('edit-institution-details/{institute_id}', 'InstituteDetailsController@edit_institution_details');
Route::post('do-edit-institution-details/{institute_id}', 'InstituteDetailsController@do_edit_institution_details');

//*********************************/ INSTITUTE TIMINGS /************************************************************/

Route::get('add-institute-timings', 'InstituteTimingsController@add_institute_timings');
Route::post('do-add-institute-timings', 'InstituteTimingsController@do_add_institute_timings');
Route::get('view-institute-timings', 'InstituteTimingsController@view_institute_timings');
Route::get('edit-institute-timings/{institute_timings_id}', 'InstituteTimingsController@edit_institute_timings');
Route::post('do-edit-institute-timings/{institute_timings_id}', 'InstituteTimingsController@do_edit_institute_timings');
Route::get('delete-institute-timings/{institute_timings_id}', 'InstituteTimingsController@delete_institute_timings');
Route::get('make-active-institute-timings/{institute_timings_id}', 'InstituteTimingsController@make_active_institute_timings');
Route::get('make-inactive-institute-timings/{institute_timings_id}', 'InstituteTimingsController@make_inactive_institute_timings');

//*********************************/ INSTITUTE HOLIDAYS /************************************************************/

Route::get('add-institute-holiday', 'InstituteHolidaysController@add_institute_holiday');
Route::post('do-add-institute-holiday', 'InstituteHolidaysController@do_add_institute_holiday');
Route::get('view-institute-holidays', 'InstituteHolidaysController@view_institute_holidays');
Route::get('edit-institute-holiday/{institute_holiday_id}', 'InstituteHolidaysController@edit_institute_holiday');
Route::post('do-edit-institute-holiday/{institute_holiday_id}', 'InstituteHolidaysController@do_edit_institute_holiday');
Route::get('delete-institute-holiday/{institute_holiday_id}', 'InstituteHolidaysController@delete_institute_holiday');
Route::get('make-active-institute-holiday/{institute_holiday_id}', 'InstituteHolidaysController@make_active_institute_holiday');
Route::get('make-inactive-institute-holiday/{institute_holiday_id}', 'InstituteHolidaysController@make_inactive_institute_holiday');

//*********************************/ ATTENDANCE/************************************************************/

Route::get('add-attendance-type', 'AttendanceTypesController@add_attendance_type');
Route::post('do-add-attendance-type', 'AttendanceTypesController@do_attendance_type');
Route::get('view-attendance-types', 'AttendanceTypesController@view_attendance_types');
Route::get('edit-attendance-type/{attendance_type_id}', 'AttendanceTypesController@edit_attendance_type');
Route::post('do-edit-attendance-type/{attendance_type_id}', 'AttendanceTypesController@do_edit_attendance_type');
Route::get('make-active-attendance-type/{attendance_type_id}', 'AttendanceTypesController@make_active_attendance_type');
Route::get('make-inactive-attendance-type/{attendance_type_id}', 'AttendanceTypesController@make_inactive_attendance_type');
Route::get('delete-attendance-type/{attendance_type_id}', 'AttendanceTypesController@delete_attendance_type');

//########################################### * SETTINGS END * ############################################################
//
//########################################### * LOGS START * ##############################################################
//*********************************/ LOGS IN OUT/************************************************************/
Route::get('log-history', 'LogsController@log_history');
Route::get('log_history_search', 'LogsController@log_history_search');

//*********************************/ LOG HISTORY/************************************************************/
Route::get('log-details', 'LogsController@log_details');
Route::get('log_details_search', 'LogsController@log_details_search');

//########################################### * LOGS END * #################################################################
//########################################### * Institute Reports START* #################################################################
Route::get('view-institute-students', 'InstituteReportsController@view_institute_students');
Route::post('view-institute-students', 'InstituteReportsController@view_institute_students');

Route::get('view-institute-students/{class_id}', 'InstituteReportsController@view_institute_class_students');

Route::get('view-institute-timetable', 'InstituteReportsController@view_institute_timetable');
Route::post('view-institute-timetable', 'InstituteReportsController@view_institute_timetable');

Route::get('view-institute-fees', 'InstituteReportsController@view_institute_fees');
Route::post('view-institute-fees', 'InstituteReportsController@view_institute_fees');

Route::get('view-institute-transport-fees', 'InstituteReportsController@view_institute_transport_fees');
Route::post('view-institute-transport-fees', 'InstituteReportsController@view_institute_transport_fees');

Route::get('view-institute-students-attendance', 'InstituteReportsController@view_institute_students_attendance');
Route::post('view-institute-students-attendance', 'InstituteReportsController@view_institute_students_attendance');

Route::get('view-institute-classes', 'InstituteReportsController@view_institute_classes');

Route::get('view-institute-students-payments', 'InstituteReportsController@view_institute_student_payments');
Route::post('view-institute-students-payments', 'InstituteReportsController@view_institute_student_payments');

Route::get('view-institute-staff', 'InstituteReportsController@view_institute_staff');
Route::post('view-institute-staff', 'InstituteReportsController@view_institute_staff');

Route::get('view-institute-staff-attendance', 'InstituteReportsController@view_institute_staff_attendance');
Route::post('view-institute-staff-attendance', 'InstituteReportsController@view_institute_staff_attendance');

Route::get('view-institute-staff-salary', 'InstituteReportsController@view_institute_staff_salary');
Route::post('view-institute-staff-salary', 'InstituteReportsController@view_institute_staff_salary');

Route::get('view-institute-students-marks', 'InstituteReportsController@view_institute_students_marks');
Route::post('view-institute-students-marks', 'InstituteReportsController@view_institute_students_marks');

Route::get('view-institute-transport-students', 'InstituteReportsController@view_institute_transport_students');
Route::post('view-institute-transport-students', 'InstituteReportsController@view_institute_transport_students');

Route::get('view-institute-exam-timetable', 'InstituteReportsController@view_institute_exam_timetable');
Route::post('view-institute-exam-timetable', 'InstituteReportsController@view_institute_exam_timetable');

//########################################### * Institute Reports  END* #################################################################
//########################################### * Institute BALANCE SHEET PAYMENTS START * #################################################################
Route::get('balance-sheet-payments-chart', 'InstituteBalanceSheetPaymentsController@balance_sheet_payments_chart');
Route::get('balance-sheet-payments-academic-years', 'InstituteBalanceSheetPaymentsController@balance_sheet_payments_academic_years');
Route::get('balance-sheet-payments-months/{academic_year_id}', 'InstituteBalanceSheetPaymentsController@balance_sheet_payments_months');
Route::get('balance-sheet-payments-day/{academic_year_id}/{year}/{month}', 'InstituteBalanceSheetPaymentsController@balance_sheet_payments_day');
Route::get('balance-sheet-payments-day-fees/{academic_year_id}/{year}/{month}/{day}', 'InstituteBalanceSheetPaymentsController@balance_sheet_payments_day_fees');
Route::get('balance-sheet-payment-history/{academic_year_id}/{year}/{month}/{day}/{fee_id}', 'InstituteBalanceSheetPaymentsController@balance_sheet_payment_history');
//########################################### * Institute BALANCE PAYMENTS SHEET END * #################################################################
//########################################### * Institute BALANCE EXPENSES SHEET START * #################################################################
Route::get('balance-sheet-expenses-chart', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_chart');
Route::get('balance-sheet-expenses-academic-years', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_academic_years');
Route::get('balance-sheet-expenses-months/{academic_year_id}', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_months');
Route::get('balance-sheet-expenses-day/{academic_year_id}/{year}/{month}', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_day');
Route::get('balance-sheet-expenses-day-fees/{academic_year_id}/{year}/{month}/{day}', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_day_fees');
Route::get('balance-sheet-expense-history/{academic_year_id}/{year}/{month}/{day}/{expense_type_id}', 'InstituteBalanceSheetExpensesController@balance_sheet_expense_history');
//########################################### * Institute BALANCE EXPENSES SHEET END * #################################################################
//########################################### * Institute BALANCE TOTAL SHEET START * #################################################################
Route::get('balance-sheet-total-academic-years', 'InstituteBalanceSheetTotalController@balance_sheet_total_academic_years');
Route::get('balance-sheet-total-months/{academic_year_id}', 'InstituteBalanceSheetTotalController@balance_sheet_total_months');
//Route::get('balance-sheet-expenses-day/{academic_year_id}/{year}/{month}', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_day');
//Route::get('balance-sheet-expenses-day-fees/{academic_year_id}/{year}/{month}/{day}', 'InstituteBalanceSheetExpensesController@balance_sheet_expenses_day_fees');
//Route::get('balance-sheet-expense-history/{academic_year_id}/{year}/{month}/{day}/{expense_type_id}', 'InstituteBalanceSheetExpensesController@balance_sheet_expense_history');
//########################################### * Institute BALANCE TOTAL SHEET END * #################################################################
//*********************************/ Albums/************************************************************/
Route::get('view-albums', 'AlbumController@view_albums');
Route::get('add-album', 'AlbumController@add_album');
Route::post('do-add-album', 'AlbumController@do_add_album');
Route::get('edit-album/{album_id}', 'AlbumController@edit_album');
Route::post('do-edit-album/{album_id}', 'AlbumController@do_edit_album');
Route::get('delete-album/{album_id}', 'AlbumController@delete_album');
Route::get('make-active-album/{album_id}', 'AlbumController@make_active_album');
Route::get('make-inactive-album/{album_id}', 'AlbumController@make_inactive_album');

//*********************************/ Gallery/************************************************************/
Route::get('view-gallery', 'GalleryController@view_gallery');
Route::get('add-gallery', 'GalleryController@add_gallery');
Route::post('do-add-gallery', 'GalleryController@do_add_gallery');
Route::get('getimagesall/{id}', 'GalleryController@getimagesall');
Route::get('delete-image/{album_id}/{image_id}', 'GalleryController@delete_image');

//common logins
Route::get('view-institutes-student', 'CommanLoginsController@view_institute_students');
Route::post('view-institutes-student', 'CommanLoginsController@view_institute_students');
Route::get('view-institutes-transport-student', 'CommanLoginsController@view_institute_transport_students');
Route::post('view-institutes-transport-student', 'CommanLoginsController@view_institute_transport_students');
Route::get('view-staffs', 'CommanLoginsController@view_staffs');
Route::get('student-books', 'CommanLoginsController@student_books');
Route::get('driver-route-students', 'CommanLoginsController@driver_route_students');
Route::get('driver-all-routes', 'CommanLoginsController@driver_all_routes');
Route::get('driver-my-stops', 'CommanLoginsController@driver_my_stops');

//Staff login
//**********************************/ STUDENT Attendance /***********************************************************
Route::get('staff-add-student-attendance', 'StaffAddStudentAttendanceController@add_student_attendance');
Route::get('staff-get-student-subjects', 'StaffAddStudentAttendanceController@staff_get_student_subjects');
Route::post('staff_get_students_all', 'StaffAddStudentAttendanceController@get_student_all');
Route::post('staff-save-students-attendance', 'StaffAddStudentAttendanceController@save_student_attendance');
Route::get('staff-view-students-attendance', 'StaffAddStudentAttendanceController@view_students_attendance');

//**********************************/ STUDENT MARKS /***********************************************************
Route::get('staff-get-students-marks', 'StaffAddStudentMarksController@get_students_marks');
Route::get('staff-get-exam-class', 'StaffAddStudentMarksController@get_exam_class');
Route::get('staff-get-exam-subjects', 'StaffAddStudentMarksController@get_exam_subjects');
Route::get('staff-get-exam-students', 'StaffAddStudentMarksController@get_exam_students');
Route::post('staff-save-students-marks', 'StaffAddStudentMarksController@save_students_marks');
Route::get('staff-view-students-marks', 'StaffAddStudentMarksController@view_students_marks');
Route::get('staff-edit-student-marks/{exam}/{class}/{subject}', 'StaffAddStudentMarksController@edit_students_marks');
Route::post('staff-update-students-marks/{exam}/{class}/{subject}', 'StaffAddStudentMarksController@update_students_marks');

Route::get('staff-get-student-exam-subject-marks', 'StaffAddStudentMarksController@get_student_exam_subject_marks');
Route::post('staff-update-student-all-ubject-marks', 'StaffAddStudentMarksController@update_student_all_subject_marks');
Route::get('staff-marks-added-students', 'StaffAddStudentMarksController@marks_added_students');
Route::get('staff-edit-exam-class', 'StaffAddStudentMarksController@edit_exam_class');
Route::get('staff-edit-exam-subjects', 'StaffAddStudentMarksController@edit_exam_subjects');
Route::get('staff-edit-student-subject-marks', 'StaffAddStudentMarksController@edit_student_subject_marks');
Route::post('staff-update-student-subject-marks', 'StaffAddStudentMarksController@update_student_subject_marks');
Route::get('staff-get-marks-added-students/{exam}/{class}/{subject}', 'StaffAddStudentMarksController@get_marks_added_students');
Route::post('staff-save-individual-marks/{e_id}/{c_id}/{s_id}', 'StaffAddStudentMarksController@save_student_exam_subject_marks');
//**********************************/ STUDENT ReMARKS /***********************************************************
Route::get('staff-get-students-remarks', 'StaffAddStudentRemarksController@get_students_remarks');
Route::get('staff-remark-class-subjects', 'StaffAddStudentRemarksController@remark_class_subjects');
Route::get('staff-remark-class-students', 'StaffAddStudentRemarksController@class_students');
Route::post('staff-add-remarks-students', 'StaffAddStudentRemarksController@add_remarks_students');
Route::post('staff-do-add-remarks-students', 'StaffAddStudentRemarksController@do_add_student_remarks');
Route::get('staff-view-students-remarks', 'StaffAddStudentRemarksController@view_students_remarks');
Route::get('staff-edit-remark/{remark_id}', 'StaffAddStudentRemarksController@edit_remarks');
Route::post('staff-do-edit-remark/{remark_id}', 'StaffAddStudentRemarksController@do_edit_remarks');
Route::get('staff-delete-remark/{remark_id}', 'StaffAddStudentRemarksController@delete_remarks');
//**********************************/ STUDENT Assignments /***********************************************************
Route::get('staff-get-students-assignments', 'StaffAddStudentAssignmentController@get_students_assignments');
Route::get('staff-get-assignment-students-list', 'StaffAddStudentAssignmentController@get_assignment_students_list');
Route::post('staff-do-add-assignment-class', 'StaffAddStudentAssignmentController@do_add_assignment_class');
Route::get('staff-view-class-assignments', 'StaffAddStudentAssignmentController@view_class_assignments');
Route::get('staff-edit-assignment/{assignment_id}', 'StaffAddStudentAssignmentController@edit_assignment');
Route::post('staff-do-edit-assignment-class/{assignment_id}', 'StaffAddStudentAssignmentController@do_edit_assignment');
//Route::get('staff-delete-assignment/{assignment_id}', 'StaffAddStudentAssignmentController@delete_assignment');
//*********************************/ Parent Messages/************************************************************/
Route::get('add-message', 'ParentMessagesController@add_message');
Route::post('do-add-message', 'ParentMessagesController@do_add_message');
Route::get('view-messages', 'ParentMessagesController@view_messages');
Route::get('edit-message/{message_id}', 'ParentMessagesController@edit_message');
Route::post('do-edit-message/{message_id}', 'ParentMessagesController@do_edit_message');
Route::get('delete-message/{message_id}', 'ParentMessagesController@delete_message');
Route::get('make-active-message/{message_id}', 'ParentMessagesController@make_active_message');
Route::get('make-inactive-message/{message_id}', 'ParentMessagesController@make_inactive_message');
Route::get('admin-view-messages', 'ParentMessagesController@admin_view_messages');


//*********************************/ Students Migration/************************************************************/
Route::get('students-migration', 'StudentsMigrationController@students_migration');
Route::get('academic-year-classes', 'StudentsMigrationController@academic_year_classes');
Route::get('to-academic-year-classes', 'StudentsMigrationController@to_academic_year_classes');
Route::get('migrated_class_students', 'StudentsMigrationController@migrated_class_students');

Route::get('class-schedule-migration', 'StudentsMigrationController@class_schedule_migration');
Route::post('class-schedule-migration-update', 'StudentsMigrationController@class_schedule_migration_update');

Route::get('classes-migration', 'StudentsMigrationController@classes_migration');
Route::get('get-f-a-y-classes', 'StudentsMigrationController@get_f_a_y_classes');
Route::get('get-t-a-y-classes', 'StudentsMigrationController@get_t_a_y_classes');
Route::post('update-migrated-classes', 'StudentsMigrationController@update_migrated_classes');

Route::get('migrate-timings', 'StudentsMigrationController@migrate_timings');
Route::post('update-migrated-timings', 'StudentsMigrationController@update_migrated_timings');

Route::post('save-migrated-class', 'StudentsMigrationController@save_migrated_class');
Route::get('migrated-students', 'StudentsMigrationController@migrated_students');
Route::get('view-migrated-classes', 'StudentsMigrationController@view_migrated_classes_students');

Route::get('staff-migration', 'StudentsMigrationController@staff_migration');
Route::post('save-migrated-staff', 'StudentsMigrationController@save_migrated_satff');

Route::get('class-fee-migration', 'StudentsMigrationController@class_fee_migration');
Route::post('save-migrated-class-fees', 'StudentsMigrationController@save_migrated_class_fees');

Route::get('transport-fee-migration', 'StudentsMigrationController@transport_fee_migration');
Route::post('save-migrated-transport-fees', 'StudentsMigrationController@save_migrated_transport_fees');


//------------------------------------------------------------------------PDF
Route::get('student-summary-pdf/{student_id}', 'PdfController@student_summary_pdf');
Route::get('student-summary-print/{student_id}', 'PdfController@student_summary_print');
Route::get('payment-receipt-pdf/{receipt_id}', 'PdfController@payment_receipt_pdf');
Route::get('payment-receipt-print/{receipt_id}', 'PdfController@payment_receipt_print');
Route::get('payment-history-pdf/{student_id}', 'PdfController@payment_history_pdf');
Route::get('payment-history-print/{student_id}', 'PdfController@payment_history_print');
Route::get('total-fees-pdf/{student_id}', 'PdfController@total_fees_pdf');
Route::get('total-fees-print/{student_id}', 'PdfController@total_fees_print');
Route::get('staff-summary-pdf/{staff_id}', 'PdfController@staff_summary_pdf');
Route::get('staff-summary-print/{staff_id}', 'PdfController@staff_summary_print');
Route::get('salary-pay-slip-pdf/{salary_id}', 'PdfController@salary_pay_slip_pdf');
Route::get('salary-pay-slip-print/{salary_id}', 'PdfController@salary_pay_slip_print');


//REports PDF

Route::get('view-institute-students-pdf/{print}', 'PdfReportsController@view_institute_students_pdf');
Route::get('view-institute-transport-students-pdf/{print}', 'PdfReportsController@view_institute_transport_students_pdf');
Route::get('view-institute-classes-pdf/{print}', 'PdfReportsController@view_institute_classes_pdf');
Route::get('view-institute-timetable-pdf/{print}', 'PdfReportsController@view_institute_timetable_pdf');
Route::get('view-institute-fees-pdf/{print}', 'PdfReportsController@view_institute_fees_pdf');
Route::get('view-institute-transport-fees-pdf/{print}', 'PdfReportsController@view_institute_transport_fees_pdf');
Route::get('view-institute-student-marks-pdf/{print}', 'PdfReportsController@view_institute_student_marks_pdf');
Route::get('view-institute-exam-timetable-pdf/{print}', 'PdfReportsController@view_institute_exam_timetable_pdf');
Route::get('view-institute-staff-pdf/{print}', 'PdfReportsController@view_institute_staff_pdf');
Route::get('view-institute-staff-pdf/{print}', 'PdfReportsController@view_institute_staff_pdf');
Route::get('view-institute-staff-attendance-pdf/{print}', 'PdfReportsController@view_institute_staff_attendance_pdf');
Route::get('view-institute-staff-salary-pdf/{print}', 'PdfReportsController@view_institute_staff_salary_pdf');
Route::get('view-institute-student-attendance-pdf/{print}', 'PdfReportsController@view_institute_student_attendance_pdf');
Route::get('balance-sheet-total-pdf/{print}/{id}', 'PdfController@balance_sheet_total_pdf');
Route::get('balance-sheet-expenses-pdf/{print}/{id}', 'PdfController@balance_sheet_expenses_pdf');
Route::get('balance-sheet-payments-pdf/{print}/{id}', 'PdfController@balance_sheet_payments_pdf');

//Emails
//Route::post('student-summary-email/{id}', 'StudentController@student_summary_email');
Route::get('student-summary-email/{parent}/{student_id}', 'StudentController@student_summary_email');
Route::get('staff-summary-email/{id}', 'StaffController@staff_summary_email');

//REports Excel
Route::get('view-institute-students-excel', 'ExcelController@view_institute_students_excel');

//Class scheduleEXCEL &PDF
Route::get('class-schedule-pdf/{class_section_id}', 'PdfController@class_schedule_pdf');
Route::get('class-schedule-excel/{class_section_id}', 'ExcelController@class_schedule_excel');

//SMS integration
Route::get('sms-compose', 'ApiController@sms_compose');
Route::get('sms-send', 'ApiController@sms_send');

Route::get('sms-credentials', 'ApiController@sms_credentials');
Route::get('sms-send-credentials', 'ApiController@sms_send_credentials');

Route::get('sms-sent', 'ApiController@sms_sent');

Route::get('sms-individual-create', 'ApiController@sms_individual_create');
Route::post('sms-individual-send', 'ApiController@sms_individual_send');
Route::get('sms-individual-view', 'ApiController@sms_individual_view');

Route::get('sms-sent', 'ApiController@sms_sent');

Route::get('pageNotFound', 'AdminLoginController@page_not_found');