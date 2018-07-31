@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li ><a href="{{url ('view-students')}}">Students</a></li> 
                <li class="active"><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
                <li><a href="{{url ('view-all-student-fee-discounts')}}">Fee discounts</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-plus" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Add <b> </b> Attendance @if($attendance_type[0]->id == 2){{$attendance_type[0]->title}} @endif </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>      
<!--                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('edit-student-attendance')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-pencil"></i> Edit</a> 
                   -->
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="row">                               
                                <div class="col-sm-12">                                  
                                    <form class="form-horizontal" action="{{url('get_students_all')}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}                                                                               
                                        <div class="col-sm-12"><br>
                                            @include('include.messages')                                           
                                            <div class="row">
                                                <label class="col-sm-1"></label>
                                                <div class="col-sm-2">
                                                    <label class="">Class</label>                                                 
                                                </div>
                                                @if($attendance_type[0]->id == 2)
                                               <div class="col-sm-2">
                                                    <label class="">Subjects</label>                                                 
                                                </div>
                                                @endif
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2"></label>                                                 
                                                </div>
                                                
                                            </div>
                                            <div class="row" id="">
                                                <label class="col-sm-1">Select :</label>
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id" id="c_section_id"  class="" required>
                                                        <option value="">--- Select class---</option> 
                                                        <?php foreach ($class_sections as $class_section) { ?>
                                                            <option value="{{$class_section->id }}" @if(old('class_section_id') == $class_section->id )selected @endif>{{$class_section->classes->class_name}} @if($class_section->section_id >0) - {{ $class_section->sections->section_name }}@endif</option>
                                                        <?php } ?>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('class_section_id') }}
                                                    </p>
                                                </div>
                                                @if($attendance_type[0]->id == 2)
                                                <div class="col-sm-2">
                                                    <select  name="subject_id" id="sub_id" required class="">
                                                        <option value="">--- Select subject---</option> 
                                                        
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('subject_id') }}
                                                    </p>
                                                </div>
                                                @endif
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get students</span>
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
