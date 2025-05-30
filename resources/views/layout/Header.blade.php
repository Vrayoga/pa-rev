<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box d-flex align-items-center">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('') }}assets/images/logo-smk1.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('') }}assets/images/logo-smk1.png" alt="" height="17">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('') }}assets/images/logo-smk1.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('') }}assets/images/logo-smk1.png" alt="" height="19">
                    </span>
                </a>

                <span class="d-none d-lg-inline-block ms-2 fw-bold text-uppercase">SMKN 1 SUMENEP</span>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->

        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-bell bx-tada"></i>
                    @if (isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="badge bg-danger rounded-pill">{{ $unreadNotificationsCount }}</span>
                    @endif
                </button>
                <div id="notif-pendaftaran" class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">Notifications</h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small">View All</a>
                            </div>
                        </div>
                    </div>
                    <div id="notification-list" data-simplebar style="max-height: 230px;">
                        @forelse($notifications as $notification)
                            <a href="{{ route('pendaftaran.index') }}"
                                class="text-reset notification-item {{ $notification->is_read ? '' : 'unread' }} "
                                data-id="{{ $notification->id }}"
                                onclick="markNotificationAsRead(event, {{ $notification->id }})">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title bg-{{ $notification->is_read ? 'secondary' : 'primary' }} rounded-circle font-size-16">
                                            <i class="bx bx-bell"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $notification->title }}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{ $notification->message }}</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center p-3">
                                <p class="text-muted mb-0">No notifications found</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center"
                            href="{{ route('pendaftaran.index') }}">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                        </a>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('') }}assets/images/users/avatar-1.jpg" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-user">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profile</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="/logout"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    #notification-list {
        max-height: 300px;
        /* Sesuaikan dengan tinggi yang diinginkan */
        overflow-y: auto;
        /* Membuat area notifikasi menjadi scrollable */
    }
</style>



<script>
    function fetchNotifications() {
        $.ajax({
            url: '{{ route('notifications.fetch') }}' + '?random=' + new Date()
                .getTime(), // Endpoint untuk mengambil notifikasi
            method: 'GET',
            success: function(response) {
                console.log(response);
                const badge = $('#page-header-notifications-dropdown .badge');
                const count = response.unreadCount;

                // Update badge
                if (count > 0) {
                    badge.text(count).removeClass('d-none');
                } else {
                    badge.addClass('d-none');
                }

                const notificationList = $('#notification-list');
                notificationList.empty();

                if (response.notifications.length > 0) {
                    response.notifications.forEach(function(notification) {
                        // Format waktu menggunakan moment.js
                        let formattedTime = moment(notification.created_at)
                    .fromNow(); // Format waktu menjadi relatif (misalnya "1 menit yang lalu")

                        notificationList.append(`
                <a href="{{ route('pendaftaran.index') }}" class="text-reset notification-item ${notification.is_read ? '' : 'unread'}" data-id="${notification.id}" onclick="markNotificationAsRead(event, ${notification.id})">
                    <div class="d-flex">
                        <div class="avatar-xs me-3">
                            <span class="avatar-title bg-${notification.is_read ? 'secondary' : 'primary'} rounded-circle font-size-16">
                                <i class="bx bx-bell"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">${notification.title}</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">${notification.message}</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> ${formattedTime}</p>
                            </div>
                        </div>
                    </div>
                </a>
            `);
                    });
                } else {
                    notificationList.append(`
            <div class="text-center p-3">
                <p class="text-muted mb-0">Tidak ada notifikasi</p>
            </div>
        `);
                }
            },
            error: function() {
                console.error("Error fetching notifications.");
            }
        });
    }

    function markNotificationAsRead(event, id) {
        event.preventDefault();
        $.ajax({
            url: `/notifications/${id}/read`, // Sesuaikan dengan route kamu
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function() {
                fetchNotifications(); // Refresh list setelah membaca notifikasi
                window.location.href = "{{ route('pendaftaran.index') }}"; // Arahkan setelah dibaca
            }
        });
    }

    $(document).ready(function() {
        fetchNotifications(); // Ambil notifikasi pertama kali saat halaman dimuat
        setInterval(fetchNotifications, 5000); // Polling setiap 10 detik
    });
</script>
