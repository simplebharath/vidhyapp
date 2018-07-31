<link rel="stylesheet" href="{{ URL::asset('assets/css/header_custom.css') }}">

    <div class="pull-right col-md-2">
        <div class="login-info">
       
                    <div class="dropdown">
                        <a class="account" ><img src='{{ asset('uploads/student/'. Session::get('student_profile_pic_name')) }}'  alt="me" class="img-rounded" height="30" width="30" /> 
                            @if(Session::has('student_user_name'))
                            {{ Session::get('student_user_name') }}<span><i class="fa fa-angle-down"></i></span>
                            @else
                            <script type="text/javascript">
                                window.location = "{{ url('/') }}";//here double curly bracket
                            </script>
                            
                            @endif
                        </a>
                            
                        <div class="submenu">
                            <ul class="root">
                                
                    <li><span> <a href="{{ url('logout') }}" ><span class="iconbox"> <i class="fa fa-sign-out"></i> <span>Logout</span> </span></a></li>
                    
                            </ul>
                            
                        </div>
                        
                    </div>
                                            </div>
        </div>
<script type="text/javascript" src="{{ URL::asset('assets/js/header_custom.js') }}"></script>
