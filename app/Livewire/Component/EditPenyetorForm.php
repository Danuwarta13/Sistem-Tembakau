<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Pelanggans;
use Livewire\Attributes\Validate;

class EditPenyetorForm extends Component
{
    public $penyetorId;

    #[Validate('required|string|min:1|max:255')]
    public $nama;

    #[Validate('required|string|min:1|max:255')]
    public $daerah;

    protected $listeners = ['openEditPenyetorModal' => 'loadPenyetor'];

    // Muat data penyetor ke form edit
    public function loadPenyetor($id)
    {
        // dd($id);
        // Ambil data penyetor berdasarkan ID
        $penyetor = Pelanggans::find($id);

        // Isi properti dengan data penyetor
        $this->penyetorId = $penyetor->id;
        $this->nama = $penyetor->nama;
        $this->daerah = $penyetor->daerah;

        // Tampilkan modal edit
        $this->dispatch('showModal');
    }

    // Perbarui data penyetor
    public function update()
    {
        // Validasi input
        $validated = $this->validate();

        // Update ke database
        Pelanggans::find($this->penyetorId)->update($validated);

        // Tutup modal edit
        $this->dispatch('hideModal');

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->success('Data pelanggan berhasil diperbarui.');

        // Beri tahu komponen induk bahwa data telah diperbarui
        $this->dispatch('updated-penyetor');
    }

    // Nonaktifkan modal hapus
    public $showDeleteModal = false;

    // Confirmasi hapus penyetor
    public function confirmDelete()
    {
        // Tampilkan modal hapus
        $this->showDeleteModal = true;
    }

    // Fungsi hapus penyetor
    public function delete()
    {
        // Hapus penyetor dari database
        $penyetor = Pelanggans::find($this->penyetorId);

        if (!$penyetor) {
            $this->dispatch('error', message: 'Data penyetor tidak ditemukan.');
            return;
        }

        if ($penyetor->barangs()->exists()) {
            // Kirim event Livewire atau flash message
            // dd('ada barang');

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->error('Data pelanggan tidak dapat dihapus karena masih memiliki Keranjang terkait.');
            return;
        }

        // Jika aman → hapus
        $penyetor->delete();


        // Tutup modal hapus
        $this->showDeleteModal = false;

        // Tutup modal edit
        $this->dispatch('hideModal');

        // Atau reset all properties
        $this->reset();

        flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->success('Data pelanggan berhasil dihapus.');

        // Beri tahu komponen induk bahwa data telah diperbarui
        $this->dispatch('updated-penyetor');
    }

    public function render()
    {
        return view('livewire.component.edit-penyetor-form');
    }
}
