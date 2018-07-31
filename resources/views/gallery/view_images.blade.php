@include('include.header')
@include('include.navigationbar')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
    function delete_image(id) {
        if (!confirm("Are you sure to delete image?")){
      return false;
    }
        var id1 = id.split("/");
        var image_id = id1[0];
        var album_id = id1[1];
        //alert(image_id);
        $.ajax({
            type: 'GET',
            url: '/delete-image/' + album_id + '/' + image_id,
            dataType: 'json',
            success: function (data, status) {
                //alert(data);
                console.log(data);
                location.reload();
            }
        });
    }
</script>
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Gallery</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                <li ><a href="{{url ('view-albums')}}">Album Title</a></li>
                @endif
                <li class="active"><a href="{{url ('view-gallery')}}">Gallery</a></li>
                <li><a href="{{url ('view-videos')}}">Videos</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View {{$images[0]->albums->album_title}} images</h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-gallery')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-gallery')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-arrow-left"></i> Back </a>
                    </header>
                    <div>
                        <br>
                        <div class="jarviswidget-editbox">
                        </div>

                        <div class="widget-body no-padding">
                            <div class="table-responsive">


                                @foreach($images as $image)

                                <div class="col-md-3">

                                    <div class="thumbnail" >
                                        <div id="first">
                                             @if(Session::get('user_type_id') == 1)
                                            <span class="close" id="{{$image->id.'/'.$image->album_id}}" onclick="delete_image(this.id);">&times;</span>
                                            @endif
                                            <a href="{{ asset('uploads/gallery/'.$image->albums->foldername.'/'.$image->images) }}" class="html5lightbox" data-group="mygroup" data-thumbnail="" title=""><img style='height:160px; width:240px;' src="{{URL::asset('uploads/gallery/'.$image->albums->foldername.'/'.$image->images)}}"></a>
                                        </div>
                                        <div id="second">
                                        </div>
                                    </div>
                                </div>                       
                                @endforeach                       
                            </div>
                        </div>
                    </div>
                </div>        
            </article>
        </div>
    </div>
</div>
@include('include.footer')
