<?php

namespace App\Http\Controllers;

use Session;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller {
    
    public function page_not_found() {

        return view('errors/pageNotFound');
    }
    public function admin_login() {

        return view('users/login');
    }

    public function update_session(Request $request) {
        $id = $request->academic_year_id;
        $request->session()->put('academic_year_id', $id);
        return ($id);
    }

    public function admin_authenticate(Request $request) {
        $user_name = $request->username;
        $password = $request->password;
        $user_logins = DB::select(DB::raw("SELECT * FROM user_logins WHERE BINARY user_name = '$user_name' && BINARY password = '$password'"));
        if (count($user_logins) == 1) {
            if ($user_logins[0]->status == 1) {
                $institute = \App\Institute_detail::limit(1)->get();
                $institute_academic_year_id = $institute[0]->academic_year_id;
                $logo = $institute[0]->institution_logo;
                $academic_year = DB::select(DB::raw("SELECT * FROM academic_years WHERE CURRENT_DATE BETWEEN from_date AND to_date AND id=$institute_academic_year_id AND status=1"));

                if ((count($academic_year) == 1)) {
                    $current = \Carbon\Carbon::now()->toDateTimeString();
                    $date = date("Y-m-d", strtotime($current));
                    $a_date = date("d-m-Y", strtotime($current));
                    $request->session()->put('new_date', $date);
                    $request->session()->put('a_date', $a_date);
                    Session::put('username', $user_name);
                    Session::put('institution_logo', $logo);
                    //Session::put('user_type_id', $user_logins[0]->user_type_id);
                    $request->session()->put('academic_year_id', $academic_year[0]->id);
                    $request->session()->put('user_login_id', $user_logins[0]->id);
                    $request->session()->put('user_type_id', $user_logins[0]->user_type_id);

                    if ($user_logins[0]->user_type_id == 1) {
                        $user_details = \App\User::where('user_login_id', $user_logins[0]->id)->get();
                        Session::put('user_profile_pic_name', $user_details[0]->photo);
                    }
                    if ($user_logins[0]->user_type_id == 5) {
                        $user_details = \App\Student::where('user_login_id', $user_logins[0]->id)->get();

                        Session::put('user_profile_pic_name', $user_details[0]->photo);
                    }
                    if ($user_logins[0]->user_type_id == 7) {
                        $user_details = \App\Parent_detail::where('user_login_id', $user_logins[0]->id)->get();
                        Session::put('user_profile_pic_name', $user_details[0]->father_photo);
                    }
                    if ($user_logins[0]->user_type_id == 9 || $user_logins[0]->user_type_id == 2 || $user_logins[0]->user_type_id == 3 || $user_logins[0]->user_type_id == 4 || $user_logins[0]->user_type_id == 6 || $user_logins[0]->user_type_id == 8) {
                        $user_details = \App\Staff::where('user_login_id', $user_logins[0]->id)->get();
                        Session::put('user_profile_pic_name', $user_details[0]->photo);
                    }
                    Session::put('user', 'Not Regisered');

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

                    $current_time = \Carbon\Carbon::now()->toDateTimeString();
                    $ua = getBrowser();
                    $yourbrowser = $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'];
                    $data = array(
                        'log_in' => $current_time,
                        'log_type' => 'Login',
                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                        'user_browser' => $yourbrowser,
                        'created_at' => $current_time,
                        'academic_year_id' => $institute[0]->academic_year_id,
                        'user_login_id' => $user_logins[0]->id);
                    DB::table('logs')->insert($data);
                    if ($user_logins[0]->user_type_id == 1) {
                        $user_details = \App\User::where('user_login_id', $user_logins[0]->id)->get();
                        $request->session()->put('user_id', $user_details[0]->id);
                        return redirect('admin-dashboard');
                    }
                    if ($user_logins[0]->user_type_id == 5) {
                        $user_details = \App\Student::where('user_login_id', $user_logins[0]->id)->get();
                        $request->session()->put('student_id', $user_details[0]->id);
                        return redirect('view-student-profile/' . $user_details[0]->id);
                    }
                    if ($user_logins[0]->user_type_id == 7) {
                        $user_details = \App\Parent_detail::where('user_login_id', $user_logins[0]->id)->get();
                        $request->session()->put('student_id', $user_details[0]->student_id);
                        $request->session()->put('parent_id', $user_details[0]->id);
                        return redirect('view-student-profile/' . $user_details[0]->student_id);
                    }
                    if ($user_logins[0]->user_type_id == 9 || $user_logins[0]->user_type_id == 2 || $user_logins[0]->user_type_id == 3 || $user_logins[0]->user_type_id == 4 || $user_logins[0]->user_type_id == 6 || $user_logins[0]->user_type_id == 8) {
                        $user_details = \App\Staff::where('user_login_id', $user_logins[0]->id)->get();
                        $request->session()->put('staff_id', $user_details[0]->id);
                        return redirect('view-staff-profile/' . $user_details[0]->id);
                    }
                } else {
                    Session::put('Not_A_user', 'Not at Regiser');
                    Session::put('institution_logo', $logo);
                    $request->session()->put('username', $user_name);
                    $request->session()->put('user_login_id', $user_logins[0]->id);
                    return redirect('settings/add-academic-year')->with(['message-warning' => 'Academic Year Expired. Please add or update academic year']);
                }
            } else {
                return redirect('admin-login')->with(['message-danger' => 'Your are not active user please contact adminstrator']);
            }
        }
        return redirect('admin-login')->with(['message-danger' => 'username or password is wrong']);
    }

    public function admin_dashboard() {
        return view('dashboard/dashboard');
    }

    public function admin_logout(Request $request) {
        if (Session::has('username')) {
            $current_time = \Carbon\Carbon::now()->toDateTimeString();
            $created_user_id = Session::get('user_login_id');

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
                'academic_year_id' => $academic_year_id = \App\Institute_detail::where('status', '1')->value('academic_year_id'),
                'user_login_id' => $created_user_id);
            DB::table('logs')->insert($data);
            $request->session()->flush();
            return redirect('admin-login');
        } else {
            $request->session()->flush();
            return redirect('admin-login');
        }
    }

}
