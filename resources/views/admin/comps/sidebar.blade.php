<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="/images/logo-mini.svg" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1" >
            <h5 class="mb-0">Dashboard</h5>
        </div>
        <div class="sidebar-close ">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="/admin">
                    <div class="parent-icon">
                        <span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="/admin/clients">
                    <div class="parent-icon">
                        <span class="material-symbols-outlined">account_circle</span>
                    </div>
                    <div class="menu-title">Clients</div>
                </a>
            </li>
            <li>
                <a href="/admin/shows">
                    <div class="parent-icon">
                        <span class="material-symbols-outlined">slideshow</span>
                    </div>
                    <div class="menu-title">Shows</div>
                </a>
            </li>
            <li>
                <a href="/admin/episodes">
                    <div class="parent-icon">
                        <span class="material-symbols-outlined">play_circle</span>
                    </div>
                    <div class="menu-title">Episodes</div>
                </a>
            </li>
            <li>
                <a href="/admin/celebrities">
                    <div class="parent-icon">
                        <span class="material-symbols-outlined">
                            video_camera_front
                        </span>
                    </div>
                    <div class="menu-title">Celebrities</div>
                </a>
            </li>
        </ul>
        <!--end navigation-->
    </div>
    <div class="sidebar-bottom dropdown dropup-center dropup">
        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
            <div class="user-img">
                <img class="profile-avatar" src="{{ $base }}/avatars/{{ Session::get("avatar") }}" alt="">
            </div>
            <div class="user-info">
                <h5 class="mb-0 user-name">{{ Session::get("name") }}</h5>
                <p class="mb-0 user-designation text-capitalize">{{ Session::get("role") }}</p>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="javascript:;"><span class="material-symbols-outlined me-2">
                account_circle
                </span><span>Profile</span></a>
            </li>
            <li>
                <div class="dropdown-divider mb-0"></div>
            </li>
            <li><a class="dropdown-item" href="/logout"><span class="material-symbols-outlined me-2">
                logout
                </span><span>Logout</span></a>
            </li>
        </ul>
    </div>
</aside>