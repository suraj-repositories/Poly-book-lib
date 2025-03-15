@if (count($resultBranches) <= 0)
    <div class="item-border ">
        <div class="no-result">
            <div class="text-box p-2 justify-content-center">
                No results for "{{ $search }}".
            </div>
        </div>
    </div>
@else
    @php $counter = 0; @endphp
    @foreach ($resultBranches as $branch)
        @if ($counter >= 30)
            @break;
        @endif
        @php $counter++; @endphp
        <div class="{{ $loop->iteration > 1 ? 'item-border' : '' }}">
            <a class="item page" href="{{ route('branches.show', $branch->id) }}">
                <div class="icon-box">
                    <iconify-icon icon="lets-icons:file-duotone" class="icon"></iconify-icon>
                </div>
                <div class="text-box">
                    <div class="title">{{ $branch->name }}</div>
                    <iconify-icon icon="lsicon:right-outline" class="right-arrow"></iconify-icon>
                </div>
            </a>


            @foreach ($branch->books as $book)
                @if ($counter >= 30)
                    @break;
                @endif
                @php $counter++; @endphp
                <a class="item content" href="{{ route('books.show', $book->id) }}">
                    <div class="icon-box">
                        <iconify-icon icon="solar:notebook-broken" class="icon transparent"></iconify-icon>
                    </div>
                    <div class="text-box sub-border">
                        <div class="title">
                            <div>{{ $book->title }}
                                @if ($book->author && str_contains(strtolower($book->author), strtolower($search)))
                                    <br> <small><b>Author : </b>{{ $book->author }}</small>
                                @endif
                            </div>
                            <small data-html-to-text='true'> {!! $book->description !!} </small>
                        </div>
                        <iconify-icon icon="si:down-right-line" class="right-arrow"></iconify-icon>
                    </div>
                </a>
            @endforeach

        </div>
    @endforeach

@endif
