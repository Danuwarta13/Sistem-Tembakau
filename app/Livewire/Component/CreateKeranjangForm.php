<?php

namespace App\Livewire\Component;

use App\Models\Barangs;
use Livewire\Component;
use App\Models\Pelanggans;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class CreateKeranjangForm extends Component
{
    // Validation rules 
    #[Validate('required|date')]
    public $tanggal = '';

    #[Validate('required|string|max:255')]
    public $nama = '';

    #[Validate('required|string|max:255')]
    public $daerah = '';

    public $no_seri = '';

    #[Validate('required|string|min:1')]
    public $grade = '';

    #[Validate('required|numeric')]
    public $bruto = '';

    #[Validate('required|numeric')]
    public $netto = '';

    #[Validate('required')]
    public $harga = '';

    #[Validate('required')]
    public $jumlah = '';

    // Event listener untuk menangani pelanggan baru dibuat dari modal
    #[On('penyetor-created')]

    // Isi otomatis field berdasarkan data pelanggan baru
    public function fillPelanggan($pelanggan)
    {
        // Ambil no seri terbaru untuk form Barang
        $this->pelanggan_id = $pelanggan['id'];
        $this->nama = $pelanggan['nama'];
        $this->daerah = $pelanggan['daerah'];
    }

    public $pelanggan_id = '';    // Menyimpan ID pelanggan dari dropdown
    public $pelanggans = [];      // Untuk menampung semua data pelanggan

    // Mount untuk menyiapkan data awal
    public function mount()
    {
        // Ambil semua data pelanggan dari tabel pelanggans
        $this->pelanggans = Pelanggans::all();
        // Set tanggal default ke hari ini (format Y-m-d untuk input type="date")
        $this->tanggal = now()->format('Y-m-d');
    }

    // Update nama, daerah, no_seri saat pelanggan diubah
    public function updatedPelangganId($id)
    {
        // Jika ada ID dipilih dari dropdown
        if ($id) {
            // Ambil data pelanggan berdasarkan ID
            $pelanggan = Pelanggans::find($id);

            // Jika data ditemukan, isi otomatis field nama & daerah
            if ($pelanggan) {
                $this->nama = $pelanggan->nama;
                $this->daerah = $pelanggan->daerah;
            }
        }
    }

    public function updatedGrade()
    {
        // Ubaah grade ke huruf kapital
        $this->grade = strtoupper($this->grade);

        // Ambil no seri terakhir berdasarkan grade
        $last = Barangs::where('grade', $this->grade)->max('no_seri');

        // Jika belum ada data, mulai dari 1
        $this->no_seri = $last ? $last + 1 : 1;
    }

    // Update netto saat bruto diubah
    public function updatedBruto()
    {
        // cek jika bruto valid (tidak null dan angka)
        if ($this->bruto !== null && is_numeric($this->bruto)) {

            // Aturan perhitungan netto otomatis
            if ($this->bruto > 50) {
                $this->netto = $this->bruto - 3;
            } else {
                $this->netto = $this->bruto - 2;
            }

            // Hitung ulang jumlah jika diperlukan 
            $this->hitungJumlah();
        } else {
            // Jika bruto dikosongkan , netto juga dikosongkan
            $this->netto = '';
        }
    }

    // Update jumlah saat harga atau netto diubah
    public function updatedNetto()
    {
        // Hitung ulang jumlah
        $this->hitungJumlah();
    }

    // Private function agar bisa dipanggil dari beberapa tempat
    // Hitung jumlah berdasarkan harga & netto
    private function hitungJumlah()
    {
        // Hilangkan titik agar bisa dihitung
        $harga = str_replace('.', '', $this->harga);
        $netto = $this->netto;

        // Jika keduanya adalah angka
        if (is_numeric($harga) && is_numeric($netto)) {
            // Hitung jumlah Harga X Netto 
            $jumlah = $harga * $netto;
            // Format hasil ke ribuan
            $this->jumlah = number_format($jumlah, 0, ',', '.');
        } else {
            // Jika keduannya bukan angka, kosongkan jumlah
            $this->jumlah = '';
        }
    }

    public function updatedHarga($value)
    {
        //Hilangkan titik lama, ubah ke angka murni
        $numericValue = str_replace('.', '', $value);

        // Pastikan angka valid
        if (is_numeric($numericValue)) {
            $this->harga = number_format($numericValue, 0, ',', '.');
        } else {
            $this->harga = '';
        }

        $this->hitungJumlah();
    }

    public function createNewBarang()
    {
        // Ubah ke angka murni sebelum validasi/simpan
        $harga = str_replace('.', '', $this->harga);
        $jumlah = str_replace('.', '', $this->jumlah);
        if (!is_numeric($jumlah)) {
            $this->addError('jumlah', 'Jumlah tidak valid.');
            return;
        }

        // validasi data
        $validated = $this->validate();

        // Tambahkan no ke data yang divalidasi
        $validated['no_seri'] = $this->no_seri;
        $validated['pelanggan_id'] = $this->pelanggan_id;   // simpan ID pelanggan ke database
        $validated['harga'] = $harga;
        $validated['jumlah'] = $jumlah;

        // Simpan data ke database
        Barangs::create($validated);

        $this->reset();
        $this->mount(); // Panggil mount lagi untuk set tanggal hari ini dan load pelanggan

        // Notifikasi sukses
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->success('Keranjang berhasil ditambahkan.');

        // Mengirimkan event / sinyal ke komponen lain bahwa barang baru telah dibuat
        $this->dispatch('barang-created');
    }

    public function render()
    {
        return view('livewire.component.create-keranjang-form');
    }
}
