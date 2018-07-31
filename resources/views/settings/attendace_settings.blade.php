@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                @if(Session::has('attendance_settings'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{ Session::get('attendance_settings') }}
                </div>
                @endif
                {{ Session::forget('attendance_settings') }}
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Attendance Settings</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('attendance_settings') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Attendance Type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <?php
                                        $new_array = array();
                                        foreach ($attendance_types as $attendance_setting) {
                                            $new_array[] = $attendance_setting->attendance_type_title;
                                        }
                                        array_unshift($new_array, "Select Attendance");
                                                    if (sizeof($attendance_settings) == 0) { ?>
                                                        <select  name="attendance_type" id="attendance_type"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>
                                                            <option value="">Select Attendance Type</option> 
                                                            <?php foreach ($attendance_types as $attendance_type) { ?>
                                                                <option value="<?php echo $attendance_type->attendance_type_id; ?>"><?php echo $attendance_type->attendance_type_title; ?></option>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <?php $type = $attendance_settings[0]->attendance_type_id; ?>
                                                        {{ Form::select('attendance_type_edit', $new_array, $type, ['class' => 'col-xs-10 col-sm-5 col-md-9 col-lg-9']) }}
                                                       <?php } ?>

                                                                </select>
                                                                </div>
                                                                <div style = "color: red;">
                                                                {{ $errors->first('attendance_type')}}
                                                            </div>
                                                            </div>

                                                            <div class = "form-group">
                                                            <div class = "col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>
                                                            <div class = "col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                            <button class = "btn btn-info" type = "reset" name = "">
                                                            <i class = "ace-icon fa fa-times bigger-110"></i>
                                                            Cancel
                                                            </button>
                                                            </div>
                                                            <div class = "col-xs-6 col-sm-6 col-md-5 col-lg-5">
                                                            <button class = "btn btn-info" type = "submit" name = "submit">
                                                            <i class = "ace-icon fa fa-check bigger-110"></i>
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
                                                            <div class = "col-xs-1 col-sm-1 col-md-6 col-lg-6"></div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            @include('include.footer')                                                            