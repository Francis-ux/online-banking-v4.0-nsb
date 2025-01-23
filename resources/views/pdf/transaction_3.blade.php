<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaction Details</title>
        <style>
            /* General body styling */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background: #ffffff;
            }

            /* Transaction container to center on the page */
            .transaction-container {
                width: 700px;
                margin: 50px auto;
                /* Centers the container horizontally and adds vertical spacing */
                background: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
                padding: 20px;
                border: 1px solid #ddd;
            }

            /* Header alignment */
            .transaction-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
                margin-bottom: 15px;
            }

            .transaction-header img {
                height: 50px;
            }

            .transaction-header h2 {
                font-size: 20px;
                margin: 0;
                flex: 1;
                text-align: center;
            }

            /* Tables for transaction and beneficiary details */
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 10px 0;
            }

            th,
            td {
                text-align: left;
                font-size: 14px;
                padding: 8px;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f8f8f8;
                font-weight: bold;
            }

            /* Highlight classes */
            .highlight-credit {
                color: #4caf50;
                background: #e8f5e9;
                padding: 4px 8px;
                border-radius: 4px;
                display: inline-block;
            }

            .highlight-debit {
                color: #f70808;
                background: #f5ebe8;
                padding: 4px 8px;
                border-radius: 4px;
                display: inline-block;
            }

            .highlight-success {
                color: #4caf50;
                background: #e8f5e9;
                padding: 4px 8px;
                border-radius: 4px;
                display: inline-block;
            }

            .highlight-failed {
                color: #f70808;
                background: #f5ebe8;
                padding: 4px 8px;
                border-radius: 4px;
                display: inline-block;
            }

            /* Beneficiary title styling */
            .beneficiary-title {
                font-size: 16px;
                font-weight: bold;
                margin: 10px 0;
            }

            /* Footer styling */
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
        <div class="transaction-container">
            <!-- Header Section -->
            <div class="transaction-header">
                <!-- Space for the logo -->
                <img src="{{ public_path('/dashboard/resources/images/logo.png') }}" alt="Company Logo">
                <h2>Transaction Details</h2>
            </div>

            <!-- Transaction Details Table -->
            <table class="transaction-details">
                <tr>
                    <th>Transaction ID</th>
                    <td>{{ $transaction->uuid }}</td>
                </tr>
                <tr>
                    <th>Payment Amount</th>
                    <td>{{ currency($user->currency, 'code') }}{{ formatAmount($transaction->amount) }}</td>
                </tr>
                <tr>
                    <th>Transaction Type</th>
                    @if ($transaction->type == 'CREDIT')
                        <td><span class="highlight-credit">CREDIT</span></td>
                    @else
                        <td><span class="highlight-debit">DEBIT</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Reference ID</th>
                    <td>{{ $transaction->reference_id }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    @if ($transaction->status == 1)
                        <td><span class="highlight-success">SUCCESS</span></td>
                    @else
                        <td><span class="highlight-failed">FAILED</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Date/Time</th>
                    <td>{{ date('M d, Y', strtotime($transaction->date)) }},
                        {{ date('H:i:s', strtotime($transaction->time)) }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $transaction->description }}</td>
                </tr>
            </table>

            <!-- Beneficiary Details Section -->
            <div class="beneficiary-title">Beneficiary Details</div>
            <table class="beneficiary-details">
                @if (!empty($transfer))
                    <tr>
                        <th>Beneficiary Bank</th>
                        <td>{{ $transfer->bank_name }}</td>
                    </tr>
                    <tr>
                        <th>Beneficiary Name</th>
                        <td>{{ $transfer->account_name }}</td>
                    </tr>
                    <tr>
                        <th>Account Number</th>
                        <td>{{ $transfer->account_number }}</td>
                    </tr>
                @else
                    <tr>
                        <th>Beneficiary Bank</th>
                        <td>{{ config('app.name') }}</td>
                    </tr>
                    <tr>
                        <th>Beneficiary Name</th>
                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Account Number</th>
                        <td>{{ $user->account_number }}</td>
                    </tr>
                @endif
            </table>
            <div class="footer">
                <p>Support: <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                <p>Enjoy a reliable & stable network service on {{ config('app.name') }}.</p>
            </div>
        </div>
    </body>

</html>
