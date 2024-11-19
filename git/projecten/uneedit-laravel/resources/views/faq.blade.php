<?php use App\Http\Controllers\FaqController; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const questions = document.querySelectorAll(".question");

            questions.forEach(question => {
                question.addEventListener("click", function() {
                    const answer = this.nextElementSibling;
                    if (answer.style.display === "block") {
                        answer.style.display = "none";
                    } else {
                        answer.style.display = "block";
                    }
                });
            });
        });
    </script>
</head>

<body>
    <x-header></x-header>
    <main>
        <section id="faq">
            
            <?php $faqItems = FaqController::show(); ?>
            <ul>
                @foreach ($faqItems as $faq)
                <li>
                    <span class="question">{{ $faq->message }}</span>
                    <div class="answer" style="display: none;">{{ $faq->answer }}</div>
                </li>
                @endforeach
            </ul>
        </section>
    </main>
    <x-footer></x-footer>
</body>

</html>