<style> #error-message{margin-left: 310px;}</style>
@extends('layouts.master')
@section('sub-title', "")
@section("main-content")
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        
                        <h2>Edit Class-Section</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-sections')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  @if(Session::get('add') == 1) href="{{url('add-class-section')}}" @else disabled @endif style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-edit-class-section/'.$class_sections[0]->id)}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="class_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">                                                                                                               
                                                        <option value="{{$class_sections[0]->class_id}}">{{$class_sections[0]->classes->class_name}}</option>                                                     
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('class_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Section: <span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select class="col-xs-10 col-sm-5 col-md-9 col-lg-9" name="section_id" id="section" >
                                                        <option value="">---- select section----</option>
                                                        <?php foreach ($sections as $section) { ?>                                                        
                                                            <option value="{{$section->id}}"  @if (($section->id) == ($class_sections[0]->section_id) ) selected="selected" @endif>  {{$section->section_name}} </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('section_id') }}
                                                </div>
                                            </div>

                                            <div style="margin-left:40%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-class-sections')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View class-sections</span>
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