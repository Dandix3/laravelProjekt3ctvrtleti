<html lang="cs">
<head>
    @include('head')
    <title>Fail</title>

</head>
<body>
    <div class="alert alert-danger" role="alert">{{ $message }}</div>
    <a class="btn btn-primary" href="{{ url($url) }}">Zpět na seznam</a>
</body>
</html>

