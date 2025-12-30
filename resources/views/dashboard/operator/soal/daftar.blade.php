@php
    $page = 'soal';
    $page_title = 'daftar soal';
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
        <div class="flex flex-col 2xl:flex-row gap-5">
            <!-- Card -->
            <div class="h-full w-full 2xl:w-3xl flex flex-col gap-y-5">
                <!-- Header -->
                <div class="flex gap-x-3">
                <div class="grow">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                        {{ ucfirst($page_title) }}
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                        Manajemen daftar soal dan jawbaban
                    </p>
                </div>
                </div>
                <!-- End Header -->

                <!-- Card -->
                <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="py-2 px-2">
                    <div class="p-4 space-y-5">
                        <div class="sm:col-span-9">
                            <!-- Select -->
                            <select id="ddSoal" data-hs-select='{
                                "isSelectedOptionOnTop": true,
                                "hasSearch": true,
                                "searchPlaceholder": "Cari paket soal...",
                                "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                                "searchWrapperClasses": "bg-white p-2 -mx-1 -mt-1 sticky top-0 dark:bg-neutral-900",
                                "placeholder": "Pilih paket soal...",
                                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"\" data-title></span></button>",
                                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-3.5 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                                "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"text-sm font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div><div class=\"text-xs text-gray-500 dark:text-neutral-500 \" data-description></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                            }' name="id_paket_soal" class="dd-soal hidden">
                            <option value="">Choose</option>
                            @foreach ($data as $item)
                              <option value="{{ $item['id_paket_soal'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                            </select>
                            <!-- End Select -->

                        </div>
                        <!-- End Col -->
                    </div>
                    </div>

                    <!-- Footer -->
                    <div class="p-6 pt-0 flex justify-end gap-x-2">
                    <div class="w-full flex justify-end items-center gap-x-2">
                        <button onclick="openSoal(this)" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                        Pilih paket soal
                        </button>
                    </div>
                    </div>
                    <!-- End Footer -->
                </div>
                <!-- End Card -->
            </div>
            <!-- End Card -->
    
            <!-- Card -->
            <div class="h-full size-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div id="loadList" class="hidden">
                <!-- Header -->
                <div class="p-5 pb-4 grid grid-cols-6 items-center gap-x-4">
                  <div class="col-span-3">
                    <h2 id="title" class="inline-block font-semibold text-lg text-gray-800 dark:text-neutral-200">
                      TITLE
                    </h2>
                    <p id="subtitle" class="text-sm text-gray-500 dark:text-neutral-500">
                      SUBTITLE
                    </p>
                  </div>
                  <!-- End Col -->
      
                  <div class="flex justify-end items-center col-span-3 gap-x-1">
                    <a id="addhref" href="#" type="button" class="py-2 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                      <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-fading-plus-icon lucide-circle-fading-plus"><path d="M12 2a10 10 0 0 1 7.38 16.75"/><path d="M12 8v8"/><path d="M16 12H8"/><path d="M2.5 8.875a10 10 0 0 0-.5 3"/><path d="M2.83 16a10 10 0 0 0 2.43 3.4"/><path d="M4.636 5.235a10 10 0 0 1 .891-.857"/><path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/></svg>  
                      <span class="text-xs hidden lg:block">Tambah soal</span> 
                    </a>
                    <a id="dethref" href="#" type="button" class="py-2 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                      <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-list-icon lucide-layout-list"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><path d="M14 4h7"/><path d="M14 9h7"/><path d="M14 15h7"/><path d="M14 20h7"/></svg>
                      <span class="text-xs hidden lg:block">Detail</span> 
                    </a>      
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Header -->
      
                <!-- Body -->
                <div class="h-full p-5 pt-0">
                  <div>
                      <!-- Card List Group -->
                      <div id="renderContainer" class="space-y-5">
                          <!-- Diisi js -->
                      </div>
                      <!-- End Card List Group -->
                  </div>
                </div>
                <!-- End Body -->
              </div>
              
              <div id="initList" class="">
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
                      Silahkan memilih paket soal
                    </p>
                    <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                      Seluruh soal akan ditampilkan disini setelah Anda memilih paket soal pada daftar yang telah disediakan.
                    </p>
                  </div>
                </div>
              </div>

              <div id="nullList" class="hidden">
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
                      Tambah soal untuk menampilkan daftar soal.
                    </p>
                  </div>
                </div>
              </div>

              <div id="loadingList" class="hidden">
                <div class="p-5 min-h-150 flex flex-col justify-center items-center text-center">
                  <div class="max-w-sm mx-auto">                    
                    <p class="mt-2 font-medium text-gray-800 dark:text-neutral-200">
                      Memuat soal...
                    </p>
                    <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                      Refresh halaman jika proses ini terlalu lama.
                    </p>
                  </div>
                </div>
              </div>

              <div id="errorList" class="hidden">
                <div class="p-5 min-h-150 flex flex-col justify-center items-center text-center">
                  <svg class="w-48 mx-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>

                  <div class="max-w-sm mx-auto">
                    <p class="mt-2 font-medium text-gray-800 dark:text-neutral-200">
                      Terjadi kesalahan saat memuat soal
                    </p>
                    <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                      Silahkan coba lagi muat soal atau refresh halaman.
                    </p>
                  </div>
                </div>
              </div>

            </div>
            <!-- End Card -->
        </div>
    </div>
</x-app-op>
<script>
async function openSoal(btn) {
    const select = document.getElementById('ddSoal')
    const initList = document.getElementById('initList')
    const loadingList = document.getElementById('loadingList')
    const loadList = document.getElementById('loadList')
    const errorList = document.getElementById('errorList')
    const nullList = document.getElementById('nullList')

    const id = select.value
    if (!id) return

    btn.disabled = true
    btn.innerHTML = 'Loading...'

    initList.classList.add('hidden')
    loadList.classList.add('hidden')
    errorList.classList.add('hidden')
    nullList.classList.add('hidden')
    loadingList.classList.remove('hidden')

    try {
        const response = await fetch(`/operator/soal/load/${id}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })

        if (!response.ok) {
            let message = 'Request gagal'

            try {
                const err = await response.json()
                message = err.message ?? message
            } catch (_) {}

            throw {
                status: response.status,
                message
            }
        }

        const result = await response.json()

        loadList.classList.remove('hidden')
        renderSoal(result.data)

    } catch (error) {
        console.error('FETCH ERROR:', error)
        errorList.classList.remove('hidden')

    } finally {
        btn.disabled = false
        btn.innerHTML = 'Pilih paket soal'
        loadingList.classList.add('hidden')
    }
}

function renderSoal(data){
  const container = document.getElementById('renderContainer')

  document.getElementById('title').innerText = data.nama
  document.getElementById('subtitle').innerText = data.deskripsi
  document.getElementById('addhref').href = `/operator/soal/${data.id_paket_soal}/create`
  document.getElementById('dethref').href = `/operator/soal/${data.id_paket_soal}`

  container.innerHTML = "";

  if(data.soal.length == 0){
    document.getElementById('nullList').classList.remove('hidden')
  } else {
    data.soal.forEach((soal, index) => {
      renderSoalCard(container, soal.id_paket_soal, soal.id_soal, soal, soal.tipe_jawaban, soal.pilihan)
    });
  }

}

function renderSoalCard(container, idPaketSoal, idSoal, soal, tipeJawban, jawaban){
    const index = container.children.length + 1;
    const sumBenar = jawaban.filter(p => p.benar === 1).length
    const jawabanPG = 
      jawaban
      .map((pilihan) => {
        if (pilihan.benar === 1) {
          return `
            <div class="mt-2 flex items-start gap-x-2 text-green-600 dark:text-green-500">
                <h4 class="text-xs mt-0.5">
                    <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big-icon lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
                </h4>
                <div class="escape-container text-xs">
                ${pilihan.teks_jawaban}
                </div>
            </div>
          `
        }

        return `
          <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
              <h4 class="text-xs mt-0.5">
                  <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-icon lucide-circle"><circle cx="12" cy="12" r="10"/></svg>
              </h4>
              <div class="escape-container text-xs">
              ${pilihan.teks_jawaban}
              </div>
          </div>
        `
      })
      .join('')

    const jawabanEssai =
      `
        <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
              <h4 class="text-xs mt-0.5">
                  <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-text-select-icon lucide-text-select"><path d="M14 21h1"/><path d="M14 3h1"/><path d="M19 3a2 2 0 0 1 2 2"/><path d="M21 14v1"/><path d="M21 19a2 2 0 0 1-2 2"/><path d="M21 9v1"/><path d="M3 14v1"/><path d="M3 9v1"/><path d="M5 21a2 2 0 0 1-2-2"/><path d="M5 3a2 2 0 0 0-2 2"/><path d="M7 12h10"/><path d="M7 16h6"/><path d="M7 8h8"/><path d="M9 21h1"/><path d="M9 3h1"/></svg>
              </h4>
            <p class="text-xs">
            Jawaban essai
            </p>
        </div>
      `

    const jawabanNull =
      `
        <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
            <p class="text-xs">
            Tidak ada pilihan jawaban
            </p>
        </div>
      `

    const alertSoal = 
        `
          <span class="flex absolute top-0 end-0 size-3 -mt-1.5 -me-1.5">
              <span class="animate-ping absolute inline-flex size-full rounded-full bg-red-400 opacity-75 dark:bg-red-600"></span>
              <span class="relative inline-flex rounded-full size-3 bg-red-500"></span>
          </span>
        `

    const jawabanLoad = tipeJawban == 1 ? jawabanPG || jawabanNull : jawabanEssai
    const alertLoad = sumBenar != 1 ? tipeJawban == 1 ? alertSoal : '' : '';
    
    container.innerHTML += `<div class="p-4 relative flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                              <div class="grid lg:grid-cols-12 gap-y-2 lg:gap-y-0 gap-x-4">
                                  <div class="lg:col-span-7">
                                      <div class="q-escape-container grid text-sm gap-x-1 text-gray-800 dark:text-neutral-200">
                                        ${soal.teks_soal}
                                      </div>
                                  </div>
  
                                  <div class="lg:col-span-3"> 
                                    ${jawabanLoad}
                                  </div>
  
                                  <div class="lg:col-span-2">
                                      <div class="flex lg:flex-col justify-end items-center gap-2 border-t border-gray-200 lg:border-t-0 pt-3 lg:pt-0 dark:border-neutral-700">
                                          <div class="lg:order-2 lg:ms-auto">
                                              <a href="/operator/soal/${idPaketSoal}/${idSoal}" type="button" class="relative py-2 px-3 text-xs inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-chhdl">
                                                  Edit soal
                                                  ${alertLoad}
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <span class="absolute top-0 start-0 inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-gray-600 text-white">${index}</span>
                          </div>`

}
</script>