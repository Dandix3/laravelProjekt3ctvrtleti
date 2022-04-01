<html lang="cs">
<head>
    @include("head")
    <title>Database</title>
</head>
<body>
@include('header')
<div class="container">
    <h1>Prohlížeč databáze</h1>
    <table class="table">
        <tbody>
        <tr>
            <td><a class="btn btn-primary" href="{{ url("/employees") }}">Seznam zaměstnanců</a></td>
        </tr>
        <tr>
            <td><a class="btn btn-primary" href="{{ url("/rooms") }}">Seznam místností</a></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
