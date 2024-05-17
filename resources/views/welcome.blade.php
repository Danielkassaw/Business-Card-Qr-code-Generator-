<!DOCTYPE html>
<html>

<head>
    <title>QR Code</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
</head>

<body>
    <div class="qr-code-container">
        <div class="user-image">
            <img src="/top_image.jpg" alt="Image">
        </div>
       
        <h1>{{ $name }}</h1>
        <div class="qr-code">
            {!! $qrCodeData !!}
        </div>
    </div>
</body>

</html>
