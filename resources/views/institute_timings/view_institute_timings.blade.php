@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Institute timings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                <li ><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li ><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                 <li class="active" ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li ><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li ><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
                @endif
                @if((Session::get('user_type_id') != 1) && (Session::get('user_type_id') != 2))
                <li class="active" ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                
                @endif
            </ul>
        </div>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Institute Timings </h2>
                         @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-institute-timings')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        
                        <div class="widget-body no-padding">
                            <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                <thead>
                                    <tr>
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Period" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="From" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="To" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Duration" />
                                            </th>
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                           
                                            @endif
                                        </tr>
                                        <tr>

                                            <th style="text-align: center;">Title</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Duration</th>
                                             @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            <th>Actions</th>
                                           
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($institute_timings as $institute_timing) {
                                            ?> 
                                            <tr class="">                                       
                                                <td>{{$institute_timing->title}}</td>
                                                <td>{{$institute_timing->class_start}}</td>
                                                <td>{{$institute_timing->class_end}}</td>
                                                <td>{{$institute_timing->duration}}</td>
                                                 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-institute-timings/'.$institute_timing->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-institute-timings/'.$institute_timing->id )}}" onclick="return confirm('Are you sure to delete timings.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                               

                                                @if (($institute_timing->status) == 1)
                                                
                                               <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-institute-timings/'.$institute_timing->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                
                                                @else 
                                                
                                              <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-institute-timings/'.$institute_timing->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                               
                                                @endif
                                                </td>
                                                @endif
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
