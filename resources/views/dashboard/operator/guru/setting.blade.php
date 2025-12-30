@php
    $page = 'guru';
    $page_title = 'guru';
    $action_param = $data['id_guru'];
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Card Form -->
      <div class="flex flex-col pt-3 gap-y-5 max-w-xl mx-auto">
        <!-- Header -->
        <div class="flex gap-x-3">
          <div class="grow">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                Pengaturan {{ $page_title }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-neutral-500">
               Halaman akses pengaturan {{ $page_title }}
            </p>
          </div>
        </div>
        <!-- End Header -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ route('operator.'.$page.'.update.action', $action_param) }}" method="post">
            @csrf
            @method('PUT')
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Username
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input type="text" name="username" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan username" value="{{ $data['username'] }}" autocomplete="off">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Nama guru
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input type="text" name="nama" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan nama guru" value="{{ $data['nama'] }}" autocomplete="off">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->
              </div>
            </div>

            <!-- Footer -->
            <div class="p-6 pt-0 flex justify-end gap-x-2">
              <div class="w-full flex justify-end items-center gap-x-2">
                <a href="{{ route('operator.'.$page) }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                  Kembali
                </a>

                <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                  Perbarui
                </button>
              </div>
            </div>
            <!-- End Footer -->
          </form>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ route('operator.'.$page.'.update-password.action', $action_param) }}" method="post">
            @csrf
            @method('PUT')
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Password baru
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9 relative">
                    <input id="hs-toggle-password" type="password" name="password" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan password baru" autocomplete="off">
                    <button type="button" data-hs-toggle-password='{
                        "target": "#hs-toggle-password"
                      }' class="absolute inset-y-0 end-0 flex items-center z-20 px-4 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
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
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Konfirmasi
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9 relative">
                    <input id="hs-toggle-password-confirm" type="password" name="password_confirmation" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan konfirmasi password baru" autocomplete="off">
                    <button type="button" data-hs-toggle-password='{
                        "target": "#hs-toggle-password-confirm"
                      }' class="absolute inset-y-0 end-0 flex items-center z-20 px-4 cursor-pointer text-gray-400 rounded-e-md focus:outline-hidden focus:text-blue-600 dark:text-neutral-600 dark:focus:text-blue-500">
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
                  <!-- End Col -->
                </div>
                <!-- End Grid -->
              </div>
            </div>

            <!-- Footer -->
            <div class="p-6 pt-0 flex justify-end gap-x-2">
              <div class="w-full flex justify-end items-center gap-x-2">
                <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                  Perbarui password
                </button>
              </div>
            </div>
            <!-- End Footer -->
          </form>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ route('operator.akses-paket-soal.create.action') }}" method="post">
            @csrf
            <input type="hidden" name="id_guru" value="{{ $action_param }}">
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Daftar paket soal
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <!-- Select -->
                    <select data-hs-select='{
                        "apiUrl": "{{ env('API_BASE_URL') }}/paket-soal/select",
                        "apiQuery": "",
                        "apiSearchQueryKey": "search",
                        "apiDataPart": "data",
                        "apiSelectedValues": ["{{ old('id_paket_soal') }}"],
                        "apiFieldsMap": {
                          "id": "id_paket_soal",
                          "val": "id_paket_soal",
                          "title": "nama",
                          "description": "deskripsi"
                        },

                        "isSelectedOptionOnTop": true,
                        "hasSearch": true,
                        "searchPlaceholder": "Cari paket soal...",
                        "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 -mt-1 sticky top-0 dark:bg-neutral-900",
                        "placeholder": "{{ (old('id_paket_soal') ? 'Paket soal terpilih' : 'Pilih paket soal...') }}",
                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-3.5 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                        "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"text-sm font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div><div class=\"text-xs text-gray-500 dark:text-neutral-500 \" data-description></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                      }' name="id_paket_soal" class="hidden">
                      <option value="">Choose</option>
                    </select>
                    <!-- End Select -->
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->
              </div>
            </div>

            <!-- Footer -->
            <div class="p-6 pt-0 flex justify-end gap-x-2">
              <div class="w-full flex justify-end items-center gap-x-2">
                <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                  Beri akses paket
                </button>
              </div>
            </div>
            <!-- End Footer -->
          </form>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="p-6 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class=" w-full flex justify-between">
                <div class="w-full text-sm">
                    <p class="font-semibold text-gray-800 dark:text-neutral-200">Daftar paket soal</p>
                    <p class="text-xs text-gray-500 dark:text-neutral-500">{{ empty($data['akses_paket_soal']) ? 'Tidak ada paket soal' : 'Total '.count($data['akses_paket_soal']).' data paket soal' }}</p>
                </div>
            </div>

            <!-- List Group -->
            <ul>

              @if (empty($data['akses_paket_soal']))
                <div class="py-3">
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

                  <div class="max-w-sm mx-auto text-center">
                    <p class="mt-2 font-medium text-gray-800 dark:text-neutral-200">
                      Tidak ada paket soal tercatat
                    </p>
                    <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                      Daftar data paket soal akan tampil disini
                    </p>
                  </div>
                </div>
              @else
                @foreach ($data['akses_paket_soal'] as $aps)
                    @php
                        $akses = collect($data['akses_paket_soal'])
                                ->firstWhere('id_akses_paket_soal', $aps['id_akses_paket_soal']);

                        $idAPS = $akses['id_akses_paket_soal'] ?? null;
                    @endphp

                    <li class="py-3 border-b last:border-b-0 border-gray-200 dark:border-neutral-700">
                        <div class="flex gap-x-3">
                            <div class="grow">
                                <a class="font-medium text-sm text-gray-800 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 dark:text-neutral-200 dark:hover:text-blue-500 dark:focus:text-blue-500"
                                  href="{{ route('operator.paket-soal.setting', $aps['id_paket_soal']) }}">{{ $aps['paket_soal']['nama'] }}</a>
                                <p class="text-xs text-gray-500 dark:text-neutral-500">
                                    {{ $aps['paket_soal']['deskripsi'] }}
                                </p>
                            </div>

                            <div>
                                <button data-id="{{ $idAPS }}" data-label="{{ $aps['paket_soal']['nama'] }}" class="btn-hapus-aps py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-red-700 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal-akses" data-hs-overlay="#hs-scale-confirm-modal-akses">
                                    Cabut akses
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
              @endif

            </ul>
            <!-- End List Group -->
          </form>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-6 w-full flex justify-between">
                <div class="w-full text-sm">
                    <p class="font-semibold text-gray-800 dark:text-neutral-200">Hapus data</p>
                    <p class="text-xs text-gray-500 dark:text-neutral-500">Menghapus permanen data {{ $page_title }}</p>
                </div>
              <div>
                <button class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-red-700 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal" data-hs-overlay="#hs-scale-confirm-modal">
                  Hapus
                </button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Card -->
      </div>
      <!-- End Card Form -->
    </div>
</x-app-op>

<script>
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-hapus-aps')
    if (!btn) return

    const label = btn.dataset.label
    const id = btn.dataset.id
    const action = `/operator/akses-paket-soal/delete/${id}`

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
                      Yakin ingin menghapus data {{ $page_title }} ini secara permanen? Mungkin akan memengaruhi data lainnya. Aksi ini tidak dapat dikembalikan.
                      </p>
                  </div>
                  <div class="flex justify-end items-center gap-x-2  ">
                      <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal">
                      Kembali
                      </button>
                      <form method="post" action="{{ route('operator.'.$page.'.delete.action', $action_param) }}">
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

<!-- Confirm Modal Akses -->
<div id="hs-scale-confirm-modal-akses" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-akses-label">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-7">
                <div class="flex justify-between items-center  ">
                    <h3 id="hs-scale-confirm-modal-akses-label" class="font-bold text-gray-800 dark:text-white">
                    Cabut akses paket soal?
                    </h3>
                </div>
                <div class="pb-3 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                    Yakin ingin mencabut akses <strong id="label">Nama</strong> pada guru ini? Aksi ini tidak dapat dikembalikan.
                    </p>
                </div>
                <div class="flex justify-end items-center gap-x-2  ">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal-akses">
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
<!-- End Confirm Modal Akses -->