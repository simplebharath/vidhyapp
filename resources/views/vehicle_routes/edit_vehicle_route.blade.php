@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Transport Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-vehicle-types')}}">Vehicle Types</a></li>
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li  class="active"><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Reading</a></li>
                <li><a href="{{url ('view-fuel')}}"> Fuel</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Vehicle Route</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-vehicles-routes')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-vehicle-route')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-vehicle-route/'.$vehicle_routes[0]->id) }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route Name<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_title" value="{{$vehicle_routes[0]->route_title}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_title') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route From<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_from" value="{{$vehicle_routes[0]->route_from}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_from') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> From start Time<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  id="timepicker" placeholder=""  name="route_from_start_time"  value="{{$vehicle_routes[0]->route_from_start_time}}" class=" col-xs-10 col-sm-5 col-lg-8 col-mg-8" />                                                        
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_from_start_time') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> From End Time<span class="error"> </span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  id="timepicker1" placeholder=""  name="route_from_end_time"  value="{{$vehicle_routes[0]->route_from_end_time}}" class=" col-xs-10 col-sm-5 col-lg-8 col-mg-8" />                                                        
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_from_end_time') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route From Latitude<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_from_latitude" value="{{$vehicle_routes[0]->route_from_latitude}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_from_latitude') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route From Longitude<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_from_longitude" value="{{$vehicle_routes[0]->route_from_longitude}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_from_longitude') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route To<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_to" value="{{$vehicle_routes[0]->route_to}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_to') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> To Start Time<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  id="timepicker2" placeholder="" value="{{$vehicle_routes[0]->route_to_start_time}}" name="route_to_start_time" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_to_start_time') }}
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> TO End Time<span class="error"> </span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  id="timepicker3" placeholder=""  name="route_to_end_time"  value="{{$vehicle_routes[0]->route_to_end_time}}" class=" col-xs-10 col-sm-5 col-lg-8 col-mg-8" />                                                        
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_to_end_time') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route To Latitude<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_to_latitude" value="{{$vehicle_routes[0]->route_to_latitude}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_to_latitude') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route To Longitude<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="route_to_longitude" value="{{$vehicle_routes[0]->route_to_longitude}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('route_to_longitude') }}
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
                                                <a href="{{ url('view-vehicles-routes')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Vehicle Routes</span>
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