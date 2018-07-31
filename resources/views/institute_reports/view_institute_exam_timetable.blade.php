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
                        <h2>View students exam Timetable</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                         -->
                          <form class="form-horizontal" action="{{url('view-institute-exam-timetable-pdf/2')}}" enctype="multipart/form-data" method="GET">
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
                         <form class="form-horizontal" action="{{url('view-institute-exam-timetable-pdf/1')}}" target="_blank" enctype="multipart/form-data" method="GET">
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
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-institute-students-marks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-pencil-square"></i>  Marks</a>
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
                                            <form class="form-horizontal" action="{{url('view-institute-exam-timetable')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="exam_id[]" multiple=""  class="">
                                                   
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
                                                        <span class="bigger-110">Get Timetable</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-exam-timetable')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>

                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Exam " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:9%">
                                                <input type="text" class="form-control" placeholder="Subjects" />
                                            </th>
                                            <th class="hasinput" style="width:11%">
                                                <input type="text" class="form-control" data-provide="datepicker" placeholder="Exam date" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Timings" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Marks" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Syllabus" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Exam</th>
                                            <th data-sortable="true">Class </th>
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Exam date</th>
                                            <th data-sortable="true">Timings</th>
                                            <th data-sortable="true">Marks</th>
                                            <th data-sortable="true">Syllabus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($schedule_exams as $schedule_exam) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$schedule_exam->exams->title}}</td>
                                                <td>{{$schedule_exam->class_sections->classes->class_name}}   @if(($schedule_exam->section_id) != '0') - {{$schedule_exam->class_sections->sections->section_name}}@endif </td>
                                                <td>{{$schedule_exam->subjects->subject_name}}</td>
                                                <td>{{$schedule_exam->exam_date}}</td>
                                                <td> {{$schedule_exam->exams_start_time}} - {{$schedule_exam->exams_end_time}} <br>{{$schedule_exam->exam_duration}}</td>
                                                
                                                <td> MAX : {{$schedule_exam->max_marks}}<br> Pass : {{$schedule_exam->pass_marks}}</td>
                                                <td>{{$schedule_exam->exam_syllabus}}</td> 
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
