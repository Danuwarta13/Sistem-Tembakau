<div x-data="{ open: false }" x-on:show-modal.window="open = true" x-on:hide-modal.window="open = false">

    {{-- Overlay --}}
    <div x-show="open" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40"></div>

    {{-- Modal --}}
    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                <!-- Modal header -->
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Edit Barang
                    </h3>
                    <button type="button" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" x-on:click="open = false">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" /></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit.prevent="update" action="#">
                    <div class="space-y-4 mb-6 mt-4">
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium text-heading">Nama</label>
                            <input wire:model="nama" type="text" id="nama" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-green-300 focus:border-green-600 block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Nama Penyetor" required />
                        </div>

                        <div>
                            <label for="daerah" class="block mb-2 text-sm font-medium text-heading">Daerah</label>
                            <input wire:model="daerah" type="text" id="daerah" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-green-300 focus:border-green-600 block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Daerah Penyetor" required />
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        {{-- Update --}}
                        <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Update product
                        </button>

                        {{-- Delete --}}
                        <button type="button" wire:click="confirmDelete" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Delete
                        </button>

                        @if($showDeleteModal)
                        <div class="fixed  inset-0 bg-black opacity-80  z-40"></div>
                        <div class="fixed inset-0 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg w-80 shadow-lg">

                                <h2 class="text-lg font-bold mb-3">Konfirmasi Hapusss</h2>
                                <p>Yakin ingin menghapus data ini?</p>

                                <div class="mt-4 flex justify-end gap-2">
                                    <button type="button" wire:click="$set('showDeleteModal', false)" class="px-4 py-2 bg-gray-300 rounded">
                                        Batal
                                    </button>

                                    <button type="button" wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showModal', () => {
                window.dispatchEvent(new CustomEvent('show-modal'));
            });

            Livewire.on('hideModal', () => {
                window.dispatchEvent(new CustomEvent('hide-modal'));
            });
        });

    </script>
</div>
