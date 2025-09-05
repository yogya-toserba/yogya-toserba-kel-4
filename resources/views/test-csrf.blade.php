<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test CSRF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test CSRF dan Session</h2>
        
        <div class="row">
            <div class="col-md-6">
                <h4>Session Info</h4>
                <ul class="list-group">
                    <li class="list-group-item">Session ID: {{ session()->getId() }}</li>
                    <li class="list-group-item">CSRF Token: {{ csrf_token() }}</li>
                    <li class="list-group-item">App Key Exists: {{ config('app.key') ? 'Yes' : 'No' }}</li>
                    <li class="list-group-item">Session Driver: {{ config('session.driver') }}</li>
                </ul>
            </div>
            
            <div class="col-md-6">
                <h4>Test Form</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('test.csrf.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="test_input" class="form-label">Test Input</label>
                        <input type="text" class="form-control" name="test_input" value="test data">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Test</button>
                </form>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('admin.login') }}" class="btn btn-secondary">Go to Admin Login</a>
        </div>
    </div>
</body>
</html>
