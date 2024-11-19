<html>

<head>
    <title>bedankje</title>
    <link rel="stylesheet" href="{{ asset('css/THNX.css') }}">
</head>

<body>
    <main>
        <h1>Bedankt voor uw aankoop, u ontvangt zo spoedig mogelijk een mail over uw order.</h1>
        <form action="{{route('webshop.index')}}">
            <button class="shadow__btn">ga verder</button>
        </form>
    </main>

</body>
</html>
