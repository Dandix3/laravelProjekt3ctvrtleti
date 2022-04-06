<html lang="cs">
<head>
    @include("head")
    <title>Seznam místností</title>
    <script src="https://kit.fontawesome.com/65a54a70ce.js" crossorigin="anonymous"></script>
</head>
<body>
@include('header')
<div class="container">
    <h1 class="h1">Seznam místností</h1>
    @if(isset($errors->messages()['mess']))
    <div class="alert alert-danger">
        {{ $errors->messages()['mess'][0] }} <br>
        <form action="{{ url('forceDeleteRoom') }}" method="post" onsubmit="return confirm('Force delete vymaže místnost, klíče a místnosti zaměstance\n opravdu chcete pokračovat?\n\n akce nemůže být vrácena');" style="display: inline-block; margin: 0">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $errors->messages()['id'][0] }}">
            <input type="submit" value="Force delete" class="btn btn-danger">
        </form>
    </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Název <a href="{{url("/rooms")}}?orderBy=name_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/rooms")}}?orderBy=name_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th>Číslo <a href="{{url("/rooms")}}?orderBy=no_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/rooms")}}?orderBy=no_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th>Tel. <a href="{{url("/rooms")}}?orderBy=phone_ASC"><i class="fas fa-arrow-down"></i></a> <a
                        href="{{url("/rooms")}}?orderBy=phone_DESC"><i class="fas fa-arrow-up"></i></a></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($rooms as $room)
            <tr>
                <td><a href="{{ url('/roomDetail', $room->room_id) }}">{{ $room->name }}</a></td>
                <td>{{ $room->no }}</td>
                @if($room->phone != "")
                    <td>{{ $room->phone }}</td>
                @else
                    <td>-----</td>
                @endif
                @if(Auth::user()->admin)
                    <td>
                        <form action="{{ url('deleteRoom') }}" method="post" onsubmit="return confirm('Opravdu chcete smazat místnost?\n\n akce nemůže být vrácena');" style="display: inline-block; margin: 0">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $room->room_id }}">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                        <a href="{{ url('/editRoom', $room->room_id) }}" class="btn btn-info">Edit</a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-secondary" href="{{ url("/") }}">Zpět</a>
    @if(Auth::user()->admin)
    <a class="btn btn-primary" href="{{ url("/createRoom") }}">Nová místnost</a>
    @endif
</div>
</body>
</html>
