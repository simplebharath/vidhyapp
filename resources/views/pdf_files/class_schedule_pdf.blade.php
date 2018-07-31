<style>
    table, th, td
    {
        border-collapse:collapse;
        border: 1px solid black;
        width:100%;
        text-align:center;
        font-family: sans-serif;
    }
</style>

<div id="main" role="main" >
    <div  align="center">
<!--            <div  align="left"> <img src='{{ asset('uploads/logo/'.$institutions[0]->institution_logo) }}'  height="100" width="100" style="border-radius: 50%; margin-top: 20px;" class=""> </div>-->
        <p class="panel-title" style="color:white; color:black; text-align: center; font-family: sans-serif;font-size: 30px;">{{ $institutions[0]->institution_name }}</p>                            
    </div>
    <div id="ribbon" >

    </div>
    <div id="content">

        <div class="row">

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        @if(COUNT($classes)== 1)
                        <h2>{{$classes[0]->classes->class_name}} @if ($classes[0]->section_id != 0 ) -  {{$classes[0]->sections->section_name}} @endif  Class Timetable</h2>
                        @else
                        <h2>View All Classes Schedule</h2>
                        @endif
                    </header> 

                    <div>   
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="connection-table" data-toggle="table" class="table table-condensed " 
                                       data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="true" data-search="true" >
                                    <thead>
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
                                        <?php $i = 1;
                                        foreach ($class_subjects as $class_subject) { ?>                                                                       
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td><span class="badge bg-color-orange">{{$class_subject->days->day_title}}</span></td>
                                                <td><span class="badge bg-color-redLight">{{ $class_subject->timings->title }}</span></td>
                                                <td><span class="badge bg-color-blue">{{$class_subject->subjects->subject_name}} </span></td>                   
                                                <td> {{ $class_subject->timings->class_start }} </td>
                                                <td>{{ $class_subject->timings->class_end }} </td>
                                                <td>{{ $class_subject->timings->duration }}</td>
                                            </tr>
    <?php $i ++;
} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
        </div>
    </div>
</div>

