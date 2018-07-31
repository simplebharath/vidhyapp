@include('include.header')
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
                <li><a href="{{url ('view-event-titles')}}">Event Title</a></li>
                @endif
                <li><a href="{{url ('view-events')}}">Events</a></li>
                <li class="active"><a href="{{url ('view-event-albums')}}">Event Albums</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View Event Albums </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-events')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                                @foreach($folders as $folder_names)
                                <div class="col-lg-2 col-md-4 col-sm-6">
                                    <a href='{{ url('getimagesalls/'.$folder_names->event_title_id)}}' class="thumbnail"><i  class="fa fa-folder-open" style='font-size:140px;color:orangered;'></i>
                                         <p align="center">{{$folder_names->event_title->title}}</p>
                                    </a>
                                </div>
                                @endforeach

                    </div>
                </div>        
            </article>
        </div>
    </div>
</div>
@include('include.footer')
