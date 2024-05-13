<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StoreProfile;
use App\Models\Asset;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $assetController;

    public function __construct(AssetController $assetController)
    {
        $this->assetController = $assetController;
    }

    public function index(Request $request)
    {
        $title = "Home";
        $section = $request->query('section', '');
        $menProducts = Product::where('category', 'Men')->get();
        $womenProducts = Product::where('category', 'Women')->get();
        $kidsProducts = Product::where('category', 'Kids')->get();

        // Mengambil gambar banner
        $mainBannerPath = $this->getBannerPath('mainBanner');
        $menBannerPath = $this->getBannerPath('menBanner');
        $womenBannerPath = $this->getBannerPath('womanBanner');
        $kidsBannerPath = $this->getBannerPath('kidsBanner');
        $otherBannerPath = $this->getBannerPath('otherBanner');

        //Proflie Toko
        $profile = StoreProfile::first();

        return view('home', compact('title', 'menProducts', 'womenProducts', 'kidsProducts', 'mainBannerPath', 'menBannerPath', 'womenBannerPath', 'kidsBannerPath', 'otherBannerPath', 'profile', 'section'));
    }


    public function about()
    {
        $title = 'About';
        return view('pages.about', compact('title'));
    }

    public function contact()
    {
        $title = 'Contact';
        return view('pages.contact',  compact('title'));
    }

    public function products()
    {
        $title = 'Product';
        $products = Product::all();
        return view('pages.products', compact('products', 'title'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $title = $product->name;
        return view('pages.single-products', compact('product', 'title'));
    }

    public function getBannerPath($type)
    {
        $banner = Asset::where('type', $type)->first();
        if (!$banner) {
            Log::warning("Banner type '{$type}' not found.");
            return 'assets/images/default-banner.jpg';
        }
        return $banner->path;
    }
}
