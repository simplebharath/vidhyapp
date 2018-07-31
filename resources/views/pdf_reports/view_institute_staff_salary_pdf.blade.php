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
        <td class="head" style="width:40%;"> <h2>Staff Salary</h2></td>
        <td class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td  class="head" style="width:10%;">&nbsp;</td>
        <td class="head" style="width:30%; font-size: 14px;"> Date :{{Carbon\Carbon::today()->format('d-m-Y')}}<br> 
            Academic year :{{ date('Y', strtotime($years[0]->from_date))}} - {{ date('Y', strtotime($years[0]->to_date))}}
        </td>
    </tr>
</table>

<hr>

<table>
    <thead>
        <tr>
            <th data-sortable="true">Department</th>
            <th data-sortable="true">Staff name</th>
            <th data-sortable="true">Month</th>
            <th data-sortable="true">Total salary</th> 
            <th data-sortable="true">Deducted salary</th>
            <th data-sortable="true">Gross salary</th>
            <th>Remarks</th>
            <th>Paid On</th>

        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($staff_salaries as $staff_salary) {
            ?> 
            <tr class="">                                                 
                <td>{{$staff_salary->staff_types->title}} <br> {{$staff_salary->staff_department->title}}</td>                                            
                <td><span>{{$staff_salary->staff->first_name}} {{$staff_salary->staff->last_name}}</span></td>                                      
                <td>{{$staff_salary->months->month}}</td>
                <td> {{ $staff_salary->staff->total_salary}}</td>
                <td> {{ number_format($staff_salary->deducted_salary,2)}}</td>
                <td> {{ $staff_salary->gross_salary}}</td>
                <td> {{ $staff_salary->remark }} </td> 
                <td>{{$staff_salary->created_at->format('d-m-Y')}}</td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<br>
<hr>
@if($print==1)
<script type="text/javascript"> try {
        this.print();
    } catch (e) {
        window.onload = window.print;
    }</script>
@endif