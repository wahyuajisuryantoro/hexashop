<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalRevenue = DB::table('orders')->sum('total_price');
        $newOrdersCount = DB::table('orders')
            ->whereDate('created_at', '>=', now()->subDay())
            ->count();
        $orderStatuses = DB::table('order_details')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
        $recentTransactions = DB::table('orders')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $topSellingProducts = DB::table('products')
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->select('products.id', 'products.name', DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();
        $newlyAddedProducts = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $productCategories = DB::table('products')
            ->select('category', DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->get();
        $monthlyRevenue = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, SUM(total_price) as total'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        $annualRevenue = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) year, SUM(total_price) as total'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        return view('dashboard', [
            'totalRevenue' => $totalRevenue,
            'newOrdersCount' => $newOrdersCount,
            'orderStatuses' => $orderStatuses,
            'recentTransactions' => $recentTransactions,
            'topSellingProducts' => $topSellingProducts,
            'newlyAddedProducts' => $newlyAddedProducts,
            'productCategories' => $productCategories,
            'monthlyRevenue' => $monthlyRevenue,
            'annualRevenue' => $annualRevenue,
            'title' => 'Dashboard'
        ]);
    }

    public function settingPayment()
    {
        $title = 'Setting Server Pembayaran';
        return view('admin.payment.index', compact('title'));
    }

    public function getAssets()
    {
        return view('admin.assets.index');
    }
}
