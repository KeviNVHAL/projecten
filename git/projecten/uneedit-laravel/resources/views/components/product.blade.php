<div class="product">
    <a href="{{ url('/webshop/product/' . $product->id) }}" class="product-link">
        <img src="{{ asset('img/products/' . $product->picture) }}" alt="{{ $product->name }}">
        <div class="product-info">
            <h3>{{ $product->name }}</h3>
            <p>€{{ number_format($product->price, 2) }}</p>
        </div>
    </a>
</div>