<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;

?>

<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/admin_panel.css') }}">
</head>

<body>
    <x-admin_nav></x-admin_nav>
    <main>
        <x-form-table
            id="form-1"
            :tableData="$table_data"
            create_URL="{{ url('/admin/products/create/') }}"
            update_URL="{{ url('/admin/products/update/') }}"
            destroy_URL="{{ url('/admin/products/destroy/') }}" />
    </main>
</body>

</html>