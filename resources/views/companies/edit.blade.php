@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Company
                    <a href="{{ route('companies.index') }}" class="btn btn-danger float-end">Back</a>
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

                <form action="{{ route('companies.update', $company->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name">Company Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $company->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 