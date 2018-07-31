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
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li class="active"><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Reading</a></li>
                <li><a href="{{url ('view-fuel')}}"> Fuel</a></li>
                @endif
                @if(Session::get('user_type_id') == 8)
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li  ><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li class="active"><a href="{{url ('view-route-stops')}}">Route stops</a></li>
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
                        <h2> View Route Stops </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-route-stop')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="route_title" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="stop_name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="location" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="timings" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Route Title</th>
                                            <th data-sortable="true">Stop Name</th>
                                            <th data-sortable="true">Location</th>
                                            <th data-sortable="true">Timings </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($route_stops as $route_stop) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td> {{$route_stop->vehicle_route->route_title}} <br> From : {{$route_stop->vehicle_route->route_from}} <br> To : {{$route_stop->vehicle_route->route_to}}</td>
                                                <td>{{$route_stop->stop_name}}</td>
                                                <td>Latitude : {{ $route_stop->stop_latitude }} <br> Longitude : {{$route_stop->stop_longitude}}</td>
                                                <td>From : {{$route_stop->pickup_time}} <br> TO : {{$route_stop->drop_time}} </td>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-route-stop/'.$route_stop->id)}}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-route-stop/'.$route_stop->id) }}" onclick="return confirm('Are you sure to delete Route Stop Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($route_stop->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-route-stop/'.$route_stop->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-route-stop/'.$route_stop->id)}}" title="Make active">
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
