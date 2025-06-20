<span class="text-muted">Selamat datang,</span>
<div class="dropdown">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-cog me-2"></i>Ubah Profile</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirmLogout();">
                @csrf
                <button class="dropdown-item" type="submit">
                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </li>
    </ul>
</div>

<script>
    function confirmLogout() {
        return confirm('Apakah Anda yakin ingin keluar?');
    }
</script>
