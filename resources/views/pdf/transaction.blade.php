<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaction Receipt</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }

            .receipt-container {
                width: 500px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 5px;
            }

            .header {
                background-color: #e30613;
                color: #fff;
                text-align: center;
                padding: 10px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }

            .header h1 {
                margin: 0;
                font-size: 18px;
            }

            .header img {
                height: 20px;
                vertical-align: middle;
                margin-left: 5px;
            }

            .content {
                padding: 20px;
                font-size: 14px;
                color: #333;
            }

            .content h2 {
                font-size: 16px;
                margin: 0 0 10px 0;
                color: #333;
                border-bottom: 1px solid #ccc;
                padding-bottom: 5px;
            }

            .content p {
                margin: 5px 0;
            }

            .content p span {
                font-weight: bold;
            }

            .footer {
                text-align: center;
                font-size: 12px;
                color: #777;
                border-top: 1px solid #ccc;
                padding-top: 10px;
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <div class="receipt-container">
            <div class="header">
                <h1>Transaction Receipt <img src="{{ public_path('/dashboard/resources/images/logo1.png') }}"
                        alt="logo">
                </h1>
            </div>
            <div class="content">
                <h2>Transaction Details:-</h2>
                <p><span>Date:</span>{{ date('D M d Y', strtotime($transaction->date)) }}</p>
                <p><span>Time:</span>{{ date('H:i:s', strtotime($transaction->time)) }}</p>
                <p><span>Reference:</span> {{ $transaction->reference_id }}</p>
                <p><span>Amount:</span> {{ formatAmount($transaction->amount) }} {{ currency($user->currency, 'code') }}
                </p>
                <p><span>Status:</span> {{ $transaction->status == 1 ? 'SUCCESSFUL' : 'FAILED' }}</p>
                <p><span>Type:</span> {{ $transaction->type }}</p>
                <h2>Accounts Details:-</h2>
                @if (!empty($transfer))
                    @if ($transfer->type == 'Electronic Transfer')
                        <p><span>Sender Name:</span> {{ $user->first_name . ' ' . $user->last_name }}</p>
                        <p><span>Sender Account Number:</span>{{ getMaskedAccountNumber($user->account_number) }}
                        </p>
                        <p><span>Beneficiary:</span> {{ $transfer->beneficiary }}</p>
                        <p><span>Wallet:</span> {{ $transfer->withdrawal_method }}</p>
                        <p><span>Narration:</span> {{ $transaction->description }}</p>
                    @else
                        <p><span>Sender Name:</span> {{ $user->first_name . ' ' . $user->last_name }}</p>
                        <p><span>Sender Account Number:</span>{{ getMaskedAccountNumber($user->account_number) }}
                        </p>
                        <p><span>Receiver Name:</span> {{ $transfer->account_name }}</p>
                        <p><span>Receiver Account Number:</span> {{ $transfer->account_number }}</p>
                        <p><span>Narration:</span> {{ $transaction->description }}</p>
                    @endif
                @else
                    <p><span>Receiver Name:</span> {{ $user->first_name . ' ' . $user->last_name }}</p>
                    <p><span>Receiver Account Number:</span> {{ $user->account_number }}</p>
                    <p><span>Narration:</span> {{ $transaction->description }}</p>
                @endif
            </div>
        </div>
    </body>

</html>
