 <div class="mb-4 p-6 bg-neutral-primary-soft border border-default rounded-base shadow-md hover:shadow-lg transition">

     <h2 class="text-2xl font-bold text-heading">Total Keseluruhan</h2>
     <p class="my-2 text-slate-500 text-sm">
         Berikut adalah total keseluruhan dari Grade A, B dan C.
     </p>

     {{-- GRID RESPONSIVE --}}
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">

         {{-- KERANJANG --}}
         <div class="flex items-center gap-3 bg-green-100 border border-green-300 hover:bg-green-300 hover:text-heading group
                    px-4 py-3 rounded-xl shadow-sm hover:shadow-md transition">
             <div class="p-2 bg-green-200 rounded-lg">
                 <svg class="w-5 h-5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                 </svg>
             </div>

             <div>
                 <p class="text-sm text-slate-600 dark:group-hover:text-white transition">Total Keranjang</p>
                 <p class="font-semibold text-slate-800 text-lg dark:group-hover:text-white transition">{{ ribuan($totalKrj) }}</p>
             </div>
         </div>

         {{-- BERAT --}}
         <div class="group flex items-center gap-3 bg-blue-100 border border-blue-300 hover:bg-blue-300 hover:text-heading 
                    px-4 py-3 rounded-xl shadow-sm hover:shadow-md transition">
             <div class="p-2 bg-blue-200 rounded-lg">
                 <svg class="w-5 h-5 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.5 21h13M12 21V7m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm2-1.8c3.073.661 2.467 2.8 5 2.8M5 8c3.359 0 2.192-2.115 5.012-2.793M7 9.556V7.75m0 1.806-1.95 4.393a.773.773 0 0 0 .37.962.785.785 0 0 0 .362.089h2.436a.785.785 0 0 0 .643-.335.776.776 0 0 0 .09-.716L7 9.556Zm10 0V7.313m0 2.243-1.95 4.393a.773.773 0 0 0 .37.962.786.786 0 0 0 .362.089h2.436a.785.785 0 0 0 .643-.335.775.775 0 0 0 .09-.716L17 9.556Z" />
                 </svg>
             </div>

             <div>
                 <p class="text-sm text-slate-600 dark:group-hover:text-white transition">Total Berat</p>
                 <p class="font-semibold text-slate-800 text-lg dark:group-hover:text-white transition">{{ ribuan($totalKg) }} Kg</p>
             </div>
         </div>

         {{-- CASH --}}
         <div class="flex items-center gap-3 bg-orange-100 border border-orange-300 hover:bg-orange-300 hover:text-heading group
                    px-4 py-3 rounded-xl shadow-sm hover:shadow-md transition">
             <div class="p-2 bg-orange-200 rounded-lg">
                 <svg class="w-5 h-5 text-orange-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                 </svg>
             </div>

             <div>
                 <p class="text-sm text-slate-600 dark:group-hover:text-white transition">Total Cash</p>
                 <p class="font-semibold text-slate-800 text-sm dark:group-hover:text-white transition">{{ rupiah($totalR) }}</p>
             </div>
         </div>

         {{-- RATA-RATA --}}
         <div class="flex items-center gap-3 bg-gray-100 border border-grbg-gray-300 hover:bg-gray-300 hover:text-heading group
                    px-4 py-3 rounded-xl shadow-sm hover:shadow-md transition">
             <div class="p-2 bg-gray-200 rounded-lg">
                 <svg class="w-5 h-5 text-grbg-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-width="2" d="M12 3v18m9-9H3" />
                 </svg>
             </div>

             <div>
                 <p class="text-sm text-slate-600 dark:group-hover:text-white transition">Harga Rata-rata / Kg</p>
                 <p class="font-semibold text-slate-800 text-lg dark:group-hover:text-white transition">{{ rupiah($rataR) }}</p>
             </div>
         </div>

     </div>
 </div>
