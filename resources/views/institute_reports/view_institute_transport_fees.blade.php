@include('include.header')
@include('include.navigationbar')
<style>
    select[multiple]{
        min-width:130px !important;
    }
</style>
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Reports</li><li>Transport Fee</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-institute-classes')}}">Classes</a></li> 
                <li><a href="{{url ('view-institute-students')}}">Students</a></li> 
                <li><a href="{{url ('view-institute-timetable')}}">Class Timetable</a></li> 
                <li><a href="{{url ('view-institute-fees')}}">Class Fees</a></li> 
                <li  class="active"><a href="{{url ('view-institute-transport-fees')}}">Transport Fee</a></li> 
                <li><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                <li><a href="{{url ('view-institute-students-marks')}}">Exams</a></li>
<!--                <li><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
                -->
                <li><a href="{{url ('view-institute-staff')}}">Staff</a></li>
                <li><a href="{{url ('view-institute-staff-attendance')}}">Staff Attendance</a></li>
                <li><a href="{{url ('view-institute-staff-salary')}}">Staff Salary</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>View Transport Fee</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                      -->  
                    <form class="form-horizontal" action="{{url('view-institute-transport-fees-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 

                            @if($route_id !="")
                            @foreach($route_id as $route)
                            <input type="hidden" name="route_id[]"  value="{{$route}}">
                            @endforeach
                            @endif
                            @if($stop_id !="")
                            @foreach($stop_id as $stop)
                            <input type="hidden" name="stop_id[]" value="{{$stop}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                      <form class="form-horizontal" target="_blank" action="{{url('view-institute-transport-fees-pdf/1')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 

                            @if($route_id !="")
                            @foreach($route_id as $route)
                            <input type="hidden" name="route_id[]"  value="{{$route}}">
                            @endforeach
                            @endif
                            @if($stop_id !="")
                            @foreach($stop_id as $stop)
                            <input type="hidden" name="stop_id[]" value="{{$stop}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</button>
                        </form>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <div class="col-sm-12"><br>                                         
                                        <div class="row" id="">
                                            <label class="col-sm-1"> </label>
                                            <div class="col-sm-2">

                                            </div>
                                            <form class="form-horizontal" action="{{url('view-institute-transport-fees')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-3">
                                                    <select  name="route_id[]" multiple=""  class="">
                                                        <option value="">--- vehicle route(s)---</option> 
                                                        @foreach($routes as $route)
                                                        <option value="{{$route->id}}" <?php
                                                        if ($route_id != '') {
                                                            foreach ($route_id as $route_i) {
                                                                if ($route_i == $route->id) {
                                                                    ?> selected="selected" <?php
                                                            }
                                                        }
                                                    }
                                                        ?> >{{ $route->route_title }} {{ $route->route_from }}  {{ $route->route_to }}</option>
                                                        @endforeach
                                                    </select>                                          
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="stop_id[]" multiple="" class="">
                                                        <option value="">--- select stop(s)---</option> 
                                                        @foreach($stops as $stop)
                                                        <option value="{{$stop->id}}" <?php
                                                    if ($stop_id != '') {
                                                        foreach ($stop_id as $stop_i) {
                                                            if ($stop_i == $stop->id) {
                                                                ?> selected="selected" <?php
                                                            }
                                                        }
                                                    }
                                                        ?> >{{ $stop->stop_name }}  </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Fees</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-2">
                                                    <a href="{{url('view-institute-transport-fees')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Route" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Route title" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Stop" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Fee Type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Term Fee" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Total Fee" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S. No</th>
                                            <th data-sortable="true">Route</th>
                                            <th data-sortable="true">Route title</th>
                                            <th data-sortable="true">Stop</th>
                                            <th data-sortable="true">Fee Type</th>
                                            <th data-sortable="true">Term Fee</th>
                                            <th data-sortable="true">Total Fee</th> 

                                        </tr>
                                    </thead>
                                    <tbody>                                     
<?php $i = 1;
foreach ($transport_fees as $transport_fee) {
    ?>                                                                            
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td>{{$transport_fee->routes->route_title}}</td><td> {{$transport_fee->routes->route_from}} - {{$transport_fee->routes->route_to}} </td>
                                                <td>{{$transport_fee->route_stops->stop_name}}</td>
                                                <td>{{$transport_fee->fee_types->fee_name}}</td>
                                                <td>{{$transport_fee->transport_fee}}</td>
                                                <td>{{$transport_fee->transport_fee * $transport_fee->fee_types->yearly}}</td>
                                            </tr>
    <?php $i++;
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                </div>              
            </article>
        </div>
    </div>
</div>
@include('include.footer')
