@if(Session::has('message-success'))
<div class="alert alert-success fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-check"></i>
    <strong>Success!</strong> {{ Session::get('message-success') }}
</div>
@endif
{{ Session::forget('message-success') }}


@if(Session::has('message-warning'))
<div class="alert alert-warning fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Success!</strong> {{ Session::get('message-warning') }}
</div>
@endif
{{ Session::forget('message-warning') }}


@if(Session::has('message-info'))
<div class="alert alert-info fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Success!</strong> {{ Session::get('message-info') }}
</div>
@endif
{{ Session::forget('message-info') }}

@if(Session::has('message-danger'))
<div class="alert alert-danger fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Success!</strong> {{ Session::get('message-danger') }}
</div>
@endif
{{ Session::forget('message-danger') }}


@if(Session::has('message1-success'))
<div class="alert alert-success fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Error!</strong> {{ Session::get('message1-success') }}
</div>
@endif
{{ Session::forget('message1-success') }}


@if(Session::has('message1-warning'))
<div class="alert alert-warning fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Error!</strong> {{ Session::get('message1-warning') }}
</div>
@endif
{{ Session::forget('message1-warning') }}


@if(Session::has('message1-info'))
<div class="alert alert-info fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Error!</strong> {{ Session::get('message1-info') }}
</div>
@endif
{{ Session::forget('message1-info') }}

@if(Session::has('message1-danger'))
<div class="alert alert-danger fade in">
    <button class="close" data-dismiss="alert">
        &times;
    </button>
    <i class="fa-fw fa fa-info"></i>
    <strong>Error!</strong> {{ Session::get('message1-danger') }}
</div>
@endif
{{ Session::forget('message1-danger') }}