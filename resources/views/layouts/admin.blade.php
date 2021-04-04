<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>    @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="{{ asset('admin/main.css') }}" rel="stylesheet"></head>
<link rel="stylesheet" href="{{ asset('admin/froala_editor.pkgd.min.css') }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('admin/froala_editor.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/loading.js') }}"></script>

<body>

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    
    @include('layouts.navbar')
    <div class="app-main">
    @include('layouts.left_layout')
    @yield('content')
    </div>
    </div>


    @include('admin.subjects.create')
    @include('admin.outlines.create')
    @include('admin.outlines.edit')
    @include('admin.subjects.edit')
    @include('admin.subjects.assign')
    @include('admin.subjects.views')
    @include('admin.elos.create')
    @include('admin.elos.edit')
    @include('admin.faculty.create')
    @include('admin.faculty.edit')
    @include('admin.settings.edit')
    @include('admin.outline_details.edit')
    @include('admin.users.preview')
    
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script type="text/javascript" src="{{ asset('admin/main.js') }}"></script>
<script>
    new FroalaEditor('div#froala-editor')
</script>
</body>
</html>