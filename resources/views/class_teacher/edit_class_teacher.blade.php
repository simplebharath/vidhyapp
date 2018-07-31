@include('include.header')
<style> #error-message{margin-left: 330px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Classes</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-classes')}}">Classes</a></li>
                <li><a href="{{url ('view-sections')}}">Sections</a></li>
                <li ><a href="{{url ('view-subjects')}}">Subjects</a></li>
                <li><a href="{{ url('view-class-sections')}}">Class-Sections</a></li>
                <li ><a href="{{ url('view-class-subjects')}}">Class-Subjects</a></li> 
                <li ><a href="{{ url('view-class-schedule')}}">Class-Schedule</a></li> 
                <li  class="active"><a href="{{ url('view-class-teachers')}}">Class-Teacher</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Edit Class-Teacher</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-teachers')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-sections')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-edit-class-teacher/'.$class_teachers[0]->id)}}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class<span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select   name="class_section_id" id="class_section_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >

                                                        <option value="{{ $class_teachers[0]->class_section_id}}" >{{ $class_teachers[0]->classes->class_name }}  @if(($class_teachers[0]->section_id) != 0)  -  {{ $class_teachers[0]->sections->section_name }}  @endif </option>

                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('class_section_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Teacher: </label>
                                                <div class="col-sm-9">
                                                    <select  name="staff_id" id="section"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value=""> --- select teacher --- </option>
                                                        <?php foreach ($teachers as $teacher) { ?>                                                        
                                                            <option value="{{$teacher->id}}" @if ($class_teachers[0]->staff_id == $teacher->id) selected="selected" @endif>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('staff_id') }}
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
                                                <a href="{{ url('view-class-teachers')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View class teachers</span>
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