<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNEED-IT - Webshop</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/webshop.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/webshop.js') }}"></script>
    <meta name="description" content="Your one-stop solution for all your IT needs.">
    <meta name="keywords" content="IT, repair, services, phones, laptops, PCs">
</head>

<body>
    <x-webshop-header></x-webshop-header>
    <main>
        
    <div class="center-container">
        <h1 class="webshop">Webshop</h1>
        
        <div id="product-grid" class="product-grid">
            @include('webshop._products', ['products' => $products])
        </div>
        
        <div class="load-more-container">
            @if($hasMore)
                <button id="previous" data-page="1" style="display:none;">
                    <img src="{{ asset('img/previous.png') }}" alt="Previous">
                </button>
                <button id="load-more" data-page="2">
                    <img src="{{ asset('img/next.png') }}" alt="Load More">
                </button>
            @endif
        </div>
    </div>

    </main>
    <x-footer></x-footer>  
</body>
</html>
