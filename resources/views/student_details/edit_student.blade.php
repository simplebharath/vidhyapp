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
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Edit student</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">

                                        <li class="active">
                                            <a href="{{url('edit-student/'.$students[0]->id)}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-parent/'.$students[0]->id)}}"> <span class="step">2</span> <span class="title">Parents Information</span> </a>
                                        </li>
                                        <li >
                                            <a href="#"> <span class="step">3</span> <span class="title">Previous Institution</span> </a>
                                        </li>
                                        <li >
                                            <a href="#"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div><br>
                                <div class="col-sm-12">
                                    <form class="form-horizontal" action="{{url('do-edit-student/'.$students[0]->id)}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div class="col-xs-12">
                                            <legend>Admission info</legend>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Academic year<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select readonly name="academic_year_id" id="academic_year_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >                                                                                                                       
                                                                <option value="{{$years[0]->id}}">{{$years[0]->from_year}} - {{$years[0]->to_year}}</option>                                                         
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('academic_year_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select   name="user_type_id" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >                                                              
                                                                    <option value="{{ $students[0]->user_type_id }}" >{{ $students[0]->user_types->title }}</option>                                                             
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_type_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="student_type_id" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                                
                                                                <?php foreach ($student_types as $student_type) { ?>
                                                                    <option value="{{ $student_type->id }}" @if($students[0]->student_type_id == $student_type->id )selected @endif>{{ $student_type->title }}</option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('student_type_id') }}
                                                        </div>
                                                    </div>
                                                    @if($students[0]->student_type_id != 1)
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="class_section_id" id="class_section_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                                
                                                                    <option value="{{ $students[0]->class_section_id }}" >{{ $students[0]->class_sections->classes->class_name }} @if($students[0]->section_id > 0) - {{$students[0]->class_sections->sections->section_name}}@endif</option>
                                                                
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('class_section_id') }}
                                                        </div>
                                                    </div>
                                                     @endif
                                                    @if($students[0]->student_type_id == 1)
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                           <select  name="route_id" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">                                                                
                                                                 <?php foreach ($routes as $route) { ?>
                                                                    <option value="{{ $route->id }}" @if($students[0]->route_id == $route->id )selected @endif>{{ $route->route_from }} - {{ $route->route_to }}</option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Stop <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                           <select  name="stop_id" id=""  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">   
                                                                <?php foreach ($stops as $stop) { ?>
                                                                    <option value="{{ $stop->id }}" @if($students[0]->stop_id == $stop->id )selected @endif>{{ $stop->stop_name }} : Pickup:{{ $stop->pickup_time }} - Drop:{{ $stop->drop_time }}</option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    @endif

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                     @if($students[0]->student_type_id == 1)
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="class_section_id" id="class_section_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                                
                                                                    <option value="{{ $students[0]->class_section_id }}" >{{ $students[0]->class_sections->classes->class_name }} @if($students[0]->section_id > 0) - {{$students[0]->class_sections->sections->section_name}}@endif</option>
                                                                
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('class_section_id') }}
                                                        </div>
                                                    </div>
                                                     @endif
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student ID<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" readonly="" style="background-color:lightgrey;" id="form-field-1" placeholder="" name="unique_id" value="{{ $students[0]->unique_id}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('unique_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Admission number <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1"  name="admission_number" value="{{ $students[0]->admission_number}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('admission_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Roll number<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="roll_number" value="{{ $students[0]->roll_number}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('roll_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Joined date<span class="error">* </span></label>                                               
                                                        <div class="col-sm-9 input">
                                                            <input type="text"  id="example1"  name="joined_date" value="{{ $students[0]->joined_date}}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('joined_date') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-xs-12">
                                            <legend>Personal info</legend>
                                            <div class="row">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Student name<span class="error">* </span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="first_name" value="{{$students[0]->first_name}}" placeholder="First name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('first_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="middle_name" value="{{$students[0]->middle_name}}" placeholder="Middle name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('middle_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="last_name" value="{{$students[0]->last_name}}" placeholder="Last name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('last_name') }}
                                                    </p>
                                                </div>                
                                            </div>
                                            <hr>
                                            <article class="col-xs-6">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of birth<span class="error">* </span></label>                                               
                                                        <div class="col-sm-9 input">
                                                            <input type="text"  id="example1"  name="date_of_birth" value="{{ $students[0]->date_of_birth}}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('date_of_birth') }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="email" value="{{ $students[0]->email}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="contact_number" value="{{ $students[0]->contact_number}}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('contact_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Emergency number<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="emergency_number" value="{{ $students[0]->emergency_number}}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('emergency_number') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="" class=""  name="photo" value="{{ $students[0]->photo}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('photo') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"></span></label>                                                    
                                                        <div class="col-sm-4">
                                                            <img src="{{URL::asset('uploads/students/profile_photos/'.$students[0]->photo)}}" width="150" height="120" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-xs-12"><br>
                                            <legend>Contact info</legend>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unique identity number </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="aadhaar_number" value="{{ $students[0]->aadhaar_number}}" class="input-mask-aadhaar col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('aadhaar_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father name <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="father_name" value="{{ $students[0]->father_name}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="father_number" value="{{ $students[0]->father_number}}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mother name <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="mother_name" value="{{ $students[0]->mother_name}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_name') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone number<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="mother_number" value="{{ $students[0]->mother_number}}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Present Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="3" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="present_address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $students[0]->present_address }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('present_address') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Permanent Address </label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="permanent_address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $students[0]->permanent_address }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('permanent_address') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-xs-12"><br>
                                            <legend>General info</legend>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Gender <span class="error">*</span></label>
                                                        <div class="col-md-9">
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="gender" value="Male" @if($students[0]->gender == 'Male') checked="checked" @endif>
                                                                       Male </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="gender" value="Female" @if($students[0]->gender == 'Female') checked="checked" @endif>
                                                                       Female </label>                                             
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('gender') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Blood group <span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="blood_group" value="{{ $students[0]->blood_group}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('blood_group') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Religion<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="religion" value="{{ $students[0]->religion}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('religion') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Caste<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="caste" value="{{ $students[0]->caste}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('caste') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nationality <span class="error">*</span> <span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="nationality" value="{{ $students[0]->nationality}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('nationality') }}
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Domicile<span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="domicile" value="{{ $students[0]->domicile}}" class=" col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('domicile') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Physical Handicapped  <span class="error">*</span> </label>
                                                        <div class="col-md-9">
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="physical_handicapped" value="1" @if($students[0]->physical_handicapped == '1') checked="checked" @endif>
                                                                       Yes </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="physical_handicapped" value="0" @if($students[0]->physical_handicapped == '0') checked="checked" @endif>
                                                                       No </label>   
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('physical_handicapped') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Siblings same Institution <span class="error">*</span> </label>
                                                        <div class="col-md-9">
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="siblings" value="1" @if($students[0]->siblings == '1') checked="checked" @endif>
                                                                       Yes </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="siblings" value="0" @if($students[0]->siblings == '0') checked="checked" @endif>
                                                                       No </label>   
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('siblings') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Identification Mark 1<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="mark_1" value="{{ $students[0]->mark_1}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mark_1') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Identification Mark 2<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="mark_2" value="{{ $students[0]->mark_2}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mark_2') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hobbies /Activities </label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="hobbies" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $students[0]->hobbies }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('hobbies') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>                                     
                                        <div class="col-xs-12">
                                            <legend>Action Permissions</legend>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Student Rights</label>
                                                        <div class="col-md-9">
                                                            <label class="checkbox-inline">
                                                                <input name="add_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" hidden="" name="add_rights" @if($students[0]->add_rights) checked @endif>
                                                                        </label>
                                                            <label class="checkbox-inline">
                                                                <input name="view_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" checked name="view_rights" @if($students[0]->view_rights) checked @endif>                                                           
                                                                       View </label>
                                                            <label class="checkbox-inline">
                                                                <input name="edit_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="edit_rights" @if($students[0]->edit_rights) checked @endif>                         
                                                                       Edit </label>
                                                            <label class="checkbox-inline">
                                                                <input name="delete_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" hidden="" name="delete_rights" @if($students[0]->delete_rights) checked @endif>                                                            
                                                                        </label>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                        </div>

                                        <div class="col-xs-12">
                                            <legend></legend>
                                        </div>
                                        <div class="col-md-offset-4">
                                            <button type="submit" class="width-10 btn btn-md btn-success">
                                                <i class="ace-icon fa fa-check"></i>
                                                <span class="bigger-110">Update student details</span>
                                            </button>
                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                <i class="ace-icon fa fa-times red2"></i>
                                                <span class="bigger-110">Cancel</span>
                                            </button>   
                                            <a href="{{ url('view-students')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                <i class="ace-icon fa fa-undo"></i>
                                                <span class="bigger-110">View student details </span>
                                            </a>
                                        </div><br>

                                    </form>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
<script src="{{ URL::asset('assets/js/jquery.maskinput.min.js') }}"></script>
<script type="text/javascript">
                                                        jQuery(function ($) {
                                                            $.mask.definitions['~'] = '[+-]';
                                                            $('.input-mask-date').mask('99/99/9999');
                                                            $('.input-mask-phone').mask('9999999999');
                                                            $('.input-mask-aadhaar').mask('999999999999');

                                                        });
</script>