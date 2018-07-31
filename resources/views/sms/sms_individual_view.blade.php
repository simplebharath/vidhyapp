@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>SMS</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('sms-credentials')}}">SMS Credentials</a></li>
                <li><a href="{{url ('sms-compose')}}">Class SMS </a></li>
                <li><a href="{{url ('sms-sent')}}">Sent SMS </a></li>
                <li class="active"><a href="{{url ('sms-individual-create')}}">Individual SMS </a></li>
            </ul>
        </div><br>

        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2> View Sent SMS </h2>
                         <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="#" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> SMS Credit: {{$institute[0]->sms_count}}</a>
                         <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('sms-individual-create')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-envelope"> </i> Create SMS</a>
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
                                                <input type="text" class="form-control" placeholder="S No" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Phone" />
                                            </th>
                                             <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Message" />
                                            </th>
                                             <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Sent At" />
                                            </th>
                                             <th class="hasinput" style="width:10%">
                                                <input type="text" class="form-control" placeholder="Sent By" />
                                            </th>
                                           
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S.No</th>
                                            <th data-sortable="true">Phone</th>
                                            <th data-sortable="true">Message</th>
                                            <th data-sortable="true">Sent At</th>
                                            <th data-sortable="true">Sent By</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($messages as $message) {
                                            ?> 
                                            <tr class="">
                                                <td> {{$i}} </td>
                                                <td>{{$message->phone}}</td>
                                                <td>{{$message->message}}</td>
                                                <td>{{date("d-M-Y h:i a",strtotime($message->created_at))}}</td>
                                               <td>{{$message->user_logins->user_name}}</td>
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
