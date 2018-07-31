@include('include.header')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@include('include.navigationbar')
<script type="text/javascript">
 $(document).ready(function () {
        $('#state').on('change', function () {
            //var data1 = document.getElementById("cid").value;
           var data1 = $('#state').val();
            console.log(data1);
            $.ajax({
                type: 'GET',
                url: '/getcity',
                data: {'data1': data1},
                dataType: 'json',
                success: function (data, status) {
                    var option = "";
                    option += "<option value=''>--Select City--</option>";
                    for (i = 0; i < data.length; i++) {
                        option += "<option value='" + data[i].city_id + "'>" + data[i].city_name + "</option>";
                    }
                    $('#city').html(option);
                }
            });
        });
    });
</script>
<!-- MAIN PANEL -->
<div id="main" role="main" >

    <!-- RIBBON -->
    <div id="ribbon">

         <!-- breadcrumb col-md-3 -->
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
        <!-- end row -->
        <div class="row">

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-university"></i> </span>
                        <h2>Institution Details</h2><span ><a href="{{url ('view_institution_details')}}" class="btn btn-success pull-right" >View</a></span>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('add_institution_details') }}">
                                        {{ csrf_field() }}
                                        <fieldset>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Name<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="institution_name" value="{{ old('institution_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('institution_name') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Email<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="email"  id="form-field-1" placeholder="" name="institution_email" value="{{ old('institution_email') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('institution_email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="registration_number" value="{{ old('registration_number') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('registration_number') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number1<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="office_contact_number1" value="{{ old('office_contact_number1') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('office_contact_number1') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number2</label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="office_contact_number2" value="{{ old('office_contact_number2') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('office_contact_number2') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Academic Year<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="academic_year" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>
                                                            <option value="">Select Academic Year</option> 
                                                            <?php foreach ($years as $year) { ?>
                                                            <option value="<?php echo $year->academic_year_id; ?>"><?php echo $year->from_date."-".$year->to_date; ?></option>
                                                             <?php } ?>

                                                        </select> 
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('academic_year') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Logo<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="file"  id="form-field-1"  name="institution_logo" value="{{ old('institution_logo') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('institution_logo') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Institution Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file"  id="form-field-1"  name="institution_image" value="{{ old('institution_image') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('institution_image') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">State<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="state" id="state" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>
                                                            <option value="">Select State</option> 
                                                           <?php foreach ($states as $state) { ?>
                                                            <option value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?></option>
                                                             <?php } ?>
                                                        </select> 
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('state') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">City<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <select   name="city" id="city" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required></select>
                                                       </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('city') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <textarea cols="40" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required>{{ old('address') }}</textarea>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('address') }}
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                                
<!--                                                <h5 style="font-weight:400;">Contact Person1:</h5>-->
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tagline<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="cp1_name" value="{{ old('cp1_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9"/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp1_name') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Youtube Channel Id<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="cp1_email" value="{{ old('cp1_email') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp1_email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Established In<span class="error"> </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="cp1_phone1" value="{{ old('cp1_phone1') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp1_phone1') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Affiliated By</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="cp1_phone2" value="{{ old('cp1_phone2') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp1_phone2') }}
                                                    </div>
                                                </div>
                                                <h5 style="font-weight:400;">Contact Person :</h5>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  id="form-field-1" placeholder="" name="cp2_name" value="{{ old('cp2_name') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp2_name') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="email"  id="form-field-1" placeholder="" name="cp2_email" value="{{ old('cp2_email') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp2_email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number1<span class="error">* </span></label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="cp2_phone1" value="{{ old('cp2_phone1') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" required/>
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp1_phone2') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number2</label>
                                                    <div class="col-sm-9">
                                                        <input type="number"  id="form-field-1" placeholder="" name="cp2_phone2" value="{{ old('cp2_phone2') }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                    </div>
                                                    <div style="color: red;">
                                                        {{ $errors->first('cp2_phone2') }}
                                                    </div>
                                                </div>
                                                </div>
                                            
                                        <div class="form-group">
                                            <div class="col-md-offset-6 col-md-9 col-lg-6 col-sm-12" >
                                                <button class="btn btn-info" type="submit" name="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Save
                                                </button><div class="col-md-offset-1 col-md-9 col-lg-1 col-sm-1"></div>
                                                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1"></div>
                                                <button class="btn btn-info" type="reset">
                                                    <i class="fa fa-times bigger-110"></i>
                                                    Cancel
                                                </button>
                                            </div></div>
                                        
                                        </fieldset>    
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
</div>
<!-- END MAIN PANEL -->
@include('include.footer')
