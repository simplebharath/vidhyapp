<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Exam;
use App\Http\Controllers\Controller;

class ExamController extends Controller {

    public function add_exam() {
        return view('exams/add_exam');
    }

    public function do_add_exam(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:exams',
        ]);
        $exams = new Exam();
        $exams->title = $request['title'];
        $exams->created_user_id = $created_user_id;
        $exams->academic_year_id = $academic_year_id;
        $exams->save();
        $data = array(
            'log_type' => ' Exam added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-exams')->with(['message-success' => 'Exam' . $request['title'] . ' added successfully.']);
    }

    public function view_exams() {
        $exams = Exam::orderBy('created_at', 'desc')->get();
        return view('exams/view_exams', compact('exams'));
    }

    public function edit_exam($exam_id) {
        $exams = Exam::where('id', $exam_id)->get();
        return view('exams/edit_exam', compact('exams'));
    }

    public function do_edit_exam(Request $request, $exam_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:exams',
        ]);
        $exams = Exam::find($exam_id);
        $exams->title = $request['title'];
        $exams->updated_user_id = $created_user_id;
        //$exams->academic_year_id = $academic_year_id;
        $old_values = Exam::where('id',$exam_id)->get();

        $data = array(
            'log_type' => 'Exam updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $exams->update();
        return redirect('view-exams')->with(['message-success' => 'Exam ' . $request['title'] . ' updated successfully.']);
    }

    public function delete_exam($exam_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = Exam::where('id', $exam_id)->value('title');
        $old_values = Exam::where('id', $exam_id)->get();
        if(COUNT($old_values[0]->exams)==0){
        $data = array(
            'log_type' => 'Exam deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Exam::where('id', $exam_id)->delete();
        }else{
            return redirect('view-exams')->with(['message1-danger' => 'Exam ' . $title . ' assigned to class, you can\'t deleted.']);
        }
        return redirect('view-exams')->with(['message-success' => 'Exam ' . $title . ' deleted successfully.']);
    }

    public function make_inactive_exam($exam_id) {
        $title = Exam::where('id', $exam_id)->value('title');
        Exam::where('id', $exam_id)->update(['status' => 0]);
        return redirect('view-exams')->with(['message-warning' => 'Exam ' . $title . ' inactivated successfully.']);
    }

    public function make_active_exam($exam_id) {
        $title = Exam::where('id', $exam_id)->value('title');
        Exam::where('id', $exam_id)->update(['status' => 1]);
        return redirect('view-exams')->with(['message-info' => 'Exam ' . $title . ' activated successfully.']);
    }

}
