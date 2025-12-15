<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Title --}}
    <title>{{ $title ?? 'Page Title' }}</title>

    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('svg/logo.svg') }}" type="image/x-icon">

    @vite('resources/css/app.css')
</head>
<body>


    <nav class="fixed top-0 z-50 w-full bg-neutral-primary-soft border-b border-default">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    {{-- Icon Open sideBar --}}
                    @livewire('component.open-sidebar')

                    <a href="{{ route('operator.dashboard') }}" class="flex ms-2 md:me-24">
                        <img src="{{ asset('svg/logo.svg') }}" class="h-8 me-2" alt="FlowBite Logo" />
                        <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white">TembakauKu</span>
                    </a>


                </div>


                <div class="flex justify-between gap-2.5">
                    {{-- DarkMode --}}
                    @livewire('component.theme-toggle')

                    {{-- button Fullscreen --}}
                    @livewire('component.icon-fullscreen')
                </div>

            </div>
        </div>
    </nav>

    @livewire('component.sidebar-operator')

    <div>
        {{ $slot }}
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.js"></script>
    <script>
        // Function Fullscreen
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('fullscreen-toggle', () => {

                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    localStorage.setItem('fullscreen_active', '1');
                } else {
                    document.exitFullscreen();
                    localStorage.removeItem('fullscreen_active');
                }
            });
        });

        // DarkMode
        document.addEventListener('livewire:init', () => {
            Livewire.on('theme-changed', data => {

                const theme = data.theme;

                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }

                localStorage.setItem('theme', theme);
            });
        });

        // Load tema saat pertama kali halaman dibuka
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

    </script>


</body>
</html>
