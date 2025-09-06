<?php
// Check PHP environment
echo "=== DIAGNOSTIC: Three-Dot Dropdown (Titik 3) Bootstrap Conflicts ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n";
echo "PHP Version: " . phpversion() . "\n\n";

// Check files
$files_to_check = [
    'resources/views/admin/penggajian/index.blade.php',
    'resources/views/layouts/navbar_admin.blade.php'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "✅ File exists: $file\n";
        
        $content = file_get_contents($file);
        
        // Check for Bootstrap version
        if (preg_match('/bootstrap@(\d+\.\d+\.\d+)/', $content, $matches)) {
            echo "   Bootstrap version found: {$matches[1]}\n";
        }
        
        // Check for dropdown related code
        $dropdown_count = substr_count($content, 'dropdown');
        echo "   Dropdown references: $dropdown_count\n";
        
        // Check for three-dot icon
        $ellipsis_count = substr_count($content, 'fa-ellipsis');
        echo "   Three-dot icons: $ellipsis_count\n";
        
        // Check for potential conflicts
        $conflicts = [];
        
        if (strpos($content, 'display: none') !== false && strpos($content, 'dropdown-toggle::after') !== false) {
            $conflicts[] = "CSS hides Bootstrap dropdown arrow";
        }
        
        if (preg_match('/z-index:\s*(\d+)/', $content, $zIndexMatch)) {
            $zIndex = intval($zIndexMatch[1]);
            if ($zIndex < 1050) {
                $conflicts[] = "Z-index too low: $zIndex (should be >= 1050)";
            }
        }
        
        if (count($conflicts) > 0) {
            echo "   ⚠️  Potential conflicts:\n";
            foreach ($conflicts as $conflict) {
                echo "      - $conflict\n";
            }
        } else {
            echo "   ✅ No obvious conflicts detected\n";
        }
        
    } else {
        echo "❌ File not found: $file\n";
    }
    echo "\n";
}

// Create test HTML for browser testing
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic: Three-Dot Dropdown Bootstrap Conflicts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Replicate the exact styles from penggajian index */
        .dropdown-toggle::after {
            display: none !important;
        }

        .btn.dropdown-toggle {
            cursor: pointer;
            position: relative;
        }

        .btn.dropdown-toggle:hover {
            background-color: #f8f9fc !important;
            border-color: #d1d3e2 !important;
        }

        .dropdown-menu {
            border: 1px solid #e3e6f0 !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
            border-radius: 0.35rem !important;
            min-width: 10rem !important;
            z-index: 1055 !important;
            animation: dropdownFadeIn 0.2s ease-in-out;
        }

        @keyframes dropdownFadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem !important;
            transition: all 0.15s ease-in-out !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
        }

        .dropdown-item:hover {
            background-color: #f8f9fc !important;
            color: #3a3b45 !important;
            transform: translateX(3px);
        }

        .dropdown-item i {
            width: 16px !important;
            text-align: center !important;
            margin-right: 0.5rem !important;
        }

        .btn-outline-secondary {
            border-color: #d1d3e2 !important;
            color: #858796 !important;
        }

        .btn-outline-secondary:hover {
            background-color: #5a5c69 !important;
            border-color: #5a5c69 !important;
            color: white !important;
            transform: scale(1.05);
        }

        .dropdown-item.text-danger:hover {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }
        
        .diagnostic-box {
            background-color: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 1rem 0;
        }
        
        .status-ok { color: #28a745; }
        .status-warning { color: #ffc107; }
        .status-error { color: #dc3545; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3>🔍 Diagnostic: Three-Dot Dropdown Bootstrap Conflicts</h3>
        
        <div class="diagnostic-box">
            <h5>System Information</h5>
            <div id="systemInfo">Loading...</div>
        </div>
        
        <!-- Test Case 1: Basic Three-Dot Dropdown -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Test Case 1: Basic Three-Dot Dropdown</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Single Dropdown</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                type="button" 
                                id="testDropdown1"
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                                title="Menu Aksi">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" 
                                aria-labelledby="testDropdown1">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="testAction('view', 1)">
                                        <i class="fas fa-eye text-info"></i>Lihat Detail
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="testAction('edit', 1)">
                                        <i class="fas fa-edit text-warning"></i>Edit Gaji
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="testAction('delete', 1)">
                                        <i class="fas fa-trash"></i>Hapus
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Test Results</h6>
                        <div id="testResults1" class="diagnostic-box">
                            <em>Click the three-dot button to test...</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Test Case 2: Multiple Dropdowns in Table -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Test Case 2: Multiple Dropdowns in Table (Real scenario)</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Karyawan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>Karyawan <?= $i ?></td>
                            <td>
                                <span class="badge bg-<?= $i % 2 == 0 ? 'success' : 'warning' ?>">
                                    <?= $i % 2 == 0 ? 'Paid' : 'Pending' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                        type="button" 
                                        id="dropdownMenuButton<?= $i ?>"
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false"
                                        title="Menu Aksi">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" 
                                        aria-labelledby="dropdownMenuButton<?= $i ?>">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="testAction('view', <?= $i ?>)">
                                                <i class="fas fa-eye text-info"></i>Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="testAction('edit', <?= $i ?>)">
                                                <i class="fas fa-edit text-warning"></i>Edit Gaji
                                            </a>
                                        </li>
                                        <?php if($i % 2 != 0): // Pending status ?>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="testAction('mark_paid', <?= $i ?>)">
                                                <i class="fas fa-check text-success"></i>Tandai Dibayar
                                            </a>
                                        </li>
                                        <?php else: // Paid status ?>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="testAction('print_slip', <?= $i ?>)">
                                                <i class="fas fa-file-pdf text-primary"></i>Cetak Slip
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="testAction('delete', <?= $i ?>)">
                                                <i class="fas fa-trash"></i>Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Test Results -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Test Action Log</h5>
            </div>
            <div class="card-body">
                <div id="actionLog" class="diagnostic-box" style="max-height: 200px; overflow-y: auto;">
                    <em>Action results will appear here...</em>
                </div>
                <button class="btn btn-secondary btn-sm mt-2" onclick="clearLog()">Clear Log</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let actionCount = 0;
        
        // System information gathering
        document.addEventListener('DOMContentLoaded', function() {
            const systemInfo = document.getElementById('systemInfo');
            let info = [];
            
            try {
                // Bootstrap check
                if (typeof bootstrap !== 'undefined') {
                    const version = bootstrap.Tooltip.VERSION || 'Unknown';
                    info.push(`<span class="status-ok">✅ Bootstrap loaded: v${version}</span>`);
                } else {
                    info.push(`<span class="status-error">❌ Bootstrap not loaded</span>`);
                }
                
                // Dropdown count
                const dropdowns = document.querySelectorAll('.dropdown-toggle');
                info.push(`<span class="status-ok">✅ Found ${dropdowns.length} dropdown toggles</span>`);
                
                // Font Awesome check
                const faIcons = document.querySelectorAll('i[class*="fa-"]');
                info.push(`<span class="status-ok">✅ Found ${faIcons.length} Font Awesome icons</span>`);
                
                // Initialize dropdowns
                if (typeof bootstrap !== 'undefined') {
                    let successfulInits = 0;
                    dropdowns.forEach(function(dropdown) {
                        try {
                            new bootstrap.Dropdown(dropdown, {
                                boundary: 'viewport',
                                display: 'dynamic'
                            });
                            successfulInits++;
                            
                            // Add event listeners for testing
                            dropdown.addEventListener('show.bs.dropdown', function() {
                                logAction(`Dropdown ${this.id} is showing`);
                            });
                            
                            dropdown.addEventListener('shown.bs.dropdown', function() {
                                logAction(`Dropdown ${this.id} is shown (visible)`);
                            });
                            
                            dropdown.addEventListener('hide.bs.dropdown', function() {
                                logAction(`Dropdown ${this.id} is hiding`);
                            });
                            
                            dropdown.addEventListener('hidden.bs.dropdown', function() {
                                logAction(`Dropdown ${this.id} is hidden`);
                            });
                        } catch (e) {
                            info.push(`<span class="status-error">❌ Failed to init dropdown ${dropdown.id}: ${e.message}</span>`);
                        }
                    });
                    info.push(`<span class="status-ok">✅ Successfully initialized ${successfulInits} dropdowns</span>`);
                }
                
                // Z-index check
                const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                let zIndexOk = true;
                dropdownMenus.forEach(function(menu, index) {
                    const styles = window.getComputedStyle(menu);
                    const zIndex = parseInt(styles.zIndex) || 0;
                    if (zIndex < 1050) {
                        info.push(`<span class="status-warning">⚠️ Dropdown menu ${index + 1} has low z-index: ${zIndex}</span>`);
                        zIndexOk = false;
                    }
                });
                if (zIndexOk) {
                    info.push(`<span class="status-ok">✅ All dropdown menus have proper z-index</span>`);
                }
                
            } catch (e) {
                info.push(`<span class="status-error">❌ Error during system check: ${e.message}</span>`);
            }
            
            systemInfo.innerHTML = info.join('<br>');
        });
        
        function testAction(action, id) {
            actionCount++;
            const timestamp = new Date().toLocaleTimeString();
            let message = `[${timestamp}] Action "${action}" clicked for ID ${id}`;
            
            // Simulate the actual functions from the penggajian page
            switch(action) {
                case 'view':
                    message += ' - Would open detail modal';
                    break;
                case 'edit':
                    message += ' - Would redirect to edit page';
                    break;
                case 'mark_paid':
                    message += ' - Would mark as paid via AJAX';
                    break;
                case 'print_slip':
                    message += ' - Would generate slip PDF';
                    break;
                case 'delete':
                    message += ' - Would show delete confirmation';
                    break;
                default:
                    message += ' - Unknown action';
            }
            
            logAction(message);
        }
        
        function logAction(message) {
            const actionLog = document.getElementById('actionLog');
            const timestamp = new Date().toLocaleTimeString();
            const logEntry = document.createElement('div');
            logEntry.innerHTML = `<small class="text-muted">[${timestamp}]</small> ${message}`;
            logEntry.style.marginBottom = '0.25rem';
            actionLog.appendChild(logEntry);
            actionLog.scrollTop = actionLog.scrollHeight;
        }
        
        function clearLog() {
            document.getElementById('actionLog').innerHTML = '<em>Log cleared...</em>';
            actionCount = 0;
        }
        
        // Global error handler
        window.addEventListener('error', function(e) {
            logAction(`<span class="status-error">❌ JavaScript Error: ${e.error.message}</span>`);
        });
        
        // Monitor all Bootstrap dropdown events globally
        document.addEventListener('show.bs.dropdown', function(e) {
            console.log('Global: Dropdown showing -', e.target.id);
        });
        
        document.addEventListener('shown.bs.dropdown', function(e) {
            console.log('Global: Dropdown shown -', e.target.id);
        });
        
        document.addEventListener('hide.bs.dropdown', function(e) {
            console.log('Global: Dropdown hiding -', e.target.id);
        });
        
        document.addEventListener('hidden.bs.dropdown', function(e) {
            console.log('Global: Dropdown hidden -', e.target.id);
        });
    </script>
</body>
</html>
