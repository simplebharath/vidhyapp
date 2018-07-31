@include('include.header')
<style> #error-message{margin-left: 300px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Exams</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-exams')}}"> Exams</a></li>
                <li ><a href="{{url ('view-class-exams')}}"> class-exams</a></li>
                <li  class="active"><a href="{{url ('view-schedule-exams')}}"> schedule-exams</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Exam : {{$schedule_exams[0]->exams->title}}  For Class : {{$schedule_exams[0]->classes->class_name}} @if($schedule_exams[0]->section_id > 0) - {{$schedule_exams[0]->sections->section_name}}@endif </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-schedule-exams')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-exams')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-schedule-exams/'.$schedule_exams[0]->id)}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Subject<span class="error"> </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="subject_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-7">
                                                        <option value="{{$schedule_exams[0]->subject_id}}">{{$schedule_exams[0]->subjects->subject_name}}</option>
                                                        
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('subject_id') }}
                                                </div>
                                            </div>
                                                
                                                <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Exam date<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  placeholder=""   name="exam_date" data-provide="datepicker" value="{{$schedule_exams[0]->exam_date}}" class="col-xs-10 col-sm-5 col-lg-7 col-mg-8" />                                                        
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('exam_date') }}
                                                        </div>
                                                    </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Exam Start Time<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="timepicker1" placeholder=""  name="exams_start_time"  value="{{$schedule_exams[0]->exams_start_time}}" class="col-xs-10 col-sm-5 col-lg-7 col-mg-9" />                                                        
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('exams_start_time') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Exam End Time<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="timepicker2"  placeholder=""  name="exams_end_time"  value="{{$schedule_exams[0]->exams_end_time}}" class="col-xs-10 col-sm-5 col-lg-7 col-mg-9" />                                                        
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('exams_end_time') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Max-Marks<span class="error">* </span></label>                                               
                                                    <div class="col-sm-9 input">
                                                        <input type="text"  id="example1"  name="max_marks" value="{{$schedule_exams[0]->max_marks}}" class="date col-xs-10 col-sm-5 col-lg-7 col-mg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('max_marks') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pass-Marks<span class="error">* </span></label>                                               
                                                    <div class="col-sm-9 input">
                                                        <input type="text"  id="example1"  name="pass_marks" value="{{$schedule_exams[0]->pass_marks}}" class="date col-xs-10 col-sm-5 col-lg-7 col-mg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('pass_marks') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Exam syllabus<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea cols="40" rows="4" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md-9 col-lg-7" placeholder="" name="exam_syllabus" class="col-xs-10 col-sm-5 col-md-9 col-lg-7" >{{$schedule_exams[0]->exam_syllabus}}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('exam_syllabus') }}
                                                    </div>
                                                </div>
                                            <div style="margin-left:32%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-schedule-exams')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Schedule exams</span>
                                                </a>
                                            </div><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <div class="col-xs-1 col-sm-1 col-md-6 col-lg-6"></div>
        </div>
    </div>
</div>
@include('include.footer')