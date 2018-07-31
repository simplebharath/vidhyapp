@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Transport</li><li>All Drivers</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
               <li  class="active"><a href="{{url ('driver-all-routes')}}">All Drivers</a></li>
                <li><a href="{{url ('driver-my-stops')}}">My stops </a></li>
            </ul>
        </div>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View All Vehicle Drivers </h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Staff " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Vehicle Type " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Vehicle " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Route " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Timings " />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            
                                            <th data-sortable="true">Staff</th>
                                            <th data-sortable="true">Vehicle Type</th>
                                            <th data-sortable="true">Vehicle </th>
                                            <th data-sortable="true">Route </th>
                                            <th data-sortable="true">Timings</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($drivers as $vehicle_driver) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$vehicle_driver->id}} </td>
                                               
                                                <td>{{$vehicle_driver->staff->first_name}} {{$vehicle_driver->staff->last_name}}</td>
                                                <td>{{$vehicle_driver->vehicle_type->title}}</td>
                                                <td> {{$vehicle_driver->vehicle->owner_name}} <br> {{$vehicle_driver->vehicle->vehicle_number}}</td>
                                                <td>{{$vehicle_driver->routes->route_title}} : <br> {{$vehicle_driver->routes->route_from}} - {{$vehicle_driver->routes->route_to}}</td>
                                                <td>
                                                    From start: {{$vehicle_driver->routes->route_from_start_time}} | End: {{$vehicle_driver->routes->route_from_end_time}} <br>
                                                    To start : {{$vehicle_driver->routes->route_to_start_time}}  | End: {{$vehicle_driver->routes->route_to_end_time}}
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
