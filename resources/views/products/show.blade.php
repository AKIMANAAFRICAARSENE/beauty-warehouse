@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold" style="color:var(--primary)">Product Details</h4>
                <a href="{{ route('products.index') }}" class="btn btn-outline-danger fw-semibold">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Name:</span>
                    <div class="ps-2">{{ $product->name }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Description:</span>
                    <div class="ps-2 text-muted">{{ $product->description }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Quantity:</span>
                    <div class="ps-2">
                        <span class="badge {{ $product->quantity < 10 ? 'bg-danger' : 'bg-success' }}">
                            {{ $product->quantity }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Supplier:</span>
                    <div class="ps-2">{{ $product->supplier->name }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Added On:</span>
                    <div class="ps-2 text-muted">{{ $product->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Last Updated:</span>
                    <div class="ps-2 text-muted">{{ $product->updated_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3 text-end">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary fw-semibold">
                        <i class="bi bi-pencil me-1"></i> Edit Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
