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
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li class="active"><a href="{{url ('view-route-stops')}}">Route stops</a></li>
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
                        <h2>Edit Route Stop</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-route-stops')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-route-stop')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-route-stop/'.$route_stops[0]->id) }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Route Title<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="route_id" id="cid"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                        <option value="">--- select Route---</option> 
                                                        <?php foreach ($vehicle_routs as $vehicle_rout) { ?>
                                                            <option value="<?php echo $vehicle_rout->id; ?>" @if($route_stops[0]->route_id == $vehicle_rout->id ) selected @endif>{{ $vehicle_rout->route_title}} : {{ $vehicle_rout->route_from}} - {{ $vehicle_rout->route_to}} </option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('route_id') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Stop Name <span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="stop_name" value="{{$route_stops[0]->stop_name}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('stop_name') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Stop Latitude <span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="stop_latitude" value="{{$route_stops[0]->stop_latitude}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('stop_latitude') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Stop Longitude <span class="error">* </span></label>                                               
                                                <div class="col-sm-8 input">
                                                    <input type="text"  id="example1"  name="stop_longitude" value="{{$route_stops[0]->stop_longitude}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('stop_longitude') }}
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Pickup Time<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <input type="text"  id="timepicker" placeholder=""  name="pickup_time"  value="{{$route_stops[0]->pickup_time}}" class=" col-xs-10 col-sm-5 col-lg-8 col-mg-8" />                                                        
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('pickup_time') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Drop Time<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <input type="text"  id="timepicker1" placeholder="" value="{{$route_stops[0]->drop_time}}" name="drop_time" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('drop_time') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Stop Address<span class="error">* </span></label>
                                                    <div class="col-sm-8">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md-8 col-lg-8" placeholder="" name="stop_address"  >{{$route_stops[0]->stop_address}}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('stop_address') }}
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
                                                <a href="{{ url('view-route-stops')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Route Stops</span>
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