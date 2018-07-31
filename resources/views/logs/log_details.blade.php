@include('include.header')
@include('include.navigationbar')
<style>
    .tabledata{
        word-wrap: break-word;
    }
</style>
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Log Details</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <ul class="nav nav-tabs">
            <li ><a href="{{ url('log-history')}}">Log History</a></li>
            <li class="active"><a href="{{ url('log-details') }}">Log Details</a></li>
        </ul>
        <div class="form-inline pull-left">
            <div class="form-group">
                Search :
            </div>
            <div class="form-group" >
                <form  role="form" method="GET"  action="{{ url('log_details_search')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" size="20" class="form-control" id="form-field-1" placeholder="Search for Log Details" name="search" value="<?php
                        if (null !== (filter_input(INPUT_GET, 'submit'))) {
                            echo $value;
                        }
                        ?>" class="col-xs-5 col-sm-12" />
                    </div>
                    <button class="btn btn-info btn-sm" type="submit" name="submit">
                        <i class="glyphicon glyphicon-search"></i> 
                    </button>
                </form>
            </div>
            <div class="form-group">
                <form   method="GET"  action="{{ url('log-details') }}">
                    <button class="btn btn-info btn-sm" type="submit" name="" >
                        <span class="glyphicon glyphicon-refresh"></span>
                    </button>
                </form>
            </div>
        </div><br><br>
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                        <h2>View Log Details </h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="datatable_fixed_column" class="table table-condensed table-bordered" width="100%">
                                    <thead> 
                                        <tr>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:20%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:5%">
                                                <input type="text"  class="form-control"  placeholder="Search" />
                                            </th>
                                           

                                        </tr>
                                        <tr>
                                            <th class="col-md-1" data-sortable="true">Log Type</th>                                         
                                            <th class="col-md-2" data-sortable="true">Existing</th>
                                            <th class="col-md-2" data-sortable="true">Changed to</th>                                           
                                            <th class="col-md-1" data-sortable="true">Created By</th>
                                            <th class="col-md-1" data-sortable="true">Created On</th>
                                            <th class="col-md-1" data-sortable="true">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($logs as $log) {
                                            ?> 
                                            <tr class="tabledata">
                                                <td>{{$log->log_type }}</td>                                               
                                                <td>{{$log->old_value }}</td>
                                                <td>{{ $log->new_value }}</td>                                              
                                                <td>{{$log->user_logins->user_name}}</td>
                                                <td>{{$log->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                                <td>{{ $log->message }}</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-right">
                                </div>
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
