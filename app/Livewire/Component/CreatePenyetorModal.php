<?php

namespace App\Livewire\Component;

use App\Models\Pelanggans;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

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
        try {
            $validated = $this->validate(
                [
                    'newPelangganNama' => 'required|string|max:255|unique:pelanggans,nama',
                    'newPelangganDaerah' => 'required|string|max:255',
                ],
                [
                    'newPelangganNama.required' => 'Nama pelanggan wajib diisi',
                    'newPelangganNama.string' => 'Nama pelanggan harus berupa teks.',
                    'newPelangganNama.unique' => 'Nama pelanggan sudah ada. Silakan gunakan nama lain.',
                    'newPelangganDaerah.required' => 'Daerah pelanggan wajib diisi.',
                    'newPelangganDaerah.string' => 'Daerah pelanggan harus berupa teks.',
                ]
            );

            $pelanggan = Pelanggans::create([
                'nama' => $validated['newPelangganNama'],
                'daerah' => $validated['newPelangganDaerah'],
            ]);

            $this->newPelangganNama = '';
            $this->newPelangganDaerah = '';

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->success('Data Penyetor berhasil ditambahkan.');

            $this->dispatch('penyetor-created', pelanggan: $pelanggan);
        } catch (ValidationException $e) {

            // Ambil semua pesan error
            $errors = collect($e->validator->errors()->all())->join(', ');

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 4000)
                ->error($errors);

            throw $e; // supaya error tetap tampil di form (opsional)
        }
    }


    public function render()
    {
        return view('livewire.component.create-penyetor-modal');
    }
}