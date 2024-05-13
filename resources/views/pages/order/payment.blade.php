<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
</head>
<body>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var snapToken = '{{ $snapToken }}';
            window.snap.pay(snapToken, {
                // Optional callbacks
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    window.location.href = "{{ route('cart.index') }}";
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.location.href = "{{ route('cart.index') }}";
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                    window.location.href = "{{ route('cart.index') }}";
                }
            });
        });
    </script>
    
</body>
</html>
