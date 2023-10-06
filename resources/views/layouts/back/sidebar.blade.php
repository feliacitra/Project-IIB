<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="/dashboard">
            <img class="sidebar-brand-image" src="{{ asset('back/images/logo/main_logo.png') }}" alt="main_logo" width="55%"/>
        </a>
        <a>
            <div class="sidebar-toggler active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @if ( auth()->user()->role == '1' )
                <li class="nav-item nav-category">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="monitor"></i>
                        <span class="link-title">Dashboard Startup</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="bar-chart-2"></i>
                        <span class="link-title">Dashboard Monev 1</span>
                    </a>    
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="bar-chart"></i>
                        <span class="link-title">Dashboard Monev 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="trending-up"></i>
                        <span class="link-title">Dashboard WRAP</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Data Master</li>
                <li class="nav-item">
                    <a href="{{ route('master.pengguna') }}" class="nav-link">
                        <i class="fa fa-users"></i>
                        <span style="margin-left:12px">Master Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.inkubasi') }}" class="nav-link">
                        <i class="fa fa-sitemap"></i>
                        <span style="margin-left:12px">Master Program Inkubasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.kategori.startup') }}" class="nav-link">
                        <i class="fa fa-rocket"></i>
                        <span style="margin-left:15px">Master Kategori Startup</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.civitas') }}" class="nav-link">
                        <i class="fa fa-address-card"></i>
                        <span style="margin-left:14px">Master Civitas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.universitas') }}" class="nav-link">
                        <i class="fa fa-building"></i>
                        <span style="margin-left:17px">Master Universitas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('faculty.index') }}" class="nav-link">
                        <i class="fa fa-university"></i>
                        <span style="margin-left:16px">Master Fakultas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.prodi') }}" class="nav-link">
                        <i class="fa fa-graduation-cap"></i>
                        <span style="margin-left:13px">Master Program Studi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.periode') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Master Periode Pendaftaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master.penilaian') }}" class="nav-link">
                        <i class="fa fa-check"></i>
                        <span style="margin-left:17px">Master Komponen Penilaian</span>
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

                <li class="nav-item nav-category">Pendaftaran</li>
                <li class="nav-item">
                    <a href="{{ route('pendaftar') }}" class="nav-link">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Data Pendaftar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('penilaianDE') }}" class="nav-link">
                        <i class="link-icon" data-feather="edit"></i>
                        <span class="link-title">Penilaian Desk Evaluation</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Hak Akses</li>
                <li class="nav-item">
                    <a href="{{ route('access.index') }}" class="nav-link">
                        <i class="fa fa-cogs"></i>
                        <span style="margin-left:15px">Hak Akses</span>
                    </a>
                </li>
                {{-- @foreach (get_access() as $feature)
                    <li class="nav-item nav-category">{{ $feature }}</li>
                    @endforeach --}}
                    {{-- <li class="nav-item nav-category">{{ auth()->user()->role }}</li> --}}
                    
                    {{-- @elseif ( auth()->user()->role == '2' ) --}}
                    @else
                    {{-- <li class="nav-item nav-category">Data Master</li> --}}
                    {{-- @dd($history) --}}
                    {{-- @dd($history) --}}
            <li class="nav-item">
                {{-- @dd($history); --}}
                @if(isset($history))
                <form action="{{ route('dashboard') }}" method="GET">
                    <select name="history" id="periode" class="form-control form-select">
                        <option value="" class="text-muted">History</option>
                        @foreach($history->historyStartup as $item)
                        @if($item->masterPeriodeProgram[0]->masterPeriode->mpe_id == $periode->mpe_id)
                        <option value="{{ $item->mpd_id }}" selected>{{ $item->masterPeriodeProgram[0]->masterPeriode->mpe_name }}</option>
                        @else
                        <option value="{{ $item->mpd_id }}">{{ $item->masterPeriodeProgram[0]->masterPeriode->mpe_name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <button type="submit" id="periodeButton" hidden></button>
                </form>
                @endif
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard', auth()->user()->id) }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
            <a href="" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Profil Startup</span>
                </a>
            </li>
            {{-- @dd(isset($check)) --}}
            @if(isset($check))
            @if($check != 1)
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Voting Jadwal Mentoring</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Jadwal Mentoring</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Jadwal Bootcamp</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Sertifikat Monev</span>
                </a>
            </li>
            @endif
            @endif
            @foreach (get_menu() as $menu)
            <li class="nav-item">
                {!! $menu !!}
            </li>
            @endforeach
           
            @endif
            <script>
                 $("#periode").change(function (){
                    document.getElementById('periodeButton').click();
                 });
            </script>
        </ul>
    </div>
</nav>
<!-- partial -->
