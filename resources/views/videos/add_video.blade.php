@include('include.header')
<style> #error-message{margin-left: 200px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Videos</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-albums')}}">Albums Title</a></li>
                <li><a href="{{url ('view-gallery')}}">Gallery</a></li>
                <li  class="active" ><a href="{{url ('add-video')}}">Videos</a></li>

            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Video</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-videos')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form"  enctype="multipart/form-data" method="POST" action="{{ url('do-add-video') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Video title :<span class="error"> * </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="title" value="{{ old('title') }}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    <small class="help-block" style="clear:both;color:red;padding-bottom: 0px !important;margin-bottom: 0px !important;"> {{ $errors->first('title') }}</small>
                                                    </div>
                                           
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Youtube Video Id :<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="video" value="{{ old('video') }}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                        <small class="help-block" style="clear:both;color:red;padding-bottom: 0px !important;margin-bottom: 0px !important;"> {{ $errors->first('video') }}</small>
                                                    </div>
                                         
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                    <div class="col-sm-8">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="" name="description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('description') }}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                </div>
                                                <div style="margin-left:36%">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Save</span>
                                                    </button>
                                                    <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                        <i class="ace-icon fa fa-times red2"></i>
                                                        <span class="bigger-110">Cancel</span>
                                                    </button>   
                                                    <a href="{{ url('view-videos')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110"> view Videos</span>
                                                    </a>
                                                </div><br>
                                               
                                            </div>
                                        </form>
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