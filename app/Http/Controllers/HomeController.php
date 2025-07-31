<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Business;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function qrcode_download(Business $business)
    {
        if (Helper::menu_or_shop($business) == 'menu') {
            $url = route('menu', $business->name);
        } else {
            $url = route('shop.home', $business->name);
        }
        $filePath = public_path('qrcodes/qr-code.png');

        QrCode::size(300)->format('png')->generate($url, $filePath);

        return response()->download($filePath);
    }

    public function fix()
    {
        return 'fixed...';
    }

    public function test()
    {
        return view('test');
    }
}
