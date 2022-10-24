<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @php
        if(str_contains($_SERVER['REQUEST_URI'],'management/team')  ){
            session()->put('module_active','team');
        }else {
            session()->put('module_active','employee');
        }
    @endphp
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
            @if (session()->has('warning'))
                <div class="alert alert-warning text-center">
                    {{ session()->get('warning') }}
                </div>
            @endif
            @if (session()->has('fail'))
                <div class="alert alert-danger text-center">
                    {{ session()->get('fail') }}
                </div>
            @endif
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <footer class="main-footer ">
        <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
    @include('layout.footer')
</div>
</body>

