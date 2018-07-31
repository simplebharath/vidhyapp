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
        <td class="head" style="width:40%;"> <h2>{{$student[0]->first_name }} {{$student[0]->middle_name}} {{ $student[0]->last_name}} </h2></td>
        <td class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td class="head" style="width:30%; font-size: 14px;">  Student Id : #{{$student[0]->unique_id}}<br> 
            Academic year :{{ date('Y', strtotime($student[0]->academic_years->from_date))}} - {{ date('Y', strtotime($student[0]->academic_years->to_date))}}
        </td>
    </tr>
</table>

<hr>

<table>
    <tr style="padding-bottom:0px; margin-bottom: 0px;">
        <td class="head" style="width:10%;"><img width="80" height="75" style="float:left; border-radius: 50%;" src="{{URL::asset('uploads/students/profile_photos/'.$student[0]->photo)}}"  @if($student[0]->photo =="") @if($student[0]->gender="Male") src="{{URL::asset('uploads/errors/student_male.png')}}" @else src="{{URL::asset('uploads/errors/student_female.png')}}" @endif @endif>
        </td>

        <td class="head" style="width:20%;font-size: 14px;">Student Info <br> {{$student[0]->first_name }}{{ $student[0]->last_name}} <br>Class : {{$student[0]->classes->class_name}} @if($student[0]->class_sections->section_id != 0) - {{ $student[0]->class_sections->sections->section_name}} @endif
            <br>Roll No: {{$student[0]->roll_number}}</td>
        <td class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td class="head" style="width:10%;"><img width="80" height="75" style="float:right; border-radius: 50%;"  src="{{URL::asset('uploads/students/father/'.$student[0]->parents->father_photo)}}" @if($student[0]->parents->father_photo =="") src="{{URL::asset('uploads/errors/father.png')}}" @endif >
        </td>
        <td class="head" style="width:30%; font-size: 14px;"> Father/Guardian <br> {{$student[0]->father_name}}<br> 
            {{$student[0]->father_number}} <br>{{$student[0]->present_address}}
        </td>
    </tr>
</table>
<br><br>
<h3 style="padding-bottom:5px; margin-bottom: 5px;clear:both;">Student Profile</h3>
<table>           
    <tr><td><span style="color:grey;">First Name:</span> &nbsp; {{ $student[0]->first_name}} </td><td><span style="color:grey;">Middle Name:</span> &nbsp; {{$student[0]->middle_name}}</td><td><span style="color:grey;">Last Name:</span> &nbsp;{{$student[0]->last_name}}</td></tr>
    <tr><td><span style="color:grey;">Class:</span> &nbsp; {{ $student[0]->class_sections->classes->class_name}} @if($student[0]->class_sections->section_id != 0) - {{$student[0]->class_sections->sections->section_name}} @endif</td><td><span style="color:grey;">Roll Number:</span> &nbsp;{{$student[0]->roll_number}}</td><td><span style="color:grey;">Student Id:</span> &nbsp;{{$student[0]->unique_id}}</td></tr>
    <tr><td><span style="color:grey;">Admission number: </span> &nbsp;{{ $student[0]->admission_number}}</td><td><span style="color:grey;">Joined Date:</span> &nbsp;{{$student[0]->joined_date}}</td><td><span style="color:grey;">Email Id:</span> &nbsp; {{$student[0]->email}}</td></tr>
    <tr><td><span style="color:grey;">Date of Birth number: </span> &nbsp;{{ $student[0]->date_of_birth}}</td><td><span style="color:grey;">UID:</span> &nbsp;{{$student[0]->aadhaar_number}}</td> <td><span style="color:grey;">Admission type:</span> &nbsp; {{$student[0]->student_types->title}}</td></tr>
    <tr><td><span style="color:grey;">Father: </span> &nbsp;{{ $student[0]->father_name}}</td><td><span style="color:grey;">Mobile Number:</span> &nbsp;{{$student[0]->father_number}}</td> <td><span style="color:grey;">Father Email Id:</span> &nbsp; {{$student[0]->parents->father_email}}</td></tr>
    <tr><td><span style="color:grey;">Mother: </span> &nbsp;{{ $student[0]->mother_name}}</td><td><span style="color:grey;">Mobile Number:</span> &nbsp;{{$student[0]->mother_number}}</td> <td><span style="color:grey;">Mother Email Id:</span> &nbsp;{{$student[0]->parents->mother_email}}</td></tr>
    <tr><td><span style="color:grey;">Father qualification: </span> &nbsp;{{$student[0]->parents->father_education}}</td><td><span style="color:grey;">Father Occupation:</span> &nbsp;{{$student[0]->parents->father_occupation}}</td> <td><span style="color:grey;">Family income:</span> &nbsp;{{$student[0]->parents->family_income}}</td></tr>
    <tr><td><span style="color:grey;">Mother qualification: </span> &nbsp;{{$student[0]->parents->mother_education}}</td><td><span style="color:grey;">Mother Occupation:</span> &nbsp;{{$student[0]->parents->mother_occupation}}</td> <td><span style="color:grey;">Domicile:</span> &nbsp;{{$student[0]->domicile}}</td></tr>
    <tr><td><span style="color:grey;">Blood Group : </span> &nbsp;{{$student[0]->blood_group}}</td><td><span style="color:grey;">Religion:</span> &nbsp;{{$student[0]->religion}}</td> <td><span style="color:grey;">Caste:</span> &nbsp; {{$student[0]->caste}}</td></tr>
    <tr><td><span style="color:grey;">Nationality : </span> &nbsp;{{ $student[0]->nationality}}</td><td><span style="color:grey;">Physically Handicapped:</span> &nbsp;@if($student[0]->physically_handicapped == 1) YES @else NO @endif</td> <td><span style="color:grey;">Siblings in same school:</span> &nbsp; @if($student[0]->siblings == 1) YES @else NO @endif</td></tr>
    <tr><td><span style="color:grey;">Identification Marks:</span> <br>{{$student[0]->mark_1}}@if($student[0]->mark_2 !='') ,{{$student[0]->mark_2}} @endif</td><td><span style="color:grey;">Permanent Address:</span> <br> {{$student[0]->permanent_address}}</td><td><span style="color:grey;">Present Address:</span> <br> {{$student[0]->present_address}}</td></tr>
</table>
@if(COUNT($educations) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Previous Education</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th data-sortable="true">S.No.</th>
                <th data-sortable="true">Institute</th>
                <th data-sortable="true">Class From-To</th>
                <th data-sortable="true">Year From-To</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($educations as $education) {
                ?>
                <tr class="">
                    <td>{{$i}}</td>
                    <td>{{$education->institute_name}}</td>
                    <td>{{$education->class_from}} - {{$education->class_to}}</td>
                    <td>{{$education->from_year}} - {{$education->to_year}}</td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>    
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Previous Education</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif
@if(COUNT($student_documents) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Documents</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th>S No</th>
                <th>File name</th>
                <th>Document</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($student_documents as $student_document) {
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td><a> {{ $student_document->file_name }} </a></td>
                    <td><a><img width="100" height="100" @if($student_document->document !='') src="{{URL::asset('uploads/students/documents/'.$student_document->document)}}" @else <p>No Document</p> @endif ></a></td>                                          
                    <td>{{$student_document->created_at->format('d-m-Y')}}</td>                                                                              
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Documents</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

<!--class timetable-->

@if(COUNT($class_subjects) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Class Timings</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th data-sortable="true">Day</th>
                <th data-sortable="true">Period</th>
                <th data-sortable="true">Subject</th>
                <th data-sortable="true">Start</th>
                <th data-sortable="true">End</th> 
                <th data-sortable="true">Duration</th> 
            </tr>
        </thead>
        <tbody>                                     
            @foreach ($class_subjects as $class_subject)                                                                              
            <tr class="">      
                <td>{{$class_subject->days->day_title}}</td>
                <td>{{ $class_subject->timings->title }}</td>
                <td>{{$class_subject->subjects->subject_name}}</td>                   
                <td> {{ $class_subject->timings->class_start }} </td>
                <td>{{ $class_subject->timings->class_end }} </td>
                <td>{{ $class_subject->timings->duration }}</td>
            </tr>
            @endforeach
        </tbody>    
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Class Timings</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No class timings added.</p>
@endif




@if(COUNT($student_attendances) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Attendance</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th>S No</th>
                @if($attendance_type[0]->id == 2) <th>Subject</th> @endif 
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
            foreach ($student_attendances as $student_attendance) {
                if (is_numeric($student_attendance->working_days)) {
                    $total+= $student_attendance->working_days;
                    $present+= $student_attendance->present;
                    $absent+= ($student_attendance->working_days - $student_attendance->present);
                }
                ?>
                <tr>
                    <td>{{$i}}</td>
                    @if($attendance_type[0]->id == 2) <td>{{$student_attendance->subject_name}}</td> @endif
                    <td><span class="">{{$student_attendance->month}} - {{$student_attendance->year}}</span></td>
                    <td>{{$student_attendance->working_days}}</td>
                    <td>{{$student_attendance->present}}</td>
                    <td>{{$student_attendance->working_days - $student_attendance->present}}</td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
        @if($total != 0 )
        <tr><td></td>@if($attendance_type[0]->id == 2) <td></td> @endif<td><b>Total (  {{ number_format((($present/$total)*100),2) }} &#37; )</b></td><td><b>{{$total}}</b></td><td><b>{{$present}}</b></td>
            <td> <b>{{$absent}} </b></td></tr>
        @endif
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Attendance</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

<!--class assignments-->

@if(COUNT($assignments) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Class Assignments</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th data-sortable="true">S No</th>
                <th data-sortable="true">Subject</th>
                <th data-sortable="true">Title</th>
                <th data-sortable="true">Description</th>
                <th data-sortable="true">Assignment sheet</th>  
                <th data-sortable="true">Submission date </th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($assignments as $assignment) {
                ?> 
                <tr class="">      
                    <td>{{$i}}</td>
                    <td>  {{$assignment->subjects->subject_name}} </td>
                    <td>{{$assignment->assignment_title}}</td>
                    <td>{{$assignment->assignment_description}}</td>
                    <td><a @if($assignment->assignment_file != '') href="{{url('uploads/assignments/'.$assignment->assignment_file)}}" @endif target="_blank">@if($assignment->assignment_file != '')<img src="{{URL::asset('uploads/assignments/'.$assignment->assignment_file)}}" alt=" No File"  height="50" width="50">@else No Document @endif </a></td>
                    <td>{{$assignment->last_date}}</td>

                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>   
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Class Assignments</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No assignments added.</p>
@endif

<!--exam timetable-->
<h3 style="padding-bottom:1px; margin-bottom: 1px;" >Exam Timetable</h3>
@if(!empty($exams))
@foreach($timings as $k => $time)
@if(COUNT($time) !=0 )
<div>
    <p style="text-align: center;"> {{$time[0]->title}}</p>
    <table width="100%">
        <thead> 
            <tr>

                <th data-sortable="true">Exam date</th>
                <th data-sortable="true">Subject</th>                                                   
                <th data-sortable="true">Timings</th>
                <th data-sortable="true">Duration</th>
                <th data-sortable="true">Syllabus</th>
                <th data-sortable="true">Pass/Max Marks</th>

            </tr>
        </thead>
        <tbody>                                     
            <?php
            $i = 1;
            foreach ($time as $timing) {
                ?>                                                                            
                <tr class="">      
                    <td>{{$timing->exam_date}}</td>
                    <td>{{$timing->subject_name}}</td>                                                       
                    <td>{{$timing->exams_start_time}} {{$timing->exams_end_time}}</td>
                    <td>{{$timing->exam_duration}}</td>
                    <td>{{$timing->exam_syllabus}}</td>
                    <td>{{$timing->pass_marks}} / {{$timing->max_marks}}</td>
                </tr>
                <?php $i++;
            }
            ?>

        </tbody>
    </table>

</div>
@else
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">Exam timetable not added.</p>
@endif
@endforeach
@else
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No exams scheduled to this student class.</p>
@endif




<h3 style="padding-bottom:1px; margin-bottom: 1px;" >Exam Marks</h3>
@if(!empty($exams))
@foreach($marks as $k => $mar)
@if(COUNT($mar) !=0 )
<div>
    <p style="text-align: center;"> {{$mar[0]->title}}</p>
    <table width="100%">
        <thead> 
            <tr>
                <th data-sortable="true">S No</th>
                <th data-sortable="true">Exam date</th>
                <th data-sortable="true">Subject</th>
                <th data-sortable="true">Marks</th>
                <th data-sortable="true">Pass/Max Marks</th>
                <th data-sortable="true">Grade</th>

            </tr>
        </thead>
        <tbody>                                     
            <?php
            $i = 1;
            $sum_marks_obtained = 0;
            $total_marks = 0;

            foreach ($mar as $mark) {
                if (is_numeric($mark->marks_obtained)) {
                    $sum_marks_obtained+= $mark->marks_obtained;
                    $total_marks+= $mark->max_marks;
                }
                ?>                   

                <tr class="">      
                    <td>{{$i}}</td>
                    <td>{{$mark->exam_date}}</td>
                    <td>{{$mark->subject_name}}</td>
                    <td>{{$mark->marks_obtained}} </td>
                    <td>{{$mark->pass_marks}} / {{$mark->max_marks}}</td>
                    <td>{{$mark->grade}}</td>

                </tr>

                <?php
                $i++;
            }
            ?>

        </tbody>
        <?php foreach ($totals as $key => $total) { ?>
            @if($total[0]->exam_id == $mar[0]->examid)
            @if($total[0]->total_marks_obtained != 0 )
            <tr><td></td><td></td><td><b>Total ( {{$total[0]->percentage}} &#37; )</b></td><td><b>{{$total[0]->total_marks_obtained}}</b></td><td><b>{{$total[0]->total_marks}}</b></td>
                <td> <b> {{$total[0]->grade}} </b> </td></tr>
            @endif
            @endif
        <?php } ?>

    </table>

</div>
@else
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">Marks not added or absent to the exams.</p>
@endif
@endforeach
@else
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No exams scheduled to this student class.</p>
@endif

@if(COUNT($student_fees) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Fees</h3>
    <table class="table">
        <thead>
            <tr>
                <th> Fee Title</th>
                <th> Amount</th>
                <th> Discount</th>
                <th>Total Amount<br>(yearly)</th>
                <th> Paid</th>
                <th> Due</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $i = 1;
            $total = 0;
            $paid = 0;
            $discount = 0;
            foreach ($student_fees as $student_fee) {
                $data = ($student_fee->fee_amount * $student_fee->yearly) - $student_fee->discount;
                $total +=$data;
                $discount += $student_fee->discount;
                $paid +=$student_fee->paid_amount;
                ?>
                <tr>

                    <td>{{$student_fee->fee_title}}</td>
                    <td>{{$student_fee->fee_amount}} ( {{$student_fee->fee_name}} )</td>
                    <td>@if($student_fee->discount !=""){{$student_fee->discount}} @else 0 @endif</td>
                    <td>{{($student_fee->fee_amount * $student_fee->yearly)- $student_fee->discount}}</td>
                    <td>@if($student_fee->paid_amount !='') {{$student_fee->paid_amount }} @else 0 @endif</td>
                    <td>{{($student_fee->fee_amount * $student_fee->yearly) - $student_fee->paid_amount - $student_fee->discount}}</td>

                </tr>
                <?php
                $i++;
            }
            ?>
            @if($transport_fees !="")
            <?php
            $t = ($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->discount;
            $total +=$t;
            $paid +=$transport_fees[0]->paid_amount;
            $discount += $transport_fees[0]->discount;
            ?>
            <tr>

                <td>{{$transport_fees[0]->fee_title}}</td>
                <td>{{$transport_fees[0]->transport_fee }}( {{$transport_fees[0]->fee_name}} )</td>
                <td>@if($transport_fees[0]->discount !=""){{$transport_fees[0]->discount}} @else 0 @endif</td>
                <td>{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly)-$transport_fees[0]->discount}}</td>
                <td>@if($transport_fees[0]->paid_amount !='') {{$transport_fees[0]->paid_amount }} @else 0 @endif</td>
                <td>{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->paid_amount - $transport_fees[0]->discount}}</td>

            </tr>
            @endif
            <tr><td></td> <td><b>Total</b></td><td>{{$discount}}</td> <td><b>{{$total}}</b></td> <td><b>{{$paid}}</b></td> <td><b>{{$total - $paid}}</b></td></tr>
        </tbody>
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Fees</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
@endif

@if(COUNT($payments) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Payment History</h3>
    <table width="100%">
        <thead> 
            <tr>

                <th> <i class="fa fa-building"></i>Receipt No</th>
                <th> <i class="fa fa-calendar"></i>Paid Date</th>
                <th> Fee</th>
                <th>  Paid Amount</th>
                <th> Paid by</th>
                <th> Received by</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($payments as $payment) {
                ?>
                <tr>
                    <td>{{$payment->receipt_number}}</td>
                    <td>{{date("d-m-Y",strtotime($payment->payment_date))}}</td>
                    <td>{{$payment->fees->fee_title}}</td>
                    <td>{{$payment->paid_amount}}</td>
                    <td>{{$payment->paid_by}}</td>
                    <td>{{$payment->user_logins->user_name}}</td>

                </tr>
                <?php
                $i++;
            }
            ?>

        </tbody>
    </table>
</div>

@endif

@if(COUNT($routes) ==1)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Transport</h3>
    <table width="100%">
        <thead> 
            <tr>
                <th>Title</th>
                <th>Details</th>
            </tr>
        </thead>
        <?php if (COUNT($routes) != 0) { ?>
            <tbody>                                                                                        
                <tr>  <td>Vehicle Type</td>  <td>{{$routes[0]->vehicle_type->title}}</td></tr>
                <tr>  <td>Route Number</td>  <td>{{$routes[0]->routes->route_title}}</td></tr>
                <tr>  <td>Route From</td>  <td>{{$routes[0]->routes->route_from}} ( {{$routes[0]->routes->route_from_start_time}} - {{$routes[0]->routes->route_from_end_time}} ) </td></tr>
                <tr>  <td>Route To</td>  <td>{{$routes[0]->routes->route_to}} ( {{$routes[0]->routes->route_to_start_time}} - {{$routes[0]->routes->route_to_end_time}} )</td></tr>
                <tr>  <td>Driver</td>  <td>{{$routes[0]->staff->first_name}} {{$routes[0]->staff->last_name}} ({{$routes[0]->staff->contact_number}})</td></tr>
                <?php
                $i = 1;
                foreach ($stops as $stop) {
                    ?>
                    <tr>  <td>Stop {{$i}}  @if($stop->id == $student[0]->stop_id )( <b> Student Boarding Stop </b> )</td> @endif </td>  
                        <td>
                            @if($stop->id == $student[0]->stop_id )<b> {{$stop->stop_name}} </b> ( Pickup time : {{$stop->pickup_time}} - Drop time : {{$stop->drop_time}} ) <br>Address :  {{$stop->stop_address}} 
                            @else {{$stop->stop_name}} ( Pickup time : {{$stop->pickup_time}} - Drop time : {{$stop->drop_time}} ) @endif 

                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</div>

@endif



@if(COUNT($remarks) !=0)
<div>
    <h3 style="padding-bottom:5px; margin-bottom: 5px;" >Remarks</h3>
    <table width="100%">
        <thead> 
            <tr>                                           
                <th data-sortable="true"> Subject</th>                                         
                <th data-sortable="true">Title</th>                                      
                <th data-sortable="true">Description</th>         
                <th data-sortable="true">Given on</th>
                <th data-sortable="true">Remark by</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($remarks as $remark) {
                ?> 
                <tr class="">
                    <td> @if($remark->subject_id >0){{$remark->subjects->subject_name}} @else NA @endif </td>
                    <td>{{$remark->remark_title}}</td>
                    <td>{{$remark->remark_description}}</td>
                    <td>{{$remark->created_at->format('d-m-Y')}}</td>
                    <td>{{$remark->user_logins->user_name}}</td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>    
    </table>
</div>
@else
<h3 style="padding-bottom:5px; margin-bottom: 5px;" >Remarks</h3>
<p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No remarks added.</p>
@endif





@if($print==1)
<script type="text/javascript"> try {
        this.print();
    } catch (e) {
        window.onload = window.print;
    }</script>
@endif