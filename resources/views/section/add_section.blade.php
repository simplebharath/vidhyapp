@extends('layouts.master')
@section('sub-title', "")
@section("main-content")
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
<!--                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>-->
                        <h2>Add Section</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-sections')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-add-section') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Section<span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="section_name" value="{{ old('section_name') }}"  class="col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('section_name') }}
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
                                                <a href="{{ url('view-sections')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View sections</span>
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