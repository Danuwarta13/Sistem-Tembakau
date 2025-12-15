<table style="width: 100%; border-collapse: collapse; font-size: 12px;">

    <!-- JUDUL -->
    <tr>
        <td colspan="9" style="font-size:16px; font-weight:bold; text-align:center; padding:8px 0;">
            LAPORAN PEMBELIAN TEMBAKAU WELERI 2025 (WD)
        </td>
    </tr>

    <tr>
        <td colspan="8" style="height: 10px;"></td>
    </tr>

    <!-- INFORMASI ATAS -->
    <tr>
        <td>LAP :</td>
        <td style="text-align:center;">{{ $lap }}</td>
        <td></td>

        <td>GRADE :</td>
        <td style="text-align: center">{{ $grade }}</td>
        <td></td>
        <td></td>
        <td>NETTO :</td>
        <td style="text-align: right">{{ ribuan($totalNetto) }}</td>
    </tr>

    <tr>
        <td>SERI :</td>
        <td style="text-align:center;">WD</td>
        <td></td>

        <td>NO :</td>
        <td>{{ $seriStart }} s/d {{ $seriEnd }} ({{ $barang->count() }} krj)</td>
        <td></td>
        <td></td>
        <td>JUMLAH :</td>
        <td style="text-align:right">{{ rupiah($totalJumlah) }}</td>
    </tr>

    <tr>
        <td colspan="8" style="height: 10px;"></td>
    </tr>

    <!-- TABEL HEADER -->
    <tr style="font-weight:bold; background:#f0f0f0; text-align:center; padding: 5px;">
        <td style="border:1px solid #000; text-align: center">NO</td>
        <td style="border:1px solid #000; text-align: center">TANGGAL</td>
        <td style="border:1px solid #000; text-align: center">NAMA</td>
        <td style="border:1px solid #000; text-align: center">DAERAH</td>
        <td style="border:1px solid #000; text-align: center">NO SERI</td>
        <td style="border:1px solid #000; text-align: center">BRUTO</td>
        <td style="border:1px solid #000; text-align: center">NETTO</td>
        <td style="border:1px solid #000; text-align: center">HARGA</td>
        <td style="border:1px solid #000; text-align: center">JUMLAH</td>
    </tr>

    <!-- DATA LOOPING -->
    @foreach ($barang as $key => $b)
    <tr>
        <td style="border:1px solid #000; text-align:center;">{{ $b->no_seri }}</td>
        <td style="border:1px solid #000; text-align:center;">{{ $b->tanggal }}</td>
        <td style="border:1px solid #000;">{{ $b->nama }}</td>
        <td style="border:1px solid #000;">{{ $b->daerah }}</td>
        <td style="border:1px solid #000; text-align:center;">{{ $b->no_seri }}</td>
        <td style="border:1px solid #000; text-align:right;">{{ to_koma($b->bruto) }}</td>
        <td style="border:1px solid #000; text-align:right;">{{ to_koma($b->netto) }}</td>
        <td style="border:1px solid #000; text-align:right;">{{ rupiah($b->harga) }}</td>
        <td style="border:1px solid #000; text-align:right;">{{ rupiah($b->jumlah) }}</td>
    </tr>
    @endforeach
    <!-- BARIS TOTAL -->
    <tr style="font-weight:bold; background:#e8e8e8;">
        <td colspan="4" style="border:1px solid #000; text-align:right;">JUMLAH :</td>

        <td style="border:1px solid #000; text-align:center;">
            {{ $barang->count() }}
        </td>
        <td style="border:1px solid #000; text-align:right;">

        </td>

        <td style="border:1px solid #000; text-align:right;">
            {{ ribuan($totalNetto) }}
        </td>

        <td style="border:1px solid #000; text-align:right;"></td>

        <td style="border:1px solid #000; text-align:right;">
            {{ rupiah($totalJumlah) }}
        </td>
    </tr>

    {{-- Baris Rata Rata --}}
    <tr style="font-weight: bold; background: #e8e8e8;">
        <td colspan="8" style="text-align: right; border:1px solid #000;">Rata - rata/Kg :</td>
        <td style="border:1px solid #000; text-align:right;">
            {{ rupiah($Rrata) }}
        </td>
    </tr>

</table>
