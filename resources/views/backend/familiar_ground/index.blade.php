@extends('admin.admin_master')
@section('title', 'Familiar Ground')
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
                <p class="card-text">Add where you meet the customer</p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                        <form class="needs-validation" id="myForm" method="POST" action="{{ route('familiar-ground.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Familiar Ground Name</label>
                                            <input type="text" class="form-control" placeholder="Familiar Ground Name" name="familiar_ground_name" required>
                                            <small class="form-control-feedback">
                                            @error('familiar_ground_name')
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
                                <th>Familiar Ground Name</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr class="{{ $colors[$key % count($colors)] }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->familiar_ground_name }}</td>
                                <td>
                                    @if($item->created_at == NULL)
                                    <span class="text-danger">No Date Set</span>
                                    @else
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit Data</button>
                                    <button class="btn btn-sm btn-danger" title="Delete Data" id="delete_data" href="{{ route('familiar-ground.delete', $item->id) }}">Delete</button>
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
                                        <form action="{{ route('familiar-ground.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">Familiar Ground Name</label>
                                                    <input type="text" class="form-control" placeholder="Familiar Ground Name" name="familiar_ground_name" value="{{ $item->familiar_ground_name }}">
                                                    @error('familiar_ground_name')
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
