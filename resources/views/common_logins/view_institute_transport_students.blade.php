@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Reports</li><li>Students</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('view-institute-students')}}">Students</a></li> 
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>View Transport students</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-institutes-student')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-users"></i> All Students</a>
                    </header>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <div class="col-sm-12"><br>                                         
                                        <div class="row" id="">
                                            <label class="col-sm-1"> </label>
                                            <form class="form-horizontal" action="{{url('view-institutes-transport-student')}}" enctype="multipart/form-data" method="POST">
                                                {{ csrf_field() }} 
                                                <div class="col-sm-2">
                                                    <select  name="class_section_id[]" multiple=""  class="">
                                                        <option value="">--- Select class---</option> 
                                                        @foreach($class_sections as $class_section)
                                                        <option value="{{$class_section->id}}" <?php
                                                        if ($classes_id != '') {
                                                            foreach ($classes_id as $classes_i) {
                                                                if ($classes_i == $class_section->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>>{{ $class_section->classes->class_name }}  @if(($class_section->section_id) != 0)  -  {{ $class_section->sections->section_name}}  @endif </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select  name="route_id[]" multiple=""  class="">
                                                        <option value="">--- vehicle route(s)---</option> 
                                                        @foreach($routes as $route)
                                                        <option value="{{$route->id}}" <?php
                                                        if ($route_id != '') {
                                                            foreach ($route_id as $route_i) {
                                                                if ($route_i == $route->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?> >{{ $route->route_title }} {{ $route->route_from }}  {{ $route->route_to }}</option>
                                                        @endforeach
                                                    </select>                                          
                                                </div>
                                                <div class="col-sm-2">
                                                    <select  name="stop_id[]" multiple="" class="">
                                                        <option value="">--- select stop(s)---</option> 
                                                        @foreach($stops as $stop)
                                                        <option value="{{$stop->id}}" <?php
                                                        if ($stop_id != '') {
                                                            foreach ($stop_id as $stop_i) {
                                                                if ($stop_i == $stop->id) {
                                                                    ?> selected="selected" <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?> >{{ $stop->stop_name }}  </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="width-1 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        <span class="bigger-110">Get students</span>
                                                    </button>
                                                </div>
                                                <div class="col-sm-">
                                                    <a href="{{url('view-institutes-transport-student')}}" class="width-10 btn btn-md btn-info">
                                                        <i class="ace-icon fa fa-refresh"></i>
                                                        <span class="bigger-110">Refresh</span>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>    
                                    </div>

                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly=""class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student Id" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                           
                                            <th class="hasinput" style="width:15%">
                                                <input type="text"  class="form-control" placeholder="Route" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text"  class="form-control" placeholder="Stops" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Student id</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Class-Roll No</th>
                                            <th data-sortable="true">Route </th>
                                            <th data-sortable="true">Stop</th>         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($students as $student) {
                                            ?> 
                                            <tr class="">
                                                <td><a ><img src="{{URL::asset('uploads/students/profile_photos/'.$student->photo)}}"  @if($student->gender = 'Male') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_male.png') }}'" @if($student->gender = 'Female') onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student_female.png') }}'" @endif  @endif height="50" width="50"></a>  </td>
                                                <td><a>{{$student->unique_id}}</a></td>
                                                <td>{{ $student->student_types->title }} <br><a href="#">{{$student->first_name}}  {{$student->last_name}}</a> </td>    
                                                <td>{{$student->classes->class_name}} @if($student->section_id >0) - {{$student->sections->section_name}} @endif -{{ $student->roll_number}}</td>
                                                <td>{{$student->routes->route_title}}<br> {{$student->routes->route_from}} - {{$student->routes->route_to}}</td>
                                                <td>{{$student->stops->stop_name}} <br> {{$student->stops->pickup_time}}- {{$student->stops->drop_time}}</td>
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
