<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>@yield('title') | {{ config('app.name') }}</title>
     <meta name="author" content="{{ config('constants.author') }}">
     <meta name="description" content="for students">
     <meta name="keywords" content="polytechnic books">

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="/favicon.ico">

     <!-- Vendor css (Require in all Page) -->
     <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

     <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/dropzone.css') }}">
     <!-- Theme Config js (Require in all Page) -->
     <script src="{{asset('assets/js/config.min.js')}}"></script>

     <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" type="text/css" />

</head>
