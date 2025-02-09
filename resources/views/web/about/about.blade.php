@extends('layout.layout')
@section('title', Route::is('about') ? 'About' : '')

@section('content')
    <main class="main">

        @include('web.about.about_bredcrumbs')

        @include('web.about.about_content')

        <x-web.stats />


    </main>
@endsection
