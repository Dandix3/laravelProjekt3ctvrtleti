<html lang="cs">
<head>
    @include("head")
    <title>Upravit místnost č. {{ $room->no }}</title>
</head>
<body>
@include('header')
<div class="container" style="margin-top: 40px">
    <form action="{{ url("editRoom") }}" method="POST">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="name" class="form-label">Název</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}" required>
        </div>
        <div class="mb-3">
            <label for="no" class="form-label">Číslo</label>
            <input type="text" class="form-control" id="no" name="no" value="{{ $room->no }}" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $room->phone }}">
        </div>
        <div class="mb-3">
            <input type="hidden" id="id" name="id" value={{ $room->room_id }}>
            <input type="submit" class="btn btn-primary">

            <a class="btn btn-secondary" href="{{ url("/rooms") }}">Zpět na seznam</a>
        </div>
    </form>
</div>
</body>
</html>
