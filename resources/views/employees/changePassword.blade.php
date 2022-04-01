<html lang="cs">
<head>
    @include("head")
    <title>Změna hesla</title>
</head>
<body>
@include('header')
<div class="container" style="width: 300px; margin-top: 50px">
    <form action="{{ url('changePassword') }}" method="POST">
        {{csrf_field()}}
        @if(isset($error))
            <div class="mb-3">
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            </div>
        @endif
        <div class="mb-3">
            <label for="newPassword" class="form-label">Nové heslo</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" placeholder="Zopakujte heslo" required>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Změnit">
        </div>
    </form>
    <a class="btn btn-secondary" href="{{ url('/') }}">Zpět</a>
</div>
</body>
</html>
