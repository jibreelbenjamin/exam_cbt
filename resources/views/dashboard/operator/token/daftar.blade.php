@php
    $page = 'token';
    $page_title = 'token';
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
            <div class="relative inline-flex">
              <!-- Filter Button -->
              <a href="{{ route('operator.token.create') }}" class="py-1.5 sm:py-2 px-2.5 inline-flex items-center gap-x-1.5 text-sm sm:text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-plus-icon lucide-circle-fading-plus"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="M12 8v8"/><path d="M16 12H8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg>
                Generate <span class="hidden sm:block">{{ $page_title }}</span>
              </a>
              <!-- End Filter Button -->
            </div>
            <button id="btnConfirm" class="hidden" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal" data-hs-overlay="#hs-scale-confirm-modal"></button>
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
                              Token
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Masa aktif
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Status
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Ujian
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Penanggung jawab
                            </p>
                        </th>

                        <th scope="col">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Kadaluarsa
                            </p>
                        </th>

                        <th scope="col" class="min-w-50">
                            <p class="px-5 py-2.5 text-start flex items-center gap-x-1 text-sm text-nowrap font-normal text-gray-500 dark:text-neutral-500">
                              Waktu generate
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
                    function badgeStatus(key){
                      const now = new Date()
                      const expired = new Date(key.replace(' ', 'T'));
                      return now < expired
                          ? `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Aktif</span>`
                          : now > expired
                          ? `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Kadaluarsa</span>`
                          : `<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-50 text-gray-500 dark:bg-white/10 dark:text-white">Unknown</span>`;
                    }

                    container.insertAdjacentHTML('beforeend', `
                        <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                            <td class="size-px whitespace-nowrap px-3 py-3">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${number}
                                </span>
                            </td>

                            <td class="size-px whitespace-nowrap px-3 py-3">
                                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                ${item.token.toUpperCase()}
                                </span>
                            </td>

                            <td class="size-px whitespace-nowrap px-3 py-3">
                                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                ${item.durasi} Menit
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${badgeStatus(item.token_expired_at)}
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${item?.ujian?.nama ?? 'Semua ujian'}
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${item.admin.nama}
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                ${formatTanggal(item.token_expired_at)} 
                                </span>
                            </td>
        
                            <td class="size-px whitespace-nowrap px-4 py-1">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                    ${formatTanggal(item.created_at)}
                                </span>
                            </td>

                            <td class="size-px whitespace-nowrap px-4 py-1">            
                                <div class="relative inline-flex">
                                <button data-id="${item.id_token}" data-label="${item.token}" type="button" class="btn-hapus-token size-7 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-red-700 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>
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

    document.addEventListener('click', function (e) {
      const btn = e.target.closest('.btn-hapus-token')
      if (!btn) return

      const label = btn.dataset.label
      const id = btn.dataset.id
      const action = `/operator/token/delete/${id}`

      document.getElementById('btnConfirm').click()

      document.getElementById('label').innerText = label
      document.getElementById('form').action = action
    })
</script>

<!-- Confirm Modal -->
  <div id="hs-scale-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-label">
      <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
          <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
              <div class="p-7">
                  <div class="flex justify-between items-center  ">
                      <h3 id="hs-scale-confirm-modal-label" class="font-bold text-gray-800 dark:text-white">
                      Hapus {{ $page_title }}?
                      </h3>
                  </div>
                  <div class="pb-3 overflow-y-auto">
                      <p class="mt-1 text-gray-800 dark:text-neutral-400">
                      Yakin ingin menghapus riwayat {{ $page_title }} <strong id="label">Nama</strong> secara permanen? Aksi ini tidak dapat dikembalikan.
                      </p>
                  </div>
                  <div class="flex justify-end items-center gap-x-2  ">
                      <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal">
                      Kembali
                      </button>
                      <form id="form" method="post" action="">
                          @csrf
                          @method('DELETE')
                          <button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                          Hapus
                          </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- End Confirm Modal -->
@endif