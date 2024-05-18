<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
    <div class="qr-code-container">
        <div class="user-image">
            <img src="{{ $imageUrl }}" alt="Profile Image">
        </div>
        <div class="user-details">
            <h1 class="name">{{ $name }}</h1>
            <p>{{ $title }}</p>
            <p>{{ $company }}</p>
            <p>{{ $phone }}</p>
        </div>
        <div class="qr-code">
            {!! $qrCodeData !!}
        </div>
    </div>
</body>
</html>
