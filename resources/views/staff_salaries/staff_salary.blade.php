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
                <li ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li>     
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        @endif
        <section  class="">
            <div class="row">
                <div class=""style="margin-left: 15px;">
                    <ul class="nav nav-tabs pull-left">
                        <li ><a href="{{url ('view-staff-profile/'.$staffs[0]->id)}}">Profile</a></li>
                        <li><a href="{{url ('view-staff-experiences/'.$staffs[0]->id)}}">Experience</a></li>
                        <li ><a href="{{url ('view-staff-qualifications/'.$staffs[0]->id)}}">Qualifications</a></li> 
                        <li ><a href="{{url ('view-staff-documents/'.$staffs[0]->id)}}">Documents</a></li>
                          @if(Session::get('user_type_id') == 4)  <li><a href="{{url ('view-staff-timetable/'.$staffs[0]->id)}}">Timetable</a></li> @endif
                        <li><a href="{{url ('view-staff-total-attendance/'.$staffs[0]->id)}}">Attendance</a></li>
                        <li  class="active"><a href="{{url ('view-staff-salary/'.$staffs[0]->id)}}">Salary</a></li>
                        
                    </ul>
                </div>
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('include.messages')
                    <div class="col-sm-12 col-md-12 col-lg-4">
                      @include('staff_details.include_staff_profile')
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                            @if(Session::get('view') == 1)
                            <header>
                                <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                <h2> View <b> {{$staffs[0]->first_name}} {{$staffs[0]->middle_name}} {{$staffs[0]->last_name}}</b> Salary </h2>                               
                            </header>		
                            <div>

                                <div class="widget-body no-padding">
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            
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
                                            
                                            <th data-sortable="true">Month</th>
                                            <th data-sortable="true">Total salary</th> 
                                            <th data-sortable="true">Deducted </th>
                                            <th data-sortable="true">Gross salary</th>
                                            <th>Remarks</th>
                                            <th>Paid On</th>
                                            <th>Print</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(COUNT($staff_salaries)>0)
                                        <?php
                                        foreach ($staff_salaries as $staff_salary) {
                                            ?> 
                                            <tr class="">                                                 
                                                <td>{{$staff_salary->months->month}}</td>
                                                <td> &#x20B9; {{ $staff_salary->staff->total_salary}}</td>
                                                <td> &#x20B9; {{number_format($staff_salary->deducted_salary,2)}}</td>
                                                <td>&#x20B9; {{ $staff_salary->gross_salary}}</td>
                                                <td> {{ $staff_salary->remark }} </td> 
                                                <td>{{$staff_salary->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{url('salary-pay-slip-pdf/'.$staff_salary->id)}}" ><li class="fa fa-file-pdf-o"></li></a>
                                                        <a href="{{url('salary-pay-slip-print/'.$staff_salary->id)}}" target="_blank"><li class="glyphicon glyphicon-print"></li></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            @endif
                                    </tbody>
                                </table>			
                                </div>
                            </div>

                            @else                                                                                                          
                            <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this 'View Documents' service.Please contact administrator.</h3>
                            @endif 
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>

@include('include.footer')

