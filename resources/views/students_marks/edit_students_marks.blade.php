@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Marks</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
               
                <li><a href="{{url('get-students-marks')}}"> Add Marks</a></li>
                <li><a href="{{url ('view-students-marks')}}"> View Marks</a></li>
                 <li class="active"><a href="{{url ('marks-added-students')}}"> Edit Marks</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> Edit Students Marks</h2>
                   <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('marks-added-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                 <form class="form-horizontal" action="{{url('update-students-marks/'.$marks[0]->exam_id .'/'.$marks[0]->class_section_id.'/'.$marks[0]->subject_id)}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <div class="dt-toolbar pull-right" style="float:right;">
                                            <div class="col-sm-10">
                                                <label> </label>
                                            </div>

                                            <div class="col-sm-2 pull-right">
                                                <button type="submit" class="width-10 btn btn-md btn-warning">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update Marks</span>
                                                </button>
                                            </div>
                                        </div>
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text"  class="form-control" placeholder="Exam" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Image" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Subject" />
                                            </th> 
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Min / Max" />
                                            </th> 
                                             <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Secured Marks" />
                                            </th> 
                                             
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Exam</th>   
                                            <th data-sortable="true"> Student</th>                                        
                                            <th data-sortable="true">Image</th>  
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Marks</th>
                                            <th data-sortable="true">Secured Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($marks as $mark) {
                                            ?> 
                                            <tr class="">
                                                <td>{{$mark->exams->title}} <br> {{$mark->class_exams->exams_start_date}} to {{$mark->class_exams->exams_end_date}}</td>
                                                <td> 
                                                     ID: {{$mark->students->unique_id}} <br>
                                               CLASS: {{ $mark->students->classes->class_name }}  @if(($mark->students->section_id) > 0)  -  {{ $mark->students->sections->section_name}}  @endif
                                                <br> Roll No : {{$mark->students->roll_number}} <br>
                                               NAME: {{$mark->students->first_name}} {{$mark->students->last_name}}
                                                </td>
                                                    <td><img src="{{URL::asset('uploads/students/profile_photos/'.$mark->students->photo)}}"  @if($mark->students->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($mark->students->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="80" width="80">  </td>
                                                <td>{{$mark->subjects->subject_name}} ( {{$mark->schedule_exams->exam_date}} ) <br>{{$mark->schedule_exams->exams_start_time}} to {{$mark->schedule_exams->exams_end_time}} <br> ( {{$mark->schedule_exams->exam_duration}} )</td>
                                                <td>Pass marks: {{$mark->schedule_exams->pass_marks}} <br> Max. marks:{{$mark->schedule_exams->max_marks}}</td>
                                                <td>
                                                    <input type="text" required="" name="marks_obtained[<?php echo $mark->student_id; ?>]" value="{{$mark->marks_obtained}}">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('marks_obtained') }}
                                                    </p>
                                                </td>
                                               
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                 </form>
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
