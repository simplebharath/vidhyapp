@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Staff</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li ><a href="{{url ('view-staff')}}">Staff</a></li> 
                <li ><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li class="active" ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>     
        @endif
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Staff Salary</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-salary')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                                <input type="text" class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Staff name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Month" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Total salary" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Deducted" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Gross salary" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Remarks" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control" placeholder="Paid on" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly=""  class="form-control" placeholder="Print" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Staff name</th>
                                            <th data-sortable="true">Month</th>
                                            <th data-sortable="true">Total salary</th> 
                                            <th data-sortable="true">Deducted salary</th>
                                            <th data-sortable="true">Gross salary</th>
                                            <th>Remarks</th>
                                            <th>Paid On</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($staff_salaries as $staff_salary) {
                                            ?> 
                                            <tr class="">                                                 
                                                <td>{{$staff_salary->staff_types->title}} <br> {{$staff_salary->staff_department->title}}</td>                                            
                                                <td><span>{{$staff_salary->staff->first_name}} {{$staff_salary->staff->last_name}}</span></td>                                      
                                                <td>{{$staff_salary->months->month}}</td>
                                                <td> &#x20B9; {{ $staff_salary->staff->total_salary}}</td>
                                                <td> &#x20B9; {{ number_format($staff_salary->deducted_salary,2)}}</td>
                                                <td>&#x20B9; {{ $staff_salary->gross_salary}}</td>
                                                <td> {{ $staff_salary->remark }} </td> 
                                                <td>{{$staff_salary->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td>
                                                    <div class="btn-group">                                                      
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-staff-salary/' .$staff_salary->id)}}" onclick="return confirm('Are you sure to delete Staff salary details.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif                                                    
                                                       &nbsp; <a href="{{url('salary-pay-slip-pdf/'.$staff_salary->id)}}" ><li class="fa fa-file-pdf-o"></li></a>
                                                       &nbsp; <a href="{{url('salary-pay-slip-print/'.$staff_salary->id)}}" target="_blank"><li class="glyphicon glyphicon-print"></li></a>                                   
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
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
