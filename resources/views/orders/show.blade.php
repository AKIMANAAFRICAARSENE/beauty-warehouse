@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Order Details
                    <a href="{{ route('orders.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Order ID:</strong>
                            <p>{{ $order->id }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Product:</strong>
                            <p>{{ $order->product->name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Company:</strong>
                            <p>{{ $order->company->name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Quantity:</strong>
                            <p>{{ $order->quantity }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Status:</strong>
                            <p>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </p>
                        </div>
                        <div class="mb-3">
                            <strong>Order Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Created At:</strong>
                            <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Last Updated:</strong>
                            <p>{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit Order</a>
                    
                    @if($order->status == 'pending')
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <input type="hidden" name="product_id" value="{{ $order->product_id }}">
                        <input type="hidden" name="company_id" value="{{ $order->company_id }}">
                        <input type="hidden" name="quantity" value="{{ $order->quantity }}">
                        <input type="hidden" name="order_date" value="{{ $order->order_date }}">
                        <button type="submit" class="btn btn-success mx-2" onclick="return confirm('Are you sure you want to mark this order as completed?')">
                            Mark as Completed
                        </button>
                    </form>
                    
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <input type="hidden" name="product_id" value="{{ $order->product_id }}">
                        <input type="hidden" name="company_id" value="{{ $order->company_id }}">
                        <input type="hidden" name="quantity" value="{{ $order->quantity }}">
                        <input type="hidden" name="order_date" value="{{ $order->order_date }}">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">
                            Cancel Order
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 