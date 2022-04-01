<div style="display: inline-flex; position: absolute; top:2%; right: 2%">
    <div style="margin: auto 50px auto auto;"><b>Přihlášen: </b> {{ Auth::user()->name }}&nbsp;{{ Auth::user()->surname }}</div>
    <a href="{{ url('logout') }}" class="btn btn-secondary">Odhlásit</a>
    @if (!Auth::user()->admin)
        <a style="margin-left: 5px" href="{{ url('/changePassword') }}" class="btn btn-primary">Změnit heslo</a>
    @endif
</div>
