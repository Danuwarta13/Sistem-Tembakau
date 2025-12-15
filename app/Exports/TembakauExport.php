<?php

namespace App\Exports;

use App\Models\Barangs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class TembakauExport implements FromView
{
    public function __construct(
        public $lap,
        public $grade,
        public $seriStart,
        public $seriEnd
    ) {}

    public function view(): View
    {
        $barang = Barangs::whereBetween('no_seri', [$this->seriStart, $this->seriEnd])
            ->where('grade', $this->grade)
            ->get();

        // Hitung total netto & jumlah
        $totalNetto = $barang->sum('netto');
        $totalJumlah = $barang->sum('jumlah');
        $Rrata = $totalJumlah / $totalNetto;

        return view('exports.tembakau', [
            'lap' => $this->lap,
            'grade' => $this->grade,
            'seriStart' => $this->seriStart,
            'seriEnd' => $this->seriEnd,
            'barang' => $barang,
            'totalNetto' => $totalNetto,
            'totalJumlah' => $totalJumlah,
            'Rrata' => $Rrata,
        ]);
    }
}
