    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('index') }}" class="logo">
                            <img src="{{ asset($logoPath) }}" alt="Site Logo" style="max-width: 150px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="/?section=men">Men's</a></li>
                            <li class="scroll-to-section"><a href="/?section=women">Women's</a></li>
                            <li class="scroll-to-section"><a href="/?section=kids">Kid's</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('products') }}">Products</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </li>
                            @if (Auth::check() && !session('is_admin'))
                                <li><a href="{{ route('pages.profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                                <li>
                                    <a href="{{ route('cart.index') }}">
                                        <i class="fa fa-shopping-cart"></i> Cart
                                        @if (session('cart_count', 0) > 0)
                                            <span id="cart-badge" class="badge">{{ session('cart_count') }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="login-button">Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <li><a href="{{ route('login.user') }}" class="login-button">Login</a></li>
                            @endif

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
