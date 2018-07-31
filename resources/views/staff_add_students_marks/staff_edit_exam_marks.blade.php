@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('staff-get-students-marks')}}"> Add Marks</a></li>
                <li><a href="{{url ('staff-view-students-marks')}}"> View Marks</a></li>
                <li class="active"><a href="{{url ('staff-marks-added-students')}}"> Edit Marks</a></li>

            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Edit exam marks class-wise or subject wise </h2>
                    </header>   
                    <div class="col-sm-12">                                  
                        <form class="form-horizontal" action="{{url('staff-edit-student-subject-marks')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }}                                                                               
                            <div class="col-sm-12"><br>
                                @include('include.messages')                                           
                                <div class="row">
                                    <label class="col-sm-1"></label>
                                    <div class="col-sm-2">
                                        <label class="">Exam</label>                                                 
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="">Class</label>                                                 
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="">Subjects</label>                                                 
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="col-sm-2"></label>                                                 
                                    </div>

                                </div>
                                <div class="row" id="">
                                    <label class="col-sm-1">Select :</label>
                                    <div class="col-sm-2">
                                        <select  name="exam_id" id="edit_exam" required class="">
                                            <option value="">--- Select exam---</option> 
                                            <?php foreach ($exams as $exam) { ?>
                                                <option value="{{$exam->id }}" @if(old('exam_id') == $exam->id )selected @endif>{{$exam->title}} </option>
                                            <?php } ?>
                                        </select>
                                        <p class="help-block" style="color: red;">
                                            {{ $errors->first('exam_id') }}
                                        </p>
                                    </div>
                                    <div class="col-sm-2">
                                        <select  name="class_section_id" id="view_exam_classes" class="staff_view_exam_classes" required class="">
                                            <option value="">--- Select class---</option> 

                                        </select>
                                        <p class="help-block" style="color: red;">
                                            {{ $errors->first('class_section_id') }}
                                        </p>
                                    </div>

                                    <div class="col-sm-2">
                                        <select  name="subject_id" id="staff_edit_exam_subject" class="" required="">
                                            <option value="">--- Select subject---</option> 

                                        </select>
                                        <p class="help-block" style="color: red;">
                                            {{ $errors->first('subject_id') }}
                                        </p>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="submit" class="width-10 btn btn-md btn-success">
                                            <i class="ace-icon fa fa-check"></i>
                                            <span class="bigger-110">Get students</span>
                                        </button>
                                    </div>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')