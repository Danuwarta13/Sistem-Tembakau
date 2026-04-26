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
    </div>
</div>