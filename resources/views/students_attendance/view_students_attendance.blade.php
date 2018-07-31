@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li ><a href="{{url ('view-students')}}">Students</a></li> 
                <li class="active"><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Students Attendance</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-student-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('edit-student-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-pencil"></i> Edit</a> -->
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            @if($attendance_type[0]->id ==2 )
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Subject" />
                                            </th>
                                            @endif
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="student name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" data-provide="datepicker"  class="form-control" placeholder="Select date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Attendance" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="reason" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Taken on" />
                                            </th>


                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>   
                                            <th data-sortable="true"> Class</th>  
                                            @if($attendance_type[0]->id ==2 )
                                            <th data-sortable="true">Subject</th>
                                            @endif
                                            <th data-sortable="true">Student name</th>         
                                            <th >Date</th>
                                            <th >Attendance</th>
                                            <th >Reason</th>
                                            <th >Taken on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(COUNT($student_attendances) !=0)
                                        <?php
                                        $i = 1;
                                        foreach ($student_attendances as $student_attendance) {
                                            ?> 
                                            <tr class="">
                                                <td>{{$i}}</td>
                                                <td> {{$student_attendance->class_sections->classes->class_name}} @if($student_attendance->class_sections->section_id > 0) - {{ $student_attendance->class_sections->sections->section_name}} @endif </td>
                                                @if($attendance_type[0]->id ==2 )
                                                <td>@if($student_attendance->subject_id >0) {{$student_attendance->subjects->subject_name}} @endif</td>
                                                @endif
                                                <td> {{$student_attendance->students->first_name}} {{$student_attendance->students->last_name}}</td>                                               
                                                <td> {{  date("d-m-Y", strtotime($student_attendance->attendance_date))}}</td>
                                                <td>  @if($student_attendance->attendance_status == 1) Present @else Absent @endif </td>
                                                <td>{{$student_attendance->reason}}</td>
                                                <td class="col-md-3">{{$student_attendance->created_at->format('l jS \\of F Y h:i:s A')}}</td>

                                            </tr>
                                            <?php $i++;
                                        } ?>
                                            @endif
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
