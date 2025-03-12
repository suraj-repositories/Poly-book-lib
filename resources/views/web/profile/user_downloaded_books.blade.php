@forelse ($user->downloads->take(50) as $download)
    <div class="user-book">
        <img src="{{ $download->book->getCoverPageUrl() ?? '#' }}" class="book-img me-3" alt="Book">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="heading">
                <h5 class="mb-1"><a href="{{ route('books.show', $download->book ?? '_') }}"
                        class="text-dark">{{ $download->book->title ?? '-' }}</a></h5>
                <p class="mb-2 date">{{ \Carbon\Carbon::parse($download->created_at)->format('F d, Y') }}
                </p>
            </div>
            <div class="d-flex mb-3">
                <form action="{{ route('download', ['type' => 'book', 'id' => $download->book->id]) }}" method="GET">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent p-0">
                        <iconify-icon icon="solar:download-minimalistic-line-duotone" class="fs-3 fw-bold"
                            title="Download Again"></iconify-icon>
                    </button>
                </form>

            </div>
        </div>
    </div>
@empty
    <x-no-data icon="line-md:downloading-loop" text="No Downloads Yet" />
@endforelse
