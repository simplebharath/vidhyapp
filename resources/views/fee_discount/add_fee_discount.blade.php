@include('include.header')
@include('include.navigationbar')
<style> #error-message{margin-left:200px;}</style>
<div id="main" role="main" >
    <div id="ribbon">
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
                <li ><a href="{{url ('view-students-attendance')}}">Attendance</a></li>

            </ul>
        </div><br>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <ul class="nav nav-tabs pull-left">
                    <li><a href="{{url ('view-student-profile/'.$students[0]->id)}}">Profile</a></li>
                    <li><a href="{{url ('view-student-timetable/'.$students[0]->id.'/'.$students[0]->class_section_id)}}">Timetable</a></li>
                    <li ><a href="{{url ('view-student-documents/'.$students[0]->id)}}">Documents</a></li>
                    <li ><a href="{{url ('view-student-attendance/'.$students[0]->id)}}">Attendance</a></li>
                    <li ><a href="{{url ('view-student-fees/'.$students[0]->id)}}">Fees</a></li>
                    <li class="active"><a href="{{url ('view-fee-discounts/'.$students[0]->id)}}">Fee Discounts</a></li>
                    <li><a href="{{url ('view-student-payment-history/'.$students[0]->id)}}">Payments</a></li>
                    <li ><a href="{{url ('view-student-assignments/'.$students[0]->id)}}">Assignments</a></li>
                    <li><a href="{{url ('view-student-remarks/'.$students[0]->id)}}">Remarks</a></li>
                    <li><a href="{{url ('view-student-exams/'.$students[0]->id)}}">Marks</a></li>
                    @if($students[0]->student_type_id == 1)
                    <li><a href="{{url ('view-student-transport/'.$students[0]->route_id.'/'.$students[0]->stop_id.'/'.$students[0]->id)}}">Transport</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            @include('student_profile.include_profile')
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">

                                <header>
                                    <span class="widget-icon"> <i class="fa fa-plus"></i> </span>
                                    <h2> Add fee discount </h2>                                    
                                    <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-fee-discounts/'.$students[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i>  View </a>
                                </header>		
                                <div><br>
                                    <div class="widget-body no-padding">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <form  class="form-horizontal" role="form" method="POST" action="{{ url('do-add-fee-discount/'.$students[0]->id) }}">
                                                        {{ csrf_field() }}       
                                                        <input hidden="" name="class_section_id" id="student_class" value="{{$students[0]->class_section_id}}">
                                                        <input hidden="" name="student_id" id="student_ids" value="{{$students[0]->id}}">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Title<span class="error">* </span></label>
                                                            <div class="col-sm-9">
                                                                <select  name="fee_id" id="fee_discount_id"  class="col-xs-10 col-sm-5 col-md-8 col-lg-8">
                                                                    <option value="">--- select fee ---</option> 
                                                                    <?php foreach ($fees as $fee) { ?>
                                                                        <option value="<?php echo $fee->id; ?>" @if(old('fee_id') == $fee->id )selected @endif><?php echo $fee->fee_title; ?></option>
                                                                    <?php } ?>
                                                                </select> 
                                                            </div>

                                                            <div style="color: red;" id="error-message">
                                                                {{ $errors->first('fee_id') }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fees<span class="error">* </span></label>
                                                            <div class="col-sm-9">
                                                                <input type="text"  id="fee_types" disabled="" placeholder="" name="title" value="" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Total <span class="error">* </span></label>
                                                            <div class="col-sm-9">
                                                                <input type="text"  id="total_amount" disabled="" placeholder="" name="title" value="" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Discount <span class="error">* </span></label>
                                                            <div class="col-sm-9">
                                                                <input type="number"  id="form-field-1" placeholder="" name="discount" value="{{old('discount')}}" class="col-xs-10 col-sm-5 col-lg-8 col-mg-8" />
                                                            </div>
                                                            <div style="color: red;" id="error-message">
                                                                {{ $errors->first('discount') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-offset-5">
                                                            <button type="submit" class="width-10 btn btn-md btn-success">
                                                                <i class="ace-icon fa fa-check"></i>
                                                                <span class="bigger-110">Save</span>
                                                            </button>
                                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                                <i class="ace-icon fa fa-times red2"></i>
                                                                <span class="bigger-110">Cancel</span>
                                                            </button>   
                                                            
                                                        </div><br>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@include('include.footer')
