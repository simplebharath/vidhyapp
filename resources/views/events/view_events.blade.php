@include('include.header')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Events</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
             <ul class="nav nav-tabs">
                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                <li><a href="{{url ('view-event-titles')}}">Event Titles</a></li>
                @endif
                <li class="active"><a href="{{url ('view-events')}}">Events</a></li>
                <li><a href="{{url ('view-event-albums')}}">Event Albums</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Events </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-event')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Event Title" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Start Time" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="End Time" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Venue" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="description" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="Event Poster" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            
                                            <th class="hasinput" style="width:7%">
                                                <input type="text" class="form-control" placeholder=" Images" />
                                            </th>
                                           <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No </th>
                                            <th data-sortable="true">Event Title</th>
                                            <th data-sortable="true">Start Time </th>
                                            <th data-sortable="true">End Time</th>
                                            <th data-sortable="true">Venue</th>
                                            <th data-sortable="true">Description</th>
                                            <th data-sortable="true">Event Poster</th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            
                                            <th>Images</th>
                                           <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($events as $event) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$event->events->title}}</td>
                                                <td>{{$event->start_time }}</td>
                                                <td>{{$event->end_time  }}</td>
                                                <td>{{$event->venue}}</td>
                                                <td>{{$event->description }}</td>
                                                <td><img @if($event->event_poster !="") src="{{URL::asset('uploads/events/'.$event->event_poster)}}" @else No Poster @endif onerror="this.onerror=null;this.src='{{ asset('uploads/errors/poster.png') }}'" height="50" width="50"></td>
                                                @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                
                                                <td><a  @if(Session::get('edit')==1) href="{{ ('add-event-album/'.$event->event_title_id) }}" @endif><button class="btn txt-color-white btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif> <i class="fa fa-plus"></i> Add </button></a>
                                                    <br> <br><a  @if(Session::get('edit')==1) href="{{ ('getimagesalls/'.$event->event_title_id) }}" @endif><button class="btn  btn-primary btn-xs" @if(Session::get('edit') !=1) disabled @endif> <i class="fa fa-eye"></i> View </button></a></td>
                                                    
                                                    <td><div class="btn-group">
                                                        <a href="{{ url('edit-event/'.$event->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-event/'.$event->id) }}" onclick="return confirm('Are you sure to delete Event Details?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                        @endif
                                                    </div>
                                                @if (($event->status) == 1)                                                                                              
                                               <a class="btn bg-color-yellow txt-color-white btn-xs" title="Make inactive" href="{{url('make-inactive-event/'.$event->id)}}">
                                                        <i class="fa fa-times" > </i> 
                                                    </a>
                                            
                                                @else 
                                               
                                                <a class="btn bg-color-blue txt-color-white btn-xs" title="Make active" href="{{url('make-active-event/'.$event->id)}}">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                              
                                                @endif
                                                    </td>
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
            </article>
        </div>
    </div>
</div>
@include('include.footer')
