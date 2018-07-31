@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">
<!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">

        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-inr"></i> </span>
                        <h2>Add Fee Type</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('settings/add_fee_types') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Fee Type <span class="error">* </span></label>

                                                <div class="col-sm-8">
                                                    <input type="text"  id="form-field-1"  name="fee_name" placeholder="Enter Fee Type" value="{{ old('fee_name') }}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" required/>
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('fee_name') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Select Fee Status<span class="error">* </span></label>

                                                <div class="col-sm-8 col-md-6 col-lg-8 col-xs-8">
                                                    <select required  name="fee_status" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" >
                                                        <option value="">Choose Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">InActive</option>
                                                    </select> 
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('fee_status') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                    <button class="btn btn-info" type="reset" name="">
                                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                                        Cancel
                                                    </button>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                                                    <button class="btn btn-info" type="submit" name="submit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
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