@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li ><a href="{{url ('view-students-attendance')}}">Attendance</a></li>
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        @endif
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li><a href="{{url ('view-student-profile/'.$students[0]->id)}}">Profile</a></li>
                    <li><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li ><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li ><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                    <li><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                    <li><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
                    <li ><a href="{{url ('view-student-assignments/'.$students[0]->id)}}">Assignments</a></li>
                    <li><a href="{{url ('view-student-remarks/'.$students[0]->id)}}">Remarks</a></li>
                    <li><a href="{{url ('view-student-exams/'.$students[0]->id)}}">Marks</a></li>
                    @if($students[0]->student_type_id == 1)
                    <li class="active"><a href="{{url ('view-student-transport/'.$students[0]->route_id.'/'.$students[0]->stop_id.'/'.$students[0]->id)}}">Transport</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            @include('student_profile.include_profile')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                    <h2> Transport </h2>                                    
                                    
                                </header>		
                                <div>
                                    <div class="widget-body no-padding">
                                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                            <thead>
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="File name" />
                                            </th>                                       
                                        </tr>
                                            </thead>
                                            <?php if(COUNT($routes) != 0) { ?>
                                            <tbody>                                                                                        
                                                <tr>  <td>Vehicle Type</td>  <td>{{$routes[0]->vehicle_type->title}}</td></tr>
                                                <tr>  <td>Route Number</td>  <td>{{$routes[0]->routes->route_title}}</td></tr>
                                                <tr>  <td>Route From</td>  <td>{{$routes[0]->routes->route_from}} ( {{$routes[0]->routes->route_from_start_time}} - {{$routes[0]->routes->route_from_end_time}} ) </td></tr>
                                                <tr>  <td>Route To</td>  <td>{{$routes[0]->routes->route_to}} ( {{$routes[0]->routes->route_to_start_time}} - {{$routes[0]->routes->route_to_end_time}} )</td></tr>
                                                <tr>  <td>Driver</td>  <td>{{$routes[0]->staff->first_name}} {{$routes[0]->staff->last_name}} ({{$routes[0]->staff->contact_number}})</td></tr>
                                                <?php $i=1; foreach($stops as $stop) { ?>
                                                <tr>  <td>Stop {{$i}}  @if($stop->id == $students[0]->stop_id )( <b> Student Boarding Stop </b> )</td> @endif </td>  
                                                    <td>
                                                        @if($stop->id == $students[0]->stop_id )<b> {{$stop->stop_name}} </b> ( Pickup time : {{$stop->pickup_time}} - Drop time : {{$stop->drop_time}} ) <br>Address :  {{$stop->stop_address}} 
                                                    @else {{$stop->stop_name}} ( Pickup time : {{$stop->pickup_time}} - Drop time : {{$stop->drop_time}} ) @endif 
                                                    
                                                    </td>
                                                </tr>
                                                <?php $i++; } ?>
                                                </tr>
                                            </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@include('include.footer')
