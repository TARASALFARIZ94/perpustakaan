<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
    <li class="nav-item nav-profile">
        <a href="{{route('logout')}}" class="nav-link">
        <div class="nav-profile-image">
            <img src="assets/images/faces/face1.jpg" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">Taras Al Fariz</span>
            <span class="text-secondary text-small">Project Manager</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('member')}}">
        <span class="menu-title">Manage Member</span>
        <i class="mdi mdi-account menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('buku')}}">
        <span class="menu-title">Manage Books</span>
        <i class="mdi mdi-book-outline menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('pinjam')}}">
        <span class="menu-title">Manage Loans</span>
        <i class="mdi mdi-book menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('kembali')}}">
        <span class="menu-title">Manage Returns</span>
        <i class="mdi mdi-library menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('kategori')}}">
        <span class="menu-title">Manage Categories</span>
        <i class="mdi mdi-table-large menu-icon"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('user')}}">
        <span class="menu-title">Manage Staff</span>
        <i class="mdi mdi-lock menu-icon"></i>
        </a>
    </li>
    </ul>
</nav>
<!-- partial -->
 <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
 {{$slot}}
 </div>

<!-- isi konten -->
<!-- main-panel ends -->