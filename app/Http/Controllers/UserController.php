<?php

namespace App\Http\Controllers;

//=========models
use App\Sections as Sections;
use \App\User_type as User_type;
use \App\Users as Users;
use \App\Classes as Classes;
use \App\Subjects as Subjects;
use \App\Logdetails as Logdetails;
use \App\Academic_Year as Academic_Year;
//==============system-defined
Use laravelcollective\html;
use Hash;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use DB;
use Validator;
use Excel;
use Redirect;
use \Input as Input;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Pagination\Paginator;

class UserController extends Controller {

    public function authenticate(Request $request) {
        $user_name = $request->username;
        $password = $request->password;
        $user_logins = DB::select(DB::raw("SELECT * FROM user_logins WHERE BINARY user_name = '$user_name' && BINARY password = '$password'"));
        if (count($user_logins) == 1) {
            if ($user_logins[0]->status == 1) {

                $request->session()->put('user_login_id', $user_logins[0]->user_login_id);
                $user_login_id = $user_logins[0]->user_login_id;
                Session::put('user_type_id', $user_logins[0]->user_type);
                $settings_check = DB::table('settings_check')->where('settings_check_id', 1)->get();
                if ($settings_check[0]->set_institute_details == 0 && $settings_check[0]->acadamic_year_id == 0 && $settings_check[0]->set_fee_details == 0) {
                    Session::put('Not_A_user', 'Not at Regiser');
                    $request->session()->put('username', $user_name);
                    return redirect('settings/add_academic_year');
                } else {
                    $academic_check = DB::select(DB::raw("SELECT * FROM academic_years WHERE CURRENT_DATE BETWEEN from_date AND to_date"));
                    if (count($academic_check) == 0) {
                        Session::put('academic_year_expire', 'your Academic Year Expired Please Contact Your Service Providers');
                        return redirect('/');
                    }
                    if ($user_logins[0]->user_type == 4) {
                        $request->session()->put('student_user_name', $user_name);
                        $student_profile = DB::select(DB::raw("select profile_pic from students where user_login_id=$user_login_id"));
                        $student_profile1 = $student_profile[0]->profile_pic;
                        Session::put('student_profile_pic_name', $student_profile1);
                        $institution_details = DB::table('institute_details')->where('institute_id', 1)->get();
                        Session::put('institution_logo', $institution_details[0]->institution_logo);
                        return redirect('student_login_profile');
                    } elseif ($user_logins[0]->user_type == 8) {
                        $request->session()->put('parent_user_name', $user_name);
                        $parent_profile = DB::select(DB::raw("select profile_pic from parents where user_login_id=$user_login_id"));
                        $parent_profile1 = $parent_profile[0]->profile_pic;
                        Session::put('parent_profile_pic_name', $parent_profile1);
                        $institution_details = DB::table('institute_details')->where('institute_id', 1)->get();
                        Session::put('institution_logo', $institution_details[0]->institution_logo);
                        return redirect('parent_login_profile');
                    } elseif ($user_logins[0]->user_type == 6) {
                        $request->session()->put('staff_user_name', $user_name);
                        $institution_details = DB::table('institute_details')->where('institute_id', 1)->get();
                        Session::put('academic_year_id', $institution_details[0]->academic_year_id);
                        $staff_profile = DB::select(DB::raw("select * from staff where user_login_id=$user_login_id"));
                        $staff_profile1 = $staff_profile[0]->profile_pic;
                        Session::put('parent_profile_pic_name', $staff_profile1);
                        $institution_details = DB::table('institute_details')->where('institute_id', 1)->get();
                        Session::put('institution_logo', $institution_details[0]->institution_logo);
                        return redirect('staff_login_profile');
                    } elseif ($user_logins[0]->user_type == 7) {
                        Session::put('status_error', 'Your Login Credentials are low,Please Contact SuperAdmin');
                        return view('users/login');
                    } else {
                        $request->session()->put('username', $user_name);
                        $user_details = DB::table('users')->where('user_login_id', $user_logins[0]->user_login_id)->get();
                        Session::put('user_profile_pic_name', $user_details[0]->photo);
                        $request->session()->put('userid', $user_details[0]->user_id);
                        $institution_details = DB::table('institute_details')->where('institute_id', 1)->get();
                        Session::put('institution_logo', $institution_details[0]->institution_logo);
                        Session::put('academic_year_id', $institution_details[0]->academic_year_id);
                        // $comments=DB::table('parent_comments')->select('comment')->orderBy('parent_comment_id', 'desc')->take(5);
//                        $comments=DB::select((DB::raw("select comment from parent_comments ORDER BY parent_comment_id DESC LIMIT 5")));
//                        if(count($comments)==1){
//                         $request->session()->put('comments1',$comments[0]->comment);
//                         return redirect('dashboard');
//                        }elseif(count($comments)==2){
//                          $request->session()->put('comments1',$comments[0]->comment);
//                        $request->session()->put('comments2',$comments[1]->comment); 
//                        return redirect('dashboard');
//                        }elseif(count($comments)==3){
//                          $request->session()->put('comments1',$comments[0]->comment);
//                        $request->session()->put('comments2',$comments[1]->comment);
//                        $request->session()->put('comments3',$comments[2]->comment);
//                        return redirect('dashboard');
//                        }elseif(count($comments)==4){
//                        $request->session()->put('comments1',$comments[0]->comment);
//                        $request->session()->put('comments2',$comments[1]->comment);
//                        $request->session()->put('comments3',$comments[2]->comment);
//                        $request->session()->put('comments4',$comments[3]->comment);
//                        return redirect('dashboard');
//                        }else{
//                        $request->session()->put('comments1',$comments[0]->comment);
//                        $request->session()->put('comments2',$comments[1]->comment);
//                        $request->session()->put('comments3',$comments[2]->comment);
//                        $request->session()->put('comments4',$comments[3]->comment);
//                        $request->session()->put('comments5',$comments[4]->comment);
//                        
//                        
//                        return redirect('dashboard');
//                    }}


                        $current_time = \Carbon\Carbon::now()->toDateTimeString();
                        $user_name = Session::get('username');

                        function getBrowser() {
                            $u_agent = $_SERVER['HTTP_USER_AGENT'];
                            $bname = 'Unknown';
                            $platform = 'Unknown';
                            $version = "";
                            if (preg_match('/linux/i', $u_agent)) {
                                $platform = 'linux';
                            } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                                $platform = 'mac';
                            } elseif (preg_match('/windows|win32/i', $u_agent)) {
                                $platform = 'windows';
                            }
                            if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
                                $bname = 'Internet Explorer';
                                $ub = "MSIE";
                            } elseif (preg_match('/Firefox/i', $u_agent)) {
                                $bname = 'Mozilla Firefox';
                                $ub = "Firefox";
                            } elseif (preg_match('/Chrome/i', $u_agent)) {
                                $bname = 'Google Chrome';
                                $ub = "Chrome";
                            } elseif (preg_match('/Safari/i', $u_agent)) {
                                $bname = 'Apple Safari';
                                $ub = "Safari";
                            } elseif (preg_match('/Opera/i', $u_agent)) {
                                $bname = 'Opera';
                                $ub = "Opera";
                            } elseif (preg_match('/Netscape/i', $u_agent)) {
                                $bname = 'Netscape';
                                $ub = "Netscape";
                            }
                            $known = array('Version', $ub, 'other');
                            $pattern = '#(?<browser>' . join('|', $known) .
                                    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                            if (!preg_match_all($pattern, $u_agent, $matches)) {
                                
                            }
                            $i = count($matches['browser']);
                            if ($i != 1) {
                                if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                                    $version = $matches['version'][0];
                                } else {
                                    $version = $matches['version'][1];
                                }
                            } else {
                                $version = $matches['version'][0];
                            }
                            if ($version == null || $version == "") {
                                $version = "?";
                            }

                            return array(
                                'userAgent' => $u_agent,
                                'name' => $bname,
                                'version' => $version,
                                'platform' => $platform,
                                'pattern' => $pattern
                            );
                        }

                        $ua = getBrowser();
                        $yourbrowser = $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'];


                        $data = array(
                            'log_in' => $current_time,
                            'log_type' => 'Login',
                            'ip_address' => $_SERVER['REMOTE_ADDR'],
                            'user_browser' => $yourbrowser,
                            'created_at' => $current_time,
                            'user_name' => $user_name);
                        DB::table('logs')->insert($data);
                        return redirect('dashboard');
                    }
                }
            } else {
                Session::put('status_error', 'Your Login Credentials are low,Please Contact SuperAdmin');
                return view('users/login');
            }
        } else {
            Session::put('login-error', 'your entered username or password not match.');
            return view('users/login');
        }
    }

    public function dashboard() {
        return view('dashboard/dashboard');
    }

    public function user_type() {
        return view('users/user_type');
    }

    public function add_user_type(Request $request) {
        $data = Input::except(array('_token'));
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');

        $rule = array(
            'title' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255|unique:user_types',
            'status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $data1 = array(
                'title' => $request->input('title'),
                'created_user_id' => $created_user_id,
                'academic_year_id' => $academic_year_id,
                'status' => $request->input('status'));
            DB::table('user_types')->insert($data1);
            $new_value = json_encode($data1, true);
            $data2 = array(
                'log_type' => 'Add usertype details',
                'message' => 'Added',
                'new_value' => $new_value,
                'old_value' => "No old Value for Add Activity",
                'user_name' => $created_user_id);
            DB::table('log_details')->insert($data2);
            Session::put('add_user_type_message', 'user type added successfully');
            return redirect('view_user_types');
        }
    }

    public function login() {
        return view('users/login');
    }

    public function view_user_types() {
        $user_types['user_types'] = DB::select(DB::raw("SELECT ut.user_type_id,ut.title,ul.user_name,ut.status,ut.created_user_id,ut.updated_user_id,ut.created_at,ut.updated_at FROM `user_types` ut LEFT JOIN user_logins ul ON ul.user_login_id=ut.created_user_id WHERE ut.active=1"));
        return view('users/view_user_types', $user_types);
    }

    public function edit_user_type($id) {
        $user_types['user_types'] = DB::table('user_types')->where('user_type_id', $id)->get();
        Session::put('user_type_id', $id);
        return view('users/edit_user_type', $user_types);
    }

    public function do_edit_user_type(Request $request) {
        $id = Session::get('user_type_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'title' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255',
            'status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $result = DB::table('user_types')->where('user_type_id', $id)->get();
            $title = $result[0]->title;
            $status = $result[0]->status;
            $old_value = "title=" . $title . ",status=" . $status . ",user type id=" . $id;
            $updated_userid = Session::get('user_login_id');
            $user_type = $request->input('title');
            $select = $request->input('status');
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            DB::table('user_types')
                    ->where('user_type_id', $id)
                    ->limit(1)
                    ->update(array('title' => $user_type, 'status' => $select, 'updated_user_id' => $updated_userid, 'updated_at' => $current_time));
            Session::set('user_type_edit_message', 'your Edited User details are updated');
            $new_value = "title=$user_type,status=$select,updated_user_id=$updated_userid,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'User Type Edit',
                'message' => 'Edited',
                'new_value' => $new_value,
                'old_value' => $old_value,
                'user_name' => $updated_userid);
            DB::table('log_details')->insert($data1);
            Session::forget('user_type_id');
            return redirect('view_user_types');
        }
    }

    public function delete_user_type($id) {
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('user_types')->where('user_type_id', $id)->get();
        $title = $result[0]->title;
        $status = $result[0]->status;
        $old_value = "title=" . $title . ",status=" . $status . ",user type id=" . $id;
        $data1 = array(
            'log_type' => 'Delete user type details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        //$user = DB::table('user_types')->where('user_type_id', $id)->delete();
        $user = DB::table('user_types')->where('user_type_id', $id)->update(['active' => 0]);
        if ($user) {
            Session::put('delete_user_type_message', 'Selected User Type Details deleted Successfully');
            return redirect('view_user_types');
        } else {
            
        }
    }

    public function usertypesearch(Request $request) {
        $query = $request->input('search');
        if ($query) {
            $user_types['user_types'] = DB::table('user_types')
                    ->leftJoin('user_logins', 'user_types.created_user_id', '=', 'user_logins.user_login_id')
                    ->select('user_types.user_type_id', 'user_types.title', 'user_types.status', 'user_types.created_at', 'user_types.updated_at', 'user_logins.user_name')
                    ->orWhere('user_types.user_type_id', 'LIKE', '%' . $query . '%')
                    ->orWhere('user_types.title', 'LIKE', '%' . $query . '%')
                    ->orWhere('user_types.status', 'LIKE', '%' . $query . '%')
                    ->paginate(20);

            return view('users/view_user_types', $user_types, ['value' => $query]);
        }
    }

    public function add_user() {
        $users['users'] = DB::select(DB::raw("SELECT user_type_id,title FROM user_types where user_type_id in(2,3,5)"));
        return view('users/add_user', $users);
    }

    public function do_add_user(Request $request) {
        $data = Input::except(array('_token'));
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $rule = array(
            'firstname' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255',
            'lastname' => 'required|regex:/^[\pL\s]+$/u',
            'user_name' => 'required|min:3|max:255|unique:user_logins',
            'email_id' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'address' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif | max:4000',
            'usertype' => 'required',
            'status' => 'required',
            'phone' => 'required|numeric|min:10'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            $pass = $request->input('password');
            $password = Hash::make($pass);
            if ($request->hasFile('photo')) {
                $file = Input::file('photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $name);
            }
            $data2 = array(
                'user_name' => $request->input('user_name'),
                'password' => $request->input('password'),
                'user_type' => $request->input('usertype'),
                'status' => $request->input('status'));
            DB::table('user_logins')->insert($data2);
            $results = DB::select(DB::raw("SELECT max(user_login_id) as user_login_id FROM user_logins"));
            $userloginid = $results[0]->user_login_id;
            $data1 = array(
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'email_id' => $request->input('email_id'),
                'address' => $request->input('address'),
                'user_type_id' => $request->input('usertype'),
                'user_login_id' => $userloginid,
                'photo' => $name,
                'contact_number' => $request->input('phone'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $created_user_id);
            DB::table('users')->insert($data1);
            $newvalue = json_encode($data1, true);
            $created_user_id = Session::get('user_login_id');
            $data3 = array(
                'log_type' => 'Add user details',
                'message' => 'Added',
                'new_value' => $newvalue,
                'old_value' => "No old Value for Add Activity",
                'user_name' => $created_user_id);
            DB::table('log_details')->insert($data3);
            Session::put('add_user_message', 'user added successfully');
            return redirect('view_users');
        }
    }

    public function view_users() {
        $users['users'] = DB::select(DB::raw("SELECT u.user_id,u.user_login_id,u.user_type_id,u.first_name,u.last_name,u.email_id,u.contact_number,u.photo,u.address,u.created_user_id,ul.user_name,u.created_at FROM `users` u LEFT JOIN user_logins ul ON ul.user_login_id=u.created_user_id where u.active=1"));

        return view('users/view_users', $users);
    }

    public function userssearch(Request $request) {
        $query = $request->input('search');
        if ($query) {
            $users['users'] = DB::table('users')
                    ->leftJoin('user_logins', 'users.created_user_id', '=', 'user_logins.user_login_id')
                    ->select('users.user_id', 'users.first_name', 'users.last_name', 'users.email_id', 'users.contact_number', 'users.photo', 'users.created_at', 'users.updated_at', 'user_logins.user_name')
                    ->orwhere('users.user_id', 'LIKE', '%' . $query . '%')
                    ->orWhere('users.first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('users.last_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('users.email_id', 'LIKE', '%' . $query . '%')
                    ->orWhere('users.contact_number', 'LIKE', '%' . $query . '%')
                    ->paginate(20);
            return view('users/view_users', $users, ['value' => $query]);
        }
    }

    public function edit_user($id) {
        $users['users'] = DB::table('users')
                ->join('user_logins', 'users.user_login_id', '=', 'user_logins.user_login_id')
                ->select('users.user_id', 'users.user_type_id', 'user_logins.user_name', 'user_logins.status', 'users.first_name', 'users.last_name', 'users.email_id', 'users.address', 'users.contact_number', 'users.photo', 'users.created_at', 'users.updated_at')
                ->where('users.user_id', $id)
                ->get();
        $users['usertypes'] = DB::table('user_types')->select('title')->get();
        Session::put('userid1', $id);
        return view('users/edit_user', $users);
    }

    public function do_edit_user(Request $request) {
        $id = Session::get('userid1');
        $id1 = Session::get('user_login_id');
        $result = DB::table('users')->where('user_id', $id)->get();
        $first_name = $result[0]->first_name;
        $last_name = $result[0]->last_name;
        $email = $result[0]->email_id;
        $address = $result[0]->address;
        $phone = $result[0]->contact_number;
        $userType_Id = $result[0]->user_type_id;
        $userLogin_Id = $result[0]->user_login_id;

        $oldvalue = "user  id=" . $id . ",first name=" . $first_name . ",Last Name=" . $last_name . ",Email id=" . $email
                . ",address=" . $address . ",contact number=" . $phone . ",user type id=" . $userType_Id . ",user login id=" . $userLogin_Id;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $data = Input::except(array('_token'));
        $rule = array(
            'firstname' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255',
            'lastname' => 'required|regex:/^[\pL\s]+$/u',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif | max:4000',
            'usertype' => 'required',
            'status' => 'required',
            'phone' => 'required|numeric|min:10'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->hasFile('photo')) {
                $file = Input::file('photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/', $name);

                $first_name = $request->input('firstname');
                $last_name = $request->input('lastname');
                $email_id = $request->input('email');
                $user_name = $request->input('username');
                $address = $request->input('address');
                $user_type_id = $request->input('usertype');
                $contact_number = $request->input('phone');
                DB::table('users')
                        ->where('user_id', $id)
                        ->limit(1)
                        ->update(array('first_name' => $first_name, 'last_name' => $last_name, 'photo' => $name, 'email_id' => $email_id, 'address' => $address, 'contact_number' => $contact_number, 'user_type_id' => $user_type_id, 'updated_user_id' => $id1, 'updated_at' => $current_time));
                DB::table('user_logins')->where('user_login_id', $userLogin_Id)->limit(1)->update(array('user_name' => $user_name));
                Session::put('update_user_message', 'user Updated successfully');
                $newvalue = "first_name=$first_name,last_name=$last_name,photo=$name,email_id =$email_id,address=$address,contact_number=$contact_number,user_type_id= $user_type_id, updated_user_id =$id1,updated_at=$current_time";
                $data1 = array(
                    'log_type' => 'Edit User Details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => $oldvalue,
                    'user_name' => $id1);
                DB::table('log_details')->insert($data1);
            } else {
                $first_name = $request->input('firstname');
                $last_name = $request->input('lastname');
                $email_id = $request->input('email');
                $user_name = $request->input('username');
                $address = $request->input('address');
                $user_type_id = $request->input('usertype');
                $contact_number = $request->input('phone');
                DB::table('users')
                        ->where('user_id', $id)
                        ->limit(1)
                        ->update(array('first_name' => $first_name, 'last_name' => $last_name, 'email_id' => $email_id, 'address' => $address, 'contact_number' => $contact_number, 'user_type_id' => $user_type_id, 'updated_user_id' => $id1, 'updated_at' => $current_time));
                DB::table('user_logins')->where('user_login_id', $userLogin_Id)->limit(1)->update(array('user_name' => $user_name));
                Session::put('update_user_message', 'user Updated successfully');
                $newvalue = "first_name=$first_name,last_name=$last_name,email_id =$email_id,address=$address,contact_number=$contact_number,user_type_id= $user_type_id, updated_user_id =$id1,updated_at=$current_time";
                $data1 = array(
                    'log_type' => 'Edit User Details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => $oldvalue,
                    'user_name' => $id1);
                DB::table('log_details')->insert($data1);
            }
            Session::forget('userid1');
            return redirect('view_users');
        }
    }

    public function delete_user($id) {
        $delete_user_id = DB::table('users')->select('user_login_id')->where('user_id', $id)->get();
        $login_user_id = $delete_user_id[0]->user_login_id;
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('users')->where('user_id', $id)->get();
        $first_name = $result[0]->first_name;
        $last_name = $result[0]->last_name;
        $email = $result[0]->email_id;
        $address = $result[0]->address;
        $phone = $result[0]->contact_number;
        $userType_Id = $result[0]->user_type_id;
        $userLogin_Id = $result[0]->user_login_id;
        $oldvalue = "user  id=" . $id . ",first name=" . $first_name . ",Last Name=" . $last_name . ",Email id=" . $email
                . ",address=" . $address . ",contact number=" . $phone . ",user type id=" . $userType_Id . ",user login id=" . $userLogin_Id;
        $data1 = array(
            'log_type' => 'Delete user details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        //$user = DB::table('users')->where('user_id', $id)->delete();
        $user = DB::table('users')->where('user_id', $id)->update(['active' => 0]);
        // $delete = DB::table('user_logins')->where('user_login_id', $login_user_id)->delete();
        $delete = DB::table('user_logins')->where('user_login_id', $login_user_id)->update(['active' => 0]);
        if ($user) {
            Session::put('delete_user_message', 'Selected User Details deleted Successfully');
            return redirect('view_users');
        } else {
            
        }
    }

    public function add_class() {
        return view('classes/add_class');
    }

    public function do_add_class(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'class_name' => 'required|regex:/^[\pL\s]+$/u|unique:classes'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $data1 = array(
                'class_name' => $request->input('class_name'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $id);
            DB::table('classes')->insert($data1);
            $created_user_id = Session::get('user_login_id');
            $newvalue = json_encode($data1, true);
            $data2 = array(
                'log_type' => 'Add class details',
                'message' => 'Added',
                'new_value' => $newvalue,
                'old_value' => "No Old Value for Add Activity",
                'user_name' => $created_user_id);
            DB::table('log_details')->insert($data2);
            Session::put('add_class_message', 'Class Added Successfully');
            return redirect('view_classes');
        }
    }

    public function view_classes() {
        $classes['classes'] = DB::table('classes')
                ->leftJoin('user_logins', 'classes.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(classes.created_at,"%d-%m-%Y %r") as date'), 'classes.class_id', 'classes.class_name', 'classes.created_user_id', 'classes.updated_user_id', 'classes.updated_at', 'user_logins.user_name'])
                ->where('classes.active', 1)
                ->paginate(20);
        return view('classes/view_classes', $classes);
    }

    public function class_details($id) {
        $classes['class_names'] = DB::table('classes')->where('class_id', $id)->get();
        $classes['classes'] = DB::table('students')
                ->leftJoin('user_logins', 'students.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'students.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'students.section_id')
                ->leftJoin('academic_years', 'academic_years.academic_year_id', '=', 'students.academic_year')
                ->select('students.student_id', 'classes.class_name', 'classes.class_id', 'sections.section_name', 'students.created_user_id', 'students.updated_user_id', 'students.created_at', 'students.updated_at', 'user_logins.user_name', 'students.academic_year', 'students.roll_number', 'students.first_name', 'students.last_name', 'students.profile_pic', 'students.contact_number', 'students.emergency_number')
                ->where('students.class_id', $id)
                ->where('students.active', 1)
                ->paginate(20);
        return view('classes/class_details', $classes);
    }

    public function class_search(Request $request) {
        $query = $request->input('search');

        $classes['classes'] = DB::table('classes')
                ->leftJoin('user_logins', 'classes.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(classes.created_at,"%d-%m-%Y %r") as date'), 'classes.class_id', 'classes.class_name', 'classes.created_user_id', 'classes.updated_user_id', 'classes.updated_at', 'user_logins.user_name'])
                ->Where('classes.class_name', $query)
                ->where('classes.active', 1)
//                        ->orWhere('user_logins.user_name', 'LIKE', '%' . $query . '%')
                ->paginate(20);

        return view('classes/view_classes', $classes, ['value' => $query]);
    }

    public function edit_class($id) {
        $classes['classes'] = DB::table('classes')->where('class_id', $id)->get();
        Session::put('class_id', $id);
        return view('classes/edit_class', $classes);
    }

    public function do_edit_class(Request $request) {
        $id = Session::get('class_id');
        $id1 = Session::get('user_login_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'class_name' => 'required|regex:/^[\pL\s]+$/u|unique:classes'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $result = DB::table('classes')->where('class_id', $id)->get();
            $class_name = $result[0]->class_name;
            $old_value = "Class  Name=" . $class_name . ",class id=" . $id;
            $class_name1 = $request->input('class_name');
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            DB::table('classes')
                    ->where('class_id', $id)
                    ->limit(1)
                    ->update(array('class_name' => $class_name1, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            Session::put('edit_class_message', 'selected class updated successfully');
            $new_value = "class_name= $class_name1, updated_user_id = $id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit Class Details',
                'message' => 'Edited',
                'new_value' => $new_value,
                'old_value' => $old_value,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::forget('classid');
            return redirect('view_classes');
        }
    }

    public function delete_class($id) {
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('classes')->where('class_id', $id)->get();
        $class_name = $result[0]->class_name;
        $old_value = "Class  Name=" . $class_name . ",class id=" . $id;
        $data1 = array(
            'log_type' => 'Delete class details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);


        //$user = DB::table('classes')->where('class_id', $id)->delete();
        $user = DB::table('classes')->where('class_id', $id)->update(['active' => 0]);
        if ($user) {
            Session::put('delete_class_message', 'Class ' . $class_name . ' deleted Successfully!');
            return redirect('view_classes');
        } else {
            
        }
    }

    public function assign_class_teacher($id) {
        Session::put('class_id', $id);
        $teacher['classes'] = DB::table('classes')->select('class_id', 'class_name')->where('class_id', $id)->get();
        $teacher['sections'] = DB::select(DB::raw("SELECT cs.section_id,s.section_name FROM `class_section`cs LEFT JOIN sections s ON cs.section_id=s.section_id where cs.class_id=$id and cs.section_id NOT IN(SELECT section_id from class_teacher WHERE class_id=$id)"));
        $teacher['staffs'] = DB::select(DB::raw("SELECT staff_id,first_name,last_name FROM `staff`where staff_id NOT IN(SELECT staff_id from class_teacher)"));
        return view('students/classteacher/assign_class_teacher', $teacher);
    }

    public function get_class_teacher_section(Request $request) {
        $name = $request->input('data1');
        Session::put('class_id', $name);
        $teacher_section = DB::select(DB::raw("SELECT section_id,section_name FROM `sections`where section_id NOT IN(SELECT section_id from class_teacher WHERE class_id=$name)"));
        return ($teacher_section);
    }

    public function get_class_teachers(Request $request) {
        $name = $request->input('data1');
        $classid = Session::get('class_id');
        $class_teacher = DB::select(DB::raw("SELECT staff_id,first_name,last_name FROM `staff`where staff_id NOT IN(SELECT staff_id from class_teacher) and active=1 and staff_type_id=1"));
        return($class_teacher);
    }

    public function do_assign_class_teacher(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $class_id = Session::get('class_id');
        $data1 = array(
            'class_id' => $class_id,
            'section_id' => $request->input('section'),
            'staff_id' => $request->input('teacher'),
            'academic_year_id' => $academic_year_id,
            'created_user_id' => $id);

        DB::table('class_teacher')->insert($data1);
        $new_value = json_encode($data1, true);
        $data2 = array(
            'log_type' => 'Add Class-Teacher',
            'message' => 'Added',
            'new_value' => $new_value,
            'old_value' => "No Old Value for Add Activity",
            'user_name' => $id);
        DB::table('log_details')->insert($data2);
        Session::put('add_class_teacher_message', 'Class Teacher Added Successfully');
        return redirect('view_class_teachers');
    }

    public function view_class_teachers() {
//$teachers['teachers'] = DB::select(DB::raw("SELECT ct.class_teacher_id,ct.created_at,ul.user_name,c.class_name,
//s.section_name,st.first_name from class_teacher ct LEFT JOIN classes c ON c.class_id=ct.class_id LEFT JOIN 
//sections s ON s.section_id=ct.section_id LEFT JOIN staff st ON st.staff_id=ct.staff_id LEFT JOIN user_logins ul
// ON ul.user_login_id=ct.created_user_id"));
        $teachers['teachers'] = DB::table('class_teacher')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_teacher.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_teacher.section_id')
                ->leftJoin('staff', 'staff.staff_id', '=', 'class_teacher.staff_id')
                ->leftJoin('user_logins', 'user_logins.user_login_id', '=', 'class_teacher.created_user_id')
                ->select([DB::RAW('DATE_FORMAT(class_teacher.created_at,"%d-%m-%Y %r") as date'), 'staff.profile_pic', 'staff.last_name', 'class_teacher.class_teacher_id', 'classes.class_id', 'sections.section_id', 'staff.staff_id', 'user_logins.user_name', 'class_teacher.created_at', 'class_teacher.updated_at', 'classes.class_name', 'sections.section_name', 'staff.first_name'])
                ->where('class_teacher.active', 1)
                ->orderby('staff.first_name', 'ASC')
                ->paginate(20);

        return view('students/classteacher/view_class_teachers', $teachers);
    }

    public function class_teacher_search(Request $request) {
        $query = $request->input('search');
        $teachers['teachers'] = DB::table('class_teacher')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_teacher.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_teacher.section_id')
                ->leftJoin('staff', 'staff.staff_id', '=', 'class_teacher.staff_id')
                ->leftJoin('user_logins', 'user_logins.user_login_id', '=', 'class_teacher.created_user_id')
                ->select([DB::RAW('DATE_FORMAT(class_teacher.created_at,"%d-%m-%Y %r") as date'), 'staff.last_name', 'class_teacher.class_teacher_id', 'classes.class_id', 'sections.section_id', 'staff.staff_id', 'user_logins.user_name', 'class_teacher.created_at', 'class_teacher.updated_at', 'classes.class_name', 'sections.section_name', 'staff.first_name'])
                ->where('class_teacher.active', 1)
                ->where('staff.first_name', 'LIKE', '%' . $query . '%')
                ->orwhere('staff.last_name', 'LIKE', '%' . $query . '%')
                ->orderby('staff.first_name', 'DESC')
                ->paginate(15);

        return view('students/classteacher/view_class_teachers', $teachers, ['value' => $query]);
    }

    public function edit_class_teacher($id) {
        Session::put('class_teacher_id', $id);
        $teacher['classes'] = DB::select(DB::raw("SELECT ct.class_teacher_id,ul.user_name,c.class_name,s.section_name,st.first_name,st.staff_id from class_teacher ct LEFT JOIN classes c ON c.class_id=ct.class_id LEFT JOIN sections s ON s.section_id=ct.section_id LEFT JOIN staff st ON st.staff_id=ct.staff_id LEFT JOIN user_logins ul ON ul.user_login_id=ct.created_user_id WHERE class_teacher_id=$id"));
        $teacher['staffs'] = DB::select(DB::raw("select staff_id,first_name,last_name from staff where staff_type_id=1 "));
        return view('students/classteacher/edit_class_teacher', $teacher);
    }

    public function do_edit_class_teacher(Request $request) {
        $id = Session::get('class_teacher_id');
        $id1 = Session::get('user_login_id');
        $result = DB::table('class_teacher')->where('class_teacher_id', $id)->get();
        $class_id = $result[0]->class_id;
        $section_id = $result[0]->section_id;
        $staff_id = $result[0]->staff_id;
        $staff = DB::table('staff')->where('staff_id', $staff_id)->get();
        $staff_firstname = $staff[0]->first_name;
        $staff_lastname = $staff[0]->last_name;
        $old_value = "class id=" . $class_id . ",section id=" . $section_id . ",staff id=" . $staff_id . ",class_teacher id=" . $id;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $class_teacher_id = $request->input('teacher');
        $check = DB::select(DB::raw("select * from class_teacher where staff_id=$class_teacher_id"));
        if (count($check) >= 1) {
            Session::put('error_message', $staff_firstname . $staff_lastname . ' assigned to other class please select another teacher.');
            return redirect('view_class_teachers');
        } else {
            DB::table('class_teacher')
                    ->where('class_teacher_id', $id)
                    ->limit(1)
                    ->update(array('staff_id' => $class_teacher_id, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            Session::put('edit_class_teacher_message', 'selected class-teacher Updated Successfully');
            $new_value = "staff_id = $class_teacher_id, updated user id = $id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit class teacher',
                'message' => 'Edited',
                'new_value' => $new_value,
                'old_value' => $old_value,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::forget('class_teacher_id');
            Session::put('edit_class_teacher', 'Class Teacher Updated Successfully');
            return redirect('view_class_teachers');
        }
    }

    public function delete_class_teacher($id) {

        $created_user_id = Session::get('user_login_id');
        $result = DB::table('class_teacher')->where('class_teacher_id', $id)->get();
        $class_id = $result[0]->class_id;
        $section_id = $result[0]->section_id;
        $staff_id = $result[0]->staff_id;
        $old_value = "class_id=" . $class_id . ",section_id=" . $section_id . ",staff_id=" . $staff_id . ",class_teacher id=" . $id;
        $data1 = array(
            'log_type' => 'Delete details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        // $user = DB::table('class_teacher')->where('class_teacher_id', $id)->delete();
        $user = DB::table('class_teacher')->where('class_teacher_id', $id)->upadet(['active' => 0]);
        if ($user) {
            Session::put('delete_class_teacher', 'Selected class-teacher deleted Successfully');
            return redirect('view_class_teachers');
        } else {
            
        }
    }

    public function add_subject() {
        return view('subjects/add_subject');
    }

    public function do_add_subject(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'subject_name' => 'required|regex:/^[\pL\s]+$/u|unique:subjects'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $data1 = array(
                'subject_name' => $request->input('subject_name'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $id);
            DB::table('subjects')->insert($data1);
            $created_user_id = Session::get('user_login_id');
            $newvalue = json_encode($data1, true);
            $data2 = array(
                'log_type' => 'Add subject details',
                'message' => 'Added',
                'new_value' => $newvalue,
                'old_value' => "No Old Value for Add Activity",
                'user_name' => $created_user_id);
            DB::table('log_details')->insert($data2);
            Session::put('add_subject_message', 'Subject Added Successfully');
            return redirect('view_subjects');
        }
    }

    public function view_subjects() {
        $subjects['subjects'] = DB::table('subjects')
                ->join('user_logins', 'subjects.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(subjects.created_at,"%d-%m-%Y %r") as date'), 'subjects.subject_id', 'subjects.subject_name', 'subjects.created_user_id', 'user_logins.user_name', 'subjects.updated_user_id', 'subjects.updated_at', 'subjects.created_at'])
                ->where('subjects.active', 1)
                ->paginate(20);
        return view('subjects/view_subjects', $subjects);
    }

    public function subject_search(Request $request) {
        $query = $request->input('search');

        $subjects['subjects'] = DB::table('subjects')
                ->join('user_logins', 'subjects.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(subjects.created_at,"%d-%m-%Y %r") as date'), 'subjects.subject_id', 'subjects.subject_name', 'subjects.created_user_id', 'user_logins.user_name', 'subjects.updated_user_id', 'subjects.updated_at', 'subjects.created_at'])
                ->where('subjects.active', 1)
                ->Where('subjects.subject_name', 'LIKE', '%' . $query . '%')
                ->paginate(15);
        return view('subjects/view_subjects', $subjects, ['value' => $query]);
    }

    public function edit_subject($id) {
        $subjects['subjects'] = DB::table('subjects')->where('subject_id', $id)->get();
        Session::put('subjectid', $id);
        return view('subjects/edit_subject', $subjects);
    }

    public function do_edit_subject(Request $request) {
        $id = Session::get('subjectid');
        $id1 = Session::get('user_login_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'subject_name' => 'required|regex:/^[\pL\s]+$/u|unique:subjects'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $result = DB::table('subjects')->where('subject_id', $id)->get();
            $subject_name1 = $result[0]->subject_name;
            $old_value = "subject  Name=" . $subject_name1 . ",subject id=" . $id;
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            $subject_name = $request->input('subject_name');
            DB::table('subjects')
                    ->where('subject_id', $id)
                    ->limit(1)
                    ->update(array('subject_name' => $subject_name, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            Session::put('edit_subject_message', $subject_name1 . 'Updated Successfully!');
            $new_value = "subject name= $subject_name, updated user id = $id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit subject Details',
                'message' => 'Edited',
                'new_value' => $new_value,
                'old_value' => $old_value,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::forget('subjectid');
            return redirect('view_subjects');
        }
    }

    public function delete_subject($id) {

        $created_user_id = Session::get('user_login_id');
        $result = DB::table('subjects')->where('subject_id', $id)->get();
        $subject_name1 = $result[0]->subject_name;
        $old_value = "subject  Name=" . $subject_name1 . ",subject id=" . $id;
        $data1 = array(
            'log_type' => 'Delete details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        // $user = DB::table('subjects')->where('subject_id', $id)->delete();
        $user = DB::table('subjects')->where('subject_id', $id)->update(['active' => 0]);
        if ($user) {
            Session::put('delete_subject_message', $subject_name1 . 'Subject deleted Successfully');
            return redirect('view_subjects');
        } else {
            
        }
    }

    public function user_profile() {
        $id = Session::get('userid');
        $users['institution_details'] = DB::table('institute_details')->where('institute_id', 1)->get();
        $users['users'] = DB::table('users')->where('user_id', $id)->get();

        return view('users/user_profile', $users);
    }

    public function password_change() {
        return view('users/passwordchange');
    }

    public function do_password_change(Request $request) {
        $id = Session::get('userid');

        $old_password = $request->input('old_password');
        $new_password = $request->input('password');
        $results = DB::select(DB::raw("SELECT * FROM user_logins WHERE user_login_id = $id && password = '$old_password'"));
        if (count($results) == 1) {
            $data = Input::except(array('_token'));
            $rule = array(
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            } else {
                DB::table('user_logins')
                        ->where('user_login_id', $id)
                        ->limit(1)
                        ->update(array('password' => $new_password));

                return redirect('view_user_types');
            }
        } else {
            Session::put('change_password', 'your entered old password mismatch.');
            return view('users/passwordchange');
        }
    }

    public function logout(Request $request) {
        if (Session::has('username')) {
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            $user_name = Session::get('username');

            function getBrowser() {
                $u_agent = $_SERVER['HTTP_USER_AGENT'];
                $bname = 'Unknown';
                $platform = 'Unknown';
                $version = "";
                if (preg_match('/linux/i', $u_agent)) {
                    $platform = 'linux';
                } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                    $platform = 'mac';
                } elseif (preg_match('/windows|win32/i', $u_agent)) {
                    $platform = 'windows';
                }
                if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
                    $bname = 'Internet Explorer';
                    $ub = "MSIE";
                } elseif (preg_match('/Firefox/i', $u_agent)) {
                    $bname = 'Mozilla Firefox';
                    $ub = "Firefox";
                } elseif (preg_match('/Chrome/i', $u_agent)) {
                    $bname = 'Google Chrome';
                    $ub = "Chrome";
                } elseif (preg_match('/Safari/i', $u_agent)) {
                    $bname = 'Apple Safari';
                    $ub = "Safari";
                } elseif (preg_match('/Opera/i', $u_agent)) {
                    $bname = 'Opera';
                    $ub = "Opera";
                } elseif (preg_match('/Netscape/i', $u_agent)) {
                    $bname = 'Netscape';
                    $ub = "Netscape";
                }
                $known = array('Version', $ub, 'other');
                $pattern = '#(?<browser>' . join('|', $known) .
                        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                if (!preg_match_all($pattern, $u_agent, $matches)) {
                    
                }
                $i = count($matches['browser']);
                if ($i != 1) {
                    if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                        $version = $matches['version'][0];
                    } else {
                        $version = $matches['version'][1];
                    }
                } else {
                    $version = $matches['version'][0];
                }

                if ($version == null || $version == "") {
                    $version = "?";
                }

                return array(
                    'userAgent' => $u_agent,
                    'name' => $bname,
                    'version' => $version,
                    'platform' => $platform,
                    'pattern' => $pattern
                );
            }

            $ua = getBrowser();
            $yourbrowser = $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'];
            $data = array(
                'log_out' => $current_time,
                'log_type' => 'Logout',
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'user_browser' => $yourbrowser,
                'created_at' => $current_time,
                'user_name' => $user_name);
            DB::table('logs')->insert($data);
            $request->session()->flush();
            return redirect('login');
        } else {
            $request->session()->flush();
            return redirect('login');
        }
    }

    public function add_section() {
        return view('sections/add_section');
    }

    public function do_add_section(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'section_name' => 'required|regex:/^[\pL\s]+$/u|unique:sections'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $data1 = array(
                'section_name' => $request->input('section_name'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $id);
            DB::table('sections')->insert($data1);
            $created_user_id = Session::get('user_login_id');
            $newvalue = json_encode($data1, true);
            $data2 = array(
                'log_type' => 'Add section details',
                'message' => 'Added',
                'new_value' => $newvalue,
                'old_value' => "No Old Value for Add Activity",
                'user_name' => $created_user_id);
            DB::table('log_details')->insert($data2);
            Session::put('add_section_message', 'Section Added Successfully');
            return redirect('view_section');
        }
    }

    public function view_section() {
        $sections['sections'] = DB::table('sections')
                ->join('user_logins', 'sections.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(sections.created_at,"%d-%m-%Y %r") as date'), 'sections.section_id', 'sections.section_name', 'user_logins.user_name', 'sections.updated_user_id', 'sections.updated_at', 'sections.created_at'])
                ->where('sections.active', 1)
                ->paginate(20);
        return view('sections/view_section', $sections);
    }

    public function section_search(Request $request) {
        $query = $request->input('search');
        $sections['sections'] = DB::table('sections')
                ->join('user_logins', 'sections.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(sections.created_at,"%d-%m-%Y %r") as date'), 'sections.section_id', 'sections.section_name', 'user_logins.user_name', 'sections.updated_user_id', 'sections.updated_at', 'sections.created_at'])
                ->where('sections.active', 1)->where('sections.section_name', $query)
                ->paginate(15);
        return view('sections/view_section', $sections, ['value' => $query]);
    }

    public function edit_section($id) {
        $sections['sections'] = DB::table('sections')->where('section_id', $id)->get();
        Session::put('section_id', $id);
        return view('sections/edit_section', $sections);
    }

    public function do_section_edit(Request $request) {
        $id = Session::get('section_id');
        $id1 = Session::get('user_login_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'section_name' => 'required|regex:/^[\pL\s]+$/u|unique:sections'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $result = DB::table('sections')->where('section_id', $id)->get();
            $section_name1 = $result[0]->section_name;
            $oldvalue = "section  Name=" . $section_name1 . ",section id=" . $id;
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            $section_name = $request->input('section_name');
            DB::table('sections')
                    ->where('section_id', $id)
                    ->limit(1)
                    ->update(array('section_name' => $section_name, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            Session::put('edit_section_message', 'selected Section Updated Successfully');
            $newvalue = "section name= $section_name, updated user id = $id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit section Details',
                'message' => 'Edited',
                'new_value' => $newvalue,
                'old_value' => $oldvalue,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::forget('section_id');

            return redirect('view_section');
        }
    }

    public function delete_section($id) {
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('sections')->where('section_id', $id)->get();
        $section_name1 = $result[0]->section_name;
        $oldvalue = "section  Name=" . $section_name1 . ",section id=" . $id;
        $data1 = array(
            'log_type' => 'Delete section details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        //$user = DB::table('sections')->where('section_id', $id)->delete();
        $user = DB::table('sections')->where('section_id', $id)->update(['active' => 0]);
        if ($user) {
            Session::put('delete_section_message', 'section ' . $section_name1 . ' deleted successfully!');
            return redirect('view_section');
        } else {
            
        }
    }

    public function add_section_class() {
        $users['users'] = DB::table('classes')->select('class_id', 'class_name')->get();
        return view('sectionclass/add_section_class', $users);
    }

    public function ajaxcall(Request $request) {
        $name = $request->input('data1');
        $sections = DB::select(DB::raw("SELECT section_id,section_name FROM `sections`where section_id NOT IN(SELECT section_id from class_section WHERE class_id=$name)"));
        return ($sections);
    }

    public function do_add_section_class(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');

        $data1 = array(
            'class_id' => $request->input('class'),
            'section_id' => $request->input('section'),
            'academic_year_id' => $academic_year_id,
            'created_user_id' => $id);
        DB::table('class_section')->insert($data1);

        $created_user_id = Session::get('user_login_id');
        $newvalue = json_encode($data1, true);
        $data2 = array(
            'log_type' => 'Add class-section details',
            'message' => 'Added',
            'new_value' => $newvalue,
            'old_value' => "No Old Value for Add Activity",
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data2);
        Session::put('add_class_section_message', 'Class Section Added Successfully');
        return redirect('view_class_section');
    }

    public function view_class_section() {
        /*    $users['users'] = DB::select(DB::raw("select cs.class_section_id,cs.created_at,cs.updated_at,
          c.class_name,
          s.section_name,
          ul.user_name
          from class_section cs left join classes c on cs.class_id = c.class_id  left join sections s on cs.section_id = s.section_id left join user_logins ul on cs.created_user_id = ul.user_login_id")); */
        $sections['sections'] = DB::table('class_section')
                ->leftJoin('user_logins', 'class_section.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_section.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_section.section_id')
                ->select([DB::RAW('DATE_FORMAT(class_section.created_at,"%d-%m-%Y %r") as date'), 'class_section.class_section_id', 'classes.class_id', 'sections.section_id', 'classes.class_name', 'sections.section_name', 'class_section.created_user_id', 'class_section.updated_user_id', 'class_section.created_at', 'class_section.updated_at', 'user_logins.user_name'])
                ->where('class_section.active', 1)
                ->paginate(20);
        return view('sectionclass/view_class_section', $sections);
    }

    public function class_section_search(Request $request) {
        $query = $request->input('search');
        $sections['sections'] = DB::table('class_section')
                ->leftJoin('user_logins', 'class_section.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_section.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_section.section_id')
                ->select([DB::RAW('DATE_FORMAT(class_section.created_at,"%d-%m-%Y %r") as date'), 'class_section.class_section_id', 'classes.class_id', 'sections.section_id', 'classes.class_name', 'sections.section_name', 'class_section.created_user_id', 'class_section.updated_user_id', 'class_section.created_at', 'class_section.updated_at', 'user_logins.user_name'])
                ->where('class_section.active', 1)
                ->Where('classes.class_name', 'LIKE', '%' . $query . '%')
                ->orWhere('sections.section_name', 'LIKE', '%' . $query . '%')
                ->paginate(15);
        return view('sectionclass/view_class_section', $sections, ['value' => $query]);
    }

    public function section_details($class_id, $section_id) {
        $classes['class_names'] = DB::select(DB::raw("select c.class_id,c.class_name,s.section_id,s.section_name from classes c CROSS JOIN sections s WHERE c.class_id=$class_id and s.section_id=$section_id"));

        $classes['classes'] = DB::table('students')
                ->leftJoin('user_logins', 'students.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'students.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'students.section_id')
                ->select('students.student_id', 'classes.class_name', 'students.class_id', 'sections.section_name', 'sections.section_id', 'students.created_user_id', 'students.updated_user_id', 'students.created_at', 'students.updated_at', 'user_logins.user_name', 'students.academic_year', 'students.roll_number', 'students.first_name', 'students.last_name', 'students.profile_pic', 'students.contact_number', 'students.emergency_number')
                ->where('students.class_id', $class_id)
                ->where('students.section_id', $section_id)
                ->where('students.active', 1)
                ->paginate(20);

        /* $classes['classes'] = DB::select(DB::raw("SELECT st.student_id,c.class_name,st.class_id, s.section_name,s.section_id, st.created_user_id, st.updated_user_id, st.created_at, st.updated_at, ul.user_name, st.academic_year, st.roll_number, st.first_name, st.last_name, st.profile_pic, st.contact_number, st.emergency_number FROM students st
          LEFT JOIN classes c ON c.class_id=st.class_id
          LEFT JOIN user_logins ul ON ul.user_login_id=st.created_user_id
          LEFT JOIN sections s ON s.section_id=st.section_id WHERE (st.section_id=$section_id AND st.class_id=$class_id)")); */

        return view('classes/section_details', $classes);
    }

    public function edit_class_section($id) {
        $sections['sections'] = DB::select(DB::raw("select 
  c.class_name,
  s.section_name,
  cs.class_id,
  cs.section_id,
  cs.created_user_id
  from class_section cs  left join classes c on cs.class_id = c.class_id  left join sections s on cs.section_id = s.section_id left join user_logins ul on cs.created_user_id = ul.user_login_id  WHERE cs.class_section_id=$id"));
        $sections['classes'] = DB::table('sections')->select('section_name')->get();
        Session::put('class_section_id', $id);
        return view('sectionclass/edit_class_section', $sections);
    }

    public function do_edit_class_section(Request $request) {
        $id = Session::get('class_section_id');
        $id1 = Session::get('user_login_id');
        $class = $request->input('class');
        $section = $request->input('section');
        $count = DB::select(DB::raw("SELECT * FROM `class_section` WHERE class_id=$class and section_id=$section"));
        if (count($count) == '') {
            $result = DB::table('class_section')->where('class_section_id', $id)->get();
            $class_id = $result[0]->class_id;
            $section_id = $result[0]->section_id;
            $clsss = DB::table('classes')->where('class_id', $class_id)->get();
            $class1 = $clsss[0]->class_name;
            $section = DB::table('sections')->where('section_id', $section_id)->get();
            $section1 = $section[0]->section_name;
            $old_value = "Class Id=" . $class_id . ",Section id=" . $section_id . ",Class Section id=" . $id;
            $current_time = \Carbon\Carbon::now()->toDateTimeString();

            DB::table('class_section')
                    ->where('class_section_id', $id)
                    ->limit(1)
                    ->update(array('class_id' => $class, 'section_id' => $section, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            $new_value = "class id= $class,section id= $section, updated user id = $id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit Class-section Details ',
                'message' => 'Edited',
                'new_value' => $new_value,
                'old_value' => $old_value,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::forget('subjectid');
            Session::put('edit_class_section_message', $class1 . $section1 . ' Updated Successfully!');
            return redirect('view_class_section');
        } else {
            Session::put('session_exist_error', $class1 . $section1 . ' already (matched in database) EXIST');
            return redirect("edit_class_section/$id");
        }
    }

    public function delete_class_action($id) {
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('class_section')->where('class_section_id', $id)->get();
        $class_id = $result[0]->class_id;
        $section_id = $result[0]->section_id;

        $clsss = DB::table('classes')->where('class_id', $class_id)->get();
        $class1 = $clsss[0]->class_name;
        $section = DB::table('sections')->where('section_id', $section_id)->get();
        $section1 = $section[0]->section_name;

        $old_value = "Class Id=" . $class_id . ",Section id=" . $section_id . ",Class Section id=" . $id;
        $data1 = array(
            'log_type' => 'Delete Class-Section details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        //$section = DB::table('class_section')->where('class_section_id', $id)->delete();
        $section = DB::table('class_section')->where('class_section_id', $id)->update(['active' => 0]);
        if ($section) {
            Session::put('delete_class_section_message', $class1 . $section1 . ' deleted Successfully!');
            return redirect('view_class_section');
        } else {
            
        }
    }

    public function add_class_subject() {
        $subjects['subjects'] = DB::table('classes')->select('class_id', 'class_name')->get();
        $subjects['days'] = DB::table('days')->get();
        return view('classsubject/add_class_subject', $subjects);
    }

    public function getsection(Request $request) {
        $name = $request->input('data1');
        Session::put('classid', $name);
        $sections = DB::select(DB::raw("SELECT * FROM `sections` where section_id IN(SELECT section_id FROM class_section WHERE class_id=$name)"));
        return ($sections);
    }

    public function getsubject_without_section(Request $request) {
        $class_id = $request->input('data1');
        $day_id = $request->input('day_id');
        $subjects = DB::select(DB::raw("SELECT subject_id,subject_name FROM `subjects`where subject_id NOT IN(SELECT subject_id from class_subject WHERE class_id=$class_id AND day_id=$day_id)"));
        return($subjects);
    }

    public function getsubject(Request $request) {
        $name = $request->input('data2');
        $day_id = $request->input('day_id');
        $classid = Session::get('classid');
        $subjects = DB::select(DB::raw("SELECT subject_id,subject_name FROM `subjects`where subject_id NOT IN(SELECT subject_id from class_subject WHERE class_id=$classid and section_id=$name AND day_id=$day_id)"));
        return($subjects);
    }

    public function do_add_class_subject(Request $request) {
        $data = Input::except(array('_token'));
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $start_time = $request->input('starttime');
        $rule = array(
            'class' => 'required',
            'subject' => 'required',
            'starttime' => 'required',
            'day' => 'required',
            'endtime' => 'required|after:' . $start_time
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            if ($request->input('section') == "") {
                $data1 = array(
                    'class_id' => $request->input('class'),
                    'subject_id' => $request->input('subject'),
                    'day_id' => $request->input('day'),
                    'start_time' => $request->input('starttime'),
                    'end_time' => $request->input('endtime'),
                    'academic_year_id' => $academic_year_id,
                    'created_user_id' => $id);

                DB::table('class_subject')->insert($data1);
            } else {
                $data1 = array(
                    'class_id' => $request->input('class'),
                    'section_id' => $request->input('section'),
                    'subject_id' => $request->input('subject'),
                    'day_id' => $request->input('day'),
                    'start_time' => $request->input('starttime'),
                    'end_time' => $request->input('endtime'),
                    'academic_year_id' => $academic_year_id,
                    'created_user_id' => $id);

                DB::table('class_subject')->insert($data1);
            }
            $new_value = json_encode($data1, true);
            $created_user_id = Session::get('user_login_id');

            $data2 = array(
                'log_type' => 'Add Class-Subject details',
                'message' => 'Added',
                'new_value' => $new_value,
                'old_value' => "No Old Value for Add Activity",
                'user_name' => $created_user_id);
            DB::table('log_details')->insert($data2);
            Session::put('add_class_subject_message', 'Subject Added to Respected class Successfully');
            return redirect('view_class_subject');
        }
    }

    public function view_class_subject() {
// $users['users'] = DB::select(DB::raw("select cs.class_subject_id,cs.created_at,cs.updated_at,
//c.class_name, s.section_name,ul.user_name,su.subject_name from class_subject cs left join classes c on cs.class_id = c.class_id  left join sections s on cs.section_id = s.section_id left join user_logins ul on cs.created_user_id = ul.user_login_id left join subjects su on cs.subject_id = su.subject_id"));
        $subjects['subjects'] = DB::table('class_subject')
                ->leftJoin('user_logins', 'class_subject.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_subject.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_subject.section_id')
                ->leftJoin('subjects', 'subjects.subject_id', '=', 'class_subject.subject_id')
                ->leftJoin('days', 'days.day_id', '=', 'class_subject.day_id')
                ->select([DB::RAW('DATE_FORMAT(class_subject.created_at,"%d-%m-%Y %r") as date'), 'class_subject.class_subject_id', 'days.day_title', 'class_subject.start_time', 'class_subject.end_time', 'subjects.subject_id', 'subjects.subject_name', 'classes.class_id', 'sections.section_id', 'classes.class_name', 'sections.section_name', 'class_subject.created_user_id', 'class_subject.updated_user_id', 'class_subject.created_at', 'class_subject.updated_at', 'user_logins.user_name'])
                ->where('class_subject.active', 1)
                ->orderby('class_subject.created_at', 'DESC')
                ->paginate(20);
        return view('classsubject/view_class_subject', $subjects);
    }

    public function class_subject_search(Request $request) {
        $query = $request->input('search');
        $subjects['subjects'] = DB::table('class_subject')
                ->leftJoin('user_logins', 'class_subject.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_subject.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_subject.section_id')
                ->leftJoin('subjects', 'subjects.subject_id', '=', 'class_subject.subject_id')
                ->leftJoin('days', 'days.day_id', '=', 'class_subject.day_id')
                ->select([DB::RAW('DATE_FORMAT(class_subject.created_at,"%d-%m-%Y %r") as date'), 'class_subject.class_subject_id', 'days.day_title', 'class_subject.start_time', 'class_subject.end_time', 'subjects.subject_id', 'subjects.subject_name', 'classes.class_id', 'sections.section_id', 'classes.class_name', 'sections.section_name', 'class_subject.created_user_id', 'class_subject.updated_user_id', 'class_subject.created_at', 'class_subject.updated_at', 'user_logins.user_name'])
                ->where('class_subject.active', 1)
                ->Where('subjects.subject_name', 'LIKE', '%' . $query . '%')
                ->orWhere('days.day_title', 'LIKE', '%' . $query . '%')
                ->orderby('class_subject.created_at', 'DESC')
                ->paginate(20);
        return view('classsubject/view_class_subject', $subjects, ['value' => $query]);
    }

    public function edit_class_subject($id) {
        Session::put('class_subject_id', $id);
        $subjects['subjects'] = DB::select(DB::raw("select c.class_name,s.section_name,sb.subject_name,d.day_title,cs.start_time,cs.end_time from class_subject cs  left join classes c on cs.class_id = c.class_id  left join sections s on cs.section_id = s.section_id left join subjects sb on cs.subject_id = sb.subject_id left join days d on d.day_id=cs.day_id   WHERE cs.class_subject_id=$id"));
        return view('classsubject/edit_class_subject', $subjects);
    }

    public function do_edit_class_subject(Request $request) {
        $class_subject_id = Session::get('class_subject_id');
        $result = DB::table('class_subject')->where('class_subject_id', $class_subject_id)->get();
        $start_time = $result[0]->start_time;
        $end_time = $result[0]->end_time;
        $old_value = "start time=" . $start_time . ",end time=" . $end_time . ",class section id=" . $class_subject_id;
        $updated_user_id = Session::get('user_login_id');
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $start_time1 = $request->input('starttime');
        $data = Input::except(array('_token'));
        $rule = array(
            'starttime' => 'required',
            'endtime' => 'required|after:' . $start_time1
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $end_time1 = $request->input('endtime');
            $start_time1 = $request->input('starttime');

            DB::table('class_subject')
                    ->where('class_subject_id', $class_subject_id)
                    ->limit(1)
                    ->update(array('start_time' => $start_time1, 'end_time' => $end_time1, 'updated_user_id' => $updated_user_id, 'updated_at' => $current_time));
            Session::set('edit_class_subject_message', 'Updated Class-Subject Successfully');
            $new_value = "Start time=$start_time1,end time=$end_time1,updated_user_id=$updated_user_id,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit class-subject',
                'message' => 'Edited',
                'new_value' => $new_value,
                'old_value' => $old_value,
                'user_name' => $updated_user_id);
            DB::table('log_details')->insert($data1);
            Session::forget('class_subject_id');
            Session::put('edit_class_subject', 'Class-Subject Updated Successfully');
            return redirect('view_class_subject');
        }
    }

    public function delete_class_subject($id) {
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('class_subject')->where('class_subject_id', $id)->get();
        $start_time = $result[0]->start_time;
        $end_time = $result[0]->end_time;
        $old_value = "start time=" . $start_time . ",end time=" . $end_time . ",class section id=" . $id;
        $data1 = array(
            'log_type' => 'Delete class-subject details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        //$subjects = DB::table('class_subject')->where('class_subject_id', $id)->delete();
        $subjects = DB::table('class_subject')->where('class_subject_id', $id)->update(['active' => 0]);
        if ($subjects) {
            Session::put('delete_class_subject_message', 'Selected Class-Subject deleted Successfully');
            return redirect('view_class_subject');
        } else {
            
        }
    }

    public function add_fee_types() {
        return view('feetypes/add_fee_types');
    }

    public function do_add_fee_types(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'fee_name' => 'required|unique:fee_types',
            'fee_status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            $data1 = array(
                'fee_name' => $request->input('fee_name'),
                'fee_status' => $request->input('fee_status'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $id);
            DB::table('fee_types')->insert($data1);
            $newvalue = json_encode($data1, true);
            $data2 = array(
                'log_type' => 'Add Fee Types',
                'message' => 'Added',
                'new_value' => $newvalue,
                'old_value' => "Their is No old Value value for Add",
                'user_name' => $id);
            DB::table('log_details')->insert($data2);
            Session::put('add_fee_types', 'fee-type Added successfully');
            return redirect('view_fee_types');
        }
    }

    public function view_fee_types() {
        $feetypes['feetypes'] = DB::table('fee_types')
                ->join('user_logins', 'fee_types.created_user_id', '=', 'user_logins.user_login_id')
                ->select('fee_types.fee_type_id', 'user_logins.user_name', 'fee_types.fee_name', 'fee_types.fee_status', 'fee_types.created_at')
                ->where('fee_types.active', 1)
                ->paginate(20);
        return view('feetypes/view_fee_types', $feetypes);
    }

    public function edit_fee_types($id) {
        $feetypes['feetypes'] = DB::table('fee_types')->where('fee_type_id', $id)->get();
        Session::put('fee_type_id', $id);
        return view('feetypes/edit_fee_types', $feetypes);
    }

    public function do_edit_fee_types(Request $request) {
        $id = Session::get('fee_type_id');
        $data = Input::except(array('_token'));
        $rule = array(
            'fee_name' => 'required',
            'fee_status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $result = DB::table('fee_types')->where('fee_type_id', $id)->get();
            $feename = $result[0]->fee_name;
            $status = $result[0]->fee_status;
            $oldvalue = "fee name=" . $feename . ",fee stauts=" . $status . ",fee_type_id=" . $id;

            $updateduserid = Session::get('user_login_id');
            $fee_name = $request->input('fee_name');
            $fee_status = $request->input('fee_status');
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            DB::table('fee_types')
                    ->where('fee_type_id', $id)
                    ->limit(1)
                    ->update(array('fee_name' => $fee_name, 'fee_status' => $fee_status, 'updated_user_id' => $updateduserid, 'updated_at' => $current_time));
            Session::set('edit_fee_types_message', 'Fee Type Details updated  successfully');
            $newvalue = "fee_name=$fee_name,fee_status=$fee_status,updated_user_id=$updateduserid,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit Fee Types ',
                'message' => 'Edited',
                'new_value' => $newvalue,
                'old_value' => $oldvalue,
                'user_name' => $updateduserid);
            DB::table('log_details')->insert($data1);
            Session::forget('fee_type_id');
            Session::put('edit_fee_type', 'Fee-Type details Updated successfully');
            return redirect('view_fee_types');
        }
    }

    public function delete_fee_types($id) {
        $created_user_id = Session::get('user_login_id');
        $result = DB::table('fee_types')->where('fee_type_id', $id)->get();
        $feename = $result[0]->fee_name;
        $status = $result[0]->fee_status;
        $oldvalue = "fee name=" . $feename . ",fee stauts=" . $status . ",fee_type_id=" . $id;
        $data1 = array(
            'log_type' => 'Delete Fee Type details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $created_user_id);
        DB::table('log_details')->insert($data1);
        //$feetype = DB::table('fee_types')->where('fee_type_id', $id)->delete();
        $feetype = DB::table('fee_types')->where('fee_type_id', $id)->upd0ate(['active' => 0]);
        if ($feetype) {
            Session::put('delete_fee_types', 'Selected Fee Types deleted Successfully');
            return redirect('view_fee_types');
        } else {
            
        }
    }

    public function add_institution_details() {
        $institutions['states'] = DB::table('state')->get();

        $institutions['years'] = DB::table('academic_years')->get();
        return view('institutions/add_institution_details', $institutions);
    }

    public function getcity(Request $request) {
        $name = $request->input('data1');
        Session::put('classid', $name);
        $cities = DB::select(DB::raw("SELECT * FROM `city` where state_id=$name"));

        return ($cities);
    }

    public function do_add_institution_details(Request $request) {
        $data = Input::except(array('_token'));
        $createduserid = Session::get('user_login_id');
        $rule = array(
            'institution_name' => 'required',
            'institution_email' => 'required|email|max:255',
            'registration_number' => 'required',
            'office_contact_number1' => 'required|numeric',
            'office_contact_number2' => 'numeric',
            'academic_year' => 'required',
            'institution_logo' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cp1_phone1' => 'required|numeric',
            'cp2_name' => 'required|alpha',
            'cp2_email' => 'required|email',
            'cp2_phone1' => 'required|numeric',
            'cp2_phone2' => 'numeric');
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->hasFile('institution_logo')) {
                $file = Input::file('institution_logo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_logo = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/', $institution_logo);
            }
            if ($request->hasFile('institution_image')) {
                $file = Input::file('institution_image');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_image = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/', $institution_image);
            }
            $data2 = array(
                'institution_name' => $request->input('institution_name'),
                'institution_email' => $request->input('institution_email'),
                'registration_number' => $request->input('registration_number'),
                'office_contact_number1' => $request->input('office_contact_number1'),
                'office_contact_number2' => $request->input('office_contact_number2'),
                'academic_year_id' => $request->input('academic_year'),
                'institution_logo' => $institution_logo,
                'institution_image' => $institution_image,
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $request->input('address'),
                'cp1_name' => $request->input('cp1_name'),
                'cp1_email' => $request->input('cp1_email'),
                'cp1_phone1' => $request->input('cp1_phone1'),
                'cp1_phone2' => $request->input('cp1_phone2'),
                'cp2_name' => $request->input('cp2_name'),
                'cp2_email' => $request->input('cp2_email'),
                'cp2_phone1' => $request->input('cp2_phone1'),
                'cp2_phone2' => $request->input('cp2_phone2'),
                'created_user_id' => $createduserid);

            DB::table('institute_details')->insert($data2);
            $newvalue = json_encode($data2, true);
            $data1 = array(
                'log_type' => 'Add Institution details',
                'message' => 'Added',
                'new_value' => $newvalue,
                'old_value' => "No old Value for Add Activity",
                'user_name' => $createduserid);
            DB::table('log_details')->insert($data1);
            Session::put('add_institute_details', 'Institution Details Added Successfully');
            return redirect('view_institution_details');
        }
    }

    public function view_institution_details() {
        $institutions['institutions'] = DB::table('institute_details')->where('status', 1)->paginate(20);
        return view('institutions/view_institution_details', $institutions);
    }

    public function edit_institution_details($id) {
        $institutions['institutions'] = DB::select(DB::raw("select id.institution_name,id.institution_image,id.institution_logo,id.institution_code,id.institution_email,id.registration_number,id.office_contact_number1,id.office_contact_number2,s.state_name,c.city_name,ay.from_date,ay.to_date,id.academic_year_id,id.state_id,id.city_id,id.address,id.cp1_name,id.cp1_email,id.cp1_phone1,id.cp1_phone2,id.cp2_name,id.cp2_email,id.cp2_phone1,id.cp2_phone2 from institute_details id  left join state s on id.state_id = s.state_id left join city c on c.city_id = id.city_id left join academic_years ay on ay.academic_year_id = id.academic_year_id  WHERE id.institute_id=$id"));
        Session::put('institution_details_id', $id);
        return view('institutions/edit_institution_details', $institutions);
    }

    public function do_edit_institution_details(Request $request) {
        $data = Input::except(array('_token'));
        $createduserid = Session::get('user_login_id');
        //$id = Session::get('institution_details_id');
        $result = DB::table('institute_details')->where('institute_id', 1)->get();
        $institution_name = $result[0]->institution_name;
        $institution_email = $result[0]->institution_email;
        $registration_number = $result[0]->registration_number;
        $office_contact_number1 = $result[0]->office_contact_number1;
        $office_contact_number2 = $result[0]->office_contact_number2;
        $state = $result[0]->state_id;
        $address = $result[0]->address;
        $city = $result[0]->city_id;
        $cp1_name = $result[0]->cp1_name;
        $cp1_email = $result[0]->cp1_email;
        $cp1_phone1 = $result[0]->cp1_phone1;
        $cp1_phone2 = $result[0]->cp1_phone2;
        $cp2_name = $result[0]->cp2_name;
        $cp2_email = $result[0]->cp2_email;
        $cp2_phone1 = $result[0]->cp2_phone1;
        $cp2_phone2 = $result[0]->cp2_phone2;
        $old_value = "Institution Name=" . $institution_name . ",Institution email=" . $institution_email . ",registration number=" . $registration_number .
                ",office contact number 1=" . $office_contact_number1 . ",office contact number 1=" . $office_contact_number2 . ",State=" . $state .
                ",address=" . $address . ",city=" . $city . ",cp1 name=" . $cp1_name .
                ",cp1 email=" . $cp1_email . ",cp1 phone1=" . $cp1_phone1 . ",Cp2 name=" . $cp2_name .
                ",Cp2 email=" . $cp2_email . ",cp2 phone1=" . $cp2_phone1 . ",cp2 phone2=" . $cp2_phone2 .
                ",cp1 phone2=" . $cp1_phone2;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();

        $rule = array(
            'institution_name' => 'required',
            'institution_email' => 'required|email|max:255',
            'registration_number' => 'required',
            'office_contact_number1' => 'required|numeric',
            'office_contact_number2' => 'numeric',
            'academic_year' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cp1_phone1' => 'required|numeric',
            'cp2_name' => 'required|alpha',
            'cp2_email' => 'required|email',
            'cp2_phone1' => 'required|numeric',
            'cp2_phone2' => 'numeric');
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {

            if ($request->hasFile('institution_logo') && !($request->hasFile('institution_image'))) {
                $file = Input::file('institution_logo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_logo = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/', $institution_logo);
                $data2 = array(
                    'institution_name' => $request->input('institution_name'),
                    'institution_email' => $request->input('institution_email'),
                    'registration_number' => $request->input('registration_number'),
                    'office_contact_number1' => $request->input('office_contact_number1'),
                    'office_contact_number2' => $request->input('office_contact_number2'),
                    'academic_year_id' => $request->input('academic_year'),
                    'state_id' => $request->input('state'),
                    'institution_logo' => $institution_logo,
                    'city_id' => $request->input('city'),
                    'address' => $request->input('address'),
                    'cp1_name' => $request->input('cp1_name'),
                    'cp1_email' => $request->input('cp1_email'),
                    'cp1_phone1' => $request->input('cp1_phone1'),
                    'cp1_phone2' => $request->input('cp1_phone2'),
                    'cp2_name' => $request->input('cp2_name'),
                    'cp2_email' => $request->input('cp2_email'),
                    'cp2_phone1' => $request->input('cp2_phone1'),
                    'cp2_phone2' => $request->input('cp2_phone2'),
                    'updated_user_id' => $createduserid);

                DB::table('institute_details')->where('institute_id', $id)->update($data2);
                $created_user_id = Session::get('user_login_id');
                $newvalue = json_encode($data2, true);
                $data3 = array(
                    'log_type' => 'Edit institute_details details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => "No Old Value for Add Activity",
                    'user_name' => $created_user_id);
                DB::table('log_details')->insert($data3);
                Session::put('edit_institute_details', 'Institution Details Updated Successfully');
                return redirect('view_institution_details');
            } elseif ($request->hasFile('institution_image') && !($request->hasFile('institution_logo'))) {
                $file = Input::file('institution_image');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_image = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/', $institution_image);
                $data2 = array(
                    'institution_name' => $request->input('institution_name'),
                    'institution_email' => $request->input('institution_email'),
                    'registration_number' => $request->input('registration_number'),
                    'office_contact_number1' => $request->input('office_contact_number1'),
                    'office_contact_number2' => $request->input('office_contact_number2'),
                    'academic_year_id' => $request->input('academic_year'),
                    'state_id' => $request->input('state'),
                    'institution_image' => $institution_image,
                    'city_id' => $request->input('city'),
                    'address' => $request->input('address'),
                    'cp1_name' => $request->input('cp1_name'),
                    'cp1_email' => $request->input('cp1_email'),
                    'cp1_phone1' => $request->input('cp1_phone1'),
                    'cp1_phone2' => $request->input('cp1_phone2'),
                    'cp2_name' => $request->input('cp2_name'),
                    'cp2_email' => $request->input('cp2_email'),
                    'cp2_phone1' => $request->input('cp2_phone1'),
                    'cp2_phone2' => $request->input('cp2_phone2'),
                    'updated_user_id' => $createduserid);

                DB::table('institute_details')->where('institute_id', $id)->update($data2);
                $created_user_id = Session::get('user_login_id');
                $newvalue = json_encode($data2, true);
                $data3 = array(
                    'log_type' => 'Edit institute_details details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => "No Old Value for Add Activity",
                    'user_name' => $created_user_id);
                DB::table('log_details')->insert($data3);
                Session::put('edit_institute_details', 'Institution Details Updated Successfully');
                return redirect('view_institution_details');
            } elseif ($request->hasFile('institution_image') && $request->hasFile('institution_logo')) {
                $file = Input::file('institution_logo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_logo = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/', $institution_logo);
                $file1 = Input::file('institution_image');
                $timestamp1 = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_image = $timestamp1 . '-' . $file1->getClientOriginalName();

                $file1->move(public_path() . '/uploads/', $institution_image);
                $data2 = array(
                    'institution_name' => $request->input('institution_name'),
                    'institution_email' => $request->input('institution_email'),
                    'registration_number' => $request->input('registration_number'),
                    'office_contact_number1' => $request->input('office_contact_number1'),
                    'office_contact_number2' => $request->input('office_contact_number2'),
                    'academic_year_id' => $request->input('academic_year'),
                    'state_id' => $request->input('state'),
                    'institution_logo' => $institution_logo,
                    'institution_image' => $institution_image,
                    'city_id' => $request->input('city'),
                    'address' => $request->input('address'),
                    'cp1_name' => $request->input('cp1_name'),
                    'cp1_email' => $request->input('cp1_email'),
                    'cp1_phone1' => $request->input('cp1_phone1'),
                    'cp1_phone2' => $request->input('cp1_phone2'),
                    'cp2_name' => $request->input('cp2_name'),
                    'cp2_email' => $request->input('cp2_email'),
                    'cp2_phone1' => $request->input('cp2_phone1'),
                    'cp2_phone2' => $request->input('cp2_phone2'),
                    'updated_user_id' => $createduserid);

                DB::table('institute_details')->where('institute_id', $id)->update($data2);
                $created_user_id = Session::get('user_login_id');
                $newvalue = json_encode($data2, true);
                $data3 = array(
                    'log_type' => 'Edit institute_details details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => "No Old Value for Add Activity",
                    'user_name' => $created_user_id);
                DB::table('log_details')->insert($data3);
                Session::put('edit_institute_details', 'Institution Details Updated Successfully');
                return redirect('view_institution_details');
            } else {
                $data2 = array(
                    'institution_name' => $request->input('institution_name'),
                    'institution_email' => $request->input('institution_email'),
                    'registration_number' => $request->input('registration_number'),
                    'office_contact_number1' => $request->input('office_contact_number1'),
                    'office_contact_number2' => $request->input('office_contact_number2'),
                    'academic_year_id' => $request->input('academic_year'),
                    'state_id' => $request->input('state'),
                    'city_id' => $request->input('city'),
                    'address' => $request->input('address'),
                    'cp1_name' => $request->input('cp1_name'),
                    'cp1_email' => $request->input('cp1_email'),
                    'cp1_phone1' => $request->input('cp1_phone1'),
                    'cp1_phone2' => $request->input('cp1_phone2'),
                    'cp2_name' => $request->input('cp2_name'),
                    'cp2_email' => $request->input('cp2_email'),
                    'cp2_phone1' => $request->input('cp2_phone1'),
                    'cp2_phone2' => $request->input('cp2_phone2'),
                    'updated_user_id' => $createduserid);

                DB::table('institute_details')->where('institute_id', '1')->update($data2);
                $created_user_id = Session::get('user_login_id');
                $newvalue = json_encode($data2, true);
                $data3 = array(
                    'log_type' => 'Edit institute_details details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => "No Old Value for Add Activity",
                    'user_name' => $created_user_id);
                DB::table('log_details')->insert($data3);
                Session::put('edit_institute_details', 'Institution Details Updated Successfully');
                return redirect('view_institution_details');
            }
        }
    }

    public function delete_institution_details($id) {
        $createduserid = Session::get('user_login_id');
        $result = DB::table('institute_details')->where('institute_id', $id)->get();
        $institution_name = $result[0]->institution_name;
        $institution_email = $result[0]->institution_email;
        $registration_number = $result[0]->registration_number;
        $office_contact_number1 = $result[0]->office_contact_number1;
        $office_contact_number2 = $result[0]->office_contact_number2;
        $state = $result[0]->state_id;
        $address = $result[0]->address;
        $city = $result[0]->city_id;
        $cp1_name = $result[0]->cp1_name;
        $cp1_email = $result[0]->cp1_email;
        $cp1_phone1 = $result[0]->cp1_phone1;
        $cp1_phone2 = $result[0]->cp1_phone2;
        $cp2_name = $result[0]->cp2_name;
        $cp2_email = $result[0]->cp2_email;
        $cp2_phone1 = $result[0]->cp2_phone1;
        $cp2_phone2 = $result[0]->cp2_phone2;
        $old_value = "Institution Name=" . $institution_name . ",Institution email=" . $institution_email . ",registration number=" . $registration_number .
                ",office contact number 1=" . $office_contact_number1 . ",office contact number 1=" . $office_contact_number2 . ",State=" . $state .
                ",address=" . $address . ",city=" . $city . ",cp1 name=" . $cp1_name .
                ",cp1 email=" . $cp1_email . ",cp1 phone1=" . $cp1_phone1 . ",Cp2 name=" . $cp2_name .
                ",Cp2 email=" . $cp2_email . ",cp2 phone1=" . $cp2_phone1 . ",cp2 phone2=" . $cp2_phone2 .
                ",cp1 phone2=" . $cp1_phone2;
        $data1 = array(
            'log_type' => 'Delete Institution details',
            'message' => 'institute_details',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $old_value,
            'user_name' => $createduserid);
        DB::table('log_details')->insert($data1);
        //$institution_email = DB::table('institute_details')->where('institute_id', $id)->delete();
        $institution_email = DB::table('institute_details')->where('institute_id', $id)->update(['active' => 0]);
        if ($institution) {
            Session::put('delete_institute_details', 'Selected Institute Details deleted Successfully');
            return redirect('view_institution_details');
        } else {
            
        }
    }

    public function add_bus_driver() {
        return view('busdriver/add_bus_driver');
    }

    public function do_add_bus_driver(Request $request) {
        $data = Input::except(array('_token'));
        $id1 = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $rule = array(
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email',
            'phone' => 'required',
            'phone2' => 'required',
            'address' => 'required',
            'photo' => 'required',
            'aadhar_photo' => 'required',
            'license_photo' => 'required',
            'status' => 'required',
            'experience' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->hasFile('photo')) {
                $file = Input::file('photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $profile_pic = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/driver/', $profile_pic);
            }
            if ($request->hasFile('aadhar_photo')) {
                $file = Input::file('aadhar_photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $aadhar_photo = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/driver/', $aadhar_photo);
            }
            if ($request->hasFile('license_photo')) {
                $file = Input::file('license_photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $license_photo = $timestamp . '-' . $file->getClientOriginalName();

                $file->move(public_path() . '/uploads/driver/', $license_photo);
            }
            $data2 = array(
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'contact_number' => $request->input('phone'),
                'emergency_number' => $request->input('phone2'),
                'address' => $request->input('address'),
                'academic_year_id' => $academic_year_id,
                'profile_pic' => $profile_pic,
                'aadhar_pic' => $aadhar_photo,
                'license_pic' => $license_photo,
                'status' => $request->input('status'),
                'created_user_id' => $created_user_id,
                'experience' => $request->input('experience'));
            DB::table('bus_drivers')->insert($data2);
            $newvalue = json_encode($data2, true);
            $data1 = array(
                'log_type' => 'Add Bus Driver details',
                'message' => ' Added',
                'new_value' => $newvalue,
                'old_value' => "No old Value for Add Activity",
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::put('add_bus_driver_message', 'Bus Driver Added Successfully');
            return redirect('view_drivers');
        }
    }

    public function view_drivers() {
        $drivers['drivers'] = DB::table('bus_drivers')
                ->leftJoin('user_logins', 'user_logins.user_login_id', '=', 'bus_drivers.created_user_id')
                ->select('bus_drivers.experience', 'bus_drivers.bus_driver_id', 'user_logins.user_name', 'bus_drivers.first_name', 'bus_drivers.last_name', 'bus_drivers.contact_number', 'bus_drivers.address', 'bus_drivers.profile_pic', 'bus_drivers.created_at', 'bus_drivers.created_user_id')
                ->where('bus_drivers.active', 1)
                ->orderBy('first_name', 'ASC')
                ->paginate(20);
        return view('busdriver/view_drivers', $drivers);
    }

    public function edit_bus_driver($id) {
        Session::put('bus_driver_id', $id);
        $drivers['drivers'] = DB::table('bus_drivers')->where('bus_driver_id', $id)->get();
        return view('busdriver/edit_bus_driver', $drivers);
    }

    public function do_edit_bus_driver(Request $request) {
        $id = Session::get('bus_driver_id');
        $id1 = Session::get('user_login_id');
        $result = DB::table('bus_drivers')->where('bus_driver_id', $id)->get();
        $first_name = $result[0]->first_name;
        $last_name = $result[0]->last_name;
        $email = $result[0]->email;
        $address = $result[0]->address;
        $phone = $result[0]->contact_number;
        $emergency_number = $result[0]->emergency_number;
        $created_user_id = $result[0]->created_user_id;

        $oldvalue = "user  id=" . $id . ",first name=" . $first_name . ",Last Name=" . $last_name . ",Email id=" . $email
                . ",address=" . $address . ",contact number=" . $phone . ",emergency number=" . $emergency_number . ",created user id=" . $created_user_id;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $data = Input::except(array('_token'));
        $rule = array(
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'phone' => 'required',
            'phone2' => 'required',
            'address' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {

            if ($request->hasFile('photo')) {
                $file = Input::file('photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $profile_pic = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/driver/', $profile_pic);

                $first_name = $request->input('firs_tname');
                $last_name = $request->input('last_name');
                $email_id = $request->input('email');
                $address = $request->input('address');
                $contact_number = $request->input('phone');
                $data2 = array(
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'contact_number' => $request->input('phone'),
                    'emergency_number' => $request->input('phone2'),
                    'address' => $request->input('address'),
                    'profile_pic' => $profile_pic,
                    'status' => $request->input('status'),
                    'updated_user_id' => $id1,
                    'experience' => $request->input('experience'));
                DB::table('bus_drivers')->where('bus_driver_id', $id)->update($data2);
                $newvalue = "first_name=$first_name,last_name=$last_name,email_id =$email_id,address=$address,contact_number=$contact_number, updated_user_id =$id1,updated_at=$current_time";
                $data1 = array(
                    'log_type' => ' Edit Drivers details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => $oldvalue,
                    'user_name' => $id1);
                DB::table('log_details')->insert($data1);
            } else {
                $first_name1 = $request->input('firs_tname');
                $last_name1 = $request->input('last_name');
                $email_id1 = $request->input('email');
                $address1 = $request->input('address');
                $contact_number1 = $request->input('phone');
                $data3 = array(
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'contact_number' => $request->input('phone'),
                    'emergency_number' => $request->input('phone2'),
                    'address' => $request->input('address'),
                    'status' => $request->input('status'),
                    'updated_user_id' => $id1,
                    'experience' => $request->input('experience'));
                DB::table('bus_drivers')->where('bus_driver_id', $id)->update($data3);
                $newvalue = "first_name=$first_name1,last_name=$last_name1,email_id =$email_id1,address=$address1,contact_number=$contact_number1, updated_user_id =$id1,updated_at=$current_time";
                $data4 = array(
                    'log_type' => ' Edit Drivers detals',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => $oldvalue,
                    'user_name' => $id1);
                DB::table('log_details')->insert($data4);
            }
            Session::put('update_bus_driver_message', 'Bus Driver Details Updated successfully');
            Session::forget('bus_driver_id');
            return redirect('view_drivers');
        }
    }

    public function delete_bus_driver($id) {
        $id1 = Session::get('user_login_id');
        $result = DB::table('bus_drivers')->where('bus_driver_id', $id)->get();
        $first_name = $result[0]->first_name;
        $last_name = $result[0]->last_name;
        $email = $result[0]->email;
        $address = $result[0]->address;
        $phone = $result[0]->contact_number;
        $emergency_number = $result[0]->emergency_number;
        $created_user_id = $result[0]->created_user_id;

        $oldvalue = "user  id=" . $id . ",first name=" . $first_name . ",Last Name=" . $last_name . ",Email id=" . $email
                . ",address=" . $address . ",contact number=" . $phone . ",emergency number=" . $emergency_number . ",created user id=" . $created_user_id;
        $data1 = array(
            'log_type' => 'Delete driver details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $id1);
        DB::table('log_details')->insert($data1);
        //$driver = DB::table('bus_drivers')->where('bus_driver_id', $id)->delete();
        $driver = DB::table('bus_drivers')->where('bus_driver_id', $id)->update(['active' => 0]);
        if ($driver) {
            Session::put('delete_bus_driver', 'Bus Driver Deleted Successfully');
            return redirect('view_drivers');
        }
    }

    public function add_bus_route() {
        return view('busroute/add_bus_route');
    }

    public function do_add_bus_route(Request $request) {
        $data = Input::except(array('_token'));
        $createduserid = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');

        $rule = array(
            'route_from' => 'required|regex:/^[\pL\s]+$/u|unique:bus_routes',
            'route_to' => 'required|regex:/^[\pL\s]+$/u',
            'status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $data1 = array(
                'route_from' => $request->input('route_from'),
                'route_to' => $request->input('route_to'),
                'created_user_id' => $createduserid,
                'academic_year_id' => $academic_year_id,
                'status' => $request->input('status'));
            $new_value = json_encode($data1, true);
            DB::table('bus_routes')->insert($data1);
            $data2 = array(
                'log_type' => 'Add Bus route details',
                'message' => 'Added',
                'new_value' => $new_value,
                'old_value' => "No old Value for Add Activity",
                'user_name' => $createduserid);
            DB::table('log_details')->insert($data2);
            Session::put('addbusroutemessage', 'Bus Route Added successfully');
            return redirect('view_bus_routes');
        }
    }

    public function view_bus_routes() {
        $routes['routes'] = DB::table('bus_routes')
                ->join('user_logins', 'bus_routes.created_user_id', '=', 'user_logins.user_login_id')
                ->select('bus_routes.route_to', 'user_logins.user_name', 'bus_routes.bus_route_id', 'bus_routes.route_from', 'bus_routes.status', 'bus_routes.created_user_id', 'bus_routes.updated_at', 'bus_routes.created_at')
                ->where('bus_routes.active', 1)
                ->orderBy('route_to', 'ASC')
                ->paginate(20);
        return view('busroute/view_bus_routes', $routes);
    }

    public function edit_bus_route($id) {
        $routes['routes'] = DB::table('bus_routes')->where('bus_route_id', $id)->get();
        Session::put('busrouteid', $id);
        return view('busroute/edit_bus_route', $routes);
    }

    public function do_edit_bus_route(Request $request) {
        $id = Session::get('busrouteid');
        $id1 = Session::get('user_login_id');
        $data = Input::except(array('_token'));
        $result = DB::table('bus_routes')->where('bus_route_id', $id)->get();
        $busroutefrom = $result[0]->route_from;
        $busrouteto = $result[0]->route_to;
        $select = $result[0]->status;
        $oldvalue = "route_to=" . $busrouteto . ",route_from=" . $busroutefrom . ",stauts=" . $select . ",fee_type_id=" . $id;
        $rule = array(
            'route_from' => 'required|regex:/^[\pL\s]+$/u',
            'route_to' => 'required|regex:/^[\pL\s]+$/u|unique:bus_routes',
            'status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $route_from = $request->input('route_from');
            $route_to = $request->input('route_to');
            $status = $request->input('status');
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            DB::table('bus_routes')
                    ->where('bus_route_id', $id)
                    ->limit(1)
                    ->update(array('route_from' => $route_from, 'route_to' => $route_to, 'status' => $status, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            $newvalue = "route_from=$route_from,route_to=$route_to,status=$status,updated_user_id=$id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit Bus Route Details',
                'message' => 'Edited',
                'new_value' => $newvalue,
                'old_value' => $oldvalue,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::put('doeditbusroutemessage', 'selected Bus Route updated successfully');
            Session::forget('busrouteid');
            return redirect('view_bus_routes');
        }
    }

    public function delete_bus_route($id) {
        $id1 = Session::get('user_login_id');
        $result = DB::table('bus_routes')->where('bus_route_id', $id)->get();
        $busroutefrom = $result[0]->route_from;
        $busrouteto = $result[0]->route_to;
        $select = $result[0]->status;
        $oldvalue = "route_to=" . $busrouteto . ",route_from=" . $busroutefrom . ",stauts=" . $select . ",fee_type_id=" . $id;
        $data1 = array(
            'log_type' => 'Delete Bus Route details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $id1);
        DB::table('log_details')->insert($data1);
        //$route = DB::table('bus_routes')->where('bus_route_id', $id)->delete();
        $route = DB::table('bus_routes')->where('bus_route_id', $id)->update(['active' => 0]);
        if ($route) {
            Session::put('deletebusroutemessage', 'Selected Bus Route deleted Successfully');
            return redirect('view_bus_routes');
        } else {
            
        }
    }

    public function add_bus_stop() {
        $routes['routes'] = DB::table('bus_routes')->get();
        return view('busstop/add_bus_stop', $routes);
    }

    public function do_add_bus_stop(Request $request) {
        $data = Input::except(array('_token'));
        $createduserid = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $pickup_time = $request->input('pickup_time');
        $rule = array(
            'bus_route_id' => 'required',
            'bus_stop_name' => 'required|regex:/^[\pL\s]+$/u|unique:bus_stops',
            'status' => 'required',
            'pickup_time' => 'required',
            'drop_time' => 'required|after:' . $pickup_time
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $data1 = array(
                'bus_stop_name' => $request->input('bus_stop_name'),
                'bus_route_id' => $request->input('bus_route_id'),
                'pickup_time' => $request->input('pickup_time'),
                'drop_time' => $request->input('drop_time'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $createduserid,
                'status' => $request->input('status'));
            DB::table('bus_stops')->insert($data1);
            $new_value = json_encode($data1, true);
            $data2 = array(
                'log_type' => 'Add Bus stop details',
                'message' => 'Added',
                'new_value' => $new_value,
                'old_value' => "No old value for Add Activity.",
                'user_name' => $createduserid);
            DB::table('log_details')->insert($data2);
            Session::put('addbusstopmessage', 'Bus Stop Added successfully');
            return redirect('view_bus_stops');
        }
    }

    public function view_bus_stops() {
        $stops['stops'] = DB::table('bus_stops')
                ->leftJoin('bus_routes', 'bus_routes.bus_route_id', '=', 'bus_stops.bus_route_id')
                ->leftJoin('user_logins', 'bus_stops.created_user_id', '=', 'user_logins.user_login_id')
                ->select('bus_stops.bus_stop_id', 'bus_stops.bus_stop_name', 'bus_stops.pickup_time', 'bus_stops.drop_time', 'bus_stops.bus_route_id', 'bus_stops.status', 'bus_stops.created_user_id', 'bus_stops.created_at', 'bus_stops.updated_at', 'bus_routes.route_from', 'bus_routes.route_to', 'bus_routes.bus_route_id', 'user_logins.user_name')
                ->where('bus_stops.active', 1)
                ->orderBy('bus_stop_name', 'ASC')
                ->paginate(20);
        return view('busstop/view_bus_stops', $stops);
    }

    public function edit_bus_stop($id) {
        $stopss = DB::table('bus_stops')->where('bus_stop_id', $id)->get();
        $bus_stop_id = $stopss[0]->bus_route_id;
        $stops['stops'] = DB::table('bus_stops')->where('bus_stop_id', $id)->get();
        $stops['routes'] = DB::table('bus_routes')->select('route_from', 'route_to')->where('bus_route_id', $bus_stop_id)->get();
        Session::put('busstopid', $id);
        return view('busstop/edit_bus_stop', $stops);
    }

    public function do_edit_bus_stop(Request $request) {
        $id = Session::get('busstopid');
        $id1 = Session::get('user_login_id');
        $result = DB::table('bus_stops')->where('bus_stop_id', $id)->get();
        $pickuptime = $result[0]->pickup_time;
        $droptime = $result[0]->drop_time;
        $select = $result[0]->status;
        $bus_stop_name = $result[0]->bus_stop_name;
        $bus_stop_id = $result[0]->bus_stop_id;
        $oldvalue = "bus_stop_id=" . $bus_stop_id . ",bus_stop_name=" . $bus_stop_name . ",pickup_time=" . $pickuptime . ",drop_time=" . $droptime . ",stauts=" . $select;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $pickup_time = $request->input('pickup_time');
        $data = Input::except(array('_token'));
        $rule = array(
            //'bus_route_id' => 'required',
            'bus_stop_name' => 'required|regex:/^[\pL\s]+$/u',
            'status' => 'required',
            'pickup_time' => 'required',
            'drop_time' => 'required|after:' . $pickup_time
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $bus_route_from = $request->input('bus_route_id');
            $pickup_time = $request->input('pickup_time');
            $drop_time = $request->input('drop_time');
            $bus_stop = $request->input('bus_stop_name');
            $status = $request->input('status');
            DB::table('bus_stops')
                    ->where('bus_stop_id', $id)
                    ->limit(1)
                    ->update(array('pickup_time' => $pickup_time, 'drop_time' => $drop_time, 'bus_stop_name' => $bus_stop, 'status' => $status, 'updated_user_id' => $id1, 'updated_at' => $current_time));
            $newvalue = "bus_stop_name=$bus_stop,pickup_time=$pickup_time,drop_time=$drop_time,status=$status,updated_user_id=$id1,updated_at=$current_time";
            $data1 = array(
                'log_type' => 'Edit Bus stop Details ',
                'message' => 'Edited',
                'new_value' => $newvalue,
                'old_value' => $oldvalue,
                'user_name' => $id1);
            DB::table('log_details')->insert($data1);
            Session::put('doeditbusstopemessage', 'selected Bus Stop updated successfully');
            Session::forget('busstopid');
            return redirect('view_bus_stops');
        }
    }

    public function delete_bus_stop($id) {
        $id1 = Session::get('userid');
        $result = DB::table('bus_stops')->where('bus_stop_id', $id)->get();
        $pickuptime = $result[0]->pickup_time;
        $droptime = $result[0]->drop_time;
        $select = $result[0]->status;
        $busstop = $result[0]->bus_stop_name;
        $oldvalue = "bus_stop_name=" . $busstop . ",pickup_time=" . $pickuptime . ",drop_time=" . $droptime . ",stauts=" . $select;
        $data1 = array(
            'log_type' => 'Delete bus stop details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $id1);
        DB::table('log_details')->insert($data1);
        //$stop = DB::table('bus_stops')->where('bus_stop_id', $id)->delete();
        $stop = DB::table('bus_stops')->where('bus_stop_id', $id)->update(['active' => 0]);
        if ($stop) {
            Session::put('deletebusstopmessage', 'Selected Bus Route deleted Successfully');
            return redirect('view_bus_stops');
        } else {
            
        }
    }

    public function addbus() {
        $buses['routes'] = DB::select(DB::raw("SELECT bus_route_id,route_from,route_to FROM bus_routes where bus_route_id NOT IN(SELECT bus_route_id from buses)"));
        $buses['drivers'] = DB::select(DB::raw("SELECT bus_driver_id,first_name,last_name FROM bus_drivers where bus_driver_id NOT IN(SELECT bus_driver_id from buses)"));
        return view('buses/addbus', $buses);
    }

    public function doaddbus(Request $request) {
        $data = Input::except(array('_token'));
        $createduserid = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $pickup_start_time = $request->input('pickup_start_time');
        $drop_start_time = $request->input('drop_start_time');
        $pickup_end_time = $request->input('pickup_end_time');
        $rule = array(
            'bus_number' => 'required|unique:buses',
            'pickup_start_time' => 'required',
            'pickup_end_time' => 'required|after:' . $pickup_start_time,
            'drop_start_time' => 'required|after:' . $pickup_end_time,
            'drop_end_time' => 'required|after:' . $drop_start_time,
            'status' => 'required',
            'bus_driver_id' => 'required',
            'bus_route_id' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $data1 = array(
                'bus_route_id' => $request->input('bus_route_id'),
                'bus_driver_id' => $request->input('bus_driver_id'),
                'bus_number' => $request->input('bus_number'),
                'pickup_start_time' => $request->input('pickup_start_time'),
                'pickup_end_time' => $request->input('pickup_end_time'),
                'drop_start_time' => $request->input('drop_start_time'),
                'drop_end_time' => $request->input('drop_end_time'),
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $createduserid,
                'status' => $request->input('status'));
            $new_value = json_encode($data1, true);
            DB::table('buses')->insert($data1);
            $data2 = array(
                'log_type' => 'Add bus details',
                'message' => 'Added',
                'new_value' => $new_value,
                'old_value' => "No old value for this activity",
                'user_name' => $createduserid);
            DB::table('log_details')->insert($data2);
            Session::put('addbusmessage', 'Bus  Added successfully');
            return redirect('viewbuses');
        }
    }

    public function viewbuses() {
        $buses['buses'] = DB::table('buses')
                ->leftJoin('bus_routes', 'buses.bus_route_id', '=', 'bus_routes.bus_route_id')
                ->leftJoin('bus_drivers', 'buses.bus_driver_id', '=', 'bus_drivers.bus_driver_id')
                ->leftJoin('user_logins', 'buses.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(buses.created_at,"%d-%m-%Y %r") as date'), 'buses.bus_id', 'buses.created_user_id', 'buses.created_at', 'buses.updated_at', 'buses.bus_number', 'buses.status', 'buses.drop_start_time', 'buses.drop_end_time', 'buses.pickup_start_time', 'buses.pickup_end_time', 'bus_routes.route_from', 'bus_routes.route_to', 'bus_routes.bus_route_id', 'bus_drivers.first_name', 'bus_drivers.last_name', 'user_logins.user_name'])
                ->where('buses.active', 1)
                ->orderBy('buses.created_at', 'DESC')
                ->paginate(20);
        return view('buses/viewbuses', $buses);
    }

    public function editbus($id) {
        $buses = DB::table('buses')->where('bus_id', $id)->get();
        $bus_route = $buses[0]->bus_route_id;
        $bus_driver = $buses[0]->bus_driver_id;
        $buses['buses'] = DB::table('buses')->where('bus_id', $id)->get();
        $busess['routes'] = DB::table('bus_routes')->select('route_to', 'route_from')->where('bus_route_id', $bus_route)->get();
        $busess['drivers'] = DB::table('bus_drivers')->select('first_name', 'last_name')->where('bus_driver_id', $bus_driver)->get();
        Session::put('busid', $id);
        return view('buses/edit_bus', $busess, $buses);
    }

    public function doeditbus(Request $request) {
        $id1 = Session::get('user_login_id');
        $id = Session::get('busid');
        $updateduserid = Session::get('user_login_id');
        $result = DB::table('buses')->where('bus_id', $id)->get();
        $busnumber = $result[0]->bus_number;
        $select = $result[0]->status;
        $bus_route_id = $result[0]->bus_route_id;
        $bus_driver_id = $result[0]->bus_driver_id;
        $oldvalue = "Bus number=" . $busnumber . ",Status=" . $select . ",Route from to=" . $bus_route_id . ",Driver name=" . $bus_driver_id;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $pickup_start_time = $request->input('pickup_start_time');
        $drop_start_time = $request->input('drop_start_time');
        $pickup_end_time = $request->input('pickup_end_time');
        $data = Input::except(array('_token'));
        $rule = array(
            'pickup_start_time' => 'required',
            'pickup_end_time' => 'required|after:' . $pickup_start_time,
            'drop_start_time' => 'required|after:' . $pickup_end_time,
            'drop_end_time' => 'required|after:' . $drop_start_time,
            'status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $bus_number = $request->input('bus_number');
            $bus_route = $request->input('bus_route_id');
            $driver_name = $request->input('bus_driver_id');
            $status = $request->input('status');
            $pickup_start_time = $request->input('pickup_start_time');
            $pickup_end_time = $request->input('pickup_end_time');
            $drop_start_time = $request->input('drop_start_time');
            $drop_end_time = $request->input('drop_end_time');

            DB::table('buses')
                    ->where('bus_id', $id)
                    ->limit(1)
                    ->update(array('pickup_start_time' => $pickup_start_time, 'pickup_end_time' => $pickup_end_time, 'drop_start_time' => $drop_start_time, 'drop_end_time' => $drop_end_time, 'status' => $status, 'updated_user_id' => $updateduserid, 'updated_at' => $current_time));
            $newvalue = "bus_number=$bus_number,bus_driver_id=$driver_name,bus_route_id =$bus_route,updated_at=$current_time";
            $data2 = array(
                'log_type' => 'Edit Bus Details ',
                'message' => 'Edited',
                'new_value' => $newvalue,
                'old_value' => $oldvalue,
                'user_name' => $id1);
            DB::table('log_details')->insert($data2);
            Session::set('buseditmessage', 'your Edited Bus details are updated');
            Session::forget('usertypeid');
            return redirect('viewbuses');
        }
    }

    public function dobusdelete($id) {
        $updateduserid = Session::get('user_login_id');
        $result = DB::table('buses')->where('bus_id', $id)->get();
        $busnumber = $result[0]->bus_number;
        $select = $result[0]->status;
        $bus_route_id = $result[0]->bus_route_id;
        $bus_driver_id = $result[0]->bus_driver_id;
        $oldvalue = "Bus number=" . $busnumber . ",Status=" . $select . ",Route from to=" . $bus_route_id . ",Driver name=" . $bus_driver_id;
        $data1 = array(
            'log_type' => 'Delete Bus Details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => $updateduserid);
        DB::table('log_details')->insert($data1);
        //$bus = DB::table('buses')->where('bus_id', $id)->delete();
        $bus = DB::table('buses')->where('bus_id', $id)->update(['active' => 0]);
        if ($bus) {
            Session::put('deletebusmessage', 'Selected Bus Details deleted Successfully');
            return redirect('viewbuses');
        } else {
            
        }
    }

    public function bus_details($id) {
        $users['users'] = DB::select(DB::raw("SELECT b.bus_id, b.bus_number, b.status,br.route_from,br.route_to,bd.first_name,bd.last_name,bd.contact_number,bd.emergency_number,b.pickup_start_time,b.pickup_end_time,b.drop_start_time,b.drop_end_time,b.created_user_id,b.created_at,b.updated_at  FROM buses b LEFT JOIN bus_routes br on b.bus_route_id=br.bus_route_id LEFT JOIN bus_drivers bd on bd.bus_driver_id=b.bus_driver_id where b.bus_id=$id"));
        return view('buses/bus_details', $users);
    }

    public function route_details($id, $bus_id) {
        $bus_id11 = trim($bus_id, "bus_id=");
        $users['users'] = DB::select(DB::raw("SELECT b.bus_id, b.bus_number, b.status,br.route_from,br.route_to,bd.first_name,bd.last_name,bd.contact_number,bd.emergency_number,b.pickup_start_time,b.pickup_end_time,b.drop_start_time,b.drop_end_time,b.created_user_id,b.created_at,b.updated_at  FROM buses b LEFT JOIN bus_routes br on b.bus_route_id=br.bus_route_id LEFT JOIN bus_drivers bd on bd.bus_driver_id=b.bus_driver_id where b.bus_id=$bus_id11"));
        $users['users1'] = DB::table('bus_stops')
                ->leftJoin('user_logins', 'bus_stops.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('bus_routes', 'bus_routes.bus_route_id', '=', 'bus_stops.bus_route_id')
                ->select('bus_stops.bus_stop_name', 'bus_stops.status', 'bus_stops.bus_stop_id', 'bus_stops.pickup_time', 'bus_stops.drop_time', 'bus_routes.bus_route_id', 'bus_routes.route_from', 'bus_routes.route_to', 'bus_stops.created_user_id', 'bus_stops.updated_user_id', 'bus_stops.created_at', 'bus_stops.updated_at', 'user_logins.user_name')
                ->where('bus_stops.bus_route_id', $id)
                ->paginate(20);
        return view('busroute/route_details', $users);
    }

    public function route_details1($id) {
        $bus_id = DB::table('buses')->select('bus_id')->where('bus_route_id', $id)->get();
        $bus_id1 = $bus_id[0]->bus_id;
        $users['users'] = DB::select(DB::raw("SELECT b.bus_id, b.bus_number, b.status,br.route_from,br.route_to,bd.first_name,bd.last_name,bd.contact_number,bd.emergency_number,b.pickup_start_time,b.pickup_end_time,b.drop_start_time,b.drop_end_time,b.created_user_id,b.created_at,b.updated_at  FROM buses b LEFT JOIN bus_routes br on b.bus_route_id=br.bus_route_id LEFT JOIN bus_drivers bd on bd.bus_driver_id=b.bus_driver_id where b.bus_id=$bus_id1"));
        $users['users1'] = DB::table('bus_stops')
                ->leftJoin('user_logins', 'bus_stops.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('bus_routes', 'bus_routes.bus_route_id', '=', 'bus_stops.bus_route_id')
                ->select('bus_stops.pickup_time', 'bus_stops.drop_time', 'bus_stops.bus_stop_id', 'bus_stops.bus_stop_name', 'bus_stops.status', 'bus_routes.bus_route_id', 'bus_routes.route_from', 'bus_routes.route_to', 'bus_stops.created_user_id', 'bus_stops.updated_user_id', 'bus_stops.created_at', 'bus_stops.updated_at', 'user_logins.user_name')
                ->where('bus_stops.bus_route_id', $id)
                ->paginate(20);
        return view('busroute/route_details', $users);
    }

    public function driver_details($id) {
        $drivers['drivers'] = DB::select(DB::raw("SELECT b.bus_id, b.bus_number, b.status,br.route_from,br.route_to,bd.first_name,bd.last_name,bd.experience,bd.address,bd.bus_driver_id,bd.contact_number,bd.emergency_number,b.pickup_start_time,b.pickup_end_time,b.drop_start_time,b.drop_end_time,bd.created_user_id,bd.profile_pic,bd.created_at,bd.updated_at  FROM buses b LEFT JOIN bus_routes br on b.bus_route_id=br.bus_route_id LEFT JOIN bus_drivers bd on bd.bus_driver_id=b.bus_driver_id where bd.bus_driver_id=$id"));
        return view('busdriver/driver_details', $drivers);
    }

    public function subject_details($subject_id, $class_id, $section_id) {
        $subjects['classes'] = DB::select(DB::raw("SELECT s.section_name,c.class_name,su.subject_name FROM class_subject cs LEFT JOIN classes c ON c.class_id=cs.class_id LEFT JOIN sections s ON s.section_id=cs.section_id
LEFT JOIN subjects su ON su.subject_id=cs.subject_id WHERE c.class_id=$class_id AND s.section_id=$section_id AND su.subject_id=$subject_id GROUP BY cs.class_id"));

        $subjects['subjects'] = DB::table('staff_subject')
                ->rightJoin('class_subject', function($join) {
                    $join->on('staff_subject.class_id', '=', 'class_subject.class_id');
                    $join->on('staff_subject.section_id', '=', 'class_subject.section_id');
                    $join->on('staff_subject.subject_id', '=', 'class_subject.subject_id');
                })
                ->leftJoin('user_logins', 'staff_subject.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_subject.class_id')
                ->leftJoin('subjects', 'subjects.subject_id', '=', 'class_subject.subject_id')
                ->leftJoin('days', 'days.day_id', '=', 'class_subject.day_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_subject.section_id')
                ->leftJoin('staff', 'staff.staff_id', '=', 'staff_subject.staff_id')
                ->select('subjects.subject_name', 'subjects.subject_id', 'day_title', 'classes.class_name', 'class_subject.class_id', 'sections.section_name', 'staff_subject.created_user_id', 'staff_subject.updated_user_id', 'staff_subject.created_at', 'staff_subject.updated_at', 'user_logins.user_name', 'staff.first_name', 'staff.last_name', 'class_subject.start_time', 'class_subject.end_time', 'staff.profile_pic', 'staff.contact_number')
                ->where('staff_subject.class_id', $class_id)
                ->where('staff_subject.section_id', $section_id)
                ->where('staff_subject.subject_id', $subject_id)
                ->paginate(20);
        return view('classsubject/subject_details', $subjects);
    }

    public function subject_details1($subject_id, $class_id) {
        $subjects['classes'] = DB::select(DB::raw("SELECT s.section_name,c.class_name,su.subject_name FROM class_subject cs LEFT JOIN classes c ON c.class_id=cs.class_id LEFT JOIN sections s ON s.section_id=cs.section_id
LEFT JOIN subjects su ON su.subject_id=cs.subject_id WHERE c.class_id=$class_id AND su.subject_id=$subject_id GROUP BY cs.class_id"));

        $subjects['subjects'] = DB::table('staff_subject')
                ->rightJoin('class_subject', function($join) {
                    $join->on('staff_subject.class_id', '=', 'class_subject.class_id');
                    $join->on('staff_subject.section_id', '=', 'class_subject.section_id');
                    $join->on('staff_subject.subject_id', '=', 'class_subject.subject_id');
                })
                ->leftJoin('user_logins', 'staff_subject.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'class_subject.class_id')
                ->leftJoin('subjects', 'subjects.subject_id', '=', 'class_subject.subject_id')
                ->leftJoin('days', 'days.day_id', '=', 'class_subject.day_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'class_subject.section_id')
                ->leftJoin('staff', 'staff.staff_id', '=', 'staff_subject.staff_id')
                ->select('subjects.subject_name', 'subjects.subject_id', 'day_title', 'classes.class_name', 'class_subject.class_id', 'sections.section_name', 'staff_subject.created_user_id', 'staff_subject.updated_user_id', 'staff_subject.created_at', 'staff_subject.updated_at', 'user_logins.user_name', 'staff.first_name', 'staff.last_name', 'class_subject.start_time', 'class_subject.end_time', 'staff.profile_pic', 'staff.contact_number')
                ->where('staff_subject.class_id', $class_id)
                ->where('staff_subject.subject_id', $subject_id)
                ->paginate(20);
        return view('classsubject/subject_details', $subjects);
    }

    public function calender_events() {
        return view('events/calender_events');
    }

    public function export_to_excel() {
        $users = Users::select('user_type_id', 'first_name', 'last_name')->get();
        $paymentsArray = [];
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['id', 'customer', 'email', 'total', 'created_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($users as $payment) {
            $paymentsArray[] = $payment->toArray();
        }
        Excel::create($current_time . '_users', function($excel) use($paymentsArray) {
            $excel->setTitle('users');
            $excel->sheet('Sheet 1', function($sheet) use($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });
        })->download('xls');
        return redirect('view_user_types');
    }

    public function log_history() {
        $logs['logs'] = DB::table('logs')
                ->select('log_id', 'log_type', 'user_name', 'log_out', 'log_in', 'user_browser', 'created_at', 'ip_address')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        return view('logs/log_history', $logs);
    }

    public function log_history_search(Request $request) {
        $query = $request->input('search');

        $logs['logs'] = DB::table('logs')->where('log_id', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_type', 'LIKE', '%' . $query . '%')
                        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                        ->orWhere('user_name', 'LIKE', '%' . $query . '%')
                        ->orWhere('ip_address', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_in', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_out', 'LIKE', '%' . $query . '%')
                        ->orWhere('user_browser', 'LIKE', '%' . $query . '%')
                        ->orderBy('created_at', 'DESC')->paginate(10);

        return view('logs/log_history', $logs, ['value' => $query]);
    }

    public function logdetails() {
        $logs['logs'] = DB::table('log_details')
                ->leftJoin('user_logins', 'log_details.user_name', '=', 'user_logins.user_name')
                ->select('log_details.log_id', 'log_details.log_type', 'log_details.message', 'log_details.old_value', 'log_details.new_value', 'user_logins.user_name', 'log_details.created_at')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);

        return view('logs/logdetails', $logs);
    }

    public function log_details_search(Request $request) {
        $query = $request->input('search');
        $logs['logs'] = DB::table('log_details')
                        ->leftJoin('user_logins', 'log_details.user_name', '=', 'user_logins.user_name')
                        ->select('log_details.log_id', 'log_details.log_type', 'log_details.message', 'log_details.old_value', 'log_details.new_value', 'user_logins.user_name', 'log_details.created_at')
                        ->where('log_details.log_id', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_details.created_at', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_details.log_type', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_details.message', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_details.old_value', 'LIKE', '%' . $query . '%')
                        ->orWhere('log_details.new_value', 'LIKE', '%' . $query . '%')
                        ->orWhere('user_logins.user_name', 'LIKE', '%' . $query . '%')
                        ->orderBy('log_details.created_at', 'DESC')->paginate(10);

        return view('logs/logdetails', $logs, ['value' => $query]);
    }

    public function buses_search(Request $request) {
        $query = $request->input('search');
        $buses['buses'] = DB::table('buses')
                ->leftJoin('bus_routes', 'buses.bus_route_id', '=', 'bus_routes.bus_route_id')
                ->leftJoin('bus_drivers', 'buses.bus_driver_id', '=', 'bus_drivers.bus_driver_id')
                ->leftJoin('user_logins', 'buses.created_user_id', '=', 'user_logins.user_login_id')
                ->select([DB::RAW('DATE_FORMAT(buses.created_at,"%d-%m-%Y %r") as date'), 'buses.bus_id', 'buses.created_user_id', 'buses.created_at', 'buses.updated_at', 'buses.bus_number', 'buses.status', 'buses.drop_start_time', 'buses.drop_end_time', 'buses.pickup_start_time', 'buses.pickup_end_time', 'bus_routes.route_from', 'bus_routes.route_to', 'bus_routes.bus_route_id', 'bus_drivers.first_name', 'bus_drivers.last_name', 'user_logins.user_name'])
                ->where('buses.active', 1)
                ->where('bus_id', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_number', 'LIKE', '%' . $query . '%')
                ->orWhere('route_from', 'LIKE', '%' . $query . '%')
                ->orWhere('route_to', 'LIKE', '%' . $query . '%')
                ->orWhere('first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                ->orWhere('pickup_start_time', 'LIKE', '%' . $query . '%')
                ->orWhere('pickup_end_time', 'LIKE', '%' . $query . '%')
                ->orWhere('drop_start_time', 'LIKE', '%' . $query . '%')
                ->orWhere('drop_end_time', 'LIKE', '%' . $query . '%')
                ->orWhere('user_name', 'LIKE', '%' . $query . '%')
                ->orWhere('buses.created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('buses.updated_at', 'LIKE', '%' . $query . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        return view('buses/viewbuses', $buses, ['value' => $query]);
    }

    public function bus_route_search(Request $request) {
        $query = $request->input('search');
        $routes['routes'] = DB::table('bus_routes')
                ->join('user_logins', 'bus_routes.created_user_id', '=', 'user_logins.user_login_id')
                ->select('bus_routes.route_to', 'user_logins.user_name', 'bus_routes.bus_route_id', 'bus_routes.route_from', 'bus_routes.status', 'bus_routes.created_user_id', 'bus_routes.updated_at', 'bus_routes.created_at')
                ->where('bus_route_id', 'LIKE', '%' . $query . '%')
                ->orWhere('route_from', 'LIKE', '%' . $query . '%')
                ->orWhere('user_name', 'LIKE', '%' . $query . '%')
                ->orWhere('route_to', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_routes.created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_routes.updated_at', 'LIKE', '%' . $query . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        return view('busroute/view_bus_routes', $routes, ['value' => $query]);
    }

    public function bus_stop_search(Request $request) {
        $query = $request->input('search');
        $stops['stops'] = DB::table('bus_stops')
                ->leftJoin('bus_routes', 'bus_routes.bus_route_id', '=', 'bus_stops.bus_route_id')
                ->leftJoin('user_logins', 'bus_stops.created_user_id', '=', 'user_logins.user_login_id')
                ->select('bus_stops.bus_stop_id', 'bus_stops.bus_stop_name', 'bus_stops.pickup_time', 'bus_stops.drop_time', 'bus_stops.bus_route_id', 'bus_stops.status', 'bus_stops.created_user_id', 'bus_stops.created_at', 'bus_stops.updated_at', 'bus_routes.route_from', 'bus_routes.route_to', 'bus_routes.bus_route_id', 'user_logins.user_name')
                ->where('bus_stop_id', 'LIKE', '%' . $query . '%')
                ->orWhere('route_from', 'LIKE', '%' . $query . '%')
                ->orWhere('user_name', 'LIKE', '%' . $query . '%')
                ->orWhere('route_to', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_stop_name', 'LIKE', '%' . $query . '%')
                ->orWhere('pickup_time', 'LIKE', '%' . $query . '%')
                ->orWhere('drop_time', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_stops.created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_stops.updated_at', 'LIKE', '%' . $query . '%')
                ->orderBy('bus_stop_name', 'ASC')
                ->paginate(10);
        return view('busstop/view_bus_stops', $stops, ['value' => $query]);
    }

    public function bus_driver_search(Request $request) {
        $query = $request->input('search');
        $drivers['drivers'] = DB::table('bus_drivers')
                ->leftJoin('user_logins', 'user_logins.user_login_id', '=', 'bus_drivers.created_user_id')
                ->select('bus_drivers.bus_driver_id', 'bus_drivers.experience', 'user_logins.user_name', 'bus_drivers.first_name', 'bus_drivers.last_name', 'bus_drivers.contact_number', 'bus_drivers.address', 'bus_drivers.profile_pic', 'bus_drivers.created_at', 'bus_drivers.created_user_id')
                ->where('bus_driver_id', 'LIKE', '%' . $query . '%')
                ->orWhere('first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                ->orWhere('contact_number', 'LIKE', '%' . $query . '%')
                ->orWhere('address', 'LIKE', '%' . $query . '%')
                ->orWhere('user_name', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_drivers.created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('bus_drivers.updated_at', 'LIKE', '%' . $query . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        return view('busdriver/view_drivers', $drivers, ['value' => $query]);
    }

    public function academic_year_search(Request $request) {
        $query = $request->input('search');
        $years['years'] = DB::table('academic_years')
                ->join('user_logins', 'academic_years.created_user_id', '=', 'user_logins.user_login_id')
                ->select('academic_years.academic_year_id', 'user_logins.user_name', 'academic_years.from_date', 'academic_years.to_date', 'academic_years.created_at')
                ->where('academic_years.academic_year_id', 'LIKE', '%' . $query . '%')
                ->orWhere('academic_years.from_date', 'LIKE', '%' . $query . '%')
                ->orWhere('academic_years.to_date', 'LIKE', '%' . $query . '%')
                ->orWhere('user_logins.user_name', 'LIKE', '%' . $query . '%')
                ->orWhere('academic_years.created_at', 'LIKE', '%' . $query . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        return view('acadamicyear/view_academic_year', $years, ['value' => $query]);
    }

    public function fee_types_search(Request $request) {
        $query = $request->input('search');
        $feetypes['feetypes'] = DB::table('fee_types')
                ->join('user_logins', 'fee_types.created_user_id', '=', 'user_logins.user_login_id')
                ->select('fee_types.fee_type_id', 'user_logins.user_name', 'fee_types.fee_name', 'fee_types.fee_status', 'fee_types.created_at')
                ->where('fee_types.fee_type_id', 'LIKE', '%' . $query . '%')
                ->orWhere('fee_types.fee_name', 'LIKE', '%' . $query . '%')
                ->orWhere('user_logins.user_name', 'LIKE', '%' . $query . '%')
                ->orWhere('fee_types.fee_status', 'LIKE', '%' . $query . '%')
                ->orWhere('fee_types.created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('fee_types.updated_at', 'LIKE', '%' . $query . '%')
                ->paginate(10);
        return view('feetypes/view_fee_types', $feetypes, ['value' => $query]);
    }

}
