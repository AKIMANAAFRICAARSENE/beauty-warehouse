@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Company Details
                    <a href="{{ route('companies.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Company Name:</strong>
                    <p>{{ $company->name }}</p>
                </div>
                <div class="mb-3">
                    <strong>Email Address:</strong>
                    <p>{{ $company->email }}</p>
                </div>
                <div class="mb-3">
                    <strong>Phone Number:</strong>
                    <p>{{ $company->phone }}</p>
                </div>
                <div class="mb-3">
                    <strong>Added On:</strong>
                    <p>{{ $company->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong>
                    <p>{{ $company->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="mb-3">
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit Company</a>
                </div>
                
                <div class="mt-5">
                    <h5>Orders from this Company:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($company->orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No orders found from this company.</td>
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