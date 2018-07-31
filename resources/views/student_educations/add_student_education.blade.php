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
                <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-plus" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Add <b> {{$student[0]->first_name}} {{$student[0]->middle_name}} {{$student[0]->last_name}}</b> Previous Education</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View students</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-student')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add student</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">

                                        <li class="active">
                                            <a href="{{url('edit-student/'.$student[0]->id)}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{url('add-parent/'.$student[0]->id)}}"> <span class="step">2</span> <span class="title">Parent Information</span> </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{url('add-student-education/'.$student[0]->student_id)}}"> <span class="step">3</span> <span class="title">Previous Institution</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-student-document/'.$student[0]->student_id)}}"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div><br>
                                <div class="col-sm-12">                                  
                                    <form class="form-horizontal" action="{{url('do-add-student-education/'.$student[0]->student_id)}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}                                                                               
                                        <div class="col-sm-12"><br>
                                            @include('include.messages')
                                            <legend></legend>
                                            <div class="row" id="">
                                                <label class="col-sm-1"></label>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Institution</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Fromclass</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Toclass</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Fromyear</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Toyear</label>                                                 
                                                </div>

                                            </div>
                                            <div class="row" >
                                                <label class="col-sm-1">Education :</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="institute_name" value="{{old('institute_name')}}" placeholder="Institute name">
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('institute_name') }}
                                                    </p>
                                                </div> 
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="class_from" value="{{old('class_from')}}" placeholder="From calss">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('class_from') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="class_to" value="{{old('class_to')}}" placeholder="To class">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('class_to') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="from_year" value="{{old('from_year')}}" placeholder="From year">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('from_year') }}
                                                    </p>
                                                </div>                                                                                              
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="to_year" value="{{old('to_year')}}" placeholder="To year">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('to_year') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" >
                                            <label class="col-sm-3"></label>
                                            <label class="col-sm-1">Description </label>
                                            <div class="col-sm-3">
                                                <textarea cols="55" rows="3" maxlength="500" name="education_description" placeholder="">{{old('education_description')}}</textarea>
                                                </select>
                                                <p class="help-block" style="color: red;">
                                                    {{ $errors->first('education_description') }}
                                                </p>
                                            </div> 
                                        </div>
                                        <div class="col-xs-12">
                                            <br>
                                        </div>
                                        <div class="col-md-offset-4">
                                            <button type="submit" class="width-10 btn btn-md btn-success">
                                                <i class="ace-icon fa fa-check"></i>
                                                <span class="bigger-110">Save student education</span>
                                            </button>
                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                <i class="ace-icon fa fa-times red2"></i>
                                                <span class="bigger-110">Cancel</span>
                                            </button>   
                                            <a href="{{ url('view-students')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                <i class="ace-icon fa fa-undo"></i>
                                                <span class="bigger-110">View student details </span>
                                            </a>
                                        </div><br>

                                    </form>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </article>
        </div>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2> View <b> {{$student[0]->first_name}} {{$student[0]->middle_name}} {{$student[0]->last_name}}</b>Previous Education</h2>
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                @if(Session::get('view') == 1)
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Institute" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control" placeholder="From -To" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="From year" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text"  class="form-control" placeholder="To year" />
                                            </th>
                                            <th class="hasinput" style="width:20%">
                                                <input type="text" class="form-control" placeholder="Description" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>

                                        <tr>
                                            <th data-sortable="true">SNo</th>
                                            <th data-sortable="true">Institute</th>
                                            <th data-sortable="true">Class From - To</th>
                                            <th data-sortable="true">From year</th>             
                                            <th data-sortable="true">To year</th>
                                            <th data-sortable="true">Description</th>
                                            <th data-sortable="true">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($student_educations as $student_education) {
                                            ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$student_education->institute_name}}</td>
                                                <td>{{$student_education->class_from}} - {{$student_education->class_to}}</td>
                                                <td>{{$student_education->from_year}}</td>
                                                <td>{{$student_education->to_year}}</td>
                                                <td>{{$student_education->education_description}}</td>                                          
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-student-education/'.$student_education->student_id.'/'.$student_education->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif
                                                        @if(Session::get('user_type_id') == 1)
                                                        @if((Session::get('delete') == 1)&&(Session::get('edit') == 1)) <a href="{{ url('delete-student-education/'.$student_education->student_id.'/'.$student_education->id )}}" onclick="return confirm('Are you sure to delete student education.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Delete"><button class="btn btn-danger btn-xs disabled" data-title="Delete" data-toggle="modal" data-target="#delete" disabled=""><span class="glyphicon glyphicon-trash"></span></button></a>@endif
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                @else                                                                                                          
                                <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this service.Please contact administrator.</h3>
                                @endif                               
                            </div>
                        </div>
                    </div>
                </div>

            </article>
        </div>
    </div>
</div>
@include('include.footer')
