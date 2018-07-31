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
        <td class="head" style="width:40%;"> <h2>Class Timetable </h2></td>
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
            <th data-sortable="true">S No.</th>
            <th data-sortable="true">Class</th>
            <th data-sortable="true">Subject</th>
            <th data-sortable="true">Day</th>
            <th data-sortable="true">Period</th>
            <th data-sortable="true">Start-End</th>
            <th data-sortable="true">Duration</th> 
            <th data-sortable="true">Staff</th>
            <th data-sortable="true">Image</th>
        </tr>
    </thead>
    <tbody>                                     
        <?php
        $i = 1;
        foreach ($class_subjects as $class_subject) {
            ?>                                                                         
            <tr class="">      
                <td>{{$i}}</td>
                <td>{{ $class_subject->classes->class_name }}@if($class_subject->section_id >0) {{ $class_subject->sections->section_name }} @endif</td>
                <td>{{$class_subject->subjects->subject_name}}</td>  
                <td>{{$class_subject->days->day_title}}</td>
                <td>{{ $class_subject->timings->title }}</td>
                <td> {{ $class_subject->timings->class_start }} - {{ $class_subject->timings->class_end }} </td>
                <td>{{ $class_subject->timings->duration }}</td>
                <td>@if($class_subject->staff_id !=0){{$class_subject->staffs->first_name}} {{$class_subject->staffs->last_name}}<br>Dep : {{$class_subject->staffs->departments->title}}   @else Not Assigned @endif</td>
                <td>@if($class_subject->staff_id ==0) - @else <img src="{{URL::asset('uploads/staff/'.$class_subject->staffs->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="30" width="30"></a> @endif</td>
               
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