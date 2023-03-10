<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    @include('dashboard.components.head')
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>@yield('title')</title>
</head>

<body class="app sidebar-mini @if(App::getLocale() == "ar") rtl @else ltr @endif light-mode">

<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{ asset('assets/admin/images/loader.svg') }}" class="loader-img" alt="Loader">
</div>

<!-- GLOBAL-LOADER -->

<div class="page">
    <div class="page-main">
        @include('dashboard.components.navbar')

        @include('dashboard.components.sidebar')

        <div class="main-content app-content mt-0">
            <div class="side-app">
                <div class="main-container container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.components.country-selector')

    @include('dashboard.components.footer')

</div>

@include('dashboard.components.footer-script')
<script type="text/javascript">

    $.extend(true, $.fn.dataTable.defaults, {
        bFilter: !1,
        bInfo: !1,
        bLengthChange: !1,
        oLanguage: {
            oPaginate: {
                sFirst: "First",
                sLast: "Last",
                sNext: "{{__('main.next')}}",
                sPrevious: "{{__('main.previous')}}",
            },
            sInfo: "{{__('main.sInfo')}}",
            sEmptyTable: "{{__('main.sEmptyTable')}}",
            sLengthMenu: "{{__('main.sLengthMenu')}}",
            sSearch: "{{__('main.search')}}",
            sZeroRecords: "{{__('main.sZeroRecords')}}",
        },
    });

</script>
</body>

</html>
