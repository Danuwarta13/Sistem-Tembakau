<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Pelanggans;

class CreatePenyetorModal extends Component
{
    public $nama = '';
    public $daerah = '';
    public $pelanggan_id = '';    // Menyimpan ID pelanggan dari dropdown

    //Form untuk tambah pelanggan baru
    public $newPelangganNama = '';
    public $newPelangganDaerah = '';

    protected $listeners = ['open-penyetor-modal' => 'openModal'];

    public $open = false;

    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }

    public function createNewPelanggan()
    {
        // Validasi hanya properti modal pelanggan
        $validated = $this->validate([
            'newPelangganNama' => 'required|string|max:255',
            'newPelangganDaerah' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        $pelanggan = Pelanggans::create([
            'nama' => $validated['newPelangganNama'],
            'daerah' => $validated['newPelangganDaerah'],
        ]);

        // reset input modal
        $this->newPelangganNama = '';
        $this->newPelangganDaerah = '';

        // Notifikasi sukses
        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->success('Data Penyetor berhasil ditambahkan.');

        $this->dispatch('penyetor-created', pelanggan: $pelanggan);
    }


    public function render()
    {
        return view('livewire.component.create-penyetor-modal');
    }
}
