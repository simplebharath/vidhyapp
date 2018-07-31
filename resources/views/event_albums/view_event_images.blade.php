@include('include.header')
@include('include.navigationbar')
<script>
    function delete_image(id) {
        if (!confirm("Are you sure to delete image?")) {
            return false;
        }
        var id1 = id.split("/");
        var image_id = id1[0];
        var event_title_id = id1[1];
        //alert(image_id);
        $.ajax({
            type: 'GET',
            url: '/delete-images/' + event_title_id + '/' + image_id,
            dataType: 'json',
            success: function (data, status) {
                 console.log(data);
                location.reload();
                 var option = "";
                var message = "Image successfully deleted.";
             //   option += "<p>" + message + "</p>"
               option +="<div class='alert alert-success fade in'><button class='close' data-dismiss='alert'></button><i class='fa-fw fa fa-check'></i><strong>"+ message +"</strong></div>";
              
                $('#message').html(option);
            }
        });
    }
</script>
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
                <div id="message"></div>
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View @if(COUNT($images)  != 0) {{$images[0]->event_title->title}} images @endif</h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-events')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>
                    <div>


                        @foreach($images as $image)
                        @if(COUNT($images)  != 0)
                        <div class="col-md-3">

                            <div class="thumbnail" >
                                <div id="first">
                                    @if(Session::get('user_type_id') ==1)
                                    <span title="Delete image" class="close" style="color:red;" id="{{$image->id.'/'.$image->event_title_id}}" onclick="delete_image(this.id);">&times;</span>
                                    @endif
                                    <a href="{{ asset('uploads/events/'.$image->event_title->foldername.'/'.$image->images) }}" class="html5lightbox" data-group="mygroup" data-thumbnail="" title=""><img style='height:160px; width:240px;' src="{{URL::asset('uploads/events/'.$image->event_title->foldername.'/'.$image->images)}}"></a>
                                </div>
                                <div id="second">
                                </div>
                            </div>
                        </div> 
                        @else
                        <div class="thumbnail" >
                            <div id="first">
                                <h2> No images to show</h2>
                            </div>
                            <div id="second">
                            </div>
                        </div>

                        @endif
                        @endforeach 

                    </div>
                </div>        
            </article>
        </div>
    </div>
</div>
@include('include.footer')
