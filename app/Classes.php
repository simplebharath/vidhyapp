<?php

namespace App;

use Illuminate\Http\Request;
use \App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $method = null;
    public $academic_year_id = null;
    public $user_login_id = null;

    public function __construct() {
        $this->method = new BaseModel();
        $this->academic_year_id = $this->method->session_academic_year_id();
        $this->user_login_id = $this->method->session_user_login_id();
    }

    public function classesTabs() {
        $this->tabs = ["add-class", "view-classes", "edit-class"];
        return $this->tabs;
    }
    public function subTitle() {
        $this->title = "Manage Classes";
        return $this->title;
    }

    public function classesValidationAdd() {
        $validateData = [
            'class_name' => 'required|unique:classes',
        ];
        return $validateData;
    }

    public function classesValidationEdit($class_id) {
        $validateData = [
            'class_name' => 'required|unique:classes,class_name,' . classes::where('id', $class_id)->value('id'),
        ];
        return $validateData;
    }

    public function classesSave($request) {
        $classes_save = new Classes();
        $classes_save->class_name = $request['class_name'];
        $classes_save->created_user_id = $this->user_login_id;
        $classes_save->academic_year_id = $this->academic_year_id;
        $classes_save->save();
        if ($classes_save->id) {
            $data = array(
                'log_type' => ' class added successfully!',
                'message' => 'Added',
                'new_value' => $request['class_name'],
                'old_value' => 'No old values',
                'academic_year_id' => $this->academic_year_id,
                'user_login_id' => $this->user_login_id);
            $this->method->saveLogData($data);
        }
        return true;
    }

    public function classesUpdate($request, $class_id) {
        $classes = classes::find($class_id);
        $classes->class_name = $request['class_name'];
        $classes->updated_user_id = $this->user_login_id;
        $old_values = classes::find($class_id);
        $data = array(
            'log_type' => 'Class updated successfully!',
            'message' => 'Added',
            'new_value' => $request['class_name'],
            'old_value' => $old_values,
            'academic_year_id' => $this->academic_year_id,
            'user_login_id' => $this->user_login_id);
        $this->method->saveLogData($data);
        $classes->update();
        return true;
    }

}
