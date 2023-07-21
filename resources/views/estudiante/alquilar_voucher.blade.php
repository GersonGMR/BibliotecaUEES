<!-- resources/views/alquiler_voucher.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Alquiler Voucher</title>
    <style>
        /* Add your custom styles for the alquiler voucher here */
        body {
            font-family: Arial, sans-serif;
        }
        /* Add any additional styles as needed */
    </style>
</head>
<body>
    <h2>Comprobante</h2>
    <p>Email de usuario: {{ $userEmail }}</p>
    <p>Nombre libro: {{ $book->name }}</p>
    <p>Descripción: {{ $book->description }}</p>
    <img src="{{ $book->barcode_image }}" alt="Barcode">
    <!-- Add any other data you want to include in the alquiler voucher -->

    <!-- You can add more content and customize the layout of the alquiler voucher as needed -->

</body>
</html>