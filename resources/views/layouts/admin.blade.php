<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
    <script src="/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="/js/tinymce.js"></script>

    <link href="/css/style.css?{{ time() }}" rel="stylesheet">
    <link href="/css/multi-select.css" rel="stylesheet">
</head>
<body>

@include('admin/navbar')
<br><br><br>
@yield('content')

</body>
</html>