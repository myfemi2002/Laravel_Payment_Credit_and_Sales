@extends('admin.admin_master')
@section('title', 'Admin User Profile')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">@yield('title')</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
                </ol>
            </nav>
        </div>
    </div>

<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                            <div class="mt-3">
                                <h4>{{ $adminData->name }}</h4>
                                <p class="text-muted font-size-sm">{{ $adminData->role }}</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    Username:
                                </h6>
                                <span class="text-secondary">{{ $adminData->username }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    Phone:
                                </h6>
                                <span class="text-secondary">{{ $adminData->phone }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    Email:
                                </h6>
                                <span class="text-secondary">{{ $adminData->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    Address:
                                </h6>
                                <span class="text-secondary">{{ $adminData->address }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    Facebook:
                                </h6>
                                <span class="text-secondary">{{ $adminData->facebook }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    Twitter:
                                </h6>
                                <span class="text-secondary">{{ $adminData->twitter }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <i>
                                    <h6 class="mb-0">
                                        Join Date:
                                    </h6>
                                </i>
                                <i><span class="text-secondary">{{ $adminData->created_at }}</span></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" class="form-control" value="{{ $adminData->username }}" disabled />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name <span class="text-danger"> *</span></h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="name" class="form-control" value="{{ $adminData->name }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email <span class="text-danger"> *</span> </h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="email" name="email" class="form-control" value="{{ $adminData->email }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone <span class="text-danger"> *</span></h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="tel" name="phone" class="form-control" value="{{ $adminData->phone }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Social Media</h6>
                                </div>
                                <div class="col-sm-4 text-secondary">
                                    <input type="text" name="facebook" class="form-control" placeholder="https://facebook.com/" value="{{ $adminData->facebook }}" />
                                </div>
                                <div class="col-sm-4 text-secondary">
                                    <input type="text" name="twitter" class="form-control" placeholder="https://twitter.com/" value="{{ $adminData->twitter }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <textarea type="text" name="address" rows="2" class="form-control" >{{ $adminData->address }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Photo</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="file" name="photo" class="form-control"  id="image"   />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"> </h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <img id="showImage" src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="submit"  class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    	$('#image').change(function(e){
    		var reader = new FileReader();
    		reader.onload = function(e){
    			$('#showImage').attr('src',e.target.result);
    		}
    		reader.readAsDataURL(e.target.files['0']);
    	});
    });
</script>
@endsection
