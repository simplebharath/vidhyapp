@include('include.header')
@include('include.navigationbar')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
    function delete_video(id) {
        if (!confirm("Are you sure to delete video?")) {
            return false;
        }
        var id1 = id.split("/");
        var video_id = id1[0];
        //var album_id = id1[1];
        //alert(image_id);
        $.ajax({
            type: 'GET',
            url: '/delete-video/' + album_id + '/' + image_id,
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
                <li><a href="{{url ('view-gallery')}}">Gallery</a></li>
                <li class="active"><a href="{{url ('view-videos')}}">Videos</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-video-camera"></i> </span>
                        <h2> View Videos</h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-video')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                        @endif
                    </header>
                    <div>
                        <br>
                     
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                @if((Session::get('user_type_id')==1))
                                @foreach($videos as $video)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="thumbnail" >
                                            <div id="first">
                                                <iframe width="550" height="440"
                                                        src="{{URL::asset('http://www.youtube.com/embed/'.$video->video)}}">
                                                </iframe></div>
                                            <div id="second">
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                                                <header>
                                                    <span class="widget-icon"> <i class="fa fa-video-camera"></i> </span>
                                                    <h2> Edit Video</h2>
                                                    @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3)
                                                    <a type="button" class="btn btn-xs btn-danger pull-right" href="{{url('delete-video/'.$video->id)}}" onclick="return confirm('Are you sure to delete video?')" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                                    @endif
                                                </header>
                                                <div>
                                                    <div class="widget-body no-padding"><br>

                                                        <form  class="form-horizontal" role="form"  enctype="multipart/form-data" method="POST" action="{{ url('do-update-video/'.$video->id) }}">
                                                            {{ csrf_field() }}                                       
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Video title :<span class="error"> * </span></label>                                               
                                                                    <div class="col-sm-8 input">
                                                                        <input type="text"  id="example1"  name="title" value="{{ $video->title }}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                                        <small class="help-block" style="clear:both;color:red;padding-bottom: 0px !important;margin-bottom: 0px !important;"> {{ $errors->first('title') }}</small>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Youtube Video Id :<span class="error">* </span></label>                                               
                                                                    <div class="col-sm-8 input">
                                                                        <input type="text"  id="example1"  name="video" value="{{ $video->video }}" class="date col-xs-10 col-sm-5 col-lg-8 col-mg-8"/>
                                                                        <small class="help-block" style="clear:both;color:red;padding-bottom: 0px !important;margin-bottom: 0px !important;"> {{ $errors->first('video') }}</small>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description<span class="error"> </span></label>
                                                                    <div class="col-sm-8">
                                                                        <textarea cols="40" rows="2" maxlength="160" wrap="soft" class="col-xs-10 col-sm-5 col-md- col-lg-8" placeholder="" name="description" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $video->description }}</textarea>
                                                                    </div>
                                                                    <div style="color: red;" id="error-message">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                </div>
                                                                <div style="margin-left:36%">
                                                                    <button type="submit" class="width-10 btn btn-md btn-success">
                                                                        <i class="ace-icon fa fa-check"></i>
                                                                        <span class="bigger-110">Update</span>
                                                                    </button>


                                                                </div><br>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                        </article>
                                    </div> 

                                    <div class="col-md-6">
                                        <form  class="form-horizontal" role="form"  enctype="multipart/form-data" method="POST" action="{{ url('change-access-status/'.$video->id) }}">
                                            {{ csrf_field() }}     
                                            <input type="hidden" name="public" value="{{$video->status}}">
                                            <div style="margin-left:36%">
                                                <button type="submit" @if($video->status == 1) class="width-10 btn btn-md btn-info" @else class="width-10 btn btn-md btn-danger" @endif>
                                                        @if($video->status == 1)  <i class="ace-icon fa fa-check"></i> @else  <i class="ace-icon fa fa-times"></i> @endif
                                                    <span class="bigger-110">@if($video->status == 1) Make Private @else Make public @endif</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                @endforeach       


                                <div style="float:right;">{{ $videos->links() }}</div>
                            </div>
                            @endif

                            @if((Session::get('user_type_id')!=1))
                            @foreach($videos as $video)
                            @if($video->status == 1)
                            <div class="col-md-6">
                                <iframe width="550" height="440"
                                        src="{{URL::asset('http://www.youtube.com/embed/'.$video->video)}}">
                                </iframe>                               
                            </div>
                            @endif
                            @endforeach       
                           
                        </div>
                             <div>{{ $videos->links() }}</div>
                        @endif



                    </div>
                </div>
        </div>        

        </article>

    </div>

</div>

</div>
@include('include.footer')