<div class="sidebar" id="sidebar">
  <!-- LOGO & BRAND SECTION -->
  <div class="sidebar-brand">
    <div class="brand-logo">
      <img src="{{ asset('image/logo_yogya.png') }}" alt="YOGYA Logo" class="yogya-logo">
    </div>
    <div class="brand-text">
      <h3>My<span class="brand-highlight">YOGYA</span></h3>
      <p class="brand-subtitle">Supplier Panel</p>
    </div>
  </div>

  <!-- NOTIFICATION SECTION -->
  <div class="notification-section">
    <div class="notification-header">
      <i class="fas fa-bell"></i>
      <span>Notifikasi</span>
      <span class="notification-count" id="notificationCount">0</span>
    </div>
    <div class="notification-list" id="notificationList">
      <!-- Notifikasi akan dimuat di sini -->
    </div>
  </div>

  <!-- NAVIGATION MENU -->
  <div class="sidebar-nav">
    <a href="{{ route('supplier.dashboard') }}" class="nav-item {{ request()->routeIs('supplier.dashboard') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <span class="nav-text">Dashboard</span>
      @if(request()->routeIs('supplier.dashboard'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('supplier.profile') }}" class="nav-item {{ request()->routeIs('supplier.profile') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-user"></i>
      </div>
      <span class="nav-text">Profil</span>
      @if(request()->routeIs('supplier.profile'))
        <div class="nav-indicator"></div>
      @endif
    </a>

    <a href="{{ route('supplier.chat') }}" class="nav-item {{ request()->routeIs('supplier.chat*') ? 'active' : '' }}">
      <div class="nav-icon">
        <i class="fas fa-comments"></i>
      </div>
      <span class="nav-text">Chat Gudang</span>
      @if(request()->routeIs('supplier.chat*'))
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
            <i class="fas fa-truck"></i>
          </div>
          <div class="user-status online"></div>
        </div>
        <div class="admin-info">
          <h5 class="admin-name">Supplier</h5>
          <p class="admin-role">{{ Auth::guard('pemasok')->user()->nama_lengkap ?? 'Supplier User' }}</p>
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
        v1.0.0
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
    color: var(--yogya-orange);
    text-decoration: none;
    transform: translateX(2px);
  }

  body.dark-mode .nav-item:hover {
    background: var(--dark-nav-hover);
    color: var(--yogya-orange);
  }

  .nav-item.active {
    background: var(--yogya-gradient);
    color: white;
    box-shadow: 0 4px 8px rgba(242, 107, 55, 0.3);
    font-weight: 600;
  }

  .nav-item.active:hover {
    color: white;
    transform: none;
  }

  .nav-icon {
    width: 18px;
    text-align: center;
    font-size: 16px;
    position: relative;
  }

  .nav-text {
    font-size: 14px;
    letter-spacing: 0.2px;
  }

  .nav-indicator {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 20px;
    background: white;
    border-radius: 2px 0 0 2px;
  }

  .chat-badge {
    position: absolute;
    top: -3px;
    right: -3px;
    background: #dc3545;
    color: white;
    font-size: 9px;
    font-weight: 700;
    padding: 2px 5px;
    border-radius: 8px;
    min-width: 16px;
    text-align: center;
    line-height: 1;
    border: 1px solid var(--light-sidebar-bg);
  }

  body.dark-mode .chat-badge {
    border-color: var(--dark-sidebar-bg);
  }

  .notification-section {
    margin: 20px 15px 10px 15px;
    background: var(--light-card-bg);
    border-radius: 12px;
    border: 1px solid var(--light-border);
    overflow: hidden;
  }

  body.dark-mode .notification-section {
    background: var(--dark-card-bg);
    border-color: var(--dark-border);
  }

  .notification-header {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background: var(--yogya-gradient);
    color: white;
    font-size: 13px;
    font-weight: 600;
  }

  .notification-header i {
    margin-right: 8px;
  }

  .notification-count {
    margin-left: auto;
    background: rgba(255, 255, 255, 0.3);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
  }

  .notification-list {
    max-height: 200px;
    overflow-y: auto;
  }

  .notification-item {
    padding: 12px 15px;
    border-bottom: 1px solid var(--light-border);
    cursor: pointer;
    transition: background 0.3s ease;
  }

  body.dark-mode .notification-item {
    border-bottom-color: var(--dark-border);
  }

  .notification-item:hover {
    background: var(--light-nav-hover);
  }

  body.dark-mode .notification-item:hover {
    background: var(--dark-nav-hover);
  }

  .notification-item:last-child {
    border-bottom: none;
  }

  .sidebar-footer {
    margin-top: auto;
    padding: 15px;
    border-top: 2px solid var(--light-border);
    background: var(--light-card-bg);
  }

  body.dark-mode .sidebar-footer {
    background: var(--dark-card-bg);
    border-top-color: var(--dark-border);
  }

  .admin-dropdown {
    position: relative;
  }

  .admin-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--light-bg);
    border: 1px solid var(--light-border);
  }

  body.dark-mode .admin-profile {
    background: var(--dark-bg);
    border-color: var(--dark-border);
  }

  .admin-profile:hover {
    background: var(--light-nav-hover);
    border-color: var(--yogya-orange);
  }

  body.dark-mode .admin-profile:hover {
    background: var(--dark-nav-hover);
  }

  .admin-avatar {
    position: relative;
  }

  .avatar-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--yogya-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    box-shadow: 0 2px 6px rgba(242, 107, 55, 0.3);
  }

  .user-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid white;
  }

  .user-status.online {
    background: #10b981;
  }

  body.dark-mode .user-status {
    border-color: var(--dark-card-bg);
  }

  .admin-info {
    flex: 1;
    min-width: 0;
  }

  .admin-name {
    font-size: 13px;
    font-weight: 600;
    margin: 0 0 2px 0;
    color: var(--light-text);
    line-height: 1.2;
  }

  body.dark-mode .admin-name {
    color: var(--dark-text);
  }

  .admin-role {
    font-size: 11px;
    color: var(--light-text-secondary);
    margin: 0;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  body.dark-mode .admin-role {
    color: var(--dark-text-secondary);
  }

  .admin-actions {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .mode-toggle-btn {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    border: 1px solid var(--light-border);
    background: var(--light-bg);
    color: var(--light-text-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 11px;
  }

  body.dark-mode .mode-toggle-btn {
    border-color: var(--dark-border);
    background: var(--dark-bg);
    color: var(--dark-text-secondary);
  }

  .mode-toggle-btn:hover {
    background: var(--yogya-orange);
    border-color: var(--yogya-orange);
    color: white;
  }

  .dropdown-arrow {
    color: var(--light-text-secondary);
    font-size: 10px;
    transition: transform 0.3s ease;
  }

  body.dark-mode .dropdown-arrow {
    color: var(--dark-text-secondary);
  }

  .admin-dropdown.open .dropdown-arrow {
    transform: rotate(180deg);
  }

  .dropdown-menu {
    position: absolute;
    bottom: 100%;
    left: 0;
    right: 0;
    background: var(--light-bg);
    border: 1px solid var(--light-border);
    border-radius: 10px;
    box-shadow: 0 6px 20px var(--light-shadow);
    margin-bottom: 8px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
    z-index: 1000;
  }

  body.dark-mode .dropdown-menu {
    background: var(--dark-card-bg);
    border-color: var(--dark-border);
    box-shadow: 0 6px 20px var(--dark-shadow);
  }

  .admin-dropdown.open .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    color: var(--light-text);
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    font-size: 12px;
  }

  body.dark-mode .dropdown-item {
    color: var(--dark-text);
  }

  .dropdown-item:hover {
    background: var(--light-nav-hover);
    color: var(--yogya-orange);
  }

  body.dark-mode .dropdown-item:hover {
    background: var(--dark-nav-hover);
  }

  .dropdown-item:first-child {
    border-radius: 10px 10px 0 0;
  }

  .dropdown-item:last-child {
    border-radius: 0 0 10px 10px;
  }

  .dropdown-item i {
    width: 14px;
    text-align: center;
  }

  .dropdown-item small {
    margin-left: auto;
    color: var(--light-text-secondary);
    font-size: 10px;
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

  .logout-item {
    color: #dc2626 !important;
  }

  .logout-item:hover {
    background: rgba(220, 38, 38, 0.1) !important;
    color: #dc2626 !important;
  }

  .sidebar-info {
    text-align: center;
    padding: 15px;
    margin-top: auto;
    background: transparent;
    border-top: 1px solid var(--light-border);
  }

  body.dark-mode .sidebar-info {
    background: transparent;
    border-top-color: var(--dark-border);
  }

  .sidebar-info p {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
  }

  .app-version, .last-login {
    font-size: 10px;
    color: var(--light-text-secondary);
    margin: 2px 0;
    border: none !important;
    outline: none !important;
  }

  body.dark-mode .app-version,
  body.dark-mode .last-login {
    color: var(--dark-text-secondary);
  }

  /* RESPONSIVE */
  @media (max-width: 768px) {
    .sidebar {
      transform: translateX(-100%);
    }
    
    .sidebar.open {
      transform: translateX(0);
    }
  }

  /* SCROLLBAR */
  .sidebar::-webkit-scrollbar {
    width: 4px;
  }

  .sidebar::-webkit-scrollbar-track {
    background: transparent;
  }

  .sidebar::-webkit-scrollbar-thumb {
    background: var(--light-border);
    border-radius: 2px;
  }

  body.dark-mode .sidebar::-webkit-scrollbar-thumb {
    background: var(--dark-border);
  }

  .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--yogya-orange);
  }
</style>

<script>
// Toggle admin dropdown
function toggleAdminDropdown() {
  const dropdown = document.querySelector('.admin-dropdown');
  dropdown.classList.toggle('open');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
  const dropdown = document.querySelector('.admin-dropdown');
  if (!dropdown.contains(event.target)) {
    dropdown.classList.remove('open');
  }
});

// Dark mode toggle
function toggleDarkMode(event) {
  event.stopPropagation();
  document.body.classList.toggle('dark-mode');
  
  const icon = document.getElementById('mode-icon');
  if (document.body.classList.contains('dark-mode')) {
    icon.className = 'fas fa-sun';
    localStorage.setItem('darkMode', 'true');
  } else {
    icon.className = 'fas fa-moon';
    localStorage.setItem('darkMode', 'false');
  }
}

// Load dark mode preference
document.addEventListener('DOMContentLoaded', function() {
  const darkMode = localStorage.getItem('darkMode');
  const icon = document.getElementById('mode-icon');
  
  if (darkMode === 'true') {
    document.body.classList.add('dark-mode');
    icon.className = 'fas fa-sun';
  }
  
  // Update current time
  updateCurrentTime();
  setInterval(updateCurrentTime, 60000); // Update every minute
});

// Update current time
function updateCurrentTime() {
  const timeElement = document.getElementById('current-time');
  if (timeElement) {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit'
    });
    timeElement.textContent = timeString;
  }
}

// Handle absensi
function handleAbsensi() {
  alert('Fitur absensi akan segera tersedia');
}

// Handle logout
function handleLogout() {
  if (confirm('Apakah Anda yakin ingin logout?')) {
    // Create a form and submit it
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("supplier.logout") }}';
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    
    form.appendChild(csrfToken);
    document.body.appendChild(form);
    form.submit();
  }
}

// Load notifications (placeholder)
function loadNotifications() {
  // This can be implemented with actual notification data
  document.getElementById('notificationCount').textContent = '0';
}

// Initialize
loadNotifications();
</script>
