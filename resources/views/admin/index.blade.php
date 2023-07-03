@extends('admin.admin_master')
@section('title', 'Dashboard')
@section('admin')


<div class="row">
<div class="col-xl-2 col-sm-6 col-12">
    <div class="card">
        <div class="card-body">
            <div class="dash-widget-header">
                <span class="dash-widget-icon bg-1">
                    <i class="fas fa-naira-sign"></i>
                </span>
                <div class="dash-count">
                    <div class="dash-title">Total Amount Paid</div>
                    <div class="dash-counts">
                        <p> ₦ {{ number_format($currentTotalAmountPaid, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="progress progress-sm mt-3">
                <div class="progress-bar bg-5" role="progressbar" style="width: {{ $progressPercentage }}%" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>

    <div class="col-xl-2 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-2">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Customers</div>
                        <div class="dash-counts">
                            <p>{{ count($customers) }}</p>
                        </div>
                    </div>
                </div>
                <div class="progress progress-sm mt-3">
                    <div class="progress-bar bg-6" role="progressbar" style="width: {{ $progressPercentage }}%" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-2 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-3">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Paid Customers</div>
                        <div class="dash-counts">
                            <p>{{ $paidCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="progress progress-sm mt-3">
                    <div class="progress-bar bg-7" role="progressbar" style="width: {{ $paidPercentage }}%" aria-valuenow="{{ $paidPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-2 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-4">
                    <i class="far fa-file"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Unpaid Customers</div>
                        <div class="dash-counts">
                            <p>{{ $unpaidCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="progress progress-sm mt-3">
                    <div class="progress-bar bg-4" role="progressbar" style="width: {{ $unPaidPercentage }}%" aria-valuenow="{{ $unPaidPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-5">
                        <i class="fa fa-th"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Overdue Payment</div>
                        <div class="dash-counts">
                            <p>{{ $overdueCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="progress progress-sm mt-3">
                    <div class="progress-bar bg-5" role="progressbar" style="width: {{ $overDuePercentage }}%" aria-valuenow="{{ $overDuePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="dash-widget-icon bg-6">
                        <i class="fas fa-file-invoice"></i>
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">Partially Paid Customers</div>
                        <div class="dash-counts">
                            <p>{{ $partiallyPaidCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="progress progress-sm mt-3">
                    <div class="progress-bar bg-6" role="progressbar" style="width: {{ $partiallyPaidCount }}%" aria-valuenow="{{ $partiallyPaidCount }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row">
    <div class="col-xl-7 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Customer Analytics</h5>

                </div>
            </div>
            <div class="card-body">

                <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                    <div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                        <div>
                            <span>Paid</span>
                            <p class="h3 text-primary me-5">{{ $paidCount }}</p>
                        </div>
                        <div>
                            <span>Unpaid </span>
                            <p class="h3 text-success me-5">{{ $unpaidCount }}</p>
                        </div>
                        <div>
                            <span>Overdue </span>
                            <p class="h3 text-danger me-5">{{ $overdueCount }}</p>
                        </div>
                        <div>
                            <span>Partially </span>
                            <p class="h3 text-dark me-5">{{ $partiallyPaidCount }}</p>
                        </div>
                    </div>
                </div>


                <canvas id="customerChart"></canvas>

<script>
    // Retrieve the data from your controller
    var paidCount = <?php echo $paidCount; ?>;
    var unpaidCount = <?php echo $unpaidCount; ?>;
    var overdueCount = <?php echo $overdueCount; ?>;
    var partiallyPaidCount = <?php echo $partiallyPaidCount; ?>;

    // Create the chart
    var ctx = document.getElementById('customerChart').getContext('2d');
    var customerChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Paid Customers', 'Unpaid Customers', 'Overdue Payment', 'Partially Paid Customers'],
            datasets: [{
                label: 'Customer Status',
                data: [paidCount, unpaidCount, overdueCount, partiallyPaidCount],
                backgroundColor: ['#36a2eb', '#ff6384', '#ffce56', '#4bc0c0'],
                borderColor: ['#36a2eb', '#ff6384', '#ffce56', '#4bc0c0'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>









            </div>
        </div>
    </div>



    <div class="col-xl-5 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Product Analytics</h5>

                </div>
            </div>






            <div class="card-body">
    <div id="productChartContainer">
        <canvas id="productChart"></canvas>
    </div>
</div>

<script>
    // Retrieve the data from your controller
    var allProduct = @json($allProduct);

    // Extract the necessary data for the chart
    var productLabels = allProduct.map(function(product) {
        return product.product_name;
    });

    var productData = allProduct.map(function(product) {
        return product.product_amount;
    });

    // Generate random colors for the chart slices
    var colors = generateRandomColors(productData.length);

    // Function to generate random colors
    function generateRandomColors(count) {
        var colors = [];
        for (var i = 0; i < count; i++) {
            var color = '#' + Math.floor(Math.random() * 16777215).toString(16);
            colors.push(color);
        }
        return colors;
    }

    // Create the chart
    var ctx = document.getElementById('productChart').getContext('2d');
    var productChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: productLabels,
            datasets: [{
                data: productData,
                backgroundColor: colors,
            }],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        },
    });
</script>







        </div>
    </div>
</div>

<div class="row">


<div class="col-md-6 col-sm-6">
    <div class="card">
        <div class="card-header">
            <div class="row align-center">
                <div class="col">
                    <h5 class="card-title">Unpaid Customer</h5>
                </div>
                <div class="col-auto">
                    <a href="{{ route('unpaid-payment.view') }}" class="btn-right btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
    <table class="table table-stripped table-hover">
        <thead class="thead-light">
            <tr>
                <th>Customer</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unpaidCustomers as $customer)
            <tr>
                <td>{{ $customer->customer_name }}</td>
                <td>₦ {{ number_format($customer->product_total_amount, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($customer->purchase_date)->format('d M Y') }}</td>
                <td>
                    @if ($customer->payment_status === 'paid')
                    <span class="badge bg-success-light">Paid</span>
                    @elseif ($customer->payment_status === 'unpaid')
                    <span class="badge bg-warning">Unpaid</span>
                    @elseif ($customer->payment_status === 'overdue')
                    <span class="badge bg-danger-light">Overdue</span>
                    @elseif ($customer->payment_status === 'draft')
                    <span class="badge bg-info-light">Draft</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>
</div>

</div>



    <div class="col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header">
                <div class="row align-center">
                    <div class="col">
                        <h5 class="card-title">Paid Customer</h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('paid-payment.view') }}" class="btn-right btn btn-sm btn-outline-primary">
                        View All
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">



                <div class="table-responsive">
    <table class="table table-stripped table-hover">
        <thead class="thead-light">
            <tr>
                <th>Customer</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paidCustomers as $customer)
            <tr>
                <td>{{ $customer->customer_name }}</td>
                <td>₦ {{ number_format($customer->product_total_amount, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($customer->purchase_date)->format('d M Y') }}</td>
                <td>
                    @if ($customer->payment_status === 'paid')
                    <span class="badge bg-success-light">Paid</span>
                    @elseif ($customer->payment_status === 'unpaid')
                    <span class="badge bg-warning">Unpaid</span>
                    @elseif ($customer->payment_status === 'overdue')
                    <span class="badge bg-danger-light">Overdue</span>
                    @elseif ($customer->payment_status === 'draft')
                    <span class="badge bg-info-light">Draft</span>
                    @endif
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
