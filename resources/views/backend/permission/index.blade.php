@extends('admin.admin_master')
@section('title', 'Permission')
@section('admin')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<div class="page-header">
    <div class="content-page-header">
        <h5>@yield('title')</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-buttons">
                <button type="button" class="btn btn-rounded btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#centermodal"  style="float: right;"><i class="fa fa-plus-circle"></i> Add Permission</button>
                <h4 class="card-title"> @yield('title')</h4>
                <p class="card-text">
                    All Permission
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="examp" class="cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission Name</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->group_name  }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit Data</button>
                                    <button class="btn btn-sm btn-danger" title="Delete Data" id="delete_data" href="{{ route('permission.delete', $item->id) }}">Delete</button>
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
                                        <form action="{{ route('permission.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="form-label">Permission Name</label>
                                                    <input type="text" class="form-control" placeholder="Permission Name" name="name" value="{{ $item->name }}">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Group Name</label>
                                                    <select class="form-control form-small select" name="group_name" required>
                                                        <option value="" selected disabled>-- Select --</option>
                                                        @foreach($groupName as $group)
                                                        <option value="{{ $group->name }}" {{ $group->name === $item->group_name ? 'selected' : '' }}>{{ $group->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('group_name')
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
    $('#examp').DataTable();
    });
</script>
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add @yield('title')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card w-100">
                    <div class="card-body border-top">
                        <form id="myForm" class="form" method="POST" action="{{ route('permission.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Permission Name <span class="text-danger"> *</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Permission Name" required>
                                        <small class="form-control-feedback">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Group Name <span class="text-danger"> *</span></label>
                                        <select class="form-control form-small select" name="group_name" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            @foreach($groupName as $items)
                                            <option value="{{ $items->name }}">{{ $items->name }}</option>
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
                                    <div class=" text-center">
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
@endsection
