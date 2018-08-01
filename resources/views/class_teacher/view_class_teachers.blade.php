@extends('layouts.master')
@section('sub-title', "")
@section("main-content")   
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                       
                        <h2>View Class-Teachers</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-class-sections')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                                <input type="text" class="form-control" placeholder="Enter Name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Staff" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Class" />
                                            </th>
                                           
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Status" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly=""  class="form-control" placeholder="Actions" />
                                            </th>

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Teacher</th>
                                            <th data-sortable="true">Photo</th>
                                            <th data-sortable="true">Class</th>
                                             
                                            
                                            <th >Status</th>
                                            <th >Actions</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($class_teachers as $class_teacher) {
                                            ?> 
                                            <tr class="">                                                   
                                                <td>{{$class_teacher->teachers->first_name}} {{$class_teacher->teachers->last_name}}</td>
                                                <td><a href="{{url('view-staff-profile/'.$class_teacher->teachers->id)}}"><img src="{{URL::asset('uploads/staff/'.$class_teacher->teachers->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="50" width="50" class="img-rounded img-responsive" alt="Teacher"></a> </td>
                                                <td>{{$class_teacher->classes->class_name}} 
                                                @if ($class_teacher->section_id !=0 ) -  {{$class_teacher->sections->section_name}}  @endif  </td>                                     
                                                
                                                @if (($class_teacher->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i> Active </span> </td>
                                                 @else 
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                @endif
                                                
                                                <td><div class="btn-group">
                                                        <a  @if(Session::get('edit')==1) href="{{ url('edit-class-teacher/'.$class_teacher->id )}}" @endif title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" @if(Session::get('edit') !=1) disabled @endif><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a @if(Session::get('delete')==1)  href="{{ url('delete-class-teacher/'.$class_teacher->id )}}" onclick="return confirm('Are you sure to delete class_teacher.?');" @endif title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" @if(Session::get('delete') !=1) disabled @endif ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                              

                                                @if (($class_teacher->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" @if(Session::get('edit') ==1) href="{{url('make-inactive-class-teacher/'.$class_teacher->id)}}"  @else disabled @endif>
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                               
                                                @else 
                                             
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" @if(Session::get('edit') ==1) href="{{url('make-active-class-teacher/'.$class_teacher->id)}}"  @else disabled @endif>
                                                        <i class="fa fa-check"> </i> 
                                                    </a>
                                              
                                                @endif
                                            </tr>
                                            <?php
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

            </article>
        </div>
@endsection
