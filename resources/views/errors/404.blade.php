<html lang="cs">
<head>
    @include("head")
    <title>404: NOT FOUND</title>
</head>
<body class="container">
    <h1>404: Not Found</h1>
    <h3>{{ $exception->getMessage() }}.</h3>
    <a class="btn btn-primary" href="{{ url('/') }}">Zpět</a>
</body>
</html>
