@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Employee Details
                    <a href="{{ route('employees.index') }}" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong>
                    <p>{{ $employee->name }}</p>
                </div>
                <div class="mb-3">
                    <strong>Email:</strong>
                    <p>{{ $employee->email }}</p>
                </div>
                <div class="mb-3">
                    <strong>Position:</strong>
                    <p>{{ $employee->position }}</p>
                </div>
                <div class="mb-3">
                    <strong>Status:</strong>
                    <p>
                        @if($employee->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <strong>Added On:</strong>
                    <p>{{ $employee->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong>
                    <p>{{ $employee->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="mb-3">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit Employee</a>
                    
                    @if($employee->status == 'active')
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $employee->name }}">
                        <input type="hidden" name="email" value="{{ $employee->email }}">
                        <input type="hidden" name="position" value="{{ $employee->position }}">
                        <input type="hidden" name="status" value="inactive">
                        <button type="submit" class="btn btn-warning mx-2" onclick="return confirm('Are you sure you want to deactivate this employee?')">
                            Deactivate
                        </button>
                    </form>
                    @else
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $employee->name }}">
                        <input type="hidden" name="email" value="{{ $employee->email }}">
                        <input type="hidden" name="position" value="{{ $employee->position }}">
                        <input type="hidden" name="status" value="active">
                        <button type="submit" class="btn btn-success mx-2" onclick="return confirm('Are you sure you want to activate this employee?')">
                            Activate
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 