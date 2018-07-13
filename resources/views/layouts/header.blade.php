<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-responsive">
            </div>
            <div class="col-md-6 text-right header-links">

                        <a href="{{url('/')}}">ANM Import</a>
                        <a href="{{url('/mos')}}">MOIC Ranking Import</a>
                        <a class="logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

            </div>
        </div>
    </div>
</header>