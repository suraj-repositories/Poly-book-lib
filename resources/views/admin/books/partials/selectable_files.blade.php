@forelse ($files as $file)
    <div class="card my-1 file-card" id="sdfs" for="file_id">
        <div class="body file-card-body">

            <input type="radio" name="file_id" class="form-check-input" value="{{ $file->id }}" {{ isset($book, $book->file->id) ? ($book->file->id == $file->id ? 'checked' : '') : '' }}>
            <div class="icon"><i class="bi {{ $file->icon }}"></i></div>

            <div class="title-area">
                <div class="title text-break">{{ $file->file_name }}</div>
                <div class="size">{{ $file->size }}</div>
                <div class="extension hide">{{ $file->extension() }}</div>
            </div>
        </div>
    </div>
@empty

    <p class="text-center mt-3"><i>No Result Found.</i></p>

@endforelse
