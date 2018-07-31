@include('include.header')
@include('include.navigationbar')
<style>
    select[multiple]{
        min-width:130px !important;
    }
</style>
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Reports</li><li>Class Fees</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-institute-classes')}}">Classes</a></li> 
                <li><a href="{{url ('view-institute-students')}}">Students</a></li> 
                <li><a href="{{url ('view-institute-timetable')}}">Class Timetable</a></li> 
                <li><a href="{{url ('view-institute-fees')}}">Class Fees</a></li> 
                <li><a href="{{url ('view-institute-transport-fees')}}">Transport Fee</a></li> 
                <li><a href="{{url ('view-institute-students-attendance')}}">Student Attendance</a></li> 
                <li><a href="{{url ('view-institute-students-marks')}}">Exam Marks</a></li>
                <li  class="active"><a href="{{url ('view-institute-students-payments')}}">Payments</a></li>
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
                        <h2>View Fees</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</a>
                    </header>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <div class="col-sm-12"><br>                                         
                                        <div class="row" id="">
                                            <label class="col-sm-1"> </label>
                                            <div class="col-sm-2">

                                            </div>
                                            <form class="form-horizontal" action="{{url('view-institute-students-payments')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id[]" multiple=""  class="">
                                                    
                                                        @foreach($class_sections as $class_section)
                                                        <option value="{{$class_section->id}}" <?php
                                                        if ($class_id != '') {
                                                            foreach ($class_id as $class_i) {
                                                                if ($class_i == $class_section->id) {
                                                                    ?> selected="selected" <?php
                                                            }
                                                        }
                                                    }
                                                        ?> >{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        @endforeach
                                                    </select>                                          
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="fee_id[]" multiple="" class="">
                                            
                                                        @foreach($fees as $fee)
                                                        <option value="{{$fee->id}}" <?php
                                                    if ($fee_id != '') {
                                                        foreach ($fee_id as $fee_i) {
                                                            if ($fee_i == $fee->id) {
                                                                ?> selected="selected" <?php
                                                            }
                                                        }
                                                    }
                                                        ?> >{{ $fee->fee_title }}  </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" data-provide="datepicker" placeholder="Date"  @if($date !='') value="{{$date}}" @endif name="date">                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-xs btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Payments</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-0">
                                                    <a href="{{url('view-institute-students-payments')}}" class="width-10 btn btn-xs btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>
                                     <thead>
                                        <tr>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Receipt" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" data-provide="datepicker" class="form-control" placeholder="date" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Admission type" />
                                            </th>

                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Roll number" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Fee" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Paid" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Paid by" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Received by" />
                                            </th>
                                        </tr>
                                        <tr>

                                            <th> <i class="fa fa-building"></i>Receipt No</th>
                                            <th> <i class="fa fa-calendar"></i> Date</th>

                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Admission type</th>
                                            <th data-sortable="true">Roll number</th>                                              
                                            <th data-sortable="true">Name</th>      
                                            <th> Fee</th>
                                            <th>  Paid</th>
                                            <th> Paid by</th>
                                            <th> Received by</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($payments as $payment) {
                                            ?>
                                            <tr>
                                                <td>{{$payment->receipt_number}}</td>
                                                <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                                <td>{{$payment->students->class_sections->classes->class_name}}@if(($payment->students->class_sections->section_id) > 0)  -  {{ $payment->students->class_sections->sections->section_name}}  @endif</td>
                                                <td>{{$payment->students->student_types->title}}</td>
                                                <td>{{$payment->students->roll_number}}</td>
                                                <td>{{$payment->students->first_name}}</td>

                                                <td>{{$payment->fees->fee_title}}</td>
                                                <td>{{$payment->paid_amount}}</td>
                                                <td>{{$payment->paid_by}}</td>
                                                <td>{{$payment->user_logins->user_name}}</td>
                                              
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
