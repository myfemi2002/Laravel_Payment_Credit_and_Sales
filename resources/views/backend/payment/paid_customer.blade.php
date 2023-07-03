@extends('admin.admin_master')
@section('title', 'Paid Customer')
@section('admin')
<div class="page-header">
    <div class="content-page-header">
        <h5>@yield('title')</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-buttons">
                <h4 class="card-title"> @yield('title')</h4>
                <p class="card-text">
                    All Paid Customers
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- <table class="datatable table table-stripped"> -->
                    {{--
                    <table id="example" class="display table table-stripped" >
                    --}}
                    <table id="example" class="cell-border display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Purchhase Date</th>
                                <th>Prod Name</th>
                                <th>Prod Tot Amt</th>
                                <th>Paid Amount</th>
                                <th>Tot Amt Remaining</th>
                                <th>Pay. Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#">{{ $item->customer_name }}</a>
                                    </h2>
                                </td>
                                <td>{{ $item->purchase_date }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>₦{{ number_format($item->product_total_amount, 2) }}</td>
                                <td>₦{{ number_format($item->amount_paid, 2) }}</td>
                                <td>₦{{ number_format($item->total_amount_paid, 2) }}</td>
                                <td>
                                    @php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($item->payment_status) {
                                    case 'paid':
                                    $statusClass = 'badge-pill bg-success-light text-success';
                                    $statusText = 'Paid';
                                    break;
                                    case 'partially':
                                    $statusClass = 'badge-pill bg-warning-light text-warning';
                                    $statusText = 'Partially';
                                    break;
                                    case 'unpaid':
                                    $statusClass = 'badge-pill bg-danger-light text-danger';
                                    $statusText = 'Unpaid';
                                    break;
                                    default:
                                    break;
                                    }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
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
