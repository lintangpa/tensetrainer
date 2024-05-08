<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            margin-bottom: 20px;
            color: #555;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <p>Anda menerima email ini karena kami menerima permintaan untuk mereset password akun Anda.</p>
        <p>Jika Anda tidak melakukan permintaan ini, Anda dapat mengabaikan email ini.</p>
        <p>Untuk mereset password Anda, silakan klik tombol di bawah ini:</p>
        <a class="btn" href="{{ route('validasi-forgot-password', ['token' => $token]) }}">Reset Password</a>
        <p>Jika Anda mengalami masalah saat menekan tombol di atas, salin dan tempel URL berikut ke browser Anda:</p>
        <p>{{ route('validasi-forgot-password', ['token' => $token]) }}</p>
        <p>Terima kasih,</p>
        <p>Tim Support</p>
    </div>
</body>

</html>
