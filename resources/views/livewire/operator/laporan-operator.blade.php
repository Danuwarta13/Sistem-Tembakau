<div class="min-h-screen bg-neutral-primary-soft lg:ml-64 mt-14 p-4">
    <div class="p-4 mb-4 border border-default border-dashed rounded-base">
        {{-- Title --}}
        <div>
            <h2 class="text-xl font-bold text-heading">Export Laporan</h2>
            <p class="mb-2 text-sm text-body">Pastikan untuk memilih GRADE terlebih dahulu sebelum mengisi No Seri Start.</p>
        </div>

        <form wire:submit.prevent="export">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="lap" class="block mb-2.5 text-sm font-medium text-heading">LAP</label>
                    <input wire:model="lap" type="text" id="lap" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="" required />
                </div>
                <div>
                    <label for="grade" class="block mb-2.5 text-sm font-medium text-heading">GRADE</label>
                    <select wire:model="grade" id="grade" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                        <option selected>-- Pilih Grade --</option>
                        @foreach ($grades as $g)
                        <option value="{{ $g }}">{{ $g }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="seriStart" class="block mb-2.5 text-sm font-medium text-heading">No Seri Start</label>
                    <input wire:model.live="seriStart" type="number" id="seriStart" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="" required />
                </div>
                <div>
                    <label for="seriEnd" class="block mb-2.5 text-sm font-medium text-heading">No Seri End</label>
                    <input wire:model="seriEnd" type="text" id="seriEnd" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="" readonly />
                </div>

            </div>

            <button type="submit" class="text-white flex items-center bg-green-500 box-border border border-transparent hover:bg-green-600 focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                <svg class="w-4 h-4 me-0.5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10V4a1 1 0 0 0-1-1H9.914a1 1 0 0 0-.707.293L5.293 7.207A1 1 0 0 0 5 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2M10 3v4a1 1 0 0 1-1 1H5m5 6h9m0 0-2-2m2 2-2 2" />
                </svg>
                Export</button>
        </form>
    </div>
    <script>
        document.addEventListener('livewire:init', () => {
            // Tangkap event dari server
            Livewire.on('resetFormInputs', () => {
                // Reset semua input form di halaman
                document.querySelectorAll('input').forEach(field => field.value = '');
            });
        });

    </script>
</div>
