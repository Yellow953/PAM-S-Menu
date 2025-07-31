<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Currency;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Business $business)
    {
        if (! $business->ordering_activated) abort(403);

        $rate = Currency::withoutGlobalScopes()
            ->where('business_id', $business->id)
            ->where('code', 'LBP')
            ->where('deleted_at', null)
            ->first()
            ->rate;
        $theme_color = $business->getPersonalisation('theme_color');

        $data = compact('business', 'rate', 'theme_color');
        return view('checkout.index', $data);
    }

    public function thanks(Business $business)
    {
        if (! $business->ordering_activated) abort(403);

        $theme_color = $business->getPersonalisation('theme_color');

        $data = compact('theme_color');
        return view('checkout.thanks', $data);
    }
}
