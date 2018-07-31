<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Parent_message;
use App\Http\Controllers\Controller;

class ParentMessagesController extends Controller {

    public function add_message() {
        return view('parent_messages/add_message');
    }

    public function do_add_message(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ]);
        $student_id = Session::get('student_id');
        $parent_id = \App\Parent_detail::where('student_id', $student_id)->value('id');
        $messages = new Parent_message();
        $messages->subject = $request['subject'];
        $messages->message = $request['message'];
        $messages->parent_id = $parent_id;
        $messages->student_id = $student_id;
        $messages->created_user_id = $created_user_id;
        $messages->academic_year_id = $academic_year_id;
        $messages->save();
        $data = array(
            'log_type' => ' Message sent successfully!',
            'message' => 'Sent Message',
            'new_value' => $request['subject'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-messages')->with(['message-success' => 'Message " ' . $request['subject'] . ' " sent successfully.']);
    }

    public function view_messages() {
        $academic_year_id = Session::get('academic_year_id');
        $student_id = Session::get('student_id');
        $parent_id = \App\Parent_detail::where('student_id', $student_id)->value('id');
        $messages = Parent_message::where('parent_id', $parent_id)->where('academic_year_id', $academic_year_id)->where('student_id', $student_id)->orderBy('created_at', 'desc')->get();
        return view('parent_messages/view_messages', compact('messages'));
    }

    public function admin_view_messages() {
        $academic_year_id = Session::get('academic_year_id');
        $messages = Parent_message::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('parent_messages/admin_view_messages', compact('messages'));
    }

    public function edit_message($message_id) {
        $messages = Parent_message::where('id', $message_id)->get();
        return view('parent_messages/edit_message', compact('messages'));
    }

    public function do_edit_message(Request $request, $message_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'
        ]);
        $student_id = Session::get('student_id');
        $parent_id = \App\Parent_detail::where('student_id', $student_id)->value('id');
        $messages = Parent_message::find($message_id);
        $messages->subject = $request['subject'];
        $messages->message = $request['message'];
        $messages->parent_id = $parent_id;
        $messages->student_id = $student_id;
        $messages->updated_user_id = $created_user_id;
        //$messages->academic_year_id = $academic_year_id;
        $old_values = Parent_message::find($message_id);
        $data = array(
            'log_type' => 'Message updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['subject'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $messages->update();
        return redirect('view-messages')->with(['message-success' => 'Message ' . $request['subject'] . ' updated successfully.']);
    }

    public function delete_message($message_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $subject = Parent_message::where('id', $message_id)->value('subject');
        $old_values = Parent_message::where('id', $message_id)->get();
        $data = array(
            'log_type' => 'Message deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Parent_message::where('id', $message_id)->delete();
        return redirect('admin-view-messages')->with(['message-danger' => 'Message ' . $subject . ' deleted successfully.']);
    }

    public function make_inactive_message($message_id) {
        $subject = Parent_message::where('id', $message_id)->value('subject');
        Parent_message::where('id', $message_id)->update(['status' => 0]);
        return redirect('admin-view-messages')->with(['message-warning' => 'Message ' . $subject . ' inactivated successfully.']);
    }

    public function make_active_message($message_id) {
        $subject = Parent_message::where('id', $message_id)->value('subject');
        Parent_message::where('id', $message_id)->update(['status' => 1]);
        return redirect('admin-view-messages')->with(['message-info' => 'Message ' . $subject . ' activated successfully.']);
    }

}
