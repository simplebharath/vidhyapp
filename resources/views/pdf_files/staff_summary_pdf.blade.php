<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 5px;
        font-weight: 100;
    }
    body{
        font-family: arial, sans-serif;
    }
    .head{
        border:none;
        padding-bottom:0px; margin-bottom: 0px;
    }
</style>
 <div style="float:left;max-width:50px;">
                    <img width="80" height="80"  @if($institute[0]->institution_logo !="")  src="{{ asset('uploads/logo/'.$institute[0]->institution_logo) }}" @else  src="{{ asset('uploads/errors/200.png') }}" @endif style="width:80px;height: 80px;border-radius: 50%;padding-left:180px;">
                </div>
<center>
    <p style="font-size: 25px; padding-bottom: 0px;margin-bottom: 0px;"> {{$institute[0]->institution_name}}</p>
    <span style="font-size: 14px; padding-top: 0px; margin-top: 0px;">&nbsp; <em>{{$institute[0]->address}}, {{$institute[0]->office_contact_number1}}</em></span>
</center>

<table>
    <tr style="padding-bottom:0px; margin-bottom: 0px;">
        <td class="head" style="width:40%;"> <h2>{{$staffs[0]->first_name }} {{$staffs[0]->middle_name}} {{ $staffs[0]->last_name}} </h2></td>
        <td class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td class="head" style="width:30%; font-size: 14px;">  Staff Id : #{{$staffs[0]->staff_unique_id}}<br> 
            Academic year :{{ date('Y', strtotime($staffs[0]->academic_years->from_date))}} - {{ date('Y', strtotime($staffs[0]->academic_years->to_date))}}
        </td>
    </tr>
</table>

<hr>
<table>
    <tr style="padding-bottom:0px; margin-bottom: 0px;">
                <td class="head" style="width:10%;"><img width="80" height="75" style="float:left; border-radius: 50%;padding: 5px;" @if($staffs[0]->photo !="") src="{{URL::asset('uploads/staff/'.$staffs[0]->photo)}}" @elseif($staffs[0]->gender="Male") src="{{URL::asset('uploads/errors/staff_male.png')}}" @elseif($staffs[0]->gender="Female") src="{{URL::asset('uploads/errors/staff_female.png')}}" @endif >
    </td>
        <td class="head" style="width:20%;font-size: 14px;">Staff Info 
            <br>  {{$staffs[0]->first_name }} {{ $staffs[0]->last_name}} 
           @if($staffs[0]->class_teachers !="")  <br>Class Teacher: {{$staffs[0]->class_teachers->classes->class_name}} @if($staffs[0]->class_teachers->section_id != 0) - {{ $staffs[0]->class_teachers->sections->section_name}} @endif @endif
            <br>User Type: {{$staffs[0]->user_types->title}}
            <br>{{ $staffs[0]->staff_types->title}} - {{$staffs[0]->departments->title}} 
        </td>
        <td  class="head" style="width:50%;">&nbsp;</td>
        <td class="head" style="width:25%; font-size: 14px;"> Father/Guardian <br> {{$staffs[0]->father_name}}<br> 
            {{$staffs[0]->father_number}} <br>{{$staffs[0]->present_address}}
        </td>
    </tr>
</table>

<h3 style="padding-bottom:5px; margin-bottom: 5px;clear:both;">Staff Profile</h3>
<table>           
    <tr><td><span style="color:grey;">First Name:</span> &nbsp; {{ $staffs[0]->first_name}} </td><td><span style="color:grey;">Middle Name:</span> &nbsp; {{$staffs[0]->middle_name}}</td><td><span style="color:grey;">Last Name:</span> &nbsp;{{$staffs[0]->last_name}}</td></tr>
    <tr><td><span style="color:grey;">Class Teacher:</span> &nbsp; @if($staffs[0]->class_teachers !="") {{$staffs[0]->class_teachers->classes->class_name}} @if($staffs[0]->class_teachers->section_id != 0) - {{ $staffs[0]->class_teachers->sections->section_name}} @endif @else NA @endif</td><td><span style="color:grey;">Staff Id:</span> &nbsp;{{$staffs[0]->staff_unique_id}}</td><td><span style="color:grey;">User type</span> &nbsp;{{$staffs[0]->user_types->title}}</td></tr>
    <tr><td><span style="color:grey;">Staff Type: </span> &nbsp;{{ $staffs[0]->staff_types->title}}</td><td><span style="color:grey;">Department:</span> &nbsp;{{$staffs[0]->departments->title}}</td> <td><span style="color:grey;">Designation:</span> &nbsp; {{$staffs[0]->emp_designation}}</td></tr>                   
    <tr><td><span style="color:grey;">Employee Id: </span> &nbsp;{{ $staffs[0]->employee_id}}</td><td><span style="color:grey;">Email:</span> &nbsp;{{$staffs[0]->email}}</td><td><span style="color:grey;">Contact Number:</span> &nbsp; {{$staffs[0]->contact_number}}</td></tr>
    <tr><td><span style="color:grey;">Emergency Number: </span> &nbsp;{{ $staffs[0]->emergency_number}}</td><td><span style="color:grey;">Date of birth:</span> &nbsp;{{$staffs[0]->date_of_birth}}</td> <td><span style="color:grey;">Joined date:</span> &nbsp; {{$staffs[0]->joined_date}}</td></tr>
    <tr><td><span style="color:grey;">Gender : </span> &nbsp;{{$staffs[0]->gender}}</td><td><span style="color:grey;">Domicile:</span> &nbsp;{{$staffs[0]->domicile}}</td> <td><span style="color:grey;">Caste:</span> &nbsp; {{$staffs[0]->caste}}</td></tr>   
    <tr><td><span style="color:grey;">Blood Group : </span> &nbsp;{{$staffs[0]->blood_group}}</td><td><span style="color:grey;">Religion:</span> &nbsp;{{$staffs[0]->religion}}</td> <td><span style="color:grey;">Nationality : </span> &nbsp;{{ $staffs[0]->nationality}}</td></tr>
    <tr><td><span style="color:grey;">Marital status:</span> {{$staffs[0]->marital_status}}</td> <td><span style="color:grey;">Spouse Name:</span> &nbsp; {{$staffs[0]->spouse_name}}</td><td><span style="color:grey;">Children : </span> &nbsp;{{ $staffs[0]->child_number}}</td></tr>
    <tr><td><span style="color:grey;">Aadhaar Number:</span> {{$staffs[0]->aadhaar_number}}@if($staffs[0]->occupation !='') <br>Spouse Occupation: {{$staffs[0]->occupation}} @endif</td><td><span style="color:grey;">Permanent Address:</span> <br> {{$staffs[0]->permanent_address}}</td><td><span style="color:grey;">Present Address:</span> <br> {{$staffs[0]->present_address}}</td></tr>
    <tr><td><span style="color:grey;">Experience:</span> &nbsp; {{$staffs[0]->experience}}</td><td><span style="color:grey;">Father: </span> &nbsp;{{ $staffs[0]->father_name}}</td><td><span style="color:grey;">F.Mobile Number:</span> &nbsp;{{$staffs[0]->father_number}}</td> </tr> 
</table>


@if(COUNT($staff_qualifications) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Educational Qualifications</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th data-sortable="true">S.No.</th>
                <th data-sortable="true">Degree</th>
                <th data-sortable="true">Institute</th>
                <th data-sortable="true">Course</th>             
                <th data-sortable="true">Specialization</th>
                <th data-sortable="true">GPA</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($staff_qualifications as $staff_qualification) {
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$staff_qualification->qualification}}</td>
                    <td>{{$staff_qualification->institute_name}}</td>
                    <td>{{$staff_qualification->course_name}}</td>
                    <td>{{$staff_qualification->stream_branch}}</td>
                    <td>{{$staff_qualification->percentage}}</td>                                          

                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Educational Qualifications</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

@if(COUNT($staff_documents) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Staff Documents</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th>S No</th>
                <th data-class="expand">File name</th>
                <th>Document</th>
                <th data-hide="phone">Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($staff_documents as $staff_document) {
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td><a> {{ $staff_document->file_name }} </a></td>
                 <td>@if($staff_document->document !='')<img src="{{URL::asset('uploads/staff_documents/'.$staff_document->document)}}"  alt="document" title="{{$staff_document->file_name}}" class="superbox-img" style="width:100px;height: 60px;">@else No document @endif</td>                                          
                    
                    <td>{{$staff_document->created_at->format('d-m-Y')}}</td>

                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Staff  Documents</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif


@if(COUNT($staff_experiences) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Previous Experience</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th data-sortable="true">S. No.</th>
                <th data-sortable="true">Organization</th>
                <th data-sortable="true">Position</th>
                <th data-sortable="true">From</th>             
                <th data-sortable="true">To</th>
                <th data-sortable="true">Total Experience</th>                                           
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($staff_experiences as $staff_experience) {
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$staff_experience->organisation_name}}</td>
                    <td>{{$staff_experience->position}}</td>
                    <td>{{$staff_experience->from_year}}</td>
                    <td>{{$staff_experience->to_year}}</td>
                    <td>{{$staff_experience->total_years}}</td>                                          

                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Previous Experience</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

@if(COUNT($staff_attendances) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Attendance</h3>
    <table width="100%">
        <thead> 
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
            foreach ($staff_attendances as $staff_attendance) {
                if (is_numeric($staff_attendance->working_days)) {
                    $total+= $staff_attendance->working_days;
                    $present+= $staff_attendance->present;
                    $absent+= ($staff_attendance->working_days - $staff_attendance->present);
                }
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td><span class="">{{$staff_attendance->month}} - {{$staff_attendance->year}}</td>
                    <td>{{$staff_attendance->working_days}}</td>
                    <td>{{$staff_attendance->present}}</td>
                    <td>{{$staff_attendance->working_days - $staff_attendance->present}}</td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
        @if($total != 0 )
        <tr><td></td><td><b>Total (  {{ number_format((($present/$total)*100),2) }} &#37; )</b></td><td><b>{{$total}}</b></td><td><b>{{$present}}</b></td>
            <td> <b>{{$absent}} </b></td></tr>
        @endif
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Attendance</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Salary Monthly</h3>
    <table>
        <tr>
            <th>Basic salary</th>
            <th>Incentives</th>
            <th>Other salary</th>
            <th>Cuttings</th>
            <th><b>Total salary</b></th>
        </tr>
        <tr>
            <td>{{$staffs[0]->basic_salary}}</td>
            <td>{{$staffs[0]->incentives}}</td>
            <td>{{$staffs[0]->other_salary}}</td>
            <td>{{$staffs[0]->salary_cuttings}}</td>
            <td><b>{{$staffs[0]->total_salary}}</b></td>
        </tr>
    </table>
</div>

@if(COUNT($staff_salaries) !=0)
<div>
    <h4 style="padding-bottom:2px; margin-bottom: 2px; text-align: center" >Paid Salary</h4>
    <table width="100%">
        <thead> 
            <tr>                   
                <th data-sortable="true">Month</th>
                <th data-sortable="true">Total salary</th> 
                <th data-sortable="true">Deducted </th>
                <th data-sortable="true">Gross salary</th>
                <th>Remarks</th>
                <th>Paid On</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($staff_salaries as $staff_salary) {
                ?> 
                <tr class="">                                                 
                    <td>{{$staff_salary->months->month}}</td>
                    <td> {{ $staff_salary->staff->total_salary}}</td>
                    <td> {{ $staff_salary->deducted_salary}}</td>
                    <td>{{ $staff_salary->gross_salary}}</td>
                    <td> {{ $staff_salary->remark }} </td> 
                    <td>{{$staff_salary->created_at->format('d-m-Y')}}</td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>	
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Paid Salary</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

@if(COUNT($staff_timetables) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Time Table</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th>S.No.</th>
                <th data-class="expand">Day</th>
                <th>Class</th>
                <th data-hide="phone">Subject</th>
                <th data-hide="phone">Period</th>
                <th data-hide="phone">Timings</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($staff_timetables as $staff_timetable) {
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$staff_timetable->day_title}}</td>
                    <td>{{$staff_timetable->class_name}} @if ($staff_timetable->section_id >0 ) - {{$staff_timetable->section_name}} @endif </td>
                    <td>{{$staff_timetable->subject_name}}</td>
                    <td>{{$staff_timetable->title}}</td>
                    <td>{{$staff_timetable->class_start}} {{$staff_timetable->class_end}} ({{$staff_timetable->duration}})</td>


                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>			
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Time Table</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif
<br>
<hr>
<p style="text-align: center;">THE END</p>
@if($print==1)
<script type="text/javascript"> try {
        this.print();
    } catch (e) {
        window.onload = window.print;
    }</script>
@endif