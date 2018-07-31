@include('include.header')
<style> #error-message{margin-left: 155px;}</style>
@include('include.navigationbar')
<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>Settings</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
                <li ><a href="{{url ('view-modules')}}">Modules</a></li>
                <li><a href="{{url ('view-user-types')}}">User Types</a></li>
                <li><a href="{{url ('view-user-type-modules')}}">User Type Modules</a></li>
                <li class="active"><a href="{{url ('view-user')}}">Users</a></li>
            </ul>
        </div><br>
        <div class="row">          
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Edit User</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-user')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{url('do-edit-user/'.$users[0]->id)}}">
                                            {{ csrf_field() }}                                       
                                            <fieldset>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="first_name" value="{{ $users[0]->first_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message" id="error-message" >
                                                            {{ $errors->first('first_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="" name="last_name" value="{{ $users[0]->last_name }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('last_name') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Name<span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  id="form-field-1" placeholder="Read only" style="background-color:lightgrey" name="user_name" value="{{ $users[0]->user_logins->user_name}}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" readonly=""/>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_name') }}
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Image <span class="error"></span></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"  id="form-field-1"  name="photo" value="{{ $users[0]->photo }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;">
                                                            {{ $errors->first('photo') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"><span class="error"> </span></label>
                                                        <div class="col-sm-9">
                                                            <img src="{{URL::asset('uploads/users/'.$users[0]->photo)}}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/student.png') }}'" height="60" width="60">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="email"  id="form-field-1" placeholder="" name="email_id" value="{{ $users[0]->email_id }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('email_id') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact Number<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <input type="test"   id="form-field-1" placeholder="" name="contact_number" value="{{ $users[0]->contact_number }}" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" />
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('contact_number') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <textarea cols="39" maxlength="160" wrap="soft" class="custom-scroll" placeholder="" name="address" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >{{ $users[0]->address }}</textarea>
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Type<span class="error">* </span></label>
                                                        <div class="col-sm-9">
                                                            <select   name="user_type_id" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                                <option value=""> --- select user type --- </option> 
                                                                <?php foreach ($user_types as $user_type) { ?>
                                                                    <option value="<?php echo $user_type->id; ?>" @if ( $users[0]->user_type_id == $user_type->id) selected="selected" @endif><?php echo $user_type->title; ?></option>
                                                                <?php } ?>

                                                            </select> 
                                                        </div>
                                                        <div style="color: red;" id="error-message">
                                                            {{ $errors->first('user_type_id') }}
                                                        </div>
                                                    </div>                                                                                                      
                                                    <div class="form-group form-inline" style="padding-left:60px;">
                                                        <div class="inline-group col-sm-12" class="form-inline">
                                                            <label>User Rights   </label>
                                                            <label class="checkbox" style="padding:5px;">
                                                                <input name="add_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1"  name="add_rights" @if($users[0]->add_rights == 1) checked @endif>
                                                                       Add</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="view_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="view_rights" @if($users[0]->view_rights == 1)) checked @endif>
                                                                       View</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="edit_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="edit_rights" @if($users[0]->edit_rights == 1) checked @endif>
                                                                       Edit</label>
                                                            <label class="checkbox"  style="padding:5px;">
                                                                <input name="delete_rights" value="0" type="hidden">
                                                                <input type="checkbox" value="1" name="delete_rights" @if($users[0]->delete_rights == 1) checked @endif>
                                                                       Delete</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </fieldset>
                                            <div style="margin-left:40%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Update</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-user')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View users</span>
                                                </a>
                                            </div><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <div class="col-xs-1 col-sm-1 col-md-6 col-lg-6"></div>
        </div>
    </div>
</div>
@include('include.footer')