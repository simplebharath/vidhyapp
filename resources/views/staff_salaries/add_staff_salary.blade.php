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
                <li ><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li class="active"><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add staff salary</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-salaries')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-add-staff-salary')}}">
                                            {{ csrf_field() }} 
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
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Staff<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select  name="staff_id" id="staff_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value=""> ---select staff--- </option> 

                                                    </select> 
                                                </div>     
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Total salary<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly=""  id="total_salary" placeholder="" name="total_salary" value="{{old('total_salary')}}"  class="col-xs-10 col-sm-5 col-lg-9 col-mg-9" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('total_salary') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Month<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select   name="month_id" id="month_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value="">-- select month --</option>       
                                                        
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('month_id') }}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Working days<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly=""  id="working_days" placeholder="" name="working_days" value="{{old('working_days')}}"  class="col-xs-10 col-sm-5 col-lg-9 col-mg-9" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('working_days') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Deducted salary<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly=""  id="deducted_salary" placeholder="" name="deducted_salary" value="{{old('deducted_salary')}}"  class="col-xs-10 col-sm-5 col-lg-9 col-mg-9" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('deducted_salary') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Net salary<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly=""  id="gross_salary" placeholder="" name="gross_salary" value="{{old('gross_salary')}}"  class="col-xs-10 col-sm-5 col-lg-9 col-mg-9" />
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('gross_salary') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                <div class="col-sm-9">
                                                    <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" placeholder="" name="remark" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ old('remark') }}</textarea>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('remark') }}
                                                </div>
                                            </div>
                                            <div style="margin-left:35%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-staff-salaries')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View staff salary</span>
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