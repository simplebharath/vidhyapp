@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Payments</li><li>students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">               
                <li  class="active"><a href="{{url ('students-fee-payments')}}">Payments</a></li>
                 <li ><a href="{{url ('payment-history-institute')}}">Payment history</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-plus" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Get <b> Students  </b> To pay fees </h2>
                                                
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="row">                               
                                <div class="col-sm-12">                                  
                                    <form class="form-horizontal" action="{{url('get-students-all')}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}                                                                               
                                        <div class="col-sm-12"><br>
                                            @include('include.messages')                                           
                                            <div class="row">
                                                <label class="col-sm-1"></label>
                                                <div class="col-sm-2">
                                                    <label class="">Classes</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Students</label>                                                 
                                                </div>
                                                 <div class="col-sm-1">
                                                                                                  
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Student</label>                                                 
                                                </div>
                                               
                                            </div>
                                            <div class="row" id="dynamicQualification">
                                                <label class="col-sm-1">Select :</label>
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id" id="student_class"  class="">
                                                        <option value="">--- Select class---</option> 
                                                        <?php foreach ($classes as $class) { ?>
                                                            <option value="{{$class->id}}" @if (old('class_section_id') == $class->id) selected="selected" @endif>{{ $class->classes->class_name }}  @if(($class->section_id) != 0)  -  {{ $class->sections->section_name}}  @endif </option>
                                                        <?php } ?>
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('class_section_id') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="student_id" id="students"  class="col-xs-10 col-sm-5 col-lg-12 col-mg-12">
                                                        <option value="">--- select student---</option> 
                                                    </select> 
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('student_id') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-1">or</div>
                                                <div class="col-sm-2">
                                                   <input type="text" placeholder="Name or Roll No or Id" name="student_name" value="{{old('student_name')}}" class="col-xs-10 col-sm-5 col-lg-12 col-mg-12" />
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('student_name') }}
                                                    </p>
                                                </div>
                                                
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get details</span>
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
