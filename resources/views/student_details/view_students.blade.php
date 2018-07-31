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
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Students </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-parents')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View Parents</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-student')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add student</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly=""class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student Id" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text"  class="form-control" placeholder="Credentials" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Father" />
                                            </th>
                                             <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Mother" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" readonly="" class="form-control"  placeholder="Actions" />
                                            </th>
                                          
                                           

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Student id</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Class-Roll No</th>
                                            <th data-sortable="true">Credentials </th>
                                            <th data-sortable="true">Father</th>    
                                             <th data-sortable="true">Mother</th>    
                                            <th >Actions</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($students as $student) {
                                            ?> 
                                            <tr class="">
                                                <td><a href="{{ url('view-student-profile/'.$student->id )}}" title="View profile"><img href="{{ url('view-student-profile/'.$student->id )}}"@if($student->photo != '') src="{{URL::asset('uploads/students/profile_photos/'.$student->photo)}}" @endif @if($student->photo == '') @if($student->gender == 'Male') src="{{ URL::asset('uploads/errors/student_male.png') }}" @endif @if($student->gender == 'Female') src="{{ URL::asset('uploads/errors/student_female.png') }}" @endif  @endif height="40" width="40" border-radius:50%;> </a> </td>
                                                <td  @if (( $student->status) == 1) style="color:green;" @else style="color:red;" @endif>{{$student->unique_id}}</td>
                                                <td>{{ $student->student_types->title }} <br><a  href="{{ url('view-student-profile/'.$student->id )}}" title="View profile">{{$student->first_name}}  {{$student->last_name}}</a> </td>    
                                                <td >{{$student->classes->class_name}} @if($student->section_id >0) - {{$student->sections->section_name}} @endif -{{ $student->roll_number}}</td>
                                                <td>User name: {{$student->user_logins->user_name}} <br> Password : {{$student->user_logins->password}}</td>
                                                <td>Father : {{$student->father_name}} <br> Mobile : {{$student->father_number}} </td>
                                                <td>Mother : {{$student->mother_name}} <br> Mobile : {{$student->father_number}}</td>
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-student/'.$student->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        <a href="{{ url('view-student-profile/'.$student->id )}}" title="view"><button class="btn btn-info btn-xs" data-title="View" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-eye-open"></span></button></a>
                                                    </div>
                                              
<!--                                                <td>
                                                    @if($student->add_rights == 1)<a  href="{{url('student-add-rights-make-no/'.$student->id)}}" rel="tooltip" title="" data-placement="top" data-original-title="Student having add rights.Click here to remove access."><span class="label label-danger" style=""><i class="ace-icon fa fa-plus-circle bigger-120"></i> Disable Add</span></a> @else <a href="{{url('student-add-rights-make-yes/'.$student->id)}}" rel="tooltip" title="" data-placement="top" data-original-title="Student not having add rights.Click here to give access."><span class="label label-success" style=""><i class="ace-icon fa fa-plus-circle bigger-120"></i> Enable Add </span></a> @endif 
                                                    <br><br> @if($student->view_rights == 1)<a href="{{url('student-view-rights-make-no/'.$student->id)}}" rel="tooltip" title="" data-placement="top" data-original-title="Student having view rights.Click here to remove access."><span class="label label-danger" style=""><i class="ace-icon fa fa-eye bigger-120"></i> Disable View</span></a> @else <a href="{{url('student-view-rights-make-yes/'.$student->id)}}" rel="tooltip" title="" data-placement="top" data-original-title="Student not having view rights.Click here to give access."><span class="label label-success" style=""><i class="ace-icon fa fa-eye bigger-120"></i> Enable View </span></a> @endif
                                                    <br><br>@if($student->edit_rights == 1)<a href="{{url('student-edit-rights-make-no/'.$student->id)}}" rel="tooltip" title="" data-placement="top" data-original-title="Student having edit rights.Click here to remove access."><span class="label label-danger" style=""><i class="ace-icon fa fa-edit bigger-120"></i> Disable Edit</span></a> @else <a href="{{url('student-edit-rights-make-yes/'.$student->id)}}" rel="tooltip" title="" data-placement="top" data-original-title="Student not having edit rights.Click here to give access."><span class="label label-success" style=""><i class="ace-icon fa fa-pencil bigger-120"></i> Enable Edit </span></a> @endif
                                                </td>-->
                                                @if (($student->status) == 1)
                                                <a class="btn btn-danger btn-xs" title="Make inactive" href="{{url('make-inactive-student/'.$student->id)}}">
                                                        <i class="glyphicon glyphicon-remove" > </i>
                                                    </a>
                                                
                                                @else 
                                                <a class="btn btn-success btn-xs" title="Make active" href="{{url('make-active-student/'.$student->id)}}">
                                                        <i class="glyphicon glyphicon-ok"> </i>
                                                    </a>
                                                
                                                @endif
                                        <a class="btn btn-primary btn-xs" title="Download report" href="{{url('student-summary-pdf/'.$student->id)}}" >
                                                        <i class="glyphicon glyphicon-download-alt"> </i>
                                                    </a>
                                                    <a class="btn btn-primary btn-xs" title="Print report" target="_blank" href="{{url('student-summary-print/'.$student->id)}}">
                                                        <i class="glyphicon glyphicon-print"> </i>
                                                    </a>
                                                     <a class="btn btn-primary btn-xs" @if($students[0]->email !="")  title="Email report" href="{{url('student-summary-email/2/'.$student->id)}}" @else title="Email id not exist." class="disabled" @endif>
                                                        <i class="glyphicon glyphicon-envelope"> </i>
                                                    </a>
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
