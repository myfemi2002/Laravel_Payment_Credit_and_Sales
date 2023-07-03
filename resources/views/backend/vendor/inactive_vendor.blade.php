@extends('admin.admin_master')
@section('title', 'All Inactive Vendor')
@section('admin')
<div class="page-content">
<!--breadcrumb-->
@include('admin.body.breadcrumb')
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Vendor Username </th>
                        <th scope="col">Join Date  </th>
                        <th scope="col">Vendor Email </th>
                        <th scope="col">Status </th>
                        <th scope="col">Date of Creation</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inActiveVendor as $key => $item)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td> {{ $item->name }}</td>
                        <td> {{ $item->username }}</td>
                        <td> {{ $item->vendor_join }}</td>
                        <td> {{ $item->email }}  </td>
                        <td> <span class="btn btn-secondary">{{ $item->status }}</span>   </td>
                        <td>
                            <a href="{{ route('inactive.vendor.details',$item->id) }}" class="btn btn-info">Vendor Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination mt-3"  style="float: right;">
                <ul class="pagination-list">
                    {{ $inActiveVendor->Links('pagination::bootstrap-4') }}
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

@endsection
