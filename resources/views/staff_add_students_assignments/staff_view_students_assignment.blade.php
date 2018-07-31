@include('include.header')
<style> #error-message{margin-left:158px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Assignment</li><li>Class</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('staff-get-students-assignments')}}">Add Assignment</a></li>
                <li class="active"><a href="{{url ('staff-view-class-assignments')}}">View Assignments</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">               
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>View Class Assignments</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('staff-get-students-assignments')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Add</a>

                    </header>                    
                    <div>                                                                 
                        <div class="widget-body no-padding">
                            <div class="table-responsive">

                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:3%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Title" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Description" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Assignment sheet" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control"  placeholder="Submission date" />
                                            </th>

                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" readonly placeholder=" Edit" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Title</th>
                                            <th data-sortable="true">Description</th>
                                            <th data-sortable="true">Assignment sheet</th>  
                                            <th data-sortable="true">Submission date </th>
                                            <th data-sortable="true">Edit </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($assignments as $assignment) {
                                            ?> 
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td> {{$assignment->classes->class_name}} @if($assignment->section_id > 0) - {{ $assignment->sections->section_name}} @endif <br> {{$assignment->subjects->subject_name}} </td>
                                                <td>{{$assignment->assignment_title}}</td>
                                                <td>{{$assignment->assignment_description}}</td>
                                                <td><a @if($assignment->assignment_file !='') href="{{url('uploads/assignments/'.$assignment->assignment_file)}}" @endif target="_blank">@if($assignment->assignment_file !='')<img src="{{URL::asset('uploads/assignments/'.$assignment->assignment_file)}}" height="50" width="50"> @else No Document @endif </a></td>
                                                <td>{{$assignment->last_date}}</td>
                                                <td><div class="btn-group">
                                                        <a href="{{ url('staff-edit-assignment/'.$assignment->id)}}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                    
                                                    </div></td>
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
            </article>
        </div>
    </div>
</div>
@include('include.footer')