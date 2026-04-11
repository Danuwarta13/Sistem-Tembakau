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
                <input wire:model.live="tanggal" type="date" id="tanggal" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('tanggal')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Penyetor --}}
            <div x-data="{
                search: '',
                open: false,
                selectedId: @entangle('pelanggan_id').live,
                get filteredPelanggans() {
                    const data = this.$wire.pelanggans || [];
                    if (this.search === '') {
                        return data;
                    }
                    return data.filter((pelanggan) => {
                        return pelanggan && pelanggan.nama && String(pelanggan.nama).toLowerCase().includes(this.search.toLowerCase());
                    });
                },
                selectPelanggan(id) {
                    this.selectedId = id;
                    this.open = false;
                    this.search = '';
                },
                getSelectedNama() {
                    const data = this.$wire.pelanggans || [];
                    let selected = data.find(p => p.id == this.selectedId);
                    return selected && selected.nama ? selected.nama : 'Pilih Nama';
                }
            }" class="relative">
                <label for="pelanggan_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Pilih Penyetor</label>
                
                <div @click="open = !open" @click.outside="open = false" 
                     class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-pointer flex justify-between items-center">
                    <span x-text="getSelectedNama()" :class="{'text-gray-500 dark:text-gray-400': !selectedId}"></span>
                    <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>

                <!-- Dropdown menu -->
                <div x-show="open" style="display: none;"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-700 dark:border-gray-600">
                    
                    <div class="p-2 border-b dark:border-gray-600">
                        <input x-model="search" type="text" placeholder="Cari nama penyetor..." 
                               class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                               @click.stop>
                    </div>
                    
                    <ul class="max-h-60 overflow-y-auto py-1">
                        <li @click="selectPelanggan('')" 
                            class="px-4 py-2 cursor-pointer hover:bg-green-50 dark:hover:bg-gray-600 dark:text-white text-sm text-gray-700">
                            Pilih Nama
                        </li>
                        <template x-for="pelanggan in filteredPelanggans" :key="pelanggan.id">
                            <li @click="selectPelanggan(pelanggan.id)" 
                                class="px-4 py-2 cursor-pointer hover:bg-green-50 dark:hover:bg-gray-600 dark:text-white text-sm text-gray-700 flex justify-between items-center"
                                :class="{'bg-green-50 dark:bg-gray-600': selectedId === pelanggan.id}">
                                <span x-text="pelanggan.nama"></span>
                                <svg x-show="selectedId === pelanggan.id" class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </li>
                        </template>
                        <li x-show="filteredPelanggans.length === 0" class="px-4 py-2 text-gray-500 text-sm dark:text-gray-400">
                            Penyetor tidak ditemukan.
                        </li>
                    </ul>
                </div>
                
                @error('pelanggan_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div>
                <label for="nama" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Nama</label>
                <input wire:model="nama" type="text" id="nama" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('nama')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Daerah --}}
            <div>
                <label for="daerah" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Daerah</label>
                <input wire:model="daerah" type="text" id="daerah" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading
                           focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('daerah')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grade --}}
            <div>
                <label for="grade" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Grade</label>
                <input wire:model.live="grade" type="text" id="grade" oninput="this.value = this.value.replace(/[^a-zA-Z]/g, '')" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('grade')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- No Seri --}}
            <div>
                <label for="no_seri" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">No Seri</label>
                <input wire:model="no_seri" type="text" id="no_seri" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('no_seri')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bruto --}}
            <div>
                <label for="bruto" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Bruto</label>
                <input wire:model.live="bruto" type="number" id="bruto" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('bruto')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Netto --}}
            <div>
                <label for="netto" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Netto</label>
                <input wire:model="netto" type="number" id="netto" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('netto')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="harga" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Harga (Rp)</label>
                <input wire:model.live="harga" type="number" id="harga" class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-2 focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
                @error('harga')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label for="jumlah" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white ">Jumlah (Rp)</label>
                <input wire:model.live="jumlah" type="text" id="jumlah" readonly class="w-full px-3 py-2.5 text-sm rounded-lg border border-default-medium bg-neutral-secondary-medium text-heading focus:ring-green-500 focus:border-green-500 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder:text-gray-400 dark:text-white" />
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
