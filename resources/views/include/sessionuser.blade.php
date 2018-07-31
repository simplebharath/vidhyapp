<?php 
        $user_login_id = Session::get('user_login_id');
        if($user_login_id == '') { ?>
           <script type="text/javascript">
                                window.location = "{{ url('login') }}";//here double curly bracket
                            </script>
        
<?php }?>