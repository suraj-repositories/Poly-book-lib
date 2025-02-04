<div class="row row-cols-1 row-cols-lg-2 g-4">

    @forelse ([1, 2, 3, 5, 6, 7] as $item)
        <div class="col">
            @include('web.semesters.semester_card')
        </div>
    @empty
        @include('layout.no_data')
    @endforelse

</div>
