<?php

namespace App\Livewire\Component;

use Carbon\Carbon;
use App\Models\Barangs;
use Livewire\Component;
use App\Models\Pelanggans;
use Livewire\Attributes\On;

class CetakNotaModalAdmin extends Component
{
    public $pelanggan_id = '';
    public $tanggal = '';
    public $tanggal_list = [];

    public $pelanggans = [];
    public $barangs = [];

    protected $listeners = [
        'open-cetak-nota-modal' => 'openModal',
        'printer-error' => 'printerError',
        'printer-success' => 'printerSuccess'
    ];

    public $open = false;



    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->reset([
            'pelanggan_id',
            'barangs',
            'tanggal',
            'tanggal_list',
        ]);

        $this->open = false;
    }

    // Event listener untuk menangani pelanggan baru dibuat dari modal
    #[On('penyetor-created')]
    public function mount()
    {
        $this->pelanggans = Pelanggans::all()->toArray();
    }

    #[On('barang-created')]
    public function refreshData()
    {
        // Jika sebelumnya sudah ada pelanggan yang dipilih, reload isi tanggal & barang
        if ($this->pelanggan_id) {
            $this->updatedPelangganId($this->pelanggan_id);
        }
    }

    // 🔥 update barang ketika dropdown berubah
    public function updatedPelangganId($value)
    {
        $this->tanggal = '';
        $this->barangs = [];

        // Ambil tanggal unik dari barang milik pelanggan
        $this->tanggal_list = Barangs::where('pelanggan_id', $value)
            ->pluck('tanggal')
            ->unique()
            ->sort()
            ->toArray();

        // Isi tanggal otomatis = hari ini 
        $today = Carbon::today()->format('Y-m-d');

        // Jika tanggal hari ini ada di list, set sebagai default/pakai itu
        if (in_array($today, $this->tanggal_list)) {
            $this->tanggal = $today;
        } else {
            // Jika tidak ada, tetap isi tanggal default hari ini tapi tidak menampilkan barang
            $this->tanggal = '';
        }

        // Setelah tanggal otomatis terisi, load barang langsung
        $this->updatedTanggal($this->tanggal);
    }

    public function updatedTanggal($value)
    {
        if ($this->pelanggan_id && $value) {
            $this->barangs = Barangs::where('pelanggan_id', $this->pelanggan_id)
                ->whereDate('tanggal', $value)
                ->get();
        }
    }

    public function cetak()
    {
        if (!$this->pelanggan_id || !$this->tanggal) {
            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->error('Pilih Penyetor terlebih dahulu');
            return;
        }

        $url = route('admin.nota.cetak', [
            'penyetor' => $this->pelanggan_id,
            'tanggal' => $this->tanggal,
        ]);

        $this->dispatch('open-new-tab', url: $url);

        $this->closeModal();
    }

    public function cetakLangsung()
    {
        if (!$this->pelanggan_id || !$this->tanggal) {
            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->error('Pilih Penyetor terlebih dahulu');
            return;
        }

        $pelanggan = Pelanggans::find($this->pelanggan_id);

        $barangs = Barangs::where('pelanggan_id', $this->pelanggan_id)
            ->whereDate('tanggal', $this->tanggal)
            ->get();

        // 🔥 hitung ulang (JANGAN ambil dari DB kalau tidak ada fieldnya)
        $biayaKuliPerItem = 8000;
        $pajakPersen = 0.5;

        $totalBarang = $barangs->count();
        $totalJumlah = $barangs->sum('jumlah');

        $totalKuli = $totalBarang * $biayaKuliPerItem;
        $totalPajak = ($totalJumlah * $pajakPersen) / 100;
        $hasil = $totalJumlah - $totalKuli - $totalPajak;

        $data = [
            'pelanggan' => [
                'nama' => $pelanggan->nama ?? '-',
                'daerah' => $pelanggan->daerah ?? '-',
            ],
            'tanggal' => now()->format('d/m/Y'),
            'items' => $barangs->map(function ($b) {
                return [
                    'grade' => $b->grade ?? '-',
                    'no_seri' => $b->no_seri ?? '-',
                    'bruto' => $b->bruto ?? 0,
                    'netto' => $b->netto ?? 0,
                    'harga' => $b->harga ?? 0,
                    'jumlah' => $b->jumlah ?? 0,
                ];
            })->values()->toArray(),

            'totalJumlah' => $totalJumlah,
            'totalPajak' => $totalPajak,
            'totalKuli' => $totalKuli,
            'hasil' => $hasil,
            'totalBarang' => $totalBarang,
        ];

        $this->dispatch('print-struk', data: $data);

        $this->closeModal();
    }

    public function printerSuccess()
    {
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 2500)
            ->success('Nota berhasil dicetak');
    }

    public function printerError()
    {
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 2500)
            ->error('Printer Belum Terhubung');
    }

    public function render()
    {
        return view('livewire.component.cetak-nota-modal-admin');
    }
}
