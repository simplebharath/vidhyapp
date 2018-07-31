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
            <li>Reports</li><li>Staff</li>
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
                <li><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                <li><a href="{{url ('view-institute-students-marks')}}">Exams</a></li>
<!--                 <li><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
                 -->
                <li  class="active"><a href="{{url ('view-institute-staff')}}">Staff</a></li>
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
                        <h2>View Staff</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                    -->    
                    <form class="form-horizontal" action="{{url('view-institute-staff-pdf/2')}}" enctype="multipart/form-data" method="GET">
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
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                    <form class="form-horizontal" action="{{url('view-institute-staff-pdf/1')}}" target="_blank" enctype="multipart/form-data" method="GET">
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
                                            <form class="form-horizontal" action="{{url('view-institute-staff')}}" enctype="multipart/form-data" method="POST">
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
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Staff</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-staff')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>

                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder="Staff type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" readonly="" class="form-control" placeholder="Photo" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Staff id " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Name" />
                                            </th>
                                             <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Contact" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Staff type</th>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Photo</th>
                                            <th data-sortable="true">Staff id </th>
                                            <th data-sortable="true">Name</th>
                                            <th data-sortable="true">Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($staffs as $staff) {
                                            ?> 
                                            <tr class="">
                                                <td>{{ $staff->staff_types->title }} </td>
                                                <td>{{$staff->departments->title}}</td>
                                                <td><a href="{{url('view-staff-profile/'.$staff->id)}}"><img src="{{URL::asset('uploads/staff/'.$staff->photo)}}"  @if($staff->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($staff->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="30" width="30"></a>  </td>
                                                <td><a href="{{url('view-staff-profile/'.$staff->id)}}">{{$staff->staff_unique_id}}</a></td>                                               
                                                <td> <a href="{{url('view-staff-profile/'.$staff->id)}}">{{$staff->first_name}}  {{$staff->last_name}}</a> </td>    
                                                 <td>{{$staff->contact_number}} <br> {{$staff->email}}</td>
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
