@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Reports</li><li>Classes</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('view-institute-classes')}}">Classes</a></li> 
                <li><a href="{{url ('view-institute-students')}}">Students</a></li> 
                <li><a href="{{url ('view-institute-timetable')}}">Class Timetable</a></li> 
                <li><a href="{{url ('view-institute-fees')}}">Class Fees</a></li> 
                <li><a href="{{url ('view-institute-transport-fees')}}">Transport Fee</a></li> 
                 <li><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                 <li><a href="{{url ('view-institute-students-marks')}}">Exams</a></li>
<!--                 <li><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
                 -->
                <li><a href="{{url ('view-institute-staff')}}">Staff</a></li>
                <li><a href="{{url ('view-institute-staff-attendance')}}">Staff Attendance</a></li>
                <li><a href="{{url ('view-institute-staff-salary')}}">Staff Salary</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>View All Classes</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                        -->
<a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url("view-institute-classes-pdf/2")}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</a>
<a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url("view-institute-classes-pdf/1")}}" target="_blank" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</a>
                  
                    </header>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">

                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S no" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Class" />
                                            </th>
                                            
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="No. Students" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>
                                            <th data-sortable="true">Class</th>
                                            
                                            <th data-sortable="true">Number of Students</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                    @if(!empty($classes))    
                                        <?php $i = 1;
                                        foreach ($classes as $c) { 
                                         foreach ($c as $class) { ?> 
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td><a href="{{url('view-institute-students/'.$class->id)}}">{{$class->class_name}} 
                                                        @if($class->section_id >0) - {{ $class->section_name }} @endif </a></td>
                                                <td>{{$class->total_students}}</td>                                                               
                                            </tr>
    <?php $i++;
                                        }} ?>
                                            @endif
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
