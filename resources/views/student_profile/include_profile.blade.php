<div class="well well-light well-sm no-margin no-padding">
    <div class="row">
        <div class="col-sm-12">
            <div id="myCarousel" class="carousel fade profile-carousel">
                <div class="air air-bottom-right padding-10">

                </div>
                <div class="air air-top-left padding-10">
                    <h6 class="txt-color-white font-md"></h6>
                </div>                                      

            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3 ">
                    <img src="{{URL::asset('uploads/students/profile_photos/'.$students[0]->photo)}}"  alt="" @if($students[0]->gender == 'Male') style="background-color:#3276b1;" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @else  style="background-color:#3276b1;" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  height="90" width="90">
                        
                </div>
                <div class="col-sm-9">
                    <h2 style="padding-left: 25px;"> <span class="semi-bold">{{$students[0]->first_name}}  {{$students[0]->last_name}}</span>
                        <br>
                        <small>{{$students[0]->classes->class_name }} @if($students[0]->section_id > 0) - {{ $students[0]->sections->section_name}}@endif - {{ $students[0]->roll_number}}</small>
                    </h2>
                    @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                    <a href="{{url('edit-student/'.$students[0]->id)}}" title="Edit profile" class="btn txt-color-white bg-color-teal btn-xs"><i class="fa fa-edit"></i></a>
                        <a href="{{url('view-students')}}" title="View students" class="btn txt-color-white bg-color-pinkDark btn-xs"><i class="fa fa-eye"></i></a>
                        @endif
                        @if($students[0]->parents !="")
                         <a href="{{url('student-summary-pdf/'.$students[0]->id)}}" title="Download report" class="btn txt-color-white bg-color-blueDark btn-xs"><i class="glyphicon glyphicon-download-alt"></i></a>
                        <a href="{{url('student-summary-print/'.$students[0]->id)}}" title="Print report" target="_blank" class="btn txt-color-white bg-color-red btn-xs"><i class="glyphicon glyphicon-print"></i></a>
                        @if($students[0]->email !="") <a href="{{url('student-summary-email/2/'.$students[0]->id)}}" title="Email to student" class="btn txt-color-white bg-color-green btn-xs"><i class="glyphicon glyphicon-envelope"></i></a>@endif
                         @if($students[0]->parents->father_email !="") <a href="{{url('student-summary-email/1/'.$students[0]->id)}}" title="Email to parent" class="btn txt-color-white bg-color-teal btn-xs"><i class="glyphicon glyphicon-envelope"></i>  </a>@endif
                      @endif
                    <ul class="list-unstyled">
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">Academic year <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Present Academic year">{{ date('Y', strtotime($students[0]->academic_years->from_date))}}  {{ date('Y', strtotime($students[0]->academic_years->to_date))}} </a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-inbox"></i>&nbsp;&nbsp;<span class="txt-color-darken">Email <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Email ">{{$students[0]->email }}  </a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">Mobile number  {{$students[0]->contact_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">Emergency number  {{$students[0]->emergency_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>

                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Birth date <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Date of birth">{{ date('jS \\of F Y', strtotime($students[0]->date_of_birth))}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-university"></i>&nbsp;&nbsp;<span class="txt-color-darken">Student id <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Student id">{{$students[0]->unique_id}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-neuter"></i>&nbsp;&nbsp;<span class="txt-color-darken">Admission number <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Admission number">{{$students[0]->admission_number}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-drupal"></i>&nbsp;&nbsp;<span class="txt-color-darken">Unique identity number <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Unique identity number">{{$students[0]->aadhaar_number}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-drupal"></i>&nbsp;&nbsp;<span class="txt-color-darken">Admission type <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Student come to school in thos mode">{{$students[0]->student_types->title}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-user"></i>&nbsp;&nbsp;<span class="txt-color-darken">Father name <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{$students[0]->father_name}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-phone-square"></i>&nbsp;&nbsp;<span class="txt-color-darken">Mobile number <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{$students[0]->father_number}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-user-md"></i>&nbsp;&nbsp;<span class="txt-color-darken">Mother name <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{$students[0]->mother_name}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-phone-square"></i>&nbsp;&nbsp;<span class="txt-color-darken">Mobile number <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="">{{$students[0]->mother_number}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-plus-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">Joined Date <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Joined date">{{ date('jS \\of F Y', strtotime($students[0]->joined_date))}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-plus-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">Joined Academic year <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Joined date">{{ date('Y', strtotime($students[0]->joined_academic_years->from_date))}} - {{ date('Y', strtotime($students[0]->joined_academic_years->to_date))}}</a></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-plus-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">Joined Class <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Joined date">{{$students[0]->joined_classes->class_name }} @if($students[0]->joined_section_id > 0) - {{ $students[0]->joined_sections->section_name}}@endif - {{ $students[0]->joined_roll_number}}</a></span>
                            </p>
                        </li>
                    </ul>                     
                    <p class="font-md">
                        <i>Present address</i>
                    </p>
                    <p>{{$students[0]->present_address}}</p>

                    <p class="font-md">
                        <i>Permanent address</i>
                    </p>
                    <p>{{$students[0]->permanent_address}}</p>

                    <p class="font-md">
                        <i>Identification Marks</i>
                    </p>
                    <p>1. {{$students[0]->mark_1}}</p>

                    <p>2. {{$students[0]->mark_2}}</p>
                    <p class="font-md"> Rights </p>
                    <ul class="list-inline friends-list form-inline">
                        <li>Add : @if($students[0]->add_rights == 1 ) Yes @else No @endif</li>
                        <li>View : @if($students[0]->view_rights == 1 ) Yes @else No @endif</li>
                        <li>Edit : @if($students[0]->edit_rights == 1 ) Yes @else No @endif</li>                              
                    </ul>


                </div>                                            
            </div>
        </div><hr>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="padding-10">
                <header><p style="font-weight:300;font-size: 20px;font-family: sans-serif;">General info</p></header>
                <div class="tab-content padding-top-10">
                    <div class="tab-pane fade in active" id="a1">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Gender</a></p></td>
                                    <td>{{ $students[0]->gender}} </td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Blood group</a></p></td>
                                    <td>{{ $students[0]->blood_group}}</td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Religion</a></p></td>
                                    <td>{{ $students[0]->religion}} </td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Caste</a></p></td>
                                    <td>{{ $students[0]->caste}} </td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Nationality</a></p></td>
                                    <td>{{ $students[0]->nationality}}</td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Physically Handicapped</a></p></td>
                                    <td>@if($students[0]->physically_handicapped == 1) YES @else NO @endif</td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Siblings in this school</a></p></td>
                                    <td>@if($students[0]->siblings == 1) YES @else NO @endif</td>
                                </tr>
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Domicile</a></p></td>
                                    <td>{{ $students[0]->domicile}} </td>
                                </tr> 
                                <tr>
                                    <td> <p class="no-margin"><a href="#">Hobbies</a></p></td>
                                    <td>{{ $students[0]->hobbies}} </td>
                                </tr> 
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>