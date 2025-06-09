<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            color: #333;
        }

        .header h1 {
            font-size: 26px;
            color: #012970;
        }

        .content {
            font-size: 16px;
            color: #333;
            margin: 20px 0;
        }

        .content p {
            line-height: 1.6;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #1a73e8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 30px;
        }

        .footer p {
            margin: 5px 0;
            color: #777;
            /* Explicitly set footer text color */
        }

        .footer a {
            color: #1a73e8;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Halo, {{ $user->name }}</h1>
            <p>Terima kasih telah menjadi pelanggan kami. Berikut informasi akun Anda untuk login:</p>
        </div>

        <div class="content">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Password:</strong> password</p>
            <p>Silakan klik tombol di bawah ini untuk masuk ke halaman login dan <b>segera lakukan perubahan password
                    akun anda :</b></p>

            <a href="http://127.0.0.1:8000/login" class="btn">Login Sekarang</a>
        </div>

        <div class="footer">
            <p>Salam, <br> Tim Admin Almuna Laundry</p>
        </div>
    </div>
</body>

</html>
