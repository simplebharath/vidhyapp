<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }
    td {
        text-align: center;
    }
    td, th {
       
        text-align: left;
        padding: 5px;
        font-weight: 100;
    }
     .row {
        border:1px solid #dddddd; }
    body{
        font-family: arial, sans-serif;
        font-size: 13px;
    }
</style>
   <div style="float:left;max-width:50px;">
                    <img width="80" height="80"  @if($institute[0]->institution_logo !="")  src="{{ asset('uploads/logo/'.$institute[0]->institution_logo) }}" @else  src="{{ asset('uploads/errors/200.png') }}" @endif style="width:80px;height: 80px;border-radius: 50%;padding-left:180px;">
                </div>
        <center>
            <p style="font-size: 25px; padding-bottom: 0px;margin-bottom: 0px;"> {{$institute[0]->institution_name}}</p>
            <span style="font-size: 14px; padding-top: 0px; margin-top: 0px;">&nbsp; <em>{{$institute[0]->address}}, {{$institute[0]->office_contact_number1}}</em></span>
        </center>
        
<p style="text-align:center;text-decoration: underline;"><em>Student Fee Payment History</em></p>
<?php  if((COUNT($payments) !=0)){ ?>
<table>
    <tr>
        <td> Academic year :{{ date('Y', strtotime($payments[0]->students->academic_years->from_date))}} - {{ date('Y', strtotime($payments[0]->students->academic_years->to_date))}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="float:right;">#Date:{{Carbon\Carbon::today()->format('d-m-Y')}}</td>
    </tr>
   
    <tr>
        <td>Student: {{$payments[0]->students->first_name.' '.$payments[0]->students->middle_name.' '.$payments[0]->students->last_name }}</td>
        <td>@if($payments[0]->students->gender == "Female")D/O @else S/O: @endif {{ $payments[0]->students->father_name }}</td>
        <td>Class: {{ $payments[0]->students->classes->class_name }} @if($payments[0]->students->class_sections->section_id !=0) - {{ $payments[0]->students->sections->section_name  }} @endif</td>
        <td>Roll No.: {{ $payments[0]->students->roll_number }}</td>
        <td>Student Id: {{ $payments[0]->students->unique_id }}</td>
    </tr>
 
</table>
 <?php  } ?>
<hr>

 @if((COUNT($payments) !=0) || (!empty($payments)))
 <br>
        <div>
           
         <table width="100%">
                <thead> 
                    <tr>

                        <th class="row">Receipt No</th>
                        <th class="row"> Paid Date</th>
                        <th class="row"> Fee</th>
                        <th class="row">  Paid</th>
                        <th class="row">  Payment Type</th>
                        <th class="row"> Paid by</th>
                        <th class="row"> Received by</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($payments as $payment) {
                        ?>
                        <tr>
                            <td class="row">{{$payment->receipt_number}}</td>
                            <td class="row">{{date("d-m-Y",strtotime($payment->payment_date))}}</td>
                            <td class="row">{{$payment->fees->fee_title}}</td>
                            <td class="row">{{$payment->paid_amount}}</td>
                            <td class="row">{{$payment->payment_mode}}</td>
                            <td class="row">{{$payment->paid_by}}</td>
                            <td class="row">{{$payment->user_logins->user_name}}</td>

                        </tr>
                        <?php
                        $i++;
                    }
                    ?>

                </tbody>
            </table>
        </div><br>
 <hr>
        @endif


@if($print==1)
<script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>
@endif