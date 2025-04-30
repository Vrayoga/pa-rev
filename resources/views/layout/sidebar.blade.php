<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="/dashboard" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="menu-title" key="t-apps">Apps</li>


                @can('view siswa')    
                <li>
                    <a href="/siswa" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">Siswa</span>
                    </a>
                </li>
                @endcan

                @can('view kelas')
                    
                <li>
                    <a href="/kelas" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-file-manager">Kelas</span>
                    </a>
                </li>
                @endcan

                @can('view kategori')
                @if (!Auth::user()->hasRole('siswa'))
                <li>
                    <a href="/kategori" class="waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Kategori</span>
                    </a>
                </li>
                @endif
                @endcan

                @can('view ekstrakurikuler')
                    
                <li>
                    <a href="/ekstrakurikuler" class="waves-effect">
                        <i class="bx bx-bitcoin"></i>
                        <span key="t-crypto">Ekstrakurikuler</span>
                    </a>
                </li>
                @endcan

                     
                <li>
                    <a href="/pendaftaran" class="waves-effect">
                        <i class="bx bx-bitcoin"></i>
                        <span key="t-crypto">Pendaftaran</span>
                    </a>
                </li>

                @can('view logbook')

                <li>
                    <a href="/logbook" class="waves-effect">
                        <i class="bx bx-envelope"></i>
                        <span key="t-email">Logbook</span>
                    </a>
                </li>  
                
                @endcan

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

                {{-- @can('view user') --}}
                
                {{-- @endcan --}}
                <li class="menu-title" key="t-apps">USER MANAGEMENT</li>

                {{-- @can('view role') --}}
                <li>
                    <a href="/users" class=" waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-projects">User</span>
                    </a>
                </li>
                <li>
                    <a href="/role" class=" waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-projects">Role</span>
                    </a>
                </li>
                {{-- @endcan --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
