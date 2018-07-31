@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Parent</li><li>Message</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
        <ul class="nav nav-tabs">
                <li  class=""><a href="{{url ('add-message')}}">Compose Message</a></li>
                <li  class="active"><a href="{{url ('view-messages')}}"> View Sent Messages</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2> Sent Messages </h2>
                        
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
                                            <th class="hasinput" style="width:12%">
                                                <input type="text" class="form-control" placeholder="Subject" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text" class="form-control" placeholder="Message" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Date" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" readonly="" class="form-control" placeholder="Actions" />
                                            </th>
                                            
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="status" />
                                            </th>
                                    </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Subject</th>
                                            <th data-sortable="true">Message</th>
                                            <th data-sortable="true">Date</th>
                                            <th>Actions</th>
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
                                                <td>{{$message->subject}}</td>
                                                <td>{{$message->message}}</td>
                                             
                                                <td>{{$message->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td>@if (($message->status) == 1)
                                                    <div class="btn-group">
                                                        <a href="{{ url('edit-message/'.$message->id) }}"title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a>
                                                        
                                                    </div>@else <span class="label label-warning" ><i class="fa fa-check bigger-120"></i> Message Read </span>
                                                    @endif
                                                </td>
                                                @if (($message->status) == 1)
                                                <td><span class="label label-success" > Message sent <i class="fa fa-check bigger-120"></i></span> <br><br>
                                                    <span class="label label-danger"><i class="ace-icon fa fa-inbox bigger-120"></i>  Unread </span> </td>
                                                
                                                </td> 
                                                  @else 
                                                <td><span class="label label-success" > Message sent <i class="fa fa-check bigger-120"></i></span></td>
                                               
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
