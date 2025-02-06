<div class="row row-cols-1 row-cols-lg-2 g-4">

    @forelse ($branch->semesters as $semester)
        <div class="col">
            @include('web.semesters.semester_card')
        </div>
    @empty
        @include('layout.no_data')
    @endforelse

</div>
