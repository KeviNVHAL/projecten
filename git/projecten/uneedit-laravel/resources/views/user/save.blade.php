<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
</head>

<body>
    <x-header></x-header>
    </nav>
    <main id="main-account">
        <div class="account-info">
            <h1>My Account</h1>
            <div class="info-block">
                <?php UserController::show(); ?>
            </div>
        </div>
        <div class="edit-info" style="display: none;">
            <h1>Edit Information</h1>
            <div class="changeForm">
                <form id="changeInfoForm" action="{{ route('user.save') }}" method="post" onsubmit="handleFormSubmission()">
                    @csrf
                    <?php $user = Auth::user(); ?>

                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"><br>
                    @error('name')
                    <span style="color:red;">{{ $message }}</span><br>
                    @enderror

                    <label for="phone">Phone Number:</label><br>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"><br>
                    @error('phone')
                    <span style="color:red;">{{ $message }}</span><br>
                    @enderror

                    <label for="address">Address:</label><br>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"><br>
                    @error('address')
                    <span style="color:red;">{{ $message }}</span><br>
                    @enderror

                    <label for="email">Email:</label><br>
                    <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}"><br>
                    @error('email')
                    <span style="color:red;">{{ $message }}</span><br>
                    @enderror

                    <label for="password">New Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="Leave blank if not changing"><br>
                    @error('password')
                    <span style="color:red;">{{ $message }}</span><br>
                    @enderror

                    <label for="password_confirmation">Confirm Password:</label><br>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password"><br>
                    @error('password_confirmation')
                    <span style="color:red;">{{ $message }}</span><br>
                    @enderror

                    <div class="button-group">
                        <button type="submit" style="background-color: mediumturquoise;">Save Changes</button>
                        <button type="button" onclick="cancelChanges()" id="cancelButton" style="background-color: red;">Cancel Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="buttons">
            <button id="editButton">Informatie bewerken</button>
            <?php if (Auth::user()->is_admin == true) { ?>
                <a href="{{ route('admin.index.view') }}" style="text-decoration: none; color: inherit;"><button>Admin</button></a>
            <?php } ?>
            <form action="{{ route('user.logout') }}" method="post">
                @csrf
                <button type="submit" name="logout">Log Out</button>
            </form>
        </div>
    </main>
    <x-footer></x-footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function toggleEdit() {
                var infoBlock = document.querySelector('.info-block');
                var editBlock = document.querySelector('.edit-info');
                var editButton = document.getElementById('editButton');
                var cancelButton = document.getElementById('cancelButton');

                if (infoBlock.style.display === 'none') {
                    infoBlock.style.display = 'block';
                    editBlock.style.display = 'none';
                    editButton.style.display = 'block';
                    cancelButton.style.display = 'none';
                } else {
                    infoBlock.style.display = 'none';
                    editBlock.style.display = 'block';
                    editButton.style.display = 'none';
                    cancelButton.style.display = 'block';
                    populateForm();
                }
            }

            function populateForm() {
                var user = <?php echo json_encode($user); ?>;
                document.getElementById('name').value = user.name;
                document.getElementById('phone').value = user.phone;
                document.getElementById('address').value = user.address;
                document.getElementById('email').value = user.email;
            }

            function cancelChanges() {
                var infoBlock = document.querySelector('.info-block');
                var editBlock = document.querySelector('.edit-info');
                var editButton = document.getElementById('editButton');
                var cancelButton = document.getElementById('cancelButton');

                infoBlock.style.display = 'block';
                editBlock.style.display = 'none';
                cancelButton.style.display = 'none';
                editButton.style.display = 'block';
            }

            var editButton = document.getElementById('editButton');
            editButton.addEventListener('click', function() {
                toggleEdit();
            });

            var cancelButton = document.getElementById('cancelButton');
            cancelButton.addEventListener('click', function() {
                cancelChanges();
            });
        });
    </script>
</body>

</html>