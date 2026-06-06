<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index(): View
    {
        /** @var int $totalProducts */
        $totalProducts = Product::count();
        
        /** @var int $totalCategories */
        $totalCategories = Category::count();
        
        /** @var int $totalClicks */
        $totalClicks = (int) Product::sum('clicks');
        
        /** @var int $totalOrders */
        $totalOrders = Order::count();
        
        /** @var float $totalRevenue */
        $totalRevenue = (float) Order::sum('total_amount');
        
        /** @var int $totalUsers */
        $totalUsers = User::count();
        
        /** @var int $totalViews */
        $totalViews = ProductView::count();
        
        /** @var Collection $topProducts */
        $topProducts = Product::orderBy('clicks', 'desc')->limit(5)->get();
        
        /** @var Collection $recentOrders */
        $recentOrders = Order::latest()->limit(5)->get();
        
        /** @var int $todayViews */
        $todayViews = ProductView::whereDate('created_at', today())->count();
        
        /** @var int $thisWeekViews */
        $thisWeekViews = ProductView::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        
        /** @var int $thisMonthViews */
        $thisMonthViews = ProductView::whereMonth('created_at', now()->month)->count();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalClicks',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'totalViews',
            'topProducts',
            'recentOrders',
            'todayViews',
            'thisWeekViews',
            'thisMonthViews'
        ));
    }
}