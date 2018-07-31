@include('include.header')
<style> #error-message{margin-left: 260px;}</style>
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
                <li class="active"><a href="{{url ('view-user-type-modules')}}">User Type Modules</a></li>
                <li ><a href="{{url ('view-user')}}">Users</a></li>
            </ul>
        </div><br>
        <div class="row">          
            @include('include.messages')
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget " id="wid-id-3" data-widget-editbutton="true">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2>Add User Module</h2>
                        <a type="button" class="btn bg-color-blueLight txt-color-white btn-xs pull-right" href="{{url('view-user-type-modules')}}" style="margin-top: 5px;margin-right: 5px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    </header>
                    <div>
                        <div class="widget-body no-padding"><br>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <form  class="form-horizontal" role="form" method="POST" action="{{url('do-add-user-module/'.$user_types[0]->id)}}">
                                            {{ csrf_field() }}                                       
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">User Type <span class="error">* </span></label>
                                                <div class="col-sm-9">
                                                    <select   name="user_type_id" id="user_type_id"  class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                        <option value="{{ $user_types[0]->id}}" >{{ $user_types[0]->title }}</option>
                                                    </select> 
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('user_type_id') }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Modules <span class="error">* </span> </label>
                                                <div class="col-sm-9">
                                                    <select  name="module_id[]" id=""  multiple="multiple" style="height:380px;" class="col-xs-10 col-sm-5 col-md-9 col-lg-9" >
                                                       
                                                        <?php foreach ($modules as $module) { ?>                                                        
                                                            <option value="{{$module->id}}" @if (old('$module_id') == $module->id) selected="selected" @endif>{{ $module->module }} ( {{ $module->link }} ) - {{ $module->rank }}  -  [ {{ $module->image }} ]  </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div style="color: red;" id="error-message">
                                                    {{ $errors->first('module_id') }}
                                                </div>
                                            </div>                                           
                                            <div style="margin-left:35%">
                                                <button type="submit" class="width-10 btn btn-md btn-success">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <span class="bigger-110">Save</span>
                                                </button>
                                                <button type="reset" class="width-10  btn btn-md btn-danger ">
                                                    <i class="ace-icon fa fa-times red2"></i>
                                                    <span class="bigger-110">Cancel</span>
                                                </button>   
                                                <a href="{{ url('view-user-type-modules')}}" class="width-10 btn bg-color-blue txt-color-white">
                                                    <i class="ace-icon fa fa-undo"></i>
                                                    <span class="bigger-110">View user modules</span>
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