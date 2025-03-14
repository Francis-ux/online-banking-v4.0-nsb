<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }

            .email-container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #ffffff;
                border: 1px solid #dddddd;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .header {
                background-color: #003366;
                color: #ffffff;
                padding: 20px;
                text-align: center;
            }

            .header img {
                max-width: 300px;
                margin-bottom: 10px;
            }

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            .content {
                padding: 20px;
            }

            .content h2 {
                color: #003366;
                font-size: 20px;
                margin-bottom: 10px;
            }

            .content p {
                color: #333333;
                line-height: 1.6;
                margin-bottom: 10px;
            }

            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #003366;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 10px;
            }

            .footer {
                background-color: #f5f5f5;
                color: #333333;
                padding: 10px;
                text-align: center;
                font-size: 0.9em;
                border-top: 1px solid #dddddd;
            }

            .footer a {
                color: #003366;
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <div class="header">
                <img src="{{ asset('dashboard/resources/images/logo.png') }}" alt="{{ config('app.name') }} Logo">
            </div>
            <div class="content">
                <h1>Welcome to {{ config('app.name') }}</h1>
                <h2> You have successfully opened an account with {{ config('app.name') }}</h2>
                <h3>Below is your account details thanks for banking with us</h3>
                <p> Account name: {{ $user->first_name }} {{ $user->last_name }} </p>
                <p>Account number: {{ $user->account_number }}</p>
                <p> Account type: {{ Str::ucfirst($user->account_type) }}({{ explode('-', $user->currency)[0] }})</p>

            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </body>

</html>
