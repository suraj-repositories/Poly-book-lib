@foreach ($files as $file)
    <div class="card my-1 file-card" id="sdfs" for="file_id">
        <div class="body file-card-body">

            <input type="radio" name="file_id" class="form-check-input">
            <div class="icon"><i class="bi {{ $file->icon }}"></i></div>

            <div class="title-area">
                <div class="title text-break">{{ $file->file_name }}</div>
                <div class="size">{{ $file->size }}</div>
            </div>
        </div>
    </div>
@endforeach
