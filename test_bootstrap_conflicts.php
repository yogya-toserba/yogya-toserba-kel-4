<?php
echo "Testing Bootstrap Dropdown Conflicts\n";
echo "=====================================\n\n";

// Test to see if there are any JavaScript console errors
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Dropdown Conflict Test</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-3">
        <h4>Bootstrap Dropdown Conflict Test</h4>
        
        <!-- Test 1: Basic Bootstrap Dropdown -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h6>Test 1: Standard Bootstrap Dropdown</h6>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="standardDropdown" data-bs-toggle="dropdown">
                        Standard Dropdown
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="alert('Standard: Item 1')">Item 1</a></li>
                        <li><a class="dropdown-item" href="#" onclick="alert('Standard: Item 2')">Item 2</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Test 2: Three-dot Custom Dropdown -->
            <div class="col-md-6">
                <h6>Test 2: Three-dot Custom Dropdown</h6>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="threedotDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" onclick="alert('Three-dot: View')"><i class="fas fa-eye me-2"></i>View</a></li>
                        <li><a class="dropdown-item" href="#" onclick="alert('Three-dot: Edit')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="alert('Three-dot: Delete')"><i class="fas fa-trash me-2"></i>Delete</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Test 3: Multiple Three-dot Dropdowns in Table -->
        <div class="row mt-4">
            <div class="col-12">
                <h6>Test 3: Multiple Three-dot Dropdowns in Table</h6>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 1; $i <= 3; $i++): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>User <?= $i ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                            type="button" 
                                            id="dropdownTable<?= $i ?>" 
                                            data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="alert('Row <?= $i ?>: View')"><i class="fas fa-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="alert('Row <?= $i ?>: Edit')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="alert('Row <?= $i ?>: Delete')"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Test Results Display -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-info">
                    <h6>Test Results:</h6>
                    <ul id="testResults">
                        <li>Loading tests...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const results = document.getElementById('testResults');
            const testResults = [];
            
            // Test 1: Check Bootstrap version
            try {
                const version = bootstrap.Tooltip.VERSION || 'Unknown';
                testResults.push(`✅ Bootstrap version: ${version}`);
            } catch (e) {
                testResults.push(`❌ Bootstrap not loaded properly: ${e.message}`);
            }
            
            // Test 2: Check dropdown initialization
            try {
                const dropdowns = document.querySelectorAll('.dropdown-toggle');
                testResults.push(`✅ Found ${dropdowns.length} dropdown toggles`);
                
                // Initialize manually and check for errors
                let initCount = 0;
                dropdowns.forEach(function(dropdown) {
                    try {
                        new bootstrap.Dropdown(dropdown);
                        initCount++;
                    } catch (e) {
                        testResults.push(`❌ Failed to initialize dropdown ${dropdown.id}: ${e.message}`);
                    }
                });
                testResults.push(`✅ Successfully initialized ${initCount} dropdowns`);
            } catch (e) {
                testResults.push(`❌ Dropdown initialization failed: ${e.message}`);
            }
            
            // Test 3: Check for conflicting CSS
            try {
                const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                dropdownMenus.forEach(function(menu, index) {
                    const styles = window.getComputedStyle(menu);
                    if (styles.position === 'absolute') {
                        testResults.push(`✅ Dropdown ${index + 1} has correct positioning`);
                    } else {
                        testResults.push(`⚠️ Dropdown ${index + 1} may have positioning issues`);
                    }
                });
            } catch (e) {
                testResults.push(`❌ CSS conflict check failed: ${e.message}`);
            }
            
            // Test 4: Event listener conflicts
            try {
                let eventTestPassed = true;
                const testDropdown = document.querySelector('#threedotDropdown');
                if (testDropdown) {
                    testDropdown.addEventListener('show.bs.dropdown', function() {
                        console.log('Dropdown show event triggered');
                    });
                    testDropdown.addEventListener('shown.bs.dropdown', function() {
                        console.log('Dropdown shown event triggered');
                    });
                    testResults.push(`✅ Event listeners attached successfully`);
                } else {
                    testResults.push(`❌ Test dropdown not found`);
                }
            } catch (e) {
                testResults.push(`❌ Event listener test failed: ${e.message}`);
            }
            
            // Test 5: Z-index conflicts
            try {
                const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                let zIndexOk = true;
                dropdownMenus.forEach(function(menu, index) {
                    const styles = window.getComputedStyle(menu);
                    const zIndex = parseInt(styles.zIndex) || 0;
                    if (zIndex < 1000) {
                        testResults.push(`⚠️ Dropdown ${index + 1} has low z-index: ${zIndex}`);
                        zIndexOk = false;
                    }
                });
                if (zIndexOk) {
                    testResults.push(`✅ All dropdowns have appropriate z-index`);
                }
            } catch (e) {
                testResults.push(`❌ Z-index test failed: ${e.message}`);
            }
            
            // Update results display
            results.innerHTML = testResults.map(result => `<li>${result}</li>`).join('');
            
            // Additional console logging
            console.log('Bootstrap Dropdown Test Results:', testResults);
        });
        
        // Error catching for any global errors
        window.addEventListener('error', function(e) {
            console.error('Global error caught:', e.error);
        });
        
        // Monitor dropdown events
        document.addEventListener('show.bs.dropdown', function(e) {
            console.log('Global dropdown show:', e.target.id);
        });
        
        document.addEventListener('shown.bs.dropdown', function(e) {
            console.log('Global dropdown shown:', e.target.id);
        });
        
        document.addEventListener('hide.bs.dropdown', function(e) {
            console.log('Global dropdown hide:', e.target.id);
        });
        
        document.addEventListener('hidden.bs.dropdown', function(e) {
            console.log('Global dropdown hidden:', e.target.id);
        });
    </script>
</body>
</html>
