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
                <li class="active"><a href="{{url ('view-modules')}}">Modules</a></li>
                <li><a href="{{url ('view-user-types')}}">User Types</a></li>
                <li><a href="{{url ('view-user-type-modules')}}">User Type Modules</a></li>
                <li ><a href="{{url ('view-user')}}">Users</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Modules</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-module')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                <thead>
                                    <tr>
                                           
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Module" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Link" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Font awesome" />
                                            </th>
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" class="form-control" placeholder="Rank" />
                                            </th>
                                            <th class="hasinput" style="width:4%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>S.No</th>   
                                            <th data-sortable="true">Module</th>
                                            <th data-sortable="true">Link</th>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Rank</th>
                                            <th>Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($modules as $module) {
                                            ?> 
                                            <tr class="">
                                                <td>{{$i}}</td>
                                                <td>{{$module->module}}</td>
                                                <td>{{$module->link}}</td>
                                                <td>{{$module->image}}</td>
                                                <td>{{$module->rank}}</td>
                                               <td><div class="btn-group">
                                                        <a href="{{ url('edit-module/'.$module->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                         @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-module/'.$module->id )}}" onclick="return confirm('Are you sure to delete module.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                   </div>
                                                

                                                @if (($module->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-module/'.$module->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                                
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-module/'.$module->id)}}" title="Make active">
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
