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
        <div class="">
            <ul class="nav nav-tabs">
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li>
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
            </ul>
        </div><br>
        <div class="row">
            <div class=""style="margin-left: 15px;">
                <ul class="nav nav-tabs pull-left">
                    <li ><a href="{{url ('view-student-profile/'.$students[0]->id)}}">Profile</a></li>
                    <li  ><a href="{{url ('view-student-experiences/'.$students[0]->id)}}">Experience</a></li>
                    <li class="active"><a href="{{url ('view-student-educations/'.$students[0]->id)}}">Qualifications</a></li> 
                    <li ><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li> 
                    <li><a href="{{url ('view-student-timetable/'.$students[0]->id)}}">Timetable</a></li>
                    <li><a href="{{url ('view-student-total-attendance/'.$students[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-student-salary/'.$students[0]->id)}}">Salary</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="well well-light well-sm no-margin no-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="myCarousel" class="carousel fade profile-carousel">
                                    <div class="air air-bottom-right padding-10">
                                        <a href="{{url('edit-student/'.$students[0]->id)}}" class="btn txt-color-white bg-color-teal btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="{{url('view-student')}}" class="btn txt-color-white bg-color-pinkDark btn-sm"><i class="fa fa-eye"></i> View </a>
                                        <a href="{{url('student-download')}}" class="btn txt-color-white bg-color-pink btn-sm"><i class="fa fa-download"></i> Download </a>
                                    </div>
                                    <div class="air air-top-left padding-10">
                                        <h6 class="txt-color-white font-md"></h6>
                                    </div>                                      
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="{{URL::asset('uploads/logo/'.$institute_details[0]->institution_image)}}" alt="">
                                        </div>                                              
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3 profile-pic">
                                        <img src="{{URL::asset('uploads/student/'.$students[0]->photo)}}"  alt="" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.jpg') }}'" height="90" width="90">
                                        <div class="padding-10">
                                            <h6 class="font-md"><strong>{{$no_classes}}</strong>
                                                <br>
                                                <small>Subjects</small></h6>
                                            <br>
                                            <h6 class="font-md"><strong>{{$no_classes}}</strong>
                                                <br>
                                                <small>Classes</small></h6>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <h2 style="padding-left: 25px;"> {{$students[0]->last_name}} <span class="semi-bold">{{$students[0]->first_name}}</span>
                                            <br>
                                            <small>@if($students[0]->emp_designation != '') {{ $students[0]->emp_designation }} - @endif {{$students[0]->departments->title}}</small>
                                        </h2>

                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$students[0]->contact_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$students[0]->emergency_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                                                </p>
                                            </li>

                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Birth date <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Create an Appointment">{{$students[0]->date_of_birth}}</a></span>
                                                </p>
                                            </li>
                                        </ul>
                                        <br>
                                        <p class="font-md">
                                            <i>Present address</i>
                                        </p>
                                        <p>{{$students[0]->present_address}}</p>
                                        <br>
                                        <p>                                                  
                                        <p class="font-md"> Rights </p>
                                        <ul class="list-inline friends-list form-inline">
                                            <li>Add : @if($students[0]->add_rights == 1 ) Yes @else No @endif</li>
                                            <li>View : @if($students[0]->view_rights == 1 ) Yes @else No @endif</li>
                                            <li>Edit : @if($students[0]->edit_rights == 1 ) Yes @else No @endif</li>
                                            <li>Delete : @if($students[0]->delete_rights == 1 ) Yes @else No @endif</li>
                                        </ul>           
                                        </p>
                                    </div>                                            
                                </div>
                            </div><hr>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                            <h2> View <b> {{$students[0]->first_name}} {{$students[0]->middle_name}} {{$students[0]->last_name}}</b> Educational Qualifications</h2>
                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-student')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View student</a>
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
                                            foreach ($student_educations as $student_education) {
                                                ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$student_education->education}}</td>
                                                    <td>{{$student_education->institute_name}}</td>
                                                    <td>{{$student_education->course_name}}</td>
                                                    <td>{{$student_education->stream_branch}}</td>
                                                    <td>{{$student_education->percentage}}</td>                                          

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
