@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Marks</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
               
                <li class="active"><a href="{{url ('get-students-remarks')}}">Add Remarks</a></li>
                <li ><a href="{{url ('view-students-remarks')}}">View Remarks</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-plus" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Add <b>Remarks </b> </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students-remarks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>

                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="row">                               
                                <div class="col-sm-12">                                  
                                    <form class="form-horizontal" action="{{url('add-remarks-students')}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}                                                                               
                                        <div class="col-sm-12"><br>
                                            @include('include.messages')                                           
                                            <div class="row">
                                                <label class="col-sm-1"></label>
                                               

                                                <div class="col-sm-2">
                                                    <label class="">Class</label>                                                 
                                                </div>

                                                <div class="col-sm-2">
                                                    <label class="">Subjects</label>                                                 
                                                </div>

                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Student</label>                                                 
                                                </div>

                                            </div>
                                            <div class="row" id="">
                                                <label class="col-sm-1">Select :</label>
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id" id="remark_classes" required class="">
                                                        <option value="">--- Select class---</option> 
                                                        <?php foreach ($class_sections as $class_section) { ?>
                                                            <option value="{{$class_section->id }}" >{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        <?php } ?>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('class_section_id') }}
                                                    </p>
                                                </div>
                                               
                                                <div class="col-sm-2">
                                                    <select  name="subject_id" id="remark_subject"  class="">
                                                        <option value="">--- Select subject---</option> 

                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('subject_id') }}
                                                    </p>
                                                </div>
                                                 <div class="col-sm-2">
                                                    <select  name="student_id" id="remark_student"  class="">
                                                        <option value="">--- Select student---</option> 

                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('student_id') }}
                                                    </p>
                                                </div>

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
