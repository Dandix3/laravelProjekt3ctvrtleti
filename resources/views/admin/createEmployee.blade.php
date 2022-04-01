<html lang="cs">
<head>
    @include("head")
    <title>Nový zaměstnanec</title>
</head>
<body>
@include('header')
<div class="container" style="margin-top: 40px">
    <form action="{{ url("createEmployee") }}" method="POST">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="name" class="form-label">Jméno</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Příjmeni</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="job" class="form-label">Pozice</label>
            <input type="text" class="form-control" id="job" name="job" required>
        </div>
        <div class="mb-3">
            <label for="wage" class="form-label">Mzda</label>
            <input type="number" class="form-control" id="wage" name="wage" required>
        </div>
        <div class="mb-3">
            <label for="room" class="form-label">Místnost</label>
            <select class="form-control" id="room" name="room">
                @foreach($rooms as $room_id => $name)
                    <option value="{{ $room_id }}">{{ $name }}</option>
                @endforeach
                <option value="" selected>Žádná místnost</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="keys[]" class="form-label">Klíče</label>
            <select class="form-control" id="keys[]" name="keys[]" multiple="multiple" tabindex="1">
                @foreach($rooms as $room_id => $name)
                    <option value="{{ $room_id }}">{{ $name }}</option>
                @endforeach
                <option value="">-----</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Přihlašovací jméno</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="text" class="form-control" id="password" name="password" value="" required>
        </div>
        <div class="mb-3">
            <label for="admin" class="form-check-label">Admin</label>
            <input type="checkbox" class="form-check-input" id="admin" name="admin" value="1">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary">

            <a class="btn btn-secondary" href="{{ url("/employees") }}">Zpět na seznam</a>
        </div>
    </form>
</div>
</body>
</html>
