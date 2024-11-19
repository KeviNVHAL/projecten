<?php

use App\Http\Controllers\NewsController; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About UNEED-IT</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
</head>

<body>
    <x-header></x-header>
    <main>
        <h2>Recent News</h2>
        <section id="news">
            <ul>
                @foreach ($news_items as $news)
                <li>{{ $news->message }}</li>
                @endforeach
            </ul>
        </section>
    </main>
    <x-footer></x-footer>
</body>

</html>