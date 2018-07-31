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
                <li class="active"><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
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
                        <h2>Edit Vehicle </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-vehicles')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-vehicle')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ url('do-edit-vehicle/'.$vehicles[0]->id) }}">
                                            {{ csrf_field() }}

                                           <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Vehicle type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="vehicle_type_id" id="cid"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                        <option value="">--- select vehicle type---</option> 
                                                        <?php foreach ($vehicle_types as $vehicle_type) { ?>
                                                            <option value="<?php echo $vehicle_type->id; ?>" @if($vehicles[0]->vehicle_type_id == $vehicle_type->id ) selected @endif><?php echo $vehicle_type->title; ?></option>
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
                                                    <input type="text"  id="example1"  name="vehicle_number" value="{{$vehicles[0]->vehicle_number}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('vehicle_number') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Engine Number<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="engine_number" value="{{$vehicles[0]->engine_number}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('engine_number') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Name<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="owner_name" value="{{$vehicles[0]->owner_name}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('owner_name') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Number<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="text"  id="example1"  name="owner_number" value="{{$vehicles[0]->owner_number}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('owner_number') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Owner Email<span class="error">* </span></label>                                               
                                                <div class="col-sm-9 input">
                                                    <input type="email"  id="example1"  name="owner_email" value="{{$vehicles[0]->owner_email}}"  class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('owner_email') }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Owner Image<span class="error"></span></label>
                                                <div class="col-sm-9">
                                                    <input type="file"  id="" class=""  name="owner_image" value="{{$vehicles[0]->owner_image}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>

                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('owner_image') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"></span></label>                                                    
                                                        <div class="col-sm-4">
                                                            <img src="{{URL::asset('uploads/transport/owner_image/'.$vehicles[0]->owner_image)}}"onerror="this.onerror=null;this.src='{{ asset('uploads/errors/father1.png') }}'" height="50" width="50" class="img-rounded img-responsive" alt="VidhyApp" "> 
                                                        </div>
                                                    </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Vehicle Image<span class="error"></span></label>
                                                <div class="col-sm-9">
                                                    <input type="file"  id="" class=""  name="vehicle_image" value="{{$vehicles[0]->vehicle_image}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>

                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('vehicle_image') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"></span></label>                                                    
                                                        <div class="col-sm-4">
                                                            <img src="{{URL::asset('uploads/transport/vehicle_image/'.$vehicles[0]->vehicle_image)}}"onerror="this.onerror=null;this.src='{{ asset('uploads/errors/bus.jpg') }}'" height="50" width="50" class="img-rounded img-responsive" alt="VidhyApp" "> 
                                                        </div>
                                                    </div>
                                           <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" placeholder="" name="description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{$vehicles[0]->description}}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('description') }}
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
                                                <a href="{{ url('view-vehicles')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110"> View Vehicles</span>
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