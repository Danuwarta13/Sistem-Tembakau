<?php

namespace App\Livewire\Operator;

use App\Models\Barangs;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Exports\TembakauExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanOperator extends Component
{
    #[Title('Laporan Operator')]

    public $lap;
    public $grade;
    public $seriStart;
    public $seriEnd;
    public $grades = [];

    public function mount()
    {
        // Ambil semua grade unik dari database
        $this->grades = Barangs::select('grade')
            ->distinct()
            ->orderBy('grade')
            ->pluck('grade')
            ->toArray();
    }

    public function updatedSeriStart($value)
    {
        $value = (int) $value;

        if (!$this->grade) {
            $this->seriEnd = null;
            return;
        }

        // Ambil semua nomor seri grade yang lebih besar atau sama dengan start
        $seriList = Barangs::where('grade', $this->grade)
            ->where('no_seri', '>=', $value)
            ->orderBy('no_seri')
            ->take(50) // maksimal 50 item
            ->pluck('no_seri');

        if ($seriList->isEmpty()) {
            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->error('Nomer seri tidak ditemukan!');
            $this->seriEnd = null;
            return;
        }

        // SeriEnd adalah nomor seri terakhir dari hasil query
        $this->seriEnd = $seriList->last();
    }


    public function export()
    {
        $this->validate([
            'lap'        => 'required',
            'grade'      => 'required',
            'seriStart'  => 'required|integer',
            'seriEnd'    => 'required|integer|gte:seriStart',
        ]);

        // Simpan nilai sebelum reset
        $lap        = $this->lap;
        $grade      = $this->grade;
        $seriStart  = $this->seriStart;
        $seriEnd    = $this->seriEnd;

        // Kirim file ke browser
        $response = Excel::download(
            new TembakauExport($lap, $grade, $seriStart, $seriEnd),
            "laporan-tembakau.xlsx"
        );

        // Notifikasi sukses
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->info('File Berhasil di Export.');

        // Setelah di-return, Livewire masih bisa kirim event JS
        $this->dispatch('resetFormInputs');

        return $response;
    }


    public function render()
    {
        return view('livewire.operator.laporan-operator')->layout('layouts.operator');
    }
}