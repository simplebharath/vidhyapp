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
            <li>Reports</li><li>Staff Attendance</li>
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
                <li><a href="{{url ('view-institute-transport-fees')}}">Transport Fee</a></li> 
                <li ><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                <li><a href="{{url ('view-institute-students-marks')}}">Exams</a></li>
<!--                <li><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
                -->
                <li><a href="{{url ('view-institute-staff')}}">Staff</a></li>
                <li class="active"><a href="{{url ('view-institute-staff-attendance')}}">Staff Attendance</a></li>
                <li><a href="{{url ('view-institute-staff-salary')}}">Staff Salary</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>View Staff Attendance</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                     -->   
                      <form class="form-horizontal" action="{{url('view-institute-staff-attendance-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            @if($staff_type_id !="")
                            @foreach($staff_type_id as $staff_type)
                            <input type="hidden" name="staff_type_id[]"  value="{{$staff_type}}">
                            @endforeach
                            @endif
                            @if($department_id !="")
                            @foreach($department_id as $department)
                            <input type="hidden" name="department_id[]" value="{{$department}}">
                            @endforeach
                            @endif
                            
                             @if($from_date !="")
                            <input type="hidden" name="from_date" value="{{$from_date}}">
                            @endif
                            
                             @if($to_date !="")
                            <input type="hidden" name="to_date" value="{{$to_date}}">
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                     <form class="form-horizontal" action="{{url('view-institute-staff-attendance-pdf/1')}}" target="_blank" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 
                            @if($staff_type_id !="")
                            @foreach($staff_type_id as $staff_type)
                            <input type="hidden" name="staff_type_id[]"  value="{{$staff_type}}">
                            @endforeach
                            @endif
                            @if($department_id !="")
                            @foreach($department_id as $department)
                            <input type="hidden" name="department_id[]" value="{{$department}}">
                            @endforeach
                            @endif
                            
                             @if($from_date !="")
                            <input type="hidden" name="from_date" value="{{$from_date}}">
                            @endif
                            
                             @if($to_date !="")
                            <input type="hidden" name="to_date" value="{{$to_date}}">
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

                                            <form class="form-horizontal" action="{{url('view-institute-staff-attendance')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="staff_type_id[]" multiple=""  class="">

                                                        @foreach($staff_types as $staff_type)
                                                        <option value="{{$staff_type->id}}" <?php
                                                        if ($staff_type_id != '') {
                                                            foreach ($staff_type_id as $staff_type_i) {
                                                                if ($staff_type_i == $staff_type->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $staff_type->title }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="department_id[]" multiple=""  class="">

                                                        @foreach($staff_departments as $staff_department)
                                                        <option value="{{$staff_department->id}}" <?php
                                                        if ($department_id != '') {
                                                            foreach ($department_id as $department_i) {
                                                                if ($department_i == $staff_department->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{$staff_department->staff_types->title[0] }} - {{ $staff_department->title }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" data-provide="datepicker" placeholder="From date" @if($from_date !='') value="{{$from_date}}" @endif name="from_date">                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" data-provide="datepicker" placeholder="To date"  @if($to_date !='') value="{{$to_date}}" @endif name="to_date">                                 
                                                </div>

                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Attendance</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-staff-attendance')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:5%">
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
                                            <th class="hasinput" style="width:20%">
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
                                                <td><img src="{{URL::asset('uploads/staff/'.$staff_attendance->staffs->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'" height="30" width="30"></td>
                                                <td> {{$staff_attendance->staff_types->title}} </td>
                                                <td> {{$staff_attendance->staff_departments->title}} </td>
                                                <td> {{$staff_attendance->staffs->first_name}} {{$staff_attendance->staffs->last_name}}</td>                                               
                                                <td> {{  date("d-m-Y", strtotime($staff_attendance->attendance_date))}}</td>
                                                <td>  @if($staff_attendance->attendance_status == 1) Present @else Absent @endif </td>
                                                <td> @if($staff_attendance->attendance_status == 0) {{$staff_attendance->reason}} @else - @endif</td>
                                                <td class="col-md-3">{{$staff_attendance->created_at->format('l jS \\of F Y h:i:s A')}}</td
                                            </tr>
                                        <?php } ?>
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
