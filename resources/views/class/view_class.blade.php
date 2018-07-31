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
                <li  class="active"><a href="{{url ('view-classes')}}">Classes</a></li>
                <li><a href="{{url ('view-sections')}}">Sections</a></li>
                <li ><a href="{{url ('view-subjects')}}">Subjects</a></li>
                <li ><a href="{{ url('view-class-sections')}}">Class-Sections</a></li>
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
                        <h2>View Classes</h2>
                        @if(Session::get('add') == 1) <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-class')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @else
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right disabled" href="{{url('add-class')}}"  style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a> @endif
                        
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                 @if(Session::get('view') == 1)
                                <table id="datatable_fixed_column" class="classes table table-condensed table-bordered" width="100%">
                                <thead>
                                    <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Enter class" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Enter status" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                    </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Class</th>
                                                          
                                            <th>Status</th>
                                           <th>Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($classes as $class) {
                                            ?> 
                                            <tr class="">
                                                <td class="col-md-1"> {{$i}}</td>
                                                <td>{{$class->class_name}}</td>
                                                 @if (($class->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i> Active </span> </td>
                                                 @else 
                                                <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                @endif
                                                
                                                <td>
                                                    <div class="btn-group">
                                                        @if(Session::get('edit') == 1)   <a href="{{ url('edit-class/'.$class->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>@else
                                                        <a href="#" class="disabled" title="Edit"><button class="btn btn-primary btn-xs disabled" data-title="Edit" data-toggle="#" data-target="#" disabled=""><span class="glyphicon glyphicon-pencil"></span></button></a>@endif
                                                        
                                                    </div>
                                             

                                               @if(Session::get('edit') == 1 && ($class->status == 1))
                                                    
                                                    <a class="btn bg-color-yellow txt-color-white btn-xs "  href="{{url('make-inactive-class/'.$class->id)}}" title="Make inactive">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                    @endif
                                               
                                                   @if(Session::get('edit') == 1 && ($class->status == 0))
                                                   
                                                   <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-class/'.$class->id)}}" title="Make active">
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
