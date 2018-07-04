<!DOCTYPE html>
<html>
<head>
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')
    </div>


</body>



<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
@yield('js')
</html>

