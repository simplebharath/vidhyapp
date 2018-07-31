@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >
    <!-- RIBBON -->
    <div id="ribbon">
       <!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Change Password</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div><br>
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
             @if(Session::has('change_password'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong> {{ Session::get('change_password') }}
                </div>
                @endif
                {{ Session::forget('change_password') }}
<div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-editbutton="false">
   
 <header>
                    <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                    <h2>Change Password </h2>
                </header>
                <div>
                     <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding"><br>
                        <div class="row">
                            <div class="col-xs-12">
                           <form class="form-horizontal" role="form" method="POST"  action="{{ url('password_change') }}">
                                    {{ csrf_field() }}
                                   
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Old Password</label>
                                        <div class="col-sm-8">
                                            <input type="password"  id="form-field-1" placeholder="Old Password" name="old_password" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                        </div>
                                        <div style="color: red;">
                                                        {{ $errors->first('old_password') }}
                                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1">New Password</label>
                                        <div class="col-sm-8 col-md-6 col-lg-8 col-xs-8">
                                            <input type="password"  id="form-field-1" placeholder="New Password" name="password" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                        </div>
                                        <div style="color: red;">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Confirm Password</label>
                                        <div class="col-sm-8 col-md-6 col-lg-8 col-xs-8">
                                            <input type="password"  id="form-field-1" placeholder="Confirm Password" name="password_confirmation" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                        </div>
                                        <div style="color: red;">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-xs-6 col-sm-6 col-md-7 col-lg-7"></div>
                                        <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                                        <button class="btn btn-info" type="submit" name="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            Submit
                                        </button>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                                <div class="hr hr-24"></div>

                            </div><!-- /.span -->
                        </div><!-- /.row -->
                        <!-- PAGE CONTENT ENDS -->
                    

            </div>
    </div>
    <!-- end widget content -->

</div>
<!-- end widget div -->

</div>
<!-- end widget -->
</article>
<div class="col-xs-1 col-sm-1 col-md-5 col-lg-5"></div>
<!-- WIDGET END -->
</div>
</div>
<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
@include('include.footer')
