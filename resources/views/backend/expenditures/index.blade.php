@extends('admin.admin_master')
@section('title', 'Expenditures')
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
                <p class="card-text">Add all expenditures here</p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" id="myForm" method="POST" action="{{ route('expenditure.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Expenditure Title</label>
                                            <input type="text" class="form-control" name="expenditure_name" placeholder="Expenditure Title" required>
                                            <small class="form-control-feedback">
                                                @error('expenditure_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->

                                <div class="col-sm-6 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Amount</label>
                                            <input type="text" name="amount" class="form-control" placeholder="Amount" name="amount" required>
                                            <small class="form-control-feedback">
                                                @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->

                                <div class="col-sm-6 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Date</label>
                                            <div class="cal-icon cal-icon-info">
                                                <input type="text" name="date" class="datetimepicker form-control" placeholder="Select Date" required>
                                                <small class="form-control-feedback">
                                                    @error('date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->

                                <div class="col-sm-6 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Description</label>
                                            <textarea rows="1" cols="5" class="form-control" placeholder="Description" name="description" required></textarea>
                                            <small class="form-control-feedback">
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                            </div>
                            <!-- Row -->

                            <div class="row text-center">
                                <div class="col-sm">
                                    <button type="submit" class="btn btn-primary">Save Expenditure</button>
                                </div>
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
                <h5 class="card-title">@yield('title')</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Expenditure Name</th>
                                <th>Expenditure Amount</th>
                                <th>Expenditure Description</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->expenditure_name }}</td>
                                <td>₦{{ number_format($item->amount, 2) }}</td>

                                <td>{{ $item->description }}</td>
                                <td>
                                    @if($item->created_at == NULL)
                                    <span class="text-danger">No Date Set</span>
                                    @else
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit Data</button>
                                    <button class="btn btn-sm btn-danger" title="Delete Data" id="delete_data" href="{{ route('expenditure.delete', $item->id) }}">Delete</button>
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
                                        <form action="{{ route('expenditure.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="form-label">Expenditure Title</label>
                                                                <input type="text" class="form-control" name="expenditure_name"  value="{{ $item->expenditure_name }}" placeholder="Expenditure Title" required>
                                                                <small class="form-control-feedback">
                                                                    @error('expenditure_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Col -->

                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="form-label">Amount</label>
                                                                <input type="text" name="amount" class="form-control"  value="{{ $item->amount }}" placeholder="Amount" name="amount" required>
                                                                <small class="form-control-feedback">
                                                                    @error('amount')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Col -->

                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="form-label">Date</label>
                                                                <div class="cal-icon cal-icon-info">
                                                                    <input type="text" name="date" class="datetimepicker form-control"    value="{{ $item->date }}"placeholder="Select Date" required>
                                                                    <small class="form-control-feedback">
                                                                        @error('date')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Col -->

                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="form-label">Description</label>
                                                                <textarea rows="1" cols="5" class="form-control" placeholder="Description" name="description" required>{{ $item->description }}</textarea>
                                                                <small class="form-control-feedback">
                                                                @error('description')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Col -->
                                                </div>
                                                <!-- Row -->

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
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();

            // Serialize the form data
            var formData = $(this).serialize();

            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{ route('expenditure.store') }}",
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
<script>
    var amountInput = document.querySelector('input[name="amount"]');
    amountInput.addEventListener('input', function(event) {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
@endsection
