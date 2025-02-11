@extends('admin.layout.layout')
@section('title', Route::is('admin.reviews.index') ? 'Reviews' : '')
@section('content')

    <div class="container-fluid reviews">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:download-minimalistic-broken" class="me-1 pt-1"></iconify-icon>
                                Reviews
                            </div>
                            <div>
                                <button class="btn btn-outline-success cursor-default" style="cursor: default;">
                                    <b class="me-1">
                                        +{{ $last30days }}
                                    </b>
                                    last Month
                                </button>

                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">

                            {{-- <div class="dataTables_wrapper dt-bootstrap4 no-footer mb-2">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select
                                                    name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input
                                                    type="search" class="form-control form-control-sm" placeholder=""
                                                    aria-controls="DataTables_Table_0"></label></div>
                                    </div>
                                </div>
                            </div> --}}

                            <table class="table table-striped table-borderless table-centered" data-table="true">
                                <thead class="table-light">
                                    <tr>
                                        {{-- <th scope="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault5">
                                            </div>
                                        </th> --}}
                                        <th>
                                            <div class="d-flex justify-content-between">
                                                ID
                                                {{-- <iconify-icon icon="ph:arrows-down-up-thin" class="me-1 pt-1 cursor-pointer"
                                                    onclick="orderBy('id')">
                                                </iconify-icon> --}}
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex justify-content-between">
                                                User
                                                {{-- <iconify-icon icon="ph:arrows-down-up-thin" class="me-1 pt-1 cursor-pointer"
                                                    onclick="orderBy('email')">
                                                </iconify-icon> --}}
                                            </div>
                                        </th>
                                        <th>Book</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            {{-- <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="check-selectpr">
                                                </div>
                                            </td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $review->user->getImageURL() ?? '#' }}" alt=""
                                                        class="avatar-xs rounded-circle me-2">
                                                    <div>
                                                        <h5 class="fs-14 m-0 fw-normal">{{ $review->user->name ?? '-' }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $review->book->getCoverPageUrl() ?? '#' }}" alt=""
                                                        class="avatar-xs rounded-circle me-2">
                                                    <div>
                                                        <h5 class="fs-14 m-0 fw-normal">{{ $review->book->title ?? '-' }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <iconify-icon icon="solar:star-bold"
                                                        class="{{ $i <= ($review->rating ?? 0) ? 'text-warning' : '' }}"></iconify-icon>
                                                @endfor
                                            </td>
                                            <td> {{ $review->review }} </td>

                                            <td> {{ date('d M, Y', strtotime($review->updated_at)) }}
                                                <small>{{ date('h:i A', strtotime($review->updated_at)) }}</small>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.reviews.delete', $review->id) }}"
                                                    class="d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger"><i
                                                            class="bx bx-trash fs-16"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                        {{-- {{ $reviews->links() }} --}}
                    </div>
                </div>
            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
