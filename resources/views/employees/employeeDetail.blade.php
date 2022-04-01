<html lang="cs">
<head>
    @include("head")
    <title>Karta uživatele {{ str_limit($employee->name, 1, ".") }} {{ $employee->surname }}</title>
    <style>
        th {
            text-align: right;
        }

        .table td {
            padding-left: 50px;
        }

        .table {
            width: 30%;
        }
    </style>
</head>
<body>
@include('header')
<div class="container">

    <h1 class="h1">{{ str_limit($employee->name, 1, ".") }} {{ $employee->surname }}</h1>

    <table class="table">
        <tr>
            <th>Jméno</th>
            <td>{{ $employee->name }}</td>
        </tr>
        <tr>
            <th>Příjmení</th>
            <td>{{ $employee->surname }}</td>
        </tr>
        <tr>
            <th>Pozice</th>
            <td>{{ $employee->job }}</td>
        </tr>
        <tr>
            <th>Mzda</th>
            <td>{{ number_format($employee->wage, 0, '.', ' ') }}Kč</td>
        </tr>
        <tr>
            <th>Místnost</th>
            @if($room)
                <td><a href="{{ url("/roomDetail", $room->room_id) }}">{{ $room->name }}</a></td>
            @else
                <td>-----</td>
            @endif
        </tr>
        <tr>
            <th>Klíče</th><td>
                @foreach($keys as $room)
                    <a href="{{ url("/roomDetail", $room->room_id) }}">{{ $room->name }}</a> <br>
                @endforeach
            </td>
        </tr>
    </table>
    <a class="btn btn-secondary" href="{{ url("/employees") }}">Zpět na seznam</a>
    @if(Auth::user()->admin)
        <a href="{{ url('/editEmployee', $employee->employee_id) }}" class="btn btn-info">Edit</a>
    @endif
</div>
</body>
</html>
