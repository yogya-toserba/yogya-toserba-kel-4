<!DOCTYPE html>
<html>
<head>
    <title>Debug Tombol Kirim</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Debug Tombol Kirim Pengiriman</h2>
        
        <div class="card">
            <div class="card-body">
                <h5>Test Data Session</h5>
                <p>Data session pengiriman: {{ json_encode(session('all_pengiriman', [])) }}</p>
                <p>Count: {{ count(session('all_pengiriman', [])) }}</p>
                
                <div class="mt-4">
                    <button onclick="testKirimPengiriman(0)" class="btn btn-primary">
                        Test Kirim Index 0
                    </button>
                    
                    <button onclick="console.log('Button clicked')" class="btn btn-secondary">
                        Test Console Log
                    </button>
                    
                    <a href="#" onclick="kirimPengiriman(0); return false;" class="btn btn-success">
                        Test Link Kirim
                    </a>
                </div>
                
                <div class="mt-4">
                    <a href="/gudang/test-data" class="btn btn-warning">Generate Test Data</a>
                    <a href="/gudang/pengiriman" class="btn btn-info">Go to Pengiriman</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Test function
        function testKirimPengiriman(index) {
            console.log('testKirimPengiriman called with index:', index);
            alert('Test function works! Index: ' + index);
        }
        
        // Real kirimPengiriman function
        function kirimPengiriman(index) {
            console.log('kirimPengiriman called with index:', index);
            
            if (!window.Swal) {
                alert('SweetAlert not loaded!');
                return;
            }
            
            Swal.fire({
                title: 'Kirim Pengiriman?',
                text: 'Test function - Pengiriman akan dikirim dan masuk ke sistem penerimaan',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('User confirmed, sending AJAX...');
                    
                    $.ajax({
                        url: '{{ route("gudang.pengiriman.kirim") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            index: index
                        },
                        success: function(response) {
                            console.log('AJAX Success:', response);
                            Swal.fire('Success!', 'Response received', 'success');
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', xhr, status, error);
                            Swal.fire('Error!', 'AJAX failed: ' + error, 'error');
                        }
                    });
                }
            });
        }
        
        // Check if dependencies are loaded
        $(document).ready(function() {
            console.log('Document ready');
            console.log('jQuery loaded:', typeof $ !== 'undefined');
            console.log('SweetAlert loaded:', typeof Swal !== 'undefined');
            console.log('Bootstrap loaded:', typeof bootstrap !== 'undefined');
            
            // Test CSRF token
            console.log('CSRF Token:', $('meta[name="csrf-token"]').attr('content'));
        });
    </script>
</body>
</html>
