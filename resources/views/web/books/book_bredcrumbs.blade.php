<div class="page-title">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Books</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>
                    @if (Route::is('books.show'))
                        <a href="{{ route('books') }}">Books</a>
                    @else
                        Books
                    @endif
                </li>
                @if (Route::is('books.show'))
                    <li class="current">{{ $book->title ?? '-' }}</li>
                @endif
            </ol>
        </nav>
    </div>
</div>
