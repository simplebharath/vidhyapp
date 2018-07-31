@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active" ><a href="{{url ('view-students')}}">Students</a></li> 
                <li ><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        @endif
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li><a href="{{url ('view-student-profile/'.$students[0]->id)}}">Profile</a></li>
                    <li><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li class="active"><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
                     <li ><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                      <li><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                     <li><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
                     <li><a href="{{url ('view-student-assignments/'.$students[0]->id)}}">Assignments</a></li>
                    <li><a href="{{url ('view-student-remarks/'.$students[0]->id)}}">Remarks</a></li>
                    <li><a href="{{url ('view-student-exams/'.$students[0]->id)}}">Marks</a></li>
                    @if($students[0]->student_type_id == 1)
                    <li><a href="{{url ('view-student-transport/'.$students[0]->route_id.'/'.$students[0]->stop_id.'/'.$students[0]->id)}}">Transport</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            @include('student_profile.include_profile')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                    <h2> View <b> {{$students[0]->first_name}} {{ $students[0]->last_name }}</b> Attendance of Month <b>{{ $month }} - {{ $year }}</b> </h2>    
                                    <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-student-attendance/'.$students[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i>  Back </a>
                                </header>		
                                <div>
                                    <div class="widget-body no-padding">
                                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">				
                                            <thead>
                                                <tr>
                                                    <th class="hasinput" style="width:5%">
                                                        <input type="text" class="form-control" placeholder="S No" />
                                                    </th>
                                                    @if($attendance_type[0]->id == 2)
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Subject" />
                                                    </th>
                                                    @endif
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Day" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" data-provide="datepicker" class="form-control" placeholder="Select date" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Attendance" />
                                                    </th>
                                                    <th class="hasinput" style="width:16%">
                                                        <input type="text" class="form-control" placeholder="Reason" />
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th>S No</th>
                                                    @if($attendance_type[0]->id == 2) <th>Subject</th> @endif
                                                    <th data-class="expand">Day</th>
                                                    <th>Date</th>
                                                    <th data-hide="phone">Attendance</th>
                                                    <th data-hide="phone">Reason</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($student_attendances as $student_attendance) {
                                                    ?>
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        @if($attendance_type[0]->id == 2) <td>@if($student_attendance->subject_id > 0)<a href="{{url('view-student-subject-attendance/'.$month.'/'.$students[0]->id.'/'.$student_attendance->subject_id)}}">{{$student_attendance->subject_name}}</a>@endif</td> @endif
                                                        <td>{{$student_attendance->day}}</td>
                                                        <td>{{$student_attendance->date}}</td>
                                                        <td>@if($student_attendance->attendance_status == 1)Present @else Absent @endif</td>
                                                        <td>{{$student_attendance->reason}}</td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
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
