@include('include.header')
@include('include.navigationbar')
<!-- MAIN PANEL -->
<div id="main" role="main" >
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb col-md-3 -->
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>User Profile</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div><br>
   
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
            <article class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="false">
                   
                    <header>
                        <span class="widget-icon">  </span>
                        <h2>User Profile</h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                       
                        <div class="widget-body no-padding">
                             <?php
                                        foreach ($users as $user) {
                                            ?> 
                            <div align="left">
                            <img src='{{ asset('uploads/'.$user->photo) }}' class="img-rounded" height="75" width="75"/>
                            </div>
                            <table class="table-borderless" align="center"> 
                                <tr><td>First Name:  </td> <td><?php echo $user->first_name; ?></td></tr>
                                <tr><td>Last Name:   </td> <td><?php echo $user->last_name; ?></td></tr>
                                <tr><td>Email Address:   </td> <td><?php echo $user->email_id; ?></td></tr>
                                <tr><td>Contact Number:   </td> <td><?php echo $user->contact_number; ?></td></tr>
                                <tr><td>Address:   </td> <td><?php echo $user->address; ?></td></tr>
                                <tr><td>Created Date:   </td> <td><?php echo $user->created_at; ?></td></tr>
                                <tr><td>Updated Date:   </td> <td><?php echo $user->updated_at; ?></td></tr>
                                </table>
                       
                            
                        </div
                                        <?php } ?>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->
            </article>
            <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3"></div>
            <!-- WIDGET END -->
        </div>
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
@include('include.footer')
