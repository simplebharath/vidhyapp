@include('include.header')
<style> #error-message{margin-left: 160px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li class="active"><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                <li  ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li ><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li ><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-university"></i> </span>
                        <h2>Edit Institution Details</h2>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('do-edit-institution-details/'.$institution[0]->id) }}">
                                        {{ csrf_field() }}
                                        <fieldset>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Name<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="institution_name" value="{{$institution[0]->institution_name}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('institution_name') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Email<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="email"  id="form-field-1" placeholder="" name="institution_email" value="{{$institution[0]->institution_email}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('institution_email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="registration_number" value="{{$institution[0]->registration_number}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('registration_number') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number1<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="office_contact_number1" value="{{$institution[0]->office_contact_number1}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('office_contact_number1') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number2</label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="office_contact_number2" value="{{$institution[0]->office_contact_number2}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('office_contact_number2') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Academic Year<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="academic_year_id" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                            <option value="{{$years[0]->id}}">{{$years[0]->from_year}} - {{$years[0]->to_year}}</option>                                                    
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('academic_year_id') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee type<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="fee_type_id" id="fee_type_id" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                            <option value="">--- select fee type ---</option> 
                                                            <?php foreach ($fee_types as $fee_type) { ?>
                                                                <option value="{{$fee_type->id}}" @if($fee_type->id == $institution[0]->fee_type_id ) selected @endif>{{$fee_type->fee_name}}</option>
                                                            <?php } ?>
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('fee_type_id') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Attendance type<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="attendance_type_id" id="fee_type_id" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                            <option value="">--- select fee type ---</option> 
                                                            <?php foreach ($attendance_types as $attendance_type) { ?>
                                                                <option value="{{$attendance_type->id}}" @if($attendance_type->id == $institution[0]->attendance_type_id ) selected @endif>{{$attendance_type->title}}</option>
                                                            <?php } ?>
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('attendance_type_id') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Logo<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="file"  id="form-field-1"  name="institution_logo" value="{{$institution[0]->institution_logo}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('institution_logo') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
                                                    <div class="col-sm-9">
                                                        <img src="{{URL::asset('uploads/logo/'.$institution[0]->institution_logo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/900-without.png') }}'" height="30" width="30" class="img-rounded img-responsive" alt="VidhyApp" "> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file"  id="form-field-1"  name="institution_image" value="{{$institution[0]->institution_image}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('institution_image') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
                                                    <div class="col-sm-9">
                                                        <img src="{{URL::asset('uploads/logo/'.$institution[0]->institution_image)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/900.png') }}'" height="30" width="30" class="img-rounded img-responsive" alt="VidhyApp" "> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                       
                                                    </div>
                                                </div>
                                                <div class="form-group form-inline" style="padding-left:20px;">
                                                        <div class="inline-group col-sm-12" class="form-inline">
                                                            <label> Working days  </label>
                                                            <label class="checkbox" style="padding:5px;">
                                                                <input name="mon" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="mon" @if($institution[0]->mon == 1) checked @endif>
                                                                       Mon</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="tue" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="tue" @if($institution[0]->tue == 1) checked @endif>
                                                                       Tue</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="wed" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="wed" @if($institution[0]->wed == 1) checked @endif>
                                                                       Wed</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="thus" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="thus" @if($institution[0]->thus == 1) checked @endif>
                                                                       Thus</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="fri" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="fri" @if($institution[0]->fri == 1) checked @endif>
                                                                       Fri</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="sat" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="sat" @if($institution[0]->sat == 1) checked @endif>
                                                                       Sat</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="sun" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="sun" @if($institution[0]->sun == 1) checked @endif>
                                                                       Sun</label>
                                                        </div>
                                                    <p style="color:blue;"><b> Note : </b>Please Check the boxes,to select working days of institution.</p>
                                                    </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">State<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="state_id" id="state" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                            <option value="">--- select state ---</option> 
                                                            <?php foreach ($states as $state) { ?>
                                                                <option value="<?php echo $state->id; ?>" @if($state->id == $institution[0]->state_id ) selected @endif ><?php echo $state->state_name; ?></option>

                                                            <?php } ?>
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('state_id') }}
                                                    </div>
                                                </div>        
                                               
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">City<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="city_id" id="" class="col-xs-10 col-sm-5 col-md-9 col-lg-9">
                                                           
                                                            <?php foreach ($cities as $city) { ?>
                                                                <option value="<?php echo $city->id; ?>" @if($city->id == $institution[0]->city_id ) selected @endif ><?php echo $city->city_name; ?></option>

                                                            <?php } ?>
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('city_id') }}
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea cols="40" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{$institution[0]->address}}</textarea>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('address') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tagline<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="tag_line" value="{{$institution[0]->tag_line}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('tag_line') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Youtube Channel Id<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="youtube_channel" value="{{$institution[0]->youtube_channel}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('youtube_channel') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Established In<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="established_in" value="{{$institution[0]->established_in}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('established_in') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Affiliated By</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="affliated_by" value="{{$institution[0]->affliated_by}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('affliated_by') }}
                                                    </div>
                                                </div>
                                                <h5 style="font-weight:400;">Contact Person :</h5>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="cp2_name" value="{{$institution[0]->cp2_name}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('cp2_name') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="email"  id="form-field-1" placeholder="" name="cp2_email" value="{{$institution[0]->cp2_email}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('cp2_email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number1<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="cp2_phone1" value="{{$institution[0]->cp2_phone1}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('affliated_by') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number2</label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="cp2_phone2" value="{{$institution[0]->cp2_phone2}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;" id="error-message">
                                                        {{ $errors->first('cp2_phone2') }}
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </fieldset>  
                                        <div style="margin-left:40%">
                                            <button type="submit" class="width-10 btn btn-md btn-success">
                                                <i class="ace-icon fa fa-check"></i>
                                                <span class="bigger-110">Update</span>
                                            </button>
                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                <i class="ace-icon fa fa-times red2"></i>
                                                <span class="bigger-110">Cancel</span>
                                            </button>   
                                            <a href="{{ url('view-institution-details')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                <i class="ace-icon fa fa-undo"></i>
                                                <span class="bigger-110">View institution details</span>
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
    </div>
</div>

@include('include.footer')
