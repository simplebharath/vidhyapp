@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Balance Sheet</li><li>Total Balance</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('balance-sheet-payments-academic-years')}}">Payments</a></li>  
                <li><a href="{{url ('balance-sheet-expenses-academic-years')}}">Expenses</a></li>
                <li  class="active"><a href="{{url ('balance-sheet-total-academic-years')}}">Total</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="col-sm-12 col-md-12 col-lg-3">
                    @include('institute_balance_sheet_total.include_total_year')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-calendar-minus-o"></i> </span>
                            <h2>View Months</h2>
                           
                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('balance-sheet-total-academic-years')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-arrow-left"></i>  BACK</a>
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
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="S no" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Month-Year" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Payments" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Expenses" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Balance Amount" />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S No</th>
                                                <th data-sortable="true">Month-Year</th>
                                                <th data-sortable="true">Payments</th>
                                                <th data-sortable="true">Expenses</th>
                                                <th data-sortable="true">Balance Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                     
                                            <?php
                                            $i = 1;

                                            foreach ($monthss as $month) { $p_total=0; $e_total=0; ?>
                                            <?php foreach ($payments as $payment) { $p_total += $payment->total_amount ?> <?php }?>
                                            <?php foreach ($expenses as $expense) { $e_total += $expense->total_amount ?> <?php }?>
                                                        
                              
                                                <tr class=""> 
                                                    <td>{{$i}}</td>
                                                    <td>{{ $month }} </td>
                                                    <td> 
                                                        <?php foreach ($payments as $payment) { $pay = $payment->total_amount; $p_a_id=$payment->month_year ?> 
                                                            @if($month == $payment->month_year ){{ $pay }}  @endif
                                                        <?php } ?>                                                        
                                                    </td>
                                                    <td>
                                                        <?php foreach ($expenses as $expense) { $exp=$expense->total_amount; $p_e_id=$expense->month_year ?>
                                                            @if($month == $expense->month_year ){{ $exp }}  @endif
                                                        <?php  } ?>                                                          
                                                    </td>
                                                    
                                                    <td>
                                                     <?php foreach ($expenses as $expense) { foreach ($payments as $payment) { ?>  @if($expense->month_year ==$month && $payment->month_year ==$month )  {{$payment->total_amount - $expense->total_amount}} @endif <?php }}?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                                <tr style=""><td class="hidden">24</td> <td></td><td align="center"><i>Total</i></td> <td align="center" style="font-size: 15px;">{{$p_total}}</td> <td align="center" style="font-size: 15px;">{{$e_total}}</td> <td align="center"><span class="" style="font-size: 20px;"><i>{{$p_total - $e_total}}</i></span></td></tr>
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
