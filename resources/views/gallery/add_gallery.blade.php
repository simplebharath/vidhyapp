@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Gallery</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
           <ul class="nav nav-tabs">
                
                <li><a href="{{url ('view-albums')}}">Album Title</a></li>
                <li class="active"><a href="{{url ('view-gallery')}}">Gallery</a></li>
                <li><a href="{{url ('view-videos')}}">Videos</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Photos </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-gallery')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('do-add-gallery') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Album Title<span class="error">* </span></label>
                                                <div class="col-sm-5">
                                                    <select required aria-required="true" name="album_id" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                     <option value=""> --- select Album Title --- </option>
                                                    <?php
                                                    foreach ($albums as $album) {
                                                        ?>
                                                        <option value="<?php echo $album->id ?>"><?php echo $album->album_title; ?></option>
                                                    <?php } ?>

                                                    </select>  </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('album_id') }}
                                                </div>
                                            </div>
                                                
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Picture(S)<span class="error">* </span></label>
                                                <div class="col-sm-5">
                                                    <input type="file" name="images[]" multiple="multiple"  id="form-field-1"  value="" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('images') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                <div class="col-sm-5">
                                                    <textarea cols="40" maxlength="220" rows="2" class="custom-scroll" placeholder="" name="album_description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">{{ old('album_description') }}</textarea>
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
                                                    <a href="{{ url('view-gallery')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> View Gallery</span>
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

