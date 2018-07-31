@include('include.header')
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
        <section id="" class="">
            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('include.messages')
                    <div class="jarviswidget" id="wid-id-3" data-widget-editbutton="true">                     
                        <header>
                            <span class="widget-icon"> <i class="fa fa-plus" style="color:whitesmoke;"></i> </span>
                            <h2 style="color:whitesmoke;">Add <b> {{$staff[0]->first_name}} {{$staff[0]->middle_name}} {{$staff[0]->last_name}}</b> Document</h2>
                             <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View staff</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add staff</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-staff-profile/'.$staff[0]->id)}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View staff profile</a>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <div class="row"><br>
                                    <div class="form-bootstrapWizard">
                                        <ul class="bootstrapWizard form-wizard">
                                            <li class="active">
                                                <a href="{{url('edit-staff/'.$staff[0]->id)}}"> <span class="step">1</span> <span class="title">Basic information</span> </a>
                                            </li>
                                            <li class="active">
                                                <a href="{{url('add-staff-qualification/'.$staff[0]->id)}}"> <span class="step">2</span> <span class="title">Educational Qualifications</span> </a>
                                            </li>
                                            <li class="active">
                                                <a href="{{url('add-staff-experience/'.$staff[0]->id)}}"> <span class="step">3</span> <span class="title">Experience</span> </a>
                                            </li>
                                            <li class="active">
                                                <a href="{{url('add-staff-document/'.$staff[0]->id)}}"> <span class="step">4</span> <span class="title">Documents</span> </a>
                                            </li>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-sm-12">                                  
                                        <form class="form-horizontal" action="{{url('do-add-staff-document/'.$staff[0]->id)}}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}                                                                               
                                            <div class="col-sm-12"><br>
                                                <legend></legend>
                                                <div class="row" id="dynamicFile">
                                                    <div class="col-sm-12">
                                                        <label class="col-sm-2"></label>
                                                        <label class="col-sm-1">Document</label>

                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control" name="file_name" value="{{old('file_name')}}" placeholder="File name">
                                                            <p class="help-block" style="color: red;">
                                                                {{ $errors->first('file_name') }}
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <div class="col-sm-7">
                                                                    <input type="file"  name="document" value="{{ old('document') }}" class="col-xs-10 col-sm-5 col-md-10 col-lg-10"/>
                                                                    <br><p class="help-block" style="color: red;">
                                                                        {{ $errors->first('document') }}
                                                                    </p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="" style="padding-left:30%;">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save staff document</span>
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
                    
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                         @if(Session::get('view') == 1)
                        <header>
                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                            <h2> View <b> {{$staff[0]->first_name}} {{$staff[0]->middle_name}} {{$staff[0]->last_name}}</b> Document</h2>
                        </header>		
                        <div>

                            <div class="widget-body no-padding">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">				
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Enter File name" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" readonly="" class="form-control" placeholder="Click on  document" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="Enter  Date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>S No</th>
                                            <th data-class="expand">File name</th>
                                            <th>Document</th>
                                            <th data-hide="phone">Created at</th>
                                            <th data-hide="phone">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($staff_documents as $staff_document) { ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><a target="_blank" href="{{url('uploads/staff_documents/'.$staff_document->document)}}"> {{ $staff_document->file_name }} </a></td>
                                                <td><a target="_blank" href="{{url('uploads/staff_documents/'.$staff_document->document)}}"><img src="{{URL::asset('uploads/staff_documents/'.$staff_document->document)}}"  alt="document" title="{{$staff_document->file_name}}" class="superbox-img" style="width:100px;height: 60px;"></a></td>                                          
                                                <td>{{$staff_document->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                @if(Session::get('user_type_id') == 1)
                                                <td><a href="{{ url('delete-staff-document/'.$staff[0]->id.'/'.$staff_document->id )}}" onclick="return confirm('Are you sure to delete document.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a></td>                               
                                            @endif
                                            </tr>
    <?php $i++;
} ?>
                                    </tbody>
                                </table>			
                            </div>
                        </div>
                    
                    @else                                                                                                          
                    <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this 'View Documents' service.Please contact administrator.</h3>
                    @endif 
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>

@include('include.footer')

