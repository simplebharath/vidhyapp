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
        
<p style="text-align:center;text-decoration: underline;"><em>Student Fee Receipt</em></p>
<table>
    <tr>
        <td> Academic year :{{ date('Y', strtotime($payments[0]->students->academic_years->from_date))}} - {{ date('Y', strtotime($payments[0]->students->academic_years->to_date))}}</td>
        
        <td>Date:{{Carbon\Carbon::today()->format('d-m-Y')}}</td>
    
        <td></td>
        <td style="float:right;">Receipt Number :</td>
        <td> #{{ $payments[0]->receipt_number }}</td>
    </tr>
    <tr>
        <td>Student: {{$payments[0]->students->first_name.' '.$payments[0]->students->middle_name.' '.$payments[0]->students->last_name }}</td>
        <td>@if($payments[0]->students->gender == "Female")D/O @else S/O: @endif {{ $payments[0]->students->father_name }}</td>
        <td>Class: {{ $payments[0]->students->classes->class_name }} @if($payments[0]->students->class_sections->section_id !=0) - {{ $payments[0]->students->sections->section_name  }} @endif</td>
        <td>Roll No.: {{ $payments[0]->students->roll_number }}</td>
        <td>Student Id: {{ $payments[0]->students->unique_id }}</td>
    </tr>
</table>

<hr>

<table style="padding-left:200px;">
    <tr><td style="width:30%;">Fee Title  </td><td> : &nbsp;&nbsp; {{$payments[0]->fees->fee_title}}</td></tr>
    <tr><td style="float:right;">Amount Paid By </td><td> : &nbsp;&nbsp; {{$payments[0]->paid_by}}</td></tr>
    <tr><td style="float:right;">Amount Paid  </td><td> : &nbsp;&nbsp; {{$payments[0]->paid_amount}}</td></tr>
    <tr><td style="float:right;">Payment Type  </td><td> : &nbsp;&nbsp; {{$payments[0]->payment_mode}}</td></tr>
    <tr><td style="float:right;">Paid Date </td><td> : &nbsp;&nbsp; {{date("d-m-Y",strtotime($payments[0]->payment_date))}}</td></tr>
    <tr><td style="float:right;">Amount Received By </td><td> : &nbsp;&nbsp; {{$payments[0]->user_logins->user_name}}</td></tr>
</table>
<br><br>
<h3 align="right" style="padding-right:150px;">Receiver&rsquo;s Signature</h3>
<hr>

@if($print==1)
<script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>
@endif