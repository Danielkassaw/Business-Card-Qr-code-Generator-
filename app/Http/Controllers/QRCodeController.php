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
// Get the path to the user's profile image
// Get the URL to the user's profile image
$imageUrl = url($user->profile_image); // Adjust the path as necessary


// Create a vCard string to encode in the QR code
$vCard = "BEGIN:VCARD\n";
$vCard .= "VERSION:3.0\n";
$vCard .= "FN:" . $user->name . "\n"; // Full name
$vCard .= "TEL:" . $user->phone . "\n"; // Phone number (make sure the user has a phone attribute)
$vCard .= "PHOTO;VALUE=URL:" . $imageUrl . "\n"; // URL to the profile image
    
   
$vCard .= "EMAIL:" . $user->email . "\n"; // Email

// You can add other fields as needed
$vCard .= "END:VCARD";

// Extract user's name from vCard
$matches = [];
preg_match('/FN:(.*?)\n/', $vCard, $matches);
$name = isset($matches[1]) ? $matches[1] : 'Name not found';

preg_match('/TEL:(.*?)\n/', $vCard, $matches);
$phone = isset($matches[1]) ? $matches[1] : 'Phone not found';

// Generate the QR code data
$qrCodeData = QRCodeFacade::format('svg')->size(300)->generate($vCard);

// Store the QR code data
QrCode::create([
    'user_id' => $user->id,
    'qr_code_data' => $qrCodeData,
]);
// Pass $qrCodeData and $name to the view
return view('welcome', compact('qrCodeData', 'name', 'phone','imageUrl'));

}
}
