<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PayPal Sandbox Example</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Ac5uidI7YJlAm5oa9gjN6WYUqw7XGdurKvb34tdwUnVxSkGlCWee6fnOAT5S5e-8dc-m4iTlfduv-5aa&currency=EUR"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
</head>

<body>
    <main>
        <div id="paypal-container" style="width: 50vw; margin: 30vh auto;">
            <h1>PayPal Sandbox (test) Payment</h1>
            <div id="paypal-button-container"></div>
            <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: "{{ number_format($order['total_price'], 2, '.', '') }}"
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            var xhr = new XMLHttpRequest();
                            xhr.open("DELETE", "{{route('cart.forget');}}", true);
                            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                            xhr.onload = function() {
                                if (xhr.status >= 200 && xhr.status < 300) {
                                    window.location.href = "{{route('THNX')}}";
                                }
                            };

                            xhr.send();
                        });
                    }
                }).render('#paypal-button-container');
            </script>
        </div>
    </main>
</body>

</html>