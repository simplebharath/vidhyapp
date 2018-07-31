<?php

$user_login_id = Session::get('username');
if ($user_login_id == '') {
    ?>
    <script type="text/javascript">
        window.location = "{{ url('login') }}";
    </script>
    <?php

} ?>