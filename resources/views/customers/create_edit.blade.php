@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Customer</h4>
                </div>
                <div class="card-body">
                    @if (isset($customer))
                    <form class="forms-sample" action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @method('PATCH')
                        @else
                        <form class="forms-sample" action="{{ route('customers.store') }}" method="POST">
                            @endif

                            @csrf
                            <div class="form-group row">
                                <label for="customer-name" class="col-sm-3 col-form-label">Customer Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="
                                    customer-name" placeholder="Customer name"
                                        value="{{ isset($customer) ? $customer->name : old('name') }}" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="age" class="col-sm-3 col-form-label">Age</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('age') is-invalid @enderror"
                                        id="age" placeholder="Age" name="age"
                                        value="{{ isset($customer) ? $customer->age : old('age')}}">
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile_number" class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror"
                                        id="mobile_number" placeholder="Mobile number"
                                        value="{{ isset($customer) ? $customer->mobile_number : old('mobile_number') }}"
                                        name="mobile_number">
                                    @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">{{ isset($customer) ? 'Update' : 'Submit'
                                }}</button>
                            <a href="{{ route('customers.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection