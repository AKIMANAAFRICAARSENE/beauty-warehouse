@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                <h4 class="mb-0 fw-bold" style="color:var(--primary)">Companies</h4>
                <a href="{{ route('companies.create') }}" class="btn btn-primary fw-semibold">
                    <i class="bi bi-plus-circle me-1"></i> Add Company
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:var(--gray-light);">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td class="fw-semibold">{{ $company->name }}</td>
                                <td class="text-muted">{{ $company->email }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>
                                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-info text-light me-1" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-primary me-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this company?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
