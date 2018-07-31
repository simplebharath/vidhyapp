@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                <li ><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li ><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                <li ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li class="active" ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li ><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li ><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
                @endif
<!--                 @if(Session::get('user_type_id') != 1 || Session::get('user_type_id') != 2)
                
                <li class="active"><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                @endif-->
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Holidays</h2>
                         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        @if(Session::get('add') == 1) 
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-institute-holiday')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="{{url('add-institute-holiday')}}"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
                        @endif
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
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Enter Title" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" data-provide="datepicker" class="form-control" placeholder="Select date" />
                                            </th>
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                           
                                            @endif
                                    </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Holiday</th>
                                            <th data-sortable="true">Date</th>
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Actions</th>              
                                           
                                            @endif
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($institute_holidays as $institute_holiday) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$i}}</td>
                                                <td>{{$institute_holiday->title}}</td>
                                                 <td>{{$institute_holiday->holiday_date}}</td>
                                                  @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-institute-holiday/'.$institute_holiday->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif
                                                        @if(Session::get('user_type_id') == 1)
                                                        @if(Session::get('delete') == 1) <a href="{{ url('delete-institute-holiday/'.$institute_holiday->id )}}"  onclick="return confirm('Are you sure to delete holiday.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>@endif
                                                        @endif
                                                    </div>
                                               

                                                @if (($institute_holiday->status) == 1)
                                                
                                                @if(Session::get('edit') == 1)
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-institute-holiday/'.$institute_holiday->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a> @else
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs disabled" title="Make inactive"  href="{{url('make-inactive-institute-holiday/'.$institute_holiday->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                    @endif
                                             
                                                @else 
                                                
                                               @if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-institute-holiday/'.$institute_holiday->id)}}">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                    @else
                                                    <a class="btn bg-color-blue txt-color-white btn-xs disabled" title="Make active" href="{{url('make-active-institute-holiday/'.$institute_holiday->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                    @endif
                                               
                                                @endif
                                                @endif
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
                <div style="float: right;">
                   
                </div>
            </article>
        </div>
        
        
    </div>
</div>
@include('include.footer')
