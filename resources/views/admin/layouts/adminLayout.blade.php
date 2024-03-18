<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset("") }}admin/assets/css/components.css">
  
  <link rel="shortcut icon" href="{{ asset("") }}admin/assets/img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>
@yield('css')

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @include('admin.layouts.partials.navbar')

      @include('admin.layouts.partials.sidebar')
      <!-- Main Content -->
      @yield('admin')
      @include('admin.layouts.partials.footer')
    </div>
  </div>

  @include('admin.layouts.partials.scripts')
</body>

</html>