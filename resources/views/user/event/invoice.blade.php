<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
    </style>
</head>
<body>
    <div>
        <h4>
            <strong>Tanding</strong>
            @if (isset($payment->status))
                <span style="float: right;">Date: {{ $payment->created_at->toDateString() }}</span>
            @else
                <span style="float: right;">Date: {{ now()->toDateString() }}</span>
            @endif
        </h4>
        <hr>

        <!-- Info Dari & Untuk -->
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top; width: 33%; padding: 10px;">
                    <strong>Dari:</strong>
                    <address>
                        Admin<br>
                        Semarang, Jawa Tengah<br>
                        Telepon: 081234567890<br>
                        Email: info@tanding.com
                    </address>
                </td>
                <td style="vertical-align: top; width: 33%; padding: 10px;">
                    <strong>Untuk:</strong>
                    <address>
                        {{ $contingent->user->name }} ({{ $contingent->contingent_name }})<br>
                        {{ $contingent->user->address }}<br>
                        Telepon: {{ $contingent->user->phone }}<br>
                        Email: {{ $contingent->user->email }}
                    </address>
                </td>
                <td style="vertical-align: top; width: 33%; text-align: center; padding: 10px;">
                    @if (isset($payment->status))
                        @if ($payment->status == 'Pending')
                            <p style="background-color: #007bff; color: white; padding: 10px; border-radius: 5px;">
                                <strong>Menunggu Konfirmasi</strong>
                            </p>
                        @elseif ($payment->status == 'Approve')
                            <p style="background-color: #28a745; color: white; padding: 10px; border-radius: 5px;">
                                <strong>Pembayaran Diterima</strong>
                            </p>
                        @elseif ($payment->status == 'Reject')
                            <p style="background-color: #dc3545; color: white; padding: 10px; border-radius: 5px;">
                                <strong>Status Pembayaran: Reject</strong>
                            </p>
                        @endif
                    @endif
                </td>
            </tr>
        </table>
        <br>

        <!-- Tabel Detail -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Atlet</th>
                    <th>Kategori Pertandingan</th>
                    <th>Kategori Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registers as $index => $register)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <ul style="margin: 0; padding: 0; list-style-type: none;">
                                @foreach ($register->athletes as $athlete)
                                    <li style="position: relative; padding-left: 15px;">
                                        <span style="position: absolute; left: 0;">-</span> {{ $athlete->athlete_name }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $register->category->category_name ?? 'N/A' }}</td>
                        <td>{{ $register->age->age_name ?? 'N/A' }}</td>
                        <td>{{ $register->gender ?? 'N/A' }}</td>
                        <td>
                            @if (isset($register->matchClass))
                                {{ $register->matchClass->class_name }} ({{ $register->matchClass->class_min }}Kg s/d {{ $register->matchClass->class_max }}Kg)
                            @else
                                -
                            @endif
                        </td>
                        <td>Rp {{ number_format($register->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <table class="table" style="width: 100%; margin-top: 20px;">
            <tr>
                <th style="text-align: right; padding: 8px;">Subtotal:</th>
                <td style="text-align: right; padding: 8px;">Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th style="text-align: right; padding: 8px;">Kode Unik:</th>
                <td style="text-align: right; padding: 8px;">Rp {{ number_format($uniqueCode, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th style="text-align: right; padding: 8px;">Total:</th>
                <td style="text-align: right; padding: 8px;"><strong>Rp {{ number_format($totalPayment, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <h4>Metode Pembayaran:</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Atas Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentmethods as $paymentmethod)
                <tr>
                    <td>{{ $paymentmethod->bank_name }}</td>
                    <td>{{ $paymentmethod->account_number }}</td>
                    <td>{{ $paymentmethod->account_holder }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
