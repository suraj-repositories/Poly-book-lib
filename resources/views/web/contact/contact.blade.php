@extends('layout.layout')
@section('title', Route::is('contact') ? 'Contact Us' : '')

@section('content')
    <main class="main">

        @include('web.contact.contact_bredcrumbs')

        @include('web.contact.contact_content')



    </main>
@endsection
