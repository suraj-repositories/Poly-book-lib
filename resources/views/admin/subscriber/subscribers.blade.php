@extends('admin.layout.layout')
@section('title', Route::is('admin.subscribers.index') ? 'Subscribers' : '')
@section('content')

    <div class="container-fluid subscribers">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:user-heart-rounded-broken" class="me-1 pt-1"></iconify-icon>
                                Subscribers
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
                                                Email
                                                {{-- <iconify-icon icon="ph:arrows-down-up-thin" class="me-1 pt-1 cursor-pointer"
                                                    onclick="orderBy('email')">
                                                </iconify-icon> --}}
                                            </div>
                                        </th>
                                        <th>IP Address</th>
                                        <th>OS</th>
                                        <th>Device</th>
                                        <th>Browser</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                        <tr class="{{ session()->has('first_id') && session('first_id') == $subscriber->id ? 'first_search_bg' : '' }}">
                                            {{-- <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="check-selectpr">
                                                </div>
                                            </td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $subscriber->email }}
                                            </td>
                                            <td>
                                                {{ $subscriber->ip_address }}
                                            </td>
                                            <td> {{ $subscriber->os }} </td>
                                            <td> {{ $subscriber->device_type }} </td>
                                            <td> {{ $subscriber->browser }} </td>
                                            <td> {{ $subscriber->location }} </td>
                                            <td> {{ date('d M, Y', strtotime($subscriber->created_at)) }}
                                                <small>{{ date('h:i A', strtotime($subscriber->created_at)) }}</small>
                                            </td>


                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                        {{-- {{ $subscribers->links() }} --}}
                    </div>
                </div>
            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
