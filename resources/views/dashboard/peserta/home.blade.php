@php
    $page = 'home';
@endphp
<x-app :page='$page'>
<div class="py-2 sm:pb-0 sm:pt-5 space-y-5">
    <!-- Header -->
    <div class="flex flex-wrap justify-between items-center gap-2">
        <div>
        <h1 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
            Selamat Datang di {{ env('APP_ECHO_NAME') }}.
        </h1>
        <p class="text-sm text-gray-500 dark:text-neutral-500">
            {{ Auth::guard('peserta')->user()->nama }}
        </p>
        </div>
    </div>
    <!-- End Header -->

    <!-- Cards -->
    <div class="xl:p-5 space-y-4 flex flex-col xl:bg-white xl:border xl:border-gray-200 xl:shadow-2xs xl:rounded-xl dark:xl:bg-neutral-800 dark:xl:border-neutral-700">
        <!-- Header -->
        <div class="hidden xl:flex justify-between items-center gap-x-2">
            <h2 class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
                Daftar ujian
                @if ($total < 1)
                    <p class="text-xs font-normal text-gray-500 dark:text-neutral-500">Tidak ada jadwal ujian tersedia</p>
                @else
                    <p class="text-xs font-normal text-gray-500 dark:text-neutral-500">Tersedia <span class="font-semibold text-gray-900 dark:text-neutral-100">{{ $total }}</span> jadwal ujian</p>
                @endif
            </h2>
        </div>
        <!-- End Header -->

        <!-- Card Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-3 gap-3 xl:gap-5">

            @if (!empty($data))
                @foreach ($data as $item)                
                <!-- Card -->
                <div class="p-4 grid content-between bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div>
                        <div class="leading-5">
                            <p class="text-gray-800 text-sm decoration-2 font-semibold focus:outline-hidden focus:underline dark:text-neutral-200 dark:focus:outline-hidden">
                                {{ $item['nama'] }}
                                <p class="text-xs text-gray-500 dark:text-neutral-500">
                                    {{ $item['paket_ujian']['nama'] ?? '' }}
                                </p>
                            </p>
                        </div>
        
                        <!-- Badge Group -->
                        
                        <div class="mt-1.5 flex flex-wrap gap-1.5">
                            @if ($item['status'] == 'berjalan')
                                <span class="py-1 px-2 inline-flex items-center gap-x-1.5 bg-gray-100 text-xs text-red-600 rounded-md dark:bg-neutral-700 dark:text-red-500">
                                    <div class="ml-0.5 relative inline-flex">
                                        <span class="absolute inline-flex h-full w-full rounded-full bg-red-400 dark:bg-red-500 opacity-75 animate-ping"></span>
                                        <span class="relative inline-flex h-2 w-2 rounded-full bg-red-500 dark:bg-red-600"></span>
                                    </div>
                                    <span data-countdown="{{ $item['jadwal_selesai'] }}" data-durasi="{{ $item['durasi'] }}" class="cdRun">
                                        00:00
                                    </span>
                                </span>
                            @else
                                <span class="py-1 px-2 inline-flex items-center gap-x-1.5 bg-gray-100 text-xs text-gray-800 rounded-md dark:bg-neutral-700 dark:text-neutral-200">
                                    {{ $item['durasi'] }} Menit
                                </span>
                            @endif

                            <span class="py-1 px-2 inline-flex items-center gap-x-1.5 bg-gray-100 text-xs text-gray-800 rounded-md dark:bg-neutral-700 dark:text-neutral-200">
                                @if ($item['status'] == 'persiapan')
                                    <span class="inline-block w-1 h-3 bg-gray-500 rounded-full"></span>
                                    Persiapan
                                @elseif($item['status'] == 'berjalan')
                                    <span class="inline-block w-1 h-3 bg-yellow-500 rounded-full"></span>
                                    Berjalan
                                @elseif($item['status'] == 'selesai')
                                    <span class="inline-block w-1 h-3 bg-blue-500 rounded-full"></span>
                                    Selesai
                                @else
                                    <span class="inline-block w-1 h-3 bg-neutral-300 rounded-full"></span>
                                    Unknown
                                @endif
                            </span>
                        </div>
                        <!-- End Badge Group -->
                    </div>

                    <div>
                        <p class="mt-3 text-[10px] text-gray-500 dark:text-neutral-500">
                            @if ($item['status'] == 'persiapan')
                                Dimulai {{ $item['jadwal_mulai'] }}
                            @elseif ($item['status'] == 'berjalan')
                                Ditutup {{ $item['jadwal_selesai'] }}
                            @elseif ($item['status'] == 'selesai')
                                Ujian selesai pada {{ $item['jadwal_selesai'] }}
                            @endif
                        </p>
        
                        <div class="mt-1">
                            @if ($item['status'] == 'berjalan')                            
                                <a href="{{ route('onexam.konfirmasi', $item['id_ujian']) }}" class="py-2 px-3 w-full inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-chhdl">
                                    Kerjakan
                                </a>
                            @elseif ($item['status'] == 'persiapan')
                                <button
                                    disabled
                                    type="button"
                                    data-start="{{ $item['jadwal_mulai'] }}"
                                    class="cdPrepare py-2 px-3 w-full inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300">
                                    00:00
                                </button>

                                
                            @else
                                <button disabled type="button" class="py-2 px-3 w-full inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-chhdl">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End Card -->
                @endforeach
            @else
                <!-- Empty State -->
                <div class="p-5 sm:col-span-2 2xl:col-span-3 min-h-150 flex flex-col justify-center items-center text-center">
                    <svg class="w-48 mx-auto mb-4" width="178" height="90" viewBox="0 0 178 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="27" y="50.5" width="124" height="39" rx="7.5" fill="currentColor" class="fill-white dark:fill-neutral-800" />
                    <rect x="27" y="50.5" width="124" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-50 dark:stroke-neutral-700/10" />
                    <rect x="34.5" y="58" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-50 dark:fill-neutral-700/30" />
                    <rect x="66.5" y="61" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-50 dark:fill-neutral-700/30" />
                    <rect x="66.5" y="73" width="77" height="6" rx="3" fill="currentColor" class="fill-gray-50 dark:fill-neutral-700/30" />
                    <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" fill="currentColor" class="fill-white dark:fill-neutral-800" />
                    <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/30" />
                    <rect x="27" y="36" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70" />
                    <rect x="59" y="39" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70" />
                    <rect x="59" y="51" width="92" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70" />
                    <g filter="url(#filter3)">
                        <rect x="12" y="6" width="154" height="40" rx="8" fill="currentColor" class="fill-white dark:fill-neutral-800" shape-rendering="crispEdges" />
                        <rect x="12.5" y="6.5" width="153" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/60" shape-rendering="crispEdges" />
                        <rect x="20" y="14" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700 " />
                        <rect x="52" y="17" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700" />
                        <rect x="52" y="29" width="106" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700" />
                    </g>
                    <defs>
                        <filter id="filter3" x="0" y="0" width="178" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dy="6" />
                        <feGaussianBlur stdDeviation="6" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1187_14810" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1187_14810" result="shape" />
                        </filter>
                    </defs>
                    </svg>
    
                    <div class="max-w-sm mx-auto">
                    <p class="mt-2 font-medium text-gray-800 dark:text-neutral-200">
                        Tidak ada jadwal ujian
                    </p>
                    <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                        Seluruh jadwal ujian akan ditampilkan disini.
                    </p>
                    </div>
                </div>
                <!-- End Empty State -->
            @endif

        </div>
        <!-- End Card Grid -->
    </div>
    <!-- End Cards -->
</div>
</x-app>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const countdownButtons = document.querySelectorAll('.cdPrepare');

        countdownButtons.forEach(btn => {
            const startTime = new Date(btn.dataset.start.replace(' ', 'T')).getTime();

            const timer = setInterval(() => {
                const now = Date.now();
                let diff = Math.floor((startTime - now) / 1000);

                if (diff <= 0) {
                    setTimeout(() => {
                        btn.innerHTML = 'Loading...';
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 1000)
                        clearInterval(timer);
                        return;
                    }, 1000);
                }

                const minutes = Math.floor(diff / 60);
                const seconds = diff % 60;

                btn.innerHTML =
                    String(minutes).padStart(2, '0') + ':' +
                    String(seconds).padStart(2, '0');

            }, 1000);
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const countdowns = document.querySelectorAll(".cdRun");

        if (!countdowns.length) return;

        function updateCountdowns() {
            const now = new Date().getTime();
            let shouldReload = false;

            countdowns.forEach(el => {
                const endTime = new Date(el.dataset.countdown.replace(' ', 'T')).getTime();
                let diff = Math.floor((endTime - now) / 1000);

                if (diff <= 0) {
                    el.textContent = "00:00";
                    shouldReload = true;
                    return;
                }

                const minutes = Math.floor(diff / 60);
                const seconds = diff % 60;

                el.textContent =
                    String(minutes).padStart(2, '0') + ":" +
                    String(seconds).padStart(2, '0');
            });

            if (shouldReload) {
                window.location.reload(true);
            }
        }

        updateCountdowns();
        setInterval(updateCountdowns, 1000);
    });
</script>