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
        
<p style="text-align:center;text-decoration: underline;"><em>Student Fees</em></p>
<table>
    <tr>
        <td> Academic year :{{ date('Y', strtotime($students[0]->academic_years->from_date))}} - {{ date('Y', strtotime($students[0]->academic_years->to_date))}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td style="float:right;">#Date:{{Carbon\Carbon::today()->format('d-m-Y')}}</td>
    </tr>
    <tr>
        <td>Student: {{$students[0]->first_name.' '.$students[0]->middle_name.' '.$students[0]->last_name }}</td>
        <td>@if($students[0]->gender == "Female")D/O @else S/O: @endif {{ $students[0]->father_name }}</td>
        <td>Class: {{ $students[0]->classes->class_name }} @if($students[0]->class_sections->section_id !=0) - {{ $students[0]->sections->section_name  }} @endif</td>
        <td>Roll No.: {{ $students[0]->roll_number }}</td>
        <td>Student Id: {{ $students[0]->unique_id }}</td>
    </tr>
</table>

<hr>
<br>
  @if(COUNT($student_fees) !=0)
        <div>
        
            <table class="table">
                <thead>
                    <tr>


                        <th class="row"> Fee Title</th>
                        <th class="row"> Amount</th>
                        <th class="row"> Discount</th>
                        <th class="row">Total Amount<br>(yearly)</th>
                        <th class="row"> Paid Amount</th>
                        <th class="row"> Due</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    $total = 0;
                    $paid = 0;
                    $discount = 0;
                    foreach ($student_fees as $student_fee) {
                        $data = ($student_fee->fee_amount * $student_fee->yearly) - $student_fee->discount;
                        $total +=$data;
                        $discount += $student_fee->discount;
                        $paid +=$student_fee->paid_amount;
                        ?>
                        <tr>

                            <td class="row">{{$student_fee->fee_title}}</td>
                            <td class="row">{{$student_fee->fee_amount}} ( {{$student_fee->fee_name}} )</td>
                            <td class="row">@if($student_fee->discount !=""){{$student_fee->discount}} @else 0 @endif</td>
                            <td class="row">{{($student_fee->fee_amount * $student_fee->yearly)- $student_fee->discount}}</td>
                            <td class="row">@if($student_fee->paid_amount !='') {{$student_fee->paid_amount }} @else 0 @endif</td>
                            <td class="row">{{($student_fee->fee_amount * $student_fee->yearly) - $student_fee->paid_amount - $student_fee->discount}}</td>

                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    @if($transport_fees !="")
                    <?php
                    $t = ($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->discount;
                    $total +=$t;
                    $paid +=$transport_fees[0]->paid_amount;
                    $discount += $transport_fees[0]->discount;
                    ?>
                    <tr>

                        <td class="row">{{$transport_fees[0]->fee_title}}</td>
                        <td class="row">{{$transport_fees[0]->transport_fee }}( {{$transport_fees[0]->fee_name}} )</td>
                        <td class="row">@if($transport_fees[0]->discount !=""){{$transport_fees[0]->discount}} @else 0 @endif</td>
                        <td class="row">{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly)-$transport_fees[0]->discount}}</td>
                        <td class="row">@if($transport_fees[0]->paid_amount !='') {{$transport_fees[0]->paid_amount }} @else 0 @endif</td>
                        <td class="row">{{($transport_fees[0]->transport_fee * $transport_fees[0]->yearly) - $transport_fees[0]->paid_amount - $transport_fees[0]->discount}}</td>

                    </tr>
                    @endif
                    <tr><td class="row"></td> <td class="row"><b>Total</b></td><td class="row">{{$discount}}</td> <td class="row"><b>{{$total}}</b></td> <td class="row"><b>{{$paid}}</b></td> <td class="row"><b>{{$total - $paid}}</b></td></tr>
                </tbody>
            </table>
        </div><br><hr>
        @else
        <p style="text-align:center;padding: 10px;border:1px solid lightgrey;">No data or not yet added.</p>
        @endif



@if($print==1)
<script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>
@endif