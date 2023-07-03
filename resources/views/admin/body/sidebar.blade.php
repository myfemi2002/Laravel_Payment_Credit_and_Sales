<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('backend/assets/img/logo.png') }}" class="img-fluid logo" alt>
            </a>
            <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('backend/assets/img/logo-small.png') }}" class="img-fluid logo-small" alt>
            </a>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
            </ul>
            @if(Auth::user()->can('familiar-ground.view'))
            <ul>
                <li>
                    <a href="{{ route('familiar-ground.view') }}"><i class="fe fe-book"></i> <span>Familiar Ground</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('event.view'))
            <ul>
                <li>
                    <a href="{{ route('event.view') }}"><i class="fe fe-send"></i> <span>Manage Event</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('total-amount.view'))
            <ul>
                <li>
                    <a href="{{ route('total-amount.view') }}"><i class="fe fe-pocket"></i> <span>Total Amount Paid</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('total-amount-paid-report.view'))
            <ul>
                <li>
                    <a href="{{ route('total-amount-paid-report.view') }}"><i class="fe fe-database"></i> <span>Amount Paid Report</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('customer.menu'))
            <ul>
                <li>
                    <a href="{{ route('customer.view') }}"><i class="fe fe-users"></i> <span>Customers</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('product.menu'))
            <ul>
                <li>
                    <a href="{{ route('product.view') }}"><i class="fe fe-package"></i> <span>Product</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('payment.menu'))
            @if(Auth::user()->can('payment.view'))
            <ul>
                <li>
                    <a href="{{ route('payment.view') }}"><i class="fe fe-credit-card"></i> <span>Payment</span></a>
                </li>
            </ul>
            @endif

            @if(Auth::user()->can('payment.edit'))
            <ul>
                <li>
                    <a href="{{ route('payment.edit') }}"><i class="fe fe-credit-card"></i> <span>Edit Customer Payment</span></a>
                </li>
            </ul>
            @endif


            @if(Auth::user()->can('paid-payment.view'))
            <ul>
                <li>
                    <a href="{{ route('paid-payment.view') }}"><i class="fe fe-file-text"></i> <span>Paid Customers</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('unpaid-payment.view'))
            <ul>
                <li>
                    <a href="{{ route('unpaid-payment.view') }}"><i class="fe fe-file-plus"></i> <span>Unpaid Customers</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('overdue-payment.view'))
            <ul>
                <li>
                    <a href="{{ route('overdue-payment.view') }}"><i class="fe fe-message-square"></i> <span>Overdue Payments</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('partially-payment.view'))
            <ul>
                <li>
                    <a href="{{ route('partially-payment.view') }}"><i class="fe fe-briefcase"></i> <span>Partially Paid Customers</span></a>
                </li>
            </ul>
            @endif
            @endif
            @if(Auth::user()->can('expenditure.view'))
            <ul>
                <li>
                    <a href="{{ route('expenditure.view') }}"><i class="fe fe-link"></i> <span>Manage Expenditure</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('groupname.view'))
            <ul>
                <li>
                    <a href="{{ route('groupname.view') }}"><i class="fe fe-clipboard"></i> <span>Group Name</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('all.admin.view'))
            <ul>
                <li>
                    <a href="{{ route('all.admin.view') }}"><i class="fe fe-user-check"></i> <span>Create Admin</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('permission.view'))
            <ul>
                <li>
                    <a href="{{route('permission.view')}}"><i class="fe fe-user-minus"></i> <span>Manage Permission</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('roles.view'))
            <ul>
                <li>
                    <a href="{{route('roles.view')}}"><i class="fe fe-user-plus"></i> <span>Manage Roles</span></a>
                </li>
            </ul>
            @endif
            @if(Auth::user()->can('roles.permission.menu'))
            <ul>
                <li class="submenu">
                    <a href="#"><i class="fe fe-user-x"></i> <span> Manage Role Permission</span> <span class="menu-arrow"></span></a>
                    <ul>
                        @if(Auth::user()->can('roles.permission.view'))
                        <li><a href="{{ route('roles.permission.view') }}">Roles Permission List</a></li>
                        @endif
                        @if(Auth::user()->can('roles.permission.add'))
                        <li><a href="{{ route('roles.permission.add') }}">Add Roles Permission</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif
            <ul>
                <li>
                    <a href="{{ route('admin.logout') }}"><i class="fe fe-power"></i> <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
