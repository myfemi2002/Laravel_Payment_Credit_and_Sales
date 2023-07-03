<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png">
        <!-- loader-->
        <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet">
        <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
        <!-- Bootstrap CSS -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        {{--
        <link href="../../../css2.css?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        --}}
        <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
        <title>Error 404 </title>
    </head>
    <body>
        <!-- wrapper -->
        <div class="wrapper">
            <div class="error-404 d-flex align-items-center justify-content-center">
                <div class="container">
                    <div class="card py-5">
                        <div class="row g-0">
                            <div class="col col-xl-5">
                                <div class="card-body p-4">
                                    <h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span class="text-success">4</span></h1>
                                    <h2 class="font-weight-bold display-4">Lost in Space</h2>
                                    <p>You have reached the edge of the universe.
                                        <br>The page you requested could not be found.
                                        <br>Dont'worry and return to the previous page.
                                    </p>
                                    <div class="mt-5">
                                        <a href="javascript:history.back()" class="btn btn-primary btn-lg px-md-5 radius-30">Go Home</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7">
                                <img src="{{ asset('backend/assets/images/errors-images/shutterstock_1338315902.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
            <div class="bg-white p-3 fixed-bottom border-top shadow">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="mb-0">
                        © <?php
                            $copyYear = 2019; // Set your website start date
                            $curYear = date('Y'); // Keeps the second year updated
                            echo $copyYear . (($copyYear != $curYear) ? ' - ' . $curYear : '');
                            ?>
                        Designed and Developed by <a class="text-primary" href="https://www.newinfo.com.ng/" target="_blank">Newinfo Global Solutions Ltd</a>.
                    </p>
                    <p><span  style="float:right" >This page took {{ round(microtime(true) - LARAVEL_START, 3) }} seconds to render</span></p>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
        <!-- Bootstrap JS -->
        <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
