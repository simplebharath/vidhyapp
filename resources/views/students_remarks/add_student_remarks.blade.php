@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Remarks</li><li>Students</li>
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
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Remarks For class {{$class_name[0]->classes->class_name}} @if($class_name[0]->section_id > 0) {{$class_name[0]->sections->section_name}} @endif  @if($subject != '') {{$subject[0]->subject_name}} @endif</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('get-students-remarks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students-remarks')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <form class="form-horizontal" action="{{url('do-add-remarks-students')}}" enctype="multipart/form-data" method="POST" >
                                    {{ csrf_field() }}                                                           
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <div class="dt-toolbar pull-right" style="float:right;">
                                            <div class="col-sm-10">
                                                <label> </label>
                                            </div>

                                            <div class="col-sm-2 pull-right">
                                                <button type="submit" class="width-10 btn btn-md btn-info">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save Remarks</span>
                                                </button>
                                            </div>
                                        </div>
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:3%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" readonly="" class="form-control" placeholder="image" />
                                                </th>
                                                <th class="hasinput" style="width:5%">
                                                    <input type="text" class="form-control" placeholder="Class" />
                                                </th>

                                                <th class="hasinput" style="width:8%">
                                                    <input type="text" class="form-control" placeholder="Student" />
                                                </th>

                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" readonly placeholder="Remarks" />
                                                </th>

                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S No</th>
                                                <th data-sortable="true">Image</th>
                                                <th data-sortable="true">Class</th>                                                
                                                <th data-sortable="true">Student</th>  
                                                <th data-sortable="true">Remark </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($students as $student) {
                                                ?> 
                                                <tr class="">       
                                                    <td>{{$i}}</td>
                                                    <td><img src="{{URL::asset('uploads/students/profile_photos/'.$student->photo)}}"  @if($student->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($student->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="50" width="50"> </td>
                                                    <td> {{$student->classes->class_name}} @if($student->section_id > 0) - {{ $student->sections->section_name}} @endif  </td>
                                                    <td>{{$student->first_name}} {{$student->last_name}} <br> {{$student->roll_number}} <br> {{$student->unique_id}}</td>                                              

                                                    @if($subject != '')
                                            <input type="text" hidden="" name="subject_id" value="{{$subject[0]->id}}">
                                            @endif
                                            <td><input type="text" required="" placeholder="Title" name="remark_title[<?php echo $student->id; ?>]" value="{{old('remark_title')}}" class="col-xs-10 col-sm-5 col-md-11 col-lg-11"><br><br>
                                                <textarea type="text" required="" rows="3"  maxlength="500" cols="47" placeholder="text here..." name="remark_description[<?php echo $student->id; ?>]">{{old('remark_description')}}</textarea>
                                                <p class="help-block" style="color: red;">
                                                    {{ $errors->first('remark_title' ) }}
                                                </p>
                                                <p class="help-block" style="color: red;">
                                                    {{ $errors->first('remark_description' ) }}
                                                </p></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>     
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