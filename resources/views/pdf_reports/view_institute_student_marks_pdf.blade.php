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
        <td class="head" style="width:40%;"> <h2>Exam Marks </h2></td>
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
            <th data-sortable="true">Class -ROll No</th>   
            <th data-sortable="true"> Student</th>                                        
            <th data-sortable="true">Image</th>  
            <th data-sortable="true">Exam</th>
            <th data-sortable="true">Subject</th>
            <th data-sortable="true">Min/Max Marks</th>
            <th data-sortable="true">Secured Marks</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($marks as $mark) {
            ?> 
            <tr class="">

                <td> 
                    {{ $mark->students->classes->class_name }}  @if(($mark->students->section_id) > 0)  -  {{ $mark->students->sections->section_name}}  @endif
                    - {{$mark->students->roll_number}}</td>
                <td>{{$mark->students->first_name}} {{$mark->students->last_name}} <br> {{$mark->students->unique_id}}</td>
                <td><img src="{{URL::asset('uploads/students/profile_photos/'.$mark->students->photo)}}"  @if($mark->students->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($mark->students->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="30" width="30"> </a> </td>
                
           
                <td>{{$mark->exams->title}}</td>
                <td>{{$mark->subjects->subject_name}} <br>( {{$mark->schedule_exams->exam_date}} ) </td>
                <td>Pass marks: {{$mark->schedule_exams->pass_marks}} <br> Max. marks:{{$mark->schedule_exams->max_marks}}</td>

                <td id="marks">
                    {{$mark->marks_obtained}}</td>

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