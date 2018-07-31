@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
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
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Staff </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" readonly=""class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:13%">
                                                <input type="text" class="form-control" placeholder="Staff info" />
                                            </th>
                                            <th class="hasinput" style="width:11%">
                                                <input type="text" class="form-control" placeholder="Name-Id" />
                                            </th>
                                            <th class="hasinput" style="width:13%">
                                                <input type="text"  class="form-control" placeholder="Contact info" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Credentials" />
                                            </th>
                                            
                                            <th class="hasinput" style="width:12%">
                                                <input type="text"  class="form-control" placeholder="Experience" />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly="" class="form-control"  placeholder="Actions" />
                                            </th>


                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Staff info</th>

                                            <th data-sortable="true">Name-Id</th>
                                            <th data-sortable="true">Contact info</th>
                                            <th data-sortable="true">Credentials</th> 
                                            <th data-sortable="true">Experience</th> 
                                            <th >Actions</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($staffs as $staff) {
                                            ?> 
                                            <tr class="">
                                                <td>
                                                    <a href="{{ url('view-staff-profile/'.$staff->id )}}" title="View profile"><img src="{{URL::asset('uploads/staff/'.$staff->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="40" width="40"> </a>

                                                </td>
                                                <td>User type : {{$staff->user_types->title}} <br> {{$staff->staff_types->title}} - {{$staff->departments->title}} </td>
                                                <td @if (($staff->status) == 1) style="color:green;" @else style="color:red;" @endif> <a  href="{{ url('view-staff-profile/'.$staff->id )}}" title="View profile"> {{$staff->first_name}}  {{$staff->last_name}} </a><br> {{ $staff->staff_unique_id }} </td>
                                                <td> {{ $staff->contact_number }} <br> {{ $staff->email }}</td>
                                                <td>User name: {{$staff->user_logins->user_name}} <br> Password : {{$staff->user_logins->password}}</td>
                                                <!--                                                @if (($staff->status) == 1)
                                                                                                <td class="col-md-3">
                                                                                                    @if($staff->add_rights == 1) <span class=" label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> Add Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> Add Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                                                                    <br><br>
                                                                                                    @if($staff->view_rights == 1) <span class=" label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> View Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> View Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                    <br><br>
                                                
                                                                                                    @if($staff->edit_rights == 1) <span class="label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> Edit Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> Edit Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                                                                    <br><br>
                                                                                                     @if(Session::get('user_type_id') == 1)
                                                                                                    @if($staff->delete_rights == 1) <span class="label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> Delete Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> Delete Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                    @endif
                                                                                                </td>
                                                                                                <td>
                                                                                                    @if($staff->add_rights == 1)<a href="{{url('staff-add-rights-make-no/'.$staff->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-plus-circle bigger-120"></i> Disable Add</span></a> @else <a href="{{url('staff-add-rights-make-yes/'.$staff->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-plus-circle bigger-120"></i> Enable Add </span></a> @endif 
                                                                                                   <br><br> @if($staff->view_rights == 1)<a href="{{url('staff-view-rights-make-no/'.$staff->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-eye bigger-120"></i> Disable View</span></a> @else <a href="{{url('staff-view-rights-make-yes/'.$staff->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-eye bigger-120"></i> Enable View </span></a> @endif
                                                                                                    <br><br>@if($staff->edit_rights == 1)<a href="{{url('staff-edit-rights-make-no/'.$staff->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-edit bigger-120"></i> Disable Edit</span></a> @else <a href="{{url('staff-edit-rights-make-yes/'.$staff->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-pencil bigger-120"></i> Enable Edit </span></a> @endif
                                                                                                  <br><br> @if($staff->delete_rights == 1)<a href="{{url('staff-delete-rights-make-no/'.$staff->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-trash-o bigger-120"></i> Disable Delete</span></a> @else <a href="{{url('staff-delete-rights-make-yes/'.$staff->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-trash-o bigger-120"></i> Enable Delete </span></a> @endif
                                                                                                </td>
                                                                                                @else
                                                                                                <td class="col-md-3">
                                                                                                    @if($staff->add_rights == 1) <span class=" label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> Add Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> Add Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                                                                    <br><br>
                                                                                                    @if($staff->view_rights == 1) <span class=" label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> View Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> View Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                    <br><br>
                                                
                                                                                                    @if($staff->edit_rights == 1) <span class="label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> Edit Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> Edit Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                                                                    <br><br>
                                                                                                    @if($staff->delete_rights == 1) <span class="label label-info" style=""><i class="ace-icon fa fa-check bigger-120"></i> Delete Enabled </span> @else <span class="label label-danger" style=""><i class="ace-icon fa fa-times bigger-120"></i> Delete Disabled </span> @endif &nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                                                                </td>
                                                                                                <td>NA</td>
                                                                                                @endif-->
                                                <td>Joined date :{{$staff->joined_date}} <br>Experience : {{$staff->experience}}</td>
                                                <td><div class="btn-group">
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('edit-staff/'.$staff->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @endif
                                                        <a href="{{ url('view-staff-profile/'.$staff->id )}}" title="view"><button class="btn btn-info btn-xs" data-title="View" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-eye-open"></span></button></a>
                                                    </div>

                                                    @if (($staff->status) == 1)

                                                    <a class="btn btn-danger btn-xs" title="Make inactive" href="{{url('make-inactive-staff/'.$staff->id)}}">
                                                        <i class="glyphicon glyphicon-remove" > </i>
                                                    </a>

                                                    @else 

                                                    <a class="btn btn-success btn-xs" title="Make active" href="{{url('make-active-staff/'.$staff->id)}}">
                                                        <i class="glyphicon glyphicon-ok"> </i>
                                                    </a>
                                                    

                                                    @endif
                                                    <a class="btn btn-primary btn-xs" title="Download report" href="{{url('staff-summary-pdf/'.$staff->id)}}" >
                                                        <i class="glyphicon glyphicon-download-alt"> </i>
                                                    </a>
                                                    <a class="btn btn-primary btn-xs" title="Print report" target="_blank" href="{{url('staff-summary-print/'.$staff->id)}}">
                                                        <i class="glyphicon glyphicon-print"> </i>
                                                    </a>
                                                     <a class="btn btn-primary btn-xs" title="Email report" href="{{url('staff-summary-email/'.$staff->id)}}">
                                                        <i class="glyphicon glyphicon-envelope"> </i>
                                                    </a>

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
