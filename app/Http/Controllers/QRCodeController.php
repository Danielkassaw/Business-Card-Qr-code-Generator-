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

// Create a vCard string to encode in the QR code
$vCard = "BEGIN:VCARD\n";
$vCard .= "VERSION:3.0\n";
$vCard .= "FN:" . $user->name . "\n"; // Full name
$vCard .= "EMAIL:" . $user->email . "\n"; // Email

// You can add other fields as needed
$vCard .= "END:VCARD";

// Extract user's name from vCard
$matches = [];
preg_match('/FN:(.*?)\n/', $vCard, $matches);
$name = isset($matches[1]) ? $matches[1] : 'Name not found';

// Generate the QR code data
$qrCodeData = QRCodeFacade::format('svg')->size(300)->generate($vCard);

// Store the QR code data
QrCode::create([
    'user_id' => $user->id,
    'qr_code_data' => $qrCodeData,
]);
// Pass $qrCodeData and $name to the view
return view('welcome', compact('qrCodeData', 'name'));

}
}
