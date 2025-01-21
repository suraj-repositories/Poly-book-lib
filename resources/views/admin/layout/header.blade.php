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
     <meta name="csrf-token" content="{{ csrf_token() }}" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="/favicon.ico">

     <!-- Plugins Styles -->
     <link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/dropzone.css') }}">
     <link rel="stylesheet" href="{{asset('assets/vendor/gridjs/theme/mermaid.min.css')}}" type="text/css" />
     <link rel="stylesheet" href="{{asset('assets/vendor/datatable/datatable.css')}}" type="text/css" />

     <!-- Plugin Scripts -->
     <script src="{{ asset('assets/vendor/gridjs/gridjs.umd.js') }}"></script>
     <script src="{{ asset('assets/js/orange-bundle/utility.js') }}"></script>
     <script src="{{ asset('assets/js/orange-bundle/laravel_form.js') }}"></script>
     <script src="{{ asset('assets/js/orange-bundle/file_service.js') }}"></script>

     <!-- Vendor css (Require in all Page) -->
     <link href="{{asset('assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">

     <!-- App css (Require in all Page) -->
     <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="{{asset('assets/js/config.min.js')}}"></script>
     <script src="{{asset('assets/vendor/jquery/jquery-3.7.1.js')}}"></script>
     <script src="{{asset('assets/vendor/datatable/datatable.js')}}"></script>

     <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" type="text/css" />


     @vite(['resources/js/app.js'])
     @routes
</head>
