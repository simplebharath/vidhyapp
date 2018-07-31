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
                    <li ><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li ><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li ><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
                    <li class=""><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                    <li><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                    <li class="active"><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
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
                            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                    <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Payment History  </h2>                                    
                                @if(COUNT($payments)!=0)    <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('payment-history-print/'.$students[0]->id)}}" target="_blank" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print </a>
                                     <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('payment-history-pdf/'.$students[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  Pdf </a>
                                @endif
                                </header>		
                                <div>
                                    <div class="widget-body no-padding">
                                        <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Receipt" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" data-provide="datepicker" placeholder="Date" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Fee" />
                                                </th>
                                                <th class="hasinput" style="width:9%">
                                                    <input type="text" class="form-control" placeholder="Paid" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Paid by" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Received by" />
                                                </th>
                                                 <th class="hasinput" style="width:7%">
                                                     <input type="text"  class="form-control" readonly="" placeholder="Receipt" />
                                                </th>
                                            </tr>
                                            <tr>

                                                <th> Receipt No</th>
                                                <th> Date</th>
                                                <th> Fee</th>
                                                <th> Paid</th>
                                                <th> Paid by</th>
                                                <th> Received by</th>
                                                <th> Receipt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($payments as $payment) {
                                                ?>
                                                <tr>
                                                    <td>{{$payment->receipt_number}}</td>
                                                    <td>{{date('d-m-Y', strtotime($payment->payment_date))}}</td>
                                                    <td>{{$payment->fees->fee_title}}</td>
                                                    <td>{{$payment->paid_amount}}</td>
                                                    <td>{{$payment->paid_by}}</td>
                                                    <td>{{$payment->user_logins->user_name}}</td>
                                                    <td>
                                                        <a href="{{url('payment-receipt-pdf/'.$payment->id)}}" title="Download receipt"><li class="fa fa-file-pdf-o"></li></a>
                                                     &nbsp;&nbsp;   <a href="{{url('payment-receipt-print/'.$payment->id)}}" target="_blank" title="Print receipt"><li class="glyphicon glyphicon-print"></li></a>
                                                    </td>
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
