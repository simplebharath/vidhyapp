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
        <td class="head" style="width:40%;"> <h2>Balance Sheet </h2></td>
        <td class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td class="head" style="width:30%; font-size: 14px;"> Date :{{Carbon\Carbon::today()->format('d-m-Y')}}

        </td>
    </tr>
    @if(COUNT($payments) !=0)
    <?php
    $i = 1;
    foreach ($years as $year) {
        ?>                                                                           
        <tr class="" style="clear:both;">      

            <td style="width:20%;" class="head">{{ date('Y', strtotime($years[0]->from_date))}} - {{ date('Y', strtotime($years[0]->to_date))}}</td>
            <?php
            foreach ($payments as $payment) {
                $pay = $payment->total;
                $p_a_id = $payment->ac_id
                ?>                                              
                <td style="width:23%;" class="head"> <?php if ($payment->ac_id == $year->id) { ?><a href="" style="text-decoration: none;">Payments : {{$payment->total}} </a> <?php } ?> </td>
            <?php } ?>
            <?php
            foreach ($expenses as $expense) {
                $exp = $expense->total;
                $p_e_id = $expense->ac_id
                ?>  

                <td style="width:23%;" class="head"> <?php if ($expense->ac_id == $year->id) { ?> <a href="" style="text-decoration: none;">Expenses: {{$expense->total}}</a> <?php } ?> </td>
            <?php } ?>
            <td  class="head" style="width:4%;">&nbsp;</td>
            <td style="width:30%;" class="head"><?php if ($p_a_id == $year->id && $p_e_id == $year->id) { ?>
                    <a href="#months" style="text-decoration: none;"> Total Balance: {{$pay - $exp}}</a>
                <?php } ?>

            </td>

        </tr>
        <?php
        $i++;
    }
    ?>
    @endif
</table>
<hr>

<!--@if((COUNT($payments) !=0) && (COUNT($expenses) !=0))
<div>
    <h3> Academic year :{{ date('Y', strtotime($years[0]->from_date))}} - {{ date('Y', strtotime($years[0]->to_date))}} </h3>
    <table class="table">
        <thead>
            <tr>
                <th data-sortable="true">S No</th>
                <th data-sortable="true">Academic year</th>
                <th data-sortable="true">Payments</th>
                <th data-sortable="true">Expenses</th>
                <th data-sortable="true">Total Balance</th>

            </tr>
        </thead>
        <tbody>   
            @if(COUNT($payments) !=0)
<?php
$i = 1;
foreach ($years as $year) {
    ?>                                                                           
                                                        <tr class="">      
                                                            <td>{{$year->id}}</td>
                                                            <td>{{$year->from_date}}  To {{$year->to_date}}</td>
    <?php
    foreach ($payments as $payment) {
        $pay = $payment->total;
        $p_a_id = $payment->ac_id
        ?>                                              
                                                                                                        <td> <?php if ($payment->ac_id == $year->id) { ?><a href="{{url('balance-sheet-payments-months/'.$payment->ac_id)}}"> {{$payment->total}} </a> <?php } ?> </td>
    <?php } ?>
    <?php
    foreach ($expenses as $expense) {
        $exp = $expense->total;
        $p_e_id = $expense->ac_id
        ?>  

                                                                                                        <td> <?php if ($expense->ac_id == $year->id) { ?> <a href="{{url('balance-sheet-expenses-months/'.$expense->ac_id)}}">{{$expense->total}}</a> <?php } ?> </td>
    <?php } ?>

                                                            <td><?php if ($p_a_id == $year->id && $p_e_id == $year->id) { ?>
                                                                                                            <a href="{{url('balance-sheet-total-months/'.$year->id)}}"> {{$pay - $exp}}</a>
    <?php } ?>

                                                            </td>

                                                        </tr>
    <?php
    $i++;
}
?>
            @endif
        </tbody>
    </table>
</div><br><hr>
@endif-->

@if((COUNT($payments) !=0) && (COUNT($expenses) !=0))
<p>Balance : Month-wise</p>
<div>
    <table>
        <thead>
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

            foreach ($monthss as $month) {
                $p_total = 0;
                $e_total = 0;
                ?>
                <?php
                foreach ($paymentss as $payment) {
                    $p_total += $payment->total_amount
                    ?> <?php } ?>
                <?php
                foreach ($expensess as $expense) {
                    $e_total += $expense->total_amount
                    ?> <?php } ?>


                <tr class=""> 
                    <td>{{$i}}</td>
                    <td>{{ $month }} </td>
                    <td> 
                        <?php
                        foreach ($paymentss as $payment) {
                            $pay = $payment->total_amount;
                            $p_a_id = $payment->month_year
                            ?> 
                            @if($month == $payment->month_year ) {{ $pay }} @endif
                        <?php } ?>                                                        
                    </td>
                    <td>
                        <?php
                        foreach ($expensess as $expense) {
                            $exp = $expense->total_amount;
                            $p_e_id = $expense->month_year
                            ?>
                            @if($month == $expense->month_year ){{ $exp }}  @endif
                        <?php } ?>                                                          
                    </td>

                    <td>
                        <?php
                        foreach ($expensess as $expense) {
                            foreach ($paymentss as $payment) {
                                ?>  @if($expense->month_year ==$month && $payment->month_year ==$month )  {{$payment->total_amount - $expense->total_amount}} @endif <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr style=""> <td></td><td align="center"><i>Total</i></td> <td align="center" style="font-size: 15px;">{{$p_total}}</td> <td align="center" style="font-size: 15px;">{{$e_total}}</td> <td align="center"><span class="" style="font-size: 20px;"><i>{{$p_total - $e_total}}</i></span></td></tr>
        </tbody>
    </table>
</div><br>
@endif
<hr>
<center><h2 style="text-decoration:underline;">Payments</h2></center>
<table>
    <tr><td class="head"><h4>Payments Month-wise:</h4></td><td class="head"></td><td class="head"></td></tr>
    <?php
    $i = 1;
    $total = 0;
    foreach ($p_months as $month) {
        if ($p_months != '') {
            $total +=$month->total_amount;
        }
        ?>      

        <tr class="">      
            <td>{{$i}}</td>
            <td>{{$month->month}} - {{$month->year}}</td>
            <td><a>{{$month->total_amount}}</a></td>                                                
        </tr>

        <?php
        $i++;
    }
    ?>
    @if($p_months !='')      <tr><td></td><td>Total Payments</td><td><i> {{ $total }} </i></td></tr>@endif
</table>

<table>
    <tr><td class="head"><h4>Payments Fee-wise:</h4></td><td class="head"></td><td class="head"></td></tr>
    <thead>
        <tr>
            <th data-sortable="true">S No</th>

            <th data-sortable="true">Fee</th>
            <th data-sortable="true">Total Amount</th>
        </tr>
    </thead>
    <tbody>                                     
        <?php
        $i = 1;
        $total = 0;
        foreach ($p_each_day as $each) {
            if ($p_each_day != '') {
                $total +=$each->total_payments;
            }
            ?>                                                                           
            <tr class="">      
                <td>{{$i}}</td>

                <td><a >{{$each->fee_title}}</a></td>
                <td>{{$each->total_payments}}</td>
            </tr>
            <?php
            $i++;
        }
        ?>
        @if( $p_each_day != '')    <tr><td></td><td>Total</td><td>  {{ $total }}</td></tr> @endif
    </tbody>
</table>




<table>
    <tr><td class="head"><h4>Payments Day-wise:</h4></td><td class="head"></td><td class="head"></td></tr>
    <thead>
        <tr>
            <th data-sortable="true">S No</th>
            <th data-sortable="true">Date</th>
            <th data-sortable="true">Day</th>
            <th data-sortable="true">Total Amount</th>
        </tr>
    </thead>
    <tbody>                                     
        <?php
        $i = 1;
        $total = 0;
        foreach ($p_days as $day) {
            if ($p_days != '') {
                $total +=$day->total_payments;
            }
            ?>                                                                           
            <tr class="">      
                <td>{{$i}}</td>

                <td><a >{{$day->date}}</a></td>
                <td><a  >{{$day->day}} </a></td>
                <td>{{$day->total_payments}}</td>
            </tr
            <?php
            $i++;
        }
        ?>
        @if($p_days !='')      <tr><td></td><td></td><td>Total Payments</td><td><i>  {{ $total }} </i></td></tr>@endif
    </tbody>
</table>

<table>
    <tr><td class="head"><h4>All Payments:</h4></td><td class="head"></td><td class="head"></td></tr>
    <thead>
        <tr>
            <th>Receipt No</th>
            <th>Student id</th>
            <th>Class</th>                                     
            <th>Name</th>      
            <th>Payment Date</th>   
            <th> Paid</th>
            <th>Payment type</th>
            <th> Paid by</th>
            <th> Received by</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total = 0;
        foreach ($a_payments as $payment) {
            if ($a_payments != '') {
                $total +=$payment->paid_amount;
            }
            ?>
            <tr>
                <td>{{$payment->receipt_number}}</td>
                <td>{{$payment->students->unique_id}}</td>
                <td>{{$payment->students->class_sections->classes->class_name}}@if(($payment->students->class_sections->section_id) > 0)  -  {{ $payment->students->class_sections->sections->section_name}}  @endif -{{$payment->students->roll_number}}</td>
                <td>{{$payment->students->first_name}}</td>
                <td>{{$payment->payment_date}}</td>
                <td>{{$payment->paid_amount}}</td>
                <td>{{$payment->payment_mode}}</td>
                <td>{{$payment->paid_by}}</td>
                <td>{{$payment->user_logins->user_name}}</td>

            </tr>
            <?php
            $i++;
        }
        ?>
        @if( $a_payments != '')    <tr><td></td><td></td><td></td><td></td><td>Total</td><td>  {{ $total }}</td><td></td><td></td><td></td></tr> @endif
    </tbody>
</table>

<hr>
<center><h2 style="text-decoration:underline;">Expenses</h2></center>

<table>
    <tr><td class="head"><h4>Expenses Month-wise:</h4></td><td class="head"></td><td class="head"></td></tr>
    <thead>
        <tr>
            <th data-sortable="true">S No</th>
            <th data-sortable="true">Month-Year</th>
            <th data-sortable="true">Total Amount</th>

        </tr>
    </thead>
    <tbody>                                     
        <?php
        $i = 1;
        $total = 0;
        foreach ($e_months as $month) {
            if ($e_months != '') {
                $total +=$month->total_amount;
            }
            ?>      

            <tr class="">      
                <td>{{$i}}</td>
                <td>{{$month->month}} - {{$month->year}}</td>
                <td><a>{{$month->total_amount}}</a></td>                                                
            </tr>

            <?php
            $i++;
        }
        ?>
        @if($e_months !='')<tr><td></td><td>Total Expenses</td><td><i> {{ $total }} </i></td></tr>@endif
    </tbody>
</table>

<table>
    <tr><td class="head"><h4>Expenses Day-wise:</h4></td><td class="head"></td><td class="head"></td><td class="head"></td></tr>
    <tr>
        <td>S.No</td>
        <td>Date</td>
        <td>Day</td>
        <td>Expenses</td>
    </tr>
    <tbody>                                     
        <?php
        $i = 1;
        $total = 0;
        foreach ($e_days as $day) {
            if ($e_days != '') {
                $total +=$day->total_expenses;
            }
            ?>                                                                           
            <tr class="">      
                <td>{{$i}}</td>

                <td>{{$day->date}}</td>
                <td>{{$day->day}}</td>
                <td>{{$day->total_expenses}}</td>
            </tr
            <?php
            $i++;
        }
        ?>
        @if($e_days !='')      <tr><td></td><td>{{$e_days[0]->month_name}} - {{$e_days[0]->year}}</td><td>Total Expenses</td><td><i>{{ $total }} </i></td></tr>@endif
    </tbody>
</table>

<table>
    <tr><td class="head"><h4>Expenses Type-wise:</h4></td><td class="head"></td><td class="head"></td></tr>
    <thead>
        <tr>
            <th data-sortable="true">S No</th>
            <th data-sortable="true">Expenses Type</th>
            <th data-sortable="true">Total Amount</th>
        </tr>
    </thead>
    <tbody>                                     
        <?php
        $i = 1;
        $total = 0;
        foreach ($e_each_day as $each) {
            if ($e_each_day != '') {
                $total +=$each->total_expenses;
            }
            ?>                                                                           
            <tr class="">      
                <td>{{$i}}</td>
                <td>{{$each->title}}</a></td>
                <td>{{$each->total_expenses}}</td>
            </tr>
            <?php
            $i++;
        }
        ?>
        @if( $e_each_day != '')    <tr><td></td><td>Total</td><td> {{ $total }}</td></tr> @endif
    </tbody>
</table>

<table>
    <tr><td class="head"><h4>All Expenses </h4></td><td class="head"></td><td class="head"></td><td class="head"></td><td class="head"></td><td class="head"></td><td class="head"></td></tr>
    <thead>
        <tr>
            <th data-sortable="true">S.No</th>
            <th data-sortable="true">Expense Type</th>
            <th data-sortable="true">Pay To</th>
            <th data-sortable="true">Amount</th>
            <th data-sortable="true">Paid By</th>
            <th data-sortable="true">Paid On</th>
            <th data-sortable="true">Description</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total = 0;
        foreach ($e_expenses as $expense) {
            if ($e_expenses != '') {
                $total +=$expense->amount;
            }
            ?> 
            <tr class="">
                <td> {{$i}} </td>
                <td>{{$expense->expenses->title}}</td>
                <td>{{$expense->pay_to }}</td>
                <td>{{$expense->amount  }}</td>
                <td>{{$expense->paid_by}}</td>
                <td>{{$expense->paid_on }}</td>
                <td>{{$expense->description }}</td>


            </tr>
            <?php
            $i++;
        }
        ?>
        <tr><td></td><td></td><td>Total</td><td>{{$total}}</td><td></td><td></td><td></td></tr>
    </tbody>
</table>


@if($print==1)
<script type="text/javascript"> try {
        this.print();
    } catch (e) {
        window.onload = window.print;
    }</script>
@endif