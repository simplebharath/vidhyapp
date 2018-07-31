@include('include.header')
<style> #error-message{margin-left: 255px;}</style>
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
                <li  ><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li ><a href="{{url ('view-staff')}}">Staff</a></li> 
                <li class="active"><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Edit Staff-subject</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-subjects')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-edit-staff-subject/'.$staff_subjects[0]->id)}}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Staff type<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="staff_type_id" id="staff_type_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9">                                                           
                                                        <option value="{{$staff_subjects[0]->staff_type_id}}" >{{$staff_subjects[0]->staff_types->title}}</option>                                        
                                                    </select> 

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
                                                        <option value="{{$staff_subjects[0]->staff_department_id}}" >{{$staff_subjects[0]->staff_department->title}}</option> 
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_department_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Staff<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="staff_id" id="staff_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >                                                       
                                                        <option value="{{$staff_subjects[0]->staff_id}}" >{{$staff_subjects[0]->Staff->first_name}} {{$staff_subjects[0]->Staff->first_name}} ( {{ $staff_subjects[0]->Staff->employee_id }} )</option>                                        
                                                    </select> 
                                                </div>     
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select   name="class_section_id" id="class_section_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >    
                                                        <option value="{{$staff_subjects[0]->class_section_id}}" >{{ $staff_subjects[0]->classes->class_name }}  @if(($staff_subjects[0]->section_id) != 0)  -  {{ $staff_subjects[0]->sections->section_name}}  @endif </option>    
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('class_section_id') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Subject <span class="error">* </span> </label>
                                                <div class="col-sm-9">
                                                    <select class="col-xs-10 col-sm-5 col-md-9 col-lg-9"  name="subject_id" id="subject_id" >  
                                                        <?php foreach ($subjects as $subject) { ?>
                                                            <option value="{{$subject->id}}" @if(($subject->id)==($staff_subjects[0]->subject_id))selected @endif>{{$subject->subject_name}}</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('subject_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"></span></label>                                               
                                                <div class="col-sm-7 input">
                                                    <textarea class="form-control" name="description" placeholder="" rows="" cols="2" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">{{$staff_subjects[0]->description}}</textarea>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            </div>
                                            <div style="margin-left:35%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-staff-subjects')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View staff subjects</span>
                                                </a>
                                            </div><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <div class="col-xs-1 col-sm-1 col-md-6 col-lg-6"></div>
        </div>
    </div>
</div>
@include('include.footer')