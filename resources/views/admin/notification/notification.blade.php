@extends('admin.layout.layout')
@section('title', Route::is('admin.notifications.index') ? 'Notifications' : '')
@section('content')

    <div class="container-fluid notifications">

        @include('layout.alert')

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-3">
                            <div class="text-dark fs-3 fw-semibold ">
                                <iconify-icon icon="solar:bell-bing-broken" class="me-1 pt-1"></iconify-icon>
                                Notifications
                                @if($newNotificationsCount > 0)
                                <sup><sup class="fs-10 badge bg-success rounded-pill">{{$newNotificationsCount }}</sup></sup>
                            @endif

                            </div>
                            <div>

                                <a href="{{ route('admin.notification.clear_all') }}" class="btn btn-outline-warning">
                                    Clear All
                                </a>

                            </div>
                        </div> <!-- end row -->
                    </div>
                    <!-- end card body -->
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless table-centered" data-table="true">
                                <thead class="table-light">
                                    <tr>
                                        {{-- <th scope="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault5">
                                            </div>
                                        </th> --}}
                                        <th scope="col">ID</th>
                                        <th scope="col">From</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
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

                                                    @if ($notification->type == 'contact')
                                                        @if (!empty($notification->notifiable->user))
                                                            <div class="{{ $notification->is_read ? '' : 'unreaded' }} unreaded-img">
                                                                <img src="{{ $notification->notifiable->user->getImageURL() }}"
                                                                class="img-fluid me-2 avatar-sm rounded-circle "
                                                                alt="avatar-3" />
                                                            </div>
                                                            <a
                                                                href="{{ route('admin.contacts.index', ['first_id' => $notification->notifiable->id]) }}">
                                                                <div>
                                                                    <h5 class="fs-14 m-0 fw-normal">
                                                                        {{ $notification->notifiable->user->name }}

                                                                    </h5>
                                                                    <h6 class="fs-11 m-0 fw-light">
                                                                        {{ $notification->notifiable->user->email }}</h5>
                                                                </div>
                                                            </a>
                                                        @else
                                                            <span
                                                                class="avatar-title bg-soft-info text-info fs-20  avatar-xs rounded-circle me-2 w-eq-h {{ $notification->is_read ? '' : 'unreaded' }}">
                                                                {{ strtoupper(substr($notification->notifiable->name, 0, 1)) }}
                                                            </span>
                                                            <a
                                                                href="{{ route('admin.contacts.index', ['first_id' => $notification->notifiable->id]) }}">
                                                                <div>
                                                                    <h5 class="fs-14 m-0 fw-normal">
                                                                        {{ $notification->notifiable->name }}</h5>
                                                                    <h6 class="fs-11 m-0 fw-light">
                                                                        {{ $notification->notifiable->email }}</h5>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    @else
                                                        <span
                                                            class="avatar-title bg-soft-info text-info fs-20  avatar-xs rounded-circle me-2 w-eq-h {{ $notification->is_read ? '' : 'unreaded' }}">
                                                            {{ strtoupper(substr($notification->notifiable->email, 0, 1)) }}
                                                        </span>
                                                        <a
                                                            href="{{ route('admin.subscribers.index', ['first_id' => $notification->notifiable->id]) }}">
                                                            <div>
                                                                <h5 class="fs-14 m-0 fw-normal">
                                                                    {{ $notification->notifiable->email }}</h5>
                                                            </div>
                                                        </a>
                                                    @endif


                                                </div>
                                            </td>
                                            <td>
                                                {{ $notification->title }}
                                            </td>
                                            <td>
                                                {{ $notification->type }}
                                            </td>
                                            <td> {{ $notification->message }} </td>
                                            <td> {{ date('d M, Y', strtotime($notification->created_at)) }}
                                                <small>{{ date('h:i A', strtotime($notification->created_at)) }}</small>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
