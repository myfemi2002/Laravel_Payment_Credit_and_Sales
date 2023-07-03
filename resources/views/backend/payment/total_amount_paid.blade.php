@extends('admin.admin_master')
@section('title', 'Total Amount Paid')
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
                <h4 class="card-title">@yield('title')</h4>
                <p class="card-text">All Paid Customers</p>
            </div>
            <div class="card-body">

                <br>
                @if(isset($allData))
                <div class="table-responsive">
                    <table id="example" class="cell-border display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Purchase Date</th>
                                <th>Event Name</th>
                                <th>Prod Name</th>
                                <th>Prod Tot Amt</th>
                                <th>Paid Amount</th>
                                <th>Pay. Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalPaidAmount = 0;
                            @endphp
                            @foreach($allData as $key => $item)
                            @php
                            $totalPaidAmount += $item->amount_paid;
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#">{{ $item->customer_name }}</a>
                                    </h2>
                                </td>
                                <td>{{ $item->purchase_date }}</td>
                                <td>{{ $item->event_name }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>₦{{ number_format($item->product_total_amount, 2) }}</td>
                                <td>₦{{ number_format($item->amount_paid, 2) }}</td>
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
                        <tfoot>
                            <tr>
                                <th colspan="6" style="text-align:right">Total:</th>
                                <th>₦{{ number_format($totalPaidAmount, 2) }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
