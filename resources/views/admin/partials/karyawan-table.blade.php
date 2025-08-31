<tbody>
    @forelse($karyawan as $index => $employee)
    <tr>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">{{ $karyawan->firstItem() + $index }}</td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <img src="/image/default-avatar.png" alt="Foto" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <div>
                <strong style="color: #1e293b;">{{ $employee->nama }}</strong>
                <br>
                <small style="color: #64748b;">{{ $employee->email }}</small>
            </div>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <strong style="color: #1e293b;">{{ $employee->divisi }}</strong>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <span class="badge-department">{{ $employee->divisi }}</span>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <span class="badge-active">Aktif</span>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0;">
            <small style="color: #64748b;">{{ $employee->created_at->format('d M Y') }}</small>
        </td>
        <td style="font-size: 0.85rem; border: none; padding: 12px 0; text-align: center;">
            <div class="action-dropdown">
                <button class="action-dropdown-btn" data-employee-id="{{ $employee->id_karyawan }}">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="action-dropdown-menu">
                    <button class="action-dropdown-item view-item" onclick="viewEmployee({{ $employee->id_karyawan }})">
                        <i class="fas fa-eye me-2"></i>Detail
                    </button>
                    <button class="action-dropdown-item edit-item" onclick="editEmployee({{ $employee->id_karyawan }})">
                        <i class="fas fa-edit me-2"></i>Edit
                    </button>
                    <button class="action-dropdown-item delete-item" onclick="deleteEmployee({{ $employee->id_karyawan }})">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" style="text-align: center; padding: 50px 0; color: #64748b;">
            <i class="fas fa-users fa-3x mb-3" style="opacity: 0.3;"></i>
            <p>Tidak ada data karyawan ditemukan</p>
        </td>
    </tr>
    @endforelse
</tbody>
