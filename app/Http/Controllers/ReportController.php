<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
    
    public function orders(Request $request)
    {
        // Default to current month if no dates provided
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date'))->startOfDay() 
            : Carbon::now()->startOfMonth();
        
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date'))->endOfDay() 
            : Carbon::now()->endOfDay();
            
        // Make sure end date is not before start date
        if ($endDate->lt($startDate)) {
            $endDate = $startDate->copy()->endOfDay();
        }
            
        // Get orders within date range with proper date comparison
        // Check if we should use order_date or created_at
        if (Schema::hasColumn('orders', 'order_date')) {
            $orders = Order::with(['product', 'company'])
                ->whereDate('order_date', '>=', $startDate->toDateString())
                ->whereDate('order_date', '<=', $endDate->toDateString())
                ->orderBy('order_date', 'desc')
                ->get();
        } else {
            $orders = Order::with(['product', 'company'])
                ->whereDate('created_at', '>=', $startDate->toDateString())
                ->whereDate('created_at', '<=', $endDate->toDateString())
                ->orderBy('created_at', 'desc')
                ->get();
        }
            
        // Calculate summary statistics
        $totalOrders = $orders->count();
        $totalQuantity = $orders->sum('quantity');
        $totalProducts = $orders->pluck('product_id')->unique()->count();
        $totalCompanies = $orders->pluck('company_id')->unique()->count();
        
        // Orders by status
        $pendingOrders = $orders->where('status', 'pending')->count();
        $completedOrders = $orders->where('status', 'completed')->count();
        $cancelledOrders = $orders->where('status', 'cancelled')->count();
        
        // Group by date - ensure we're using the date part only
        $ordersByDate = $orders->groupBy(function($order) {
            if (isset($order->order_date)) {
                return $order->order_date->format('Y-m-d');
            }
            return $order->created_at->format('Y-m-d');
        });

        // Sort dates chronologically
        $ordersByDate = $ordersByDate->sortKeys();
        
        // Create date labels and data for chart
        $dateLabels = [];
        $dateValues = [];
        
        foreach ($ordersByDate as $date => $dateOrders) {
            $dateLabels[] = Carbon::parse($date)->format('d M');
            $dateValues[] = $dateOrders->count();
        }
        
        // Group by product
        $ordersByProduct = $orders->groupBy('product_id');
        $productSummary = [];
        
        foreach ($ordersByProduct as $productId => $items) {
            if (isset($items[0]->product)) {
                $productSummary[] = [
                    'product_name' => $items[0]->product->name,
                    'quantity' => $items->sum('quantity'),
                    'order_count' => $items->count(),
                    'avg_quantity' => $items->count() > 0 ? round($items->sum('quantity') / $items->count(), 1) : 0
                ];
            }
        }
        
        // Sort products by order count descending
        usort($productSummary, function($a, $b) {
            return $b['order_count'] <=> $a['order_count'];
        });
        
        // Group by company
        $ordersByCompany = $orders->groupBy('company_id');
        $companySummary = [];
        
        foreach ($ordersByCompany as $companyId => $items) {
            if (isset($items[0]->company)) {
                $companySummary[] = [
                    'company_name' => $items[0]->company->name,
                    'quantity' => $items->sum('quantity'),
                    'order_count' => $items->count(),
                    'avg_quantity' => $items->count() > 0 ? round($items->sum('quantity') / $items->count(), 1) : 0
                ];
            }
        }
        
        // Sort companies by order count descending
        usort($companySummary, function($a, $b) {
            return $b['order_count'] <=> $a['order_count'];
        });
        
        return view('reports.orders', compact(
            'orders',
            'startDate',
            'endDate',
            'totalOrders',
            'totalQuantity',
            'totalProducts',
            'totalCompanies',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'ordersByDate',
            'dateLabels',
            'dateValues',
            'productSummary',
            'companySummary'
        ));
    }
    
    public function products(Request $request)
    {
        // Default to current month if no dates provided
        $startDate = $request->input('start_date') 
            ? Carbon::parse($request->input('start_date'))->startOfDay() 
            : Carbon::now()->startOfMonth();
        
        $endDate = $request->input('end_date') 
            ? Carbon::parse($request->input('end_date'))->endOfDay() 
            : Carbon::now()->endOfDay();
        
        // Make sure end date is not before start date
        if ($endDate->lt($startDate)) {
            $endDate = $startDate->copy()->endOfDay();
        }
        
        // Get all products
        $products = Product::with('supplier')->get();
        
        // Get orders within date range - use whereDate for proper date comparison
        // Check if we should use order_date or created_at
        if (Schema::hasColumn('orders', 'order_date')) {
            $orders = Order::whereDate('order_date', '>=', $startDate->toDateString())
                ->whereDate('order_date', '<=', $endDate->toDateString())
                ->get();
        } else {
            $orders = Order::whereDate('created_at', '>=', $startDate->toDateString())
                ->whereDate('created_at', '<=', $endDate->toDateString())
                ->get();
        }
        
        // Calculate product stats
        foreach ($products as $product) {
            $productOrders = $orders->where('product_id', $product->id);
            $product->orders_count = $productOrders->count();
            $product->total_quantity = $productOrders->sum('quantity');
            $product->completed_orders = $productOrders->where('status', 'completed')->count();
            $product->pending_orders = $productOrders->where('status', 'pending')->count();
        }
        
        // Sort products by most ordered
        $products = $products->sortByDesc('total_quantity');
        
        return view('reports.products', compact(
            'products',
            'startDate', 
            'endDate'
        ));
    }
}
