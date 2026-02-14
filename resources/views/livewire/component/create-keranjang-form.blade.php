<div class="p-6 mb-6 border bg-neutral-primary-soft rounded-base border-dashed border-default shadow-xl">

    {{-- Title & Modal --}}
    <div class=" flex justify-between mb-2">
        <div class="mb-2">
            <h1 class="text-lg font-bold tracking-tight text-heading md:text-lg lg:text-xl">Tambah Keranjang</h1>
            <p class="my-0.5 text-slate-500 text-sm">
                Pastika semua inputan terisi dengan benar.
            </p>
        </div>

        @livewire('component.create-penyetor-modal')
    </div>

    {{-- Form Create --}}
    <form wire:submit.prevent="createNewBarang">

        <div class="grid gap-6 mb-6 md:grid-cols-2">

            {{-- Tanggal --}}
            <div>
                <label for="tanggal" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Tanggal</label>
                <input wire:model.live="tanggal" type="date" id="tanggal" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('tanggal')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Penyetor --}}
            <div>
                <label for="pelanggan_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Pilih Penyetor</label>
                <select wire:model.live="pelanggan_id" id="pelanggan_id" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm">
                    <option selected>Pilih Nama</option>
                    @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div>
                <label for="nama" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Nama</label>
                <input wire:model="nama" type="text" id="nama" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('nama')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Daerah --}}
            <div>
                <label for="daerah" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Daerah</label>
                <input wire:model="daerah" type="text" id="daerah" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('daerah')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grade --}}
            <div>
                <label for="grade" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Grade</label>
                <input wire:model.live="grade" type="text" id="grade" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('grade')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- No Seri --}}
            <div>
                <label for="no_seri" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">No Seri</label>
                <input wire:model="no_seri" type="text" id="no_seri" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('no_seri')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bruto --}}
            <div>
                <label for="bruto" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Bruto</label>
                <input wire:model.live="bruto" type="text" id="bruto" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('bruto')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Netto --}}
            <div>
                <label for="netto" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Netto</label>
                <input wire:model="netto" type="text" id="netto" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('netto')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="harga" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Harga (Rp)</label>
                <input wire:model.live="harga" type="number" id="harga" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('harga')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Jumlah (Rp)</label>
                <input wire:model.live="jumlah" type="text" id="jumlah" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-green-500 focus:border-green-500 shadow-sm" />
                @error('jumlah')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <button class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 
                   hover:bg-green-500 rounded-lg shadow-sm focus:ring-4 focus:ring-green-300">

            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
            </svg>
            Tambah Keranjang
        </button>
    </form>
</div>
