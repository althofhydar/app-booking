<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-10">
            <i class="fas fa-dragon"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tiket.in</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if(auth()->user()->level == 'admin')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa fa-th-large"></i>
            <span>Dashboard</span></a>
    </li>
    @endif

    @if(auth()->user()->level == 'admin')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('event.index') }}">
            <i class="fa fa-list-alt"></i>
            <span>Event</span></a>
    </li>
    @endif

    @if(auth()->user()->level == 'admin')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('ticket.index') }}">
            <i class="fas fa-fw fa-solid fa-box"></i>
            <span>Ticket</span></a>
    </li>
    @endif

    @if(auth()->user()->level == 'admin')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-solid fa-user"></i>
            <span>User</span></a>
    </li>
    @endif
  



    @if(auth()->user()->level == 'user')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('events') }}">
            <i class="fa fa-th-large"></i>
            <span>Beranda</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  

</ul>