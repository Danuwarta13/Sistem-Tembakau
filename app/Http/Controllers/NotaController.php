<?php

namespace App\Http\Controllers;

use App\Models\Barangs;
use App\Models\Pelanggans;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaController extends Controller
{
    public function cetak($pelangganId, $tanggal)
    {
        $pelanggan = Pelanggans::findOrFail($pelangganId);

        // Ambil barang berdasarkan pelanggan
        $barangs = Barangs::where('pelanggan_id', $pelangganId)
            ->whereDate('tanggal', $tanggal)
            ->get();

        $totalBarang = $barangs->count();
        $totalJumlah = $barangs->sum('jumlah');

        $biayaKuliPerItem = 8000;
        $pajak = 0.5;
        $totalKuli = $totalBarang * $biayaKuliPerItem;
        $totalPajak = ($totalJumlah * $pajak) / 100;
        $hasil = $totalJumlah - $totalKuli - $totalPajak;


        $pdf = Pdf::loadView('pdf.nota', compact('pelanggan', 'barangs', 'totalKuli', 'totalPajak', 'totalBarang', 'totalJumlah', 'hasil'));
        return $pdf->stream('nota.pdf');
    }
}
