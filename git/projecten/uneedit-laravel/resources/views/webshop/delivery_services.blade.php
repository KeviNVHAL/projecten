<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>delivery service</title>
  <link rel="stylesheet" href="{{ asset('css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('css/delivery_services.css') }}">
</head>

<body>
  <x-webshop-header></x-webshop-header>
  <main>

    <div class="container">
      <div id="delivery_box-container">
        <h1>Bezorgdiensten voor Order #{{ $orderId = session('orderId'); }}</h1>
        <div class="delivery_box">
          <h1 class="text_delivery">Bezorgdiensten</h1>
          <p class="text_delivery">Kies een bezorgdienst:</p>

          <form action="{{ route('delivery.services.update') }}" method="POST">
            @csrf
            <input type="hidden" name="delivery_service" id="delivery_service" value="">
            <ul>
              <li><button type="button" class="delivery_service" onclick="selectService('UPS')">UPS</button></li>
              <li><button type="button" class="delivery_service" onclick="selectService('DHL')">DHL</button></li>
              <li><button type="button" class="delivery_service" onclick="selectService('Homerr')">Homerr</button></li>
            </ul>

            <div class="input-container">
              <label for="delivery_date" class="input text_delivery">Bezorgdag:</label>
              <input type="date" id="delivery_date" class="input text_delivery" name="delivery_date">

              <label for="delivery_time" class="input text_delivery">Levertijd:</label>
              <input type="time" id="delivery_time" class="input text_delivery" name="delivery_time">
            </div>
            <button type="submit">Bevestigen</button>
          </form>

          <div id="result" class="text_delivery"></div>
        </div>
        <script>
          function selectService(deliveryService) {
            document.getElementById('delivery_service').value = deliveryService;
            const selectedDate = document.getElementById('delivery_date').value;
            const selectedTime = document.getElementById('delivery_time').value;

            // Check if both date and time are selected
            if (!selectedDate) {
              document.getElementById('result').innerText = 'Kies een bezorgdag.';
              return;
            }
            if (!selectedTime) {
              document.getElementById('result').innerText = 'Kies een levertijd.';
              return;
            }

            // Get today's date without time
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset to midnight to compare only dates

            // Parse the selected date and check if it's in the past
            const deliveryDate = new Date(selectedDate);
            if (deliveryDate < today) {
              document.getElementById('result').innerText = 'Je kunt geen bezorging selecteren voor een eerdere datum dan vandaag.';
              return;
            }

            // Parse the selected date to get the day of the week
            const selectedDay = deliveryDate.getDay(); // 0 = Sunday, 6 = Saturday

            // Check if the selected day is a weekday (1 = Monday to 5 = Friday)
            if (selectedDay === 0 || selectedDay === 6) {
              document.getElementById('result').innerText = 'Bezorgdienst is niet beschikbaar in het weekend. Kies een doordeweekse dag.';
              return;
            }

            // Parse selected time into hours and minutes
            const [selectedHour, selectedMinute] = selectedTime.split(':').map(Number);

            // Define delivery time window
            const startHour = 10;
            const endHour = 17;
            const endMinute = 30;

            // Check if selected time is within delivery hours
            const isWithinDeliveryTime = (
              (selectedHour > startHour || (selectedHour === startHour && selectedMinute >= 0)) &&
              (selectedHour < endHour || (selectedHour === endHour && selectedMinute <= endMinute))
            );

            // Display appropriate message based on selected day and time
            if (isWithinDeliveryTime) {
              document.getElementById('result').innerText = `
              Je hebt ${deliveryService} gekozen voor bezorging op ${selectedDate} om ${selectedTime}.`;
            } else {
              document.getElementById('result').innerText = 'De geselecteerde tijd is niet beschikbaar. Kies een tijd tussen 10:00 en 17:30.';
            }
          }
        </script>
      </div>
    </div>
  </main>
  <x-footer></x-footer>
</body>

</html>