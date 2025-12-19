@php
    $page = 'peserta';
    $page_title = 'peserta';
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Table Card -->
      <div class="p-5 space-y-4 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Nav Tab -->
        <nav class="flex justify-between gap-1 relative after:absolute after:bottom-0 after:inset-x-0" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
          <p class="flex flex-col text-lg font-medium text-gray-900 dark:text-neutral-100">
            Daftar {{ $page_title }}
                <span class="text-xs font-normal text-gray-500 dark:text-neutral-500">Total <span class="font-semibold text-gray-900 dark:text-neutral-100">{{ count($data) }}</span> data {{ $page_title }}</span>
          </p>

          <div class="flex justify-end items-center gap-x-2">
            <!-- Import Dropdown -->
            <div class="hs-dropdown [--auto-close:true] relative inline-flex">
              <!-- Filter Button -->
              <button id="hs-pro-dptied" type="button" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-plus-icon lucide-circle-fading-plus"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="M12 8v8"/><path d="M16 12H8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg>
                Tambah <span class="hidden sm:block">{{ $page_title }}</span>
              </button>
              <!-- End Filter Button -->

              <!-- Dropdown -->
              <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-40 transition-[opacity,margin] duration opacity-0 hidden z-10 bg-white rounded-xl shadow-xl dark:bg-neutral-900" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-dptied">
                <div class="p-1">
                  <a href="{{ route('operator.'.$page.'.create') }}" class="w-full flex gap-x-3 py-1.5 px-2 rounded-lg text-[13px] text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-300 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" data-hs-overlay="#hs-pro-dicm">
                    <svg class="shrink-0 mt-0.5 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Tambah manual
                  </a>
                  <button disabled type="button" class="w-full flex gap-x-3 py-1.5 px-2 rounded-lg text-[13px] text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-300 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" data-hs-overlay="#hs-pro-decm">
                    <svg class="shrink-0 mt-0.5 size-3.5" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.0324 1.91994H9.45071C9.09999 1.91994 8.76367 2.05926 8.51567 2.30725C8.26767 2.55523 8.12839 2.89158 8.12839 3.24228V8.86395L20.0324 15.8079L25.9844 18.3197L31.9364 15.8079V8.86395L20.0324 1.91994Z" fill="#21A366"></path>
                        <path d="M8.12839 8.86395H20.0324V15.8079H8.12839V8.86395Z" fill="#107C41"></path>
                        <path d="M30.614 1.91994H20.0324V8.86395H31.9364V3.24228C31.9364 2.89158 31.7971 2.55523 31.5491 2.30725C31.3011 2.05926 30.9647 1.91994 30.614 1.91994Z" fill="#33C481"></path>
                        <path d="M20.0324 15.8079H8.12839V28.3736C8.12839 28.7243 8.26767 29.0607 8.51567 29.3087C8.76367 29.5567 9.09999 29.6959 9.45071 29.6959H30.6141C30.9647 29.6959 31.3011 29.5567 31.549 29.3087C31.797 29.0607 31.9364 28.7243 31.9364 28.3736V22.7519L20.0324 15.8079Z" fill="#185C37"></path>
                        <path d="M20.0324 15.8079H31.9364V22.7519H20.0324V15.8079Z" fill="#107C41"></path>
                        <path opacity="0.1" d="M16.7261 6.87994H8.12839V25.7279H16.7261C17.0764 25.7269 17.4121 25.5872 17.6599 25.3395C17.9077 25.0917 18.0473 24.756 18.0484 24.4056V8.20226C18.0473 7.8519 17.9077 7.51616 17.6599 7.2684C17.4121 7.02064 17.0764 6.88099 16.7261 6.87994Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M15.7341 7.87194H8.12839V26.7199H15.7341C16.0844 26.7189 16.4201 26.5792 16.6679 26.3315C16.9157 26.0837 17.0553 25.748 17.0564 25.3976V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M15.7341 7.87194H8.12839V24.7359H15.7341C16.0844 24.7349 16.4201 24.5952 16.6679 24.3475C16.9157 24.0997 17.0553 23.764 17.0564 23.4136V9.19426C17.0553 8.84386 16.9157 8.50818 16.6679 8.26042C16.4201 8.01266 16.0844 7.87299 15.7341 7.87194Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                        <path opacity="0.2" d="M14.7421 7.87194H8.12839V24.7359H14.7421C15.0924 24.7349 15.4281 24.5952 15.6759 24.3475C15.9237 24.0997 16.0633 23.764 16.0644 23.4136V9.19426C16.0633 8.84386 15.9237 8.50818 15.6759 8.26042C15.4281 8.01266 15.0924 7.87299 14.7421 7.87194Z" class="og88b dark:fill-neutral-200" fill="currentColor"></path>
                        <path d="M1.51472 7.87194H14.7421C15.0927 7.87194 15.4291 8.01122 15.6771 8.25922C15.925 8.50722 16.0644 8.84354 16.0644 9.19426V22.4216C16.0644 22.7723 15.925 23.1087 15.6771 23.3567C15.4291 23.6047 15.0927 23.7439 14.7421 23.7439H1.51472C1.16402 23.7439 0.827672 23.6047 0.579686 23.3567C0.3317 23.1087 0.192383 22.7723 0.192383 22.4216V9.19426C0.192383 8.84354 0.3317 8.50722 0.579686 8.25922C0.827672 8.01122 1.16402 7.87194 1.51472 7.87194Z" fill="#107C41"></path>
                        <path d="M3.69711 20.7679L6.90722 15.794L3.96694 10.8479H6.33286L7.93791 14.0095C8.08536 14.3091 8.18688 14.5326 8.24248 14.68H8.26328C8.36912 14.4407 8.47984 14.2079 8.5956 13.9817L10.3108 10.8479H12.4822L9.46656 15.7663L12.5586 20.7679H10.2473L8.3932 17.2959C8.30592 17.148 8.23184 16.9927 8.172 16.8317H8.14424C8.09016 16.9891 8.01824 17.1399 7.92998 17.2811L6.02236 20.7679H3.69711Z" fill="white"></path>
                    </svg>
                    Import data
                  </button>
                </div>
              </div>
              <!-- End Dropdown -->
            </div>
            <!-- End Import Dropdown -->
          </div>
        </nav>
        <!-- End Nav Tab -->

        @if (empty($data))
            <!-- Empty State -->
            <div class="p-5 min-h-150 flex flex-col justify-center items-center text-center">
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
                  Belum ada data {{ $page_title }}
                </p>
                <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                  Tambahkan {{ $page_title }} baru untuk mulai mengelola.
                </p>
              </div>
            </div>
            <!-- End Empty State -->
        @else            
          <!-- Search Group -->
          <div class="grid md:grid-cols-2 gap-y-2 md:gap-y-0 md:gap-x-5">
            <div>
              <!-- Search Input -->
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                  <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                  </svg>
                </div>
                <input id="search-input" type="text" class="py-1 sm:py-1.5 ps-10 pe-8 block w-full bg-gray-100 border-transparent rounded-lg sm:text-sm focus:bg-white focus:ring-0 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:bg-neutral-800 dark:focus:ring-neutral-600" placeholder="Cari {{ $page_title }}..." autocomplete="off">
                <div class="hidden absolute inset-y-0 end-0 flex items-center z-20 pe-1">
                  <button type="button" class="inline-flex shrink-0 justify-center items-center size-6 rounded-full text-gray-500 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10" />
                      <path d="m15 9-6 6" />
                      <path d="m9 9 6 6" />
                    </svg>
                  </button>
                </div>
              </div>
              <!-- End Search Input -->
            </div>
            <!-- End Col -->
          </div>
          <!-- End Search Group -->

          <!-- Datatable -->
          <div>
            <!-- Tab Content -->
            <div>
              <!-- Table Section -->
              <div class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <div class="min-w-full inline-block align-middle">
                  <!-- Table -->
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead>
                      <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                        <th scope="col" class="px-3 py-2.5 text-start">
                          <p class="py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              No.
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Username
                            </p>
                        </th>

                        <th scope="col" class="min-w-72">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Nama
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Password
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Kelas
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Ruangan
                            </p>
                        </th>

                        <th scope="col" class="min-w-50">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Diperbarui
                            </p>
                        </th>

                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <tbody id="data-container" class="divide-y divide-gray-200 dark:divide-neutral-700">
                      <!--  -->
                    </tbody>

                    <tfoot id="skeleton" class="divide-y divide-gray-200 dark:divide-neutral-700">
                      <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>
                          
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>
                          
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </td>
                      </tr>
                      
                      <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>
                          
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </td>
                      </tr>

                      <tr class="divide-x divide-gray-200 dark:divide-neutral-700"> 
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>
                          
                          <td class="size-px whitespace-nowrap px-3 py-3">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <span class="text-sm text-gray-600 dark:text-neutral-400">
                              <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </span>
                          </td>

                          <td class="size-px whitespace-nowrap px-4 py-1">
                          <div class="h-4 bg-gray-200 rounded-full dark:bg-neutral-700"></div>
                          </td>
                      </tr>
                    </tfoot>
                    <tfoot id="end" class="divide-y divide-gray-200 dark:divide-neutral-700">
                      <!-- state -->
                    </tfoot>
                  </table>
                  <!-- End Table -->
                </div>
              </div>
              <!-- End Table Section -->
            </div>
            <!-- End Tab Content -->

            <!-- Tab Content -->
            <div id="hs-pro-tabs-dut-validaccounts" class="hidden" role="tabpanel" aria-labelledby="hs-pro-tabs-dut-item-validaccounts">
              <!-- Empty State -->
              <div class="p-5 min-h-125 flex flex-col justify-center items-center text-center">
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
                    Your data will appear here soon.
                  </p>
                  <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                    In the meantime, you can create new custom insights to monitor your most important metrics.
                  </p>
                </div>
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-2 focus:ring-blue-500" data-hs-overlay="#hs-pro-empty">
                  <svg class="hidden sm:block shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                  </svg>Add user
                </button>
              </div>
              <!-- End Empty State -->
            </div>
            <!-- End Tab Content -->

            <!-- Tab Content -->
            <div id="hs-pro-tabs-dut-fakeaccounts" class="hidden" role="tabpanel" aria-labelledby="hs-pro-tabs-dut-item-fakeaccounts">
              <!-- Empty State -->
              <div class="p-5 min-h-125 flex flex-col justify-center items-center text-center">
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
                  <g filter="url(#filter4)">
                    <rect x="12" y="6" width="154" height="40" rx="8" fill="currentColor" class="fill-white dark:fill-neutral-800" shape-rendering="crispEdges" />
                    <rect x="12.5" y="6.5" width="153" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/60" shape-rendering="crispEdges" />
                    <rect x="20" y="14" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700 " />
                    <rect x="52" y="17" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700" />
                    <rect x="52" y="29" width="106" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700" />
                  </g>
                  <defs>
                    <filter id="filter4" x="0" y="0" width="178" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
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
                    Your data will appear here soon.
                  </p>
                  <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                    In the meantime, you can create new custom insights to monitor your most important metrics.
                  </p>
                </div>
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-2 focus:ring-blue-500" data-hs-overlay="#hs-pro-empty">
                  <svg class="hidden sm:block shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                  </svg>Add user
                </button>
              </div>
              <!-- End Empty State -->
            </div>
            <!-- End Tab Content -->
          </div>
          <!-- End Datatable -->
        @endif
      </div>
      <!-- End Table Card -->
    </div>
</x-app-op>

@if (!empty($data))
<script>
    let offset = 0;
    const limit = 100;
    let isLoading = false;
    let allDataLoaded = false;
    let searchQuery = '';
    let debounceTimer = null;

    function loadMoreData(reset = false) {
        if (reset) {
            offset = 0;
            allDataLoaded = false;
            document.getElementById('data-container').innerHTML = '';
            document.getElementById('end').classList.add('hidden');
        }

        if (isLoading || allDataLoaded) return;
        isLoading = true;
        document.getElementById('skeleton').classList.remove('hidden');

        searchQuery = document.getElementById('search-input').value;
        fetch(`{{ route('operator.'.$page.'.load') }}?offset=${offset}&limit=${limit}&search=${encodeURIComponent(searchQuery)}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('skeleton').classList.add('hidden');

                if (data.length === 0) {
                    allDataLoaded = true;
                    document.getElementById('end').classList.remove('hidden');
                    isLoading = false;
                    if (offset === 0) {
                        allDataLoaded = false;
                    }
                    return;
                }

                const container = document.getElementById('data-container');
                data.forEach((item, index) => {
                    const number = offset + index + 1;

                    container.insertAdjacentHTML('beforeend', `
                        <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                            <td class="size-px whitespace-nowrap px-3 py-3">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${number}
                                </span>
                            </td>

                            <td class="size-px whitespace-nowrap px-3 py-3">
                                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                ${item.username}
                                </span>
                            </td>
        
                            <td class="size-px px-4 py-1 relative group pe-20 lg:pe-24">
                                <div class="w-full flex items-center gap-x-3">
                                <div class="grow">
                                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    ${item.nama}
                                    </span>
                                </div>
                                </div>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${item.unhashed_password}
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${item?.kelas?.nama ?? '-'}
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${item?.ruangan?.nama ?? '-'} 
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                    ${formatTanggal(item.updated_at)}
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">            
                                <div class="relative inline-flex">
                                <a href="{{ route('operator.'.$page) }}/${item.id_peserta}" type="button" class="size-7 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings"><path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                </div>
                            </td>
                        </tr>
                    `);
                });

                offset += data.length;
                isLoading = false;
            })
            .catch(() => {
                document.getElementById('skeleton').classList.add('hidden');
                isLoading = false;
            });
    }
    loadMoreData()

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const windowHeight = window.innerHeight;
        const docHeight = document.documentElement.scrollHeight;

        if (scrollTop + windowHeight >= docHeight - 500) {
            loadMoreData();
        }
    });
    document.getElementById('search-input').addEventListener('input', (e) => {
        const value = e.target.value.trim();

        clearTimeout(debounceTimer);

        if (value.length >= 1 || value.length === 0) {
            debounceTimer = setTimeout(() => {
                searchQuery = value;
                loadMoreData(true);
            }, 100);
        }
    });
</script>
@endif