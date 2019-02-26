<form  action="{{ route('logout') }}" method="POST" class="d-none" id="btnLogOut">
        <button type="submit" class="btn main-navbar btn-log-out">Cerrar sesion</button>
        @csrf
</form>  