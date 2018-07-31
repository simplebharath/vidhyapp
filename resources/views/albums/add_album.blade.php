@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Albums </li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
           <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('view-albums')}}">Albums Title</a></li>
                <li><a href="{{url ('view-gallery')}}">Gallery</a></li>
                  <li><a href="{{url ('view-videos')}}">Videos</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add  Album </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-albums')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('do-add-album') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Album Title <span class="error">* </span></label>

                                                <div class="col-sm-5">
                                                    <input type="text"  id="form-field-1" placeholder="Enter Album Title" name="album_title" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                    <br><br> <div style="color: red;" class="help-block">
                                                    {{ $errors->first('album_title') }}
                                                </div>
                                                </div>
                                                
                                            </div>
                                                

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                <div class="col-sm-5">
                                                    <textarea cols="40" maxlength="200" rows="3" class="custom-scroll" placeholder="" name="album_description" class="col-xs-10 col-sm-5 col-md-8 col-lg-8" >{{ old('address') }}</textarea>
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('album_description') }}
                                                </div>
                                            </div>
                                                <div style="margin-left:25%">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Save</span>
                                                    </button>
                                                    <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                        <i class="ace-icon fa fa-times red2"></i>
                                                        <span class="bigger-110">Cancel</span>
                                                    </button>   
                                                    <a href="{{ url('view-albums')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> View Albums</span>
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
@include('include.footer')<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

