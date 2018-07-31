@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Staff</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li>     
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        @endif
        <section id="" class="">
            <div class="row">
                <div class=""style="margin-left: 15px;">
                    <ul class="nav nav-tabs pull-left">
                        <li ><a href="{{url ('view-staff-profile/'.$staffs[0]->id)}}">Profile</a></li>
                        <li><a href="{{url ('view-staff-experiences/'.$staffs[0]->id)}}">Experience</a></li>
                        <li ><a href="{{url ('view-staff-qualifications/'.$staffs[0]->id)}}">Qualifications</a></li> 
                        <li ><a href="{{url ('view-staff-documents/'.$staffs[0]->id)}}">Documents</a></li>
                         @if(Session::get('user_type_id') == 4)  <li><a href="{{url ('view-staff-timetable/'.$staffs[0]->id)}}">Timetable</a></li> @endif
                        <li class="active"><a href="{{url ('view-staff-total-attendance/'.$staffs[0]->id)}}">Attendance</a></li>
                        <li ><a href="{{url ('view-staff-salary/'.$staffs[0]->id)}}">Salary</a></li>
                        
                    </ul>
                </div>
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('include.messages')
                    <div class="col-sm-12 col-md-12 col-lg-4">
                    @include('staff_details.include_staff_profile')
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="false">
                            @if(Session::get('view') == 1)
                            <header>
                                <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                <h2> View <b> {{$staffs[0]->first_name}} {{$staffs[0]->middle_name}} {{$staffs[0]->last_name}}</b> Attendance </h2>
                                
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
                                                    <input type="text" class="form-control" placeholder="Month" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Working days" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Present" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Absent" />
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>S No</th>
                                                <th data-class="expand"> Month</th>
                                                <th>Working days</th>
                                                <th data-hide="phone">Present</th>
                                                <th data-hide="phone">Absent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                             $i = 1;
            $total = 0;
            $present = 0;
            $absent = 0;
                                            
                                            foreach($staff_attendances as $staff_attendance) {
                                                 if (is_numeric($staff_attendance->working_days)) {
                    $total+= $staff_attendance->working_days;
                    $present+= $staff_attendance->present;
                    $absent+= ($staff_attendance->working_days - $staff_attendance->present);
                }
                                                ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><span class=""><a href="{{url('view-staff-monthly-attendance/'.$staff_attendance->month.'/'.$staff_attendance->staff_id)}}">{{$staff_attendance->month}} - {{$staff_attendance->year}}</a></span></td>
                                                <td>{{$staff_attendance->working_days}}</td>
                                                <td>{{$staff_attendance->present}}</td>
                                                <td>{{$staff_attendance->working_days - $staff_attendance->present}}</td>
                                            </tr>
                                            <?php $i++; }?>
                                             @if($total != 0 )
                                             <tr><td ><p class="hidden">100</p></td><td><b>Total (  {{ number_format((($present/$total)*100),2) }} &#37; )</b></td><td><b>{{$total}}</b></td><td><b>{{$present}}</b></td>
            <td> <b>{{$absent}} </b></td></tr>
        @endif
                                        </tbody>
                                    </table>			
                                </div>
                            </div>

                            @else                                                                                                          
                            <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this 'View Documents' service.Please contact administrator.</h3>
                            @endif 
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>

@include('include.footer')

