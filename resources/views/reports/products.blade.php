@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-4">Products Report</h1>
        <div>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary me-2">Back to Reports</a>
            <button onclick="window.print()" class="btn btn-primary">Print Report</button>
        </div>
    </div>

    <!-- Date Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('reports.products') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </form>
        </div>
    </div>

    @php
        $totalProducts = $products->count();
        $lowStockCount = $products->where('quantity', '<=', 10)->count(); // Assuming low stock is <= 10
        $totalOrderedQuantity = $products->sum('total_quantity'); // This field is calculated in the controller
        $productsNotOrderedCount = $products->where('orders_count', 0)->count();
    @endphp

    <!-- Summary Cards -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3 border-0" style="background-color: var(--light);">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase text-muted small mb-2">Total Products</h6>
                    <h3 class="card-text fw-bold" style="color:var(--dark);">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3 border-0" style="background-color: var(--light);">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase text-muted small mb-2">Low Stock Products</h6>
                    <h3 class="card-text fw-bold text-danger">{{ $lowStockCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3 border-0" style="background-color: var(--light);">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase text-muted small mb-2">Total Qty Ordered (Period)</h6>
                    <h3 class="card-text fw-bold" style="color:var(--dark);">{{ $totalOrderedQuantity }}</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm rounded-3 border-0" style="background-color: var(--light);">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase text-muted small mb-2">Products Not Ordered (Period)</h6>
                    <h3 class="card-text fw-bold" style="color:var(--dark);">{{ $productsNotOrderedCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Period -->
    <div class="alert alert-info mb-4 border-0 shadow-sm rounded-3" style="background: #fff3e6; color: var(--dark);">
        <strong>Report Period:</strong> {{ $startDate->format('d M, Y') }} to {{ $endDate->format('d M, Y') }}
    </div>

    <!-- Products Performance -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 fw-bold">Product Performance</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Current Stock</th>
                            <th>Total Orders</th>
                            <th>Total Quantity</th>
                            <th>Completed Orders</th>
                            <th>Pending Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->supplier->name }}</td>
                            <td>
                                @if($product->quantity < 10)
                                <span class="text-danger fw-bold">{{ $product->quantity }}</span>
                                @else
                                {{ $product->quantity }}
                                @endif
                            </td>
                            <td>{{ $product->orders_count }}</td>
                            <td>{{ $product->total_quantity }}</td>
                            <td>{{ $product->completed_orders }}</td>
                            <td>{{ $product->pending_orders }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Low Stock Products -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 fw-bold">Low Stock Products (Less than 10)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Current Stock</th>
                            <th>Total Orders (Period)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products->where('quantity', '<', 10) as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->supplier->name }}</td>
                            <td class="text-danger fw-bold">{{ $product->quantity }}</td>
                            <td>{{ $product->orders_count }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No low stock products found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Top Performers -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 fw-bold">Top Performing Products (By Quantity)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Product</th>
                            <th>Total Quantity</th>
                            <th>Order Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rank = 1; @endphp
                        @foreach($products->where('total_quantity', '>', 0)->take(10) as $product)
                        <tr>
                            <td>{{ $rank++ }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->total_quantity }}</td>
                            <td>{{ $product->orders_count }}</td>
                        </tr>
                        @endforeach

                        @if($products->where('total_quantity', '>', 0)->count() == 0)
                        <tr>
                            <td colspan="4" class="text-center">No products ordered during this period</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Products Not Ordered -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 fw-bold">Products Not Ordered (During Period)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Current Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products->where('orders_count', 0) as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->supplier->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">All products have been ordered during this period</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
