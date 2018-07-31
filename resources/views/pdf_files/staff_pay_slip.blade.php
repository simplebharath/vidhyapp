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
<p style="text-align:center;text-decoration: underline;"><em>Salary Pay Slip</em></p>
<table>
    <tr>
        <td style="width:40%;"> Academic year :{{ date('Y', strtotime($staff_salary[0]->staff->academic_years->from_date))}} - {{ date('Y', strtotime($staff_salary[0]->staff->academic_years->to_date))}}</td>
        
        <td style="width:20%;">Date:{{Carbon\Carbon::today()->format('d-m-Y')}}</td>
    
        <td style="width:15%;"></td>
        <td style="float:right;width:25%;">Receipt Number :  #{{ $staff_salary[0]->id }}</td>
        
    </tr>
    <tr>
        <td style="width:40%;">Staff: {{$staff_salary[0]->staff->first_name.' '.$staff_salary[0]->staff->middle_name.' '.$staff_salary[0]->staff->last_name }}</td>
        
        <td style="width:20%;">{{ $staff_salary[0]->staff_types->title}} - {{ $staff_salary[0]->staff_department->title}} </td>
        <td style="width:15%;"></td>
        <td style="width:25%;">Staff Id: {{ $staff_salary[0]->staff->staff_unique_id }}</td>
    </tr>
</table>

<hr>

<table style="padding-left:200px;">
    <tr><td style="width:30%;">Payment Month  </td><td> : &nbsp;&nbsp; {{$staff_salary[0]->months->month}}</td></tr>
    <tr><td style="float:right;">Total Salary </td><td> : &nbsp;&nbsp; {{$staff_salary[0]->staff->total_salary}}</td></tr>
    <tr><td style="float:right;">Deducted  </td><td> : &nbsp;&nbsp; {{ number_format($staff_salary[0]->deducted_salary,2)}}</td></tr>
    <tr><td style="float:right;">Net Salary  </td><td> : &nbsp;&nbsp; {{ $staff_salary[0]->gross_salary }}</td></tr>
    <tr><td style="float:right;">Paid Date </td><td> : &nbsp;&nbsp; {{date("d-m-Y",strtotime($staff_salary[0]->created_at))}}</td></tr>
    <tr><td style="float:right;">Paid By </td><td> : &nbsp;&nbsp; {{$staff_salary[0]->user_logins->user_name}}</td></tr>
</table>
<br><br>
<h3 align="right" style="padding-right:150px;">Department of accounts</h3>
<hr>



@if($print==1)
<script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>
@endif