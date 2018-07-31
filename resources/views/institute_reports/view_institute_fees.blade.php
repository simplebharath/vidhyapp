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
                <li class="active"><a href="{{url ('view-institute-fees')}}">Class Fees</a></li> 
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
                        <h2>View Fees</h2>
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-excel-o"></i>  EXCEL </a>
                        -->
                        <form class="form-horizontal" action="{{url('view-institute-fees-pdf/2')}}" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 

                            @if($class_id !="")
                            @foreach($class_id as $class)
                            <input type="hidden" name="class_section_id[]"  value="{{$class}}">
                            @endforeach
                            @endif
                            @if($fee_id !="")
                            @foreach($fee_id as $fee)
                            <input type="hidden" name="fee_id[]" value="{{$fee}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>  PDF</button>
                        </form>
                        <form class="form-horizontal" action="{{url('view-institute-fees-pdf/1')}}" target="_blank" enctype="multipart/form-data" method="GET">
                            {{ csrf_field() }} 

                            @if($class_id !="")
                            @foreach($class_id as $class)
                            <input type="hidden" name="class_section_id[]"  value="{{$class}}">
                            @endforeach
                            @endif
                            @if($fee_id !="")
                            @foreach($fee_id as $fee)
                            <input type="hidden" name="fee_id[]" value="{{$fee}}">
                            @endforeach
                            @endif
                            <button type="submit" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-print"></i>  Print</button>
                        </form>

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
                                            <form class="form-horizontal" action="{{url('view-institute-fees')}}" enctype="multipart/form-data" method="POST">
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
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get Fees</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institute-fees')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Fee Type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Fee" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Term Fee" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Total Fee" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S. No</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Fee Type</th>
                                            <th data-sortable="true">Fee</th>
                                            <th data-sortable="true">Term Fee</th>
                                            <th data-sortable="true">Total Fee</th> 

                                        </tr>
                                    </thead>
                                    <tbody>                                     
<?php $i = 1;
foreach ($class_fees as $class_fee) {
    ?>                                                                            
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td>{{$class_fee->class_sections->classes->class_name}} @if($class_fee->section_id >0) - {{ $class_fee->class_sections->sections->section_name }} @endif</td>
                                                <td>{{$class_fee->fee_types->fee_name}}</td>
                                                <td>{{$class_fee->fees->fee_title}}</td>
                                                <td>{{$class_fee->fee_amount}}</td>
                                                <td>{{$class_fee->fee_amount * $class_fee->fee_types->yearly}}</td>
                                            </tr>
    <?php $i++;
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
