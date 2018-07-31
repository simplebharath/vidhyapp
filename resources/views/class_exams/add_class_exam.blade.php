@include('include.header')
<style> #error-message{margin-left: 250px;}</style>
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
                <li class="active"><a href="{{url ('view-class-exams')}}"> Class exams</a></li>
                <li><a href="{{url ('view-schedule-exams')}}"> Schedule exams</a></li>
            </ul>
        </div><br>
        <div class="row"> 
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Add Exam</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-exams')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data"  action="{{url('do-add-class-exam')}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Exam Title<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="exam_id" id="class_section_exam_id"   class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">---   select Exam Name   ---</option> 
                                                        <?php foreach ($class_exams as $class_exam) { ?>
                                                            <option value="<?php echo $class_exam->id; ?>" @if(old('exam_id') == $class_exam->id ) selected @endif><?php echo $class_exam->title; ?></option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('exam_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Class <span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="class_section_id[]" multiple="" style="height:100%;" id="class_name"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">--- select class---</option> 
                                                        
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('class_section_id') }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Exam Start Date<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="exams_start_date" value="{{ old('exams_start_date') }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('exams_start_date') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Exam End Date<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="exams_end_date" value="{{ old('exams_end_date') }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('exams_end_date') }}
                                                </div>
                                            </div>
                                            <div style="margin-left:40%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-class-exams')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View Class Exams</span>
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