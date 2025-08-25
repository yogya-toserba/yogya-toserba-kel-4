<div class="sidebar p-3">
  <h4 class="mb-4">My<span class="fw-bold">YOGYA</span></h4>

  <a href="{{ route('gudang.dahsboard') }}" class="{{ request()->routeIs('gudang.dahsboard') ? 'active' : '' }}">
    <i class="fa fa-chart-line me-2"></i> Dashboard
  </a>

  <a href="{{ route('gudang.permintaan') }}" class="{{ request()->routeIs('gudang.permintaan') ? 'active' : '' }}">
    <i class="fa fa-boxes me-2"></i> Permintaan
  </a>

  <a href="{{ route('gudang.stok') }}" class="{{ request()->routeIs('gudang.stok') ? 'active' : '' }}">
    <i class="fa fa-warehouse me-2"></i> Stok
  </a>

  <a href="{{ route('gudang.pengiriman') }}" class="{{ request()->routeIs('gudang.pengiriman') ? 'active' : '' }}">
    <i class="fa fa-truck me-2"></i> Pengiriman
  </a>

  <a href="{{ route('gudang.logistik') }}" class="{{ request()->routeIs('gudang.logistik') ? 'active' : '' }}">
    <i class="fa fa-truck me-2"></i> Logistik
  </a>

  <a href="{{ route('gudang.pemasok') }}" class="{{ request()->routeIs('gudang.pemasok') ? 'active' : '' }}">
    <i class="fa fa-handshake me-2"></i> Pemasok
  </a>

  <a href="{{ route('gudang.resiko') }}" class="{{ request()->routeIs('gudang.resiko') ? 'active' : '' }}">
    <i class="fa fa-exclamation-triangle me-2"></i> Risiko
  </a>
</div>
