<?php

namespace App;

use Illuminate\Http\Request;
use \App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Classes extends BaseModel {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public static function classesTabs() {
        $classTabs = ["add-class", "view-classes", "edit-class"];
        return $classTabs;
    }

    public static function subTitle() {
        $subTitle = "Manage Classes";
        return $subTitle;
    }

    public static function classesValidationAdd() {
        $validateData = [
            'class_name' => 'required|unique:classes',
        ];
        return $validateData;
    }

    public static function classesValidationEdit($class_id) {
        $validateData = [
            'class_name' => 'required|unique:classes,class_name,' . classes::where('id', $class_id)->value('id'),
        ];
        return $validateData;
    }

    public static function classesSaveOrUpdate($request, $class_id = null) {
        $classes = 'No old values';
        if ($class_id > 0) {
            $classes = classes::find($class_id);
            $classes->class_name = $request['class_name'];
            $classes->academic_year_id = BaseModel::session_academic_year_id();
            $classes->update();
            $data['old_value'] = $classes;
        } else {
            $classes = new Classes();
            $classes->class_name = $request['class_name'];
            $classes->academic_year_id = BaseModel::session_academic_year_id();
            $classes->created_user_id = BaseModel::session_user_login_id();
            $classes->save();
            $data['old_value'] = "No old values";
        }

        if ($classes->id) {
            $data = array(
                'log_type' => ' class added/Updated successfully!',
                'message' => 'Added/Updated',
                'new_value' => $request['class_name'],
                //'old_value' => $classes,
                'academic_year_id' => BaseModel::session_academic_year_id(),
                'user_login_id' => BaseModel::session_user_login_id());
            BaseModel::saveLogData($data);
        }
        return true;
    }

}
