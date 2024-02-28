@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    @if (\Session::has('success'))
                    <p class="alert alert-success">
                        {{ \Session::get('success') }}
                    </p>
                    @endif
                    <div class="row">
                        <div class="col-8 text-left">
                            <h4 class="card-title">List Products</h4>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('products.create') }}"
                                class="btn btn-primary btn-rounded btn-fw text-end">Create
                                New</a>
                            <a href="{{ route('products.export') }}"
                                class="btn btn-info btn-rounded btn-fw text-end">Export</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Created By</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @forelse ($products as $key => $item)
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->userName->name}}</td>
                                    <td>{{$item->customer->name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $item->id) }}"
                                            class="btn btn-info btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-rounded btn-icon"
                                            onclick="confirmDelete()">
                                            <i class="ti-trash"></i>
                                        </a>
                                        <form id="delete-product" action="{{ route('products.destroy', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    @empty
                                    <td colspan="5">Data not available.....</td>
                                    @endforelse
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete() {
        if (window.confirm('Are you sure you want to delete this product?')) {
            document.getElementById('delete-product').submit();
        }
    }
</script>
@endsection