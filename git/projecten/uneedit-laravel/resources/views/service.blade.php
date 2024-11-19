<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
</head>

<body>
    <x-header></x-header>
    <main>
        <h1 id="our-service">ONZE <span id="service-text">SERVICE</span></h1>
        <p id="our-support">Dit zijn alle diensten die wij leveren.</p>
        <div id="services">
            <div class="Service-Align">
                <div class="Graphic-Design">
                    <img src="" alt="">
                    <h1 class="Service-Text">Graphic Design</h1>
                    <p class="Service-Pharagraph">Ons bedrijf biedt grafisch ontwerp diensten aan, zoals logo's, branding,
                        webdesign, printmaterialen en visuele content.</p>
                </div>
                <div class="Graphic-Design red-border">
                    <img src="" alt="">
                    <h1 class="Service-Text">Software Development</h1>
                    <p class="Service-Pharagraph">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit dignissimos,
                        facere consectetur, ipsam delectus voluptatibus reiciendis quas, </p>
                </div>
                <div class="Graphic-Design">
                    <img src="" alt="">
                    <h1 class="Service-Text">Product Design</h1>
                    <p class="Service-Pharagraph">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis nihil
                        provident ipsa ut optio sunt tenetur vitae excepturi consequuntur est, </p>
                </div>
            </div>
            <div class="Service-Align">
                <div class="Graphic-Design red-border">
                    <img src="" alt="">
                    <h1 class="Service-Text">Blog Writing</h1>
                    <p class="Service-Pharagraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora deleniti,
                        dolorum dolore, </p>
                </div>
                <div class="Graphic-Design">
                    <img src="" alt="">
                    <h1 class="Service-Text">Social Marketing</h1>
                    <p class="Service-Pharagraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi ab quo
                        tempore? </p>
                </div>
                <div class="Graphic-Design red-border">
                    <img src="" alt="">
                    <h1 class="Service-Text">IT Services</h1>
                    <p class="Service-Pharagraph">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti,
                        accusantium? </p>
                </div>
            </div>
        </div>
    </main>
    <x-footer></x-footer>
</body>

</html>