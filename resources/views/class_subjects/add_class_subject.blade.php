
<style> #error-message{margin-left: 255px;}</style>
@extends('layouts.master')
@section('sub-title', "")
@section("main-content")
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        
                        <h2>Add Class-subject</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-subjects')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-add-class-subject')}}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Day<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="day_id" id="day_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value=""> ---select day--- </option> 
                                                        <?php foreach ($days as $day) { ?>
                                                            <option value="{{$day->id}}" @if (old('day_id') == $day->id) selected="selected" @endif>{{$day->day_title}}</option>
                                                        <?php } ?>                                                     
                                                    </select> 
                                                </div>     
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('day_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select   name="class_section_id" id="class_section_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value="">-- select class --</option>       
                                                        <?php foreach ($class_sections as $class_section) { ?>                                                        
                                                            <option value="{{$class_section->id}}" @if (old('class_section_id') == $class_section->id) selected="selected" @endif>{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('class_section_id') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Subject <span class="error">* </span> </label>
                                                <div class="col-sm-9">
                                                    <select class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  name="subject_id" id="subject_id" >                                                       
                                                    <option value=""> --- first select class ---</option>
                                                    </select>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('subject_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Timings<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select   name="institute_timing_id" id="institute_timing_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value=""> --- first select subject ---</option>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('institute_timing_id') }}
                                                </div>
                                            </div>
                                            <input type="text" hidden="" name="start_time" id="class_start" class=" col-xs-10 col-sm-5 col-md-9 col-lg-9" ></input>                                              
                                            <input type="text" hidden=""  name="end_time" id="class_end" class=" col-xs-10 col-sm-5 col-md-9 col-lg-9"></input>
                                            <div style="margin-left:35%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-class-subjects')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View class-subjects</span>
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
@endsection