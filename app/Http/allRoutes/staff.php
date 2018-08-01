<?php
//########################################### * MANAGE STAFF * ############################################################
//***********************************/ STAFF TYPES /**********************************************************

Route::get('add-staff-type', 'StaffTypesController@add_staff_type');
Route::post('do-add-staff-type', 'StaffTypesController@do_add_staff_type');
Route::get('view-staff-types', 'StaffTypesController@view_staff_types');
Route::get('edit-staff-type/{staff_type_id}', 'StaffTypesController@edit_staff_type');
Route::post('do-edit-staff-type/{staff_type_id}', 'StaffTypesController@do_edit_staff_type');
Route::get('delete-staff-type/{staff_type_id}', 'StaffTypesController@delete_staff_type');
Route::get('make-active-staff-type/{staff_type_id}', 'StaffTypesController@make_active_staff_type');
Route::get('make-inactive-staff-type/{staff_type_id}', 'StaffTypesController@make_inactive_staff_type');

//**********************************/ STAFF DEPARTMENTS /***********************************************************

Route::get('add-staff-department', 'StaffDepartmentsController@add_staff_department');
Route::post('do-add-staff-department', 'StaffDepartmentsController@do_add_staff_department');
Route::get('view-staff-departments', 'StaffDepartmentsController@view_staff_departments');
Route::get('edit-staff-department/{staff_department_id}', 'StaffDepartmentsController@edit_staff_department');
Route::post('do-edit-staff-department/{staff_department_id}', 'StaffDepartmentsController@do_edit_staff_department');
Route::get('delete-staff-department/{staff_department_id}', 'StaffDepartmentsController@delete_staff_department');
Route::get('make-active-staff-department/{staff_department_id}', 'StaffDepartmentsController@make_active_staff_department');
Route::get('make-inactive-staff-department/{staff_department_id}', 'StaffDepartmentsController@make_inactive_staff_department');

//**********************************/ STAFF DETAILS /***********************************************************

Route::get('add-staff', 'StaffController@add_staff');
Route::get('get-department', 'StaffController@get_department');
Route::post('do-add-staff', 'StaffController@do_add_staff');
Route::get('view-staff', 'StaffController@view_staff');
Route::get('view-staff-profile/{staff_id}', 'StaffController@view_staff_profile');
Route::get('view-staff-profile', 'StaffController@view_staff_prof');
Route::get('edit-staff/{staff_id}', 'StaffController@edit_staff');
Route::post('do-edit-staff/{staff_id}', 'StaffController@do_edit_staff');
//Route::get('delete-staff/{staff_id}', 'StaffController@delete_staff');
Route::get('make-active-staff/{staff_id}', 'StaffController@make_active_staff');
Route::get('make-inactive-staff/{staff_id}', 'StaffController@make_inactive_staff');

Route::get('staff-add-rights-make-no/{staff_id}', 'StaffController@staff_add_right_make_no');
Route::get('staff-add-rights-make-yes/{staff_id}', 'StaffController@staff_add_right_make_yes');
Route::get('staff-edit-rights-make-no/{staff_id}', 'StaffController@staff_edit_right_make_no');
Route::get('staff-edit-rights-make-yes/{staff_id}', 'StaffController@staff_edit_right_make_yes');
Route::get('staff-view-rights-make-yes/{staff_id}', 'StaffController@staff_view_right_make_yes');
Route::get('staff-view-rights-make-no/{staff_id}', 'StaffController@staff_view_right_make_no');
Route::get('staff-delete-rights-make-no/{staff_id}', 'StaffController@staff_delete_right_make_no');
Route::get('staff-delete-rights-make-yes/{staff_id}', 'StaffController@staff_delete_right_make_yes');

//**********************************/ STAFF Experience /***********************************************************
Route::get('add-staff-experience/{staff_id}', 'StaffExperiencesController@add_staff_experience');
Route::post('do-add-staff-experience/{staff_id}', 'StaffExperiencesController@do_add_staff_experience');
Route::get('view-staff-experiences/{staff_id}', 'StaffExperiencesController@view_staff_experiences');
Route::get('edit-staff-experience/{staff_id}/{e_id}', 'StaffExperiencesController@edit_staff_experience');
Route::post('do-edit-staff-experience/{staff_id}/{e_id}', 'StaffExperiencesController@do_edit_staff_experience');
Route::get('delete-staff-experience/{staff_id}/{e_id}', 'StaffExperiencesController@delete_staff_experience');
//**********************************/ STAFF Qualification /***********************************************************
Route::get('add-staff-qualification/{staff_id}', 'StaffQualificationsController@add_staff_qualification');
Route::post('do-add-staff-qualification/{staff_id}', 'StaffQualificationsController@do_add_staff_qualification');
Route::get('view-staff-qualifications/{staff_id}', 'StaffQualificationsController@view_staff_qualifications');
Route::get('edit-staff-qualification/{staff_id}/{q_id}', 'StaffQualificationsController@edit_staff_qualification');
Route::post('do-edit-staff-qualification/{staff_id}/{q_id}', 'StaffQualificationsController@do_edit_staff_qualification');
Route::get('delete-staff-qualification/{staff_id}/{q_id}', 'StaffQualificationsController@delete_staff_qualification');

//**********************************/ STAFF Documents /***********************************************************
Route::get('add-staff-document/{staff_id}', 'StaffDocumentsController@add_staff_document');
Route::post('do-add-staff-document/{staff_id}', 'StaffDocumentsController@do_add_staff_document');
Route::get('view-staff-documents/{staff_id}', 'StaffDocumentsController@view_staff_documents');
Route::get('delete-staff-document/{staff_id}/{d_id}', 'StaffDocumentsController@delete_staff_document');

//**********************************/ STAFF Subjects /***********************************************************
Route::get('add-staff-subject', 'StaffSubjectsController@add_staff_subject');
Route::get('get-staff-subjects', 'StaffSubjectsController@get_staff_subjects');
Route::get('get-staff', 'StaffSubjectsController@get_staff');
Route::post('do-add-staff-subject', 'StaffSubjectsController@do_add_staff_subject');
Route::get('view-staff-subjects', 'StaffSubjectsController@view_staff_subjects');
Route::get('edit-staff-subject/{staff_subject_id}', 'StaffSubjectsController@edit_staff_subject');
Route::post('do-edit-staff-subject/{staff_type_id}', 'StaffSubjectsController@do_edit_staff_subject');
Route::get('delete-staff-subject/{staff_subject_id}', 'StaffSubjectsController@delete_staff_subjects');
Route::get('make-active-staff-subject/{staff_type_id}', 'StaffSubjectsController@make_active_staff_subject');
Route::get('make-inactive-staff-subject/{staff_type_id}', 'StaffSubjectsController@make_inactive_staff_subject');
Route::get('view-staff-timetable/{staff_id}', 'StaffSubjectsController@view_staff_timetable');
//**********************************/ STAFF Attendance /***********************************************************
Route::get('add-staff-attendance', 'StaffAttendanceController@add_staff_attendance');

Route::get('edit-staff-attendance', 'StaffAttendanceController@edit_staff_attendance');
Route::post('get-staff-edit-attendance', 'StaffAttendanceController@get_staff_edit_attendance');
Route::post('update-staff-attendance', 'StaffAttendanceController@update_staff_attendance');

Route::post('get_staff_all', 'StaffAttendanceController@get_staff_all');
Route::post('save-staff-attendance', 'StaffAttendanceController@save_staff_attendance');
Route::get('view-staff-attendance', 'StaffAttendanceController@view_staff_attendance');
Route::get('view-staff-total-attendance/{staff_id}', 'StaffAttendanceController@view_staff_total_attendance');
Route::get('view-staff-monthly-attendance/{month}/{staff_id}', 'StaffAttendanceController@view_staff_monthly_attendance');

//**********************************/ STAFF salaries /***********************************************************
Route::get('add-staff-salary', 'StaffSalariesController@add_staff_salary');
Route::get('get-staff-salary', 'StaffSalariesController@get_staff_salary');
Route::get('get-salary', 'StaffSalariesController@get_staff');
Route::get('get-staff-months', 'StaffSalariesController@get_staff_months');
Route::get('get-staff-working-days', 'StaffSalariesController@get_staff_working_days');
Route::get('view-staff-salary/{staff_id}', 'StaffSalariesController@staff_salary');
Route::post('do-add-staff-salary', 'StaffSalariesController@do_add_staff_salary');
Route::get('view-staff-salaries', 'StaffSalariesController@view_staff_salary');
Route::get('delete-staff-salary/{staff_salary_id}', 'StaffSalariesController@delete_staff_salary');
//########################################### * STAFF END * ############################################################