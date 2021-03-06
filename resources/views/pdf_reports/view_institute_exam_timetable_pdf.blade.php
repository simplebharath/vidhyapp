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
        <td class="head" style="width:40%;"> <h2>Exam Timetable </h2></td>
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
            <th data-sortable="true">S.No</th>
            <th data-sortable="true">Exam</th>
            <th data-sortable="true">Class </th>
            <th data-sortable="true">Subject</th>
            <th data-sortable="true">Exam date</th>
            <th data-sortable="true">Timings</th>
            <th data-sortable="true">Marks</th>
            <th data-sortable="true">Syllabus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($schedule_exams as $schedule_exam) {
            ?> 
            <tr class="">
                <td> {{$i}} </td>
                <td>{{$schedule_exam->exams->title}}</td>
                <td>{{$schedule_exam->class_sections->classes->class_name}}   @if(($schedule_exam->section_id) != '0') - {{$schedule_exam->class_sections->sections->section_name}}@endif </td>
                <td>{{$schedule_exam->subjects->subject_name}}</td>
                <td>{{$schedule_exam->exam_date}}</td>
                <td> {{$schedule_exam->exams_start_time}} - {{$schedule_exam->exams_end_time}} <br>{{$schedule_exam->exam_duration}}</td>

                <td> MAX : {{$schedule_exam->max_marks}}<br> Pass : {{$schedule_exam->pass_marks}}</td>
                <td>{{$schedule_exam->exam_syllabus}}</td> 
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