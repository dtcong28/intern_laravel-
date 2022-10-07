<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layout.navbar')
    @include('layout.siderbar')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
            @endif
            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    @include('layout.footer')
</div>
</body>
