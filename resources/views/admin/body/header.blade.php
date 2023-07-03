@php
$id = Auth::user()->id;
$adminData = App\Models\User::find($id);
@endphp
<div class="header header-one">
    <a href="javascript:void(0);" id="toggle_btn">
    <span class="toggle-bars">
    <span class="bar-icons"></span>
    <span class="bar-icons"></span>
    <span class="bar-icons"></span>
    <span class="bar-icons"></span>
    </span>
    </a>
    <a class="mobile_btn" id="mobile_btn">
    <i class="fas fa-bars"></i>
    </a>
    <ul class="nav nav-tabs user-menu">
        <li class="nav-item  has-arrow dropdown-heads ">
            <a href="javascript:void(0);" class="win-maximize">
            <i class="fe fe-maximize"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
            <span class="user-img">
            <img src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}" alt="img" class="profilesidebar">
            <span class="animate-circle"></span>
            </span>
            <span class="user-content">
            <span class="user-details">{{ $adminData->role }}</span>
            <span class="user-name">{{ $adminData->name }}</span>
            </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilemenu">
                    <div class="subscription-menu">
                        <ul>
                            <li>
                                <a class="dropdown-item" href="#">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="subscription-logout">
                        <ul>
                            <li class="pb-0">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
