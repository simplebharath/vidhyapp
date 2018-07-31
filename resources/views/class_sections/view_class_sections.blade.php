@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Manage Classes</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-classes')}}">Classes</a></li>
                <li><a href="{{url ('view-sections')}}">Sections</a></li>
                <li ><a href="{{url ('view-subjects')}}">Subjects</a></li>
                <li  class="active"><a href="{{ url('view-class-sections')}}">Class-Sections</a></li>
                <li ><a href="{{ url('view-class-subjects')}}">Class-Subjects</a></li> 
                <li ><a href="{{ url('view-class-schedule')}}">Class-Schedule</a></li> 
                <li ><a href="{{ url('view-class-teachers')}}">Class-Teacher</a></li>
            </ul>
        </div><br>       
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('include.messages')
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>View Class-Sections</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right"  @if(Session::get('add') == 1) href="{{url('add-class-section')}}" @else disabled @endif style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>

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
                                                <input type="text" class="form-control" placeholder="class" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Assign" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="status" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                           
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.no </th>
                                            <th data-sortable="true">Class </th>
                                            <th>Class Teacher</th>
                                            
                                            <th>Status</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($class_sections as $class_section) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}}</td>
                                                <td>{{$class_section->classes->class_name}}
                                                        @if(($class_section->section_id) != '0')
                                                        - {{$class_section->sections->section_name}}                                                                                      
                                                    @endif </td>
                                                <td><a  @if(Session::get('edit')==1) href="{{ ('add-class-teacher/'.$class_section->id) }}" @endif> <button class="btn txt-color-white btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif> Assign </button><br>@foreach($teachers as $teacher) @if($teacher->class_section_id == $class_section->id )  {{$teacher->teachers->first_name}}@endif @endforeach</a> </td>
                                                
                                                @if (($class_section->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i> Active </span> </td>
                                                @else 
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                @endif


                                                <td><div class="btn-group">
                                                        <a @if(Session::get('edit')==1) href="{{ url('edit-class-section/'.$class_section->id )}}" @endif title="Edit"><button class="btn btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil" ></span></button></a>
                                                        
                                                    </div>
                                                

                                                @if (($class_section->status) == 1)
                                                
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" @if(Session::get('edit') ==1) href="{{url('make-inactive-class-section/'.$class_section->id)}}" @else disabled @endif>
                                                       <i class="fa fa-times" > </i>
                                                    </a>
                                                
                                                @else 
                                                
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" @if(Session::get('edit') ==1) href="{{url('make-active-class-section/'.$class_section->id)}}" @else disabled @endif>
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
                                @else                                                                                                          
                                <h3 style="text-align: center;font-family: sans-serif;">You don't have permission to access this service.Please contact administrator.</h3>
                                @endif   
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
