@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Fees</li><li>Payments</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">

                <li  class="active"><a href="{{url ('students-fee-payments')}}">Payments</a></li>
                <li ><a href="{{url ('payment-history-institute')}}">Payment history</a></li>
            </ul>
        </div><br>     
        <div class="row">
            @include('include.messages')
            <article class="col-sm-12 col-md-12 col-lg-6">
                <div class="well well-light well-sm no-margin no-padding">
                    <div class="row">     
                        <div class="col-sm-12">
                            <div class="">
                                <div class="col-sm-1" style="padding: 0px;margin-left: 15px;margin-top: 10px;padding-right: 10px;">
                                    <img src="{{URL::asset('uploads/students/profile_photos/'.$student[0]->photo)}}"   style="background-color:#3276b1;" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'"   height="60" width="60">
                                </div>
                                <h2 style="margin-top: 0px;margin-left: 100px;"><span class="semi-bold">{{$student[0]->first_name}}</span>  {{$student[0]->last_name}} {{$student[0]->last_name}} 

                                </h2>
                                <div class="col-sm-5" style="margin-left: 15px;">

                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">Academic year <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Present Academic year">{{ date('Y', strtotime($student[0]->academic_years->from_date))}}  {{ date('Y', strtotime($student[0]->academic_years->to_date))}} </a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-neuter"></i>&nbsp;&nbsp;<span class="txt-color-darken">Admission number <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Admission number">{{$student[0]->admission_number}}</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Joined date <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{ date('jS \\of F Y', strtotime($student[0]->joined_date))}}</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-drupal"></i>&nbsp;&nbsp;<span class="txt-color-darken">Admission type <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Student come to school in thos mode">{{$student[0]->student_types->title}}</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-university"></i>&nbsp;&nbsp;<span class="txt-color-darken">Student id <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Student id">{{$student[0]->unique_id}}</a></span>
                                            </p>
                                        </li>


                                </div>
                                <div class="col-sm-5" >
                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-drupal"></i>&nbsp;&nbsp;<span class="txt-color-darken">Class <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{$student[0]->classes->class_name }} @if($student[0]->section_id > 0) - {{ $student[0]->sections->section_name}}@endif</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-drupal"></i>&nbsp;&nbsp;<span class="txt-color-darken">Roll No <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{ $student[0]->roll_number}}</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-drupal"></i>&nbsp;&nbsp;<span class="txt-color-darken">UID <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Unique identity number">{{$student[0]->aadhaar_number}}</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Father name <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Date of birth">{{ $student[0]->father_name}}</a></span>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-university"></i>&nbsp;&nbsp;<span class="txt-color-darken">Mobile <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Student id">{{$student[0]->father_number}}</a></span>
                                            </p>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-rupee"></i> </span>
                        <h2>View Fees <b>{{$student[0]->first_name}} {{$student[0]->last_name}}</b> {{ $student[0]->classes->class_name }}  @if(($student[0]->section_id) != 0)  -  {{ $student[0]->sections->section_name}}  @endif - {{$student[0]->roll_number}}</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('get-students-all/'.$student[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                    </header> 
                    <div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Fee Type</th>
                                            <th>  Fee</th>
                                            <th> Amount</th>
                                            <th>  Total</th>
                                            <th> Paid</th>
                                            <th> Due</th>
                                            <th>Pay now</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $total=0;
                                        $paid=0;
                                        foreach ($student_fees as $student_fee) {
                                            $data = ($student_fee->fee_amount * $student_fee->yearly) - $student_fee->discount;
                        $total +=$data;
                        $paid +=$student_fee->paid_amount;
                                       
                                            ?>
                                            <tr>
                                                <td>{{$student_fee->fee_name}}</td>
                                                <td>{{$student_fee->fee_title}}</td>
                                                <td>{{$student_fee->fee_amount}}</td>
                                                <td>{{($student_fee->fee_amount * $student_fee->yearly)- $student_fee->discount}}</td>
                                                <td>@if($student_fee->paid_amount !='') {{$student_fee->paid_amount }} @else 0 @endif</td>
                                                <td>{{($student_fee->fee_amount * $student_fee->yearly) - $student_fee->paid_amount - $student_fee->discount }}</td>
                                                <td><span class="student_fee btn btn-xs btn-primary" @if($student_fee->paid_amount >= (($student_fee->fee_amount * $student_fee->yearly)-$student_fee->discount)) disabled @endif id="{{ $student[0]->id.'/'.$student_fee->fee_ids}}">Pay now</span></a></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        @if($transport_fees !='')
                                         <?php
                    $t = ($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->discount;
                    $total +=$t;
                    $paid +=$transport_fees[0]->paid_amount;
                    ?>
                                        <tr>
                                            <td>{{$transport_fees[0]->fee_name}}</td>
                                            <td>{{$transport_fees[0]->fee_title}}</td>
                                            <td>{{$transport_fees[0]->transport_fee}}</td>
                                            <td>{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->discount}}</td>
                                            <td>@if($transport_fees[0]->paid_amount !='') {{$transport_fees[0]->paid_amount }} @else 0 @endif</td>
                                            <td>{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->paid_amount - $transport_fees[0]->discount}}</td>

                                            <td><span class="student_fee btn btn-xs btn-primary"@if($transport_fees[0]->paid_amount == (($transport_fees[0]->transport_fee * $transport_fees[0]->yearly)- $transport_fees[0]->discount)) disabled @endif  id="{{ $student[0]->id.'/'.$transport_fees[0]->fee_ids}}">Pay now</span></a></td>
                                        </tr>
                                        @endif
                                         <tr><td></td><td></td> <td><b>Total</b></td> <td><b>{{$total}}</b></td> <td><b>{{$paid}}</b></td> <td><b>{{$total - $paid}}</b></td><td></td></tr>
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="col-sm-12 col-md-12 col-lg-6">
                <div id="do_payment_form" style="display:none;">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                            <h2>Pay Fee</h2>
                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-student-fee/'.$student[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                        </header>
                        <div>
                            <div class="widget-body no-padding"><br>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-pay-fee/'.$student[0]->id) }}">
                                                {{ csrf_field() }}   
                                                <div id="payment_add_div">

                                                </div>
                                                <div class="col-md-offset-5">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Save</span>
                                                    </button>
                                                    <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                        <i class="ace-icon fa fa-times red2"></i>
                                                        <span class="bigger-110">Cancel</span>
                                                    </button>   
                                                </div><br>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="payment_details_div" >
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                            <h2>Payment history <b>{{$student[0]->first_name}} {{$student[0]->last_name}}</b> {{ $student[0]->classes->class_name }}  @if(($student[0]->section_id) != 0)  -  {{ $student[0]->sections->section_name}}  @endif - {{ $student[0]->roll_number}}</h2>
                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('get-students-all/'.$student[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                        </header> 
                        <div>
                            <div class="widget-body no-padding">
                                <div class="table-responsive">
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Receipt" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" data-provide="datepicker" class="form-control" placeholder="Date" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Fee" />
                                                </th>
                                                <th class="hasinput" style="width:6%">
                                                    <input type="text" class="form-control" placeholder="Paid" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Paid by" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Received by" />
                                                </th>
                                                 <th class="hasinput" style="width:6%">
                                                     <input type="text"  class="form-control" readonly="" placeholder="Receipt print" />
                                                </th>
                                            </tr>
                                            <tr>

                                                <th> Receipt No</th>
                                                <th>Date</th>
                                                <th> Fee</th>
                                                <th>  Paid</th>
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
                                                    <td>{{$payment->payment_date}}</td>
                                                    <td>{{$payment->fees->fee_title}}</td>
                                                    <td>{{$payment->paid_amount}}</td>
                                                    <td>{{$payment->paid_by}}</td>
                                                    <td>{{$payment->user_logins->user_name}}</td>
                                                    <td>
                                                        <a href="{{url('payment-receipt-pdf/'.$payment->id)}}" title="Download receipt"><li class="fa fa-file-pdf-o"></li></a>
                                                        <a href="{{url('payment-receipt-print/'.$payment->id)}}" target="_blank" title="Print receipt"><li class="glyphicon glyphicon-print"></li></a>
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
            </article>
        </div>
    </div>
</div>
@include('include.footer')
