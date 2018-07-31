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
        <td class="head" style="width:40%;"> <h2>Expenses</h2></td>
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