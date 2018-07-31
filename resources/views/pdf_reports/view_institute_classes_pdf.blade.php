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
        <td class="head" style="width:40%;"> <h2>Classes </h2></td>
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
            <th style="width:33%;">S No</th>
            <th style="width:33%;">Class</th>

            <th style="width:33%;">Number of Students</th>
        </tr>
    </thead>
    <tbody>                                     
        <?php $i = 1;
        foreach ($classes as $class) {
            ?>                                                                           
            <tr class="">      
                <td style="width:33%;">{{$i}}</td>
                <td style="width:33%;">{{$class->class_name}} 
                    @if($class->section_id >0) - {{ $class->section_name }} @endif </td>
                <td style="width:33%;">{{$class->total_students}}</td>                                                               
            </tr>
            <?php $i++;
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