<!-- Dynamic Navbar Component -->
@auth('pelanggan')
    @include('layouts.authenticated-navbar')
@else
    @include('layouts.guest-navbar')
@endauth
