@include('include.header')
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon">
        <ol class="breadcrumb col-md-3">
            <li>Balance Sheet</li><li>Total Balance</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">
        <div class="">
            <ul class="nav nav-tabs">
                <li><a href="{{url ('balance-sheet-payments-academic-years')}}">Payments</a></li> 
                <li><a href="{{url ('balance-sheet-expenses-academic-years')}}">Expenses</a></li>
                <li class="active"><a href="{{url ('balance-sheet-total-academic-years')}}">Total</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">              
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar-minus-o"></i> </span>
                        <h2>View All Academic years</h2>
                        
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
                                                <input type="text"  class="form-control" placeholder="Payments" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Expenses" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Balance" />
                                            </th>
                                            <th class="hasinput" style="width:10%">
                                                <input type="text"  class="form-control" placeholder="Actions" />
                                            </th>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true">S No</th>
                                            <th data-sortable="true">Academic year</th>
                                            <th data-sortable="true">Payments</th>
                                            <th data-sortable="true">Expenses</th>
                                            <th data-sortable="true">Total Balance</th>
                                            <th data-sortable="true">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @if(COUNT($payments) !=0)
                                        <?php
                                        $i = 1;
                                        foreach ($years as $year) {
                                            ?>                                                                           
                                            <tr class="">      
                                                <td>{{$year->id}}</td>
                                                <td>{{$year->from_date}}  To {{$year->to_date}}</td>
                                            <?php foreach ($payments as $payment) { 
                                                $pay = $payment->total;
                                                $p_a_id=$payment->ac_id
                                                ?>                                              
                                                <td> <?php  if($payment->ac_id == $year->id) { ?><a href="{{url('balance-sheet-payments-months/'.$payment->ac_id)}}"> {{$payment->total}} </a> <?php }?> </td>
                                            <?php } ?>
                                            <?php foreach ($expenses as $expense) { $exp=$expense->total; $p_e_id=$expense->ac_id?>  
                                                
                                                <td> <?php  if($expense->ac_id == $year->id) { ?> <a href="{{url('balance-sheet-expenses-months/'.$expense->ac_id)}}">{{$expense->total}}</a> <?php }?> </td>
                                            <?php } ?>
                                          
                                                <td><?php  if($p_a_id ==  $year->id && $p_e_id ==  $year->id) { ?>
                                                    <a href="{{url('balance-sheet-total-months/'.$year->id)}}"> {{$pay - $exp}}</a>
                                                 <?php } ?>
                                              
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-info" href="{{url('balance-sheet-total-pdf/2/'.$year->id)}}"><i class="glyphicon glyphicon-file"></i></a>
                                                    <a class="btn btn-xs btn-info" href="{{url('balance-sheet-total-pdf/1/'.$year->id)}}" target="_blank"><i class="glyphicon glyphicon-print"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                            @endif
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
