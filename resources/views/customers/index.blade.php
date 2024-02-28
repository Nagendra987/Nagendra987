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
                            <h4 class="card-title">List Customers</h4>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('customers.create') }}"
                                class="btn btn-primary btn-rounded btn-fw text-end">Create
                                New</a>
                            <a href="{{ route('customers.export') }}"
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
                                    <th>Mobile Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   @if($customers)
                                    @forelse ($customers as $key => $item)
                                    <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->userName->name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->mobile_number }}</td>
                                    <td>
                                        <a href="{{ route('customers.edit', $item->id) }}"
                                            class="btn btn-info btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-rounded btn-icon"
                                            onclick="confirmDelete()">
                                            <i class="ti-trash"></i>
                                        </a>
                                        <form id="delete-custommer" action="{{ route('customers.destroy', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    @empty
                                    <td colspan="5">Data not available.....</td>
                                    </tr>
                                    @endforelse
                                    @endif
                                

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
        if (window.confirm('Are you sure you want to delete this customer?')) {
            document.getElementById('delete-custommer').submit();
        }
    }
</script>
@endsection