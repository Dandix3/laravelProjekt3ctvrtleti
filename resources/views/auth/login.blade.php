<html lang="cs">
<head>
    @include("head")
    <title>Přihlášení</title>
</head>
<body>
<div class="container" style="width: 300px">
    <form action="{{ url('login') }}" method="post">
        {{csrf_field()}}
        @if(isset($error))
        <div class="mb-3">
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
        </div>
        @endif
        <div class="mb-3">
            <label for="login" class="form-label">Jméno</label>
            <input type="text" class="form-control" name="login" id="login" value="">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" name="password" id="password" value="">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
</div>
</body>
</html>
