<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- 后台管理模板css -->
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">

    <!-- css -->
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/mind.css')}}">

    <!-- 后台管理模板js -->
    <script type="text/javascript" src="{{asset('resources/views/admin/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/style/js/ch-ui.admin.js')}}"></script>

    <!-- 弹窗库 -->
    <script type="text/javascript" src="{{asset('resources/org/layer/layer.js')}}"></script>
</head>
<body>
@yield('content')
</body>
</html>