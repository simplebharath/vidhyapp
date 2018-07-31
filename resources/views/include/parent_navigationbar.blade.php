<!--<aside id="left-panel" >
    <div class="login-info">
        <span>  User image size is adjusted inside CSS, it should stay as it  
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src='{{ asset('uploads/parent/'. Session::get('parent_profile_pic_name')) }}'  alt="me" class="img-rounded" /> 
                <span>
                    @if(Session::has('parent_user_name'))
                    {{ Session::get('parent_user_name') }}
                    @else
                    <script type="text/javascript">
window.location = "{{ url('/') }}";//here double curly bracket
                    </script>

                    @endif
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 
        </span>
    </div>
    <nav>
       
            <ul>
                <li>
                    <a href="{{ url('parent_login_profile') }}" title="Parent_profile"><i class="fa fa-home"></i> <span class="menu-item-parent">Parent Profile</span></a>
                </li>

            </ul>
           
            


    </nav>
</aside>-->
<!-- END NAVIGATION -->
<link rel="stylesheet" href="{{ URL::asset('assets/css/header_custom.css') }}">

    <div class="pull-right col-md-2">
        <div class="login-info">
       
                    <div class="dropdown">
                        <a class="account" ><img src='{{ asset('uploads/parent/'. Session::get('parent_profile_pic_name')) }}'  alt="me" class="img-rounded" height="30" width="30" /> 
                            @if(Session::has('parent_user_name'))
                            {{ Session::get('parent_user_name') }}<span><i class="fa fa-angle-down"></i></span>
                            @else
                            <script type="text/javascript">
                                window.location = "{{ url('/') }}";//here double curly bracket
                            </script>
                            
                            @endif
                        </a>
                            
                        <div class="submenu">
                            <ul class="root">
                                
                    <li><span> <a href="{{ url('logout') }}" ><span class="iconbox"> <i class="fa fa-sign-out"></i> <span>Logout</span> </span></a></li>
                    
                            </ul>
                            
                        </div>
                        
                    </div>
                                            </div>
        </div>
<script type="text/javascript" src="{{ URL::asset('assets/js/header_custom.js') }}"></script>
