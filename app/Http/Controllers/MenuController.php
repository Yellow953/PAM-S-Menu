<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\Currency;
use App\Models\OperatingHour;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Business $business)
    {
        $categories = Category::withoutGlobalScopes()->select('id', 'name', 'image')->with('products')->where('business_id', $business->id)->where('deleted_at', null)->get();
        $products = Product::withoutGlobalScopes()->select('id', 'name', 'price', 'description', 'image', 'category_id')->with('category', 'secondary_images', 'variants', 'variants.options')->where('business_id', $business->id)->where('deleted_at', null)->where('quantity', '>', 0)->get()->groupBy('category_id');
        $operating_hours = OperatingHour::withoutGlobalScopes()->where('business_id', $business->id)->get();
        $rate = Currency::withoutGlobalScopes()->where('business_id', $business->id)->where('code', 'LBP')->where('deleted_at', null)->first()->rate;
        $theme_color = $business->getPersonalisation('theme_color');

        $data = compact('business', 'categories', 'products', 'operating_hours', 'rate', 'theme_color');
        return view('menu.index', $data);
    }
}
