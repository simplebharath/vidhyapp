<table style="border: 1px solid black;" >
    <thead>
        <tr><h2 style="color:white; color:black; text-align: center; font-family: sans-serif;font-size: 20px;">{{ $institutions[0]->institution_name }}</h2></tr>
<tr> <h6 style="text-align:center;font-size: 15px;">{{$classes[0]->classes->class_name}} @if ($classes[0]->section_id != 0 ) -  {{$classes[0]->sections->section_name}} @endif  Class Timetable</h6>       </tr>
        <tr>
            <th data-sortable="true">S.No</th>
            <th data-sortable="true">Day</th>
            <th data-sortable="true">Period</th>
            <th data-sortable="true">Subject</th>
            <th data-sortable="true">Start</th>
            <th data-sortable="true">End</th> 
            <th data-sortable="true">Duration</th> 
        </tr>
    </thead>
    <tbody>                                     
        <?php $i=1; foreach ($class_subjects as $class_subject)       {?>                                                                       
        <tr class="">      
            <td>{{$i}}</td>
            <td><span class="badge bg-color-orange">{{$class_subject->days->day_title}}</span></td>
            <td><span class="badge bg-color-redLight">{{ $class_subject->timings->title }}</span></td>
            <td><span class="badge bg-color-blue">{{$class_subject->subjects->subject_name}} </span></td>                   
            <td> {{ $class_subject->timings->class_start }} </td>
            <td>{{ $class_subject->timings->class_end }} </td>
            <td>{{ $class_subject->timings->duration }}</td>
        </tr>
        <?php $i ++;}?>
    </tbody>
</table>
