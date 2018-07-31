@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Payments</li><li>Payment history</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">

                <li><a href="{{url ('students-fee-payments')}}">Payments</a></li>
                <li  class="active"><a href="{{url ('payment-history-institute')}}">Payment history</a></li>
            </ul>
        </div><br>     
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                        <h2>Payment history </h2>

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
                                                <input type="text" data-provide="datepicker" class="form-control" placeholder="date" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Admission type" />
                                            </th>

                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Fee" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Paid" />
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

                                            <th> Receipt No</th>
                                            <th>  Date</th>

                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Admission type</th>
                                                                                        
                                            <th data-sortable="true">Name</th>      
                                            <th> Fee</th>
                                            <th>  Paid</th>
                                            <th> Paid by</th>
                                            <th> Received by</th>
                                            <th> Print</th>
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
                                                <td>{{$payment->students->class_sections->classes->class_name}}@if(($payment->students->class_sections->section_id) > 0)  -  {{ $payment->students->class_sections->sections->section_name}}  @endif - {{$payment->students->roll_number}}</td>
                                                <td>{{$payment->students->student_types->title}}</td>
                                               
                                                <td>{{$payment->students->first_name}}</td>

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
            </article>
        </div>
    </div>
</div>
@include('include.footer')
