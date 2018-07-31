@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Balance Sheet</li><li>Expenses</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('balance-sheet-payments-academic-years')}}">Payments</a></li>
                <li class="active"><a href="{{url ('balance-sheet-expenses-academic-years')}}">Expenses</a></li>
                 <li><a href="{{url ('balance-sheet-total-academic-years')}}">Total</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar-minus-o"></i> </span>
                        <h2>VIew All Academic years</h2>
                       
                    </header>
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
                                                <input type="text" class="form-control" placeholder="S no" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Academic year" />
                                            </th>
                                             <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Date From- To" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Month From- To" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Total Expenses" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>
                                            <th data-sortable="true">Academic year</th>
                                            <th data-sortable="true">Date From- To</th>
                                            <th data-sortable="true">Month From- To</th>
                                            <th data-sortable="true">Total Expenses</th>
                                             <th data-sortable="true">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                     
                                        <?php $i = 1;
                                        foreach ($years as $year) { ?>                                                                           
                                            <tr class="">      
                                                <td>{{$i}}</td>
                                                <td><a href="{{url('balance-sheet-expenses-months/'.$year->ac_id)}}">{{$year->start_year}} - {{$year->end_year}}</a></td>
                                                <td><a href="{{url('balance-sheet-expenses-months/'.$year->ac_id)}}">{{$year->start_date}} to {{$year->end_date}}</a></td>
                                                 <td>{{$year->start_month}} - {{$year->start_year}} to {{$year->end_month}} - {{$year->end_year}}</td>                                                              
                                                 <td>&#8377; {{$year->total}}</td>
                                                 <td>
                                                    <a class="btn btn-xs btn-info" href="{{url('balance-sheet-expenses-pdf/2/'.$year->id)}}"><i class="glyphicon glyphicon-file"></i></a>
                                                    <a class="btn btn-xs btn-info" href="{{url('balance-sheet-expenses-pdf/1/'.$year->id)}}" target="_blank"><i class="glyphicon glyphicon-print"></i></a>
                                                </td>
                                            </tr>
    <?php $i++;
} ?>
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
