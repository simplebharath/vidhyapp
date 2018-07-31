@if(Session::has('user_id'))
<script type="text/javascript">
    window.location = "{{ url('admin-dashboard') }}";
</script>
@elseif(Session::has('staff_id'))
<script type="text/javascript">
    window.location = "{{ url('view-staff-profile/'.Session::get('staff_id')) }}";
</script>
@elseif(Session::has('student_id'))
<script type="text/javascript">
    window.location = "{{ url('view-student-profile/'.Session::get('student_id')) }}";
</script>
@endif
<html lang="en-us" id="extr-page">
    <head>
        <?php
        $intitute = DB::table('institute_details')->limit(1)->get();
        $logout_name = $intitute[0]->institution_name;
        $logout_logo = $intitute[0]->institution_logo;
        ?>
        <meta charset="utf-8">
        <title>@if ( $logout_name != '' ) {{$logout_name}} @else VidhyApp  @endif</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-production-plugins.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-production.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-skins.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/your_style.css') }}" />
        <link rel="shortcut icon" @if ( $logout_logo != '' )   href="{{ URL::asset('uploads/logo/'.$logout_logo)}}" @else href="{{ URL::asset('uploads/errors/900-without.png') }}" @endif type="image/x-icon">
        <link rel="icon" @if ( $logout_logo != '' )   href="{{ URL::asset('uploads/logo/'.$logout_logo)}}" @else href="{{ URL::asset('uploads/errors/900-without.png') }}" @endif type="image/x-icon">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <link rel="apple-touch-icon" href="{{ URL::asset('assets/img/splash/sptouch-icon-iphone.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets/img/splash/touch-icon-ipad.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('assets/img/splash/touch-icon-iphone-retina.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('assets/img/splash/touch-icon-ipad-retina.png') }}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)') }}">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)') }}">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)') }}">
    </head>
    <body class="animated fadeInDown">
        <div id="main" role="main">
            <div id="content" class="container">
                <div class="row">
                    @include('include.messages')
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4"></div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">  
                        
                        <div style="padding-left:80px;"><img width="200" height="150" @if ( $logout_logo != '' )   src="{{ URL::asset('uploads/logo/'.$logout_logo)}}" @else src="{{ URL::asset('uploads/logo/900-without.png')}}" @endif alt="VidhyApp" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/900-without.png') }}'"> </div>
                        <div id="" style="font-weight:500; padding-left: 10px; font-family:cursive, sans-serif;color:#053D78; font-size: 32px; text-align: center!important;">@if ( $logout_name != '' ) {{$logout_name}} @else VidhyApp  @endif </div>
                       
                            <br><br> 
                        <div class="well no-padding">

                            <form id="login-form" class="smart-form client-form" role="form" method="POST" action="{{ url('admin-authenticate') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <header style="text-align:center;">
                                    Sign In
                                </header>
                                @if(Session::has('login-error'))
                                <p  style="color: red"> {{ Session::get('login-error') }}</p>
                                @endif
                                {{ Session::forget('login-error') }}
                                <fieldset>
                                    <section>
                                        <label class="label">Username<span class="error">* </span></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="username" required>
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b></label>
                                    </section>

                                    <section>
                                        <label class="label">Password<span class="error">* </span></label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password" required>
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                    </section>
                                </fieldset>
                                <footer>
                                    <div class="row">
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                            <button type="submit" class="btn btn-primary">
                                                Sign in
                                            </button>
                                        </div>

                                        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
                                            <button type="reset" class="btn btn-primary">
                                                Reset
                                            </button>
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-sm-4 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
                                    </div>
                                </footer>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4"></div>
                </div>
            </div>
        </div>

        <!--================================================== -->	
        <script src="{{ URL::asset('assets/js/plugin/pace/pace.min.js')}}"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script> if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
    }</script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) {
        document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }</script>
        <script src="{{ URL::asset('assets/js/app.config.js')}}"></script>

        <script src="{{ URL::asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
        <script type="text/javascript">
    runAllForms();

    $(function () {
        $("#login-form").validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                }
            },
            messages: {
                username: {
                    required: 'Please enter your username'

                },
                password: {
                    required: 'Please enter your password'
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
        </script>
    </body>
</html>