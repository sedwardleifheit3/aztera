
<header id="navbar">
    <div id="navbar-container" class="boxed">
        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Nifty Logo" class="brand-icon">
                <?php /*
                <div class="brand-title">
                    <span class="brand-text">Enartis</span>
                </div>
                */ ?>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->

        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <div class="nav-center-header">
                <h4> WIN-IQ:OX </h4>
                
            </div>
            <ul class="nav navbar-top-links pull-right">
                <li class="dropdown">
                    <a href="/"> <i class="psi-home"></i> </a>
                </li>
                @if (Auth::check())
                    @ifUserIs('admin')
                        <li class="dropdown">
                            <a href="{{ route('configurations') }}"class="dropdown-toggle text-right" aria-expanded="false">
                                <i class="psi-gear"></i> 
                            </a>
                        </li>
                    @endif

                    <li id="dropdown-user" class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                    <span class="ic-user pull-right">
                                        <i class="psi-administrator"></i>
                                    </span>
                            <div class="username hidden-xs">{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</div>
                        </a>


                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">
                            <ul class="head-list">
                                <li>
                                    <a href="{{ route('profile.edit', ['id' => Auth::user()->id]) }}">
                                        <i class="psi-administrator icon-fw icon-lg"></i> Profile
                                    </a>
                                </li>
                            </ul>

                            <div class="pad-all text-right">
                                <a href="{{ route('logout') }}" class="btn btn-primary"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="pli-unlock icon-fw"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="{{ route('login') }}">
                        Login
                        </a>
                    </li> 
                @endif

        

            </ul>
        </div>


    </div>
</header>

