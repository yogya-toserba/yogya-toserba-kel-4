<div class="pagination-container">
    <div class="pagination-info">
        Menampilkan {{ $karyawan->firstItem() ?? 0 }}-{{ $karyawan->lastItem() ?? 0 }} dari {{ $karyawan->total() }} karyawan
    </div>
    <div class="pagination-wrapper">
        {{ $karyawan->appends(request()->query())->links('custom.pagination') }}
    </div>
</div>
