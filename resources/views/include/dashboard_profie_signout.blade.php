<link rel="stylesheet" href="{{ URL::asset('assets/css/header_custom.css') }}">
@if((Session::get('user_type_id')==1) || (Session::get('user_type_id')==2))
<?php if (Session::has('user')) { ?>
    <div class="col-md-5 ">
        <div class="form-group" style="padding-top: 9px;">
            <form  role="form" method="GET"  action="{{ url('dashboard-search')}}">
                {{ csrf_field() }}
                <div class="form-group-lg">
                    <input type="text" style="height:33px;font-size:10pt;"  id="form-field-1" placeholder="Search Students by any detail of the student" name="search" value="<?php
                    if (null !== (filter_input(INPUT_GET, 'search'))) {
                        echo $value;
                    }
                    ?>" class="col-md-8" />
                </div>

                <button class="btn btn-info btn-sm " id="main-search"  type="submit" >
                    <i class="glyphicon glyphicon-search"></i>
                   
                </button>

                <a href="{{ url('admin-dashboard')}}" class="btn btn-info btn-sm ">
                        <i class="glyphicon glyphicon-refresh"></i>
                       
                    </a>
            </form>
        </div> <?php } ?>
    </div> 
@endif
<?php $years=  App\Academic_year::get(); ?>
@if(Session::get('user_type_id')==1)
<div class="form-group col-md-2" style="margin-top: 11px;">
    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
    <select name="academic_year_id" id="academic_year_session">
         @foreach($years as $year)
         <option value="{{$year->id}}" id="{{$year->id}}"  @if($year->id == Session::get('academic_year_id')) selected @endif>{{date('Y', strtotime($year->from_date))}} - {{date('Y', strtotime($year->to_date))}}</option>
         @endforeach
     </select>
</div>
@endif
<div class="pull-right col-md-2">
    <div class="login-info">

        <div class="dropdown">
            @if(Session::has('user_id'))
            <a class="account" style="font-size: 12px;"><img src='{{ asset('uploads/users/'. Session::get('user_profile_pic_name')) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'"  class="img-rounded" height="60" width="60" style="margin-top: 5px;" />
                @elseif(Session::has('parent_id') && Session::has('student_id'))
                <a class="account" style="font-size: 12px;"><img src='{{ asset('uploads/students/father/'. Session::get('user_profile_pic_name')) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'"  class="img-rounded" height="60" width="60" style="margin-top: 5px;" />              
                    @elseif(Session::has('student_id'))
                    <a class="account" style="font-size: 12px;"><img src='{{ asset('uploads/students/profile_photos/'. Session::get('user_profile_pic_name')) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'"  class="img-rounded" height="60" width="60" style="margin-top: 5px;" /> 
                        @elseif(Session::has('staff_id'))
                        <a class="account" style="font-size: 12px;"><img src='{{ asset('uploads/staff/'. Session::get('user_profile_pic_name')) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'"  class="img-rounded" height="60" width="60" style="margin-top: 5px;" /> 
                            @endif
                            @if(Session::has('username'))
                            {{ Session::get('username') }} <i class="fa fa-angle-down" aria-hidden="true"></i>

                            @else
                            <script type="text/javascript">
                                window.location = "{{ url('/') }}";//here double curly bracket
                            </script>

                            @endif
                        </a>

                        <div class="submenu">
                            <ul class="root">

                                <li><span> <a href="{{ url('admin-logout') }}" ><span class="iconbox"> <i class="fa fa-sign-out"></i> <span>Logout</span> </span></a></li>

                            </ul>

                        </div>
                        <i class="fa fa-angle-down"></i>
                        </div>
                        </div>
                        </div>
                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
                        <script type="text/javascript" src="{{ URL::asset('assets/js/header_custom.js') }}"></script>