<html lang="cs">
<head>
    @include("head")
    <title>Upravit uživatele {{ str_limit($employee->name, 1, ".") }} {{ $employee->surname }}</title>
</head>
<body>
@include('header')
<div class="container" style="margin-top: 40px">
    <form action="{{ url("editEmployee") }}" method="POST">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="name" class="form-label">Jméno</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Příjmeni</label>
            <input type="text" class="form-control" id="surname" name="surname" value="{{ $employee->surname }}" required>
        </div>
        <div class="mb-3">
            <label for="job" class="form-label">Pozice</label>
            <input type="text" class="form-control" id="job" name="job" value="{{ $employee->job }}">
        </div>
        <div class="mb-3">
            <label for="wage" class="form-label">Mzda</label>
            <input type="text" class="form-control" id="wage" name="wage" value="{{ $employee->wage }}">
        </div>
        <div class="mb-3">
            <label for="room" class="form-label">Místnost</label>
            <select class="form-control" id="room" name="room">
                @foreach($rooms as $room_id => $name)
                    <option @if($employee->room == $room_id) selected @endif value="{{ $room_id }}">{{ $name }}</option>
                @endforeach
                    <option @if(!$employee->room) selected @endif value="">-----</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="keys[]" class="form-label">Klíče</label>
            <select class="form-control" id="keys[]" name="keys[]" multiple="multiple">
                @foreach($rooms as $room_id => $name)
                    <option @foreach($keys as $key) @if($key->room == $room_id) selected @endif @endforeach value="{{ $room_id }}">{{ $name }}</option>
                @endforeach
                <option value="">-----</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Přihlašovací jméno</label>
            <input type="text" class="form-control" id="login" name="login" value="{{ $employee->login}}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password" placeholder="Vyplňte pro změnu hesla">
        </div>
        <div class="mb-3">
            <label for="admin" class="form-check-label">Admin</label>
            <input type="checkbox" class="form-check-input" id="admin" name="admin" value="1" @if($employee->admin) checked @endif>
        </div>
        <div class="mb-3">
            <input type="hidden" id="id" name="id" value={{ $employee->employee_id }}>
            <input type="submit" class="btn btn-primary">

            <a class="btn btn-secondary" href="{{ url("/employees") }}">Zpět</a>
        </div>
    </form>
</div>
</body>
</html>
