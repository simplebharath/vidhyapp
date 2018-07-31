@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Transport</li><li>Fuel</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                <li><a href="{{url ('view-vehicle-types')}}">Vehicle Types</a></li>
                <li><a href="{{url ('view-vehicles')}}">Vehicles </a></li>
                <li><a href="{{url ('view-vehicles-routes')}}">Vehicles Routes</a></li>
                <li><a href="{{url ('view-route-stops')}}">Route stops</a></li>
                <li><a href="{{url ('view-vehicle-drivers')}}">Vehicle Drivers</a></li>
                <li><a href="{{url ('view-meter-reading')}}">Meter Readings</a></li>
                <li  class="active"><a href="{{url ('view-fuel')}}"> Fuel</a></li>
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
                        <h2> View Fuel </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-fuel')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Vehicle" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Rate / Litre" />
                                            </th>
                                            <th class="hasinput" style="width:9%">
                                                <input type="text" class="form-control" placeholder="Kilometers" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Cost" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" data-provide="datepicker" class="form-control" placeholder="Date" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Remarks" />
                                            </th>
                                           @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No </th>
                                            <th data-sortable="true">Vehicle</th>
                                            <th data-sortable="true">Rate Per Litre </th>
                                            <th data-sortable="true">Kilometers </th>
                                            <th data-sortable="true">Cost</th>
                                            <th data-sortable="true">Date</th>
                                            <th data-sortable="true">Remarks</th>
                                           @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                            <th>Actions</th>
                                           
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($fuels as $fuel) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$fuel->fuels->staff->first_name}} <br> {{$fuel->fuels->vehicle->vehicle_number}} <br> {{$fuel->fuels->routes->route_title}}</td>
                                                <td>{{$fuel->rate_for_liter}}</td>
                                                <td>{{$fuel->kilometre}}</td>
                                                <td>{{$fuel->rate_for_liter * $fuel->kilometre}}</td>
                                                <td>{{$fuel->date}}</td>
                                                <td>{{$fuel->remarks}}
                                                  @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-fuel/'.$fuel->id)}}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-fuel/'.$fuel->id) }}" onclick="return confirm('Are you sure to delete fuel details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($fuel->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-fuel/'.$fuel->id)}}">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-fuel/'.$fuel->id)}}">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                
                                                @endif    
                                                </td>
                                                @endif
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
