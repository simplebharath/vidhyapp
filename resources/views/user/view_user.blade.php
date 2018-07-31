@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <!DOCTYPE html>
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-modules')}}">Modules</a></li>
                <li><a href="{{url ('view-user-types')}}">User Types</a></li>
                <li><a href="{{url ('view-user-type-modules')}}">User Type Modules</a></li>
                <li class="active"><a href="{{url ('view-user')}}">Users</a></li>
            </ul>
        </div><br>
        <br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Users </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-user')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                 <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>                                          
                                            <th class="hasinput" style="width:12%">
                                                <input type="text" class="form-control" placeholder="User name" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" readonly="" class="form-control" placeholder="User" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:11%">
                                                <input type="text" class="form-control" placeholder="Search " />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text" readonly="" class="form-control" placeholder="Rights" />
                                            </th>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Name</th>
                                            <th data-sortable="true">Photo</th>
                                            <th data-sortable="true">Credentials</th>
                                            <th data-sortable="true">Contact </th>
                                            <th data-sortable="true">Change Rights</th>         
                                            <th >Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($users as $user) {
                                            ?> 
                                            <tr class="">

                                                <td>User type : {{$user->user_types->title}}</span><br> Name  : {{$user->first_name}}  {{$user->last_name}}</span></td>
                                                <td><img src="{{URL::asset('uploads/users/'.$user->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'" height="50" width="50"></td>
                                                <td>User name : {{ $user->user_logins->user_name }} <br> Password : {{$user->user_logins->password}}</td>
                                                <td class="col-md-2">{{$user->email_id}} <br> {{$user->contact_number}} <br> {{$user->address}}</td>                                               
                                                @if (($user->status) == 1)
                                                <td class="col-md-3">
                                                    @if($user->add_rights == 1) <span class="badge bg-color-blue" style=""><i class="ace-icon fa fa-check bigger-120"></i> yes </span> @else <span class="badge bg-color-redLight" style=""><i class="ace-icon fa fa-times bigger-120"></i> No </span> @endif &nbsp;&nbsp;
                                                    @if($user->add_rights == 1)<a href="{{url('add-rights-make-no/'.$user->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-plus-circle bigger-120"></i> Add</span></a> @else <a href="{{url('add-rights-make-yes/'.$user->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-plus-circle bigger-120"></i> Add </span></a> @endif
                                                 &nbsp;
                                                    @if($user->view_rights == 1) <span class=" badge bg-color-blue" style=""><i class="ace-icon fa fa-check bigger-120"></i> yes </span> @else <span class="badge bg-color-redLight" style=""><i class="ace-icon fa fa-times bigger-120"></i> No </span> @endif &nbsp;&nbsp;
                                                    @if($user->view_rights == 1)<a href="{{url('view-rights-make-no/'.$user->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-eye bigger-120"></i> View</span></a> @else <a href="{{url('view-rights-make-yes/'.$user->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-eye bigger-120"></i> View </span></a> @endif
                                                    <br><br>
                                                    @if($user->edit_rights == 1) <span class="badge bg-color-blue" style=""><i class="ace-icon fa fa-check bigger-120"></i> yes </span> @else <span class="badge bg-color-redLight" style=""><i class="ace-icon fa fa-times bigger-120"></i> No </span> @endif &nbsp;&nbsp;
                                                    @if($user->edit_rights == 1)<a href="{{url('edit-rights-make-no/'.$user->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-edit bigger-120"></i> Edit</span></a> @else <a href="{{url('edit-rights-make-yes/'.$user->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-pencil bigger-120"></i> Edit </span></a> @endif
                                                &nbsp;
                                                 @if(Session::get('user_type_id') == 1)
                                                    @if($user->delete_rights == 1) <span class="badge bg-color-blue" style=""><i class="ace-icon fa fa-check bigger-120"></i> yes </span> @else <span class="badge bg-color-redLight" style=""><i class="ace-icon fa fa-times bigger-120"></i> No </span> @endif &nbsp;&nbsp;
                                                    @if($user->delete_rights == 1)<a href="{{url('delete-rights-make-no/'.$user->id)}}"><span class="label label-danger" style=""><i class="ace-icon fa fa-trash-o bigger-120"></i> Delete</span></a> @else <a href="{{url('delete-rights-make-yes/'.$user->id)}}"><span class="label label-success" style=""><i class="ace-icon fa fa-trash-o bigger-120"></i> Delete </span></a> @endif
                                                @endif
                                                </td>
                                                @else
                                                <td>NA</td>
                                                @endif
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-user/'.$user->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        <a href="{{ url('delete-user/'.$user->id )}}" onclick="return confirm('Are you sure to delete user.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                    </div>
                                                

                                                @if (($user->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-user/'.$user->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                
                                                @else 
                                                <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-user/'.$user->id)}}" title="Make active">
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
