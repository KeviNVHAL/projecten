<?php

use App\Http\Controllers\UserController; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('css/admin_panel.css') }}">
</head>

<body>
    <x-admin_nav></x-admin_nav>
    <main>
        <h2>Admins</h2>
        <table class="table1">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>Demote to User</th>
            </tr>
            <?php $admins = UserController::get_admins(); ?>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.remove', $admin->id) }}">
                        @csrf
                        <button type="submit">Demote to User</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        <h2>Users</h2>
        <table class="table1">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>Promote to Admin</th>
            </tr>
            <?php $users = UserController::get_users(); ?>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.make', $user->id) }}">
                        @csrf
                        <button type="submit">Promote to Admin</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </main>
</body>

</html>