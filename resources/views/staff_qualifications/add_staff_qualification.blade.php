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
                <li class="active"><a href="{{url ('view-staff')}}">Staff</a></li> 
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-plus" style="color:whitesmoke;"></i> </span>
                        <h2 style="color:whitesmoke;">Add <b> {{$staff[0]->first_name}} {{$staff[0]->middle_name}} {{$staff[0]->last_name}}</b> Educational Qualification</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View staff</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add staff</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-profile/'.$staff[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View staff profile</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="row">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">
                                        <li class="active">
                                            <a href="{{url('edit-staff/'.$staff[0]->id)}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                        </li>
                                        <li class="active">
                                            <a href="{{url('add-staff-qualification/'.$staff[0]->id)}}"> <span class="step">2</span> <span class="title">Educational Qualifications</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-staff-experience/'.$staff[0]->id)}}"> <span class="step">3</span> <span class="title">Experience</span> </a>
                                        </li>
                                        <li >
                                            <a href="{{url('add-staff-document/'.$staff[0]->id)}}"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                        </li>

                                    </ul>
                                    <div class="clearfix"></div>
                                </div><br>
                                <div class="col-sm-12">                                  
                                    <form class="form-horizontal" action="{{url('do-add-staff-qualification/'.$staff[0]->id)}}" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}                                                                               
                                        <div class="col-sm-12"><br>
                                            @include('include.messages')
                                            <legend></legend>
                                            <div class="row" id="dynamicQualification">
                                                <label class="col-sm-1"></label>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Degree</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Institution</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Course</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Specialization</label>                                                 
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-sm-2">Percentage</label>                                                 
                                                </div>

                                            </div>
                                            <div class="row" id="dynamicQualification">
                                                <label class="col-sm-1">Education :</label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="qualification" value="{{old('qualification')}}" placeholder="PG/inter/ssc/other">
                                                    </select>
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('qualification') }}
                                                    </p>
                                                </div> 
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="institute_name" value="{{old('institute_name')}}" placeholder="Institute name">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('institute_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="course_name" value="{{old('course_name')}}" placeholder="BE/Bsc/MPC">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('course_name') }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="stream_branch" value="{{old('stream_branch')}}" placeholder="Finance/ECE/Chemistry">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('stream_branch') }}
                                                    </p>
                                                </div>                                                                                              
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="percentage" value="{{old('percentage')}}" placeholder="GPA/Percentage">
                                                    <p class="help-block" style="color: red;">
                                                        {{ $errors->first('percentage') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12">
                                            <br>
                                        </div>
                                        <div class="col-md-offset-4">
                                            <button type="submit" class="width-10 btn btn-md btn-success">
                                                <i class="ace-icon fa fa-check"></i>
                                                <span class="bigger-110">Save staff qualification</span>
                                            </button>
                                            <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                <i class="ace-icon fa fa-times red2"></i>
                                                <span class="bigger-110">Cancel</span>
                                            </button>   
                                            <a href="{{ url('view-staff')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                <i class="ace-icon fa fa-undo"></i>
                                                <span class="bigger-110">View staff details </span>
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
                        <h2> View <b> {{$staff[0]->first_name}} {{$staff[0]->middle_name}} {{$staff[0]->last_name}}</b> Educational Qualifications</h2>
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
                                                <input type="text" class="form-control" placeholder="Enter Degree" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control" placeholder="Enter institute" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="Enter Course" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text"  class="form-control" placeholder="Enter Specialization" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Enter GPA" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>

                                        <tr>
                                            <th data-sortable="true">SNo</th>
                                            <th data-sortable="true">Degree</th>
                                            <th data-sortable="true">Institute</th>
                                            <th data-sortable="true">Course</th>             
                                            <th data-sortable="true">Specialization</th>
                                            <th data-sortable="true">GPA</th>
                                            <th data-sortable="true">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($staff_qualifications as $staff_qualification) { ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$staff_qualification->qualification}}</td>
                                                <td>{{$staff_qualification->institute_name}}</td>
                                                <td>{{$staff_qualification->course_name}}</td>
                                                <td>{{$staff_qualification->stream_branch}}</td>
                                                <td>{{$staff_qualification->percentage}}</td>                                          
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-staff-qualification/'.$staff_qualification->staff_id.'/'.$staff_qualification->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif
                                                        @if(Session::get('user_type_id') == 1)
                                                        @if((Session::get('delete') == 1)&&(Session::get('edit') == 1)) <a href="{{ url('delete-staff-qualification/'.$staff_qualification->staff_id.'/'.$staff_qualification->id )}}" onclick="return confirm('Are you sure to delete staff qualification.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Delete"><button class="btn btn-danger btn-xs disabled" data-title="Delete" data-toggle="modal" data-target="#delete" disabled=""><span class="glyphicon glyphicon-trash"></span></button></a>@endif
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
    <?php $i++;
} ?>
                                    </tbody>
                                </table>
                                @else                                                                                                          
                                <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this service.Please contact administrator.</h3>
                                @endif                               
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                    {{ $staff_qualifications->links() }}
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
