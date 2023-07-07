<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <img class="sidebar-brand-image" src="{{ asset('back/images/logo/main_logo.png') }}" alt="main_logo" width="45%">
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @if ( auth()->user()->role == '1' )
                <li class="nav-item nav-category">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard Startup</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard Monev 1</span>
                    </a>    
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard Monev 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard WRAP</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Data Master</li>
                <li class="nav-item">
                    <a href="{{ route('master.pengguna') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.inkubasi') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Program Inkubasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('startupcategory') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Kategori Startup</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.civitas') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Civitas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Universitas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Fakultas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Program Studi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Periode Pendaftaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Komponen Penilaian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Tema Bootcamp</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Feedback</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Konten Monev</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Mata Kuliah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Master Index Nilai Matkul</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Hak Akses</li>
                <li class="nav-item">
                    <a href="{{ route('access.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Hak Akses</span>
                    </a>
                </li>
                {{-- @foreach (get_access() as $feature)
                    <li class="nav-item nav-category">{{ $feature }}</li>
                @endforeach --}}
                {{-- <li class="nav-item nav-category">{{ auth()->user()->role }}</li> --}}

            @elseif ( auth()->user()->role == '2' )
            {{-- <li class="nav-item nav-category">Data Master</li> --}}
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Profil Startup</span>
                </a>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Voting Jadwal Mentoring</span>
                </a>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Jadwal Mentoring</span>
                </a>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Jadwal Bootcamp</span>
                </a>
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Sertifikat Monev</span>
                </a>
                {{-- @foreach (get_menu() as $menu)
                    {!! $menu !!}
                @endforeach --}}
            </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Profil Startup</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Voting Jadwal Mentoring</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Jadwal Mentoring</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Jadwal Bootcamp</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Sertifikat Monev</span>
                    </a>
                </li> --}}
                {{-- @foreach (get_access() as $feature)
                    <li class="nav-item nav-category">{{ $feature->name }}</li>
                @endforeach --}}
                {{-- <li class="nav-item nav-category">{{ get_access() }}</li> --}}
            @endif
        </ul>
    </div>
</nav>
<!-- partial -->
