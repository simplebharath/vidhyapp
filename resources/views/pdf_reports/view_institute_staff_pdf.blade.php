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
        <td class="head" style="width:40%;"> <h2>Staff </h2></td>
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
            <th data-sortable="true">Staff type</th>
            <th data-sortable="true">Department</th>
            <th data-sortable="true">Photo</th>
            <th data-sortable="true">Staff id </th>
            <th data-sortable="true">Name</th>
            <th data-sortable="true">Contact</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($staffs as $staff) {
            ?> 
            <tr class="">
                <td>{{ $staff->staff_types->title }} </td>
                <td>{{$staff->departments->title}}</td>
                <td><img src="{{URL::asset('uploads/staff/'.$staff->photo)}}"  @if($staff->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($staff->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="30" width="30"></a>  </td>
                
                <td>{{$staff->staff_unique_id}}</a></td>                                               
                <td>{{$staff->first_name}}  {{$staff->last_name}}</a> </td>    
                <td>{{$staff->contact_number}} <br> {{$staff->email}}</td>
            </tr>
            <?php
            $i++;
        }
        ?>
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