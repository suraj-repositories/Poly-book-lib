
<div class="container mt-4 pb-3 mb-3 border-bottom">

    <form action="{{ route('books.review.store', $book) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="review_message"
                class="form-label">Review</label>
            <textarea class="form-control" id="review_message" rows="3" name="review" required></textarea>
        </div>

        <div class="mb-3 give-rating">
            <input type="hidden" value="0" id="rating" name="rating">
            @for ($i = 0; $i < 5; $i++)
                <iconify-icon icon="solar:star-bold-duotone"
                    class="fs-3 cursor-pointer star"></iconify-icon>
            @endfor
        </div>


        <button class="btn btn-sm px-2 color-primary rounded-0">Add Review</button>
    </form>

</div>

