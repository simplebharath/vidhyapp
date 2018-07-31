@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Balance Sheet</li><li>Payments</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('balance-sheet-payments-academic-years')}}">Payments</a></li> 
                 <li><a href="{{url ('balance-sheet-expenses-academic-years')}}">Expenses</a></li>
                  <li><a href="{{url ('balance-sheet-total-academic-years')}}">Total</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="col-sm-12 col-md-12 col-lg-3">
                    @include('institute_balance_sheet_payments.include_payments_year')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-calendar-minus-o"></i> </span>
                            <h2>View Payments of @if($days !=0)<b> {{$days[0]->month_name}} - {{$days[0]->year}} : {{$each_day[0]->date}} ({{ $each_day[0]->day }}) {{$payments[0]->fees->fee_title}}</b> @endif</h2>
                           
                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('balance-sheet-payments-day-fees/'.$years[0]->ac_id.'/'.$days[0]->year.'/'.$days[0]->month_name.'/'.$each_day[0]->today)}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-arrow-left"></i>  BACK</a>
                        </header>
                        </header>
                        <div>
                            <div class="jarviswidget-editbox">
                            </div>

                            <div class="widget-body no-padding">
                                <div class="table-responsive">
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:15%">
                                                    <input type="text" class="form-control" placeholder="Receipt" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Student id" />
                                                </th>
                                                <th class="hasinput" style="width:8%">
                                                    <input type="text" class="form-control" placeholder="Class" />
                                                </th>

                                               

                                                <th class="hasinput" style="width:8%">
                                                    <input type="text" class="form-control" placeholder="Roll number" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text"  class="form-control" placeholder="Student" />
                                                </th>
                                                
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Paid" />
                                                </th>
                                                 <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Payment type" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Paid by" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Received by" />
                                                </th>
                                                <th class="hasinput" style="width:6%">
                                                    <input type="text" readonly=""  class="form-control" placeholder="Print" />
                                                </th>
                                            </tr>
                                            <tr>

                                                <th>Receipt No</th>
                                                <th> Student id</th>

                                                <th data-sortable="true">Class</th>
                                               
                                                <th data-sortable="true">Roll number</th>                                              
                                                <th data-sortable="true">Name</th>      
                                              
                                                <th> Paid</th>
                                                 <th data-sortable="true">Payment type</th>
                                                <th> Paid by</th>
                                                <th> Received by</th>
                                                <th> Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1; $total=0;
                                            foreach ($payments as $payment) {
                                                 if( $payments != '')  {  $total +=$payment->paid_amount; }
                                                ?>
                                                <tr>
                                                    <td>{{$payment->receipt_number}}</td>
                                                    <td>{{$payment->students->unique_id}}</td>
                                                    <td>{{$payment->students->class_sections->classes->class_name}}@if(($payment->students->class_sections->section_id) > 0)  -  {{ $payment->students->class_sections->sections->section_name}}  @endif</td>
                                                   
                                                    <td>{{$payment->students->roll_number}}</td>
                                                    <td>{{$payment->students->first_name}}</td>

                                                    
                                                    <td>{{$payment->paid_amount}}</td>
                                                     <td>{{$payment->payment_mode}}</td>
                                                    <td>{{$payment->paid_by}}</td>
                                                    <td>{{$payment->user_logins->user_name}}</td>
                                                    <td><a class="btn btn-xs btn-info">Print</a></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                                @if( $payments != '')    <tr><td class="hidden">100</td><td></td><td></td><td></td><td></td><td>Total</td><td> &#8377; {{ $total }}</td><td></td><td></td><td></td><td></td></tr> @endif
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
