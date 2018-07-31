<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Book;
use App\Http\Controllers\Controller;

class ApiController extends Controller {

    public function sms_compose() {
        $institute = \App\Institute_detail::limit(1)->get();
        $academic_year_id = Session::get('academic_year_id');
        $class = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        if (COUNT($class) > 0) {
            foreach ($class as $c) {
                $id = $c->id;
                $classes[] = DB::select(DB::raw("SELECT class_sections.id,class_sections.class_id,class_sections.section_id, classes.class_name,sections.section_name,class_sections.id, COUNT(class_sections.id) as total_students FROM class_sections INNER JOIN students ON class_sections.id=students.class_section_id 
LEFT JOIN classes ON classes.id=class_sections.class_id
LEFT JOIN sections ON sections.id=class_sections.section_id WHERE students.status=1 AND class_sections.academic_year_id = $academic_year_id AND students.academic_year_id = $academic_year_id AND
class_sections.id =$id"));
            }
        } else {
            $classes[] = array();
        }
        return view('sms/sms_compose', compact('classes', 'institute'));
    }

    public function sms_send(Request $request) {
        $this->validate($request, [
            'class_section_id' => 'required',
            'message' => 'required'
        ]);
        $created_user_id = Session::get('user_login_id');
        $a_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $class = $request['class_section_id'];
        $students = \App\Student::where('class_section_id', $class)->where('status', 1)->where('academic_year_id', $a_id)->get();
        $m = $request['message'];
        $msg = urlencode($m);
        $message = $msg;
        $l_msg = strlen($m);
        $n_msgs = ceil($l_msg / 160);
        $p_msg = COUNT($students);
        $total = $n_msgs * $p_msg;
        if (($institute[0]->sms_count >= $total) && $p_msg != 0) {
            $username = "vidyapp";
            $password = "bharratH";
            $sender = $institute[0]->sms_sender;
            //print_r($sender);exit;
            foreach ($students as $student) {
                $number = $student->contact_number;
                $url = "https://49.50.67.32/smsapi/httpapi.jsp?username=" . $username . "&password=" . $password . "&from=" . $sender . "&to=" . $number . "&text=" . $message . "";
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                ));
                $resp = curl_exec($curl);
                \App\Institute_detail::limit(1)->update([
                    'sms_count' => \DB::raw('sms_count -' . $n_msgs)
                ]);
            }
            //echo $resp;exit;
            $messages = new \App\Sent_message();
            $messages->message = $m;
            $messages->message_count = $total;
            $messages->created_user_id = $created_user_id;
            $messages->academic_year_id = $a_id;
            $messages->save();

            return redirect('sms-sent')->with(['message-success' => 'Message sent to the selected class students who are active.']);
        } else {
            return redirect('sms-compose')->with(['message1-danger' => 'You don\'t have sufficient SMS balance to send message or no students']);
        }
    }

    public function sms_credentials() {
        $institute = \App\Institute_detail::limit(1)->get();
        $academic_year_id = Session::get('academic_year_id');
        $users = \App\User_type:: whereHas('staff', function($query) use($academic_year_id) {
                    $query->where('academic_year_id', $academic_year_id)->where('staff.status', 1);
                })->get();
        $students = \App\User_type:: whereHas('students', function($query) use($academic_year_id) {
                    $query->where('academic_year_id', $academic_year_id)->where('students.status', 1);
                })->get();
        $parents = \App\User_type:: whereHas('parents', function($query) use($academic_year_id) {
                    $query->where('academic_year_id', $academic_year_id)->where('parent_details.status', 1);
                })->get();
        return view('sms/sms_credentials', compact('users', 'students', 'parents', 'institute'));
    }

    public function sms_send_credentials(Request $request) {
        $this->validate($request, [
            'user_type_id' => 'required'], [
            'user_type_id.required' => 'Please select the users from the list. ',
                ]
        );
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        if ($institute[0]->sms_count != 0) {
            $a_id = Session::get('academic_year_id');
            $username = "vidyapp";
            $password = "bharratH";
            $sender = $institute[0]->sms_sender;
            $user_type_id = $request['user_type_id'];
            $link = $institute[0]->short_url;
            if ($user_type_id == 5) {
                $users = \App\Student::where('status', 1)->where('academic_year_id', $a_id)->get();
            }
            if ($user_type_id == 2 || $user_type_id == 3 || $user_type_id == 4 || $user_type_id == 6 || $user_type_id == 8) {
                $users = \App\Staff::where('status', 1)->where('academic_year_id', $a_id)->get();
            }
            if ($user_type_id != 7) {
                if ($institute[0]->sms_count > COUNT($users)) {
                    foreach ($users as $user) {
                        $credentials = \App\User_login::where('id', $user->user_login_id)->get();
                        $number = $user->contact_number;
                        $user_name = $credentials[0]->user_name;
                        $pass_word = $credentials[0]->password;
                        $msg = urlencode('your school login details username:' . $user_name . ' ,password:' . $pass_word . ' click here ' . $link . ' to login.');
                        $message = $msg;
                        $l_msg = strlen($msg);
                        $n_msgs = ceil($l_msg / 160);

                        $url = "https://49.50.67.32/smsapi/httpapi.jsp?username=" . $username . "&password=" . $password . "&from=" . $sender . "&to=" . $number . "&text=" . $message . "";



                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_URL => $url,
                        ));
                        $resp = curl_exec($curl);
                        \App\Institute_detail::limit(1)->update([
                            'sms_count' => \DB::raw('sms_count -' . $n_msgs)
                        ]);
                    }
                } else {
                    return redirect('sms-credentials')->with(['message1-danger' => 'You don\'t have enough credit balance.']);
                }
                $title = \App\User_type::where('id', $request['user_type_id'])->value('title');
                $p_msg = COUNT($users);
                $total = $n_msgs * $p_msg;
                $messages = new \App\Sent_message();
                $messages->message = "Sending " . $title . " username and password.";
                $messages->message_count = $total;
                $messages->created_user_id = $created_user_id;
                $messages->academic_year_id = $academic_year_id;
                $messages->save();
            }
            if ($user_type_id == 7) {
                $parents = \App\Parent_detail::where('status', 1)->where('academic_year_id', $a_id)->get();
                if ($institute[0]->sms_count > COUNT($parents)) {
                    foreach ($parents as $parent) {
                        $institute = \App\Institute_detail::limit(1)->decrement('sms_count');
                        $users = \App\Student::where('id', $parent->student_id)->where('academic_year_id', $a_id)->get();
                        $credentials = \App\User_login::where('id', $parent->user_login_id)->get();
                        $number = $users[0]->father_number;
                        $user_name = $credentials[0]->user_name;
                        $pass_word = $credentials[0]->password;
                        $msg = urlencode('your school login details username:' . $user_name . ' ,password:' . $pass_word . ' click here ' . $link . 'to login.');
                        $message = $msg;
                        $url = "https://49.50.67.32/smsapi/httpapi.jsp?username=" . $username . "&password=" . $password . "&from=" . $sender . "&to=" . $number . "&text=" . $message . "";
                        $l_msg = strlen($msg);
                        $n_msgs = ceil($l_msg / 160);

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_RETURNTRANSFER => 1,
                            CURLOPT_URL => $url,
                        ));
                        $resp = curl_exec($curl);
                        \App\Institute_detail::limit(1)->update([
                            'sms_count' => \DB::raw('sms_count -' . $n_msgs)
                        ]);
                    }
                } else {
                    return redirect('sms-credentials')->with(['message1-danger' => 'You don\'t have enough credit balance.']);
                }
                $p_msg = COUNT($parents);
                $total = $n_msgs * $p_msg;
                $messages = new \App\Sent_message();
                $messages->message = "Sending parent username and password.";
                $messages->message_count = $total;
                $messages->created_user_id = $created_user_id;
                $messages->academic_year_id = $academic_year_id;
                $messages->save();
            }
            // echo $resp;exit;
            return redirect('sms-sent')->with(['message-success' => 'Message Successfully Sent.']);
        } else {
            return redirect('sms-credentials')->with(['message1-danger' => 'You don\'t have sufficient SMS balance to send message.']);
        }
    }

    public function sms_sent() {
        $institute = \App\Institute_detail::limit(1)->get();
        $academic_year_id = Session::get('academic_year_id');
        $messages = \App\Sent_message::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();
        return view('sms/sent_sms', compact('messages', 'institute'));
    }

    public function sms_individual_create() {
        $institute = \App\Institute_detail::limit(1)->get();
        return view('sms/sms_individual_create', compact('institute'));
    }

    public function sms_individual_view() {
        $institute = \App\Institute_detail::limit(1)->get();
        $academic_year_id = Session::get('academic_year_id');
        $messages = \App\Individual_sent_message::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();
        return view('sms/sms_individual_view', compact('messages', 'institute'));
    }

    public function sms_individual_send(Request $request) {
        $this->validate($request, [
            'phone' => 'required|min:10',
            'message' => 'required'
        ]);
        $created_user_id = Session::get('user_login_id');
        $a_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $m = $request['message'];
        $msg = urlencode($m);
        $message = $msg;
        $l_msg = strlen($m);
        $n_msgs = ceil($l_msg / 160);
        $p_msg = 1;
        $total = $n_msgs * $p_msg;
        if (($institute[0]->sms_count >= $total) && $p_msg != 0) {
            $username = "vidyapp";
            $password = "bharratH";
            $sender = $institute[0]->sms_sender;
            $number = $request['phone'];

            $url = "https://49.50.67.32/smsapi/httpapi.jsp?username=" . $username . "&password=" . $password . "&from=" . $sender . "&to=" . $number . "&text=" . $message . "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
            ));
            $resp = curl_exec($curl);
            \App\Institute_detail::limit(1)->update([
                'sms_count' => \DB::raw('sms_count -' . $n_msgs)
            ]);

//            $messages = new \App\Sent_message();
//            $messages->message = $m;
//            $messages->message_count = 1;
//            $messages->created_user_id = $created_user_id;
//            $messages->academic_year_id = $a_id;
//            $messages->save();

            $messages = new \App\Individual_sent_message();
            $messages->message = $m;
            $messages->message_count = $total;
            $messages->phone = $number;
            $messages->created_user_id = $created_user_id;
            $messages->academic_year_id = $a_id;
            $messages->save();

            return redirect('sms-individual-view')->with(['message-success' => 'Message sent successfuly']);
        } else {
            return redirect('sms-compose')->with(['message1-danger' => 'You don\'t have sufficient SMS balance to send message or no students']);
        }
    }

}
