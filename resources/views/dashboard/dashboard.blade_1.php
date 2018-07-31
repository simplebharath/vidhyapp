@include('include.header')
@include('include.navigationbar')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = new google.visualization.arrayToDataTable([
    ['Move', 'Students'],
<?php
foreach ($class_total1 as $data) {
    echo "['" . $data->class_name . "'," . $data->class_total . "],";
}
?>

    ]);
    var options = {
    title: 'Classes',
            width: 500,
            legend: { position: 'none' },
            chart: { subtitle: 'Number of Students' },
            axes: {
            x: {
            0: { side: 'bottom', label: ''} // Top x-axis.
            }
            },
            bar: { groupWidth: "30%" }
    };
    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
    };
    
</script>
<style>


    h3 { 
        position: absolute; 
        top: 20px; 
        left: 0; 
        width: 100%; 
    }
</style>
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Dashboard</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <!-- END RIBBON -->


    <!--        <div class="widget-body">-->
    <?php foreach ($institute as $institutes) { ?>
        <!--            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-md-1"></div><div class="col-md-9">-->
        <!--                    <h1 style="color: #fff ; font-size: 25pt; font-family: Monospace;background-color:  #afad62   ;text-align: center;">{{ $institutes->institution_name }}</h1></div>-->
        <div style="background-color: #afad62;margin:0px 0px 0px 0px;padding: 0px 0px 0px 0px;width: 100%;"><p style="color: white;text-align: center;font-family: sans-serif;font-size: 32px;">{{ $institutes->institution_name }}</p></div>
    <?php } ?>
    <div id="content">
        <div class="row no-space">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="clearfix"> </div>
                <div class="col-md-1 widget widget1"></div>
                <?php foreach ($students as $student) { ?>
                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <a href="{{('view_students')}}">
    <!--                                        <i class="pull-left fa fa-graduation-cap fa-2x"></i>-->
                                <div class="image">
                                    <img src="{{ URL::asset('assets/img/dashboard/stu_logo2.png') }}" width="80" height="80">
                                    <h3><strong><?php echo $student->numberofstudents; ?></strong></h3>
                                </div>
                                <div class="stats">
                                    <span>Students</span>
                                </div>
                            </a>

                        <?php } ?>
                    </div>
                </div>

                <?php foreach ($staffs as $staff) { ?>
                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <a href="{{('view_staff')}}">
    <!--                                        <i class="pull-left fa fa-male fa-2x"></i>-->
                                <img src="{{ URL::asset('assets/img/dashboard/user2.jpg') }}" width="80" height="80">
                                <div class="stats">
                                    <h3><strong><?php echo $staff->staff; ?></strong></h3>
                                    <span>Staff</span>
                                </div></a>
                        <?php } ?>
                    </div>
                </div>

                <?php foreach ($classes as $class) { ?>
                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <a href="{{('view_classes')}}">
    <!--                                        <i class="pull-left fa fa-book fa-2x"></i>-->
                                <img src="{{ URL::asset('assets/img/dashboard/class.png') }}" width="80" height="80">
                                <div class="stats">
                                    <h3><strong><?php echo $class->class; ?></strong></h3>
                                    <span>Classes</span></div></a>
                            <!--                                        <a href="{{('view_classes')}}">
                            <?php foreach ($sections as $section) { ?>
                                                                                                                                                                            <h5><strong><?php echo $section->section; ?></strong></h5>
                                                                                                                                                                            <span>Sections</span></a>-->

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php foreach ($buses as $bus) { ?>
                    <div class="col-md-2 widget widget1">
                        <div class="r3_counter_box">
                            <a href="{{('viewbuses')}}">
    <!--                                        <i class="pull-left fa fa-bus fa-2x"></i>-->
                                <img src="{{ URL::asset('assets/img/dashboard/bus-icon.png') }}" width="80" height="80">
                                <div class="stats">
                                    <h3><strong><?php echo $bus->bus; ?></strong></h3>
                                    <span>Buses</span>
                                </div></a>
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <?php foreach ($users as $user) { ?>
                        <div class="col-md-2 widget widget1">
                            <div class="r3_counter_box">
                                <a href="{{('view_users')}}">
    <!--                                            <i class="pull-left fa fa-users fa-2x"></i>-->
                                    <h3><strong><?php echo $user->user; ?></strong></h3>
                                    <img src="{{ URL::asset('assets/img/dashboard/network.png') }}" width="80" height="80">

                                    <div class="stats">

                                        <span>Users</span>
                                    </div></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
    <!-- Dashboard search    -->
    <!--        <div class="col-md-10 ">
                <div class="form-group">
                    <form  role="form" method="GET"  action="{{ url('dashboard_search')}}">
                        {{ csrf_field() }}
                        <div class="col-md-2"></div>
                        <div class="form-group-lg">
                            <input type="text" style="height:45px;font-size:12pt;"  id="form-field-1" placeholder="Search for Students by AdmissionNumber,RollNumber,Name,Email" name="search" value="" class="col-md-8" />
                        </div>
                        <button class="btn btn-info btn-lg"  type="submit" name="submit">
                            <i class="glyphicon glyphicon-search"></i>
                            search
                        </button>
                    </form>
                </div> </div>-->
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div id="top_x_div" style="width: 500px; height: 350px;"></div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-plus-square" aria-hidden="true"></i> </span>
                    <h2>Students </h2>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body no-padding">
                        <div class="table-responsive">
                            <table id="connection-table"data-toggle="table" class="table table-condensed table-striped" 
                                   data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="" data-search="" >
                                <thead>
                                    <tr>
                                        <th> Class</th>
                                        <th>No. of Students</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($class_total as $classes_vice) { ?>
                                        <tr class="">
                                            <td><a href="{{url('class_details/'.$classes_vice->class_id)}}">{{ $classes_vice->class_name }}</a></td>
                                            <td><?php echo $classes_vice->class_total; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div></div>
        <div class="col-md-0"></div>
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">

            <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-plus-square" aria-hidden="true"></i> </span>
                    <h2>Staff</h2>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body no-padding">
                        <div class="table-responsive">
                            <table id="connection-table"data-toggle="table" class="table table-condensed table-striped" 
                                   data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="" data-search="" >
                                <thead>
                                    <tr>
                                        <th> Type</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($staff_total as $staff) { ?>
                                        <tr class="">
                                            <td><a href="{{url('view_staff_type/'.$staff->staff_type_id)}}">{{ $staff->staff_type_title }}</a></td>
                                            <td>{{ $staff->count }}</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div></div>

@include('include.footer')