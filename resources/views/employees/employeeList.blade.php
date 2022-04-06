<html lang="cs">
<head>
    @include("head")
    <title>Seznam zaměstnanců</title>
    <script src="https://kit.fontawesome.com/65a54a70ce.js" crossorigin="anonymous"></script>
</head>
<body>
@include('header')
<div class="container">
    <h1 class="h1">Seznam zaměstnanců</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Jméno <a href="{{url("/employees")}}?orderBy=name_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/employees")}}?orderBy=name_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th>Místnost <a href="{{url("/employees")}}?orderBy=roomName_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/employees")}}?orderBy=roomName_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th>Tel. <a href="{{url("/employees")}}?orderBy=phone_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/employees")}}?orderBy=phone_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th>Pozice <a href="{{url("/employees")}}?orderBy=job_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/employees")}}?orderBy=job_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td><a href="{{ url('/employeeDetail', $employee->employee_id) }}">{{ $employee->name }} {{ $employee->surname }}</a></td>
                <td>{{ $employee->roomName }}</td>
                <td>{{ $employee->roomPhone }}</td>
                <td>{{ $employee->job }}</td>
                @if(Auth::user()->admin)
                <td>
                    <form action="{{ url('deleteEmployee') }}" method="POST" onsubmit="return confirm('Opravdu chcete smazat zaměstnance?\n\n akce nemůže být vrácena');" style="display: inline-block; margin: 0">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ $employee->employee_id }}">
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                    <a href="{{ url('/editEmployee', $employee->employee_id) }}" class="btn btn-info">Edit</a>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-secondary" href="{{ url("/") }}">Zpět</a>
    @if(Auth::user()->admin)
    <a class="btn btn-primary" href="{{ url("/createEmployee") }}">Nový zaměstnanec</a>
    @endif
</div>
</body>
</html>
