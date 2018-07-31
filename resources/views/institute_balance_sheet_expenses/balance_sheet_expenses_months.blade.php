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
                <li ><a href="{{url ('balance-sheet-payments-academic-years')}}">Payments</a></li> 
                <li class="active"><a href="{{url ('balance-sheet-expenses-academic-years')}}">Expenses</a></li> 
                <li><a href="{{url ('balance-sheet-total-academic-years')}}">Total</a></li>
            </ul>
        </div><br>
        <div class="row">
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="col-sm-12 col-md-12 col-lg-3">
                    @include('institute_balance_sheet_expenses.include_expenses_year')

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-calendar-minus-o"></i> </span>
                            <h2>View Months</h2>

                            <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('balance-sheet-expenses-academic-years')}}" style="margin-top: 5px;margin-right: 5px;"><i class="fa fa-arrow-left"></i>  BACK</a>
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
                                                    <input type="text"  class="form-control" placeholder="Month-Year" />
                                                </th>
                                                <th class="hasinput" style="width:10%">
                                                    <input type="text"  class="form-control" placeholder="Total Amount" />
                                                </th>
                                            </tr>
                                            <tr>
                                                <th data-sortable="true">S No</th>
                                                <th data-sortable="true">Month-Year</th>
                                                <th data-sortable="true">Total Amount</th>

                                            </tr>
                                        </thead>
                                        <tbody>                                     
                                            <?php
                                            $i = 1;
                                            $total = 0;
                                            foreach ($months as $month) {
                                                if ($months != '') {
                                                    $total +=$month->total_amount;
                                                }
                                                ?>      

                                                <tr class="">      
                                                    <td>{{$i}}</td>
                                                    <td><a href="{{url('balance-sheet-expenses-day/'.$years[0]->ac_id.'/'.$month->year.'/'.$month->month)}}">{{$month->month}} - {{$month->year}}</a></td>
                                                    <td><a>&#8377; {{$month->total_amount}}</a></td>                                                
                                                </tr>

                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            @if($months !='')      <tr><td><i>Academic Year : {{$years[0]->start_year}} - {{$years[0]->end_year}}</i></td><td>Total Expenses</td><td><i> &#8377; {{ $total }} </i></td></tr>@endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="jarviswidget" id="wid-id-6" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-editbutton="false" data-widget-sortable="false">
                        <header>
                            <h2>Expenses Pie Chart </h2>				
                        </header>
                        <div>
                            <div class="widget-body">
                                <canvas id="pieChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
@include('include.footer')
<script type="text/javascript">

    $(document).ready(function () {
        pageSetUp();

        $.ajax({
            type: 'GET',
            url: '/balance-sheet-expenses-chart',
            dataType: 'json',
            success: function (data) {
                var p_labels = data.labels;
                var payment_data = data.expenses;
                console.log(p_labels);
                console.log(payment_data);
                // }});
                var PieConfig = {
                    type: 'pie',
                    data: {
                        datasets: [{
                                data: payment_data,
                                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"]
                            }],
                        labels: p_labels
                    },
                    options: {
                        responsive: true
                    }
                };
                window.onload = function () {
                    window.myPie = new Chart(document.getElementById("pieChart"), PieConfig);
                };
            }});

    });

</script>