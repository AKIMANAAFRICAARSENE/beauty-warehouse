@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Create Order
                    <a href="{{ route('orders.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_id">Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Available: {{ $product->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="company_id">Company</label>
                        <select name="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="order_date">Order Date</label>
                        <input type="date" name="order_date" class="form-control" value="{{ old('order_date') ?? date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 