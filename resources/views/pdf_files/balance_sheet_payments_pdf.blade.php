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
        <td class="head" style="width:40%;"> <h2>Payments </h2></td>
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


@if($print==1)
<script type="text/javascript"> try {
        this.print();
    } catch (e) {
        window.onload = window.print;
    }</script>
@endif