@extends('layouts.app')

@section('content')
<!-- Hero Banner -->
<div class="p-4 mb-4 rounded-3" style="background: linear-gradient(90deg, var(--primary) 60%, var(--dark) 100%); color: var(--light); box-shadow: 0 4px 24px rgba(255,136,0,0.10);">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div>
            <h1 class="mb-1 fw-bold" style="color: var(--light); letter-spacing: -0.03em;">Welcome to the Dashboard</h1>
            <p class="mb-0" style="color: #fff9f0;">Quick overview and insights for your Beauty Warehouse system.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('reports.index') }}" class="btn btn-light text-black fw-bold shadow-sm">
                <i class="bi bi-file-earmark-bar-graph"></i> View Reports
            </a>
        </div>
    </div>
</div>

<!-- Main Stats Cards -->
<div class="row mb-4 g-4">
    <!-- Products Card -->
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100 border-0 shadow-sm" style="background: var(--light);">
            <div class="card-body text-center">
                <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:var(--primary);color:var(--light);font-size:2rem;">
                    <i class="bi bi-box"></i>
                </div>
                <div class="fw-bold display-6" style="color:var(--primary)">{{ $totalProducts }}</div>
                <div class="text-muted mb-2">Products</div>
                <a href="{{ route('products.index') }}" class="small text-decoration-none text-primary fw-semibold">View All <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Suppliers Card -->
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100 border-0 shadow-sm" style="background: var(--light);">
            <div class="card-body text-center">
                <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:var(--dark);color:var(--primary);font-size:2rem;">
                    <i class="bi bi-truck"></i>
                </div>
                <div class="fw-bold display-6" style="color:var(--dark)">{{ $totalSuppliers }}</div>
                <div class="text-muted mb-2">Suppliers</div>
                <a href="{{ route('suppliers.index') }}" class="small text-decoration-none text-primary fw-semibold">View All <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Orders Card -->
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100 border-0 shadow-sm" style="background: var(--light);">
            <div class="card-body text-center">
                <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:var(--primary-dark);color:var(--light);font-size:2rem;">
                    <i class="bi bi-bag"></i>
                </div>
                <div class="fw-bold display-6" style="color:var(--primary-dark)">{{ $totalOrders }}</div>
                <div class="text-muted mb-2">Orders</div>
                <a href="{{ route('orders.index') }}" class="small text-decoration-none text-primary fw-semibold">View All <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Companies Card -->
    <div class="col-6 col-xl-3">
        <div class="stat-card h-100 border-0 shadow-sm" style="background: var(--light);">
            <div class="card-body text-center">
                <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;background:var(--secondary);color:var(--dark);font-size:2rem;">
                    <i class="bi bi-building"></i>
                </div>
                <div class="fw-bold display-6" style="color:var(--secondary)">{{ $totalCompanies }}</div>
                <div class="text-muted mb-2">Companies</div>
                <a href="{{ route('companies.index') }}" class="small text-decoration-none text-primary fw-semibold">View All <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Order Status -->
    <div class="col-lg-8">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0 fw-bold" style="color:var(--primary)">Order Status</h5>
                <a href="{{ route('reports.orders') }}" class="btn btn-sm btn-primary fw-semibold">
                    View Report
                </a>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center p-3 rounded bg-success bg-opacity-10">
                            <div class="h1 mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                            </div>
                            <div class="display-6 fw-bold text-success mb-1">{{ $completedOrders }}</div>
                            <div class="text-muted">Completed</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 rounded" style="background:rgba(255,136,0,0.08);">
                            <div class="h1 mb-2">
                                <i class="bi bi-clock" style="color:var(--primary)"></i>
                            </div>
                            <div class="display-6 fw-bold mb-1" style="color:var(--primary)">{{ $pendingOrders }}</div>
                            <div class="text-muted">Pending</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-3 rounded bg-danger bg-opacity-10">
                            <div class="h1 mb-2">
                                <i class="bi bi-x-circle text-danger"></i>
                            </div>
                            <div class="display-6 fw-bold text-danger mb-1">{{ $cancelledOrders }}</div>
                            <div class="text-muted">Cancelled</div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h6 class="mb-3 fw-semibold" style="color:var(--primary)">Order Distribution</h6>
                    <div class="progress" style="height: 12px;">
                        @if($totalOrders > 0)
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($completedOrders / $totalOrders) * 100 }}%"
                                aria-valuenow="{{ $completedOrders }}" aria-valuemin="0" aria-valuemax="{{ $totalOrders }}">
                            </div>
                            <div class="progress-bar" style="background:var(--primary);" role="progressbar"
                                style="width: {{ ($pendingOrders / $totalOrders) * 100 }}%"
                                aria-valuenow="{{ $pendingOrders }}" aria-valuemin="0" aria-valuemax="{{ $totalOrders }}">
                            </div>
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ ($cancelledOrders / $totalOrders) * 100 }}%"
                                aria-valuenow="{{ $cancelledOrders }}" aria-valuemin="0" aria-valuemax="{{ $totalOrders }}">
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between mt-2 small">
                        <div>
                            <span class="badge bg-success me-1"></span>
                            <span class="text-muted">{{ $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100) : 0 }}% Completed</span>
                        </div>
                        <div>
                            <span class="badge" style="background:var(--primary);"></span>
                            <span class="text-muted">{{ $totalOrders > 0 ? round(($pendingOrders / $totalOrders) * 100) : 0 }}% Pending</span>
                        </div>
                        <div>
                            <span class="badge bg-danger me-1"></span>
                            <span class="text-muted">{{ $totalOrders > 0 ? round(($cancelledOrders / $totalOrders) * 100) : 0 }}% Cancelled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Monthly Comparison -->
    <div class="col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0 fw-bold" style="color:var(--primary)">Monthly Comparison</h5>
            </div>
            <div class="card-body text-center">
                <div class="display-4 fw-bold mb-1" style="color:var(--primary)">{{ $ordersThisMonth }}</div>
                <div class="text-muted mb-3">Orders This Month</div>
                <div class="my-3 h2">
                    @if($ordersPreviousMonth > 0)
                        @php $percentChange = (($ordersThisMonth - $ordersPreviousMonth) / $ordersPreviousMonth) * 100; @endphp
                        @if($percentChange > 0)
                            <span class="text-success fw-bold">
                                <i class="bi bi-graph-up-arrow"></i>
                                +{{ number_format(abs($percentChange), 1) }}%
                            </span>
                        @elseif($percentChange < 0)
                            <span class="text-danger fw-bold">
                                <i class="bi bi-graph-down-arrow"></i>
                                -{{ number_format(abs($percentChange), 1) }}%
                            </span>
                        @else
                            <span class="text-muted">No Change</span>
                        @endif
                    @else
                        <span class="text-muted">No Data</span>
                    @endif
                </div>
                <div class="text-muted small">Previous Month: <span class="fw-semibold">{{ $ordersPreviousMonth }}</span></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Employees -->
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h6 class="mb-0 fw-bold" style="color:var(--primary)">Employees</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <span class="badge bg-success me-2" style="width:18px;height:18px;"></span>
                    <span class="fw-semibold">Active:</span>
                    <span class="ms-auto">{{ $activeEmployees }}</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-danger me-2" style="width:18px;height:18px;"></span>
                    <span class="fw-semibold">Inactive:</span>
                    <span class="ms-auto">{{ $inactiveEmployees }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Low Stock Products -->
    <div class="col-md-6 col-lg-8">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h6 class="mb-0 fw-bold" style="color:var(--primary)">Low Stock Products</h6>
            </div>
            <div class="card-body p-0">
                @if($lowStockProducts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr style="background:var(--gray-light);">
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><span class="badge bg-danger">{{ $product->quantity }}</span></td>
                                <td>{{ $product->supplier ? $product->supplier->name : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-3 text-center text-muted">No low stock products 🎉</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
