@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li> GradeSettings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
           <ul class="nav nav-tabs">
                <li><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li ><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                <li  ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li class="active"><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Grade Settings</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-grade-settings')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-grade-settings')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-edit-grade-settings/'.$grade_settings[0]->id)}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Percentage<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="percentage_id"   class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >

                                                        <?php foreach ($percentages as $percentage) { ?>
                                                            <option value="<?php echo $percentage->id; ?>">{{$percentage->percentage_from }} - {{$percentage->percentage_to }}</option>
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
                                                    <select  name="grade_type_id"   class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >


                                                        <?php foreach ($grade_types as $grade_type) { ?>
                                                            <option value="<?php echo $grade_type->id; ?>" @if($grade_settings[0]->grade_type_id == $grade_type->id) selected @endif><?php echo $grade_type->title; ?></option>
                                                        <?php } ?>

                                                    </select> 
                                                </div>
                                                <div style="color: red;">
                                                    {{ $errors->first('grade_type_id') }}
                                                </div>
                                            </div>

                                            <div style="margin-left:40%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-grade-settings')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Grade Settings</span>
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