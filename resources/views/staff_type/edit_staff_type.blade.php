<style> #error-message{margin-left: 360px;}</style>
@extends('layouts.master')
@section('sub-title', "")
@section("main-content")
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <h2>Edit staff type</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-types')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        @if(Session::get('add') == 1) <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-type')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="{{url('add-staff-type')}}"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-staff-type/'.$staff_types[0]->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Staff type<span class="error">* </span></label>                                       
                                                <div class="col-sm-8">
                                                    <input type="text"  id="form-field-1"  name="title" value="{{$staff_types[0]->title}}"  class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8" required/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('title') }}
                                                </div>
                                            </div>

                                            <div style="margin-left:42%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-staff-types')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View staff types</span>
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