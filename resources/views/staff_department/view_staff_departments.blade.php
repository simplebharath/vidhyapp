@extends('layouts.master')
@section('sub-title', "")
@section("main-content")      
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <h2>View Staff departments</h2>
                        @if(Session::get('add') == 1) <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-department')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="{{url('add-staff-department')}}"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" class="form-control" placeholder="Enter staff type" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Enter Created by" />
                                            </th>
                                            <th class="hasinput" style="width:22%">
                                                <input type="text" class="form-control" placeholder="Enter Created on" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" readonly="" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Staff Type</th>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Created By</th>
                                            <th data-sortable="true">Created On</th>
                                            <th>Actions</th> 
                                        </tr>
                                    </thead>
                                    @if(Session::get('view') == 1)
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($staff_departments as $staff_department) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$staff_department->staff_types->title}} </td>
                                                <td> {{$staff_department->title}}</td>
                                                <td>{{$staff_department->user_logins->user_name}}</td>
                                                <td class="col-md-3">{{$staff_department->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-staff-department/'.$staff_department->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif

                                                        @if(Session::get('user_type_id') == 1)
                                                        @if((Session::get('delete') == 1)&&(Session::get('edit') == 1)) <a href="{{ url('delete-staff-department/'.$staff_department->id )}}" onclick="return confirm('Are you sure to delete class.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Delete"><button class="btn btn-danger btn-xs disabled" data-title="Delete" data-toggle="modal" data-target="#delete" disabled=""><span class="glyphicon glyphicon-trash"></span></button></a>@endif
                                                        @endif
                                                    </div>
                                              

                                                @if (($staff_department->status) == 1)
                                                
                                               @if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-staff-department/'.$staff_department->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a> @else
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs disabled"  href="{{url('make-inactive-staff-department/'.$staff_department->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                    @endif
                                                
                                                @else 
                                               
                                                @if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-staff-department/'.$staff_department->id)}}" title="Make active">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                    @else
                                                    <a class="btn bg-color-blue txt-color-white btn-xs disabled" href="{{url('make-active-staff-department/'.$staff_department->id)}}" title="Make active">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                    @endif
                                                
                                                @endif
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                    {{ $staff_departments->links() }}
                </div>
            </article>
        </div>
@endsection
