<div class="page-title">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Branches</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('branches') }}">Branches</a></li>
                <li class="current">{{ $branch->name }}</li>
            </ol>
        </nav>
    </div>
</div>
