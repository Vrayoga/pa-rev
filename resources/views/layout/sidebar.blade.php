<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                @can('view dashboard')
                    <li>
                        <a href="/dashboard" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-dashboards">Dashboards</span>
                        </a>
                    </li>
                @endcan

                @if (auth()->user()->hasRole('guru'))
                <li>
                    <a href="/guru" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="menu-title" key="t-apps">Apps</li>
                @endif

                @can('view kelas')
                    <li>
                        <a href="/kelas" class="waves-effect">
                            <i class="bx bx-file"></i>
                            <span key="t-file-manager">Kelas</span>
                        </a>
                    </li>
                @endcan

                @can('view siswa')
                    <li>
                        <a href="/siswa" class="waves-effect">
                            <i class="bx bx-chat"></i>
                            <span key="t-chat">Siswa</span>
                        </a>
                    </li>
                @endcan


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-bitcoin"></i>
                        <span key="t-crypto">Ekstrakurikuler</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('view kategori')
                            {{-- @if (!Auth::user()->hasRole('siswa')) --}}
                            <li>
                                <a href="/kategori" class="waves-effect">
                                    <i class="bx bx-store"></i>
                                    <span key="t-ecommerce">Kategori</span>
                                </a>
                            </li>
                        @endcan
                        @can('view ekstrakurikuler')
                            <li>
                                <a href="/ekstrakurikuler" key="t-ekstrakurikuler">
                                    <i class="bx bx-data"></i> <span>Data Ekstrakurikuler</span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="/jadwal" key="t-jadwal-ekstrakurikuler">
                                <i class="bx bx-calendar"></i> <span>Jadwal</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('view pendaftaran')
                    <li>
                        <a href="/pendaftaran" class="waves-effect">
                            <i class="bx bx-bitcoin"></i>
                            <span key="t-crypto">Pendaftaran</span>
                        </a>
                    </li>
                @endcan

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-crypto">Anggota</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if (auth()->user()->hasRole('admin'))
                            <!-- Untuk admin - tampilkan semua ekstra atau opsi melihat semua -->
                            <li><a href="">Semua Anggota</a></li>
                            @foreach (App\Models\Ekstrakurikuler::all() as $ekstra)
                                <li><a
                                        href="{{ route('anggota.ekstra', $ekstra->id) }}">{{ $ekstra->nama_ekstrakurikuler }}</a>
                                </li>
                            @endforeach
                        @elseif(auth()->user()->hasRole('guru'))
                            <!-- Untuk guru - hanya tampilkan ekstra yang dibimbing -->
                            @foreach (auth()->user()->ekstrakurikuler as $ekstra)
                                <li><a
                                        href="{{ route('anggota.ekstra', $ekstra->id) }}">{{ $ekstra->nama_ekstrakurikuler }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                @can('view absensi')
                    <li>
                        <a href="/absensi" class="waves-effect">
                            <i class="bx bx-bitcoin"></i>
                            <span key="t-crypto">Absensi</span>
                        </a>
                    </li>
                @endcan

                @can('view logbook')
                    <li>
                        @php
                            $hasOpenedAttendance = session('has_opened_attendance');
                            $isGuru = auth()->user()->hasRole('guru');
                        @endphp

                        {{-- Debug info, hapus setelah selesai --}}
                        @if ($isGuru && !$hasOpenedAttendance)
                            <a href="javascript:void(0);" class="waves-effect text-muted" onclick="showAttendanceWarning()">
                                <i class="bx bx-envelope"></i>
                                <span>Logbook</span>
                            </a>
                        @else
                            <a href="{{ route('logbook.index') }}" class="waves-effect">
                                <i class="bx bx-envelope"></i>
                                <span>Logbook</span>
                            </a>
                        @endif

                    </li>
                @endcan
                <script>
                    function showAttendanceWarning() {
                        Toastify({
                            text: "Anda harus membuka sesi absensi terlebih dahulu.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#f44336",
                        }).showToast();
                    }
                </script>
                
                


                @can('view prestasi')
                    <li>
                        <a href="/prestasi" class="waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span key="t-invoices">Prestasi</span>
                        </a>
                    </li>
                @endcan

                <li class="menu-title" key="t-apps">PAGES</li>
                @can('view absensi')
                    <li>
                        <a href="javascript: void(0);" class=" waves-effect">
                            <i class="bx bx-task"></i>
                            <span key="t-tasks">Absensi</span>
                        </a>
                    </li>
                @endcan


                @can('view user')
                    <li class="menu-title" key="t-apps">USER MANAGEMENT</li>

                    <li>
                        <a href="/users" class=" waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span key="t-projects">User</span>
                        </a>
                    </li>
                @endcan

                @can('view role')
                    <li>
                        <a href="/role" class=" waves-effect">
                            <i class="bx bx-briefcase-alt-2"></i>
                            <span key="t-projects">Role</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

