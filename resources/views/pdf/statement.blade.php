<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Withdrawal Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #ffffff;
                color: #333333;
            }
            .container {
                width: 100%;
            }
            .header {
                text-align: center;
                padding: 10px 0;
                border-bottom: 2px solid #333;
            }
            .header h1 {
                margin: 0;
            }
            .details {
                margin: 20px 0;
            }
            .details p {
                margin: 5px 0;
            }
            .withdrawal-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            .withdrawal-table th, .withdrawal-table td {
                border: 1px solid #333;
                padding: 10px;
                text-align: left;
            }
            .withdrawal-table th {
                background-color: #f2f2f2;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Seller Withdrawal Report</h1>
                <p>Date: <span id="report-date">{{ now()->format('F j, Y') }}</span></p>
            </div>

            <div class="details">
                <p><strong>Seller Name:</strong> {{ $sellerName }}</p>
                <p><strong>Seller ID:</strong> {{ $sellerId }}</p>
            </div>

            <table class="withdrawal-table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal['date'] }}</td>
                        <td>{{ $withdrawal['amount'] }}</td>
                        <td>{{ $withdrawal['method'] }}</td>
                        <td>{{ $withdrawal['status'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="footer">
                <p>Thank you for using our service!</p>
            </div>
        </div>
    </body>
</html>
