<html lang="cs">
<head>
    @include('head')
    <title>Success</title>
</head>
<body class="container">
    <div class="alert alert-success" role="alert">{{ $message }}</div>
    <a class="btn btn-primary" href="{{ url($url) }}">Zpět na seznam</a>
</body>
</html>
