<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATL</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-5 col-md-4 col-xl-2">
            <nav class="navbar bg-light">

                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{route('car_list')}}">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Upcoming Event</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Reminder</a>
                    </li>
                </ul>

            </nav>

        </div>
        <div class="col-sm-7 col-md-8 col-xl-10">
            @yield('page')
        </div>
    </div>
</div>

</body>
</html>
