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
                        <h2 style="color:whitesmoke;">Add student</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">

                                        <li class="active">
                                            <a href="{{url('add-student')}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li >
                                            <a href="#"> <span class="step">2</span> <span class="title">Parents Information</span> </a>
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
                                    <form class="form-horizontal" action="{{url('do-add-student')}}" enctype="multipart/form-data" method="POST">
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

                                                                <?php foreach ($user_types as $user_type) { ?>
                                                                    <option value="<?php echo $user_type->id; ?>" @if (old('user_type_id') == $user_type->id) selected="selected" @endif><?php echo $user_type->title; ?></option>
                                                                <?php } ?>

                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_type_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="student_type_id" id="student_type_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                                <option value="">--- Select student type ---</option> 
                                                                <?php foreach ($student_types as $student_type) { ?>
                                                                    <option value="<?php echo $student_type->id; ?>" @if(old('student_type_id') == $student_type->id )selected @endif><?php echo $student_type->title; ?></option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('student_type_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="route_id" id="routes"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">                                                                
                                                                <option value="">select when Institute transport selected</option> 
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('route_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Stops<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="stop_id" id="stop_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">                                                               
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('stop_id') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="class_section_id" id="class_section_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                                <option value="">--- select class ---</option> 
                                                                <?php foreach ($class_sections as $class_section) { ?>
                                                                    <option value="{{ $class_section->id }}" @if(old('class_section_id') == $class_section->id )selected @endif>{{ $class_section->classes->class_name }} @if($class_section->section_id > 0) - {{$class_section->sections->section_name}}@endif</option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('class_section_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student ID<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" style="background-color:lightgrey;"  id="form-field-1" readonly="" placeholder="Autometically generates,see in edit" name="unique_id" value="{{ old('unique_id') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('unique_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Admission number <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1"  name="admission_number" value="{{ old('admission_number') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('admission_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Roll number<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="roll_number" value="{{ old('roll_number') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('roll_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Joined date<span class="error">* </span></label>                                               
                                                        <div class="col-sm-9 input">
                                                            <input type="text"  id="example1"  name="joined_date" value="{{ old('joined_date') }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
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
                                                    <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('first_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="middle_name" value="{{old('middle_name')}}" placeholder="Middle name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('middle_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Last name">
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
                                                            <input type="text"  id="example1"  name="date_of_birth" value="{{ old('date_of_birth') }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('date_of_birth') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="" class=""  name="photo" value="{{ old('photo') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('photo') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="contact_number" value="{{ old('contact_number') }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('contact_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Emergency number<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="emergency_number" value="{{ old('emergency_number') }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
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
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="email" value="{{ old('email') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="user_name" value="{{ old('user_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Password<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="password"  id="form-field-1" placeholder="" name="password" value="{{ old('password') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Confirm Password<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="password"  id="form-field-1" placeholder="" name="password_confirmation" value="{{ old('password_confirmation') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('password_confirmation') }}
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
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="aadhaar_number" value="{{ old('aadhaar_number') }}" class="input-mask-aadhaar col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('aadhaar_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father name <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="father_name" value="{{ old('father_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="father_number" value="{{ old('father_number') }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mother name <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="mother_name" value="{{ old('mother_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
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
                                                            <input type="text"  id="form-field-1" placeholder="" name="mother_number" value="{{ old('mother_number') }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Present Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="3" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="present_address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('present_address') }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('present_address') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Permanent Address </label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="permanent_address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('permanent_address') }}</textarea>
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
                                                                <input type="radio" name="gender" value="Male" @if(old('gender') == 'Male') checked="checked" @endif>
                                                                       Male </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="gender" value="Female" @if(old('gender') == 'Female') checked="checked" @endif>
                                                                       Female </label>                                             
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('gender') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Blood group <span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="blood_group" value="{{ old('blood_group') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('blood_group') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Religion<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="religion" value="{{ old('religion') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('religion') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Caste<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="caste" value="{{ old('caste') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('caste') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nationality <span class="error">*</span> <span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="nationality" value="{{ old('nationality') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('nationality') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Domicile<span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="domicile" value="{{ old('domicile') }}" class=" col-xs-10 col-sm-5 col-md-9 col-lg-9" />
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
                                                                <input type="radio" name="physical_handicapped" value="1" @if(old('physical_handicapped') == '1') checked="checked" @endif>
                                                                       Yes </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="physical_handicapped" value="0" @if(old('physical_handicapped') == '0') checked="checked" @endif>
                                                                       No </label>   
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('physical_handicapped') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Siblings same institution <span class="error">*</span> </label>
                                                        <div class="col-md-9">
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="siblings" value="1" @if(old('siblings') == '1') checked="checked" @endif>
                                                                       Yes </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="siblings" value="0" @if(old('siblings') == '0') checked="checked" @endif>
                                                                       No </label>   
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('siblings') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Identification Mark 1<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="mark_1" value="{{ old('mark_1') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mark_1') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Identification Mark 2<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="mark_2" value="{{ old('mark_2') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mark_2') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hobbies /Activities </label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="hobbies" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('hobbies') }}</textarea>
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
                                                                <input type="checkbox" value="1" hidden="" name="add_rights" @if(old('add_rights')) checked @endif>
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input name="view_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" checked name="view_rights" @if(old('view_rights')) checked @endif>                                                           
                                                                       View </label>
                                                            <label class="checkbox-inline">
                                                                <input name="edit_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="edit_rights" @if(old('edit_rights')) checked @endif>                         
                                                                       Edit </label>
                                                            <label class="checkbox-inline">
                                                                <input name="delete_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" hidden="" name="delete_rights" @if(old('delete_rights')) checked @endif>                                                            
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
                                                <span class="bigger-110">Save student details</span>
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
});</script>

<script>
    @if (old('route_id'))
            var student_type_id = {{old('student_type_id')}}; ;
    var route_id = {{old('route_id')}};
    if (student_type_id == '1') {
    $.ajax({
    type: 'GET',
            url: '/student-transport-routes',
            data: {'student_type_id': student_type_id},
            dataType: 'json',
            success: function (data, status) {
            var option = "";
            for (i = 0; i < data.length; i++) {
            if (data[i].id == route_id){
            option += "<option value='" + data[i].id + "'>" + data[i].route_from + ' - ' + data[i].route_to + "</option>";
            }}
            $('#routes').html(option);
            }
    });
    } else {
    $('#routes').html('<option>--Slect student as transport to see routes--</option>');
    }
    @endif

            @if (old('route_id'))
            var route_id = {{old('route_id')}};
    var stop_id = {{old('stop_id')}};
    //alert(route_id);
    $.ajax({
    type: 'GET',
            url: '/student-route-stops',
            data: {'route_id': route_id},
            dataType: 'json',
            success: function (data, status) {
            var option = "";
         
            if (data){
            for (i = 0; i < data.length; i++) {
            if (data[i].id == stop_id){
            option += "<option value='" + data[i].id + "'>" + data[i].stop_name + ' - P : ' + data[i].pickup_time + ' D: ' + data[i].drop_time + "</option>";
            }}}
            $('#stop_id').html(option);
            }
    });
    @endif
</script>
