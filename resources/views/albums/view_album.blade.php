@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Albums</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
             <ul class="nav nav-tabs">
                <li class="active"><a href="{{url ('view-albums')}}">Albums Title</a></li>
                <li><a href="{{url ('view-gallery')}}">Gallery</a></li>
                 <li><a href="{{url ('view-videos')}}">Videos</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> View  Albums </h2>
                        @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('add-album')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
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
                                                <input type="text" class="form-control" placeholder="Album Title" />
                                            </th>
                                            <th class="hasinput" style="width:8%">
                                                <input type="text" class="form-control" placeholder="description" />
                                            </th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                           
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="status" />
                                            </th>
                                             <th class="hasinput" style="width:6%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                           
                                            @endif
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No </th>
                                            <th data-sortable="true">Album Title</th>
                                            <th data-sortable="true">description</th>
                                            @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                            
                                            <th>Status</th>
                                          <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                  <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($albums as $album) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$album->album_title}}</td>
                                                 <td>{{$album->album_description}}</td>
                                                  @if (($album->status) == 1)
                                                <td><span class="label label-success"><i class="ace-icon fa fa-check bigger-120"></i>  Active </span> </td>
                                                @else
                                                 <td><span class="label label-danger" ><i class="fa fa-times bigger-120"></i> Inactive </span></td>
                                                @endif
                                                 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <td><div class="btn-group">
                                                        <a href="{{ url('edit-album/'.$album->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                      @if(Session::get('user_type_id') ==1)
                                                        <a href="{{ url('delete-album/'.$album->id) }}" onclick="return confirm('Are you sure to delete Album titles?');" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></a>
                                                    @endif
                                                    </div> 
                                                @if (($album->status) == 1)
                                                
                                               <a class="btn bg-color-yellow txt-color-white btn-xs" href="{{url('make-inactive-album/'.$album->id)}}" title="Make private">
                                                        <i class="fa fa-times" > </i>
                                                    </a>
                                              
                                                @else 
                                               
                                                <a class="btn bg-color-blue txt-color-white btn-xs" href="{{url('make-active-album/'.$album->id)}}" title="Make public">
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                              
                                                @endif           
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
