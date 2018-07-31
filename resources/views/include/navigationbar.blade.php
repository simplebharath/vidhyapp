<?php
if (Session::get('user_type_id') == 1) {
    $user_login_id = Session::get('user_login_id');
    $users = \App\User::where('user_login_id', $user_login_id)->get();
    Session::put('add', $users[0]->add_rights);
    Session::put('view', $users[0]->view_rights);
    Session::put('edit', $users[0]->edit_rights);
    Session::put('delete', $users[0]->delete_rights);
}
if (Session::get('user_type_id') == 5 || Session::get('user_type_id') == 7) {
    $user_login_id = Session::get('user_login_id');
    if (Session::get('user_type_id') == 5) {
        $users = \App\Student::where('user_login_id', $user_login_id)->get();
    } else {
        $student_id = \App\Parent_detail::where('user_login_id', $user_login_id)->value('student_id');
        $users = \App\Student::where('id', $student_id)->get();
    }
    Session::put('add', $users[0]->add_rights);
    Session::put('view', $users[0]->view_rights);
    Session::put('edit', $users[0]->edit_rights);
    Session::put('delete', 0);
}
if (Session::get('user_type_id') == 2 || Session::get('user_type_id') == 3 || Session::get('user_type_id') == 4 || Session::get('user_type_id') == 6 || Session::get('user_type_id') == 8 || Session::get('user_type_id') == 9) {
    $user_login_id = Session::get('user_login_id');
    $users = \App\Staff::where('user_login_id', $user_login_id)->get();
    Session::put('add', $users[0]->add_rights);
    Session::put('view', $users[0]->view_rights);
    Session::put('edit', $users[0]->edit_rights);
    Session::put('delete', $users[0]->edit_rights);
}
?>
<style>
    #logo img {
        max-height: 57px !important;
    }
</style>
<aside id="left-panel" >
    <div id="">
        @if(Session::has('institution_logo'))
        <span id="logo"> <img src="{{ asset('uploads/logo/'.Session::get('institution_logo')) }}" onerror="this.onerror=null;this.src='{{ asset('uploads/errors/900-without.png') }}'" alt="VidhyApp" style="margin-top: -10px;height: 100px; width:171px; background-color:#FFF;"> </span>
        @endif
    </div>
    <nav>
        <?php if (Session::has('Not_A_user')) { ?>
            <ul>
                <li>
                    <a href="{{ url('settings/add-academic-year') }}" title="Settings"><i class="fa fa-cogs"></i> <span class="">Settings</span></a>
                </li>
            </ul>
        <?php
        } else {

            $user_type_id = Session::get('user_type_id');
            $modules = \App\User_module:: leftjoin('modules', 'modules.id', '=', 'user_modules.module_id')
                    ->select('modules.link', 'modules.module', 'modules.image', 'modules.rank')
                    ->where('user_type_id', $user_type_id)
                    ->where('user_modules.status', 1)
                    ->orderby('modules.rank', 'asc')
                    ->get();
            ?>
        @if($modules !='')
            @foreach($modules as $module)
            <ul style="">
                <li>
                    <a href="{{ url($module->link) }}" title="{{$module->module}}" style="
                       padding-top: 10px;"><i class="{{ $module->image }}"></i> <span class="menu-item-parent">{{$module->module}}</span></a>
                </li>
            </ul>
            @endforeach
            @endif
<?php } ?>
    </nav>
</aside>
