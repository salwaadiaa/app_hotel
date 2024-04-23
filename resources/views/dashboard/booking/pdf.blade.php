<!DOCTYPE html>
<html>
<head>
    <title>Booking Report</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            overflow: hidden;
            word-wrap: break-word;
            max-width: 200px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
<body>
    <h1>Booking Report</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>No Handphone</th>
                <th>Hotel</th>
                <th>Harga</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Guests</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarga = 0;
            @endphp
            @foreach($bookingsSelesai as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->user->phone }}</td>
                    <td>{{ $booking->hotel->nama }}</td>
                    <td>Rp. {{ number_format($booking->hotel->harga, 0, ',', '.') }}</td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                    <td>{{ $booking->guests }}</td>
                </tr>
                @php
                    $totalHarga += $booking->hotel->harga;
                @endphp
            @endforeach
            <tr>
                <td colspan="4" class="text-end font-weight-bold">Total Harga:</td>
                <td colspan="4" class="text-start font-weight-bold">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
