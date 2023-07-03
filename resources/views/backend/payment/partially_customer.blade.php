@extends('admin.admin_master')
@section('title', 'Partially Paid Customer')
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
                    <table id="example" class="cell-border display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Purchase Date</th>
                                <th>Prod Name</th>
                                <th>Prod Tot Amt</th>
                                <th>Paid Amount</th>
                                <th>Tot Amt Remaining</th>
                                <th>Pay. Status</th>
                                <th>Action</th>
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
                                <td>
                                    <button class="btn btn-sm btn-primary edit-data-btn" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal" data-item="{{ json_encode($item) }}">Update Payment</button>
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
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update @yield('title')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form class="needs-validation" id="myForm" method="POST" action="{{ route('unpaid-payment.update') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input class="form-control" id="customer_name" placeholder="Customer Name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input class="form-control" id="purchase_date" placeholder="Purchase Date" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_total_amount" class="form-label">Product Total Amount</label>
                                <input type="text" class="form-control" id="product_total_amount" placeholder="Product Total Amount" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount_paid" class="form-label">Amount Paid</label>
                                <input type="text" class="form-control" id="amount_paid" placeholder="Amount Paid" name="amount_paid" oninput="calculateTotalAmountPaid(); updatePaymentStatus(); validateAmountPaid()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total-amount-paid" class="form-label">Total Amount Paid</label>
                                <input type="text" class="form-control" id="total-amount-paid" placeholder="Total Amount Paid" name="total_amount_paid" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <input class="form-control" id="payment_status" name="payment_status" type="text" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label for="remark" class="form-label">Remark</label>
                                <textarea class="form-control" placeholder="Remark" id="remark" name="remark"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="payment_id" id="payment_id">
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('backend/assets/toaster/toastr.min.js') }}"></script>
<script>
    function updatePaymentStatus() {
        var productTotalAmount = parseFloat(document.getElementById('product_total_amount').value.replace('₦', '').replace(',', ''));
        var amountPaid = parseFloat(document.getElementById('amount_paid').value.replace('₦', '').replace(',', ''));
        var paymentStatusInput = document.getElementById('payment_status');

        if (isNaN(productTotalAmount) || isNaN(amountPaid)) {
            paymentStatusInput.value = "";
            return;
        }

        if (productTotalAmount === amountPaid) {
            paymentStatusInput.value = "Paid";
        } else if (amountPaid === 0) {
            paymentStatusInput.value = "Unpaid";
        } else {
            paymentStatusInput.value = "Partially";
        }
    }

    function validateAmountPaid() {
        var productTotalAmount = parseFloat(document.getElementById('product_total_amount').value.replace('₦', '').replace(',', ''));
        var amountPaid = parseFloat(document.getElementById('amount_paid').value.replace('₦', '').replace(',', ''));
        var amountPaidField = document.getElementById('amount_paid');
        var totalAmountPaidField = document.getElementById('total-amount-paid');

        if (amountPaid > productTotalAmount) {
            toastr.error("Amount Paid cannot be greater than Product Total Amount");
            amountPaidField.value = '';
            totalAmountPaidField.value = '';
        }
    }

    const editButtons = document.querySelectorAll('.edit-data-btn');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const itemData = JSON.parse(btn.getAttribute('data-item'));

            const paymentIdField = document.getElementById('payment_id');
            const customerNameField = document.getElementById('customer_name');
            const purchaseDateField = document.getElementById('purchase_date');
            const productTotalAmountField = document.getElementById('product_total_amount');
            const amountPaidField = document.getElementById('amount_paid');
            const totalAmountPaidField = document.getElementById('total-amount-paid');
            const paymentStatusField = document.getElementById('payment_status');

            paymentIdField.value = itemData.id; // Set the ID of the item
            customerNameField.value = itemData.customer_name;
            purchaseDateField.value = itemData.purchase_date;
            productTotalAmountField.value = itemData.product_total_amount.replace('₦', '');
            amountPaidField.value = itemData.amount_paid.replace('₦', '');
            totalAmountPaidField.value = itemData.total_amount_paid.replace('₦', '');
            paymentStatusField.value = itemData.payment_status;
        });
    });

    function calculateTotalAmountPaid() {
        const productTotalAmount = parseFloat(document.getElementById('product_total_amount').value.replace('₦', '').replace(',', ''));
        const amountPaid = parseFloat(document.getElementById('amount_paid').value.replace('₦', '').replace(',', ''));
        const totalAmountPaidField = document.getElementById('total-amount-paid');

        const totalAmountPaid = productTotalAmount - amountPaid;
        totalAmountPaidField.value = totalAmountPaid.toFixed(2);
    }
</script>
@endsection
