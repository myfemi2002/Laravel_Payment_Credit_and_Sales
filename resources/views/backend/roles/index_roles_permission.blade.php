@extends('admin.admin_master')
@section('title', 'Roles Permission')
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
                <a href="{{ route('roles.permission.add') }}" class="btn btn-rounded btn-primary" style="float: right;"><i class="fa fa-plus-circle"></i> Add Roles Permission</a>
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
                                <th>Role Name</th>
                                <th>Privileges</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td  style="text-transform: capitalize;">
                                    @foreach($item->permissions as $perm)
                                    @if($loop->index % 5 == 0 && $loop->index > 0)
                                    <br>
                                    @endif
                                    <span class="badge bg-primary rounded-pill  mb-2 mr-2" style="font-size: 14px; padding: 8px 12px;">{{ $perm->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('roles.permission.edit', $item->id) }}" class="btn btn-primary btn-rounded btn-sm text-white" title="Edit Data" > <i class="fa fa-edit"></i> Edit Data</a>
                                    <a href="{{ route('roles.permission.delete', $item->id) }}"  class="btn btn-danger btn-rounded btn-sm" title="Delete Data"  id="delete"  > <i class="fa fa-trash"></i> Delete</a>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#examp').DataTable();
    });
</script>
@endsection
