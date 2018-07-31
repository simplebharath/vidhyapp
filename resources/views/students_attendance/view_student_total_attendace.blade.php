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
                                    <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Attendance </h2>                                    
                                </header>		
                                <div>
                                    <div class="widget-body no-padding">
                                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">				
                                            <thead>
                                                <tr>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="S No" />
                                                    </th>
                                                     @if($attendance_type[0]->id == 2)
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Subject" />
                                                    </th>
                                                    @endif
                                                    <th class="hasinput" style="width:18%">
                                                        <input type="text" class="form-control" placeholder="Month" />
                                                    </th>
                                                    <th class="hasinput" style="width:16%">
                                                        <input type="text" class="form-control" placeholder="Working days" />
                                                    </th>
                                                    <th class="hasinput" style="width:16%">
                                                        <input type="text" class="form-control" placeholder="Present" />
                                                    </th>
                                                    <th class="hasinput" style="width:16%">
                                                        <input type="text" class="form-control" placeholder="Absent" />
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th>S No</th>
                                                    @if($attendance_type[0]->id == 2) <th>Subject</th> @endif 
                                                    <th data-class="expand"> Month</th>
                                                    <th>Working days</th>
                                                    <th data-hide="phone">Present</th>
                                                    <th data-hide="phone">Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                  $total = 0;
                    $present = 0;
                    $absent = 0;
                                                foreach ($student_attendances as $student_attendance) {
                                                     if (is_numeric($student_attendance->working_days)) {
                            $total+= $student_attendance->working_days;
                            $present+= $student_attendance->present;
                            $absent+= ($student_attendance->working_days - $student_attendance->present);
                        }
                                                    ?>
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        @if($attendance_type[0]->id == 2) <td><a href="{{url('view-student-subject-attendance/'.$student_attendance->month.'/'.$students[0]->id.'/'.$student_attendance->subject_id)}}">{{$student_attendance->subject_name}}</a></td> @endif
                                                        <td><span class=""><a  @if($attendance_type[0]->id == 1) href="{{url('view-student-monthly-attendance/'.$student_attendance->month.'/'.$student_attendance->student_id)}}" @endif>{{$student_attendance->month}} - {{$student_attendance->year}}</a></span></td>
                                                        <td>{{$student_attendance->working_days}}</td>
                                                        <td>{{$student_attendance->present}}</td>
                                                        <td>{{$student_attendance->working_days - $student_attendance->present}}</td>
                                                    </tr>
                                                    <?php $i++;
                                                }
                                                ?>
                                                     @if($total != 0 )
                                                     <tr><td><p class="hidden">100</p></td> @if($attendance_type[0]->id == 2) <td></td> @endif <td><b>Total (  {{ number_format((($present/$total)*100),2) }} &#37; )</b></td><td><b>{{$total}}</b></td><td><b>{{$present}}</b></td>
                    <td> <b>{{$absent}} </b></td></tr>
                @endif
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
