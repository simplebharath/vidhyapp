@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment"> 
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                <i class="fa fa-refresh"></i>
            </span> 
        </span>

        <!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">

        <div>

            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ url('access_controller')}}">Edit Access Type</a></li>
                <li><a href="{{ url('view_access_controllers')}}">View Access Types</a></li>              
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Access Types</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" method="POST" action="{{ url('do_edit_access_controller') }}">
                                            {{ csrf_field() }}
                                            <?php
                                            foreach ($controllers as $controller) {
                                                ?>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Access Type<span class="error">* </span></label>

                                                    <div class="col-sm-8">
                                                        <input type="text"  id="form-field-1" placeholder="Enter Access Controller" name="access_controller_title" value="<?php echo $controller->access_controller_title; ?>" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />

                                                        {{ $errors->first('access_controller_title') }}
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-4"></div>

                                                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                                        <button class="btn btn-info" type="submit" name="submit">
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
                        </article>
                        <div class="col-xs-1 col-sm-1 col-md-6 col-lg-6"></div>
                    </div>
                </div>
        </div>
        @include('include.footer')