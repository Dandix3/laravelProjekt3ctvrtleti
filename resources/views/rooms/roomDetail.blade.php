<html lang="cs">
<head>
    @include("head")
    <title>Karta místnosti č. {{ $room->no }}</title>
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

    <h1 class="h1">Místnost číslo {{ $room->no }}</h1>

    <table class="table">
        <tr>
            <th>Název</th>
            <td>{{ $room->name }}</td>
        </tr>
        <tr>
            <th>Číslo</th>
            <td>{{ $room->no }}</td>
        </tr>
        <tr>
            <th>Tel.</th>
            @if($room->phone)
                <td>{{ $room->phone }}</td>
            @else
                <td>-----</td>
            @endif
        </tr>
        <tr>
            <th>Lidé</th><td>
                @if(count($employees) !== 0)
                    @foreach($employees as $employee)
                    <a href="{{ url("/employeeDetail", $employee->employee_id) }}">{{ $employee->name }}&nbsp;{{ $employee->surname }}</a> <br>
                    @endforeach
                @else
                    -----
                @endif
            </td>
        </tr>
        <tr>
            <th>Průměrná mzda</th>
            @if($wage)
                <td>{{ number_format($wage, 0, '.', ' ') }}Kč</td>
            @else
                <td>-----</td>
            @endif
        </tr>
        <tr>
            <th>Klíče</th><td>
                @foreach($keys as $employee)
                    <a href="{{ url("/employeeDetail", $employee->employee_id) }}">{{ $employee->name }} {{ $employee->surname }}</a> <br>
                @endforeach
            </td>
        </tr>
    </table>
    <a class="btn btn-secondary" href="{{ url("/rooms") }}">Zpět na seznam</a>
</div>
</body>
</html>
