@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Parent</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                 <li  ><a href="{{url ('view-student-types')}}">Student Types</a></li>
                <li class="active"><a href="{{url ('view-students')}}">Students</a></li> 
                <li><a href="{{url ('view-students-attendance')}}">Attendance</a></li> 
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Parents </h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-student')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add Student</a>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-students')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View students</a>
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
                                                <input type="text" readonly=""class="form-control" placeholder="F - M" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Parent" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Credentials" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="student details" />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly="" class="form-control"  placeholder="Actions" />
                                            </th>
                                            
                                            

                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Father - Mother</th>
                                            <th data-sortable="true">Parent</th>
                                            <th data-sortable="true">Credentials</th>
                                             <th data-sortable="true">Student details</th>
                                            <th >Actions</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($parents as $parent) {
                                            ?> 
                                            <tr class="">
                                                <td><img src="{{URL::asset('uploads/students/father/'.$parent->father_photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/father.png') }}'" height="50" width="50"> <img src="{{URL::asset('uploads/students/mother/'.$parent->mother_photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/mother.png') }}'" height="50" width="50">  </td>
                                                <td>User type : {{$parent->user_types->title}}<br> Father  : @if (($parent->status) == 1)<span style="color:green;">@else <span style="color:red;"> @endif{{$parent->students->father_name}}</span> - {{$parent->students->father_number}}<br> Mother :  {{$parent->students->mother_name }} - {{ $parent->students->mother_number }} </td>                                                                                               
                                                <td>User name: {{$parent->user_logins->user_name}} <br> Password : {{$parent->user_logins->password}}</td>
                                                <td>Name: {{$parent->students->first_name}} {{$parent->students->last_name}} <br>Unique id: {{$parent->students->unique_id}} <br>Class : {{$parent->students->classes->class_name}} @if($parent->students->section_id >0) - {{ $parent->students->sections->section_name }}@endif  {{ $parent->students->roll_number }} </td>
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-parent/'.$parent->id )}}" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        <a href="{{ url('view-student-profile/'.$parent->student_id )}}" title="view"><button class="btn btn-info btn-xs" data-title="View" data-toggle="modal" data-target="#view" ><span class="glyphicon glyphicon-eye-open"></span></button></a>
                                                    </div>
                                             

                                                @if (($parent->status) == 1)
                                               
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-parent/'.$parent->id)}}">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                                
                                                @else 
                                               

                                                  <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-parent/'.$parent->id)}}">
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
