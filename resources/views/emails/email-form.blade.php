<!DOCTYPE html>
<html>
<head>
    <title>Gửi Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Gửi Email</h4>
                    </div>
                    <div class="card-body">
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('email.send') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email người nhận:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Tiêu đề:</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Nội dung:</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Gửi Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>