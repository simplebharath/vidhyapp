@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Events </li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
           <ul class="nav nav-tabs">
                <li><a href="{{url ('view-event-titles')}}">Event Title</a></li>
                <li ><a href="{{url ('view-events')}}">Events</a></li>
                <li class="active"><a href="{{url ('view-event-albums')}}">Event Albums</a></li>
            </ul>
        </div><br>
        <div class="row">      
             @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Event Album </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-event-albums')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('do-add-event-album') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                
                                                
                                                <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Album Title<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select required aria-required="true" name="event_title_id" id=""  class="col-xs-10 col-sm-5 col-md-8 col-lg-8"/>
                                                     
                                                    <?php
                                                    foreach ($event_albums as $event_album) {
                                                        ?>
                                                        <option value="<?php echo $event_album->id ?>"><?php echo $event_album->title; ?></option>
                                                    <?php } ?>

                                                    </select>  </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('event_title_id') }}
                                                </div>
                                            </div>
                                                
                                                <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Images<span class="error"></span></label>
                                                <div class="col-sm-8">
                                                    <input type="file"  id="" class=""  name="images[]" multiple="" value="{{ old('images') }}" class="col-xs-10 col-sm-5 col-md-8 col-lg-8"/>

                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('images') }}
                                                    </p>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                    <div class="col-sm-8">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="" name="image_description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('image_description') }}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('image_description') }}
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
                                                    <a href="{{ url('view-event-albums')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> View Event Albums</span>
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

