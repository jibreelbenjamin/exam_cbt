<!DOCTYPE html>
<html lang="en" class="scroll-smooth relative h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav.pnG') }}" >
    <title>{{ (isset($page)) ? ucfirst(preg_replace('/[^a-zA-Z0-9]+/', ' ', $page)) . ' - ' . env('APP_ECHO_NAME') : env('APP_ECHO_NAME') }} {{ (session('role') && session('role') != 'siswa') ? '[OPERATOR]' : '' }}</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') === 'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');

        function updateClock() {
            const el = document.getElementById('clock');
            if (!el) return;

            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };

            el.textContent = new Date().toLocaleString('id-ID', options);
        }

        setInterval(updateClock, 1000);
    </script>
</head>
<body class="bg-gray-50 dark:bg-neutral-900 h-full">
    <div id="overlayInit" class="fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center">
        <div class="w-12 h-12 border-5 border-white border-t-transparent rounded-full animate-spin"></div>
    </div>
    {{ $slot }}
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const overlay = document.getElementById("overlayInit");

        if (!overlay) return;
        const showOverlay = () => overlay.classList.remove("hidden");
        const hideOverlay = () => overlay.classList.add("hidden");

        showOverlay();

        window.addEventListener("load", () => {
            hideOverlay();
        });

        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", () => {
                showOverlay();
            });
        });

        const imgs = document.images;
        let loadedCount = 0;

        if (imgs.length > 0) {
            [...imgs].forEach(img => {
                const imgLoad = () => {
                    loadedCount++;
                    if (loadedCount === imgs.length) {
                        hideOverlay();
                    }
                };

                if (img.complete) {
                    imgLoad();
                } else {
                    img.addEventListener("load", imgLoad);
                    img.addEventListener("error", imgLoad); 
                }
            });
        }
    });
    </script>

</body>
</html>

@if (session('successToast'))
<x-toast type='normal' status='success'>
{{ session('successToast') }}
</x-toast>
@endif
@if (session('warningToast'))
<x-toast type='normal' status='warning'>
{{ session('warningToast') }}
</x-toast>
@endif
<x-toast type='errors-has'></x-toast>