@php
    $page = 'ujian';
    $page_title = 'ujian';
    $action_param = $data['id_ujian'];
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

        @if ($data['jadwal_mulai'] <= date('Y-m-d H:i:s') && $data['jadwal_selesai'] >= date('Y-m-d H:i:s'))
        <!-- Alert -->
        <div class="bg-yellow-50 border border-yellow-200 text-sm text-yellow-800 rounded-lg p-4 dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500" role="alert" tabindex="-1" aria-labelledby="hs-with-description-label">
          <div class="flex">
            <div class="shrink-0">
              <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
              </svg>
            </div>
            <div class="ms-4">
              <h3 id="hs-with-description-label" class="text-sm font-semibold">
                Ujian sedang berjalan!
              </h3>
              <div class="mt-1 text-sm text-yellow-700">
                Saat ini tidak dapat mengubah beberapa pengaturan ujian karena ujian sedang berlangsung.
              </div>
            </div>
          </div>
        </div>
        <!-- End Alert -->
        @endif

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
                      Nama ujian
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input type="text" name="nama" value="{{ $data['nama'] }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan nama ujian" autocomplete="off">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Token masuk
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <select data-hs-select='{
                      "placeholder": "Pilih kondisi...",
                      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                      "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex items-center text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                      "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                      "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                      "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div></div><div class=\"mt-1.5 text-sm text-gray-500 dark:text-neutral-500 \" data-description></div></div>",
                      "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' name="token" class="hidden">
                      <option value="">Choose</option>
                      <option value="1" {{ (($data['token'] == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta akan mendapatkan token dari operator untuk memulai ujian.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-play-icon lucide-play\"><path d=\"M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z\"/></svg>"
                        }'>Aktif</option>
                      <option value="0" {{ (($data['token'] == '0') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta dapat memulai ujian tanpa token.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-pause-icon lucide-pause\"><rect x=\"14\" y=\"3\" width=\"5\" height=\"18\" rx=\"1\"/><rect x=\"5\" y=\"3\" width=\"5\" height=\"18\" rx=\"1\"/></svg>"
                        }'>Nonaktif</option>
                    </select>
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Status
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <select data-hs-select='{
                      "placeholder": "Pilih kondisi...",
                      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                      "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex items-center text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                      "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                      "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                      "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div></div><div class=\"mt-1.5 text-sm text-gray-500 dark:text-neutral-500 \" data-description></div></div>",
                      "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' name="status" class="hidden">
                      <option value="">Choose</option>
                      <option value="1" {{ (($data['status'] == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta dapat memulai ujian.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-play-icon lucide-play\"><path d=\"M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z\"/></svg>"
                        }'>Aktif</option>
                      <option value="0" {{ (($data['status'] == '0') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta tidak dapat memulai ujian.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-pause-icon lucide-pause\"><rect x=\"14\" y=\"3\" width=\"5\" height=\"18\" rx=\"1\"/><rect x=\"5\" y=\"3\" width=\"5\" height=\"18\" rx=\"1\"/></svg>"
                        }'>Nonaktif</option>
                    </select>
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Durasi
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input type="number" name="durasi" value="{{ $data['durasi'] }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan durasi ujian (menit)" autocomplete="off">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Jadwal mulai
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input id="jadwal_mulai" type="datetime-local" name="jadwal_mulai" value="{{ $data['jadwal_mulai'] }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan jadwal ujian (menit)" autocomplete="off">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Jadwal selesai
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input id="jadwal_selesai" type="datetime-local" name="jadwal_selesai" value="{{ $data['jadwal_selesai'] }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan jadwal ujian (menit)" autocomplete="off">
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Paket soal
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
                        "apiSelectedValues": ["{{ $data['paket_soal']['id_paket_soal'] }}"],
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
                        "placeholder": "{{ ($data['paket_soal']['nama'] ? $data['paket_soal']['nama'] : 'Pilih paket soal...') }}",
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

                 <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Acak soal
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <select data-hs-select='{
                      "placeholder": "Pilih kondisi...",
                      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                      "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex items-center text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                      "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                      "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                      "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div></div><div class=\"mt-1.5 text-sm text-gray-500 dark:text-neutral-500 \" data-description></div></div>",
                      "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' name="acak_soal" class="hidden">
                      <option value="">Choose</option>
                      <option value="1" {{ ((($data['acak_soal']) == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Setiap peserta urutan soal akan diacak.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-play-icon lucide-play\"><path d=\"M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z\"/></svg>"
                        }'>Aktif</option>
                      <option value="0" {{ ((($data['acak_soal']) == '0') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Seluruh peserta mendapatkan urutan soal yang sama.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-pause-icon lucide-pause\"><rect x=\"14\" y=\"3\" width=\"5\" height=\"18\" rx=\"1\"/><rect x=\"5\" y=\"3\" width=\"5\" height=\"18\" rx=\"1\"/></svg>"
                        }'>Nonaktif</option>
                    </select>
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Paket ujian (opsional)
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <!-- Select -->
                    <select data-hs-select='{
                        "apiUrl": "{{ env('API_BASE_URL') }}/paket-ujian/select",
                        "apiQuery": "",
                        "apiSearchQueryKey": "search",
                        "apiDataPart": "data",
                        "apiSelectedValues": ["{{ $data['paket_ujian']['id_paket_ujian'] ?? '' }}"],
                        "apiFieldsMap": {
                          "id": "id_paket_ujian",
                          "val": "id_paket_ujian",
                          "title": "nama",
                          "description": "deskripsi"
                        },

                        "isSelectedOptionOnTop": true,
                        "hasSearch": true,
                        "searchPlaceholder": "Cari paket ujian...",
                        "searchClasses": "block w-full sm:text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-1.5 sm:py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 -mt-1 sticky top-0 dark:bg-neutral-900",
                        "placeholder": "{{ ($data['paket_ujian']['nama'] ?? 'Pilih paket ujian...') }}",
                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 ps-3.5 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                        "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                        "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"text-sm font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div><div class=\"text-xs text-gray-500 dark:text-neutral-500 \" data-description></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                      }' name="id_paket_ujian" class="hidden">
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
  document.getElementById('jadwal_mulai').addEventListener('click', function () {
    this.showPicker();
  });
  document.getElementById('jadwal_selesai').addEventListener('click', function () {
    this.showPicker();
  });
</script>

<!-- Confirm Modal -->
  <div id="hs-scale-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-label">
      <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
          <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
              <div class="p-7">
                  <div class="flex justify-between items-center  ">
                      <h3 id="hs-scale-confirm-modal-label" class="font-bold text-gray-800 dark:text-white">
                      Hapus {{ $page }}?
                      </h3>
                  </div>
                  <div class="pb-3 overflow-y-auto">
                      <p class="mt-1 text-gray-800 dark:text-neutral-400">
                      Yakin ingin menghapus data {{ $page }} ini secara permanen? Mungkin akan memengaruhi data lainnya. Aksi ini tidak dapat dikembalikan.
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