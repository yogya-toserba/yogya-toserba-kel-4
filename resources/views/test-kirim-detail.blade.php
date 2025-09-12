        <!DOCTYPE html>
<html>
<head>
    <title>Test Kirim Pengiriman</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .test-card { margin: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Test Tombol Kirim Pengiriman</h2>
        
        <div class="test-card">
            <h5>1. Test Data Session</h5>
            <p><strong>Session Pengiriman:</strong></p>
            <pre>{{ json_encode(session('all_pengiriman', []), JSON_PRETTY_PRINT) }}</pre>
            <p><strong>Count:</strong> {{ count(session('all_pengiriman', [])) }}</p>
        </div>
        
        <div class="test-card">
            <h5>2. Test JavaScript Functions</h5>
            <button onclick="testBasicAlert()" class="btn btn-secondary mb-2">Test Basic Alert</button>
            <button onclick="testSweetAlert()" class="btn btn-info mb-2">Test SweetAlert</button>
            <button onclick="testKirimFunction()" class="btn btn-warning mb-2">Test Kirim Function</button>
            <button onclick="testAjaxDirect()" class="btn btn-danger mb-2">Test AJAX Direct</button>
        </div>
        
        <div class="test-card">
            <h5>3. Test Dropdown Simulation</h5>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Dropdown Test
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Detail</a></li>
                    <li><a class="dropdown-item kirim-btn" href="#" data-index="0" onclick="kirimPengiriman(0); return false;">Kirim (onclick)</a></li>
                    <li><a class="dropdown-item kirim-test" href="#" data-index="0">Kirim (event listener)</a></li>
                </ul>
            </div>
        </div>
        
        <div class="test-card">
            <h5>4. Quick Actions</h5>
            <a href="/gudang/test-data" class="btn btn-success me-2">Generate Test Data</a>
            <a href="/gudang/pengiriman" class="btn btn-primary me-2">Go to Pengiriman</a>
            <a href="/gudang/inventori/penerimaan" class="btn btn-info">Go to Penerimaan</a>
        </div>
        
        <div class="test-card">
            <h5>5. Log Output</h5>
            <div id="log" style="background: #f8f9fa; padding: 10px; border-radius: 4px; font-family: monospace; height: 200px; overflow-y: auto;"></div>
        </div>
    </div>

    <script>
        // Setup CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        function log(message) {
            const logDiv = document.getElementById('log');
            logDiv.innerHTML += new Date().toLocaleTimeString() + ': ' + message + '\n';
            logDiv.scrollTop = logDiv.scrollHeight;
        }
        
        function testBasicAlert() {
            log('Testing basic alert...');
            alert('Basic alert works!');
            log('Basic alert completed');
        }
        
        function testSweetAlert() {
            log('Testing SweetAlert...');
            if (typeof Swal !== 'undefined') {
                Swal.fire('Success!', 'SweetAlert is working!', 'success');
                log('SweetAlert works!');
            } else {
                log('ERROR: SweetAlert not loaded!');
                alert('SweetAlert not loaded!');
            }
        }
        
        function testKirimFunction() {
            log('Testing kirimPengiriman function...');
            if (typeof kirimPengiriman === 'function') {
                log('kirimPengiriman function exists, calling with index 0...');
                kirimPengiriman(0);
            } else {
                log('ERROR: kirimPengiriman function not found!');
                alert('kirimPengiriman function not found!');
            }
        }
        
        function testAjaxDirect() {
            log('Testing direct AJAX call...');
            $.ajax({
                url: '{{ route("gudang.pengiriman.kirim") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    index: 0
                },
                success: function(response) {
                    log('AJAX Success: ' + JSON.stringify(response));
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Success!', response.message || 'AJAX call successful', 'success');
                    } else {
                        alert('AJAX Success: ' + (response.message || 'Success'));
                    }
                },
                error: function(xhr, status, error) {
                    log('AJAX Error: ' + error + ' - ' + xhr.responseText);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Error!', 'AJAX Error: ' + error, 'error');
                    } else {
                        alert('AJAX Error: ' + error);
                    }
                }
            });
        }
        
        // Define kirimPengiriman function
        function kirimPengiriman(index) {
            log('kirimPengiriman called with index: ' + index);
            
            if (typeof Swal === 'undefined') {
                log('SweetAlert not available, using confirm');
                if (confirm('Kirim pengiriman index ' + index + '?')) {
                    prosesKirimPengiriman(index);
                }
                return;
            }
            
            Swal.fire({
                title: 'Kirim Pengiriman?',
                text: 'Test - Pengiriman index ' + index + ' akan dikirim',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    log('User confirmed, processing...');
                    prosesKirimPengiriman(index);
                } else {
                    log('User cancelled');
                }
            });
        }
        
        function prosesKirimPengiriman(index) {
            log('Processing kirim pengiriman for index: ' + index);
            
            $.ajax({
                url: '{{ route("gudang.pengiriman.kirim") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    index: index
                },
                success: function(response) {
                    log('Process Success: ' + JSON.stringify(response));
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Berhasil!', response.message || 'Pengiriman berhasil dikirim', 'success');
                    } else {
                        alert('Success: ' + (response.message || 'Pengiriman berhasil dikirim'));
                    }
                },
                error: function(xhr, status, error) {
                    log('Process Error: ' + error + ' - ' + xhr.responseText);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Error!', 'Gagal mengirim: ' + error, 'error');
                    } else {
                        alert('Error: ' + error);
                    }
                }
            });
        }
        
        // Event listeners
        $(document).ready(function() {
            log('Document ready');
            log('jQuery loaded: ' + (typeof $ !== 'undefined'));
            log('SweetAlert loaded: ' + (typeof Swal !== 'undefined'));
            log('Bootstrap loaded: ' + (typeof bootstrap !== 'undefined'));
            
            // Event listener for dropdown items
            $(document).on('click', '.kirim-test', function(e) {
                e.preventDefault();
                var index = $(this).data('index');
                log('Dropdown kirim clicked via event listener, index: ' + index);
                kirimPengiriman(index);
            });
        });
    </script>
</body>
</html>
