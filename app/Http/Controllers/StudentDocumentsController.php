<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use \Input as Input;
use App\Http\Controllers\Controller;

class StudentDocumentsController extends Controller {

    public function add_student_document(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $uri = $request->path();
            $url_parts = explode('/', $uri);
            $student_id = $url_parts[1];
            $student = \App\Student::where('id', $student_id)->get();
            $id = \App\Student::where('id', $student_id)->value('student_id');
            $student_documents = \App\Student_document::where('student_id', $id)->orderBy('created_at', 'desc')->get();
            if (COUNT($student) != 1):
                return redirect('add-student');
            endif;
            return view('student_documents/add_student_document', compact('student', 'student_documents'));
        } else {
            return redirect('view-student');
        }
    }

    public function do_add_student_document(Request $request, $student_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'file_name' => 'required',
            'document' => 'required',
        ]);
        $id = \App\Student::where('id', $student_id)->value('student_id');
        $student_documents = new \App\Student_document();
        $student_documents->file_name = $request['file_name'];
        $student_documents->student_id = $id;
        $student_documents->created_user_id = $created_user_id;
        $student_documents->academic_year_id = $academic_year_id;
        if ($request->hasFile('document')) {
            $file = Input::file('document');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp;
            $file->move(public_path() . '/uploads/students/documents/', $name);
            $student_documents->document = $name;
        }
        $student_documents->save();
        $data = array(
            'log_type' => ' Student document successfully!',
            'message' => 'Added',
            'new_value' => $request['file_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('add-student-document/' . $student_id)->with(['message-success' => 'Document ' . $request['file_name'] . ' added successfully.']);
    }

    public function delete_student_document($student_id, $student_document_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = \App\Student_document::where('id', $student_document_id)->get();
        if ($old_values != '') {
            $image = $old_values[0]->document;
            if ($image != '') {
                $image_doc = public_path() . '/uploads/students/documents/' . $image;
                if (file_exists($image_doc)) {
                    unlink($image_doc);
                }
            }
        }
        $data = array(
            'log_type' => 'Student document details deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $document = \App\Student_document::where('id', $student_document_id)->value('file_name');
        \App\Student_document::where('id', $student_document_id)->delete();
        return redirect('add-student-document/' . $student_id)->with(['message-danger' => 'Student document in ' . $document . ' deleted successfully.']);
    }

}
