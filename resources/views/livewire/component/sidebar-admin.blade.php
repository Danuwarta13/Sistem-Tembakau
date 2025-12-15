 <div x-data="{ open: @entangle('open') }">

     <!-- Overlay -->
     <div x-show="open" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-sm z-20 lg:hidden">
     </div>

     <aside class="
            fixed top-0 left-0 z-40 w-64 h-full transition-transform
            -translate-x-full
            lg:translate-x-0
            " :class="{ 'translate-x-0': open }">

         <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
             <a href="{{ route('admin.dashboard') }}" class="flex items-center ps-2.5 mb-6">
                 <img src="{{ asset('svg/logo.svg') }}" class="h-6 me-3" alt="Flowbite Logo" />
                 <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">TembakauKu</span>
             </a>
             <ul class="space-y-2 font-medium">
                 <li>
                     <a href="{{ route('admin.dashboard') }}" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-green-600 group">
                         <svg class="w-5 h-5 transition duration-75 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" /></svg>
                         <span class="ms-3">Dashboard</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.keranjang') }}" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-green-600 group">
                         <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v14M9 5v14M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" /></svg>
                         <span class="flex-1 ms-3 whitespace-nowrap">Keranjang</span>
                     </a>
                 </li>
                 <li>
                     <a href="{{ route('admin.penyetor') }}" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-green-600 group">
                         <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                         <span class="flex-1 ms-3 whitespace-nowrap">Penyetor</span>
                     </a>
                 </li>
                 <li>
                     <form method="POST" action="{{ route('logout') }}">
                         @csrf
                         <button type="submit" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-green-600 group w-full text-left">
                             <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                             </svg>
                             <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                         </button>
                     </form>

                 </li>
             </ul>
         </div>
     </aside>
 </div>
