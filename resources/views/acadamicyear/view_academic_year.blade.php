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
                <li class="active"><a href="{{url ('view-academic-years')}}">Academic Year</a></li>
                <li ><a href="{{url ('view-institution-details')}}">Institution details</a></li>
                <li  ><a href="{{url ('view-institute-timings')}}">Institution timings</a></li>
                <li ><a href="{{url ('view-institute-holidays')}}">Institution holidays</a></li>
                <li><a href="{{url ('view-attendance-types')}}">Attendance</a></li>
                <li ><a href="{{url ('view-grade-types')}}">Grade</a></li>
                <li ><a href="{{url ('view-percentages')}}">Percentage</a></li>
                <li ><a href="{{url ('view-grade-settings')}}">Grade - Percentage</a></li>
            </ul>
        </div><br>       
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Academic Years</h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 1)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-academic-year')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:20%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:20%">
                                                <input type="text" class="form-control" placeholder="From" />
                                            </th>
                                            <th class="hasinput" style="width:20%">
                                                <input type="text"  class="form-control" placeholder="To" />
                                            </th>
                                            
                                            <th class="hasinput" style="width:20%">
                                                <input type="text"  class="form-control" placeholder="Status" />
                                            </th>
                                            <th class="hasinput" style="width:20%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">From</th>
                                            <th data-sortable="true">To</th>

                                             
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($years as $year) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}}</td>
                                                <td>{{$year->from_date}}</td>
                                                <td> {{$year->to_date}}</td>
                                                @if (($year->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i> Active </span> </td>
                                                @else
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                @endif
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-academic-year/'.$year->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-academic-year/'.$year->id )}}" onclick="return confirm('Are you sure to delete Acadamic Year.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                

                                                @if (($year->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-academic-year/'.$year->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                               
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-academic-year/'.$year->id)}}" title="Make active">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                               
                                                @endif
                                                <td>
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
