@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Classes</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-classes')}}">Classes</a></li>
                <li><a href="{{url ('view-sections')}}">Sections</a></li>
                <li ><a href="{{url ('view-subjects')}}">Subjects</a></li>
                <li><a href="{{ url('view-class-sections')}}">Class-Sections</a></li>
                <li ><a href="{{ url('view-class-subjects')}}">Class-Subjects</a></li> 
                <li class="active"><a href="{{ url('view-class-schedule')}}">Class-Schedule</a></li> 
                <li  ><a href="{{ url('view-class-teachers')}}">Class-Teacher</a></li>
            </ul>
        </div><br>     
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        @if($class_name != '')
                        <h2>{{$class_name[0]->classes->class_name}} @if ($class_name[0]->section_id != 0 ) -  {{$class_name[0]->sections->section_name}} @endif  Class Timetable</h2>
                        @else
                        <h2>View All Classes Schedule</h2>
                        @endif
                    </header> 
                    @if(Session::get('view') == 1)
                    <div class="col-lg-12 form-inline" >
                        <form action="{{url('class-schedule')}}" method="POST">
                            {{ csrf_field() }} 
                            <div class="form-group col-sm-7">
                                <label  class="col-sm-2"> Class </label> &nbsp;&nbsp;
                                <select  name="class_section_id"   class="col-xs-10 col-sm-4 col-md-9 col-lg-9">
                                    @if(COUNT($classes) != 1)
                                    <option value="0">                   ---  select class  --- </option> 
                                    @endif
                                    <?php foreach ($classes as $class) { ?>
                                        <option value="<?php echo $class->id; ?>" @if($class->id == $class_section_id) selected @endif ) >{{$class->classes->class_name}}  @if ($class->section_id >0 ) {{$class->sections->section_name}} @endif</option>
                                    <?php } ?>

                                </select>
                            </div> 
                            <button class="btn btn-info col-sm-2" type="submit">search</button>
                            <a class="btn btn-primary" href="{{url('view-class-schedule')}}"><i class="fa fa-refresh"></i></a>
                            @if($class_name != '')
                            <a class="btn btn-warning btn-xs"  href="{{url('class-schedule-pdf/'.$class_name[0]->id)}}"><i class="fa fa-file-pdf-o"> </i>  PDF</a> &nbsp;&nbsp;
                            <a class="btn btn-danger btn-xs"   href="{{url('class-schedule-excel/'.$class_name[0]->id)}}"><i class="fa fa-file-excel-o"> </i>  Excel</a>
                            @endif
                        </form><br>

                    </div><br><br>
                    <div>   
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">

                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text" class="form-control" placeholder="Day" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Period" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Subject" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control" placeholder="Start" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control"  placeholder="End" />
                                                    </th>
                                                    <th class="hasinput" style="width:10%">
                                                        <input type="text"  class="form-control"  placeholder="Duration" />
                                                    </th>

                                                </tr>
                                        <tr>
                                            <th data-sortable="true">Day</th>
                                            <th data-sortable="true">Period</th>
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Start</th>
                                            <th data-sortable="true">End</th> 
                                            <th data-sortable="true">Duration</th> 
                                        </tr>
                                    </thead>
                                    <tbody>                                     
                                        @foreach ($class_subjects as $class_subject)                                                                              
                                        <tr class="">      
                                            <td>{{$class_subject->days->day_title}}</td>
                                            <td>{{ $class_subject->timings->title }}</td>
                                            <td>{{$class_subject->subjects->subject_name}}</td>                   
                                            <td> {{ $class_subject->timings->class_start }} </td>
                                            <td>{{ $class_subject->timings->class_end }} </td>
                                            <td>{{ $class_subject->timings->duration }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    @else                                                                                                          
                    <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this service.Please contact administrator.</h3>
                    @endif

                </div>

            </article>
        </div>
    </div>
</div>
@include('include.footer')
