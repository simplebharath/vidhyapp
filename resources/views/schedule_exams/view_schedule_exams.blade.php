@include('include.header')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Exams</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
       
            <div class="">
                <ul class="nav nav-tabs">
                    <li><a href="{{url ('view-exams')}}"> Exams</a></li>
                    <li ><a href="{{url ('view-class-exams')}}"> Class exams</a></li>
                    <li  class="active"><a href="{{url ('view-schedule-exams')}}"> Schedule exams</a></li>
                </ul>
            </div><br>
    
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Schedule exams </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-exams')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Exam " />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:9%">
                                                <input type="text" class="form-control" placeholder="Subjects" />
                                            </th>
                                            <th class="hasinput" style="width:11%">
                                                <input type="text" class="form-control" data-provide="datepicker" placeholder="Exam date" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Timings" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Marks" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Syllabus" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                          
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Exam</th>
                                            <th data-sortable="true">Class </th>
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Exam date</th>
                                            <th data-sortable="true">Timings</th>
                                            <th data-sortable="true">Marks</th>
                                            <th data-sortable="true">Syllabus</th>
                                            <th>Actions</th>
                                           
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
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-schedule-exams/'.$schedule_exam->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                     @if(Session::get('user_type_id') == 1)    
                                                        <a href="{{ url('delete-schedule-exams/'.$schedule_exam->id) }}" onclick="return confirm('Are you sure to delete schedule exam Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                    @endif
                                                    </div>
                                                @if (($schedule_exam->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-schedule-exam/'.$schedule_exam->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                
                                                @else
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-schedule-exam/'.$schedule_exam->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                
                                                @endif
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
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
@include('include.footer')
