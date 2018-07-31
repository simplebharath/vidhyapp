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
            <li>Reports</li><li>Students Marks</li>
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
                <li><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                <li  class="active"><a href="{{url ('view-institute-students-marks')}}">Exams</a></li>
<!--                <li><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
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
                        <h2>View students exam marks</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                     -->    
                       <form class="form-horizontal" action="{{url('view-institute-student-marks-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            
                            @if($classes_id !="")
                            @foreach($classes_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                             @if($exam_id !="")
                            @foreach($exam_id as $exam)
                            <input type="hidden" name="exam_id[]" value="{{$exam}}">
                            @endforeach
                            @endif
                             @if($subject_id !="")
                            @foreach($subject_id as $subject)
                            <input type="hidden" name="subject_id[]" value="{{$subject}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                     <form class="form-horizontal" action="{{url('view-institute-student-marks-pdf/1')}}" target="_blank" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            
                            @if($classes_id !="")
                            @foreach($classes_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                             @if($exam_id !="")
                            @foreach($exam_id as $exam)
                            <input type="hidden" name="exam_id[]" value="{{$exam}}">
                            @endforeach
                            @endif
                             @if($subject_id !="")
                            @foreach($subject_id as $subject)
                            <input type="hidden" name="subject_id[]" value="{{$subject}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</button>
                        </form>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-institute-exam-timetable')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-calendar"></i>  Timetable</a>
                    </header>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">

                                    <div class="col-sm-12"><br>                                         
                                        <div class="row" id="">
                                            <label class="col-sm-1"> </label>
                                            <div class="col-sm-2">

                                            </div>
                                            <form class="form-horizontal" action="{{url('view-institute-students-marks')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="exam_id[]" multiple=""  class="">
                                                        <option value="">--- Select exam---</option> 
                                                        @foreach($exams as $exam)
                                                        <option value="{{$exam->id}}" <?php
                                                        if ($exam_id != '') {
                                                            foreach ($exam_id as $exam_i) {
                                                                if ($exam_i == $exam->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $exam->title }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id[]" multiple=""  class="">
                                                        <option value="">--- Select class---</option> 
                                                        @foreach($class_sections as $class_section)
                                                        <option value="{{$class_section->id}}" <?php
                                                        if ($classes_id != '') {
                                                            foreach ($classes_id as $classes_i) {
                                                                if ($classes_i == $class_section->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="subject_id[]" multiple="" class="">
                                                        <option value="">--- Select subject---</option> 
                                                        @foreach($subjects as $subject)
                                                        <option value="{{$subject->id}}" <?php
                                                        if ($subject_id != '') {
                                                            foreach ($subject_id as $subject_i) {
                                                                if ($subject_i == $subject->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $subject->subject_name }}  </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Marks</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-students-marks')}}" class="width-10 btn btn-md btn-info">
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
                                                <input type="text" class="form-control" placeholder="Class Roll No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>

                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Image" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Exam" />
                                            </th> 
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Subject" />
                                            </th> 
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Min/Max Marks" />
                                            </th> 
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Secured Marks" />
                                            </th> 
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Class -ROll No</th>   
                                            <th data-sortable="true"> Student</th>                                        
                                            <th data-sortable="true">Image</th>  
                                            <th data-sortable="true">Exam</th>
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Min/Max Marks</th>
                                            <th data-sortable="true">Secured Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($marks as $mark) {
                                            ?> 
                                            <tr class="">
                                               
                                                <td> 
                                                     {{ $mark->students->classes->class_name }}  @if(($mark->students->section_id) > 0)  -  {{ $mark->students->sections->section_name}}  @endif
                                                     - <a href="{{url('view-student-exams/'.$mark->student_id)}}">{{$mark->students->roll_number}} </a></td>
                                                <td><a href="{{url('view-student-exams/'.$mark->student_id)}}">{{$mark->students->first_name}} {{$mark->students->last_name}} <br> {{$mark->students->unique_id}}</a></td>
                                                <td><a href="{{url('view-student-exams/'.$mark->student_id)}}"><img src="{{URL::asset('uploads/students/profile_photos/'.$mark->students->photo)}}"  @if($mark->students->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($mark->students->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="30" width="30"> </a> </td>
                                                <td>{{$mark->exams->title}}</td>
                                                <td>{{$mark->subjects->subject_name}} <br>( {{$mark->schedule_exams->exam_date}} ) </td>
                                                <td>Pass marks: {{$mark->schedule_exams->pass_marks}} <br> Max. marks:{{$mark->schedule_exams->max_marks}}</td>

                                                <td id="marks">
                                                    {{$mark->marks_obtained}}</td>

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
