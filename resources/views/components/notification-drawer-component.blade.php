<div class="dropdown topbar-item">
    <button type="button" class="topbar-button position-relative" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <iconify-icon icon="solar:bell-bing-broken" class="fs-24 align-middle"></iconify-icon>
        @if ($notificationCount > 0)
            <span
                class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">{{ $notificationCount }}<span
                    class="visually-hidden">unread messages</span></span>
        @endif
    </button>
    <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.notification.clear_all') }}" class="text-dark text-decoration-underline">
                        <small>Clear All</small>
                    </a>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 280px;">
            <!-- Item -->

            @forelse ($notifications as $notification)
                @if ($notification->type == 'contact')
                    <a href="{{ route('admin.contacts.index', ['first_id' => $notification->notifiable->id]) }}"
                        class="dropdown-item py-3 border-bottom">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm me-2">
                                    @if (!empty($notification->notifiable->user))
                                        <img src="{{ $notification->notifiable->user->getImageURL() }}"
                                            class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-3" />
                                    @else
                                        <span class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                            {{ strtoupper(substr($notification->notifiable->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold"> {{ $notification->notifiable->name }}</p>
                                <p class="mb-0 text-wrap">
                                    {{ $notification->notifiable->message }}
                                </p>
                            </div>
                        </div>
                    </a>
                @elseif($notification->type == 'subscriber')
                    <a href="{{ route('admin.subscribers.index', ['first_id' => $notification->notifiable->id]) }}"
                        class="dropdown-item py-3 border-bottom">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm me-2">
                                    <span class="avatar-title bg-soft-danger text-danger fs-20 rounded-circle">
                                        <iconify-icon icon="stash:user-heart-duotone"></iconify-icon>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold text-wrap"> {{ $notification->message }} </p>
                            </div>
                        </div>
                    </a>
                @endif
            @empty

                <x-no-data text="No Notifications" icon="solar:bell-bing-broken" />
            @endforelse

            <!-- Item -->


        </div>
        <div class="text-center py-3">
            <a href="{{ route('admin.notifications.index') }}" class="btn btn-primary btn-sm">View All Notification <i
                    class="bx bx-right-arrow-alt ms-1"></i></a>
        </div>
    </div>
</div>
