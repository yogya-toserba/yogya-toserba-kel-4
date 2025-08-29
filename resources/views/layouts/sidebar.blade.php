<div class="sidebar" id="sidebar">
  <!-- LOGO & BRAND SECTION -->
  <div class="sidebar-brand">
    <div class="brand-logo">
      <img src="{{ asset('image/logo_yogya.png') }}" alt="YOGYA Logo" class="yogya-logo">
    </div>
    <div class="brand-text">
      <h3>My<span class="brand-highlight">YOGYA</span></h3>
      <p class="brand-subtitle">Rantai Pasok</p>
    </div>
  </div>

  <!-- NAVIGATION MENU -->
  <div class="sidebar-nav">
    <a href="{{ route('gudang.dashboard') }}" class="nav-item {{ request()->routeIs('gudang.dashboard') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <span class="nav-text">Dashboard</span>
      @if(request()->routeIs('gudang.dashboard'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('gudang.permintaan') }}" class="nav-item {{ request()->routeIs('gudang.permintaan') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-boxes"></i>
      </div>
      <span class="nav-text">Permintaan</span>
      @if(request()->routeIs('gudang.permintaan'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('gudang.stok') }}" class="nav-item {{ request()->routeIs('gudang.stok') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-warehouse"></i>
      </div>
      <span class="nav-text">Stok</span>
      @if(request()->routeIs('gudang.stok'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('gudang.pengiriman') }}" class="nav-item {{ request()->routeIs('gudang.pengiriman') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-truck"></i>
      </div>
      <span class="nav-text">Pengiriman</span>
      @if(request()->routeIs('gudang.pengiriman'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('gudang.logistik') }}" class="nav-item {{ request()->routeIs('gudang.logistik') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-route"></i>
      </div>
      <span class="nav-text">Logistik</span>
      @if(request()->routeIs('gudang.logistik'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('gudang.pemasok') }}" class="nav-item {{ request()->routeIs('gudang.pemasok') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-handshake"></i>
      </div>
      <span class="nav-text">Pemasok</span>
      @if(request()->routeIs('gudang.pemasok'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('gudang.resiko') }}" class="nav-item {{ request()->routeIs('gudang.resiko') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <span class="nav-text">Risiko</span>
      @if(request()->routeIs('gudang.resiko'))
        <div class="nav-indicator"></div>
      @endif
    </a>
  </div>

  <!-- ADMIN PROFILE DROPDOWN WITH TOGGLE -->
  <div class="sidebar-footer">
    <div class="admin-dropdown">
      <div class="admin-profile" onclick="toggleAdminDropdown()">
        <div class="admin-avatar">
          <div class="avatar-circle">
            <i class="fas fa-user"></i>
          </div>
          <div class="user-status online"></div>
        </div>
        <div class="admin-info">
          <h5 class="admin-name">Admin Gudang</h5>
          <p class="admin-role">Supervisor</p>
        </div>
        <div class="admin-actions">
          <!-- Mode Toggle Button -->
          <button class="mode-toggle-btn" onclick="toggleDarkMode(event)" id="mode-toggle" title="Toggle Dark Mode">
            <i class="fas fa-moon" id="mode-icon"></i>
          </button>
          <div class="dropdown-arrow">
            <i class="fas fa-chevron-down" id="dropdown-icon"></i>
          </div>
        </div>
      </div>
      
      <!-- Dropdown Menu -->
      <div class="dropdown-menu" id="admin-dropdown">
        <div class="dropdown-item" onclick="handleAbsensi()">
          <i class="fas fa-clock"></i>
          <span>Absensi</span>
          <small id="current-time">{{ date('H:i') }}</small>
        </div>
        <div class="dropdown-divider"></div>
        <div class="dropdown-item logout-item" onclick="handleLogout()">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
          <small>Keluar sistem</small>
        </div>
      </div>
    </div>

    <!-- Footer Info -->
    <div class="sidebar-info">
      <p class="app-version">
        <i class="fas fa-code-branch"></i>
        v2.1.3
      </p>
      <p class="last-login">
        <i class="fas fa-clock"></i>
        Login: {{ date('d/m/Y H:i') }}
      </p>
    </div>
  </div>
</div>

<style>
  :root {
    --light-bg: #ffffff;
    --light-sidebar-bg: #f8f9fc;
    --light-border: #e3e6f0;
    --light-text: #2c3e50;
    --light-text-secondary: #6c757d;
    --light-nav-hover: #f1f3f9;
    --light-card-bg: #ffffff;
    --light-shadow: rgba(0, 0, 0, 0.08);
    --dark-bg: #1a1d29;
    --dark-sidebar-bg: #252837;
    --dark-border: #3a3d4a;
    --dark-text: #e2e8f0;
    --dark-text-secondary: #94a3b8;
    --dark-nav-hover: #2d3142;
    --dark-card-bg: #2a2d3f;
    --dark-shadow: rgba(0, 0, 0, 0.3);
    --yogya-orange: #f26b37;
    --yogya-orange-dark: #e55827;
    --yogya-gradient: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-orange-dark) 100%);
  }

  body.dark-mode {
    background-color: var(--dark-bg) !important;
    color: var(--dark-text) !important;
  }

  body.dark-mode .main-content {
    background-color: var(--dark-bg) !important;
  }

  body.dark-mode .card {
    background: var(--dark-card-bg) !important;
    border-color: var(--dark-border) !important;
    color: var(--dark-text) !important;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 280px;
    background: var(--light-sidebar-bg);
    border-right: 2px solid var(--light-border);
    z-index: 1000;
    overflow-y: auto;
    transition: all 0.3s ease;
    box-shadow: 2px 0 12px var(--light-shadow);
    display: flex;
    flex-direction: column;
  }

  body.dark-mode .sidebar {
    background: var(--dark-sidebar-bg);
    border-right-color: var(--dark-border);
    box-shadow: 2px 0 12px var(--dark-shadow);
  }

  .sidebar-brand {
    padding: 20px 18px;
    text-align: center;
    border-bottom: 2px solid var(--light-border);
    background: var(--light-card-bg);
  }

  body.dark-mode .sidebar-brand {
    border-bottom-color: var(--dark-border);
    background: var(--dark-card-bg);
  }

  .brand-logo {
    margin-bottom: 10px;
  }

  .yogya-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--yogya-orange);
    padding: 2px;
    background: white;
    box-shadow: 0 3px 8px rgba(242, 107, 55, 0.3);
  }

  .brand-text h3 {
    font-size: 20px;
    font-weight: 700;
    margin: 0;
    color: var(--light-text);
    font-family: 'Inter', sans-serif;
  }

  body.dark-mode .brand-text h3 {
    color: var(--dark-text);
  }

  .brand-highlight {
    color: var(--yogya-orange);
  }

  .brand-subtitle {
    font-size: 12px;
    color: var(--light-text-secondary);
    margin: 3px 0 0 0;
    font-weight: 500;
  }

  body.dark-mode .brand-subtitle {
    color: var(--dark-text-secondary);
  }

  .sidebar-nav {
    flex: 1;
    padding: 18px 12px;
  }

  .nav-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    color: var(--light-text);
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 6px;
    transition: all 0.3s ease;
    position: relative;
    font-weight: 500;
    gap: 12px;
  }

  body.dark-mode .nav-item {
    color: var(--dark-text);
  }

  .nav-item:hover {
    background: var(--light-nav-hover);
    transform: translateX(2px);
    box-shadow: 0 1px 4px var(--light-shadow);
  }

  body.dark-mode .nav-item:hover {
    background: var(--dark-nav-hover);
    box-shadow: 0 1px 4px var(--dark-shadow);
  }

  .nav-item.active {
    background: var(--yogya-gradient);
    color: white;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.4);
  }

  .nav-item.active:hover {
    transform: translateX(0);
  }

  .nav-icon {
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .nav-icon i {
    font-size: 15px;
  }

  .nav-text {
    font-size: 14px;
    flex: 1;
  }

  .nav-indicator {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 20px;
    background: white;
    border-radius: 2px;
  }

  .sidebar-footer {
    padding: 18px;
    border-top: 2px solid var(--light-border);
    background: var(--light-card-bg);
  }

  body.dark-mode .sidebar-footer {
    border-top-color: var(--dark-border);
    background: var(--dark-card-bg);
  }

  .admin-dropdown {
    position: relative;
  }

  .admin-profile {
    display: flex;
    align-items: center;
    padding: 12px;
    background: var(--light-bg);
    border-radius: 8px;
    border: 2px solid var(--light-border);
    cursor: pointer;
    transition: all 0.3s ease;
    gap: 10px;
  }

  body.dark-mode .admin-profile {
    background: var(--dark-bg);
    border-color: var(--dark-border);
  }

  .admin-profile:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 6px var(--light-shadow);
  }

  body.dark-mode .admin-profile:hover {
    box-shadow: 0 2px 6px var(--dark-shadow);
  }

  .admin-avatar {
    position: relative;
  }

  .avatar-circle {
    width: 38px;
    height: 38px;
    background: var(--yogya-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 15px;
    box-shadow: 0 2px 6px rgba(242, 107, 55, 0.3);
  }

  .user-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    background: #22c55e;
    border-radius: 50%;
    border: 2px solid white;
  }

  .admin-info {
    flex: 1;
  }

  .admin-name {
    font-size: 14px;
    font-weight: 700;
    margin: 0;
    color: var(--light-text);
    line-height: 1.2;
  }

  body.dark-mode .admin-name {
    color: var(--dark-text);
  }

  .admin-role {
    font-size: 12px;
    font-weight: 400;
    color: var(--light-text-secondary);
    margin: 2px 0 0 0;
    line-height: 1.2;
  }

  body.dark-mode .admin-role {
    color: var(--dark-text-secondary);
  }

  body.dark-mode .admin-role {
    color: var(--dark-text-secondary);
  }

  .admin-actions {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .mode-toggle-btn {
    width: 28px;
    height: 28px;
    background: var(--yogya-gradient);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 1px 4px rgba(242, 107, 55, 0.3);
  }

  .mode-toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 2px 6px rgba(242, 107, 55, 0.4);
  }

  .dropdown-arrow {
    transition: transform 0.3s ease;
  }

  .dropdown-arrow.rotated {
    transform: rotate(180deg);
  }

  .dropdown-menu {
    position: absolute;
    bottom: 100%;
    left: 0;
    right: 0;
    background: var(--light-card-bg);
    border: 2px solid var(--light-border);
    border-radius: 8px;
    box-shadow: 0 4px 12px var(--light-shadow);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
    z-index: 1001;
    margin-bottom: 5px;
  }

  body.dark-mode .dropdown-menu {
    background: var(--dark-card-bg);
    border-color: var(--dark-border);
    box-shadow: 0 4px 12px var(--dark-shadow);
  }

  .dropdown-menu.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .dropdown-item {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    gap: 10px;
  }

  .dropdown-item:hover {
    background: var(--light-nav-hover);
  }

  body.dark-mode .dropdown-item:hover {
    background: var(--dark-nav-hover);
  }

  .dropdown-item i {
    width: 16px;
    font-size: 13px;
    color: var(--light-text-secondary);
  }

  body.dark-mode .dropdown-item i {
    color: var(--dark-text-secondary);
  }

  .dropdown-item span {
    flex: 1;
    font-size: 13px;
    font-weight: 500;
    color: var(--light-text);
  }

  body.dark-mode .dropdown-item span {
    color: var(--dark-text);
  }

  .dropdown-item small {
    font-size: 11px;
    color: var(--light-text-secondary);
  }

  body.dark-mode .dropdown-item small {
    color: var(--dark-text-secondary);
  }

  .dropdown-divider {
    height: 1px;
    background: var(--light-border);
    margin: 4px 0;
  }

  body.dark-mode .dropdown-divider {
    background: var(--dark-border);
  }

  .logout-item:hover {
    background: #fef2f2 !important;
  }

  body.dark-mode .logout-item:hover {
    background: #1a0f0f !important;
  }

  .sidebar-info {
    text-align: center;
    padding-top: 8px;
    border-top: 1px solid var(--light-border);
    margin-top: 10px;
  }

  body.dark-mode .sidebar-info {
    border-top-color: var(--dark-border);
  }

  .app-version, .last-login {
    font-size: 10px;
    color: var(--light-text-secondary);
    margin: 2px 0;
  }

  body.dark-mode .app-version,
  body.dark-mode .last-login {
    color: var(--dark-text-secondary);
  }

  @media (max-width: 768px) {
    .sidebar {
      width: 80px;
    }
    
    .nav-text, .brand-text, .admin-info {
      display: none;
    }
    
    .nav-item {
      justify-content: center;
      padding: 12px 10px;
    }
  }
</style>

<script>
  function toggleDarkMode(event) {
    if (event) {
      event.stopPropagation();
    }
    
    const body = document.body;
    const modeIcon = document.getElementById('mode-icon');
    
    body.classList.toggle('dark-mode');
    
    if (body.classList.contains('dark-mode')) {
      modeIcon.className = 'fas fa-sun';
      localStorage.setItem('theme', 'dark');
    } else {
      modeIcon.className = 'fas fa-moon';
      localStorage.setItem('theme', 'light');
    }
  }

  function toggleAdminDropdown() {
    const dropdown = document.getElementById('admin-dropdown');
    const arrow = document.getElementById('dropdown-icon');
    
    dropdown.classList.toggle('show');
    arrow.parentElement.classList.toggle('rotated');
  }

  document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('admin-dropdown');
    const adminProfile = document.querySelector('.admin-profile');
    
    if (dropdown && adminProfile && !adminProfile.contains(event.target)) {
      dropdown.classList.remove('show');
      document.getElementById('dropdown-icon').parentElement.classList.remove('rotated');
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme');
    const body = document.body;
    const modeIcon = document.getElementById('mode-icon');
    
    if (savedTheme === 'dark') {
      body.classList.add('dark-mode');
      modeIcon.className = 'fas fa-sun';
    }
    
    updateTime();
    setInterval(updateTime, 1000);
  });

  function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit'
    });
    
    const timeElement = document.getElementById('current-time');
    if (timeElement) {
      timeElement.textContent = timeString;
    }
  }

  function handleAbsensi() {
    const dropdown = document.getElementById('admin-dropdown');
    dropdown.classList.remove('show');
    document.getElementById('dropdown-icon').parentElement.classList.remove('rotated');
    
    if (confirm('Apakah Anda yakin ingin melakukan absensi sekarang?')) {
      alert('Absensi berhasil! Waktu: ' + new Date().toLocaleString('id-ID'));
    }
  }

  function handleLogout() {
    const dropdown = document.getElementById('admin-dropdown');
    dropdown.classList.remove('show');
    document.getElementById('dropdown-icon').parentElement.classList.remove('rotated');
    
    if (confirm('Apakah Anda yakin ingin logout dari sistem?')) {
      // Create a form to submit logout request properly
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '{{ route("gudang.logout") }}';
      
      // Add CSRF token
      const csrfToken = document.createElement('input');
      csrfToken.type = 'hidden';
      csrfToken.name = '_token';
      csrfToken.value = '{{ csrf_token() }}';
      form.appendChild(csrfToken);
      
      document.body.appendChild(form);
      form.submit();
    }
  }
</script>
