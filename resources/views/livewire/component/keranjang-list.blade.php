{{-- <div wire:poll.2500ms class="p-6 mb-6 border border-default border-dashed  rounded-2xl shadow-xl"> --}}

<div wire:poll.2500ms class=" p-6 mb-5 relative bg-neutral-primary-soft rounded-base border border-dashed border-default shadow-xl">

    {{-- Title --}}
    <div class=" text-center ">
        <h1 class=" text-lg font-bold tracking-tight text-heading md:text-lg lg:text-2xl">Data Keranjang</h1>
        <p class=" text-lg font-normal text-body lg:text-sm sm:px-16 xl:px-48">Here at Flowbite we focus on markets where technology.</p>
    </div>

    {{-- Search --}}
    <div class="p-2 flex items-center justify-between">
        <form wire:submit.prevent="search" action="">
            <label for="input-group-1" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" /></svg>
                </div>
                <input wire:model.live.debounce.250ms="query" type="search" id="input-group-1" class="block w-full max-w-96 ps-9 pe-3 py-2 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 shadow-xs placeholder:text-body" placeholder="Search">
            </div>
        </form>
        <button wire:click="$dispatch('open-cetak-nota-modal')" class="inline-flex items-center justify-center text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-base text-sm px-3 py-2 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
            <svg class="w-5 h-5 me-1 -ms-0.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
            </svg>
            Cetak Nota
        </button>
    </div>
    <!-- Modal Nota -->
    @livewire('component.cetak-nota-modal-' . auth()->user()->role)

    {{-- Tabel List --}}
    <div class="overflow-x-auto w-full">
        <table class="min-w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-t border-default-medium">
                <tr>

                    <th scope="col" class="px-6 py-3 font-medium text-center">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nama
                    </th>
                    <th scope="col" class="px-3 py-3 font-medium">
                        No Seri
                    </th>
                    <th scope="col" class="px-3 py-3 font-medium">
                        Grade
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Bruto
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Netto
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Jumlah
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                    <td class="px-2 py-4 text-center">{{ $barang->tanggal }}</td>
                    <td class="px-2 py-4">{{ $barang->nama }}</td>
                    <td class="px-6 py-4">{{ $barang->no_seri }}</td>
                    <td class="px-6 py-4">{{ $barang->grade }}</td>
                    <td class="px-6 py-4">{{ to_koma($barang->bruto) }}</td>
                    <td class="px-6 py-4">{{ to_koma($barang->netto) }}</td>
                    <td class="px-6 py-4">{{ rupiah($barang->harga) }}</td>
                    <td class="px-6 py-4">{{ rupiah($barang->jumlah) }}</td>

                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $barang->id }})" class="block text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-300" type="button">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @livewire('component.edit-keranjang-form')
    </div>
    <div class="p-4">
        {{ $this->barangs()->links() }}
    </div>
</div>
{{-- </div> --}}
