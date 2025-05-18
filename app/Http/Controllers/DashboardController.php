<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Company;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Count totals
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalOrders = Order::count();
        $totalEmployees = Employee::count();
        $totalCompanies = Company::count();
        
        // Low stock products (less than 10 items)
        $lowStockProducts = Product::where('quantity', '<', 10)->get();
        
        // Recent orders (last 5)
        $recentOrders = Order::with(['product', 'company'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Orders by status
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        // Orders this month vs previous month
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $ordersThisMonth = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        
        $previousMonth = Carbon::now()->subMonth()->month;
        $previousMonthYear = Carbon::now()->subMonth()->year;
        
        $ordersPreviousMonth = Order::whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousMonthYear)
            ->count();
        
        // Active vs Inactive employees
        $activeEmployees = Employee::where('status', 'active')->count();
        $inactiveEmployees = Employee::where('status', 'inactive')->count();
        
        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'totalOrders',
            'totalEmployees',
            'totalCompanies',
            'lowStockProducts',
            'recentOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'ordersThisMonth',
            'ordersPreviousMonth',
            'activeEmployees',
            'inactiveEmployees'
        ));
    }
}
