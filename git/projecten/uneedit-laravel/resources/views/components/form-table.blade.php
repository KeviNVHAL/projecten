<meta name="csrf-token" content="{{ csrf_token() }}">

@once
<script src="{{ asset('js/form_table.js') }}"></script>
@endonce

<?php
$form_id = $attributes->get('id');
$create_URL = $attributes->get('create_URL');
$update_URL = $attributes->get('update_URL');
$destroy_URL = $attributes->get('destroy_URL');
?>

<form id="{{ $form_id }}" method="POST">
    @csrf
    <button form-id="{{ $form_id }}" type="submit" class="create-button" url="{{ $create_URL }}">Create</button>

    <table class="table1">
        <thead>
            <tr>
                @if(!empty($table_data))
                @foreach(array_keys($table_data[0]) as $header)
                <th>{{ $header }}</th>
                @endforeach
                <th>Edit</th>
                <th>Delete</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($table_data as $row)
            <tr>
                @foreach($row as $value)
                <td>{{ $value }}</td>
                @endforeach
                <td><button class="edit-button" form-id="{{ $form_id }}" type="button" url="{{ $update_URL }}">Edit</button></td>
                <td><button class="delete-button" form-id="{{ $form_id }}" type="button" url="{{ $destroy_URL }}">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>