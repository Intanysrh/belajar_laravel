<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Laundry</title>
    <style>
        .body {
            font-family: monospace;
            width: 80mm;
            margin: auto;
            padding: 10px;
        }

        .invoice {
            text-align: center;
        }

        .line {
            margin: 5px 0;
            border-top: 1px dashed black;
        }

        .info,
        .products,
        .summary {
            text-align: left;
        }

        .products .item {
            margin-bottom: 5px
        }

        .products .item-qty {
            display: flex;
            justify-content: space-between;
        }

        .info .row,
        .summary .row {
            display: flex;
            justify-content: space-between;
            margin: 2px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            margin-top: 10px;
        }

        @media print {
            body {
                width: 80mm;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
            <h3>Laundry Intan</h3>
            <h2>Bersih Wangi</h2>

            <div class="info text-center">
                Jl. Karet no. 1
                <br>
                0899999999999999
            </div>
        </div>
        <div class="line"></div>
        <div class="info">
            <div class="row">
                <span>{{ $details->created_at->format('dMY') }}</span>
                <span>{{ $details->created_at->format('H:i') }}</span>
            </div>
            <div class="row">
                <span>Cashier:</span>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <div class="row">
                <span>Order Id</span>
                <span>{{ $details->order_code ?? '' }}</span>
            </div>
            <div class="line"></div>
            <div class="products">
                @foreach ($details->details as $detail)
                    <div class="item">
                        <strong>{{ $detail->service->service_name }}</strong>
                        <div class="item-qty">
                            <span>{{ $detail->qty }}x @ {{ number_format($detail->service->price) }}</span>
                            <span>{{ $detail->subtotal }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="line"></div>
            <div class="summary">
                <div class="row">
                    <span>Total</span>
                    <span>Rp {{ number_format($details->total) }}</span>
                </div>
            </div>
        </div>

        <div class="line"></div>
        <footer class="text-center">Terima kasih telah menggunakan layanan kami</footer>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
