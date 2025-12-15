<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            padding: 10px;
            width: 280px;
            /* ukuran nota kecil */
            margin: auto;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .info {
            margin-bottom: 10px;
            line-height: 1.2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th {
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
            text-align: left;
        }

        td {
            padding: 4px 0;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .total-row td {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 6px;
        }

        .total-jmlh {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 3px;
        }



        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
            border-top: 1px dashed #000;
            padding-top: 6px;
        }

    </style>
</head>
<body>

    <!-- Header Nota -->
    <div class="header">
        <h2>NOTA PEMBAYARAN</h2>
        <small>CV. Contoh Usaha Anda</small><br>
        <small>Jl. Contoh Alamat No. xx</small>

        <!-- Tanggal otomatis -->
        <strong>Tanggal:</strong> {{ now()->format('d/m/Y') }}
    </div>

    <!-- Informasi Pelanggan -->
    <div class="info">
        <strong>Nama:</strong> {{ $pelanggan->nama }} <br>
        <strong>Daerah:</strong> {{ $pelanggan->daerah }}
    </div>

    <!-- Tabel Barang -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Grade</th>
                <th>No Seri</th>
                <th class="right">Bruto</th>
                <th class="right">Netto</th>
                <th class="right">Harga</th>
                <th class="right">Jumlah</th>
            </tr>
        </thead>

        <tbody>
            @foreach($barangs as $index => $b)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="center">{{ $b->grade }}</td>
                <td class="center">{{ $b->no_seri }}</td>
                <td class="center">{{ to_koma($b->bruto) }}</td>
                <td class="center">{{ to_koma($b->netto) }}</td>
                <td class="right">{{ rupiah($b->harga) }}</td>
                <td class="right">{{ rupiah($b->jumlah) }}</td>
            </tr>
            @endforeach

            <!-- Total Jumlah -->
            <tr class="total-jmlh">
                <td colspan="6" class="right">Total Jumlah</td>
                <td class="right">{{ rupiah($totalJumlah) }}</td>
            </tr>

            <tr>
                <td colspan="6" class="right">Total Pajak ({{ rupiah($totalJumlah) }} × 0.5%)</td>
                <td class="right">{{ rupiah($totalPajak) }}</td>
            </tr>

            <tr>
                <td colspan="6" class="right">Total Biaya Kuli ({{ $totalBarang }} barang × Rp 8.000)</td>
                <td class="right">{{ rupiah($totalKuli) }}</td>
            </tr>



            <!-- Total Kuli -->
            <tr class="total-row">
                <td colspan="6"></td>
                <td class="right">{{ rupiah($hasil) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Terima kasih sudah menggunakan jasa kami! <br>
        *** Barang yang sudah dibeli tidak dapat dikembalikan ***
    </div>

</body>
</html>
