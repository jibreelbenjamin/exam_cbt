@php
    $role = session('role');
@endphp
@props(['page' => false])
<x-head :page='$page'>
    <header class="flex flex-col z-50">
        <nav class="bg-white border-b border-stone-200 dark:bg-neutral-800 dark:border-neutral-700">
            <div class="max-w-[85rem] flex justify-between basis-full items-center w-full mx-auto py-2.5 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div>
                <!-- Logo -->
                <div class="flex items-center gap-x-2.5 rounded-md text-xl font-semibold">
                    <img class="w-8 h-auto" src="{{ asset('images/fav.png') }}" alt="Logo">
                    <p class="hidden sm:flex flex-col leading-tight text-gray-800 dark:text-white">
                        <span class="text-sm">{{ env('APP_ECHO_NAME') }}</span>
                        <span class="text-[10px] text-gray-500 dark:text-neutral-500">{{ env('SCHOOL_NAME') }}</span>
                    </p>
                </div>
                <!-- Logo -->
                </div>
            </div>

            <div class="flex justify-end items-center gap-x-2">
                <span id="clock" class="px-2 sm:px-0 text-sm text-gray-800 dark:text-white">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="4" cy="12" r="3" fill="currentColor"><animate id="SVGKiXXedfO" attributeName="cy" begin="0;SVGgLulOGrw.end+0.25s" calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12"/></circle><circle cx="12" cy="12" r="3" fill="currentColor"><animate attributeName="cy" begin="SVGKiXXedfO.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12"/></circle><circle cx="20" cy="12" r="3" fill="currentColor"><animate id="SVGgLulOGrw" attributeName="cy" begin="SVGKiXXedfO.begin+0.2s" calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12"/></circle></svg>
                </span>

                <div class="hidden sm:block border-e border-gray-200 w-px h-6 mx-1.5 dark:border-neutral-700"></div>

                <!-- Account Dropdown -->
                <div class="hs-dropdown inline-flex   [--strategy:absolute] [--auto-close:inside] [--placement:bottom-right] relative text-start">
                <button id="hs-pro-dnad" type="button" class="inline-flex shrink-0 items-center gap-x-3 text-start rounded-full focus:outline-hidden" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <span class="flex flex-col justify-center items-center size-9.5 lg:size-8 bg-white border border-stone-200 text-stone-500 rounded-full shadow-2xs dark:bg-neutral-950 dark:border-neutral-800 dark:text-neutral-400">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
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
                            {{ '@'.Auth::guard($role)->user()->username }} - {{ Auth::guard('peserta')->user()->kelas->nama }}
                        </p>
                        </div>
                    </button>
                    </div>
                    <div class="p-1">
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
        </nav>
    </header>

    <main id="content" class="pb-14 sm:pb-16">
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            {{ $slot }}
        </div>
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