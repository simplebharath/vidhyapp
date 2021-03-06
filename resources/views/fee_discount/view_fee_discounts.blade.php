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
                    <li><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                    <li class="active"><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                    <li><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
                    <li><a href="{{url ('view-student-assignments/'.$students[0]->id)}}">Assignments</a></li>
                    <li><a href="{{url ('view-student-remarks/'.$students[0]->id)}}">Remarks</a></li>
                    <li><a href="{{url ('view-student-exams/'.$students[0]->id)}}">Marks</a></li>
                    @if($students[0]->student_type_id == 1)
                    <li><a href="{{url ('view-student-transport/'.$students[0]->route_id.'/'.$students[0]->stop_id.'/'.$students[0]->id)}}">Transport</a></li>
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
                             @include('include.messages')
                            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-rupee"></i> </span>
                                    <h2>View Discount Fee <b>{{$students[0]->first_name}} {{$students[0]->last_name}}</b> {{ $students[0]->classes->class_name }}  @if(($students[0]->section_id) != 0)  -  {{ $students[0]->sections->section_name}}  @endif</h2>
                                </header> 
                                <div>
                                    <div class="widget-body no-padding">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>

                                                        <th>Fee Type</th>
                                                        <th> Fee</th>
                                                        <th> Amount</th>
                                                        <th>  Total</th>
                                                        <th> Discount</th>
                                                        <th> Net pay</th>
                                                         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                        <th>Actions</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $i = 1;
                                                     $total=0;
                                        $paid=0;
                                        foreach ($student_fees as $student_fee) {
                                            $data = ($student_fee->fee_amount * $student_fee->yearly);
                        $total +=$data;
                        $paid +=$student_fee->discount;
                                                        ?>
                                                        <tr>
                                                            <td>{{$student_fee->fee_name}}</td>
                                                            <td>{{$student_fee->fee_title}}</td>
                                                            <td>{{$student_fee->fee_amount}}</td>
                                                            <td>{{ $student_fee->fee_amount * $student_fee->yearly }}</td>
                                                            <td>@if($student_fee->discount !=''){{$student_fee->discount}}@else 0 @endif</td>
                                                            <td>{{($student_fee->fee_amount * $student_fee->yearly) - $student_fee->discount}}</td>
                                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                            @if($student_fee->discount !='')
                                                            <td><a class=" btn btn-xs btn-primary"  href="{{url('edit-fee-discount/'.$student_fee->d_id)}}">Edit</a></td>
                                                            @else
                                                            <td><a class=" btn btn-xs btn-primary"  href="{{url('student-fee-discount/'.$students[0]->id.'/'.$student_fee->fee_id)}}">Add</a></td>
                                                            @endif
                                                            @endif
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                       
                                                    }
                                                    ?>
                                                    @if($transport_fees !="")
                                                     <?php
                    $t = ($transport_fees[0]->transport_fee * $transport_fees[0]->yearly);
                    $total +=$t;
                    $paid +=$transport_fees[0]->discount;
                    ?>
                                                    <tr>
                                                        
                                                        <td>{{$transport_fees[0]->fee_name}}</td>
                                                        <td>{{$transport_fees[0]->fee_title}}</td>
                                                        <td>{{$transport_fees[0]->transport_fee}}</td>
                                                        <td>{{$transport_fees[0]->transport_fee * $transport_fees[0]->yearly}}</td>
                                                         <td>@if($transport_fees[0]->discount !=''){{$transport_fees[0]->discount}}@else 0 @endif</td>
                                                            <td>{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->discount}}</td>
                                                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                        @if($transport_fees[0]->discount !='')
                                                        <td><a class=" btn btn-xs btn-primary"  href="{{url('edit-fee-discount/'.$transport_fees[0]->d_id)}}">Edit</a></td>
                                                        @else
                                                        <td><a class=" btn btn-xs btn-primary"  href="{{url('student-fee-discount/'.$students[0]->id.'/'.$transport_fees[0]->fee_id)}}">Add</a></td>
                                                        @endif
                                                        @endif
                                                    </tr>
                                                     <tr><td></td><td></td> <td><b>Total</b></td> <td><b>{{$total}}</b></td> <td><b>{{$paid}}</b></td> <td><b>{{$total - $paid}}</b></td> @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)<td></td>@endif</tr>
                                                    @endif

                                                </tbody>
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
</div>
@include('include.footer')
