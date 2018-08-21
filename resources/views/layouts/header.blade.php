<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="img-responsive">
                    </div>
                    <div class="col-md-9">
                        <div class="tagline">Governance <span>Innovation Model</span></div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 text-right header-links">

                        <a href="{{url('/')}}">ANM Performance</a>
                        <a href="{{url('/get-mos')}}">MOIC Performance</a>
                        <a href="{{url('/p-feed')}}">Patient Feedback</a>
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