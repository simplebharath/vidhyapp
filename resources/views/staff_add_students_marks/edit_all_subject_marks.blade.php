@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Marks</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('get-students-marks')}}"> Add Marks</a></li>
                <li><a href="{{url ('view-students-marks')}}"> View Marks</a></li>
                <li class="active"><a href="{{url ('marks-added-students')}}"> Edit Marks</a></li>

            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>{{$exam[0]->exams->title}} : {{$exam[0]->exams_start_date}}  To  {{$exam[0]->exams_end_date}} For {{$class_name[0]->classes->class_name}} @if($class_name[0]->section_id > 0) {{$class_name[0]->sections->section_name}} @endif </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('marks-added-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('update-student-all-ubject-marks')}}" enctype="multipart/form-data" method="POST" >
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
                                                <th class="hasinput" style="width:12%">
                                                    <input type="text" class="form-control" placeholder="Student" />
                                                </th>

                                                <th class="hasinput" style="width:8%">
                                                    <input type="text" class="form-control" placeholder="Image" />
                                                </th>
                                                <?php foreach ($subjects as $subject) { ?>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" readonly placeholder="{{$subject->subject_name}} Marks" />
                                                    </th>

                                                <?php } ?>

                                            </tr>
                                            <tr>                                              
                                                <th data-sortable="true">Student</th>                                                
                                                <th data-sortable="true">Image</th>  
                                                <?php foreach ($subjects as $subject) { ?>
                                                    <th data-sortable="true">{{$subject->subject_name .' ( '. $subject->exam_date }}) <br> {{$subject->exams_start_time}} - {{$subject->exams_end_time}}({{$subject->exam_duration}}) </th>                                              
                                                <?php } ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($marks as $mark) {?>                                        
                                                    <tr class="">                    
                                                <input type="text" name="exam_id" hidden="" value="{{$exam[0]->exam_id}}">
                                                <input type="text" name="class_section_id" hidden="" value="{{$mark->class_section_id}}">
                                                <td>
                                                    ID: 
                                                    <br> Roll No : {{$mark->roll_number}} <br>
                                                    NAME: {{$mark->first_name}} {{$mark->last_name}}
                                                </td>                                                                                       
                                                <td><img src="{{URL::asset('uploads/students/profile_photos/'.$mark->photo)}}"  @if($mark->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($mark->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="80" width="80">  </td>
                                             <?php 
                                             $secured_marks = explode(',', $mark->new_marks);
                                             $exam_subjects = explode(',', $mark->new_subjects);
                                                foreach ($exam_subjects as $key=>$subjectid){
                                                
                                                    ?>      
                                                    <td>
                                                       <input type="number" name="marks_obtained[{{$mark->student_id}}][{{$subjectid}}]" value="{{ $secured_marks[$key]}}">
                                                        <p class="help-block" style="color: red;">
                                                            {{ $errors->first('marks_obtained' ) }}
                                                        </p>
                                                        <br> <?php foreach ($subjects as $subject) if($subject->id == $subjectid) {{ ?>{{$subject->pass_marks}}/{{$subject->max_marks}} <?php }} ?> 
                                                    </td>

                                                <?php }?>
                                                </tr>
                                               <?php } ?>
                                        </tbody>
                                    </table>     
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')