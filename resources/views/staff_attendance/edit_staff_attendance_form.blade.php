@include('include.header')
<style> #error-message{margin-left:158px;}</style>
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
                <li ><a href="{{url ('view-staff')}}">Staff</a></li>   
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li class="active"><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Edit <b> </b> Attendance</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>                        

                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="row">                               
                                <div class="col-sm-12">                                  
                                    <form class="form-horizontal" action="{{url('get-staff-edit-attendance')}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}                                                                               
                                        <div class="col-sm-12"><br>
                                            @include('include.messages')                                           
                                            <div class="row">
                                                <label class="col-sm-1"></label>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Date</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="">Staff type</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Department</label>                                                 
                                                </div>

                                            </div>
                                            <div class="row" id="dynamicQualification">
                                                <label class="col-sm-1">Select :</label>
                                                <div class="col-sm-2">
                                                    <input type="text" placeholder="Select date" name="attendance_date" value="{{old('attendance_date')}}" class="form-control datepicker">
                                                    <label class=""  title=""  data-original-title="Select Date"></label>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('attendance_date') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="staff_type_id" id="staff_type_id"  class="">
                                                        <option value="">--- Select staff type---</option> 
                                                        <?php foreach ($staff_types as $staff_type) { ?>
                                                            <option value="<?php echo $staff_type->id; ?>" @if(old('staff_type_id') == $staff_type->id )selected @endif><?php echo $staff_type->title; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('staff_type_id') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="staff_department_id" id="staff_department_id"  class="">
                                                        <option value="">--- select department---</option> 
                                                    </select> 
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('staff_department_id') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get staff</span>
                                                    </button>
                                                </div>
                                            </div>    
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
