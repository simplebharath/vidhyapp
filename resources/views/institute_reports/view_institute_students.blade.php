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
            <li>Reports</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-institute-classes')}}">Classes</a></li> 
                <li class="active"><a href="{{url ('view-institute-students')}}">Students</a></li> 
                <li><a href="{{url ('view-institute-timetable')}}">Class Timetable</a></li> 
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
                        <h2><?php if ($class_id == 0) { ?> View Students  <?php } else {
    foreach ($classes as $class) { ?> {{ $class->classes->class_name }}  @if(($class->section_id) > 0)  -  {{ $class->sections->section_name}} @endif , <?php }
} ?>  @if($class_id != 0) Students @endif</h2>
<!--                    <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-institute-students-excel')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                        -->      
                        <form class="form-horizontal" action="{{url('view-institute-students-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            
                            @if($classes_id !="")
                            @foreach($classes_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                             @if($admission_type_id !="")
                            @foreach($admission_type_id as $type)
                            <input type="hidden" name="student_type_id[]" value="{{$type}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                        <form class="form-horizontal" action="{{url('view-institute-students-pdf/1')}}" target="_blank"  enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            
                            @if($classes_id !="")
                            @foreach($classes_id as $class)
                            <input type="hidden" name="class_section_id[]" value="{{$class}}">
                            @endforeach
                            @endif
                             @if($admission_type_id !="")
                            @foreach($admission_type_id as $type)
                            <input type="hidden" name="student_type_id[]" value="{{$type}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</button>
                        </form>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-institute-transport-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-bus"></i> Transport Students</a>
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
                                            <form class="form-horizontal" action="{{url('view-institute-students')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id[]" multiple=""  class="">
                                                        <option value="">--- Select class---</option> 
                                                        @foreach($class_sections as $class_section)
                                                        <option value="{{$class_section->id}}" <?php if ($classes_id != '') {
    foreach ($classes_id as $classes_i) {
        if ($classes_i == $class_section->id) { ?> selected="selected" <?php }
    }
} ?>>{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('class_section_id') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="student_type_id[]" multiple=""  class="">
                                                        <option value="">--- Select admission type---</option> 
                                                        @foreach($admission_types as $admission_type)
                                                        <option value="{{$admission_type->id}}" <?php
                                                                if ($admission_type_id != '') {
                                                                    foreach ($admission_type_id as $admission_type_i) {
                                                                        if ($admission_type_i == $admission_type->id) {
                                                                            ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $admission_type->title}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get students</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-students')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>

                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly=""class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student Id" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Credentials" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text"  class="form-control" placeholder="Parent details" />
                                            </th>


                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Student id</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Class-Roll No</th>
                                            <th data-sortable="true">Credentials </th>
                                            <th data-sortable="true">Parent</th>         

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$i = 1;
foreach ($students as $student) {
    ?> 
                                            <tr class="">
                                                <td><a href="{{url('view-student-profile/'.$student->id)}}"><img @if($student->photo != '') src="{{URL::asset('uploads/students/profile_photos/'.$student->photo)}}" @endif @if($student->photo == '') @if($student->gender == 'Male') src="{{ URL::asset('uploads/errors/student_male.png') }}" @endif @if($student->gender == 'Female') src="{{ URL::asset('uploads/errors/student_female.png') }}" @endif  @endif height="50" width="50"></a>  </td>
                                                <td><a href="{{url('view-student-profile/'.$student->id)}}">{{$student->unique_id}}</a></td>
                                                <td>{{ $student->student_types->title }} <br><a href="{{url('view-student-profile/'.$student->id)}}">{{$student->first_name}}  {{$student->last_name}}</a> </td>    
                                                <td>{{$student->classes->class_name}} @if($student->section_id >0) - {{$student->sections->section_name}} @endif -{{ $student->roll_number}}</td>
                                                <td>User name: {{$student->user_logins->user_name}} <br> Password : {{$student->user_logins->password}}</td>
                                                <td>Father : {{$student->father_name}} <br> Mobile : {{$student->father_number}}</td>
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
