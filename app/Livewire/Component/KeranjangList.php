<?php

namespace App\Livewire\Component;

use Carbon\Carbon;
use App\Models\Barangs;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class KeranjangList extends Component
{
    use WithPagination;

    #[On('barang-created')]
    #[On('barang-updated')]
    #[On('barang-deleted')]


    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public $query = '';

    private function convertToDate($query)
    {
        // Jika input mengandung angka, stripan, slash, atau bulan
        $try = str_replace('/', '-', $query);

        try {
            return Carbon::parse($try)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // bukan tanggal
        }
    }

    #[Computed()]
    public function barangs()
    {
        $date = $this->convertToDate($this->query);

        return Barangs::query()
            ->when($this->query, function ($q) use ($date) {

                if ($date) {
                    // 🔍 Query adalah TANGGAL
                    $q->whereDate('tanggal', $date);
                } else {
                    // 🔍 Query untuk nama
                    $q->where('nama', 'like', '%' . $this->query . '%');
                }
            })
            ->latest()
            ->paginate(6);
    }

    // protected $listeners = ['barangUpdated' => '$refresh'];

    public function edit($id)
    {
        // dd($id);
        $this->dispatch('openEditModal', id: $id);
    }

    public function render()
    {
        return view('livewire.component.keranjang-list', [
            'barangs' => $this->barangs,
        ]);
    }
}
