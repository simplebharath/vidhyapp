@include('include.header')
@include('include.navigationbar')
<style>
    select[multiple]{
        min-width:130px !important;
    }
</style>
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Reports</li><li>Student Attendance</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-institute-classes')}}">Classes</a></li> 
                <li><a href="{{url ('view-institute-students')}}">Students</a></li> 
                <li><a href="{{url ('view-institute-timetable')}}">Class Timetable</a></li> 
                <li><a href="{{url ('view-institute-fees')}}">Class Fees</a></li> 
                <li><a href="{{url ('view-institute-transport-fees')}}">Transport Fee</a></li> 
                <li class="active"><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                <li><a href="{{url ('view-institute-students-marks')}}">Exams</a></li>
                <!--                 <li><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
                -->
                <li><a href="{{url ('view-institute-staff')}}">Staff</a></li>
                <li><a href="{{url ('view-institute-staff-attendance')}}">Staff Attendance</a></li>
                <li><a href="{{url ('view-institute-staff-salary')}}">Staff Salary</a></li>

            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>VIew students Attendance</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                        -->     <form class="form-horizontal" action="{{url('view-institute-student-attendance-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 

                            @if($class_id !="")
                            @foreach($class_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                            @if($from_date !="")
                            <input type="hidden" name="from_date" value="{{$from_date}}">
                            @endif
                            @if($attendance_type[0]->id ==2 )
                            @if($subject_id !="")
                            @foreach($subject_id as $subject)
                            <input type="hidden" name="subject_id[]" value="{{$subject}}">
                            @endforeach
                            @endif
                            @endif
                            @if($to_date !="")
                            <input type="hidden" name="to_date" value="{{$to_date}}">
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                        <form class="form-horizontal" target="_blank" action="{{url('view-institute-student-attendance-pdf/1')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 

                            @if($class_id !="")
                            @foreach($class_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                            @if($from_date !="")
                            <input type="hidden" name="from_date" value="{{$from_date}}">
                            @endif
                            @if($attendance_type[0]->id ==2 )
                            @if($subject_id !="")
                            @foreach($subject_id as $subject)
                            <input type="hidden" name="subject_id[]" value="{{$subject}}">
                            @endforeach
                            @endif
                            @endif
                            @if($to_date !="")
                            <input type="hidden" name="to_date" value="{{$to_date}}">
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</button>
                        </form>
                    </header>
                    <div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <div class="col-sm-12"><br>                                         
                                        <div class="row" id="">
                                            <label class="col-sm-1"> </label>


                                            <form class="form-horizontal" action="{{url('view-institute-students-attendance')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id[]" multiple=""  class="">
                                                        <option value="">--- Select class(es)---</option> 
                                                        @foreach($class_sections as $class_section)
                                                        <option value="{{$class_section->id}}" <?php
                                                        if ($class_id != '') {
                                                            foreach ($class_id as $class_i) {
                                                                if ($class_i == $class_section->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?> >{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        @endforeach
                                                    </select>                                          
                                                </div>
                                                  @if($attendance_type[0]->id ==2 )
                                                <div class="col-sm-2">
                                                    <select  name="subject_id[]" multiple=""   class="">
                                                        <option value="">--- Select subject---</option> 
                                                        @foreach($subjects as $subject)
                                                        <option value="{{$subject->subjects->id}}" <?php
                                                        if ($subject_id != '') {
                                                            foreach ($subject_id as $subject_i) {
                                                                if ($subject_i == $subject->subject_id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $subject->subjects->subject_name }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                  @endif
                                                <div class="col-sm-2">
                                                    <input type="text" data-provide="datepicker" placeholder="From date" @if($from_date !='') value="{{$from_date}}" @endif name="from_date">                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" data-provide="datepicker" placeholder="To date"  @if($to_date !='') value="{{$to_date}}" @endif name="to_date">                                 
                                                </div>

                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Attendance</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-students-attendance')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            @if($attendance_type[0]->id ==2 )
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Subject" />
                                            </th>
                                            @endif
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="student name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" data-provide="datepicker"  class="form-control" placeholder="Select date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Attendance" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="reason" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>   
                                            <th data-sortable="true"> Class</th>  
                                            @if($attendance_type[0]->id ==2 )
                                            <th data-sortable="true">Subject</th>
                                            @endif
                                            <th data-sortable="true">Student name</th>         
                                            <th >Date</th>
                                            <th >Attendance</th>
                                            <th >Reason</th>

                                        </tr>
                                    </thead>
                                    <tbody>                                     
                                        <?php
                                        $i = 1;
                                        foreach ($student_attendances as $student_attendance) {
                                            ?>                                                                           
                                            <tr class="">
                                                <td>{{$i}}</td>
                                                <td> {{$student_attendance->class_sections->classes->class_name}} @if($student_attendance->class_sections->section_id > 0) - {{ $student_attendance->class_sections->sections->section_name}} @endif </td>
                                                @if($attendance_type[0]->id ==2 )
                                                <td>@if($student_attendance->subject_id >0) {{$student_attendance->subjects->subject_name}} @endif</td>
                                                @endif
                                                <td><a href="{{url('view-student-attendance/'.$student_attendance->student_id)}}"> {{$student_attendance->students->first_name}} {{$student_attendance->students->last_name}} </a></td>                                               
                                                <td> {{  date("d-m-Y", strtotime($student_attendance->attendance_date))}}</td>
                                                <td>  @if($student_attendance->attendance_status == 1) Present @else Absent @endif </td>
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

            </article>
        </div>
    </div>
</div>
@include('include.footer')
