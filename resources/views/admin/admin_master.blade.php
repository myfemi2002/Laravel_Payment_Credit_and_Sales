<!DOCTYPE html>
<html lang="en">
    <!-- Mon, 12 Jun 2023 09:18:39 GMT -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title') :: kz beverages</title>
        <link rel="shortcut icon" href="{{ asset('backend/assets/img/favicon.pn') }}g">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/toaster/toastr.css') }}">
    <body>
        <div class="main-wrapper">
            @include('admin.body.header')
            @include('admin.body.sidebar')
            <div class="page-wrapper">
                <div class="content container-fluid">
                    @yield('admin')

                @include('admin.body.footer')
                </div>
            </div>
        </div>
        <script src="{{ asset('backend/assets/js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/select2/js/custom-select.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
        <script src="{{ asset('backend/assets/plugins/apexchart/chart-data.js') }}"></script>
        <script src="{{ asset('backend/assets/js/script.js') }}"></script>
        <!--validation JavaScript -->
        <script src="{{ asset('backend/assets/validation/validate.min.js')}}"></script>
        <!--handlebars JavaScript -->
        <script src="{{ asset('backend/assets/handlebars/handlebars.js')}}"></script>
        <!--notify cdnjs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- sweetalert2 --}}
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('backend/assets/sweetalert-code/code.js') }}"></script>
        {{-- toaster --}}
        <script  type="text/javascript" src="{{ asset('backend/assets/toaster/toastr.min.js') }}"></script>
        <script>
            @if (Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
            @endif
        </script>

        <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script>
            $(document).ready(function() {
            $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            } );
            } );

            // $(document).ready(function () {
            //     $('#example').DataTable();
            // });
        </script>
    </body>
    <!-- Mon, 12 Jun 2023 09:19:31 GMT -->
</html>
