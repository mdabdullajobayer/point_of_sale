<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        caption {
            font-weight: bold;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>

    <table>
        <caption>Total Report</caption>
        <thead>
            <tr>
                <th>Report</th>
                <th>Date</th>
                <th>Total</th>
                <th>Discout</th>
                <th>Vat</th>
                <th>Payable</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Sales Report</th>
                <th>{{ $formdate }} to {{ $todate }}</th>
                <th>{{ $total }}</th>
                <th>{{ $discount }}</th>
                <th>{{ $vat }}</th>
                <th>{{ $payable }}</th>
            </tr>
        </tbody>
    </table>

    <table>
        <caption>Summary Report</caption>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Discout</th>
                <th>Vat</th>
                <th>Payable</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                <tr>
                    <th>{{ $item->customer->name }}</th>
                    <th>{{ $item->customer->number }}</th>
                    <th>{{ $item->total }}</th>
                    <th>{{ $item->discount }}</th>
                    <th>{{ $item->vat }}</th>
                    <th>{{ $item->payable }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
