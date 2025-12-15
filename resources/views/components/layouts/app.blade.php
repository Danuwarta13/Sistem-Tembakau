<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="shortcut icon" href="{{ asset('svg/logo.svg') }}" type="image/x-icon">

    @vite('resources/css/app.css')
</head>
<body>
    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.js"></script>
    <script>
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
