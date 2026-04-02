<?php

namespace App\Livewire\Component;

use App\Models\Pelanggans;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditPenyetorForm extends Component
{
    public $penyetorId;

    #[Validate('required|string|min:1|max:255')]
    public $nama;

    #[Validate('required|string|min:1|max:255')]
    public $daerah;

    //Form untuk Edit pelanggan baru
    public $editNama;
    public $editDaerah;

    protected $listeners = ['openEditPenyetorModal' => 'loadPenyetor'];

    // Muat data penyetor ke form edit
    public function loadPenyetor($id)
    {
        // dd($id);
        // Ambil data penyetor berdasarkan ID
        $penyetor = Pelanggans::find($id);

        // Isi properti dengan data penyetor
        $this->penyetorId = $penyetor->id;
        $this->editNama = $penyetor->nama;
        $this->editDaerah = $penyetor->daerah;

        // Tampilkan modal edit
        $this->dispatch('showModal');
    }

    // Perbarui data penyetor


    public function update()
    {
        try {
            // Validasi dengan ignore ID
            $validated = $this->validate([
                'editNama' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('pelanggans', 'nama')->ignore($this->penyetorId),
                ],
                'editDaerah' => 'required|string|max:255',
            ], [
                'editNama.unique' => 'Nama pelanggan sudah ada, gunakan nama lain.',
                'editNama.required' => 'Nama pelanggan wajib diisi.',
                'editDaerah.required' => 'Daerah wajib diisi.',
            ]);

            // Update data (mapping field)
            Pelanggans::find($this->penyetorId)->update([
                'nama' => $validated['editNama'],
                'daerah' => $validated['editDaerah'],
            ]);

            // Tutup modal
            $this->dispatch('hideModal');

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->success('Data pelanggan berhasil diperbarui.');

            $this->dispatch('updated-penyetor');
        } catch (ValidationException $e) {

            $errors = collect($e->validator->errors()->all())->join(', ');

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 4000)
                ->error($errors);

            throw $e; // biar tetap muncul di form
        }
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