@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Transport Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                <li ><a href="{{url ('view-vehicle-types')}}">Vehicle Types</a></li>
                <li class="active"><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Reading</a></li>
                <li><a href="{{url ('view-fuel')}}"> Fuel</a></li>
                @endif
                @if(Session::get('user_type_id') == 8)
                <li class="active"><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li  ><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li  ><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                @endif
            </ul>
        </div><br>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Vehicles </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-vehicle')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="vehicle type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Vehicle Number" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Engine Number" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Owner Name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Owner Phone Number" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Owner Email" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="Owner Image" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="Vehicle Image" />
                                            </th>
                                           
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            
                                           <th class="hasinput" style="width:8%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Vehicle Type</th>
                                            <th data-sortable="true">Vehicle Number</th>
                                            <th data-sortable="true">Engine Number</th>
                                            <th data-sortable="true">Owner Name</th>
                                            <th data-sortable="true">Phone Number</th>
                                            <th data-sortable="true"> Email</th>
                                            <th data-sortable="true"> Image</th>
                                            <th data-sortable="true"> Vehicle</th>
                                            
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th>Actions</th>                                            
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($vehicles as $vehicle) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$vehicle->vehicle_type->title}}</td>
                                                <td>{{$vehicle->vehicle_number }}</td>
                                                <td>{{$vehicle->engine_number  }}</td>
                                                <td>{{$vehicle->owner_name}}</td>
                                                <td>{{$vehicle->owner_number }}</td>
                                                <td>{{$vehicle->owner_email  }}</td>
                                                <td><img src="{{URL::asset('uploads/transport/owner_image/'.$vehicle->owner_image)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/father1.png') }}'" height="50" width="50"></td>
                                                <td><img src="{{URL::asset('uploads/transport/vehicle_image/'.$vehicle->vehicle_image)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/bus.jpg') }}'" height="50" width="50"></td>
                                                
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                                
                                                
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ url('edit-vehicle/'.$vehicle->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-vehicle/'.$vehicle->id) }}" onclick="return confirm('Are you sure to delete Vehicle Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                   
                                               
                                                @if($vehicle->status==1)
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-vehicle/'.$vehicle->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                
                                              @else
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-vehicle/'.$vehicle->id)}}" title="Make active">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                
                                                
                                                @endif
                                                @endif
                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>        
            </article>
        </div>
    </div>
</div>
@include('include.footer')
