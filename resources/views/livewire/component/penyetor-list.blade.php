<div class="mb-6 p-6 bg-neutral-primary-soft rounded-2xl shadow-xl border  border-default">
    <!-- Header -->
    <div class="mb-3 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-heading">List Penyetor</h2>
            <p class="mt-1 text-slate-500 text-sm">
                Anda bisa mengubah atau menghapus data penyetor disini.
            </p>
        </div>
        <!-- Tombol Tambah -->
        @livewire('component.create-penyetor-modal')
    </div>

    <!-- Search Bar -->
    <form wire:submit.prevent="search" action="">
        <div class="mb-4 w-full md:w-1/2">
            <div class="relative">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="query" type="search" class="w-full pl-10 pr-4 py-1.5 bg-neutral-secondary-medium  backdrop-blur-md border border-default-medium rounded-xl shadow-sm placeholder-slate-400 dark:text-slate-100 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-200 transition" placeholder="Cari penyetor...">
            </div>
        </div>
    </form>

    <!-- List Penyetor -->
    <div class="flex flex-col divide-y divide-slate-200">
        @foreach($penyetors as $penyetor)
        <div class="flex flex-col sm:flex-row sm:items-center justify-between py-4">
            <div class="flex items-center gap-4">
                <!-- Avatar -->
                <div class="shrink-0 w-12 h-12 flex items-center justify-center bg-slate-100 rounded-full text-slate-700 font-medium">
                    {{ strtoupper(substr($penyetor->nama,0,2)) }}
                </div>
                <!-- Info -->
                <div class="min-w-0">
                    <div class="font-semibold text-heading truncate">{{ $penyetor->nama }}</div>
                    <div class="text-sm text-slate-500 truncate">{{ $penyetor->daerah }}</div>
                </div>
            </div>

            <!-- Statistik & Button -->
            <div class="mt-2 sm:mt-0 flex flex-col sm:flex-row sm:items-center gap-4 text-sm text-heading">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    {{ ribuan($penyetor->barangs_count) }} Keranjang
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-blue-700 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.5 21h13M12 21V7m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm2-1.8c3.073.661 2.467 2.8 5 2.8M5 8c3.359 0 2.192-2.115 5.012-2.793M7 9.556V7.75m0 1.806-1.95 4.393a.773.773 0 0 0 .37.962.785.785 0 0 0 .362.089h2.436a.785.785 0 0 0 .643-.335.776.776 0 0 0 .09-.716L7 9.556Zm10 0V7.313m0 2.243-1.95 4.393a.773.773 0 0 0 .37.962.786.786 0 0 0 .362.089h2.436a.785.785 0 0 0 .643-.335.775.775 0 0 0 .09-.716L17 9.556Z" />
                    </svg>
                    {{ ribuan($penyetor->total_kg) }} Kg
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Z" />
                    </svg>
                    {{ rupiah($penyetor->total_cash) }}
                </div>

                <!-- Button Edit -->
                <button wire:click="edit({{ $penyetor->id }})" class="mt-2 sm:mt-0 px-3 py-1.5 bg-blue-600 hover:bg-blue-500 text-white rounded-lg shadow shadow-blue-500/20 text-sm transition dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-300">
                    Edit
                </button>
            </div>
        </div>
        @endforeach
        @livewire('component.edit-penyetor-form')
    </div>
    <div class="p-2">
        {{ $penyetors->links() }}
    </div>
</div>
