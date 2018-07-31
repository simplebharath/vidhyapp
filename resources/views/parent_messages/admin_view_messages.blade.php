@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Messages</li><li>Parent</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
        <ul class="nav nav-tabs">
                <li  class="active"><a href="{{url ('admin-view-messages')}}">View Messages</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Messages </h2>
                        
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                <thead>
                                    <tr>
                                            <th class="hasinput" style="width:6%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Image" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Father" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Student" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Class" />
                                            </th>
                                            <th class="hasinput" style="width:12%">
                                                <input type="text" class="form-control" placeholder="Subject" />
                                            </th>
                                            <th class="hasinput" style="width:15%">
                                                <input type="text" class="form-control" placeholder="Message" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Received On" />
                                            </th>
                                             @if(Session::get('user_type_id') ==1)
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            @endif
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="status" />
                                            </th>
                                            
                                    </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Image</th>
                                            <th data-sortable="true">Father</th>
                                            <th data-sortable="true">Student</th>
                                            <th data-sortable="true">Class</th>
                                            <th data-sortable="true">Subject</th>
                                             <th data-sortable="true">Message</th>
                                              <th data-sortable="true">Received On</th>
                                              @if(Session::get('user_type_id') ==1)
                                            <th>Actions</th>
                                            @endif
                                            <th>Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($messages as $message) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td><img src='{{URL::asset('uploads/students/father/'.$message->parents->father_photo)}}' onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'"  class="img-rounded" height="30" width="30" style="margin-top: 5px;" /></td>
                                                <td>{{$message->students->father_name}} {{$message->students->father_number}}</td>
                                                <td>{{$message->students->first_name}} {{$message->students->last_name}}</td>
                                                <td>{{$message->students->classes->class_name}}@if($message->students->section_id > 0) - {{$message->students->sections->section_name}} @endif - {{ $message->students->roll_number }}</td>
                                                <td>{{$message->subject}}</td>
                                                <td>{{$message->message}}</td>
                                                <td>{{$message->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td><div class="btn-group">
                                                         @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-message/'.$message->id) }}" onclick="return confirm('Are you sure to delete message?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div></td>
                                                @if (($message->status) == 1)
                                                <td><span class="label label-success"> <i class="fa fa-envelope-o"></i> New </span> <br> <br>
                                                <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-message/'.$message->id)}}">
                                                        <i class="fa fa-check" > </i> Read now
                                                    </a></td>
                                                
                                                  @else 
                                                  <td>
                                                <span class="label label-success" ><i class="fa fa-check bigger-120"></i> Read </span></td>
                                            
                                                  @endif                                                                                        
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
