<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNEED-IT</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="description" content="Your one-stop solution for all your IT needs.">
    <meta name="keywords" content="IT, repair, services, phones, laptops, PCs">
</head>

<body>
    <x-header></x-header>
    <main>
        <section id="hero">
            <h1>Welcome to UNEED-IT</h1>
        </section>
        <section id="services">
            <div class="container">
                <div class="service">
                    <h3>Phone Repair</h3>
                    <p>We specialize in repairing all types of phones, including iPhones, Android devices, and more.</p>
                </div>
                <div class="service">
                    <h3>Laptop Repair</h3>
                    <p>Our expert technicians can diagnose and fix issues with laptops of any make and model.</p>
                </div>
                <div class="service">
                    <h3>PC Repair</h3>
                    <p>From hardware upgrades to software troubleshooting, we've got you covered for all your PC repair
                        needs.</p>
                </div>
            </div>
        </section>
        <section id="iframe">
            <div class="container">
                <div id="location">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2455.469405079923!2d4.6556065!3d52.0165458!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5d125952a58cd%3A0x93f677d7fe6faaae!2sUneed-IT!5e0!3m2!1sen!2snl!4v1712919752830!5m2!1sen!2snl" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </main>
    <x-footer></x-footer>
</body>

</html>