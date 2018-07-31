<div class="well well-light well-sm no-margin no-padding">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                    <img src="{{URL::asset('uploads/staff/'.$staffs[0]->photo)}}"  alt="" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/staff.jpg') }}'" height="70" width="70">
                    <div class="padding-10">
                       @if($no_classes != 0)   <h6 class="font-md"><strong>{{$no_classes}}</strong>
                            <br>
                            <small>Classes</small></h6>@endif
                    </div>
                </div>
                <div class="col-sm-9">
                    <h2 style="padding-left: 0px;"> <span class="semi-bold">{{$staffs[0]->first_name}} {{$staffs[0]->last_name}} </span>
                        <br>
                        <small>@if($staffs[0]->emp_designation != '') {{ $staffs[0]->emp_designation }} - @endif {{$staffs[0]->departments->title}}</small>
                    </h2>
 @if(Session::get('user_type_id') == 1 || Session::get('user_type_id') == 2)
                                                <a href="{{url('edit-staff/'.$staffs[0]->id)}}" title="Edit profile" class="btn txt-color-white bg-color-teal btn-xs"><i class="fa fa-edit"></i>  </a>
                                                <a href="{{url('view-staff')}}" title="View all staff" class="btn txt-color-white bg-color-pinkDark btn-xs"><i class="fa fa-eye"></i>  </a>

                                                @endif
                                                <a href="{{url('staff-summary-pdf/'.$staffs[0]->id)}}" title="Download report"
                                                   class="btn txt-color-white bg-color-blueDark btn-xs" ><i class="glyphicon glyphicon-download-alt"></i> </a>
                                                <a href="{{url('staff-summary-print/'.$staffs[0]->id)}}" target="_blank" title="Print report" 
                                                   class="btn txt-color-white bg-color-redLight btn-xs"><i class="glyphicon glyphicon-print"></i> </a>
                                                @if($staffs[0]->email !="") <a href="{{url('staff-summary-email/'.$staffs[0]->id)}}" title="Email report" class="btn txt-color-white bg-color-green btn-xs"><i class="glyphicon glyphicon-envelope"></i> </a> @endif

                                                <ul class="list-unstyled">
                                                    <br>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$staffs[0]->contact_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$staffs[0]->emergency_number}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>
                        <li>
                            <p class="text-muted">
                                <i class="fa fa-mail-forward"></i>&nbsp;&nbsp;<span class="txt-color-darken">{{$staffs[0]->email}}</span> <span class="txt-color-darken"></span>  <span class="txt-color-darken"></span>
                            </p>
                        </li>

                        <li>
                            <p class="text-muted">
                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Birth date <a href="#" rel="tooltip" title="" data-placement="top" data-original-title="Create an Appointment">{{$staffs[0]->date_of_birth}}</a></span>
                            </p>
                        </li>
                    </ul>
                    <br>
                    <p class="font-md">
                        <i>Present address</i>
                    </p>
                    <p>{{$staffs[0]->present_address}}</p>
                    <br>
                    <p>

                    <p class="font-md"> Rights </p>
                    <ul class="list-inline friends-list form-inline">
                        <li>Add : @if($staffs[0]->add_rights == 1 ) Yes @else No @endif</li>
                        <li>View : @if($staffs[0]->view_rights == 1 ) Yes @else No @endif</li>
                        <li>Edit : @if($staffs[0]->edit_rights == 1 ) Yes @else No @endif</li>
                        <li>Delete : @if($staffs[0]->delete_rights == 1 ) Yes @else No @endif</li>
                    </ul>

                    </p>
                </div>                                            
            </div>
        </div><hr>
    </div>
</div>