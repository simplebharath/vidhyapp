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
                <li><a href="{{url ('view-staff-types')}}">Staff Types</a></li>
                <li><a href="{{url ('view-staff-departments')}}">Staff Departments</a></li>
                <li ><a href="{{url ('view-staff')}}">Staff</a></li> 
                <li class="active"><a href="{{url ('view-staff-subjects')}}">Staff subjects</a></li>
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
                        <h2>View Staff-Subjects</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-staff-subject')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                    </header>                    
                    <div>                     
                        <div class="jarviswidget-editbox">                          
                        </div>                       
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Staff type" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Department" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="staff name" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="class" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="subject" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Description" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Staff Type</th>
                                            <th data-sortable="true">Department</th>
                                            <th data-sortable="true">Staff Name</th>
                                            <th data-sortable="true">Class</th> 
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Description</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($staff_subjects as $staff_subject) {
                                            ?> 
                                            <tr class="">                                                 
                                                <td><span>{{$staff_subject->staff_types->title}}</span></td>
                                                <td><span>{{$staff_subject->staff_department->title}}</span></td>
                                                <td><span>{{$staff_subject->staff->first_name}} {{$staff_subject->staff->last_name}}</span></td>
                                                <td><span>{{$staff_subject->classes->class_name}}  @if ($staff_subject->section_id >0 ) {{$staff_subject->sections->section_name}} @endif </span> </td>
                                                <td><span>{{$staff_subject->subjects->subject_name}} </span></td>                  
                                                <td> {{ $staff_subject->description }} </td> 
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-staff-subject/'.$staff_subject->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                       
                                                        @if(Session::get('user_type_id') == 1)
                                                        <a href="{{ url('delete-staff-subject/' .$staff_subject->id)}}" onclick="return confirm('Are you sure to delete Staff subject.?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                        @if (($staff_subject->status) == 1)
                                                        
                                                        <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-staff-subject/'.$staff_subject->id)}}">
                                                                <i class="fa fa-times" > </i>
                                                            </a>
                                                     
                                                        @else 
                                                        
                                                       <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-staff-subject/'.$staff_subject->id)}}">
                                                                <i class="fa fa-check"> </i>
                                                            </a>
                                                       
                                                        @endif
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
