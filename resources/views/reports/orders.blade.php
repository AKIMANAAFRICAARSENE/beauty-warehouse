@extends('layouts.app')

@section('content')
<div class="container app-container">
    <!-- Page Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold" style="color:var(--primary)">Orders Report</h4>
            <div>
                <button id="printReportBtn" class="btn btn-outline-secondary fw-semibold me-2">
                    <i class="bi bi-printer"></i> Print Report
                </button>
                <a href="{{ route('reports.index') }}" class="btn btn-outline-danger fw-semibold">Back to Reports</a>
            </div>
        </div>
    </div>

    <!-- Date Filter Form -->
    <div class="card mb-4 border-0 shadow-sm print-hide">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold" style="color:var(--primary)">Date Filter</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('reports.orders') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="start_date" class="form-label fw-semibold">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label fw-semibold">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
                </div>
                <div class="col-md-4 d-grid">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="bi bi-filter me-1"></i> Apply Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Report Period -->
    <div class="alert alert-info mb-4 border-0 shadow-sm rounded-3" style="background: #fff3e6; color: var(--dark);">
        <strong style="color:var(--primary)">Report Period:</strong> {{ $startDate->format('d M, Y') }} to {{ $endDate->format('d M, Y') }}
    </div>

    <!-- Summary Statistics -->
    <div class="row mb-4 g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold mb-1" style="color:var(--primary)">{{ $totalOrders }}</div>
                    <div class="text-muted">Total Orders</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold mb-1" style="color:var(--success)">{{ $totalQuantity }}</div>
                    <div class="text-muted">Total Quantity</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold mb-1" style="color:var(--info)">{{ $totalProducts }}</div>
                    <div class="text-muted">Products Ordered</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-4 fw-bold mb-1" style="color:var(--dark)">{{ $totalCompanies }}</div>
                    <div class="text-muted">Companies Ordering</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold" style="color:var(--primary)">Order Status Overview</h5>
        </div>
        <div class="card-body">
            <div class="row g-4 text-center mb-4">
                <div class="col-md-4">
                    <div class="p-3 rounded bg-success bg-opacity-10">
                        <div class="h1 mb-2 text-success"><i class="bi bi-check-circle"></i></div>
                        <div class="display-6 fw-bold text-success mb-1">{{ $completedOrders }}</div>
                        <div class="text-muted small">Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded" style="background:rgba(255,136,0,0.08);">
                        <div class="h1 mb-2" style="color:var(--primary);"><i class="bi bi-clock"></i></div>
                        <div class="display-6 fw-bold mb-1" style="color:var(--primary);">{{ $pendingOrders }}</div>
                        <div class="text-muted small">Pending</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded bg-danger bg-opacity-10">
                        <div class="h1 mb-2 text-danger"><i class="bi bi-x-circle"></i></div>
                        <div class="display-6 fw-bold text-danger mb-1">{{ $cancelledOrders }}</div>
                        <div class="text-muted small">Cancelled</div>
                    </div>
                </div>
            </div>

            <h6 class="mb-3 fw-semibold" style="color:var(--primary)">Order Distribution</h6>
            <div class="progress" style="height: 15px;">
                @if($totalOrders > 0)
                    <div class="progress-bar bg-success fw-semibold" role="progressbar"
                        style="width: {{ ($completedOrders / $totalOrders) * 100 }}%"
                        aria-valuenow="{{ $completedOrders }}" aria-valuemin="0" aria-valuemax="{{ $totalOrders }}">
                        {{ round(($completedOrders / $totalOrders) * 100) }}%
                    </div>
                    <div class="progress-bar fw-semibold" style="background:var(--primary);" role="progressbar"
                        style="width: {{ ($pendingOrders / $totalOrders) * 100 }}%"
                        aria-valuenow="{{ $pendingOrders }}" aria-valuemin="0" aria-valuemax="{{ $totalOrders }}">
                        {{ round(($pendingOrders / $totalOrders) * 100) }}%
                    </div>
                    <div class="progress-bar bg-danger fw-semibold" role="progressbar"
                        style="width: {{ ($cancelledOrders / $totalOrders) * 100 }}%"
                        aria-valuenow="{{ $cancelledOrders }}" aria-valuemin="0" aria-valuemax="{{ $totalOrders }}">
                        {{ round(($cancelledOrders / $totalOrders) * 100) }}%
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Orders Over Time Chart -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold" style="color:var(--primary)">Orders Over Time</h5>
        </div>
        <div class="card-body">
            <canvas id="ordersChart" height="100"></canvas>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Product Summary -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-bold" style="color:var(--primary)">Top Products</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background:var(--gray-light);">
                                <tr>
                                    <th>Product</th>
                                    <th>Orders</th>
                                    <th>Quantity</th>
                                    <th>Avg. Per Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productSummary as $product)
                                <tr>
                                    <td class="fw-semibold">{{ $product['product_name'] }}</td>
                                    <td>{{ $product['order_count'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>{{ $product['avg_quantity'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Company Summary -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 fw-bold" style="color:var(--primary)">Top Companies</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background:var(--gray-light);">
                                <tr>
                                    <th>Company</th>
                                    <th>Orders</th>
                                    <th>Quantity</th>
                                    <th>Avg. Per Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companySummary as $company)
                                <tr>
                                    <td class="fw-semibold">{{ $company['company_name'] }}</td>
                                    <td>{{ $company['order_count'] }}</td>
                                    <td>{{ $company['quantity'] }}</td>
                                    <td>{{ $company['avg_quantity'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- All Orders Table -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0 fw-bold" style="color:var(--primary)">All Orders</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:var(--gray-light);">
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Company</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td class="fw-semibold">{{ $order->product->name }}</td>
                            <td>{{ $order->company->name }}</td>
                            <td>
                                <span class="badge {{ $order->quantity < 10 ? 'bg-danger' : 'bg-success' }}">
                                    {{ $order->quantity }}
                                </span>
                            </td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge" style="background:var(--primary); color: var(--light);">Pending</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info text-light me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this order?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found for this period.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('ordersChart');

        // Use the PHP variable for order data, formatted as JSON
        const ordersData = @json($dateValues);
        const dateLabels = @json($dateLabels);

        // Define colors using CSS variables or hex codes
        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim();
        const darkColor = getComputedStyle(document.documentElement).getPropertyValue('--dark').trim();

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dateLabels,
                datasets: [{
                    label: 'Number of Orders',
                    data: ordersData,
                    borderColor: primaryColor, // Use primary color for the line
                    backgroundColor: 'rgba(255, 136, 0, 0.2)', // Light orange for fill
                    fill: true,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: darkColor // Use dark color for legend text
                        }
                    },
                    title: {
                        display: false,
                        text: 'Orders Over Time'
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: darkColor // Use dark color for x-axis labels
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)' // Light grid lines
                        }
                    },
                    y: {
                        ticks: {
                            color: darkColor // Use dark color for y-axis labels
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)' // Light grid lines
                        }
                    }
                }
            }
        });

        // Print button functionality
        const printBtn = document.getElementById('printReportBtn');
        if(printBtn) {
            printBtn.addEventListener('click', function() {
                window.print();
            });
        }
    });
</script>
@endsection

@section('styles')
<style>
    /* Add print specific styles here */
    @media print {
        .print-hide {
            display: none !important;
        }
        body {
            background-color: #fff !important;
            color: #000 !important;
        }
        .card,
        .card-header,
        .card-body,
        .table {
            border: 1px solid #ddd !important;
        }
        .card-header {
            background-color: #f8f9fa !important;
        }
        .table thead tr {
            background-color: #e9ecef !important;
        }
    }
</style>
@endsection
