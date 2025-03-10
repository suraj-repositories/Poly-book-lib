<div class="container">

    @forelse ($reviews as $review)
        <div class="d-flex comment mb-3">
            <div class="comment-user-image">
                <img src="{{ $review->user->getImageURL() }}" class="comment-user" alt="">
            </div>
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="heading">
                        <h5 class="mb-1"> {{ $review->user->name ?? '...' }} </h5>
                        <p class="mb-2 date">{{ \Carbon\Carbon::parse($review->created_at)->format('F d, Y') }}</p>
                    </div>
                    <div class="d-flex mb-3">

                        @for ($i = 1; $i <= 5; $i++)
                            <iconify-icon icon="solar:star-bold"
                                class="{{ $i <= ($review->rating ?? 0) ? 'text-warning' : '' }}"></iconify-icon>
                        @endfor
                    </div>
                </div>

                <p>{{ $review->review }} </p>
            </div>
        </div>
    @empty
        <x-no-data icon="duo-icons:message-3" text="No Review's Yet" />
    @endforelse

</div>
