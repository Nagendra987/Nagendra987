@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Product</h4>
                </div>
                <div class="card-body">
                    @if (isset($product))
                    <form class="forms-sample" action="{{ route('products.update', $product->id) }}" method="POST">
                        @method('PATCH')
                        @else
                        <form class="forms-sample" action="{{ route('products.store') }}" method="POST">
                            @endif

                            @csrf
                            <div class="form-group row">
                                <label for="customer" class="col-sm-3 col-form-label">Select Customer</label>
                                <div class="col-sm-9">
                                    <select name="customer_id" id="customer"
                                        class="form-control @error('customer_id') is-invalid @enderror">
                                        <option value="" {{ isset($product) ? '' : 'selected' }} disabled>--Please
                                            select customer--</option>
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ isset($product) && $product->customer_id
                                            == $customer->id ? 'selcted' : ' '}}>{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product-name" class="col-sm-3 col-form-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="
                                    product-name" placeholder="Product name"
                                        value="{{ isset($product) ? $product->name : old('name') }}" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity" placeholder="Quantity" name="quantity"
                                        value="{{ isset($product) ? $product->quantity : old('quantity')}}">
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">{{ isset($product) ? 'Update' : 'Submit'
                                }}</button>
                            <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection