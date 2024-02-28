@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper">
                            <a href="{{ route('customers.export') }}" class="btn btn-primary text-white me-0"><i
                                    class="icon-download"></i> Customers
                                Export</a>
                            <a href="{{ route('products.export')}}" class="btn btn-primary text-white me-0"><i
                                    class="icon-download"></i> Products
                                Export</a>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-3">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="statistics-title">Total Customers</p>
                                        <h3 class="rate-percentage">{{$customerCount}}</h3>
                                    </div>

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="statistics-title">Total Products</p>
                                        <h3 class="rate-percentage">{{$productCount}}</h3>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection