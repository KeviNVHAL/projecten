<?php

use App\Http\Controllers\NewsController; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/admin_panel.css') }}">
  <title>News Panel</title>
</head>

<body>
  <x-admin_nav></x-admin_nav>

  <main>
    <x-form-table
      id="form-1"
      :tableData="$table_data"
      create_URL="{{ url('/admin/news/create/') }}"
      update_URL="{{ url('/admin/news/update/') }}"
      destroy_URL="{{ url('/admin/news/destroy/') }}" />
  </main>
</body>

</html>