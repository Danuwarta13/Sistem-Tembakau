<div>
    <!-- Modal toggle -->
    <button wire:click="$dispatch('open-penyetor-modal')" class="text-white bg-green-600 box-border border border-transparent hover:bg-green-500 focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" type="button">
        Tambah Penyetor
    </button>

    <!-- Main modal -->
    <div x-data="{ open: @entangle('open') }">
        <!-- Overlay -->
        <div x-show="open" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40"></div>

        <!-- Modal -->
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                        <h3 class="text-lg font-medium text-heading">
                            Tambah Penyetor
                        </h3>
                        <button type="button" wire:click="closeModal" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" /></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form wire:submit.prevent="createNewPelanggan">
                        <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                            <div class="col-span-2">
                                <label for="newPelangganNama" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
                                <input wire:model.defer="newPelangganNama" type="text" name="nama" id="newPelangganNama" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-green-300 focus:border-green-600 block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Nama Penyetor">
                                @error('newPelangganNama') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="newPelangganDaerah" class="block mb-2.5 text-sm font-medium text-heading">Daerah</label>
                                <input wire:model.defer="newPelangganDaerah" type="text" name="daerah" id="newPelangganDaerah" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-green-300 focus:border-green-600 block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Daerah Penyetor">
                                @error('newPelangganDaerah') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                            <button wire:click="closeModal" class=" inline-flex items-center text-white bg-green-600 hover:bg-green-500 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" /></svg>
                                Tambah Penyetor
                            </button>
                            <button wire:click="closeModal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
