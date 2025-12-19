@php
    $page = 'ujian';
    $page_title = 'tambah ujian';
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Card Form -->
      <div class="flex flex-col gap-y-5 max-w-xl mx-auto">
        <!-- Header -->
        <div class="flex gap-x-3">
          <div class="grow">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                {{ ucfirst($page_title) }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-neutral-500">
               Membuat {{ $page }} baru ke dalam sistem
            </p>
          </div>
        </div>
        <!-- End Header -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ route('operator.'.$page.'.create.action') }}" method="post">
            @csrf
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
                    <input type="text" name="nama" value="{{ old('nama') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan nama ujian" autocomplete="off">
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
                      <option value="1" {{ ((old('token') == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta akan mendapatkan token dari operator untuk memulai ujian.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-play-icon lucide-play\"><path d=\"M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z\"/></svg>"
                        }'>Aktif</option>
                      <option value="0" {{ ((old('token') == '0') ? 'selected=""' : '') }} data-hs-select-option='{
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
                      <option value="1" {{ ((old('status') == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta dapat memulai ujian.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-play-icon lucide-play\"><path d=\"M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z\"/></svg>"
                        }'>Aktif</option>
                      <option value="0" {{ ((old('status') == '0') ? 'selected=""' : '') }} data-hs-select-option='{
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
                    <input type="number" name="durasi" value="{{ old('durasi') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan durasi ujian (menit)" autocomplete="off">
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
                    <input id="jadwal_mulai" type="datetime-local" name="jadwal_mulai" value="{{ old('jadwal_mulai') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Tentukan jadwal mulai ujian" autocomplete="off">
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
                    <input id="jadwal_selesai" type="datetime-local" name="jadwal_selesai" value="{{ old('jadwal_selesai') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Tentukan jadwal mulai ujian" autocomplete="off">
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
                      <option value="1" {{ ((old('acak_soal') == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Setiap peserta urutan soal akan diacak.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-play-icon lucide-play\"><path d=\"M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z\"/></svg>"
                        }'>Aktif</option>
                      <option value="0" {{ ((old('acak_soal') == '0') ? 'selected=""' : '') }} data-hs-select-option='{
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
                        "apiSelectedValues": ["{{ old('id_paket_ujian') }}"],
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
                        "placeholder": "{{ (old('id_paket_ujian') ? 'Paket ujian terpilih' : 'Pilih paket ujian...') }}",
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
                  Tambah
                </button>
              </div>
            </div>
            <!-- End Footer -->
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