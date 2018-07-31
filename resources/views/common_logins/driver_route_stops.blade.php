@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Transport</li><li>My stops</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('driver-all-routes')}}">All Drivers</a></li>
                <li  class="active"><a href="{{url ('driver-my-stops')}}">My stops </a></li>
            </ul>
        </div><br>

        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View My Route Stops </h2>
                        
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
                                            
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Route Title</th>
                                            <th data-sortable="true">Stop Name</th>
                                            <th data-sortable="true">Location</th>
                                            <th data-sortable="true">Timings </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($stops as $stop) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td> {{$stop->vehicle_route->route_title}} <br> From : {{$stop->vehicle_route->route_from}} <br> To : {{$stop->vehicle_route->route_to}}</td>
                                                <td>{{$stop->stop_name}}</td>
                                                <td>Latitude : {{ $stop->stop_latitude }} <br> Longitude : {{$stop->stop_longitude}}</td>
                                                <td>From : {{$stop->pickup_time}} <br> TO : {{$stop->drop_time}} </td>
                                                
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
