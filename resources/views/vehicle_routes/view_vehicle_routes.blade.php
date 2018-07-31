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
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li  class="active"><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Reading</a></li>
                <li><a href="{{url ('view-fuel')}}"> Fuel</a></li>
                @endif

                @if(Session::get('user_type_id') == 8)
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li  class="active"><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                @endif
            </ul>
        </div><br>

        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Vehicles Routes </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-vehicle-route')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                            <th class="hasinput" style="width:3%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="Route Title" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Route From" />
                                            </th>
                                            
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Locations" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Route To" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Locations" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No </th>
                                            <th data-sortable="true">Route Title </th>
                                            <th data-sortable="true">Route From </th>
                                            
                                            <th data-sortable="true">Locations</th>
                                            <th data-sortable="true">Route To </th>
                                            
                                            <th data-sortable="true">Locations </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($vehicle_routs as $vehicle_rout) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$vehicle_rout->route_title}}</td>
                                                <td>{{$vehicle_rout->route_from}} <br> Start Time : {{$vehicle_rout->route_from_start_time}}  <br> End Time: {{$vehicle_rout->route_from_end_time}}</td>
                                                
                                                <td>Latitude:{{$vehicle_rout->route_from_latitude}} <br> Longitude:{{$vehicle_rout->route_from_longitude}}</td>
                                                <td>{{$vehicle_rout->route_to}} <br> Start Time : {{$vehicle_rout->route_to_start_time}}  <br> End Time: {{$vehicle_rout->route_to_end_time}} </td>
                                                
                                                <td>Latitude: {{$vehicle_rout->route_to_latitude}} <br> Longitude:{{$vehicle_rout->route_to_longitude}}</td>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-vehicle-route/'.$vehicle_rout->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-vehicle-route/'.$vehicle_rout->id) }}" onclick="return confirm('Are you sure to delete Vehicle Route Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($vehicle_rout->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-vehicle-route/'.$vehicle_rout->id)}}" title="Make inactive" >
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                 
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-vehicle-route/'.$vehicle_rout->id)}}" title="Make active" >
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
