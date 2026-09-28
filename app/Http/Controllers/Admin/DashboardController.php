<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('grand_total');
        
        $recentOrders = Order::with('user')
                            ->latest()
                            ->limit(5)
                            ->get();
        
        $popularProducts = Product::orderBy('sold_count', 'desc')
                                 ->limit(5)
                                 ->get();
        
        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
                              ->groupBy('status')
                              ->get();
        
        $monthlyRevenue = Order::where('status', 'delivered')
                              ->whereYear('created_at', date('Y'))
                              ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(grand_total) as total'))
                              ->groupBy('month')
                              ->orderBy('month')
                              ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders', 'totalProducts', 'totalUsers', 'totalRevenue',
            'recentOrders', 'popularProducts', 'ordersByStatus', 'monthlyRevenue'
        ));
    }
}