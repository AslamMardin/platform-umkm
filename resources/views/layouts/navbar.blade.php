<div class="col-md-3 sidebar p-0">
    <div class="p-4">
        <h6 class="fw-bold text-muted mb-3">MENU UTAMA</h6>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('project') ? 'active' : '' }}" href="{{ route('project') }}">
                    <i class="fas fa-folder me-2"></i>Project Saya
                </a>

            </li>

            @if (Auth::check() && Auth::user()->name === 'Admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-tools me-1"></i> Menu Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i
                                    class="fas fa-users me-2"></i>Kelola User</a></li>
                        <li><a class="dropdown-item" href="{{ route('templates-app.index') }}"><i
                                    class="fas fa-users me-2"></i>Kelola Template</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
