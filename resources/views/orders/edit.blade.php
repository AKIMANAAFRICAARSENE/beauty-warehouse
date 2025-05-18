@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Order
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

                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="product_id">Product</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} (Available: {{ $product->quantity }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="company_id">Company</label>
                        <select name="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ $order->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $order->quantity }}" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="order_date">Order Date</label>
                        <input type="date" name="order_date" class="form-control" value="{{ $order->order_date }}" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 