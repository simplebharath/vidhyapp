@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Student</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                 <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        <div class="row">
              
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><a href="{{url ('view-staff-profile/'.$staffs[0]->id)}}">Profile</a></li>
                    <li><a href="{{url ('view-staff-experiences/'.$staffs[0]->id)}}">Experience</a></li>
                    <li ><a href="{{url ('view-staff-qualifications/'.$staffs[0]->id)}}">Qualifications</a></li> 
                    <li ><a href="{{url ('view-staff-documents/'.$staffs[0]->id)}}">Documents</a></li> 
                    <li><a href="{{url ('view-staff-attendance/'.$staffs[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-staff-salary/'.$staffs[0]->id)}}">Salary</a></li>
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                             @include('student_profile.include_profile')
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
                                                                <td>{{ $staffs[0]->designation}}</td>
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
                                                                <td> <p class="no-margin"><a href="#">Unique identity number</a></p></td>
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
