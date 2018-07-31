<div class="well well-light well-sm no-margin no-padding">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-9">
                    <h2 style="padding-left: 0px;"> <span class="semi-bold">Academic year </span>
                        <br>
                        <small>{{$years[0]->start_year}} - {{$years[0]->end_year}}</small>
                    </h2>

                    <ul class="list-unstyled">
                        @if($days == '')
                        @if($each_day == '')
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$years[0]->start_date}} to {{$years[0]->end_date}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar-plus-o"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$years[0]->start_month}} - {{$years[0]->start_year}} to {{$years[0]->end_month}} - {{$years[0]->end_year}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        @endif
                        @endif
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-rupee"></i>&nbsp;&nbsp;<span class="txt-color-darken">Total Balance <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Total Payments for this academic year"> <b> &#8377; {{$total_balance}} </a></span>
                            </p>
                        </li>
                    </ul>

                </div>                                            
            </div>
          
          
        </div><hr>
    </div>
</div>