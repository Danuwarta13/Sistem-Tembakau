<?php

namespace App\Livewire\Component;

use Carbon\Carbon;
use App\Models\Barangs;
use Livewire\Component;
use App\Models\Pelanggans;
use Livewire\Attributes\Validate;

class EditKeranjangForm extends Component
{
    public $barangId;

    #[Validate('required|date')]
    public $tanggal = '';

    #[Validate('required|string|max:255')]
    public $nama = '';

    #[Validate('required|string|max:255')]
    public $daerah = '';

    #[Validate('required')]
    public $no_seri = '';

    #[Validate('required|string|min:1|regex:/^[A-Za-z]+$/')]
    public $grade = '';

    #[Validate('required|numeric')]
    public $bruto = '';

    #[Validate('required|numeric')]
    public $netto = '';

    #[Validate('required')]
    public $harga = '';

    #[Validate('required')]
    public $jumlah = '';

    #[Validate('required')]
    public $pelanggan_id = '';

    public $pelanggans = [];

    public $showModal = false;

    protected $listeners = ['openEditModal' => 'loadBarang'];



    // Muat data barang ke form edit
    public function loadBarang($id)
    {
        // dd($id);
        // Ambil semua data pelanggan dari tabel pelanggans
        $this->pelanggans = Pelanggans::all();

        // Muat data barang berdasarkan ID
        $barang = Barangs::find($id);

        $this->barangId = $id;
        $this->tanggal = $barang->tanggal ? Carbon::parse($barang->tanggal)->format('Y-m-d') : null;
        $this->nama = $barang->nama;
        $this->daerah = $barang->daerah;
        $this->no_seri = $barang->no_seri;
        $this->grade = $barang->grade;
        $this->bruto = $barang->bruto;
        $this->netto = $barang->netto;
        $this->harga = number_format($barang->harga, 0, ',', '.');
        $this->jumlah = number_format($barang->jumlah, 0, ',', '.');

        $this->pelanggan_id = $barang->pelanggan_id;

        // Tampilkan modal edit
        $this->dispatch('showModal');
    }

    // Update nama dan daerah saat pelanggan diubah
    public function updatedPelangganId($value)
    {
        // Cari data pelanggan berdasarkan ID
        $pel = Pelanggans::find($value);

        // jika ditemukan, update nama dan daerah
        if ($pel) {
            $this->nama = $pel->nama;
            $this->daerah = $pel->daerah;
        }
    }

    public function updatedGrade()
    {
        // Ubah huruf grade ke kapital
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
            $this->updated('netto');
        } else {
            // Jika bruto dikosongkan , netto juga dikosongkan
            $this->netto = '';
        }
    }

    // Update jumlah saat harga atau netto diubah
    public function updated($field)
    {
        // in_array untuk cek apakah field yang diupdate adalah harga atau netto
        if (in_array($field, ['harga', 'netto'])) {
            // Harga → angka murni
            $harga = is_numeric(str_replace('.', '', $this->harga)) ? floatval(str_replace('.', '', $this->harga)) : 0;
            // Netto bisa desimal
            $netto = is_numeric($this->netto) ? floatval($this->netto) : 0;

            // Hitung jumlah
            $total = $harga * $netto;

            // Format jumlah tetap ribuan
            $this->jumlah = number_format($total, 0, ',', '.');

            // Jika yang diupdate adalah harga, format kembali dengan titik
            if ($field === 'harga') {
                $this->harga = number_format($harga, 0, ',', '.');
            }
        }
    }

    public function update()
    {
        // Konversi input ke format angka sebelum simpan
        $bruto = floatval(str_replace(',', '.', $this->bruto));
        $netto = floatval(str_replace(',', '.', $this->netto));
        $harga = floatval(str_replace('.', '', $this->harga));
        $jumlah = floatval(str_replace('.', '', $this->jumlah));

        // Masukkan kembali ke variabel sebelum validasi
        $this->bruto = $bruto;
        $this->netto = $netto;
        $this->harga = $harga;
        $this->jumlah = $jumlah;

        // Validasi
        $validated = $this->validate();

        // Update ke database
        Barangs::find($this->barangId)->update($validated);

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->success('Data Keranjang berhasil diperbarui.');

        // Tutup modal edit
        $this->dispatch('hideModal');

        // Kirim notifikasi ke komponen induk
        $this->dispatch('barang-updated');
    }

    public $showDeleteModal = false;

    public function confirmDelete()
    {
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Barangs::find($this->barangId)->delete();

        // Tutup modal delete
        $this->showDeleteModal = false;

        // Tutup modal edit juga (jika ada)
        $this->dispatch('hideModal');

        // Atau reset all properties
        $this->reset();

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->success('Keranjang berhasil dihapus.');

        // Notify parent component
        $this->dispatch('barang-deleted');
    }

    public function render()
    {
        return view('livewire.component.edit-keranjang-form');
    }
}