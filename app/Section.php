<?php

namespace App;

use App\Models\BaseModel;

class Section extends BaseModel {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public static function sectionTabs() {
        $section = ["add-section", "view-sections", "edit-section"];
        return $section;
    }

    public static function subTitle() {
        $subTitle = "Manage Sections";
        return $subTitle;
    }

    public static function sectionValidationAdd() {
            $validateData = [
                'section_name' => 'required|unique:sections'
            ];
             return $validateData;
    }
    public static function sectionValidationEdit($section_id) {
            $validateData = [
                'section_name' => 'required|unique:sections,section_name,' . Section::where('id', $section_id)->value('id'),
            ];
          return $validateData;
        
    }

    public static function sectionSaveOrUpdate($request, $section_id = null) {
        $sections = 'No old values';
        if ($section_id > 0) {
            $sections = Section::find($section_id);
            $sections->section_name = $request['section_name'];
            $sections->academic_year_id = BaseModel::session_academic_year_id();
            $sections->update();
            $data['old_value'] = $sections;
        } else {
            $sections = new Section();
            $sections->section_name = $request['section_name'];
            $sections->created_user_id = BaseModel::session_user_login_id();
            $sections->academic_year_id = BaseModel::session_academic_year_id();
            $sections->save();
            $data['old_value'] = "No old values";
        }

        if ($sections->id) {
            $data = array(
            'log_type' => 'section added successfully!',
            'message' => 'Added',
            'new_value' => $request['section_name'],
            'academic_year_id' => BaseModel::session_academic_year_id(),
            'user_login_id' => BaseModel::session_user_login_id());
            BaseModel::saveLogData($data);
        }
        return true;
    }

}
