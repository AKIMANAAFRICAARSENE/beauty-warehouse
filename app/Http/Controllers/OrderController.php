<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['product', 'company'])->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('quantity', '>', 0)->get();
        $companies = Company::all();
        return view('orders.create', compact('products', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'company_id' => 'required|exists:companies,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,completed,cancelled',
            'order_date' => 'required|date',
        ]);

        $product = Product::find($request->product_id);
        
        if ($product->quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Not enough product in stock'])->withInput();
        }

        Order::create($request->all());
        
        // Reduce product quantity if order is completed
        if ($request->status == 'completed') {
            $product->quantity -= $request->quantity;
            $product->save();
        }
        
        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $companies = Company::all();
        return view('orders.edit', compact('order', 'products', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'company_id' => 'required|exists:companies,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,completed,cancelled',
            'order_date' => 'required|date',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;
        $product = Product::find($request->product_id);
        
        // Check if we have enough product in stock if order is being completed
        if ($oldStatus != 'completed' && $newStatus == 'completed') {
            if ($product->quantity < $request->quantity) {
                return back()->withErrors(['quantity' => 'Not enough product in stock'])->withInput();
            }
            
            // Reduce product quantity
            $product->quantity -= $request->quantity;
            $product->save();
        }
        
        // Return product quantity if order was completed and now is cancelled
        if ($oldStatus == 'completed' && $newStatus != 'completed') {
            $product->quantity += $order->quantity;
            $product->save();
        }
        
        $order->update($request->all());
        
        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Return product quantity if order was completed
        if ($order->status == 'completed') {
            $product = $order->product;
            $product->quantity += $order->quantity;
            $product->save();
        }
        
        $order->delete();
        
        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}