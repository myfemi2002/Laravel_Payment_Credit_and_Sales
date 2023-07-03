@extends('admin.admin_master')
@section('title', 'Product')
@section('admin')
<div class="page-header">
    <div class="content-page-header">
        <h5>@yield('title')</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header card-buttons">
                <h5 class="card-title">@yield('title')</h5>
                <p class="card-text">Add product and amount</p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" id="myForm" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" class="form-control" placeholder="Product Name" name="product_name" required>
                                            <small class="form-control-feedback">
                                            @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Product Amount</label>
                                            <input type="text" class="form-control" placeholder="Product Amount" name="product_amount" required>
                                            <small class="form-control-feedback">
                                            @error('product_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                        <div class="col-auto align-self-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                            </div>
                            <!-- Row -->
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
                <h5 class="card-title">@yield('title')</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Amount</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr class="{{ $colors[$key % count($colors)] }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>₦{{ number_format($item->product_amount, 2) }}</td>
                                <td>
                                    @if($item->created_at == NULL)
                                    <span class="text-danger">No Date Set</span>
                                    @else
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit Data</button>
                                    <button class="btn btn-sm btn-danger" title="Delete Data" id="delete_data" href="{{ route('product.delete', $item->id) }}">Delete</button>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit @yield('title')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('product.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" placeholder="Product Name" name="product_name" value="{{ $item->product_name }}">
                                                    @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Product Amount</label>
                                                    <input type="text" class="form-control" placeholder="Product Amount" name="product_amount" value="{{ $item->product_amount }}">
                                                    @error('product_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer mt-2">
                                                <button type="submit" class="btn btn-danger">Update Changes</button>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var productAmountInput = document.querySelector('input[name="product_amount"]');
    productAmountInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();

            // Serialize the form data
            var formData = $(this).serialize();

            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{ route('familiar-ground.store') }}",
                data: formData,
                success: function(response) {
                    // Handle the success response
                    console.log(response);
                    location.reload(); // Refresh the page
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.log(xhr.responseText);
                    alert('Error occurred while saving data');
                }
            });
        });
    });
</script>
@endsection
