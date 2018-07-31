@include('include.header')
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
                <li  class="active"><a href="{{url ('view-class-exams')}}"> Class exams</a></li>
                <li><a href="{{url ('view-schedule-exams')}}"> Schedule exams</a></li>
            </ul>
        </div><br>

        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Class Exams </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-class-exam')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder=" Exam Name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" data-provide="datepicker" placeholder=" start-date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" data-provide="datepicker" placeholder=" End-date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Schedule Exams" />
                                            </th>
                                           
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Exams</th>
                                            <th data-sortable="true">Class-Section</th>
                                            <th data-sortable="true">Exam-Start-Date</th>
                                            <th data-sortable="true">Exam-End-Date</th>
                                            <th data-sortable="true">Schedule Exams</th>
                                           
                                          
                                             <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($class_exams as $class_exam) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$class_exam->exams->title}}</td>
                                                <td>{{$class_exam->class_sections->classes->class_name}}   @if(($class_exam->section_id) != '0') - {{$class_exam->class_sections->sections->section_name}}@endif </td>
                                                <td>{{$class_exam->exams_start_date}}</td>
                                                <td>{{$class_exam->exams_end_date}}</td>
                                                <td><a  @if(Session::get('edit')==1) href="{{ ('add-schedule-exams/'.$class_exam->exam_id.'/'.$class_exam->class_section_id) }}" @endif><button class="btn txt-color-white btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif>Schedule Exam</button></a></td>
                                                <td>
                                                <div class="btn-group">
                                                        <a href="{{ url('edit-class-exam/'.$class_exam->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-class-exam/'.$class_exam->id) }}" onclick="return confirm('Are you sure to delete class exam Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($class_exam->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-class-exam/'.$class_exam->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                              
                                                @else
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-class-exam/'.$class_exam->id)}}">
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
                <div style="float: right;">
                </div>              
            </article>
        </div>
    </div>
</div>
@include('include.footer')
