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
                <li ><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        @endif
        <section  class="">
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
                        <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                            @if(Session::get('view') == 1)
                            <header>
                                <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                <h2> View <b> {{$staffs[0]->first_name}} {{$staffs[0]->middle_name}} {{$staffs[0]->last_name}}</b> Attendance of Month <b> {{$month}} -  {{$year}} </b></h2>
                                <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-total-attendance/'.$staffs[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i>  Back </a>
                            </header>		
                            <div>

                                <div class="widget-body no-padding">
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">				
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Day" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" data-provide="datepicker" class="form-control" placeholder="Select date" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Attendance" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Reason" />
                                                </th>

                                            </tr>
                                            <tr>
                                                <th>S No</th>
                                                <th data-class="expand">Day</th>
                                                <th>Date</th>
                                                <th data-hide="phone">Attendance</th>
                                                <th data-hide="phone">Reason</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($staff_attendances as $staff_attendance) { ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$staff_attendance->day}}</td>
                                                    <td>{{$staff_attendance->date}}</td>
                                                    <td>@if($staff_attendance->attendance_status == 1)Present @else<span style="color:red;"> Absent </span>@endif</td>
                                                    <td>{{$staff_attendance->reason}}</td>
                                                </tr>
    <?php $i++;
} ?>
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

