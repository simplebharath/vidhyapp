@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Transport</li><li>Fuel</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
           <ul class="nav nav-tabs">
                <li><a href="{{url ('view-vehicle-types')}}">Vehicle Types</a></li>
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Readings</a></li>
                <li  class="active"><a href="{{url ('view-fuel')}}"> Fuel</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Fuel</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-fuel')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-fuel')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-fuel/'.$fuels[0]->id) }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Vehicle<span class="error">* </span></label>
                                                <div class="col-sm-8">
                                                    <select  name="vehicle_driver_id" id="cid"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                        
                                                        <?php foreach ($vehicle_drivers as $vehicle_driver) { ?>
                                                            <option value="{{ $vehicle_driver->id }}" > {{ $vehicle_driver->vehicle_type->title .' - '. $vehicle_driver->vehicle->vehicle_number .' ('. $vehicle_driver->routes->route_from .' - '.$vehicle_driver->routes->route_to }}</option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('vehicle_driver_id') }}
                                                </div>
                                            </div>
                                                
                                            <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Rate Per Litre<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="number"  id="example1"  name="rate_for_liter" value="{{$fuels[0]->rate_for_liter}}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('rate_for_liter') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Kilometers<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="kilometre" value="{{$fuels[0]->kilometre}}"   class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('kilometre') }}
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Date<span class="error">* </span></label>                                               
                                                    <div class="col-sm-8 input">
                                                        <input type="text"  id="example1"  name="date" value="{{$fuels[0]->date}}" data-provide="datepicker"  class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('date') }}
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Remarks<span class="error"> </span></label>
                                                    <div class="col-sm-8">
                                                        <textarea cols="40" rows="3" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="" name="remarks" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{$fuels[0]->remarks}}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('remarks') }}
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
                                                <a href="{{ url('view-fuel')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Fuel</span>
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