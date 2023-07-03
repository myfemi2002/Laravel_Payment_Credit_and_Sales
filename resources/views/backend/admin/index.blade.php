@extends('admin.admin_master')
@section('title', 'All Admin')
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
                <p class="card-text">Add Admin</p>
            </div>
            <div class="card-body card-buttons">
                <div class="card w-100">
                    <div class="card-body border-top">
                        <form id="myForm" class="form" method="POST" action="{{ route('all.admin.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <h4 class="mt-3 mb-3"> Admin Personal Details</h4>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Name <span class="text-danger"> *</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                        <small class="form-control-feedback">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="inputlname2" class="control-label col-form-label"> Phone Number <span class="text-danger"> *</span></label>
                                        <input type="tel" name="phone" class="form-control" placeholder="Phone No" required>
                                        <small class="form-control-feedback">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="uname" class="control-label col-form-label"> Email <span class="text-danger"> *</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                                        <small class="form-control-feedback">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Gender<span class="text-danger"> *</span></label>
                                        <select class="form-control form-small select" name="gender" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="nonbinary">Non-Binary</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <small class="form-control-feedback">
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-3 form-group">
                                        <label for="uname" class="control-label col-form-label"> Address <span class="text-danger"> *</span></label>
                                        <textarea type="text" name="address" class="form-control" rows="1" required ></textarea>
                                        <small class="form-control-feedback">
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-3 form-group">
                                        <label for="uname" class="control-label col-form-label"> Password <span class="text-danger"> *</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="Add Password" required>
                                        <small class="form-control-feedback">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Assign Role <span class="text-danger"> *</span></label>
                                        <select class="form-control form-small select" name="roles" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            @foreach($roles as $items)
                                            <option value="{{ $items->id }}">{{ $items->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback">
                                        @error('group_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="action-form">
                                    <div class="mb-3 mb-0 text-end">
                                        <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">Save </button>
                                    </div>
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
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Roles</th>
                                {{--
                                <th>Last Seen</th>
                                --}}
                                <th>Date of Creation</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $rows)
                            {{--
                            <td>
                                @if($rows->UserOnline())
                                <span class="badge badge-pill bg-success">Active Now </span>
                                @else
                                <span class="badge badge-pill bg-danger"> {{ Carbon\Carbon::parse($rows->last_seen)->diffForHumans() }} </span>
                                @endif
                            </td>
                            --}}
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td> {{ $rows->name }} </td>
                                <td> {{ $rows->phone }} </td>
                                <td> {{ $rows->email }} </td>
                                <td> {{ $rows->role }} </td>
                                {{--  --}}
                                <td>
                                    @if($rows->created_at == NULL)<span class="text-danger">No Date Set</span>
                                    @else
                                    {{ Carbon\Carbon::parse($rows->created_at)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('all.admin.edit', $rows->id) }}" class="btn btn-primary btn-rounded btn-sm text-white" title="Edit Data" > <i class="fa fa-edit"></i></a>
                                    <a href="{{ route('all.admin.delete', $rows->id) }}"  class="btn btn-danger btn-rounded btn-sm"  id="delete" title="Delete Data" > <i class="fa fa-trash"></i></a>
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
