<?php

namespace App\Livewire\Component;

use Carbon\Carbon;
use App\Models\Barangs;
use Livewire\Component;
use App\Models\Pelanggans;
use Livewire\Attributes\On;

class CetakNotaModalOperator extends Component
{
    public $pelanggan_id = '';
    public $tanggal = '';
    public $tanggal_list = [];

    public $pelanggans = [];
    public $barangs = [];

    protected $listeners = ['open-cetak-nota-modal' => 'openModal'];

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
        $this->pelanggans = Pelanggans::all();
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
        $today  = Carbon::today()->format('Y-m-d');

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

        $url = route('operator.nota.cetak', [
            'penyetor' => $this->pelanggan_id,
            'tanggal'      => $this->tanggal,
        ]);

        $this->dispatch('open-new-tab', url: $url);

        $this->closeModal();
    }

    public function cetakLangsung()
    {
        // dd('diklik');
        if (!$this->pelanggan_id || !$this->tanggal) {
            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->error('Pilih Penyetor terlebih dahulu');
            return;
        }

        $url = route('operator.nota.cetak', [
            'penyetor' => $this->pelanggan_id,
            'tanggal'      => $this->tanggal,
        ]);

        $this->dispatch('print-pdf', url: $url);

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 6000)
            ->success('Nota berhasil dicetak');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.component.cetak-nota-modal-operator');
    }
}