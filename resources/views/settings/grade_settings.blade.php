@include('include.header')
@include('include.navigationbar')

<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">

        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Grade Settings</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('grade_settings') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Percentage<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="percentage_id"   class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>
                                                        <option value="">Select Percentage</option> 
                                                        <?php foreach ($percentages as $percentage) { ?>
                                                            <option value="<?php echo $percentage->percentage_ranges; ?>"><?php echo $percentage->percentage_ranges; ?></option>
                                                        <?php } ?>

                                                    </select> 
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('percentage_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Grade<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="grade_id"   class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>
                                                        <option value="">Select Grade</option> 
                                                        <?php foreach ($grades as $grade) { ?>
                                                            <option value="<?php echo $grade->grade_id; ?>"><?php echo $grade->grade_value; ?></option>
                                                        <?php } ?>

                                                    </select> 
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('grade_id') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"></div>
                                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                    <button class="btn btn-info" type="submit" name="submit" id="btnsubmit">
                                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                                        Submit
                                                    </button>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">

                                                    <button class="btn btn-info" type="reset" name="">
                                                        <i class="ace-icon fa fa-times bigger-110"></i>
                                                        Cancel
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