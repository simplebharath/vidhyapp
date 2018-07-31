@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li ><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                <li  ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li class="active"><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Grade Settings</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-grade-settings')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-grade-types')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> View Grade</a>

                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div>                     
                            <div class="jarviswidget-editbox">                          
                            </div>                       
                            <div class="widget-body no-padding">
                                <div class="table-responsive">
                                    <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="S No" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Enter percentage" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" class="form-control" placeholder="Enter grade" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                                </th>
                                                
                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S.No</th>
                                                <th data-sortable="true">Percentage</th>
                                                <th data-sortable="true">Grade</th>

                                                <th>Actions</th> 
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($grade_types as $grade_type) {
                                                ?>
                                                <tr class="">
                                                    <td> {{$i}}</td>
                                                    <td>{{$grade_type->percentages->percentage_from}} - {{$grade_type->percentages->percentage_to}}</td>
                                                    <td>{{$grade_type->grades->title}}</td>                                                  
                                                    <td><div class="btn-group">
                                                            <a href="{{ url('edit-grade-settings/'.$grade_type->id)}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-tasettingsrget="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                            @if(Session::get('user_type_id') == 1)
                                                            <a href="{{ url('delete-grade-settings/'.$grade_type->grades->id)}}" onclick="return confirm('Are you sure to delete Grade Settings.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                            @endif
                                                        </div>
                                                                                                                                            
                                                    @if (($grade_type->status) == 1)
                                                    
                                                 <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-settings/'.$grade_type->id)}}">
                                                            <i class="fa fa-times" > </i> 
                                                        </a>
                                                  
                                                    @else 
                                                    
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-settings/'.$grade_type->id)}}">
                                                            <i class="fa fa-check"> </i>
                                                        </a>
                                                   
                                                    @endif
                                                     </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="float: right;">

                    </div> 
            </article>
        </div>
    </div>
</div>

@include('include.footer')
