<div class="bg-neutral-primary-soft p-4 border border-default rounded-base shadow-md hover:shadow-lg transition">
    <div class="flex flex-col justify-between leading-normal">

        <!-- Header -->
        <div class="flex flex-col items-center p-2 md:flex-row md:justify-between">
            <h5 class="text-xl md:text-2xl font-bold tracking-tight text-heading mb-3 md:mb-0">
                Grade.
            </h5>

            <!-- BOX GRADE B (BIRU) -->
            <div class="w-full md:w-40 h-20 border-2 border-blue-500 bg-blue-100 rounded-4xl flex items-center justify-center shadow-inner">
                <p class="text-5xl md:text-6xl lg:text-7xl text-blue-600 font-semibold">B</p>
            </div>
        </div>

        <!-- Text -->
        <p class="my-4 text-sm text-body">
            Berikut adalah total keranjang yang mempunyai Grade B
        </p>

        <div class="mb-2 flex justify-between">
            <!-- Keranjang -->
            <div class="inline-flex items-center justify-center text-slate-800 bg-blue-200 border border-blue-400 hover:bg-blue-300 hover:text-heading focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-base text-sm px-4 py-2.5">
                <svg class="w-4 h-4 me-2 text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                </svg>
                {{ ribuan($totalB) }} KRJ
            </div>

            <!-- Berat -->
            <div class=" inline-flex items-center justify-center text-slate-800 bg-blue-200 border border-blue-400 hover:bg-blue-300 hover:text-heading focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-base text-sm px-2 py-2">
                <svg class="w-4 h-4 me-2 text-blue-700 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.5 21h13M12 21V7m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm2-1.8c3.073.661 2.467 2.8 5 2.8M5 8c3.359 0 2.192-2.115 5.012-2.793M7 9.556V7.75m0 1.806-1.95 4.393a.773.773 0 0 0 .37.962.785.785 0 0 0 .362.089h2.436a.785.785 0 0 0 .643-.335.776.776 0 0 0 .09-.716L7 9.556Zm10 0V7.313m0 2.243-1.95 4.393a.773.773 0 0 0 .37.962.786.786 0 0 0 .362.089h2.436a.785.785 0 0 0 .643-.335.775.775 0 0 0 .09-.716L17 9.556Z" />
                </svg>

                {{ ribuan($totalKg) }} Kg
            </div>
        </div>

        <!-- Cash -->
        <div class="mb-2 inline-flex items-center justify-center text-slate-800 bg-blue-200 border border-blue-400 hover:bg-blue-300 hover:text-heading focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-base text-sm px-2 py-2">
            <svg class="w-4 h-4 me-2 text-blue-700 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
            </svg>
            {{ rupiah($totalR) }}
        </div>

        <!-- Rata -->
        <div class="inline-flex items-center justify-center text-slate-800 bg-blue-200 border border-blue-400 hover:bg-blue-300 hover:text-heading focus:ring-4 focus:ring-blue-300 shadow-sm font-medium rounded-base text-sm px-2 py-2">
            Harga rata-rata / Kg
            {{ rupiah($rataR) }}
        </div>

    </div>

</div>
