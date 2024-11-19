<html>

<head>
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>

<body>
<x-webshop-header></x-webshop-header>
    <main>
    <h1>{{ $product->name }}</h1>
        <div id="container-1">
            <div id="container-2" class="container">
                <img src="{{ asset('img/products/' . $product->picture) }}" alt="{{ $product->name }}">
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div id="container-3" class="container">
                <div id="price-stock-wrapper">
                  <div id="price-container">
                    <span>Prijs:</span> <div id="price">{{ $product->price }}</div>
                 </div>
                  <div id="stock-container">
                    <span>Voorraad:</span> <div id="stock">{{ $product->stock }}</div>
                 </div>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Voeg toe aan winkelwagen</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
