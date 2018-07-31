@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Log History</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ url('log-history')}}">Log History</a></li>
                <li><a href="{{ url('log-details') }}">Log Details</a></li>
            </ul>
        </div><br>
        <div class="form-inline pull-left">
            <div class="form-group">
                Search :
            </div>
            <div class="form-group">
                <form  role="form" method="GET"  action="{{ url('log_history_search')}}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" size="20"  id="form-field-1" class="form-control" placeholder="Search for Log History"  name="search" value="<?php
                        if (null !== (filter_input(INPUT_GET, 'submit'))) {
                            echo $value;
                        }
                        ?>"  />
                    </div>
                    <button class="btn btn-info btn-sm" type="submit" name="submit">
                        <i class="glyphicon glyphicon-search"></i> 
                    </button>
                </form>
            </div>
            <div class="form-group">
                <form   method="GET"  action="{{ url('log-history') }}">
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
                        <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                        <h2>View Log History </h2>
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
                                                <input type="text" class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:18%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:7%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control"  placeholder="Search" />
                                            </th>
                                            <th class="hasinput" style="width:16%">
                                                <input type="text"  class="form-control"  placeholder="Search" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="col-md-1" data-sortable="true">Login Type</th>
                                            <th class="col-md-1" data-sortable="true">IP Address</th>                                            
                                            <th class="col-md-1" data-sortable="true">Browser</th>
                                            <th class="col-md-1" data-sortable="true">User Name</th>
                                            <th class="col-md-1" data-sortable="true">Login Time</th>
                                            <th class="col-md-1" data-sortable="true">Logout Time</th>
                                            <th class="col-md-1" data-sortable="true">Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($logs as $log) {
                                            ?> 
                                            <tr class="">
                                                <td>{{ $log->log_type }}</td> 
                                                <td>{{ $log->ip_address }}</td>
                                                <td>{{ $log->user_browser }}</td>
                                                <td>{{ $log->user_logins->user_name }}</td>                                             
                                                <td>{{  $log->log_in }}</td>
                                                <td>{{ $log->log_out }}</td>
                                                <td>{{$log->created_at->format('l jS \\of F Y h:i:s A')}}</td>
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
