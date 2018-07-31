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
                        <h2 style="color:whitesmoke;">Add staff</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">

                                        <li class="active">
                                            <a href="{{url('add-staff')}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li >
                                            <a href="#"> <span class="step">2</span> <span class="title">Educational Qualifications</span> </a>
                                        </li>
                                        <li >
                                            <a href="#"> <span class="step">3</span> <span class="title">Experience</span> </a>
                                        </li>
                                        <li >
                                            <a href="#"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div><br>
                                <div class="col-sm-12">
                                    <form class="form-horizontal" action="{{url('do-add-staff')}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div class="col-xs-12">
                                            <legend>Employment info</legend>
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
                                                                <option value=""> --- select user type --- </option> 
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
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Staff type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select  name="staff_type_id" id="staff_type_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                                <option value="">--- Select staff type---</option> 
                                                                <?php foreach ($staff_types as $staff_type) { ?>
                                                                    <option value="<?php echo $staff_type->id; ?>" @if(old('staff_type_id') == $staff_type->id )selected @endif><?php echo $staff_type->title; ?></option>
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
                                                                <option value="">--- first select staff type---</option> 

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
                                                            <input type="text"  id="form-field-1" placeholder="" name="emp_designation" value="{{ old('emp_designation') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('emp_designation') }}
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

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Experience <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1"  name="experience" value="{{ old('experience') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('experience') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Employee id<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="employee_id" value="{{ old('employee_id') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('employee_id') }}
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
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Emergency number<span class="error">*</span></label>
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
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error">* </span></label>
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
                                                    <input type="number" class="form-control" name="basic_salary" onblur="findTotal()" id="basic_salary" value="{{old('basic_salary')}}"  placeholder="Basic salary">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('basic_salary') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="incentives" onblur="findTotal()" id="incentives" value="0" placeholder="Incentives">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('incentives') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="other_salary" onblur="findTotal()" id="other_salary" value="0" placeholder="Other">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('other_salary') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="salary_cuttings" onblur="findTotal()" id="salary_cuttings" value="0" placeholder="Cuttings">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('salary_cuttings') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control" name="total_salary" id="total_salary" value="{{old('total_salary')}}" placeholder="Total salary">
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
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="aadhaar_number" value="{{ old('aadhaar_number') }}" class="input-mask-aadhaar col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('aadhaar_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father/Guardian <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="father_name" value="{{ old('father_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile number<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="father_number" value="{{ old('father_number') }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
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

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Marital status  <span class="error">*</span> </label>
                                                        <div class="col-md-9">
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="marital_status" value="Married" @if(old('marital_status') == 'Married') checked="checked" @endif>
                                                                       Married </label>
                                                            <label class="radio radio-inline">
                                                                <input type="radio" name="marital_status" value="Single" @if(old('marital_status') == 'Single') checked="checked" @endif>
                                                                       Unmarried </label>   
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('marital_status') }}
                                                            </p>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Spouse/Husband<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="spouse_name" value="{{ old('spouse_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('spouse_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Occupation<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="occupation" value="{{ old('occupation') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('occupation') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">No. of children<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" id="form-field-1" placeholder="" name="child_number" value="{{ old('child_number') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('child_number') }}
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
                                                                <input type="checkbox" value="1" checked name="add_rights" @if(old('add_rights')) checked @endif>
                                                                       Add </label>
                                                            <label class="checkbox-inline">
                                                                <input name="view_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" checked name="view_rights" @if(old('view_rights')) checked @endif>                                                           
                                                                       View </label>
                                                            <label class="checkbox-inline">
                                                                <input name="edit_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" checked name="edit_rights" @if(old('edit_rights')) checked @endif>                         
                                                                       Edit </label>
                                                            <label class="checkbox-inline">
                                                                <input name="delete_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" checked name="delete_rights" @if(old('delete_rights')) checked @endif>                                                            
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
                                                <span class="bigger-110">Save staff details</span>
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

<script>
   
    @if (old('staff_type_id'))
        var staff_type_id = {{old('staff_type_id')}};
        var staff_department_id = {{old('staff_department_id')}};
        console.log(staff_type_id);
        $.ajax({
            type: 'GET',
            url: '/get-department',
            data: {'staff_type_id': staff_type_id},
            dataType: 'json',
            success: function (data, status) {
                var option = "";
             
                for (i = 0; i < data.length; i++) {
                    if(data[i].id==staff_department_id){
                    option += "<option value='" + data[i].id + "'>" + data[i].title + "</option>";
                }}
                $('#staff_department_id').html(option);
            }
        });
 @endif
</script>