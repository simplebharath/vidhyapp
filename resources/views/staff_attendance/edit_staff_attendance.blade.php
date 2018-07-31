@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
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
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Edit Staff Attendance </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('update-staff-attendance')}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <div class="dt-toolbar pull-right" style="float:right;">
                                            <div class="col-sm-1">
                                                <label>Attendance date</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" placeholder="Select date" name="attendance_date" readonly="" value="{{$attendance_date}}" class="form-control">
                                                <label class=""  title=""  data-original-title="Select Date"></label>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="width-10 btn btn-md btn-info">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update Attendance</span>
                                                </button>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:3%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" readonly="" class="form-control" placeholder="Department" />
                                                </th>
                                                <th class="hasinput" style="width:6%">
                                                    <input type="text" readonly="" class="form-control" placeholder="Image" />
                                                </th>
                                                <th class="hasinput" style="width:18%">
                                                    <input type="text" class="form-control" placeholder="Staff" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text"  class="form-control" placeholder="Details" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Attendance" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Reason" />
                                                </th>

                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S No</th>
                                                <th data-sortable="true">Type-department</th>
                                                <th data-sortable="true">Image</th>
                                                <th data-sortable="true">Staff</th>
                                                <th data-sortable="true">Details</th>
                                                <th data-sortable="true">Attendance</th>
                                                <th data-sortable="true">Reason</th>             

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($staffs as $staff) {
                                                ?> 
                                            <tr class="">        
                                                <input type="text" hidden="" value="{{$staff->id}}" name="attendance_id">
                                            <input type="text" hidden="" value="{{$staff->staff_type_id}}" name="staff_type_id[<?php echo $staff->staff_id; ?>]">
                                            <input type="text" hidden="" value="{{$staff->staff_department_id}}" name="staff_department_id[<?php echo $staff->staff_id; ?>]">
                                            <td>{{$i}}</td>
                                            <td>{{$staff->staff_types->title}} - {{$staff->staff_departments->title}}</td>
                                            <td><img src="{{URL::asset('uploads/staff/'.$staff->staffs->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'" height="50" width="50"></td>                       
                                            <td>User type : {{$staff->staffs->user_types->title}}<br> Name  : {{$staff->staffs->first_name}}  {{$staff->staffs->last_name}}<br> Mobile :{{ $staff->staffs->contact_number }} </td>
                                            <td>Employee Id : {{$staff->staffs->employee_id}}<br>Department : {{$staff->staffs->departments->title}}<br>Designation:  {{$staff->staffs->emp_designation}}</td>                                                    
                                            <td data-sortable="true">  
                                                <input  hidden="" name="attendance_status[<?php echo $staff->staff_id; ?>]" value="0" >
                                                <input type="checkbox" value="1"  name="attendance_status[<?php echo $staff->staff_id; ?>]"   @if( $staff->attendance_status == 1) checked @endif >                                                        
    <!--                                            <span  id="{{ $staff->id }}"  class="present">Present</span> <span id="{{ $staff->id }}" class="absent">Absent</span>-->
                                            </td>                                                  
                                            <td><input type="text" name="reason[<?php echo $staff->staff_id; ?>]" value="{{$staff->reason}}"></td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>     
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
<!--<script>
//      var cookieValue = document.getElementById("attendance_id").value;    
//    alert(cookieValue);
       
        var attendance = document.querySelector('.attendance_status').id;
         $(".absent").hide();
        $(".present").hide();
        $(".attendance_status").change(function () {
            //alert('hi');
            if ($('.attendance_status').is(":checked")) {
                 $(".present").show();
            } else {
                $(".present").hide();
                $(".absent").show();
            }
        });
</script>-->