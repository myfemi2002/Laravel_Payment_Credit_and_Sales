@extends('admin.admin_master')
@section('title', 'Add Roles Permission')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    .custom-control-label
    {
    text-transform: capitalize;
    }
</style>
<div class="row">
    <div class="col-sm-12 mx-auto">
        <div class="card">
            <div class="card-header card-buttons">
                <h5 class="card-title">Add @yield('title')</h5>
                <p class="card-text">Add Roles Permission </p>
            </div>
            <div class="card-body card-buttons">
                <div class="row">
                    <div class="col-sm">
                        <form id="myForm" class="form" method="POST" action="{{ route('roles.permission.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Role Name <span class="text-danger"> *</span></label>
                                        <select class="form-control form-small select" id="role_id" name="role_id" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            @foreach($role as $items)
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
                                <hr class="mt-4">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
                                                <label class="form-check-label" for="flexCheckDefaultAll">Permission All</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @foreach($permission_groups as $group)
                                <div class="row">
                                    <div class="col-3">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" />
                                                <label class="form-check-label" for="flexCheckChecked"> {{ $group->group_name }} </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        @php
                                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                        @endphp
                                        <div class="card-body">
                                            @foreach($permissions as $permission)
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permission[]" value="{{$permission->id}}" class="form-check-input" value="" id="customCheck1{{$permission->id}}" />
                                                    <label class="custom-control-label" for="customCheck1{{$permission->id}}">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="p-3">
                                    <div class="action-form">
                                        <div class="mb-3 mb-0 text-end">
                                            <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">Save </button>
                                        </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        // Get the "Select All" checkbox element
        const selectAllCheckbox = $('#flexCheckDefaultAll');

        // Define a function to handle the click event on the "Select All" checkbox
        function handleSelectAllClick(event) {
          // Get the current state of the "Select All" checkbox
          const isChecked = event.target.checked;

          // Set the checked property of all checkboxes to the same state as the "Select All" checkbox
          $('input[type="checkbox"]').prop('checked', isChecked);
        }

        // Attach the handleSelectAllClick function to the click event of the "Select All" checkbox
        selectAllCheckbox.click(handleSelectAllClick);
      });

</script>
@endsection
