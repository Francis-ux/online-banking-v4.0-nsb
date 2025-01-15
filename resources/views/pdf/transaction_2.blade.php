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
                width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }

            .header {
                text-align: center;
                border-bottom: 1px solid #eee;
                padding-bottom: 20px;
                margin-bottom: 20px;
            }

            .header img {
                height: 40px;
            }

            .header h1 {
                margin: 10px 0;
                font-size: 24px;
                color: #333;
            }

            .amount {
                font-size: 28px;
                color: #00b300;
                margin: 10px 0;
            }

            .status {
                font-size: 18px;
                color: #333;
            }

            .date {
                font-size: 14px;
                color: #777;
            }

            .content {
                font-size: 14px;
                color: #333;
            }

            .content p {
                margin: 10px 0;
            }

            .content p span {
                font-weight: bold;
            }

            .footer {
                text-align: center;
                font-size: 12px;
                color: #777;
                border-top: 1px solid #eee;
                padding-top: 20px;
                margin-top: 20px;
            }

            .footer a {
                color: #00b300;
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <div class="receipt-container">
            <div class="header">
                <img src="{{ public_path('/dashboard/resources/images/logo.png') }}" alt="logo">
                <h1>Transaction Receipt</h1>
                <div class="amount" {{ $transaction->type == 'DEBIT' ? 'style=color:red' : '' }}>{{ currency($user->currency,'code') }}{{ formatAmount($transaction->amount) }}</div>
                <div class="status">{{ $transaction->status == 1 ? 'SUCCESS' : 'FAILED' }}</div>
                <div class="date">{{ date('M d, Y', strtotime($transaction->date)) }},
                    {{ date('H:i:s', strtotime($transaction->time)) }}</div>
            </div>
            <div class="content">
                <p><span>Transaction Type:</span> {{ $transaction->type }}</p>
                @if (!empty($transfer))
                    @if ($transfer->type == 'Electronic Transfer')
                        <p><span>Beneficiary:</span>{{ $transfer->beneficiary }}<br>{{ $transfer->withdrawal_method }}
                        </p>
                        <p><span>Sender Details:</span>
                            {{ $user->first_name . ' ' . $user->last_name }}<br>{{ config('app.name') }} |
                            {{ getMaskedAccountNumber($user->account_number) }}</p>
                    @else
                        <p><span>Recipient Details:</span>{{ $transfer->account_name }}<br>{{ $transfer->bank_name }}
                            |
                            {{ $transfer->account_number }}</p>
                        <p><span>Sender Details:</span>
                            {{ $user->first_name . ' ' . $user->last_name }}<br>{{ config('app.name') }} |
                            {{ getMaskedAccountNumber($user->account_number) }}</p>
                    @endif
                @else
                    <p><span>Recipient
                            Details:</span>{{ $user->first_name . ' ' . $user->last_name }}<br>{{ config('app.name') }}
                        |
                        {{ $user->account_number }}</p>
                @endif
                <p><span>Remark:</span> {{ $transaction->description }}</p>
                <p><span>Transaction Reference:</span> {{ $transaction->reference_id }}</p>
                <p><span>SessionID:</span> {{ $transaction->uuid }}</p>
            </div>
            <div class="footer">
                <p>Support: <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                <p>Enjoy a reliable & stable network service on {{ config('app.name') }}.</p>
            </div>
        </div>
    </body>

</html>
