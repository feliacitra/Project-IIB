<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <form id="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf <!-- CSRF protection token -->
        <button type="submit" style="display: none;">Logout</button>
    </form>
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>{{ count(Auth::user()->unreadNotifications) }} New Notifications</p>
                        <a href="javascript:;" class="text-muted">Clear all</a>
                    </div>
                    <div class="p-1">

                        @foreach(Auth::user()->unreadNotifications as $notification)
                        <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="bell"></i>
                            </div>
                            <div class="flex-grow-1 me-2">
                                <p>{{ $notification->data['message'] }}</p>
                                <p class="tx-12 text-muted">30 min ago</p>
                            </div>
                        </a>
                        @endforeach
                       


                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                    @if (optional(auth()->user()->user_detail)->ud_photo)
                        <img class="wd-30 ht-30 rounded-circle" src="{{ url('storage/' . auth()->user()->user_detail->ud_photo) }}" alt="profile">
                    @else
                        <img class="wd-30 ht-30 rounded-circle" src="{{ asset('back/images/logo/user.png') }}" alt="profile">
                    @endif
                    
                    {{-- <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile"> --}}
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">

                            @if (optional(auth()->user()->user_detail)->ud_photo)
                                <img class="wd-80 ht-80 rounded-circle" src="{{ url('storage/' . auth()->user()->user_detail->ud_photo) }}" alt="profile">
                            @else
                                <img class="wd-80 ht-80 rounded-circle" src="{{ asset('back/images/logo/user.png') }}" alt="profile">
                            @endif
                            
                            {{-- <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt=""> --}}
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ auth()->user()->name }}</p>
                            <p class="tx-12 text-muted">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{route('detail-profile',auth()->user()->name)}}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="{{ route('edit-profile', auth()->user()->name) }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="{{ route('change-password') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        {{-- <li class="dropdown-item py-2">
                            <a href="javascript:;" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="repeat"></i>
                                <span>Switch User</span>
                            </a>
                        </li> --}}
                        <li id="logout-btn" class="dropdown-item py-2">
                            <a href="{{ route('logout') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
