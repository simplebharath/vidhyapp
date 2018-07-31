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
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li ><a href="{{url ('view-students-attendance')}}">Attendance</a></li>
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>

            </ul>
        </div><br>
        @endif
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li><a href="{{url ('view-student-profile/'.$students[0]->id)}}">Profile</a></li>
                    <li ><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li ><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li ><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                    <li><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                    <li><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
                    <li><a href="{{url ('view-student-assignments/'.$students[0]->id)}}">Assignments</a></li>
                    <li><a href="{{url ('view-student-remarks/'.$students[0]->id)}}">Remarks</a></li>
                    <li class="active"><a href="{{url ('view-student-exams/'.$students[0]->id)}}">Marks</a></li>
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
                                    <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Timetable : {{$students[0]->classes->class_name }} @if($students[0]->section_id > 0) - {{ $students[0]->sections->section_name}}@endif </h2>                                    
                                </header>		
                                <div>
                                    <div class="widget-body no-padding">
                                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                            <thead> 
                                                <tr>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Exam" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Start On" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="End On" />
                                                    </th>
                                                     <th class="hasinput" style="width:10%">
                                                         <input type="text"  readonly="" class="form-control" placeholder="View" />
                                                    </th>



                                                </tr>
                                                <tr>
                                                    <th data-sortable="true">Exam</th>
                                                    <th data-sortable="true">Start </th>
                                                    <th data-sortable="true">End</th>
                                                     <th data-sortable="true">View</th>


                                                </tr>
                                            </thead>
                                            <tbody>                     
                                                
                                                <?php foreach ($exams as $exam)  {
                                                    $current_time = \Carbon\Carbon::now()->toDateTimeString();
                                                    $current_date = date("Y-m-d", strtotime($current_time));
                                                    $end=date("Y-m-d", strtotime($exam->exams_end_date));
                                                    ?>                                                                        
                                                <tr class="">      
                                                    <td><a href="{{url('view-student-exam-timetable/'.$exam->id.'/'.$students[0]->id)}}">{{$exam->title}}</a></td>
                                                    <td>{{$exam->exams_start_date}}</td>
                                                    <td>{{$exam->exams_end_date}}</td>
                                                   <?php if($current_date < $end) {?>
                                                    <td><a class="btn btn-xs btn-info" href="{{url('view-student-exam-timetable/'.$exam->id.'/'.$students[0]->id)}}">Timetable</a></td>
                                                   <?php }else { ?>
                                                    <td>   <a class="btn btn-xs btn-info" href="{{url('view-student-marks/'.$exam->id.'/'.$students[0]->id)}}">Marks</a></td>
                                                   <?php }?>
                                                </tr>
                                                <?php } ?>
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
