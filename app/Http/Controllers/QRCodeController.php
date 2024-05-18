<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeFacade;

class QRCodeController extends Controller
{
    public function generateQRCode($user_id)
{
    // Retrieve the user details
    $user = User::findOrFail($user_id);

    // Get the URL to the user's profile image
    $imageUrl = url($user->profile_image); // Adjust the path as necessary

    // Create a vCard string to encode in the QR code
    $vCard = "BEGIN:VCARD\n";
    $vCard .= "VERSION:3.0\n";
    $vCard .= "FN:" . $user->name . "\n"; // Full name
    $vCard .= "TEL:" . $user->phone . "\n"; // Phone number
    $vCard .= "EMAIL:" . $user->email . "\n"; // Email
    $vCard .= "PHOTO;VALUE=URL:" . $imageUrl . "\n"; // URL to the profile image
    $vCard .= "GENDER:" . $user->gender . "\n"; // Gender
    $vCard .= "ORG:" . $user->company . "\n"; // Company
    $vCard .= "TITLE:" . $user->title . "\n"; // Title
    $vCard .= "END:VCARD";

    // Generate the QR code data
    $qrCodeData = QRCodeFacade::format('svg')->size(300)->generate($vCard);

    // Store the QR code data (if necessary)
    // QrCode::create([
    //     'user_id' => $user->id,
    //     'qr_code_data' => $qrCodeData,
    // ]);

    // Pass the necessary data to the view
    return view('welcome', [
        'qrCodeData' => $qrCodeData,
        'name' => $user->name,
        'phone' => $user->phone,
        'imageUrl' => $imageUrl,
        'company' => $user->company,
        'title' => $user->title,
    ]);
}

    
}
