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
                <li  class="active"><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li ><a href="{{url ('view-staff')}}">Staff</a></li>  
                <li><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
                <li ><a href="{{url ('view-staff-attendance')}}">Staff attendance</a></li>
                <li ><a href="{{url ('view-staff-salaries')}}">Staff salaries</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Staff types</h2>
                        @if(Session::get('add') == 1) <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-type')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="{{url('add-staff-type')}}"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Enter staff type" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Enter Created by" />
                                            </th>
                                            <th class="hasinput" style="width:23%">
                                                <input type="text" class="form-control" placeholder="Enter Created on" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text"  class="form-control" readonly="" placeholder="Actions" />
                                            </th>
                                            
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Staff type</th>
                                            <th data-sortable="true">Created By</th>
                                            <th data-sortable="true">Created On</th>
                                            <th>Actions</th>              
                                            
                                        </tr>
                                    </thead>
                                     @if(Session::get('view') == 1)
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($staff_types as $staff_type) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$i}}</td>
                                                <td>{{ $staff_type->title }}</td>
                                                <td>{{$staff_type->user_logins->user_name}}</td>
                                                <td class="col-md-3">{{$staff_type->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td><div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-staff-type/'.$staff_type->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif

                                                         @if(Session::get('user_type_id') == 1)
                                                        @if((Session::get('delete') == 1)&&(Session::get('edit') == 1)) <a href="{{ url('delete-staff-type/'.$staff_type->id )}}" onclick="return confirm('Are you sure to delete staff type.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Delete"><button class="btn btn-danger btn-xs disabled" data-title="Delete" data-toggle="modal" data-target="#delete" disabled=""><span class="glyphicon glyphicon-trash"></span></button></a>@endif
                                                    @endif
                                                    </div>
                                                

                                                @if (($staff_type->status) == 1)
                                                
                                                @if(Session::get('edit') == 1)
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-staff-type/'.$staff_type->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a> @else
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs disabled"  href="{{url('make-inactive-staff-type/'.$staff_type->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                    @endif
                                                
                                                @else 
                                                
                                                @if(Session::get('edit') == 1)
                                                    <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-staff-type/'.$staff_type->id)}}"  title="Make active">
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                                    @else
                                                    <a class="btn bg-color-blue txt-color-white btn-xs disabled" href="{{url('make-active-staff-type/'.$staff_type->id)}}"  title="Make active">
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
                    {{ $staff_types->links() }}
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
