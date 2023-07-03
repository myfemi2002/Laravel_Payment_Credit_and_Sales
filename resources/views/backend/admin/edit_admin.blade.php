@extends('admin.admin_master')
@section('title', 'Edit Admin')
@section('admin')
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
                        <form id="myForm" class="form" method="POST" action="{{ route('all.admin.update',$editData->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <h4 class="mt-3 mb-3"> Admin Personal Details</h4>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Name <span class="text-danger"> *</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $editData->name }}" placeholder="Full Name" required>
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
                                        <input type="tel" name="phone" class="form-control" value="{{ $editData->phone }}"  placeholder="Phone No" required>
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
                                        <input type="email" name="email" class="form-control" value="{{ $editData->email }}"  placeholder="Email" required>
                                        <small class="form-control-feedback">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Gender<span class="text-danger"> *</span></label>
                                        <select class="form-control form-small select" name="gender" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            <option value="male" {{ ($editData->gender == "male" ? "selected": "") }}>Male</option>
                                            <option value="female" {{ ($editData->gender == "female" ? "selected": "") }}>Female</option>
                                            <option value="nonbinary" {{ ($editData->gender == "nonbinary" ? "selected": "") }}>Non-Binary</option>
                                            <option value="other" {{ ($editData->gender == "other" ? "selected": "") }}>Other</option>
                                        </select>
                                        <small class="form-control-feedback">
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="uname" class="control-label col-form-label"> Address <span class="text-danger"> *</span></label>
                                        <textarea type="text" name="address" class="form-control" rows="1" required >{{ $editData->address }}</textarea>
                                        <small class="form-control-feedback">
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="mb-3 form-group">
                                        <label for="inputfname" class="control-label col-form-label"> Assign Role <span class="text-danger"> *</span></label>
                                        <select class="form-control form-small select" name="roles" required>
                                            <option value="" selected="" disabled="">-- Select --</option>
                                            @foreach($roles as $items)
                                            <option value="{{ $items->id }}" {{ $editData->hasRole($items->name) ? 'selected' : '' }} >{{ $items->name }}</option>
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
                                        <button type="submit" class="btn btn-danger rounded-pill px-4 waves-effect waves-light">Update </button>
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
