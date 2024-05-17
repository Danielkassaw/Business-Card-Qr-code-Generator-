<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;

Route::get('/generate-qr/{user_id}', [QRCodeController::class, 'generateQRCode']);

Route::get('/', function () {
    return view('welcome');
});
