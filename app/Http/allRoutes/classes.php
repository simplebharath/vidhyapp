<?php 
//########################################### * MANAGE CLASSES START * ############################################################
//***********************************/ CLASSES /**********************************************************
Route::get('add-class', 'ClassController@add_class');
Route::post('do-add-class', 'ClassController@do_add_class');
Route::get('view-classes', 'ClassController@view_class');
Route::get('edit-class/{class_id}', 'ClassController@edit_class');
Route::post('do-edit-class/{class_id}', 'ClassController@do_edit_class');
Route::get('delete-class/{class_id}', 'ClassController@delete_class');
Route::get('make-active-class/{class_id}', 'ClassController@make_active_class');
Route::get('make-inactive-class/{class_id}', 'ClassController@make_inactive_class');

//**********************************/ SECTIONS /***********************************************************

Route::get('add-section', 'SectionController@add_section');
Route::post('do-add-section', 'SectionController@do_add_section');
Route::get('view-sections', 'SectionController@view_section');
Route::get('edit-section/{section_id}', 'SectionController@edit_section');
Route::post('do-edit-section/{section_id}', 'SectionController@do_edit_section');
Route::get('delete-section/{section_id}', 'SectionController@delete_section');
Route::get('make-active-section/{section_id}', 'SectionController@make_active_section');
Route::get('make-inactive-section/{section_id}', 'SectionController@make_inactive_section');

//**********************************/ SUBJECTS /***********************************************************

Route::get('add-subject', 'SubjectsController@add_subject');
Route::post('do-add-subject', 'SubjectsController@do_add_subject');
Route::get('view-subjects', 'SubjectsController@view_subjects');
Route::get('edit-subject/{subject_id}', 'SubjectsController@edit_subject');
Route::post('do-edit-subject/{subject_id}', 'SubjectsController@do_edit_subject');
Route::get('delete-subject/{subject_id}', 'SubjectsController@delete_subject');
Route::get('make-active-subject/{subject_id}', 'SubjectsController@make_active_subject');
Route::get('make-inactive-subject/{subject_id}', 'SubjectsController@make_inactive_subject');

//******************************/ CLASS - SECTIONS /***************************************************************

Route::get('get_sections', 'ClassSectionController@get_sections');
Route::get('add-class-section', 'ClassSectionController@add_class_section');
Route::post('do-add-class-section', 'ClassSectionController@do_add_class_section');
Route::get('view-class-sections', 'ClassSectionController@view_class_sections');
Route::get('edit-class-section/{class_section_id}', 'ClassSectionController@edit_class_section');
Route::post('do-edit-class-section/{class_section_id}', 'ClassSectionController@do_edit_class_section');
Route::get('make-active-class-section/{class_section_id}', 'ClassSectionController@make_active_class_section');
Route::get('make-inactive-class-section/{class_section_id}', 'ClassSectionController@make_inactive_class_section');
Route::get('delete-class-section/{class_section_id}', 'ClassSectionController@delete_class_section');

//*********************************/ CLASS - SUBJECTS /************************************************************/

Route::get('add-class-subject', 'ClassSubjectController@add_class_subject');
Route::get('get_subjects', 'ClassSubjectController@get_subjects');
Route::get('get_timings', 'ClassSubjectController@get_timings');
Route::post('do-add-class-subject', 'ClassSubjectController@do_add_class_subject');
Route::get('view-class-subjects', 'ClassSubjectController@view_class_subjects');
Route::get('edit-class-subject/{class_subject_id}', 'ClassSubjectController@edit_class_subject');
Route::post('do-edit-class-subject/{class_subject_id}', 'ClassSubjectController@do_edit_class_subject');
Route::get('make-active-class-subject/{class_subject_id}', 'ClassSubjectController@make_active_class_subject');
Route::get('make-inactive-class-subject/{class_subject_id}', 'ClassSubjectController@make_inactive_class_subject');
Route::get('delete-class-subject/{class_subject_id}', 'ClassSubjectController@delete_class_subject');

//*********************************/ CLASS - SCHEDULE /************************************************************/

Route::get('view-class-schedule', 'ClassScheduleController@view_class_schedule');
Route::post('class-schedule', 'ClassScheduleController@class_schedule');

//**********************************/  CLASS - TEACHERS /***********************************************************/

Route::get('add-class-teacher/{class_section_id}', 'ClassTeacherController@add_class_teacher');
Route::post('do-add-class-teacher/{class_section_id}', 'ClassTeacherController@do_add_class_teacher');
Route::get('edit-class-teacher/{class_teacher_id}', 'ClassTeacherController@edit_class_teacher');
Route::post('do-edit-class-teacher/{class_teacher_id}', 'ClassTeacherController@do_edit_class_teacher');
Route::get('view-class-teachers', 'ClassTeacherController@view_class_teachers');
Route::get('make-active-class-teacher/{class_teacher_id}', 'ClassTeacherController@make_active_class_teacher');
Route::get('make-inactive-class-teacher/{class_teacher_id}', 'ClassTeacherController@make_inactive_class_teacher');
Route::get('delete-class-teacher/{class_teacher_id}', 'ClassTeacherController@delete_class_teacher');

