<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<header>
    <div id="nav-container">
        <div id="logo">
            <a href="{{ route('index') }}"><img src="{{ asset('img/logo.png') }}" alt="UNEED-IT Logo"></a>
        </div>
        <nav>
            <ul>
                <li><a href="{{route('webshop.index')}}">Webshop</a></li>
                <li><a href="{{route('delivery_services')}}">Bezorgdiensten</a></li>
                <li><a href="{{ route('shopping_cart') }}"><img src="{{ asset('img/shopping-cart_white.png') }}" alt="Shopping Cart"></a></li>
                <li><a href="{{ route('login_or_signup') }}"><img src="{{ asset('img/account_white.png') }}" alt="account"></a></li>
            </ul>
        </nav>
    </div>
</header>