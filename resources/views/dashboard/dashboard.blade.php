@include('include.header')
@include('include.navigationbar')
<style>
    .show-stat-microcharts>div{
        margin-top: 0px !important;
    }
    .easy-pie-title{

        width:auto !important;
        display: inline !important;
    }
    .smaller-stat span.label{
        display: inline !important;
    }
    .btn.btn-default{
        color:white !important;
        background-color: #1a5276;
    }
    .fc-title{
        /*        overflow: hidden !important;
            white-space: nowrap !important;*/
        display: none !important;
    }
</style>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Dashboard</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content" style="padding-top:2px !important">
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12">
                    <div class="widget-body">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in padding-0 no-padding-bottom" id="s1">
                                <div class="show-stat-microcharts" >
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-left: 1px solid #DADADA!important;">                                  
                                        <a href="{{url('view-class-sections')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-book"></i></a>
                                        <span class="easy-pie-title"> Classes : <b> {{ $classes }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-blueDark">With section : {{ $classes - $section }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Without section  :  {{ $section }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">                                  
                                        <a href="{{url('view-students')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-user"></i></a>
                                        <span class="easy-pie-title"> Students : <b> {{ $students }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-green">Boys : {{ $students - $girls }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Girls :  {{ $girls }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">                                  
                                        <a href="{{url('view-staff')}}" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-users"></i></a>
                                        <span class="easy-pie-title"> Staff : <b> {{ $staff }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-blueDark">Teaching : {{  $teaching }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Non Teaching :  {{ $staff-$teaching }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-left: 1px solid #DADADA!important;">                                  
                                        <a href="{{url('view-vehicle-drivers')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-road"></i></a>
                                        <span class="easy-pie-title"> Routes : <b> {{ $transport }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-blueDark">Buses : {{ $vehicles}}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Drivers :  {{ $drivers }}</span>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-bottom: 1px solid #DADADA!important;border-left: 1px solid #DADADA!important;">                                  
                                        <a href="{{url('view-events')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-calendar"></i></a>
                                        <span class="easy-pie-title"> Events : <b> {{ $events }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-blueDark">Upcoming : {{ $events - $u_coming }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Completed :  {{ $u_coming }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-bottom: 1px solid #DADADA!important;">                                  
                                        <a href="{{url('view-class-exams')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-edit"></i></a>
                                        <span class="easy-pie-title"> Exams : <b> {{ $exams }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-green">Upcoming : {{ $exams - $marks }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Completed :  {{ $marks }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-bottom: 1px solid #DADADA!important;">                                  
                                        <a href="{{url('admin-view-messages')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-comment"></i></a>
                                        <span class="easy-pie-title"> Messages : <b> {{ $messages }} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-blueDark">New : {{ $messages - $read }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">Read :  {{ $read }}</span>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-right: 1px solid #DADADA!important;border-bottom: 1px solid #DADADA!important;">                                  
                                        <a href="{{url('balance-sheet-total-academic-years')}}" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-credit-card"></i></a>
                                        <span class="easy-pie-title"> Balance : <b> {{ number_format($income - $expenditure)}} </b></span>
                                        <ul class="smaller-stat hidden-sm pull-right">
                                            <li>
                                                <span class="label bg-color-blueDark">I : {{ number_format($income) }}</span>
                                            </li>
                                            <li>
                                                <span class="label bg-color-blue">E :  {{number_format( $expenditure) }}</span>
                                            </li>
                                        </ul>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </article>

            </div>
        </section>
        <br>
        <section id="widget-grid" class="">
            <div class="row" style="margin-right:-13px !important;">
                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6"  style=" margin-left: -10px;">
                    <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-comments txt-color-white"></i> </span>
                            <h2>Parent Messages</h2>									
                        </header>
                        <div>
                            <div class="widget-body widget-hide-overflow no-padding">
                                <div id="chat-body" class="chat-body custom-scroll">
                                    @if(COUNT($message)!=0)
                                    <ul>
                                        @foreach($message as $m)
                                        @if($m->status == 1)
                                        <li class="message">
                                            <img src="{{URL::asset("uploads/students/father/".$m->parents->father_photo)}}" width="50" height="50" style="border-radius:50%;" alt="">
                                            <div class="message-text">
                                                <time>
                                                    {{date("d-m-Y h:i a",strtotime($m->created_at))}}

                                                </time> <a href="{{url('admin-view-messages')}}" class="username">{{$m->students->father_name}} [ Student : {{$m->students->first_name}}   {{$m->students->last_name}}(  {{$m->students->classes->class_name}} @if($m->students->section_id !=0) - {{$m->students->sections->section_name}} @endif  | {{ $m->students->roll_number }} )]</a>

                                                <p class="chat-file row pull-left " style="background-color:lightblue;">

                                                    {{ $m->message}}
                                                </p>

                                            </div>
                                        </li>
                                        @else
                                        <li class="message">
                                            <img src="{{URL::asset("uploads/students/father/".$m->parents->father_photo)}}" width="50" height="50" style="border-radius:50%;" alt="">
                                            <div class="message-text">
                                                <time>
                                                    {{date("d-m-Y h:i a",strtotime($m->created_at))}}

                                                </time> <a href="{{url('admin-view-messages')}}" class="username">{{$m->students->father_name}} [ Student : {{$m->students->first_name}}   {{$m->students->last_name}}(  {{$m->students->classes->class_name}} @if($m->students->section_id !=0) - {{$m->students->sections->section_name}} @endif  | {{ $m->students->roll_number }} )]</a>

                                                <p class="chat-file row pull-left ">

                                                    {{ $m->message}}
                                                </p>

                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @else
                                   
                                        <div class="alert alert-info">Nothing to Show</div>
                                    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jarviswidget" id="wid-id-3" data-widget-colorbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                            <h2> Scheduled : Exams,Events and Holidays </h2>
                            <div class="widget-toolbar">
                                <!-- add: non-hidden - to disable auto hide -->
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
                                        Showing <i class="fa fa-caret-down"></i>
                                    </button>
                                    <ul class="dropdown-menu js-status-update pull-right">
                                        <li>
                                            <a href="javascript:void(0);" id="mt">Month</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" id="ag">Agenda</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" id="td">Today</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <div class="widget-body-toolbar">
                                    <div id="calendar-buttons">
                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                      
                </article>
                <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6 no-padding">
                    <div class="jarviswidget" id="wid-id-4">
                        <header>
                            <h2>Total Students </h2>
                            <div class="jarviswidget-ctrls" role="menu" ></div>   
                        </header>
                        <div>
                            <div class="widget-body no-padding">

                                <canvas id="barChart" height="138"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="jarviswidget" id="wid-id-4">
                        <header>
                            <h2>{{Session::get('a_date')}} Attendance </h2>
                            <div class="jarviswidget-ctrls" role="menu" >   <a href="{{url('admin-dashboard')}}" style="color:white !important; padding-right: 5px;" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="search"><i class="fa fa-search" style="color:white !important;"></i> search</a>  </div>

                            <div class="widget-toolbar smart-form" role="menu">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <label class="input"> 
                                    <input type="text" name="startdate" id="startdate" value="{{Session::get('a_date')}}" placeholder="Select Date" >
                                    <b class="tooltip tooltip-top-right">
                                        <i class="fa fa-warning txt-color-teal"></i> 
                                        Select the date less than or equal to today's date</b> 
                                </label>

                            </div>

                        </header>
                        <div>
                            <div class="widget-body no-padding">           
                                <div class="table-responsive">

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>S NO</th>
                                                <th>Class</th>
                                                @if($attendance_type_id==2) <th>Subject</th> @endif
                                                <th>Attendance</th>
                                                <th>Present</th>
                                                <th>Absent</th>
                                            </tr>
                                        </thead>
                                        @if(!empty($s_attendance))
                                        <?php
                                        $i = 1;
                                        foreach ($s_attendance as $attendan) {
                                            foreach ($attendan as $attendance) {
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$attendance->class_name}} {{$attendance->section_name}}</td>
                                                        @if($attendance_type_id==2)<td>{{$attendance->subject_name}}</td>@endif
                                                        <td>@if($attendance->present!=0)<a class="btn bg-color-green txt-color-white btn-xs"  title="Attendance taken.">
                                                                <i class="fa fa-check"> </i> 
                                                            </a> @else <a class="btn bg-color-red txt-color-white btn-xs" title="Attendance not taken.">
                                                                <i class="fa fa-times"> </i> 
                                                            </a> @endif</td>
                                                        <td>{{$attendance->present}}</td>
                                                        <td>{{$attendance->total-$attendance->present}}</td>

                                                    </tr>                                           
                                                </tbody>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                                @endif
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>

@include('include.footer')

<script>
    $(document).ready(function () {
        pageSetUp();
        if ($("#calendar").length) {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var calendar = $('#calendar').fullCalendar({
                editable: false,
                draggable: false,
                selectable: false,
                selectHelper: true,
                unselectAuto: false,
                disableResizing: false,
                height: "auto",
                header: {
                    left: 'title', //,today
                    center: 'prev, next, today',
                    right: 'month, agendaWeek, agenDay' //month, agendaDay,
                },
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        }, true // make the event "stick"
                                );
                    }
                    calendar.fullCalendar('unselect');
                },
                events: "{{url('/')}}" + '/get_events',
                eventRender: function (event, element, icon) {
                    if (!event.description == "") {
                        element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
                    }
                    if (!event.icon == "") {
                        element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
                    }
                }
            });

        }
        ;

        /* hide default buttons */
        $('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();

        // calendar prev
        $('#calendar-buttons #btn-prev').click(function () {
            $('.fc-prev-button').click();
            return false;
        });

        // calendar next
        $('#calendar-buttons #btn-next').click(function () {
            $('.fc-next-button').click();
            return false;
        });

        // calendar today
        $('#calendar-buttons #btn-today').click(function () {
            $('.fc-button-today').click();
            return false;
        });

        // calendar month
        $('#mt').click(function () {
            $('#calendar').fullCalendar('changeView', 'month');
        });

        // calendar agenda week
        $('#ag').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        });

        // calendar agenda day
        $('#td').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        });

        /*
         * CHAT
         */

        $.filter_input = $('#filter-chat-list');
        $.chat_users_container = $('#chat-container > .chat-list-body')
        $.chat_users = $('#chat-users')
        $.chat_list_btn = $('#chat-container > .chat-list-open-close');
        $.chat_body = $('#chat-body');

        /*
         * LIST FILTER (CHAT)
         */

        // custom css expression for a case-insensitive contains()
        jQuery.expr[':'].Contains = function (a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

        function listFilter(list) {// header is any element, list is an unordered list
            // create and add the filter form to the header

            $.filter_input.change(function () {
                var filter = $(this).val();
                if (filter) {
                    // this finds all links in a list that contain the input,
                    // and hide the ones not containing the input while showing the ones that do
                    $.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                    $.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
                } else {
                    $.chat_users.find("li").slideDown();
                }
                return false;
            }).keyup(function () {
                // fire the above change event after every letter
                $(this).change();

            });

        }

    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        pageSetUp();

        // var titles;
        $.ajax({
            type: 'GET',
            url: '/attendance-chart',
            dataType: 'json',
            success: function (data, status) {
                var abc = data.labels;
                var attendance_status = [];
                var attendance_color = [];
                var attendance_data = [];
                for (var i in data.sets) {
                    attendance_status.push(data.sets[i].label);
                    attendance_color.push(data.sets[i].backgroundColor);
                    attendance_data.push(data.sets[i].a_data);
                }
                var barChartData = {
                    "labels": abc,
                    "datasets": [
                        {
                            "label": attendance_status[0],
                            "backgroundColor": attendance_color[0],
                            "data": attendance_data[0]
                        }

                    ]
                };

                window.myBar = new Chart(document.getElementById("barChart"), {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                        }
                    }
                });
            }});

        $('#startdate').datepicker({
            dateFormat: 'dd.mm.yy',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onSelect: function (selectedDate) {
                $('#startdate').datepicker('option', '10-01-2018', selectedDate);
            }
        });
    });

</script>
