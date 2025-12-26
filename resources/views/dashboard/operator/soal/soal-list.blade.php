@php
    $page = 'soal';
    $page_title = 'daftar soal';
    $jmlBenar = 0; // untuk kebutuhan alert pada tombol edit soal
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Card Form -->
      <div class="flex flex-col gap-y-5 max-w-3xl mx-auto">
        <!-- Header -->
        <div class="flex gap-x-3">
          <div class="grow">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                {{ $data['nama'] }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-neutral-500">
               Halaman detail seluruh butir soal
            </p>
          </div>
        </div>
        <!-- End Header -->

        <!-- Card -->
        <div class="h-full size-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">           
          <div>  
            <!-- Header -->
            <div class="p-5 pb-4 grid grid-cols-6 items-center gap-x-4">
              <div class="flex items-center col-span-2 gap-x-1">
                <a href="{{ route('operator.soal') }}" type="button" class="py-2 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                  <span class="text-xs">Kembali</span> 
                </a>  
              </div>
              <div class="flex justify-end items-center col-span-4 gap-x-1">
                <a href="{{ route('operator.soal.create', $data['id_paket_soal']) }}" type="button" class="py-2 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-plus-icon lucide-circle-fading-plus"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="M12 8v8"/><path d="M16 12H8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg>  
                  <span class="text-xs hidden lg:block">Tambah soal</span> 
                </a> 
                <!-- Print Dropdown -->
                <div class="hs-dropdown [--auto-close:inside] [--placement:bottom-right] relative inline-flex">
                  <button id="hs-pro-dbrrtchdd" type="button" class="py-2 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                      <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer-icon lucide-printer"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"/><rect x="6" y="14" width="12" height="8" rx="1"/></svg>
                      <span class="text-xs hidden lg:block">Cetak soal</span> 
                  </button>
  
                  <!-- Print Dropdown -->
                  <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-20 bg-white rounded-xl shadow-xl dark:bg-neutral-900" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-dbrrtchdd">
                    <div class="p-1">
                      <div class="py-2 px-3">
                        <span class="block font-semibold text-gray-800 dark:text-neutral-200">
                          Cetak soal
                        </span>
                        <span class="block text-xs text-gray-500 dark:text-neutral-500">
                          Konfirmasi aksi 
                        </span>
                      </div>
  
                      <div class="flex justify-between items-center py-2 px-3 cursor-pointer rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-700">
                        <label for="as" class="flex flex-1 items-center gap-x-3 cursor-pointer text-sm text-gray-800 dark:text-neutral-300">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dices-icon lucide-dices"><rect width="12" height="12" x="2" y="10" rx="2" ry="2"/><path d="m17.92 14 3.5-3.5a2.24 2.24 0 0 0 0-3l-5-4.92a2.24 2.24 0 0 0-3 0L10 6"/><path d="M6 18h.01"/><path d="M10 14h.01"/><path d="M15 6h.01"/><path d="M18 9h.01"/></svg>
                          Acak soal
                        </label>
                        <input type="checkbox" onchange="cetak()" class="shrink-0 size-3.5 border-gray-300 rounded-sm text-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="as">
                      </div>
                      <div class="flex justify-between items-center py-2 px-3 cursor-pointer rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-700">
                        <label for="j" class="flex flex-1 items-center gap-x-3 cursor-pointer text-sm text-gray-800 dark:text-neutral-300">
                          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                          Sertakan jawaban
                        </label>
                        <input type="checkbox" onchange="cetak()" class="shrink-0 size-3.5 border-gray-300 rounded-sm text-blue-500 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="j">
                      </div>
  
                      <a id="cetak" href="{{ route('operator.soal.print', $data['id_paket_soal']) }}?pj=true&as=false&j=false" target="_blank" class="w-full mt-1 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                        Cetak
                      </a>
                    </div>
                  </div>
                  <!-- End Print Dropdown -->
                </div>
                <!-- End Print Dropdown -->
  
              </div>
              <!-- End Col -->
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="h-full p-5 pt-0">
              <div>
                @if (empty($data['soal']))
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
                          Daftar soal kosong
                        </p>
                        <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                          Tambah soal untuk mulai mengelola.
                        </p>
                      </div>
                    </div>
                    <!-- End Empty State -->
                @else                    
                  @foreach ($data['soal'] as $item)                      
                  <!-- Card List Group -->
                  <div class="pt-5 space-y-5">

                      <div class="p-4 relative flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                          <div>
                              <div>
                                  <div class="q-escape-container prose max-w-none dark:prose-invert text-sm grid gap-y-1 text-gray-800 dark:text-neutral-200">
                                    {!! $item['teks_soal'] !!}
                                  </div>
                              </div>

                              <div>
                                @if ($item['tipe_jawaban'] == 1)
                                  @if (empty($item['pilihan']))
                                    <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
                                        <p class="text-xs">
                                          Tidak ada pilihan jawaban
                                        </p>
                                    </div>
                                  @else                                
                                    @foreach ($item['pilihan'] as $pj)
                                      @php
                                          $jmlBenar += (int)$pj['benar']
                                          // untuk kebutuhan alert pada tombol edit soal
                                      @endphp
                                      @if ($pj['benar'] === 1)
                                          <div class="mt-2 flex items-start gap-x-2 text-green-600 dark:text-green-500">
                                            <h4 class="text-xs mt-0.5">
                                                <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                                            </h4>
                                            <div class="escape-container grid gap-y-1 text-xs">
                                              {!! $pj['teks_jawaban'] !!}
                                            </div>
                                        </div>
                                      @else          
                                        <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
                                            <h4 class="text-xs mt-0.5">
                                                <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-icon lucide-circle"><circle cx="12" cy="12" r="10"/></svg>
                                            </h4>
                                            <div class="escape-container grid gap-y-1 text-xs">
                                              {!! $pj['teks_jawaban'] !!}
                                            </div>
                                        </div>
                                      @endif
                                    @endforeach
                                  @endif
                                @elseif($item['tipe_jawaban'] == 2)
                                  <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
                                      <h4 class="text-xs mt-0.5">
                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-text-select-icon lucide-text-select"><path d="M14 21h1"/><path d="M14 3h1"/><path d="M19 3a2 2 0 0 1 2 2"/><path d="M21 14v1"/><path d="M21 19a2 2 0 0 1-2 2"/><path d="M21 9v1"/><path d="M3 14v1"/><path d="M3 9v1"/><path d="M5 21a2 2 0 0 1-2-2"/><path d="M5 3a2 2 0 0 0-2 2"/><path d="M7 12h10"/><path d="M7 16h6"/><path d="M7 8h8"/><path d="M9 21h1"/><path d="M9 3h1"/></svg>
                                      </h4>
                                      <p class="text-xs">
                                        Jawaban essai
                                      </p>
                                  </div>
                                @else
                                  <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
                                     <h4 class="text-xs mt-0.5">
                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                                      </h4>
                                      <p class="text-xs">
                                        Tipe jawaban tidak diketahui
                                      </p>
                                  </div>
                                @endif
                              </div>

                              <div>
                                  <div class="flex lg:flex-col justify-end items-center gap-2 pt-3 lg:pt-0">
                                      <div class="lg:order-2 lg:ms-auto">
                                          <a href="{{ route('operator.soal.setting', [$data['id_paket_soal'], $item['id_soal']]) }}" type="button" class="relative py-2 px-3 text-xs inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-chhdl">
                                              Edit soal
                                              @if ($item['tipe_jawaban'] == 1)          
                                                @if ( $jmlBenar != 1 )
                                                  <span class="flex absolute top-0 end-0 size-3 -mt-1.5 -me-1.5">
                                                      <span class="animate-ping absolute inline-flex size-full rounded-full bg-red-400 opacity-75 dark:bg-red-600"></span>
                                                      <span class="relative inline-flex rounded-full size-3 bg-red-500"></span>
                                                  </span>
                                                @endif
                                                @php $jmlBenar = 0 @endphp {{-- reset jumlah --}}
                                              @endif
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <span class="absolute top-0 start-0 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-gray-600 text-white">{{ $loop->iteration }}</span>
                      </div>
                      
                  </div>
                  <!-- End Card List Group -->
                  @endforeach
                @endif
              </div>
            </div>
            <!-- End Body -->
          </div>
        </div>
        <!-- End Card -->

        
      </div>
      <!-- End Card Form -->
    </div>
</x-app-op>
<script>
  function cetak(){
    const btn = document.getElementById('cetak')
    const as = document.getElementById('as').checked
    const j = document.getElementById('j').checked

    console.group('data print')
    console.log('Acak soal: ' + as)
    console.log('Sertakan jawaban: ' + j)
    console.groupEnd()
    btn.href = `{{ route('operator.soal.print', $data['id_paket_soal']) }}?as=${as}&j=${j}`
  }
</script>