<?php
namespace App\Http\Controllers\backsite;
use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function index() {
        // Stats
        $totalRevenue = Checkout::whereIn('status', ['delivered'])->sum('grand_total');
        $totalOrders = Checkout::count();
        $newOrders = Checkout::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalUsers = User::where('id_role', 3)->count();
        $lowStockProducts = Product::where('stock', '<=', 5)->where('stock', '>', 0)->get();
        $outOfStock = Product::where('stock', 0)->count();
        
        // Recent orders
        $recentOrders = Checkout::with('user')
            ->latest()->take(8)->get();
        
        // Orders by status
        $orderStats = Checkout::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->get()->keyBy('status');

        // Monthly revenue (last 6 months)
        $monthlyRevenue = Checkout::whereIn('status', ['delivered'])
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(grand_total) as total'))
            ->groupBy('month')->orderBy('month')->get();

        return view('backsite.dashboard', compact(
            'totalRevenue', 'totalOrders', 'newOrders', 'totalProducts',
            'totalUsers', 'lowStockProducts', 'outOfStock', 'recentOrders',
            'orderStats', 'monthlyRevenue'
        ));
    }
}
