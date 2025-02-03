@extends('layout.layout')
@section('title', Route::is('books') ? 'Books' : '')

@section('content')
    <main class="main">

        @include('web.books.book_bredcrumbs')

        <section id="team" class="team section">
            @include('web.books.book_heading')

            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">

                    @include('web.books.book_cards')

                </div>
            </div>

        </section>
    </main>
@endsection
