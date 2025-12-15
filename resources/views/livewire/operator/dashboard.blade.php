<div class="min-h-screen bg-neutral-primary-soft lg:ml-64 mt-14 p-4">
    <div class="p-4 border border-default border-dashed rounded-base">
        {{-- Grade--}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <!-- CARD A -->
            @livewire('component.dashboard-grade-a')

            <!-- CARD B -->
            @livewire('component.dashboard-grade-b')

            <!-- CARD C -->
            @livewire('component.dashboard-grade-c')
        </div>

        {{--Total --}}
        @livewire('component.dashboard-total')

        {{-- <div class="flex items-center justify-center h-48 rounded-base bg-neutral-secondary-soft mb-4">
            <p class="text-fg-disabled">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" /></svg>
            </p>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" /></svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" /></svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" /></svg>
                </p>
            </div>
        </div> --}}
    </div>
</div>
