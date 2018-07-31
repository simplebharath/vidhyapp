<!DOCTYPE html>
<html lang="en-us" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <?php
        $intitute = DB::table('institute_details')->limit(1)->get();
        $logout_name = $intitute[0]->institution_name;
        $logout_logo = $intitute[0]->institution_logo;
        ?>
        <title> @if ( $logout_name != '' ) {{$logout_name}} @else VidhyApp @endif  </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-production-plugins.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-production.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-skins.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/smartadmin-rtl.min.css') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('uploads/logo/900-without.png') }}" width="500" height="500" >
        @if ( $logout_logo != '' )   <link rel="icon" type="image/x-icon" href="{{ URL::asset('uploads/logo/'.$logout_logo) }}" > @else <link rel="icon" type="image/x-icon" href="{{ URL::asset('uploads/logo/900-without.png') }}" > @endif
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <link rel="apple-touch-icon" href="{{ URL::asset('assets/img/splash/sptouch-icon-iphone.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets/img/splash/touch-icon-ipad.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('assets/img/splash/touch-icon-iphone-retina.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('assets/img/splash/touch-icon-ipad-retina.png') }}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="{{ URL::asset('assets/img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/your_style.css') }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/bootstrap-datepicker.min.css') }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ URL::asset('assets/css/jquery.datetimepicker.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/header_custom.css') }}">
    </head>
    <style>
        table.table { table-layout:fixed; }
        table.table td { overflow: hidden; }
    </style>
    <body class="smart-style-0" style="min-height: 900px;">
