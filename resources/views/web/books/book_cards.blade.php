@forelse ($books as $book)
    <div class="col" data-aos="fade-up" data-aos-delay="100">
        <div class="member">
            <a href="{{ route('books.show', $book->id) }}">
                <div class="pic d-flex justify-content-center">
                    <img src="{{ $book->getCoverPageUrl() }}" class="img-fluid branch-image" alt="">
                </div>
            </a>
            <div class="member-info">
                <a href="{{ route('books.show', $book) }}">
                    <h4>{{ $book->title }}</h4>
                </a>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="social position-static">
                        <a href="#" class="d-flex align-items-center fs-4">
                            <iconify-icon icon="solar:download-minimalistic-line-duotone"
                                class="icon text-theme"></iconify-icon>

                            <span class="fs-6 ms-1">{{ count($book->downloads ?? []) }}</span>
                        </a>
                    </span>

                    <a href="#" class="d-flex align-items-center text-secondary fs-4">
                        <iconify-icon icon="solar:star-bold-duotone" class="text-warning"></iconify-icon>

                        <span class="fs-6 ms-1"> {{ round($book->averageRating(), 1) }} </span>
                    </a>
                </div>
            </div>
        </div>
    </div>


@empty

    <x-no-data icon="wpf:books" text="No Books Yet"/>
@endforelse


<div class="col-12 w-100">
    <div class="container mt-4 pt-4">
        {{ $books->links() }}
    </div>
</div>
