@include('include.header')
@include('include.navigationbar')

<div id="main" role="main" >
    <div id="ribbon" >
        <ol class="breadcrumb col-md-3">
            <li>Home</li><li>@yield("sub-title")</li>
        </ol>
        @include('include.dashboard_profie_signout')
    </div>
    <div id="content">       
        <div class="">
            <ul class="nav nav-tabs">
               @include('layouts.master_tabs')
            </ul>
        </div><br>
        @section("main-content")
        @show
    </div>
</div>
@include('include.footer')