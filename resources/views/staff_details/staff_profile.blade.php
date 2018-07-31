@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Staff</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li>    
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        @endif
        <div class="row">
            @include('include.messages')
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><a href="{{url ('view-staff-profile/'.$staffs[0]->id)}}">Profile</a></li>
                    <li><a href="{{url ('view-staff-experiences/'.$staffs[0]->id)}}">Experience</a></li>
                    <li ><a href="{{url ('view-staff-qualifications/'.$staffs[0]->id)}}">Qualifications</a></li> 
                    <li ><a href="{{url ('view-staff-documents/'.$staffs[0]->id)}}">Documents</a></li> 
             @if(Session::get('user_type_id') == 4)  <li><a href="{{url ('view-staff-timetable/'.$staffs[0]->id)}}">Timetable</a></li> @endif
                    <li><a href="{{url ('view-staff-total-attendance/'.$staffs[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-staff-salary/'.$staffs[0]->id)}}">Salary</a></li>
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="well well-light well-sm no-margin no-padding">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img src="{{URL::asset('uploads/staff/'.$staffs[0]->photo)}}"  alt="" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="70" width="70">
                                                <div class="padding-10">
                                                    @if($no_classes != 0)   <h6 class="font-md"><strong>{{$no_classes}}</strong>
                                                        <br>
                                                        <small>Classes</small></h6>@endif
                                                </div>
                                            </div>

                                            <div class="col-sm-9">
                                                <h2 style="padding-left: 0px;"> <span class="semi-bold">{{$staffs[0]->first_name}} {{$staffs[0]->last_name}} </span>
                                                    <br>
                                                    <small>@if($staffs[0]->emp_designation != '') {{ $staffs[0]->emp_designation }} - @endif {{$staffs[0]->departments->title}}</small>
                                                </h2>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <a href="{{url('edit-staff/'.$staffs[0]->id)}}" title="Edit profile" class="btn txt-color-white bg-color-teal btn-xs"><i class="fa fa-edit"></i>  </a>
                                                <a href="{{url('view-staff')}}" title="View all staff" class="btn txt-color-white bg-color-pinkDark btn-xs"><i class="fa fa-eye"></i>  </a>

                                                @endif
                                                <a href="{{url('staff-summary-pdf/'.$staffs[0]->id)}}" title="Download report"
                                                   class="btn txt-color-white bg-color-blueDark btn-xs" ><i class="glyphicon glyphicon-download-alt"></i> </a>
                                                <a href="{{url('staff-summary-print/'.$staffs[0]->id)}}" target="_blank" title="Print report" 
                                                   class="btn txt-color-white bg-color-redLight btn-xs"><i class="glyphicon glyphicon-print"></i> </a>
                                                @if($staffs[0]->email !="") <a href="{{url('staff-summary-email/'.$staffs[0]->id)}}" title="Email report" class="btn txt-color-white bg-color-green btn-xs"><i class="glyphicon glyphicon-envelope"></i> </a> @endif

                                                <ul class="list-unstyled">
                                                    <br>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$staffs[0]->contact_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$staffs[0]->emergency_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-mail-forward"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$staffs[0]->email}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                                        </p>
                                                    </li>

                                                    <li>
                                                        <p class="text-muted">
                                                            <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Birth date <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Create an Appointment">{{$staffs[0]->date_of_birth}}</a></span>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <br>
                                                <p class="font-md">
                                                    <i>Present address</i>
                                                </p>
                                                <p>{{$staffs[0]->present_address}}</p>
                                                <br>
                                                <p>

                                                <p class="font-md"> Rights </p>
                                                <ul class="list-inline friends-list form-inline">
                                                    <li>Add : @if($staffs[0]->add_rights == 1 ) Yes @else No @endif</li>
                                                    <li>View : @if($staffs[0]->view_rights == 1 ) Yes @else No @endif</li>
                                                    <li>Edit : @if($staffs[0]->edit_rights == 1 ) Yes @else No @endif</li>
                                                    <li>Delete : @if($staffs[0]->delete_rights == 1 ) Yes @else No @endif</li>
                                                </ul>

                                                </p>
                                            </div>                                            
                                        </div>
                                    </div><hr>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="padding-10">
                                            <header><p style="font-weight:300;font-size: 20px;font-family: sans-serif;">General info</p></header>
                                            <div class="tab-content padding-top-10">
                                                <div class="tab-pane fade in active" id="a1">
                                                    <table class="table table-user-information">
                                                        <tbody>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Gender</a></p></td>
                                                                <td>{{ $staffs[0]->gender}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Blood group</a></p></td>
                                                                <td>{{ $staffs[0]->blood_group}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Religion</a></p></td>
                                                                <td>{{ $staffs[0]->religion}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Caste</a></p></td>
                                                                <td>{{ $staffs[0]->caste}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Nationality</a></p></td>
                                                                <td>{{ $staffs[0]->nationality}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Marital status</a></p></td>
                                                                <td>{{ $staffs[0]->marital_status}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Spouse/Husband</a></p></td>
                                                                <td>{{ $staffs[0]->spouse_name}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Occupation</a></p></td>
                                                                <td>{{ $staffs[0]->occupation}} </td>
                                                            </tr> 
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Domicile</a></p></td>
                                                                <td>{{ $staffs[0]->domicile}} </td>
                                                            </tr> 
                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <div class="well well-light well-sm no-margin no-padding">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="padding-10">
                                            <header><p style="font-weight:300;font-size: 20px;font-family: sans-serif;">Job profile</p></header>
                                            <div class="tab-content padding-top-10">
                                                <div class="tab-pane fade in active" id="a1">
                                                    <table class="table table-user-information">
                                                        <tbody>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Academic year</a></p></td>
                                                                <td>{{ $staffs[0]->academic_years->from_date}} to {{ $staffs[0]->academic_years->to_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">User type</a></p></td>
                                                                <td>{{ $staffs[0]->user_types->title}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Staff type</a></p></td>
                                                                <td>{{ $staffs[0]->staff_types->title}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Department</a></p></td>
                                                                <td>{{ $staffs[0]->departments->title}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Designation</a></p></td>
                                                                <td>{{ $staffs[0]->emp_designation}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Joined date</a></p></td>
                                                                <td>{{ $staffs[0]->joined_date}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Employee Id</a></p></td>
                                                                <td>{{ $staffs[0]->employee_id}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Experience</a></p></td>
                                                                <td>{{ $staffs[0]->experience}} </td>
                                                            </tr>                                                               
                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="well well-light well-sm no-margin no-padding">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="padding-10">
                                            <header><p style="font-weight:300;font-size: 20px;font-family: sans-serif;">Contact Info</p></header>
                                            <div class="tab-content padding-top-10">
                                                <div class="tab-pane fade in active" id="a1">
                                                    <table class="table table-user-information">
                                                        <tbody>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Aadhaar Number</a></p></td>
                                                                <td>{{ $staffs[0]->aadhaar_number}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Father/Guardian</a></p></td>
                                                                <td>{{ $staffs[0]->father_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Mobile Number</a></p></td>
                                                                <td>{{ $staffs[0]->father_number}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Permanent address</a></p></td>
                                                                <td>{{ $staffs[0]->permanent_address}} </td>
                                                            </tr>

                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="well well-light well-sm no-margin no-padding">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="padding-10">
                                            <header><p style="font-weight:300;font-size: 20px;font-family: sans-serif;">Salary details</p></header>
                                            <div class="tab-content padding-top-10">
                                                <div class="tab-pane fade in active" id="a1">
                                                    <table class="table table-user-information">
                                                        <tbody>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Basic salary</a></p></td>
                                                                <td>{{ $staffs[0]->basic_salary}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Incentives</a></p></td>
                                                                <td>{{ $staffs[0]->incentives}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Other salary</a></p></td>
                                                                <td>{{ $staffs[0]->other_salary}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Cuttings</a></p></td>
                                                                <td>{{ $staffs[0]->salary_cuttings}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <p class="no-margin"><a href="#">Total salary</a></p></td>
                                                                <td>{{ $staffs[0]->total_salary}} </td>
                                                            </tr>

                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('include.footer')
