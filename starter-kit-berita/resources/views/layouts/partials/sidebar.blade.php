<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-header">MENU UTAMA</li>

                {{-- MENU UNTUK WARTAWAN & ADMIN --}}
                @if(in_array(Auth::user()->level, ['wartawan', 'admin']))
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}" class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Manajemen Berita</p>
                    </a>
                </li>
                @endif
                
                {{-- ======================================================= --}}
                {{--         MENU UNTUK EDITOR & ADMIN (YANG KOSONG)       --}}
                {{-- ======================================================= --}}
                @if(in_array(Auth::user()->level, ['editor', 'admin']))
                    <li class="nav-item">
                        {{-- Logika 'active' yang sudah diperbaiki --}}
                        <a href="{{ route('approval.index') }}" class="nav-link {{ request()->routeIs(['approval.index', 'approval.show']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Approval Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('approval.published') }}" class="nav-link {{ request()->routeIs('approval.published') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-double"></i>
                            <p>Berita Terbit</p>
                        </a>
                    </li>
                @endif

                {{-- MENU KHUSUS ADMIN --}}
                @if(Auth::user()->level == 'admin')
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manajemen User</p>
                    </a>
                </li>
                @endif
                
            </ul>
        </nav>
        </div>
    </aside>