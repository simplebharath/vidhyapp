@include('include.header')
<style> #error-message{margin-left:158px;}</style>
<script>
    function findTotal() {
        x = 0, y = 0, z = 0, a = 0;
        var x = parseInt(document.getElementById("basic_salary").value);
        var y = parseInt(document.getElementById("other_salary").value);
        var z = parseInt(document.getElementById("incentives").value);
        var a = parseInt(document.getElementById("salary_cuttings").value);

        document.getElementById('total_salary').value = (x + y + z - a);
    }
</script>

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
                <li ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li>   
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Edit staff</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View staff</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add staff</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-profile/'.$staff[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View staff profile</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">

                                        <li class="active">
                                            <a href="{{url('edit-staff/'.$staff[0]->id)}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-staff-qualification/'.$staff[0]->id)}}"> <span class="step">2</span> <span class="title">Educational Qualifications</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-staff-experience/'.$staff[0]->id)}}"> <span class="step">3</span> <span class="title">Experience</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-staff-document/'.$staff[0]->id)}}"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div><br>
                                <div class="col-sm-12">
                                    <form class="form-horizontal" action="{{url('do-edit-staff/'.$staff[0]->id)}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div class="col-xs-12">
                                            <legend>Employment info</legend>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Academic year<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select readonly name="academic_year_id" id="academic_year_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" > 
                                                                 <?php foreach ($years as $year) { ?>
                                                                <option value="{{$staff[0]->academic_year_id}}" @if($staff[0]->academic_year_id == $year->id) selected="selected" @endif>{{$year->from_year}} - {{$year->to_year}} </option>  
                                                                 <?php } ?>
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
                                                           
                                                                    <option value="<?php echo $staff[0]->user_type_id ?>" ><?php echo$staff[0]->user_types->title; ?></option>
                                                              
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_type_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Staff type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="staff_type_id" id="staff_type_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">

                                                                <?php foreach ($staff_types as $staff_type) { ?>
                                                                    <option value="<?php echo $staff_type->id; ?>" @if($staff[0]->staff_type_id == $staff_type->id )selected @endif><?php echo $staff_type->title; ?></option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('staff_type_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="staff_department_id" id="staff_department_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">

                                                                <?php foreach ($staff_departments as $staff_department) { ?>
                                                                    <option value="<?php echo $staff_department->id; ?>" @if($staff[0]->staff_department_id == $staff_department->id )selected @endif><?php echo $staff_department->title; ?></option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('staff_department_id') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Designation<span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="emp_designation" value="{{  $staff[0]->emp_designation }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('emp_designation') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Joined date<span class="error">* </span></label>                                               
                                                        <div class="col-sm-9 input">
                                                            <input type="text"  id="example1"  name="joined_date" value="{{  $staff[0]->joined_date }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('joined_date') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Experience <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1"  name="experience" value="{{  $staff[0]->experience }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('experience') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Staff id<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" readonly="" style="background-color:lightgrey" name="staff_unique_id" value="{{  $staff[0]->staff_unique_id }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('staff_unique_id') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-xs-12">
                                            <legend>Personal info</legend>
                                            <div class="row">

                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Staff name<span class="error">* </span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="first_name" value="{{ $staff[0]->first_name}}" placeholder="First name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('first_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="middle_name" value="{{ $staff[0]->middle_name}}" placeholder="Middle name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('middle_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="last_name" value="{{ $staff[0]->last_name}}" placeholder="Last name">
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
                                                            <input type="text"  id="example1"  name="date_of_birth" value="{{  $staff[0]->date_of_birth }}" data-provide="datepicker" class="date col-xs-10 col-sm-5 col-lg-9 col-mg-9"/>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('date_of_birth') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="contact_number" value="{{  $staff[0]->contact_number }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('contact_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Emergency number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="emergency_number" value="{{  $staff[0]->emergency_number }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('emergency_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="email" value="{{  $staff[0]->email }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="" class=""  name="photo" value="{{  $staff[0]->photo }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('photo') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"></span></label>                                                    
                                                        <div class="col-sm-4">
                                                            <img src="{{URL::asset('uploads/staff/'.$staff[0]->photo)}}" width="150" height="120" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-sm-12">
                                            <legend>Salary Details</legend>
                                            <div class="row">
                                                <label class="col-sm-2"></label>
                                                <label class="col-sm-2">Basic salary  <span style="color:red;">*</span></label>
                                                <label class="col-sm-2">Incentives (+)</label>
                                                <label class="col-sm-2">Other benefits (+)</label>
                                                <label class="col-sm-2">Salary Cutting (-)</label>
                                                <label class="col-sm-2">Total Salary <span style="color:red;">*</span></label>

                                            </div>
                                            <div class="row">
                                                <label class="col-sm-2">Salary :</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="basic_salary" onblur="findTotal()" id="basic_salary" value="{{ $staff[0]->basic_salary}}"  placeholder="Basic salary">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('basic_salary') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="incentives" onblur="findTotal()" id="incentives" value="{{ $staff[0]->incentives}}" placeholder="Incentives">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('incentives') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="other_salary" onblur="findTotal()" id="other_salary" value="{{ $staff[0]->other_salary}}" placeholder="Other">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('other_salary') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="salary_cuttings" onblur="findTotal()" id="salary_cuttings" value="{{ $staff[0]->salary_cuttings}}" placeholder="Cuttings">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('salary_cuttings') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="total_salary" id="total_salary" value="{{ $staff[0]->total_salary}}" placeholder="Total salary">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('total_salary') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12"><br>
                                            <legend>Contact info</legend>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Aadhaar number </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="aadhaar_number" value="{{  $staff[0]->aadhaar_number }}" class="input-mask-aadhaar col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('aadhaar_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father/Guardian <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="father_name" value="{{  $staff[0]->father_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile number<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="father_number" value="{{  $staff[0]->father_number }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_number') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Present Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="3" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="present_address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $staff[0]->present_address }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('present_address') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Permanent Address </label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="permanent_address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $staff[0]->permanent_address }}</textarea>
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
                                                                <input type="radio" name="gender" value="Male" @if($staff[0]->gender == 'Male') checked="checked" @endif>
                                                                       Male </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="gender" value="Female" @if($staff[0]->gender == 'Female') checked="checked" @endif>
                                                                       Female </label>                                             
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('gender') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Blood group <span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="blood_group" value="{{  $staff[0]->blood_group }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('blood_group') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Religion<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="religion" value="{{  $staff[0]->religion }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('religion') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Caste<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="caste" value="{{  $staff[0]->caste }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('caste') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nationality <span class="error">*</span> <span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="nationality" value="{{  $staff[0]->nationality }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('nationality') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Marital status  <span class="error">*</span> </label>
                                                        <div class="col-md-9">
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="marital_status" value="Married" @if($staff[0]->marital_status == 'Married') checked="checked" @endif>
                                                                       Married </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="marital_status" value="Single" @if($staff[0]->marital_status == 'Single') checked="checked" @endif>
                                                                       Unmarried </label>   
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('marital_status') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Spouse/Husband<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="spouse_name" value="{{  $staff[0]->spouse_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('spouse_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Occupation<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="occupation" value="{{  $staff[0]->occupation }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('occupation') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. of children<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="child_number" value="{{  $staff[0]->child_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('child_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Domicile<span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="domicile" value="{{  $staff[0]->domicile }}" class=" col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('domicile') }}
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
                                                        <label class="col-md-3 control-label">Staff Rights</label>
                                                        <div class="col-md-9">
                                                            <label class="checkbox-inline">
                                                                <input name="add_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="add_rights" @if($staff[0]->add_rights) checked @endif>
                                                                       Add </label>
                                                            <label class="checkbox-inline">
                                                                <input name="view_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="view_rights" @if($staff[0]->view_rights) checked @endif>                                                           
                                                                       View </label>
                                                            <label class="checkbox-inline">
                                                                <input name="edit_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="edit_rights" @if($staff[0]->edit_rights) checked @endif>                         
                                                                       Edit </label>
                                                            <label class="checkbox-inline">
                                                                <input name="delete_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="delete_rights" @if($staff[0]->delete_rights) checked @endif>                                                            
                                                                       Delete </label>
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
                                                <span class="bigger-110">Update staff details</span>
                                            </button>
                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                <i class="ace-icon fa fa-times red2"></i>
                                                <span class="bigger-110">Cancel</span>
                                            </button>   
                                            <a href="{{ url('view-staff')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                <i class="ace-icon fa fa-undo"></i>
                                                <span class="bigger-110">View staff details </span>
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