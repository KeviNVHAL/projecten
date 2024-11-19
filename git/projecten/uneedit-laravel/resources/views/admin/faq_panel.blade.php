<?php

use App\Http\Controllers\FaqController; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_panel.css') }}">
    <title>FAQ Panel</title>
</head>

<body>
    <x-admin_nav></x-admin_nav>

    <main>



        <x-form-table
            id="form-1"
            :tableData="$table_data"
            create_URL="{{ url('/admin/faq_panel/create/') }}"
            update_URL="{{ url('/admin/faq_panel/update/') }}"
            destroy_URL="{{ url('/admin/faq_panel/destroy/') }}" />
</body>

</html>