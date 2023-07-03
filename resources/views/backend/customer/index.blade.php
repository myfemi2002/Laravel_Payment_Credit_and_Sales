@extends('admin.admin_master')
@section('title', 'Customers')
@section('admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                        <form class="needs-validation" id="myForm" method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Customer Name</label>
                                            <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" required>
                                            <small class="form-control-feedback">
                                            @error('customer_name')
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
                                            <label class="form-label">Customer Phone Number</label>
                                            <input type="text" class="form-control" placeholder="Customer Phone Number" name="customer_phone" required>
                                            <small class="form-control-feedback">
                                            @error('customer_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="form-group">
                                        <label for="customer_gender">Customer Gender</label>
                                        <select class="form-control form-small select" id="customer_gender" name="customer_gender" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="nonbinary">Non-Binary</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Customer Familiar Ground Name</label>
                                            <select class="form-control form-small select" name="familiar_ground_name" required>
                                                <option value="" selected="" disabled="">-- Select --</option>
                                                @foreach($familiarGround as $items)
                                                <option value="{{ $items->familiar_ground_name }}">{{ $items->familiar_ground_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-4 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">Customer Description</label>
                                            <textarea rows="1" cols="5" class="form-control"  placeholder="Customer Description" name="customer_description" required></textarea>
                                            <small class="form-control-feedback">
                                            @error('customer_description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-auto align-self-end  mt-4 mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                    All Permission
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="examp" class="cell-border" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Know Place</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <p class="table-avatar">
                                        <a href="#" class="avatar avatar-md me-2">
                                        <span class="suite">
                                        @if ($item->customer_gender == 'male')
                                        <img class="avatar-img rounded-circle" src="{{ asset('upload/male_image.jpg') }}" alt="Male Avatar">
                                        @elseif ($item->customer_gender == 'female')
                                        <img class="avatar-img rounded-circle" src="{{ asset('upload/female_image.jpg') }}" alt="Female Avatar">
                                        @elseif ($item->customer_gender == 'nonbinary')
                                        <img class="avatar-img rounded-circle" src="{{ asset('upload/nonbinary_images.png') }}" alt="Nonbinary Avatar">
                                        @elseif ($item->customer_gender == 'other')
                                        <img class="avatar-img rounded-circle" src="{{ asset('upload/other_image.jpg') }}" alt="Other Avatar">
                                        @else
                                        <img class="avatar-img rounded-circle" src="{{ asset('upload/no_image.jpg') }}" alt="Default Avatar">
                                        @endif
                                        </span>
                                        </a>
                                        <a href="#">{{ $item->customer_name }}</a>
                                    </p>
                                </td>
                                <td>{{ $item->customer_phone }}</td>
                                <td>{{ $item->customer_gender ? ucfirst($item->customer_gender) : 'N/A' }}</td>
                                <td>{{ $item->familiar_ground_name }}</td>
                                <td>{{ Str::limit($item->customer_description, 40) }}</td>
                                <td>
                                    @if($item->created_at)
                                    {{ Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A') }}
                                    @else
                                    <span class="text-danger">No Date Set</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($item->status) {
                                    case 'active':
                                    $statusClass = 'badge-pill bg-success-light text-success';
                                    $statusText = 'Active';
                                    break;
                                    case 'suspended':
                                    $statusClass = 'badge-pill bg-warning-light text-warning';
                                    $statusText = 'Suspended';
                                    break;
                                    case 'deactive':
                                    $statusClass = 'badge-pill bg-danger-light text-danger';
                                    $statusText = 'Deactive';
                                    break;
                                    default:
                                    break;
                                    }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
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
                                        <form action="{{ route('customer.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="customer_name">Customer Name</label>
                                                            <input type="text" class="form-control" id="customer_name" placeholder="Customer Name" name="customer_name" value="{{ $item->customer_name }}" required>
                                                            @error('customer_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="customer_phone">Customer Phone Number</label>
                                                            <input type="text" class="form-control" id="customer_phone" placeholder="Customer Phone Number" name="customer_phone" value="{{ $item->customer_phone }}" required>
                                                            @error('customer_phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="customer_gender">Customer Gender</label>
                                                            <select class="form-control form-small select" id="customer_gender" name="customer_gender" required>
                                                                <option value="" selected disabled>-- Select --</option>
                                                                <option value="male" @if ($items->gender == "male") selected @endif>Male</option>
                                                                <option value="female" @if ($items->gender == "female") selected @endif>Female</option>
                                                                <option value="nonbinary" @if ($items->gender == "nonbinary") selected @endif>Non-Binary</option>
                                                                <option value="other" @if ($items->gender == "other") selected @endif>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="familiar_ground_name">Customer Familiar Ground Name</label>
                                                            <select class="form-control form-small select" id="familiar_ground_name" name="familiar_ground_name" required>
                                                                <option value="" selected disabled>-- Select --</option>
                                                                @foreach($familiarGround as $items)
                                                                <option value="{{ $items->familiar_ground_name }}" {{ $item->familiar_ground_name == $items->familiar_ground_name ? 'selected' : '' }}>{{ $items->familiar_ground_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="customer_description">Customer Description</label>
                                                            <textarea class="form-control" id="customer_description" rows="1" cols="5" placeholder="Customer Description" name="customer_description" required>{{ $item->customer_description }}</textarea>
                                                            @error('customer_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mt-2 mb-3">
                                                        <div class="form-group">
                                                            <label for="status">Change Customer Status</label>
                                                            <select class="form-control form-small select" id="status" name="status" required>
                                                                <option value="" selected disabled>-- Select --</option>
                                                                <option value="active" @if ($item->status == "active") selected @endif>Active</option>
                                                                <option value="deactive" @if ($item->status == "deactive") selected @endif>Deactive</option>
                                                                <option value="suspended" @if ($item->status == "suspended") selected @endif>Suspended</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer mt-2">
                                                <div class="d-flex justify-content-between">
                                                    <button type="submit" class="btn btn-danger me-2">Update Changes</button>
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
    $('#examp').DataTable();
    });
</script>
@endsection
