@include('include.header')
<style> #error-message{margin-left: 250px;}</style>
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
                <li ><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li ><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                <li class="active" ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li ><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li ><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Add Institute Timings</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-institute-timings')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-add-institute-timings')}}">
                                            {{ csrf_field() }}                                       
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Title<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"   id="form-field-1" placeholder="" name="title" value="{{old('title')}}"  class="col-xs-10 col-sm-5 col-lg-9 col-mg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('title') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Start Time<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="timepicker" placeholder=""  name="class_start"  value="{{old('class_start')}}" class=" col-xs-10 col-sm-5 col-lg-9 col-mg-9" />                                                        
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('class_start') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">End Time<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="timepicker1" placeholder="" value="{{old('class_end')}}" name="class_end" class="col-xs-10 col-sm-5 col-lg-9 col-mg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('class_end') }}
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
                                                    <a href="{{ url('view-institute-timings')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                        <i class="ace-icon fa fa-undo"></i>
                                                        <span class="bigger-110">Institute Timings</span>
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