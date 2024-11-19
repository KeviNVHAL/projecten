<?php

use App\Http\Controllers\RequestController;

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
      create_URL="{{ url('/admin/requests/create/') }}"
      update_URL="{{ url('/admin/requests/update/') }}"
      destroy_URL="{{ url('/admin/requests/destroy/') }}" />
  </main>
</body>

</html>