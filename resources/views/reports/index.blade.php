@extends('layouts.app')

@section('content')
<!-- Hero Banner -->
<div class="p-4 mb-4 rounded-3" style="background: linear-gradient(90deg, var(--primary) 60%, var(--dark) 100%); color: var(--light); box-shadow: 0 4px 24px rgba(255,136,0,0.10);">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div>
            <h1 class="mb-1 fw-bold" style="color: var(--light); letter-spacing: -0.03em;">Reports Dashboard</h1>
            <p class="mb-0" style="color: #fff9f0;">Analyze your business data with beautiful, interactive reports.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('dashboard.index') }}" class="btn btn-light text-black fw-bold shadow-sm">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 d-flex align-items-center">
                <i class="bi bi-bag-check me-2" style="color:var(--primary);font-size:1.5rem;"></i>
                <h5 class="mb-0 fw-bold" style="color:var(--primary)">Orders Report</h5>
            </div>
            <div class="card-body">
                <div class="bg-light p-4 text-center mb-4 rounded">
                    <div class="display-6 mb-3" style="color:var(--primary)"><i class="bi bi-file-earmark-bar-graph"></i></div>
                    <h4 class="mb-2">Order Analytics</h4>
                    <p class="text-muted mb-0">Detailed analysis of your order performance</p>
                </div>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex align-items-center border-0 bg-light mb-2 rounded">
                        <span class="badge bg-primary rounded-circle me-2">1</span>
                        Order status breakdown with percentages
                    </li>
                    <li class="list-group-item d-flex align-items-center border-0 bg-light mb-2 rounded">
                        <span class="badge bg-primary rounded-circle me-2">2</span>
                        Daily order trends visualization
                    </li>
                    <li class="list-group-item d-flex align-items-center border-0 bg-light rounded">
                        <span class="badge bg-primary rounded-circle me-2">3</span>
                        Top products and companies analysis
                    </li>
                </ul>
                <form action="{{ route('reports.orders') }}" method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="start_date_orders" class="form-label fw-semibold">Start Date</label>
                            <input type="date" name="start_date" id="start_date_orders" class="form-control" value="{{ date('Y-m-01') }}">
                        </div>
                        <div class="col-md-5">
                            <label for="end_date_orders" class="form-label fw-semibold">End Date</label>
                            <input type="date" name="end_date" id="end_date_orders" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-graph-up"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('reports.orders') }}" class="btn btn-outline-primary w-100 fw-semibold">
                    <i class="bi bi-calendar-check me-2"></i> View Current Month Report
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 d-flex align-items-center">
                <i class="bi bi-box-seam me-2" style="color:var(--success);font-size:1.5rem;"></i>
                <h5 class="mb-0 fw-bold" style="color:var(--success)">Products Report</h5>
            </div>
            <div class="card-body">
                <div class="bg-light p-4 text-center mb-4 rounded">
                    <div class="display-6 mb-3" style="color:var(--success)"><i class="bi bi-box-seam"></i></div>
                    <h4 class="mb-2">Product Performance</h4>
                    <p class="text-muted mb-0">Inventory and sales analysis for your products</p>
                </div>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex align-items-center border-0 bg-light mb-2 rounded">
                        <span class="badge bg-success rounded-circle me-2">1</span>
                        Best selling products identification
                    </li>
                    <li class="list-group-item d-flex align-items-center border-0 bg-light mb-2 rounded">
                        <span class="badge bg-success rounded-circle me-2">2</span>
                        Low stock alerts and inventory status
                    </li>
                    <li class="list-group-item d-flex align-items-center border-0 bg-light rounded">
                        <span class="badge bg-success rounded-circle me-2">3</span>
                        Order trend analysis by product
                    </li>
                </ul>
                <form action="{{ route('reports.products') }}" method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="start_date_products" class="form-label fw-semibold">Start Date</label>
                            <input type="date" name="start_date" id="start_date_products" class="form-control" value="{{ date('Y-m-01') }}">
                        </div>
                        <div class="col-md-5">
                            <label for="end_date_products" class="form-label fw-semibold">End Date</label>
                            <input type="date" name="end_date" id="end_date_products" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-graph-up"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('reports.products') }}" class="btn btn-outline-success w-100 fw-semibold">
                    <i class="bi bi-calendar-check me-2"></i> View Current Month Report
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
