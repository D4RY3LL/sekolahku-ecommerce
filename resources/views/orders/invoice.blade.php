<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }
        .invoice-title {
            font-size: 28px;
            margin: 10px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info-box {
            width: 48%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
        }
        .total-row {
            font-weight: bold;
            background: #f8f9fa;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🎒 SekolahKu</div>
        <div class="invoice-title">INVOICE</div>
        <div>Jl. Pendidikan No. 123, Jakarta | info@sekolahku.com | 0812-3456-7890</div>
    </div>

    <div class="info-row">
        <div class="info-box">
            <strong>INVOICE TO:</strong><br>
            {{ $order->user->name }}<br>
            {{ $order->user->email }}<br>
            {{ $order->user->phone }}
        </div>
        <div class="info-box">
            <strong>INVOICE DETAILS:</strong><br>
            Invoice No: {{ $order->order_number }}<br>
            Invoice Date: {{ $order->created_at->format('d M Y') }}<br>
            Payment Method: {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Subtotal</strong></td>
                <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Ongkos Kirim</strong></td>
                <td>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right;"><strong>TOTAL</strong></td>
                <td><strong>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="info-row">
        <div class="info-box">
            <strong>SHIPPING ADDRESS:</strong><br>
            {{ $order->shipping_address }}
        </div>
        <div class="info-box">
            <strong>COURIER:</strong><br>
            {{ strtoupper($order->shipping_courier) }} - {{ $order->shipping_service }}
        </div>
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di SekolahKu!</p>
        <p>Untuk pertanyaan, hubungi cs@sekolahku.com</p>
    </div>
</body>
</html>