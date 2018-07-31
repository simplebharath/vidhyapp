@include('include.header')
<style> #error-message{margin-left: 250px;}</style>
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
                <li class="active"><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Reading</a></li>
                <li><a href="{{url ('view-fuel')}}"> Fuel</a></li>
            </ul>
        </div><br>
        <div class="row"> 
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add Vehicle</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-vehicles')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{url('do-add-vehicles')}}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Vehicle type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="vehicle_type_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">--- select vehicle type---</option> 
                                                        <?php foreach ($vehicle_types as $vehicle_type) { ?>
                                                            <option value="<?php echo $vehicle_type->id; ?>" @if(old('vehicle_type_id') == $vehicle_type->id ) selected @endif><?php echo $vehicle_type->title; ?></option>
                                                        <?php } ?>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('vehicle_type_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Vehicle Number<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="vehicle_number" value="{{ old('vehicle_number') }}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('vehicle_number') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Engine Number<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="engine_number" value="{{ old('engine_number') }}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('engine_number') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Name<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="owner_name" value="{{ old('owner_name') }}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('owner_name') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Number<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="owner_number" value="{{ old('owner_number') }}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('owner_number') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Email<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="email"  id="example1"  name="owner_email" value="{{ old('owner_email') }}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('owner_email') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Owner Image<span class="error"></span></label>
                                                <div class="col-sm-9">
                                                    <input type="file"  id="" class=""  name="owner_image" value="{{ old('owner_image') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>

                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('owner_image') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> vehicle Image<span class="error"></span></label>
                                                <div class="col-sm-9">
                                                    <input type="file"  id="" class=""  name="vehicle_image" value="{{ old('vehicle_image') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>

                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('vehicle_image') }}
                                                    </p>
                                                </div>
                                            </div>
                                           <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" placeholder="" name="description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('description') }}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                </div>

                                            <div style="margin-left:35%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-vehicles')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View vehicles</span>
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