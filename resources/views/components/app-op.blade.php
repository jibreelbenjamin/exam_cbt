@php
    $role = session('role');
    $classPageActive = 'flex gap-x-3 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700 bg-gray-100 dark:bg-neutral-700';
    $classPageInactive = 'flex gap-x-3 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700';
@endphp
@props(['page' => false])
<x-head :page='$page'>
    <header class="lg:ms-65 fixed top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex justify-between basis-full items-center w-full py-2.5 px-2 sm:px-5">
            <div class="flex items-center lg:hidden">
                <div class="lg:hidden">
                <!-- Sidebar Toggle -->
                <button type="button" class="w-7 h-9.5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-pro-sidebar" aria-label="Toggle navigation" data-hs-overlay="#hs-pro-sidebar">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13" />
                    </svg>
                </button>
                <!-- End Sidebar Toggle -->
                </div>
            </div>

            <span class="text-sm text-gray-500 dark:text-neutral-500 hidden lg:inline-block">
                {{ env('APP_ECHO_NAME') }}
            </span>

            <div class="flex justify-end items-center gap-x-2">
                <span id="clock" class="text-sm text-gray-800 dark:text-white">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="4" cy="12" r="3" fill="currentColor"><animate id="SVGKiXXedfO" attributeName="cy" begin="0;SVGgLulOGrw.end+0.25s" calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12"/></circle><circle cx="12" cy="12" r="3" fill="currentColor"><animate attributeName="cy" begin="SVGKiXXedfO.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12"/></circle><circle cx="20" cy="12" r="3" fill="currentColor"><animate id="SVGgLulOGrw" attributeName="cy" begin="SVGKiXXedfO.begin+0.2s" calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12"/></circle></svg>
                </span>

                <div class="hs-tooltip [--placement:bottom] inline-block">
                    <button onclick="toggleFullscreen()" class="py-2 px-3 rounded-lg text-sm text-gray-800 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-300">
                        <span id="fsBtn"><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-expand-icon lucide-expand"><path d="m15 15 6 6"/><path d="m15 9 6-6"/><path d="M21 16v5h-5"/><path d="M21 8V3h-5"/><path d="M3 16v5h5"/><path d="m3 21 6-6"/><path d="M3 8V3h5"/><path d="M9 9 3 3"/></svg></span>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700" role="tooltip">
                            Toogle Fullscreen
                        </span>
                    </button>
                </div>

                <div class="hidden sm:block border-e border-gray-200 w-px h-6 mx-1.5 dark:border-neutral-700"></div>

                <!-- Account Dropdown -->
                <div class="hs-dropdown inline-flex   [--strategy:absolute] [--auto-close:inside] [--placement:bottom-right] relative text-start">
                <button id="hs-pro-dnad" type="button" class="inline-flex shrink-0 items-center gap-x-3 text-start rounded-full focus:outline-hidden" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <img class="shrink-0 size-9.5 rounded-full dark:brightness-400" src="{{ asset('images/pfp.svg') }}" alt="Avatar">
                </button>

                <!-- Account Dropdown -->
                <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-20 bg-white rounded-xl shadow-xl dark:bg-neutral-900" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-dnad">
                    <div class="p-1 border-b border-gray-200 dark:border-neutral-800">
                    <button class="py-2 px-3 w-full gap-x-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <div class="grow text-left">
                        <span class="text-sm font-semibold text-gray-800 dark:text-neutral-300">
                            {{ Auth::guard($role)->user()->nama }}
                        </span>
                        <p class="text-xs text-gray-500 dark:text-neutral-500">
                            {{ '@'.Auth::guard($role)->user()->username }}
                        </p>
                        </div>
                    </button>
                    </div>
                    <div class="p-1">
                    <button class="w-full flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-form-upd-pass-modal" data-hs-overlay="#hs-form-upd-pass-modal">
                        <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key-round-icon lucide-key-round"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"/><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"/></svg>
                        Reset password
                    </button>
                    <button class="w-full flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-animation-modal" data-hs-overlay="#hs-scale-animation-modal">
                        <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                        Keluar dari Aplikasi
                    </button>
                    </div>
                    <div class="px-4 py-3.5 border-y border-gray-200 dark:border-neutral-800">
                    <!-- Switch/Toggle -->
                    <div class="flex flex-wrap justify-between items-center gap-2">
                        <label for="hs-pro-dnaddm" class="flex-1 cursor-pointer text-sm text-gray-800 dark:text-neutral-300">Mode gelap</label>
                        <label for="hs-pro-dnaddm" class="relative inline-block w-11 h-6 cursor-pointer">
                        <input data-hs-theme-switch type="checkbox" id="hs-pro-dnaddm" class="peer sr-only">
                        <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-blue-600 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-sm !transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                        </label>
                    </div>
                    <!-- End Switch/Toggle -->
                    </div>
                </div>
                <!-- End Account Dropdown -->
                </div>
                <!-- End Account Dropdown -->
            </div>
        </div>
    </header>

    <aside id="hs-pro-sidebar" class="hs-overlay [--auto-close:lg]
    hs-overlay-open:translate-x-0
    -translate-x-full transition-all duration-300 transform
    w-65 h-full
    hidden
    fixed inset-y-0 start-0 z-60
    bg-white border-e border-gray-200
    lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
    dark:bg-neutral-800 dark:border-neutral-700" tabindex="-1" aria-label="Sidebar">
        <div class="relative flex flex-col h-full max-h-full pt-3">
        <header class="h-11.5 ps-5 pe-2 lg:ps-8 flex items-center gap-x-1">
            <!-- Logo -->
            <a class="flex items-center gap-x-3 rounded-md text-xl font-semibold" href="{{ route('operator.home') }}" aria-label="Preline">
                <img class="w-10 h-auto" src="{{ asset('images/fav.png') }}" alt="Logo">
                <p class="flex flex-col leading-tight text-gray-800 dark:text-white">
                    {{ env('APP_ECHO_NAME') }}
                    <span class="text-[10px] text-gray-500 dark:text-neutral-500">{{ env('SCHOOL_NAME') }}</span>
                </p>
            </a>
            <!-- End Logo -->

            <div class="lg:hidden ms-auto">
            <!-- Sidebar Close -->
            <button type="button" class="w-6 h-7 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-sidebar">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="7 8 3 12 7 16" />
                <line x1="21" x2="11" y1="12" y2="12" />
                <line x1="21" x2="11" y1="6" y2="6" />
                <line x1="21" x2="11" y1="18" y2="18" />
                </svg>
            </button>
            <!-- End Sidebar Close -->
            </div>
        </header>

        <!-- Content -->
        <div class="mt-3 h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <!-- Nav -->
            <nav class="hs-accordion-group pb-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="flex flex-col gap-y-1">

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'home') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.home') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-school-icon lucide-school"><path d="M14 21v-3a2 2 0 0 0-4 0v3"/><path d="M18 5v16"/><path d="m4 6 7.106-3.79a2 2 0 0 1 1.788 0L20 6"/><path d="m6 11-3.52 2.147a1 1 0 0 0-.48.854V19a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a1 1 0 0 0-.48-.853L18 11"/><path d="M6 5v16"/><circle cx="12" cy="9" r="2"/></svg>
                    Dashboard
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'ruangan') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.ruangan') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open-icon lucide-door-open"><path d="M11 20H2"/><path d="M11 4.562v16.157a1 1 0 0 0 1.242.97L19 20V5.562a2 2 0 0 0-1.515-1.94l-4-1A2 2 0 0 0 11 4.561z"/><path d="M11 4H8a2 2 0 0 0-2 2v14"/><path d="M14 12h.01"/><path d="M22 20h-3"/></svg>
                    Ruangan
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'kelas') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.kelas') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dock-icon lucide-dock"><path d="M2 8h20"/><rect width="20" height="16" x="2" y="4" rx="2"/><path d="M6 16h12"/></svg>
                    Kelas
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'paket-ujian') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.invalid') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive-icon lucide-archive"><rect width="20" height="5" x="2" y="3" rx="1"/><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/><path d="M10 12h4"/></svg>
                    Paket ujian
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'ujian') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.ujian') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-fold-icon lucide-calendar-fold"><path d="M3 20a2 2 0 0 0 2 2h10a2.4 2.4 0 0 0 1.706-.706l3.588-3.588A2.4 2.4 0 0 0 21 16V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"/><path d="M15 22v-5a1 1 0 0 1 1-1h5"/><path d="M8 2v4"/><path d="M16 2v4"/><path d="M3 10h18"/></svg>
                    Ujian
                </a>
                </li>
                <!-- End Link -->
                
                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'paket-soal') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.paket-soal') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-marked-icon lucide-book-marked"><path d="M10 2v8l3-3 3 3V2"/><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                    Paket soal
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'manajemen-soal') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.invalid') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-text-icon lucide-book-text"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/><path d="M8 11h8"/><path d="M8 7h6"/></svg>
                    Manajemen soal
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'laporan-ujian') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.invalid') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text-icon lucide-file-text"><path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                    Laporan ujian
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'file-manager') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.invalid') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-open-icon lucide-folder-open"><path d="m6 14 1.5-2.9A2 2 0 0 1 9.24 10H20a2 2 0 0 1 1.94 2.5l-1.54 6a2 2 0 0 1-1.95 1.5H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H18a2 2 0 0 1 2 2v2"/></svg>
                    File manager
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'peserta') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.peserta') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Data peserta
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'guru') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.guru') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-star-icon lucide-user-star"><path d="M16.051 12.616a1 1 0 0 1 1.909.024l.737 1.452a1 1 0 0 0 .737.535l1.634.256a1 1 0 0 1 .588 1.806l-1.172 1.168a1 1 0 0 0-.282.866l.259 1.613a1 1 0 0 1-1.541 1.134l-1.465-.75a1 1 0 0 0-.912 0l-1.465.75a1 1 0 0 1-1.539-1.133l.258-1.613a1 1 0 0 0-.282-.866l-1.156-1.153a1 1 0 0 1 .572-1.822l1.633-.256a1 1 0 0 0 .737-.535z"/><path d="M8 15H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/></svg>
                    Data guru
                </a>
                </li>
                <!-- End Link -->

                <!-- Link -->
                <li class="px-2 lg:px-5">
                <a class="{{ ($page == 'admin') ? $classPageActive : $classPageInactive }}" href="{{ route('operator.admin') }}">
                    <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-cog-icon lucide-user-cog"><path d="M10 15H6a4 4 0 0 0-4 4v2"/><path d="m14.305 16.53.923-.382"/><path d="m15.228 13.852-.923-.383"/><path d="m16.852 12.228-.383-.923"/><path d="m16.852 17.772-.383.924"/><path d="m19.148 12.228.383-.923"/><path d="m19.53 18.696-.382-.924"/><path d="m20.772 13.852.924-.383"/><path d="m20.772 16.148.924.383"/><circle cx="18" cy="15" r="3"/><circle cx="9" cy="7" r="4"/></svg>
                    Data admin
                </a>
                </li>
                <!-- End Link -->

            </ul>
            </nav>
            <!-- End Nav -->
        </div>
        <!-- End Content -->

        </div>
    </aside>

    <main id="content" class="lg:ps-65 pt-15 pb-5">
        {{ $slot }}
    </main>
</x-head>

<!-- Logout Modal -->
<div id="hs-scale-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-7">
                <div class="flex justify-between items-center  ">
                    <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Keluar?
                    </h3>
                </div>
                <div class="pb-3 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                    Yakin keluar dari aplikasi? Anda dapat masuk kembali dihalaman login.
                    </p>
                </div>
                <div class="flex justify-end items-center gap-x-2  ">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-animation-modal">
                    Kembali
                    </button>
                    <a href="{{ route('logout') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                    Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Logout Modal -->

<!-- Form Update Password Modal -->
<div id="hs-form-upd-pass-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-form-input-pnjmn-modal-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-7">
                <div class="flex justify-between">
                    <h3 id="hs-form-upd-pass-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Update password akun
                    <p class="text-xs font-medium text-gray-500">Memperbarui kunci masuk akun anda.</p>
                    </h3>
                </div>
                <div class="py-5 overflow-y-auto">
                    <div class="grid gap-y-4">
                        <!-- Form Group -->
                        <div>
                            <label for="password_new" class="block text-sm mb-2 dark:text-white">Password baru (min.6)</label>
                            <div class="relative">
                            <input type="password" id="password_new" placeholder="Buat password baru" class="apperance-none py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <button type="button" data-hs-toggle-password='{
                                "target": "#password_new"
                            }' class="absolute inset-y-0 end-0 flex items-center z-20 px-5 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                            <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                            </svg>
                            </button>
                            </div>
                            <p id="password_new_label" class="hidden flex items-center gap-x-1 ml-1 mt-1 text-xs text-red-500 dark:text-red-600">
                                <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                <span><!-- --></span>
                            </p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <label for="password_confirm" class="block text-sm mb-2 dark:text-white">Konfirmasi password baru</label>
                            <div class="relative">
                            <input type="text" id="password_confirm" placeholder="Ketik ulang password baru" class="apperance-none py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <button type="button" data-hs-toggle-password='{
                                "target": "#password_confirm"
                            }' class="absolute inset-y-0 end-0 flex items-center z-20 px-5 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                            <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                            </svg>
                            </button>
                            </div>
                            <p id="password_confirm_label" class="hidden flex items-center gap-x-1 ml-1 mt-1 text-xs text-red-500 dark:text-red-600">
                                <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                <span><!-- --></span>
                            </p>
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div>
                            <label for="password_old" class="block text-sm mb-2 dark:text-white">Password lama</label>
                            <div class="relative">
                            <input type="text" id="password_old" placeholder="Masukan password lama" class="apperance-none py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-400 dark:placeholder-neutral-500">
                            <button type="button" data-hs-toggle-password='{
                                "target": "#password_old"
                            }' class="absolute inset-y-0 end-0 flex items-center z-20 px-5 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
                            <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                            </svg>
                            </button>
                            </div>
                            <p id="password_old_label" class="hidden flex items-center gap-x-1 ml-1 mt-1 text-xs text-red-500 dark:text-red-600">
                                <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                <span><!-- --></span>
                            </p>
                        </div>
                        <!-- End Form Group -->
                        <p id="error_updpass" class="text-sm text-red-500"></p>
                    </div>
                </div>
                <div class="flex justify-between items-center gap-x-2  ">
                    <button id="btn-close_updpass" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-form-upd-pass-modal">
                    Tutup
                    </button>
                    <button id="btn-send_updpass" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Update password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Form Update Password Modal -->

<script>
    function toggleFullscreen() {
        let btn = document.getElementById('fsBtn');

        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
            localStorage.setItem("fullscreen", "on");
            btn.innerHTML = '<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shrink-icon lucide-shrink"><path d="m15 15 6 6m-6-6v4.8m0-4.8h4.8"/><path d="M9 19.8V15m0 0H4.2M9 15l-6 6"/><path d="M15 4.2V9m0 0h4.8M15 9l6-6"/><path d="M9 4.2V9m0 0H4.2M9 9 3 3"/></svg>';
        } else {
            document.exitFullscreen();
            localStorage.setItem("fullscreen", "off");
            btn.innerHTML = '<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-expand-icon lucide-expand"><path d="m15 15 6 6"/><path d="m15 9 6-6"/><path d="M21 16v5h-5"/><path d="M21 8V3h-5"/><path d="M3 16v5h5"/><path d="m3 21 6-6"/><path d="M3 8V3h5"/><path d="M9 9 3 3"/></svg>';
        }
    }

    function formatTanggal(dateString) {
        const date = new Date(dateString);

        const namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        const hari   = String(date.getDate()).padStart(2, '0');
        const bulan  = namaBulan[date.getMonth()];
        const tahun  = date.getFullYear();

        const jam    = String(date.getHours()).padStart(2, '0');
        const menit  = String(date.getMinutes()).padStart(2, '0');
        const detik  = String(date.getSeconds()).padStart(2, '0');

        return `${hari} ${bulan} ${tahun}, ${jam}:${menit}:${detik}`;
    }
</script>