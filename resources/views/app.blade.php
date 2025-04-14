<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- AdminLTE and Bootstrap CSS -->
    <link href="{{asset('adminlte.min.css')}}" rel="stylesheet">
    <link href="{{asset('all.min.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}

    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Script (compiled JS assets) -->
    @vite('resources/js/app.js')

    <!-- Ziggy Routes for JS -->
    @routes

    <!-- Inertia Head for proper page rendering -->
    @inertiaHead

    <style>
        /* Apply Inter font globally */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="hold-transition layout-fixed layout-navbar-fixed layout-sidebar-fixed sidebar-collapse">




    <!-- Inertia will inject content here -->
    <div class="wrapper">
        @inertia
    </div>
    <script src="https://unpkg.com/swapy/dist/swapy.min.js"></script>
    <!-- jQuery (required for AdminLTE functionality) -->
    <script src="{{asset('jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE JS -->
    <script src="{{asset('adminlte.min.js')}}"></script>
</body>

</html>
