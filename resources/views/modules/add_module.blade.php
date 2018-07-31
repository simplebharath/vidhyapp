@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('view-modules')}}">Modules</a></li>
                <li><a href="{{url ('view-user-types')}}">User Types</a></li>
                <li><a href="{{url ('view-user-type-modules')}}">User Type Modules</a></li>
                <li ><a href="{{url ('view-user')}}">Users</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add module</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-modules')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-add-module') }}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Module <span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <input type="text"  id="form-field-1" placeholder="" name="module" value="{{old('module')}}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('module') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Link <span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <input type="text"  id="form-field-1" placeholder="" name="link" value="{{old('link')}}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('link') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Image <span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <input type="text"  id="form-field-1" placeholder="fa fa-icon" name="image" value="{{old('image')}}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('image') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Rank <span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <input type="number"  id="form-field-1" placeholder="" name="rank" value="{{old('rank')}}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('rank') }}
                                                </div>
                                            </div>
                                            <div class="col-md-offset-5">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-modules')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View Modules</span>
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