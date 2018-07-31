@include('include.header')
<style> #error-message{margin-left: 400px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Transport</li><li>Drivers</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-vehicle-types')}}">Vehicle Types</a></li>
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li ><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                 <li   class="active"><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                 <li><a href="{{url ('view-meter-reading')}}">Meter Reading</a></li>
                <li><a href="{{url ('view-fuel')}}"> Fuel</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
                        <h2>Edit Vehicle driver </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-vehicle-drivers')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-vehicle-driver')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-edit-vehicle-driver/'.$vehicle_drivers[0]->id) }}">
                                            {{ csrf_field() }}

                                           <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Driver<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="user_type_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        
                                                        <?php foreach ($user_types as $user_type) { ?>
                                                            <option value="<?php echo $user_type->id; ?>"@if($vehicle_drivers[0]->user_type_id == $user_type->id ) selected @endif><?php echo $user_type->title; ?></option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('user_type_id') }}
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Staff<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="staff_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">--- select driver---</option> 
                                                        <?php foreach ($staff as $staf) { ?>
                                                            <option value="<?php echo $staf->id; ?>" @if($vehicle_drivers[0]->staff_id == $staf->id ) selected @endif> {{ $staf->first_name }}  {{ $staf->middle_name}}</option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_id') }}
                                                </div>
                                            </div>
                                                
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Vehicle type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="vehicle_type_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                      
                                                            <option value="{{ $vehicle_drivers[0]->vehicle_type_id }}" @if($vehicle_drivers[0]->vehicle_type_id == $vehicle_drivers[0]->id ) selected @endif>{{ $vehicle_drivers[0]->vehicle_type->title}}</option>
                                                      
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('vehicle_type_id') }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Vehicle<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="vehicle_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">--- select vehicle Id---</option> 
                                                        <?php foreach ($vehicles as $vehicle) { ?>
                                                            <option value="<?php echo $vehicle->id; ?>" @if($vehicle_drivers[0]->vehicle_id == $vehicle->id ) selected @endif>{{ $vehicle->vehicle_number }} : {{ $vehicle->owner_name}} </option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('vehicle_id') }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route <span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="route_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">--- select Route Id---</option> 
                                                        <?php foreach ($routes as $route) { ?>
                                                            <option value="<?php echo $route->id; ?>" @if($vehicle_drivers[0]->route_id == $route->id ) selected @endif>{{ $route->route_title}} : {{ $route->route_from}} - {{ $route->route_to}} </option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('route_id') }}
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
                                                <a href="{{ url('view-vehicle-drivers')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Vehicle Drivers</span>
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