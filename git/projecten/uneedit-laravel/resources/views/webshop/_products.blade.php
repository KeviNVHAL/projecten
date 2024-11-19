@foreach ($products as $product)
    <x-product :product="$product" />
@endforeach