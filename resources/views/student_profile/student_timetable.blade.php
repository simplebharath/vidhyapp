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
                    <li class="active"><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li ><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li ><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
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
                                    <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Timetable : {{$students[0]->classes->class_name }} @if($students[0]->section_id > 0) - {{ $students[0]->sections->section_name}}@endif </h2>                                    
                                </header>		
                                <div>
                                    <div class="widget-body no-padding">
                                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                            <thead> 
                                                <tr>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Day" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Period" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Subject" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Start" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control"  placeholder="End" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control"  placeholder="Duration" />
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th data-sortable="true">Day</th>
                                                    <th data-sortable="true">Period</th>
                                                    <th data-sortable="true">Subject</th>
                                                    <th data-sortable="true">Start</th>
                                                    <th data-sortable="true">End</th> 
                                                    <th data-sortable="true">Duration</th> 
                                                </tr>
                                            </thead>
                                            <tbody>                                     
                                                @foreach ($class_subjects as $class_subject)                                                                              
                                                <tr class="">      
                                                    <td>{{$class_subject->days->day_title}}</td>
                                                    <td>{{ $class_subject->timings->title }}</td>
                                                    <td>{{$class_subject->subjects->subject_name}}</td>                   
                                                    <td> {{ $class_subject->timings->class_start }} </td>
                                                    <td>{{ $class_subject->timings->class_end }} </td>
                                                    <td>{{ $class_subject->timings->duration }}</td>
                                                </tr>
                                                @endforeach
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
