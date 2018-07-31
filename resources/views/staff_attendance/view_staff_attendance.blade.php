@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Staff</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li ><a href="{{url ('view-staff')}}">Staff</a></li>   
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li class="active"><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Staff Attendance</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('edit-staff-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                             <th class="hasinput" style="width:6%">
                                                 <input type="text" readonly="" class="form-control" placeholder="Photo" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Staff type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Staff name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" data-provide="datepicker"  class="form-control" placeholder="Select date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Attendance" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="reason" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Taken on" />
                                            </th>
                                           

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Photo</th>   
                                            <th data-sortable="true">Staff type</th>                                          
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Staff name</th>         
                                            <th >Date</th>
                                            <th >Attendance</th>
                                            <th >Reason</th>
                                            <th >Taken on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($staff_attendances as $staff_attendance) {
                                            ?> 
                                            <tr class="">
                                                <td><img src="{{URL::asset('uploads/staff/'.$staff_attendance->staffs->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'" height="50" width="50"></td>
                                                <td> {{$staff_attendance->staff_types->title}} </td>
                                                <td> {{$staff_attendance->staff_departments->title}} </td>
                                                <td> {{$staff_attendance->staffs->first_name}} {{$staff_attendance->staffs->last_name}}</td>                                               
                                                 <td> {{  date("d-m-Y", strtotime($staff_attendance->attendance_date))}}</td>
                                                <td>  @if($staff_attendance->attendance_status == 1) Present @else Absent @endif </td>
                                                <td>{{$staff_attendance->reason}}</td>
                                                <td class="col-md-3">{{$staff_attendance->created_at->format('l jS \\of F Y h:i:s A')}}</td>

                                            </tr>
                                        <?php } ?>
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
