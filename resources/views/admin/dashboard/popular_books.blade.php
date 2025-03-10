<div class="card card-height-100">
    <div class="card-header d-flex align-items-center justify-content-between gap-2">
        <h4 class="card-title flex-grow-1">Popular Books</h4>
        <div>
            <a href="{{ route('admin.books') }}" class="btn btn-sm btn-soft-primary">View All</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-nowrap table-centered m-0">
            <thead class="bg-light bg-opacity-50">
                <tr>
                    <th class="text-muted py-1">Book</th>
                    <th class="text-muted py-1">Downloads</th>
                    <th class="text-muted py-1">User Reviews</th>
                    <th class="text-muted py-1">Rating</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($popularBooks as $book)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $book->getCoverPageUrl() }}" alt="book"
                                    class="avatar-xs rounded-circle me-2">
                                <div>
                                    <a  href="{{ route('books.show', $book->id) }}"> <h5 class="fs-14 m-0 fw-normal">{{ $book->title }}</h5></a>
                                </div>
                            </div>
                        </td>
                        <td> {{ $book->downloads_count }} </td>
                        <td>{{ count($book->reviews ?? 0) }}</td>
                        <td>
                            <iconify-icon icon="solar:star-bold-duotone" class="text-warning"> </iconify-icon> x
                            {{ round($book->averageRating() ?? 0) }}
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


        @if (count($popularBooks) <= 0)
            <div class="mt-2">
                <x-no-data text="No Record" icon="solar:notebook-broken" />
            </div>
        @endif
    </div>
</div>
