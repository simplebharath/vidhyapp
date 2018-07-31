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
            <li>Reports</li><li>Class Timetable</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-institute-classes')}}">Classes</a></li> 
                <li><a href="{{url ('view-institute-students')}}">Students</a></li> 
                <li  class="active"><a href="{{url ('view-institute-timetable')}}">Class Timetable</a></li> 
                <li><a href="{{url ('view-institute-fees')}}">Class Fees</a></li> 
                 <li><a href="{{url ('view-institute-transport-fees')}}">Transport Fee</a></li> 
                 <li><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
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
                        <h2>View Timetable </h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                           -->
                  <form class="form-horizontal" action="{{url('view-institute-timetable-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            
                            @if($class_id !="")
                            @foreach($class_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                             @if($day_id !="")
                            @foreach($day_id as $day)
                            <input type="hidden" name="day_id[]" value="{{$day}}">
                            @endforeach
                            @endif
                             @if($subject_id !="")
                            @foreach($subject_id as $subject)
                            <input type="hidden" name="subject_id[]" value="{{$subject}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                           <form class="form-horizontal" action="{{url('view-institute-timetable-pdf/1')}}" target="_blank" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            
                            @if($class_id !="")
                            @foreach($class_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                             @if($day_id !="")
                            @foreach($day_id as $day)
                            <input type="hidden" name="day_id[]" value="{{$day}}">
                            @endforeach
                            @endif
                             @if($subject_id !="")
                            @foreach($subject_id as $subject)
                            <input type="hidden" name="subject_id[]" value="{{$subject}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</button>
                        </form>
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
                                            <form class="form-horizontal" action="{{url('view-institute-timetable')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id[]" multiple=""  class="">
                                                        <option value="">--- Select class---</option> 
                                                        @foreach($class_sections as $class_section)
                                                        <option value="{{$class_section->id}}" <?php
                                                        if ($class_id != '') {
                                                            foreach ($class_id as $class_i) {
                                                                if ($class_i == $class_section->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                                <div class="col-sm-2">
                                                    <select  name="day_id[]" multiple=""   class="">
                                                        <option value="">--- Select day---</option> 
                                                        @foreach($days as $day)
                                                        <option value="{{$day->days->id}}" <?php
                                                        if ($day_id != '') {
                                                            foreach ($day_id as $day_i) {
                                                                if ($day_i == $day->day_id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?> >{{ $day->days->day_title }} </option>
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
                                                    <a href="{{url('view-institute-timetable')}}" class="width-10 btn btn-md btn-info">
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
                                                <input type="text"  class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Subject" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Day" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Period" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Start - End" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Duration" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Staff" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control"  placeholder="Image" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No.</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Day</th>
                                            <th data-sortable="true">Period</th>
                                            <th data-sortable="true">Start-End</th>
                                            <th data-sortable="true">Duration</th> 
                                            <th data-sortable="true">Staff</th>
                                            <th data-sortable="true">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                     
                                        <?php
                                        $i = 1;
                                        foreach ($class_subjects as $class_subject) {
                                            ?>                                                                         
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td>{{ $class_subject->classes->class_name }}@if($class_subject->section_id >0) {{ $class_subject->sections->section_name }} @endif</td>
                                                <td>{{$class_subject->subjects->subject_name}}</td>  
                                                <td>{{$class_subject->days->day_title}}</td>
                                                <td>{{ $class_subject->timings->title }}</td>
                                                <td> {{ $class_subject->timings->class_start }} - {{ $class_subject->timings->class_end }} </td>
                                                <td>{{ $class_subject->timings->duration }}</td>
                                                <td>@if($class_subject->staff_id !=0)<a href="{{url('view-staff-timetable/'.$class_subject->staff_id)}}">{{$class_subject->staffs->first_name}} {{$class_subject->staffs->last_name}}</a> <br>Dep : {{$class_subject->staffs->departments->title}}   @else Not Assigned @endif</td>
                                                <td>@if($class_subject->staff_id ==0) - @else<a href="{{url('view-staff-timetable/'.$class_subject->staff_id)}}"> <img src="{{URL::asset('uploads/staff/'.$class_subject->staffs->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="40" width="40"></a> @endif</td>
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
                <div style="float: right;">
                </div>              
            </article>
        </div>
    </div>
</div>
@include('include.footer')
