@include('include.header')
<style> #error-message{margin-left:158px;}</style>
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
        <div class="row">
            <div class=""style="margin-left: 15px;">
                <ul class="nav nav-tabs pull-left">
                    <li ><a href="{{url ('view-staff-profile/'.$staffs[0]->id)}}">Profile</a></li>
                    <li  ><a href="{{url ('view-staff-experiences/'.$staffs[0]->id)}}">Experience</a></li>
                    <li class="active"><a href="{{url ('view-staff-qualifications/'.$staffs[0]->id)}}">Qualifications</a></li> 
                    <li ><a href="{{url ('view-staff-documents/'.$staffs[0]->id)}}">Documents</a></li> 
                      @if(Session::get('user_type_id') == 4)  <li><a href="{{url ('view-staff-timetable/'.$staffs[0]->id)}}">Timetable</a></li> @endif
                    <li><a href="{{url ('view-staff-total-attendance/'.$staffs[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-staff-salary/'.$staffs[0]->id)}}">Salary</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="col-sm-12 col-md-12 col-lg-4">
                   @include('staff_details.include_staff_profile')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                            <h2> View <b> {{$staffs[0]->first_name}} {{$staffs[0]->middle_name}} {{$staffs[0]->last_name}}</b> Educational Qualifications</h2>
                            
                        </header>                    
                        <div>                     
                            <div class="jarviswidget-editbox">                          
                            </div>                       
                            <div class="widget-body no-padding">
                                <div class="table-responsive">
                                    @if(Session::get('view') == 1)
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <thead> 
                                            <tr>
                                                <th class="hasinput" style="width:6%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                <th class="hasinput" style="width:18%">
                                                    <input type="text" class="form-control" placeholder="Enter Degree" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text"  class="form-control" placeholder="Enter institute" />
                                                </th>
                                                <th class="hasinput" style="width:16%">
                                                    <input type="text" class="form-control" placeholder="Enter Course" />
                                                </th>
                                                <th class="hasinput" style="width:15%">
                                                    <input type="text"  class="form-control" placeholder="Enter Specialization" />
                                                </th>
                                                <th class="hasinput" style="width:15%">
                                                    <input type="text" class="form-control" placeholder="Enter GPA" />
                                                </th>

                                            </tr>

                                            <tr>
                                                <th data-sortable="true">SNo</th>
                                                <th data-sortable="true">Degree</th>
                                                <th data-sortable="true">Institute</th>
                                                <th data-sortable="true">Course</th>             
                                                <th data-sortable="true">Specialization</th>
                                                <th data-sortable="true">GPA</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($staff_qualifications as $staff_qualification) {
                                                ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$staff_qualification->qualification}}</td>
                                                    <td>{{$staff_qualification->institute_name}}</td>
                                                    <td>{{$staff_qualification->course_name}}</td>
                                                    <td>{{$staff_qualification->stream_branch}}</td>
                                                    <td>{{$staff_qualification->percentage}}</td>                                          

                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    @else                                                                                                          
                                    <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this service.Please contact administrator.</h3>
                                    @endif                               
                                </div>
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
