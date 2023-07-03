@extends('admin.admin_master')
@section('title', 'Payments')
@section('admin')
<style>
    .ash {
    background-color: #eee;
    }
</style>
<div class="page-header">
    <div class="content-page-header">
        <h5>@yield('title')</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header card-buttons">
                <h5 class="card-title">Add @yield('title')</h5>
                <p class="card-text">Add all your customers here</p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" id="myForm" method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Customer Name</label>
                                            <select class="form-control form-small select" name="customer_name" required>
                                                <option value="" selected disabled>-- Select --</option>
                                                @foreach($customer as $items)
                                                <option value="{{ $items->customer_name }}">{{ $items->customer_name }} - {{ $items->customer_phone }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label>Purchase Date</label>
                                            <div class="cal-icon cal-icon-info">
                                                <input type="text" name="purchase_date" class="datetimepicker form-control" placeholder="Select Date" required>
                                            </div>
                                            <small class="form-control-feedback">
                                            @error('purchase_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Product Total Amount</label>
                                            <input type="text" class="form-control ash" placeholder="Product Total Amount" name="product_total_amount" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Amount Paid</label>
                                            <input type="text" class="form-control" placeholder="Amount Paid" name="amount_paid" required oninput="calculateTotalAmountPaid()">
                                            <small class="form-control-feedback">
                                            @error('amount_paid')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-2 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Total Amount Remaining</label>
                                            <input type="text" class="form-control ash" placeholder="Total Amount Remaining" name="total_amount_paid" required readonly>
                                            <small class="form-control-feedback">
                                            @error('total_amount_paid')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-2 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Event Name</label>
                                            <select class="form-control form-small select" name="event_name" required>
                                                <option value="" selected disabled>-- Select --</option>
                                                @foreach($event as $items)
                                                <option value="{{ $items->event_name }}">{{ $items->event_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-2 mt-2 mb-3">
                                    <div class="form-group">
                                        <label for="payment_status">Payment Status</label>
                                        <input class="form-control" id="payment_status" name="payment_status" type="text" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-2 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Remark</label>
                                            <textarea rows="1" cols="5" class="form-control" placeholder="Remark" name="remark" required></textarea>
                                            <small class="form-control-feedback">
                                            @error('remark')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                            </div>
                            <!-- Row -->
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Select Products</label>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($product as $product)
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="product_name[]" value="{{ $product->product_name }}" id="product{{ $product->id }}">
                                        <label class="form-check-label" for="product{{ $product->id }}">
                                        {{ $product->product_name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-auto align-self-end mt-4 mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Latest 5 @yield('title')</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cust Name</th>
                                <th>Purchase Date</th>
                                <th>Prod Name</th>
                                <th>Event Name</th>
                                <th>Paid Amount</th>
                                <th>Tot Amt Remaining</th>
                                <th>Pay. Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr class="{{ $colors[$key % count($colors)] }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->purchase_date }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->event_name }}</td>
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
<!-- Include the Toastr library -->
<script src="{{ asset('backend/assets/toaster/toastr.min.js') }}"></script>
<script>
    function updateProductAmount(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var productAmount = selectedOption.getAttribute('data-amount');
        document.querySelector('input[name="product_amount"]').value = productAmount;
        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        var productAmount = parseFloat(document.querySelector('input[name="product_amount"]').value);
        var productTotalAmount = productAmount;
        document.querySelector('input[name="product_total_amount"]').value = productTotalAmount.toFixed(2);
        calculateTotalAmountPaid();
    }

    function calculateTotalAmountPaid() {
        var amountPaid = parseFloat(document.querySelector('input[name="amount_paid"]').value);
        var productTotalAmount = parseFloat(document.querySelector('input[name="product_total_amount"]').value);

        var totalAmountPaid = productTotalAmount - amountPaid;

        if (amountPaid > productTotalAmount) {
            toastr.error("Amount Paid cannot be greater than Product Total Amount.");
            document.querySelector('input[name="amount_paid"]').value = "";
            document.querySelector('input[name="total_amount_paid"]').value = "";
        } else {
            document.querySelector('input[name="total_amount_paid"]').value = totalAmountPaid.toFixed(2);
        }
        updatePaymentStatus();
    }

    function updatePaymentStatus() {
        var productTotalAmount = parseFloat(document.querySelector('input[name="product_total_amount"]').value);
        var amountPaid = parseFloat(document.querySelector('input[name="amount_paid"]').value);
        var totalAmountPaid = parseFloat(document.querySelector('input[name="total_amount_paid"]').value);
        var paymentStatusInput = document.getElementById('payment_status');

        if (productTotalAmount === totalAmountPaid && amountPaid === 0) {
            paymentStatusInput.value = "Unpaid";
        } else if (productTotalAmount === amountPaid && totalAmountPaid === 0) {
            paymentStatusInput.value = "Paid";
        } else {
            paymentStatusInput.value = "Partially";
        }
    }

    // Call the updatePaymentStatus function whenever the amount paid, total amount paid, or product total amount changes
    document.querySelector('input[name="amount_paid"]').addEventListener('input', updatePaymentStatus);
    document.querySelector('input[name="total_amount_paid"]').addEventListener('input', updatePaymentStatus);
    document.querySelector('input[name="product_total_amount"]').addEventListener('input', updatePaymentStatus);

    // Call the updatePaymentStatus function initially to set the initial payment status
    updatePaymentStatus();
</script>
<script>
    // Display Toastr notifications
    @if (session('message'))
        var type = "{{ session('alert-type', 'info') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ session('message') }}");
                break;
            case 'success':
                toastr.success("{{ session('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ session('message') }}");
                break;
            case 'error':
                toastr.error("{{ session('message') }}");
                break;
        }
    @endif
</script>
<script>
    var amountPaidInput = document.querySelector('input[name="amount_paid"]');
    amountPaidInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
<script>
    var productTotalAmountInput = document.querySelector('input[name="product_total_amount"]');
    productTotalAmountInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
<script>
    var totalAmountInput = document.querySelector('input[name="total_amount"]');
    totalAmountInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
@endsection
