@include('include.header')
<style> #error-message{margin-left: 260px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Migration</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('classes-migration')}}">Migrate Classes</a></li>
                <li class="active"><a href="{{url ('students-migration')}}">Migrate Students</a></li>               
                 <li><a href="{{url ('view-migrated-classes')}}">Migrated Students</a></li>
                 <li><a href="{{url ('migrate-timings')}}">Migrate Timings</a></li>
                 <li><a href="{{url ('class-schedule-migration')}}">Class schedule</a></li>
                 <li><a href="{{url ('staff-migration')}}">Migrate Staff</a></li>
                 <li><a href="{{url ('class-fee-migration')}}">Migrate Class-fee</a></li>
                 <li><a href="{{url ('transport-fee-migration')}}">Migrate Transport Fee</a></li>
            </ul>
        </div><br>
        <div class="row">          
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Migrate Students</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-migrated-classes')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('save-migrated-class')}}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">From Academic Year <span class="error">* </span></label>
                                                <div class="col-sm-4">
                                                    <select  name="from_academic_year_id" class='academic_year_id' id="academic_year_id"   >
                                                        <option value="">--- select academic year  ---</option>
                                                        <?php foreach ($present_years as $present_year) { ?>                                                        
                                                            <option value="{{$present_year->id}}" @if (old('from_academic_year_id') == $present_year->id) selected="selected" @endif>{{ $present_year->year1 }} - {{ $present_year->year2 }} ( {{ $present_year->from_year }} to  {{ $present_year->to_year }} ) </option>
                                                        <?php } ?>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('from_academic_year_id') }}
                                                    </p>
                                                </div>
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> class <span class="error">* </span></label>
                                                <div class="col-sm-3">
                                                    <select   name="from_class_section_id" id="migrate_student_class"   >
                                                        <option value="">--- select class  ---</option>
                                                        
                                                    </select> 
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('from_class_section_id') }}
                                                    </p>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">To Academic Year <span class="error">* </span></label>
                                                <div class="col-sm-4">
                                                    <select  name="to_academic_year_id" id="migrated_year"  >
                                                        <option value="">----------- select new academic year  ---------</option>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('to_academic_year_id') }}
                                                    </p>
                                                </div>
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">New class <span class="error">* </span></label>
                                                <div class="col-sm-3">
                                                    <select   name="to_class_section_id" id="migrated_class" >
                                                        <option value="">--- select class  ---</option>
                                                    </select> 
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('to_class_section_id') }}
                                                    </p>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Student(s) <span class="error"> </span> </label>
                                                <div class="col-sm-4">
                                                    <select  name="student_id[]" id="migrated_class_students" multiple="" style="height:330px;" class="col-sm-11">
                                                       
                                                    </select>
                                                    <small class="help-block" style="clear:both;color:red;padding-bottom: 0px !important;margin-bottom: 0px !important;"> {{ $errors->first('student_id') }}</small>
                                                   
                                                </div>
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1">selected Students <span class="error"> </span> </label>
                                                <div class="col-sm-3">
                                                    <select  name="" id="migrated_students"  multiple="" style="height:330px;"  readonly disabled="" class="col-sm-9">
                                                       
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            

                                            <div style="margin-left:48%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-migrated-classes')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">Migrated Students</span>
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