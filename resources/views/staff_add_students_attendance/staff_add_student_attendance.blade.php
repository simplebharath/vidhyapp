@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('staff-add-student-attendance')}}">Add Attendance</a></li>
                <li ><a href="{{url ('staff-view-students-attendance')}}">View Attendance</a></li> 
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Add  Attendance @if($class_name =='') Of all students of the school. @endif @if($class_name !='') Of Class  {{$class_name[0]->classes->class_name}} @if($class_name[0]->section_id > 0) {{$class_name[0]->sections->section_name}} @endif @endif   @if($attendance_type[0]->id == 2)  Subject - {{ $subjects[0]->subject_name}} @endif </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-add-student-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> Add</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('staff-save-students-attendance')}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <div class="dt-toolbar pull-right" style="float:right;">
                                            <div class="col-sm-1">
                                                <label>Select date</label>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" placeholder="Select date" name="attendance_date" class="form-control datepicker">
                                                <label class=""  title=""  data-original-title="Select Date"></label>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="width-10 btn btn-md btn-info">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save Attendance</span>
                                                </button>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:3%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                @if($class_name == '')
                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" class="form-control" placeholder="Class" />
                                                </th>
                                                @endif

                                                @if($attendance_type[0]->id == 2)
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Subject" />
                                                </th>
                                                @endif
                                                <th class="hasinput" style="width:18%">
                                                    <input type="text" class="form-control" placeholder="Name" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text"  class="form-control" placeholder="Roll No" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Attendance" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Reason" />
                                                </th>

                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S No</th>
                                                @if($class_name == '')<th data-sortable="true">Class</th>@endif
                                                @if($attendance_type[0]->id == 2)<th>Subject</th>@endif
                                                <th data-sortable="true">Name</th>                                              
                                                <th data-sortable="true">Roll No</th>                                                
                                                <th data-sortable="true">Attendance</th>
                                                <th data-sortable="true">Reason</th>             

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($students as $student) {
                                                ?> 
                                                <tr class="">        
                                            <input type="text" hidden="" value="{{$student->class_section_id}}" name="class_section_id[<?php echo $student->id; ?>]">
                                            
                                            <td>{{$i}}</td>
                                            @if($class_name == '')
                                            <td>{{$student->classes->class_name}}</td>
                                            @endif
                                            @if($attendance_type[0]->id == 2)
                                            <input  hidden="" name="subject_id[<?php echo $student->id; ?>]" value="{{$subjects[0]->id}}" >
                                            <td>{{$subjects[0]->subject_name}}</td>
                                            @endif
                                            <td>{{$student->first_name}} {{$student->last_name}} </td>
                                            <td>{{$student->roll_number}}</td>
                                            <td data-sortable="true">
                                                <input  hidden="" name="attendance_status[<?php echo $student->id; ?>]" value="0" >
                                                <input type="checkbox" checked name="attendance_status[<?php echo $student->id; ?>]"  value="1" @if(old('attendance_status')) checked @endif >                                                        
                                            </td>                                                  
                                            <td><input type="text" name="reason[<?php echo $student->id; ?>]"></td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>     
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')