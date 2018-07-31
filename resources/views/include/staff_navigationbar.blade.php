<!--<aside id="left-panel" >-->
<!--    <div class="login-info">
        <span>  User image size is adjusted inside CSS, it should stay as it  
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src='{{ asset('uploads/'. Session::get('parent_profile_pic_name')) }}'  alt="me" class="img-rounded" /> 
                <span>
                    @if(Session::has('staff_user_name'))
                    {{ Session::get('staff_user_name') }}
                    @else
                    <script type="text/javascript">
window.location = "{{ url('/') }}";//here double curly bracket
                    </script>

                    @endif
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 
        </span>
    </div>-->
<!--    <nav>
       
            <ul>
                <li>
                    <a href="{{ url('staff_login_profile') }}" title="staff_profile"><i class="fa fa-home"></i> <span class="menu-item-parent">Staff Profile</span></a>
                </li>

            </ul>
           
            


    </nav>
</aside>-->
<!-- END NAVIGATION -->