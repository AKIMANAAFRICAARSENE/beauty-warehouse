@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold" style="color:var(--primary)">Supplier Details</h4>
                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-danger fw-semibold">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Name:</span>
                    <div class="ps-2">{{ $supplier->name }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Email:</span>
                    <div class="ps-2 text-muted">{{ $supplier->email }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Phone:</span>
                    <div class="ps-2">{{ $supplier->phone }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Added On:</span>
                    <div class="ps-2 text-muted">{{ $supplier->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold" style="color:var(--primary)">Last Updated:</span>
                    <div class="ps-2 text-muted">{{ $supplier->updated_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="mb-3 text-end">
                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary fw-semibold">
                        <i class="bi bi-pencil me-1"></i> Edit Supplier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-4">
    <div class="col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0 fw-bold" style="color:var(--primary)">Products from this Supplier</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:var(--gray-light);">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($supplier->products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td>
                                    <span class="badge {{ $product->quantity < 10 ? 'bg-danger' : 'bg-success' }}">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info text-light" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No products found from this supplier.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
