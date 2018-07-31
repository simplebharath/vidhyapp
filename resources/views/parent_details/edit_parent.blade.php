@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Parents</li>
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
            @include('include.messages')
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Edit parent</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-parents')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View Parents</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View students</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">
                                        <li class="active">
                                            <a href="{{url('edit-student/'.$parents[0]->student_id)}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{url('edit-parent/'.$parents[0]->id)}}"> <span class="step">2</span> <span class="title">Parent Information</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-student-education/'.$parents[0]->student_id)}}"> <span class="step">3</span> <span class="title">Previous Institution</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-student-document/'.$parents[0]->student_id)}}"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div><br>
                                <div class="col-sm-12">
                                    <form class="form-horizontal" action="{{url('do-edit-parent/'.$parents[0]->id)}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <div class="col-xs-12">
                                            <legend>Basic info</legend>
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
                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select   name="user_type_id" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >                                                                                                   
                                                                <option value="{{$user_types[0]->id}}">{{$user_types[0]->title}}</option>                                                              
                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_type_id') }}
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-xs-12">
                                            <legend>Student info</legend>
                                            <div class="row">
                                                <label class="col-sm-2 control-label no-padding-right"></label>
                                                <div class="col-sm-3">
                                                    <label col-sm-5>Admission type - Student id</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label col-sm-5>Full Name</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label col-sm-2>Class - Roll number - Admission number</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Student details<span class="error">* </span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="e" readonly="" value="{{$parents[0]->students->student_types->title}} - (  {{$parents[0]->students->unique_id}} )" placeholder="First name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('first_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="" readonly="" value="{{$parents[0]->students->first_name}} {{$parents[0]->students->last_name}}" placeholder="Middle name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('middle_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select  class="form-control" name="" readonly="">
                                                        <option  value=""> {{$parents[0]->students->classes->class_name}} @if($parents[0]->students->section_id > 0) - {{$parents[0]->students->sections->section_name}} @endif  - {{$parents[0]->students->roll_number}} - {{$parents[0]->students->admission_number}}  </option>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('last_name') }}
                                                    </p>
                                                </div>                
                                            </div>

                                            <legend>Parents info</legend>
                                            <article class="col-xs-6">
                                                <fieldset>                                                
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father name <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" readonly="" style="background-color:lightgrey;" id="form-field-1" placeholder="" name="father_name" value="{{ $parents[0]->students->father_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact number<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" readonly="" style="background-color:lightgrey;" placeholder="" name="father_number" value="{{ $parents[0]->students->father_number }}" class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father Email<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="father_email" value="{{ $parents[0]->father_email }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_email') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Qualification <span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder=""  id="form-field-1" placeholder="" name="father_education" value="{{ $parents[0]->father_education }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_education') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Occupation<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder=""  id="form-field-1" placeholder="" name="father_occupation" value="{{ $parents[0]->father_occupation }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('father_occupation') }}
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Annual Income<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1"  placeholder="" name="family_income" value="{{ $parents[0]->family_income }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('family_income') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="" class=""  name="father_photo" value="{{ $parents[0]->father_photo }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('father_photo') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"></span></label>                                                    
                                                        <div class="col-sm-4">
                                                            <img src="{{URL::asset('uploads/students/father/'.$parents[0]->father_photo)}}" width="150" height="100" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/father.png') }}'">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <hr>
                                        <div class="col-xs-12"><br>
                                            <legend></legend>
                                            <article class="col-xs-6">
                                                <fieldset >

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mother name <span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder="" readonly="" style="background-color:lightgrey;" id="form-field-1" placeholder="" name="mother_name" value="{{ $parents[0]->students->mother_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact number<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" readonly="" style="background-color:lightgrey;"  placeholder="" name="mother_number" value="{{ $parents[0]->students->mother_number }}" readonly class="input-mask-phone col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_number') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mother Email<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1"  placeholder="" name="mother_email" value="{{ $parents[0]->mother_email }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_email') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Qualification <span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder=""  id="form-field-1" placeholder="" name="mother_education" value="{{ $parents[0]->mother_education }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_education') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Occupation<span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" placeholder=""  id="form-field-1" placeholder="" name="mother_occupation" value="{{ $parents[0]->mother_occupation }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('mother_occupation') }}
                                                        </div>
                                                    </div>


                                                </fieldset>
                                            </article>
                                            <article class="col-xs-6">
                                                <fieldset >

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="40" rows="3" maxlength="160" readonly="" style="background-color:lightgrey;" wrap="soft" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $parents[0]->students->present_address }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('address') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Photo<span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="" class=""  name="mother_photo" value="{{ $parents[0]->mother_photo }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('mother_photo') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"></span></label>                                                    
                                                        <div class="col-sm-4">
                                                            <img src="{{URL::asset('uploads/students/mother/'.$parents[0]->mother_photo)}}" width="150" height="100" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/mother.png') }}'">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </article>
                                        </div>
                                        <div class="col-xs-12">
                                            <legend></legend>
                                        </div>
                                        <div class="col-md-offset-4">
                                            <button type="submit" class="width-10 btn btn-md btn-success">
                                                <i class="ace-icon fa fa-check"></i>
                                                <span class="bigger-110">Update parent details</span>
                                            </button>
                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                <i class="ace-icon fa fa-times red2"></i>
                                                <span class="bigger-110">Cancel</span>
                                            </button>   
                                            <a href="{{ url('view-parents')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                <i class="ace-icon fa fa-undo"></i>
                                                <span class="bigger-110">View Parent details </span>
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