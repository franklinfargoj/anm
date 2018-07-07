<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-responsive">
            </div>
            <div class="col-md-6 text-right">


                        <a style="color: red" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

            </div>
        </div>
    </div>
</header>