<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use \Input as Input;
use App\Http\Controllers\Controller;

class StaffDocumentsController extends Controller {

    public function add_staff_document(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $uri = $request->path();
            $url_parts = explode('/', $uri);
            $staff_id = $url_parts[1];
            $staff = \App\Staff::where('id', $staff_id)->get();
            $staff_documents = \App\Staff_document::where('staff_id', $staff[0]->staff_id)->orderBy('created_at', 'desc')->get();
            if (COUNT($staff) != 1):
                return redirect('add-staff');
            endif;
            return view('staff_documents/add_staff_document', compact('staff', 'staff_documents'));
        } else {
            return redirect('view-staff');
        }
    }

    public function view_staff_documents($staff_id) {
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
        }
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
        if ($classes != ''):
            $no_classes = $classes[0]->subjects;
        else:
            $no_classes = 0;
        endif;
        $staff_documents = \App\Staff_document::where('staff_id', $staffs[0]->staff_id)->orderBy('created_at', 'desc')->get();
        return view('staff_documents/view_staff_documents', compact('staffs', 'staff_documents', 'institute_details', 'no_classes'));
    }

    public function do_add_staff_document(Request $request, $staff_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'file_name' => 'required',
            'document' => 'required',
        ]);
        $staff = \App\Staff::where('id', $staff_id)->get();
        $staff_documents = new \App\Staff_document();
        $staff_documents->file_name = $request['file_name'];
        $staff_documents->staff_id = $staff[0]->staff_id;
        $staff_documents->created_user_id = $created_user_id;
        $staff_documents->academic_year_id = $academic_year_id;
        if ($request->hasFile('document')) {
            $file = Input::file('document');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp;
            $file->move(public_path() . '/uploads/staff_documents/', $name);
            $staff_documents->document = $name;
        }
        $staff_documents->save();
        $data = array(
            'log_type' => ' Staff document successfully!',
            'message' => 'Added',
            'new_value' => $request['file_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('add-staff-document/' . $staff_id)->with(['message-success' => 'Document ' . $request['file_name'] . ' added successfully.']);
    }

    public function delete_staff_document($staff_id, $staff_document_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = \App\Staff_document::where('id', $staff_document_id)->get();
        if ($old_values != '') {
            $image = $old_values[0]->document;
            if ($image != '') {
                $image_doc = public_path() . '/uploads/staff_documents/' . $image;
                if (file_exists($image_doc)) {
                    unlink($image_doc);
                }
            }
        }
        $data = array(
            'log_type' => 'Staff document details deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $document = \App\Staff_document::where('id', $staff_document_id)->value('file_name');
        \App\Staff_document::where('id', $staff_document_id)->delete();
        return redirect('add-staff-document/' . $staff_id)->with(['message-danger' => 'Staff document in ' . $document . ' deleted successfully.']);
    }

}
