@extends('layout.layout')
@section('title', Route::is('home') ? 'Branches' : '')

@section('content')
    <main class="main">

        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Branches</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Branches</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section id="team" class="team section">
            @include('web.branches.branch_heading')
            <x-branch-card-list is-pagination="true" />
        </section>
    </main>
@endsection
