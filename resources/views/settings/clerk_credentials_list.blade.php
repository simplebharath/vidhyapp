@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >
    <!-- RIBBON -->
    <div id="ribbon" >
        <!-- breadcrumb -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings Management</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- row -->

        <!DOCTYPE html>
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{ url('password_settings')}}">Students</a></li>
                <li ><a href="{{ url('parent_credentials_list') }}">Parents</a></li>
                <li ><a href="{{ url('staff_credentials_list') }}">Staff</a></li>
                <li ><a href="system_admin_credentials_list">System Admin</a></li>
                <li class="active"><a href="{{ url('clerk_credentials_list') }}">Clerk</a></li>
            </ul>
        </div>
        <div class="row">

            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @if(Session::has('clerk_password_change'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Success!</strong> {{ Session::get('clerk_password_change') }}
                </div>
                @endif
                {{ Session::forget('clerk_password_change') }}
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Clerk Credentials Change </h2>

                    </header>
                    <!-- widget div-->
                    <div>
<!--                        <div class="form-inline text-left">
                <div class="form-group">
                    <form  role="form" method="get"  action="{{ url('userssearch')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="" for="form-field-1">Enter Search String:</label>
                            <input type="text"  id="form-field-1" placeholder="Search for Users" required  name="search" value="<?php
        if (null !== (filter_input(INPUT_GET, 'submit'))) {
            echo $value;
        }
        ?>" class="" />
                        </div>
                        <button class="btn btn-info btn-sm" type="submit" name="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>
                </div>
                <div class="form-group">
                    <form   method="get"  action="{{ url('view_users') }}">
                        <button class="btn btn-info btn-sm" type="submit" name="" >
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </form>
                </div>

            </div><br>-->
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <div class="table-responsive">
                                <table id="connection-table"data-toggle="table" class="table table-condensed " 
                                       data-sort-name="SNo" data-sort-order="desc" data-row-style="rowStyle" data-show-columns="" data-search="" >
                                    <thead>
                                        <tr>
                                            <th data-sortable="true">Profile Picture</th>
                                            <th data-sortable="true">Name</th>
                                            <th data-sortable="true">Email</th>
                                            <th data-sortable="true">Contact Number</th>
                                            <th >Actions</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($users as $user) {
                                            ?> 
                                            <tr class="">
                                               <td><img src='{{ asset('uploads/'.$user->photo) }}' onerror="this.onerror=null;this.src='{{ asset('uploads/2016-09-23-15-04-17-icon1.jpg') }}'" class="img-rounded" height="75" width="75"/></td>
                                                <td><?php echo $user->first_name . " " . $user->last_name; ?></td>
                                                <td><?php echo $user->email_id; ?></td>
                                                <td><?php echo $user->contact_number; ?></td>
                                                <td ><div class="btn-group">
                                                     <a href="{{ ('clerk_credentials_change/'.$user->user_id) }} " ><button class="btn btn-default btn-primary"  ><span class="glyphicon glyphicon-retweet"></span>&nbsp;Change Credentials</button></a>
                                                    </div></td>


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

                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN PANEL -->
@include('include.footer')
