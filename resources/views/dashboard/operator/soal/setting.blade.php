@php
    $page = 'soal';
    $page_title = 'soal';
    $action_param = $data['id_soal'];
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Card Form -->
      <div class="flex flex-col gap-y-5 max-w-3xl mx-auto">
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
        @if ($data['tipe_jawaban'] == 1)            
          @if (array_sum(array_column($data['pilihan'], 'benar')) > 1 || array_sum(array_column($data['pilihan'], 'benar')) < 1 )
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
                  Peringatan untuk format pilihan jawaban!
                </h3>
                <div class="mt-1 text-sm text-yellow-700">
                  @if (array_sum(array_column($data['pilihan'], 'benar')) > 1)
                    Pilihan jawaban benar terdeteksi lebih dari 1 pilihan. Tentukan minimal 1 jawaban benar dari seluruh daftar pilihan yang tersedia.
                  @elseif (empty($data['pilihan']))
                    Saat ini soal tidak memiliki pilihan jawaban. Tambah pilihan dan tentukan minimal 1 jawaban benar.
                  @elseif (array_sum(array_column($data['pilihan'], 'benar')) < 1)
                    Saat ini seluruh butir soal dalam kondisi salah, sehingga peserta tidak dapat mendapatkan poin saat menjawab soal ini. Tentukan 1 jawaban benar dari seluruh daftar pilihan yang tersedia.  
                  @endif
                </div>
              </div>
            </div>
          </div>
          <!-- End Alert -->
          @endif
        @endif

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ route('operator.soal.update.action', [$data['id_paket_soal'], $data['id_soal']]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- WYSIWYG Editor -->
                <div id="editor">
                  {!! $data['teks_soal'] !!}
                </div>
                <p class="flex items-start lg:items-center ml-1 gap-x-1.5 mt-2 text-xs text-gray-500 dark:text-neutral-500" id="hs-input-helper-text">
                  <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                  Upload gambar direkomendasikan dibawah 1,5 MB.
                </p>
                <input type="hidden" name="teks_soal" id="contentEditor" value="{{ old('teks_soal') }}">
                <!-- End WYSIWYG Editor -->

                <!-- Grid -->
                <div class="pt-5 grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Tipe soal
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <select data-hs-select='{
                      "placeholder": "Pilih tipe soal...",
                      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
                      "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex items-center text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-1 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-hidden dark:focus:ring-1 dark:focus:ring-neutral-600",
                      "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                      "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                      "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"font-semibold text-gray-800 dark:text-neutral-200 \" data-title></div></div><div class=\"mt-1.5 text-sm text-gray-500 dark:text-neutral-500 \" data-description></div></div>",
                      "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' name="tipe_jawaban" class="hidden">
                      <option value="">Choose</option>
                      <option value="1" {{ (($data['tipe_jawaban'] == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta menjawab berdasarkan pilihan yang tersedia.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-circle-slash-icon lucide-circle-slash\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><line x1=\"9\" x2=\"15\" y1=\"15\" y2=\"9\"/></svg>"
                        }'>Pilihan ganda</option>
                      <option value="2" {{ (($data['tipe_jawaban'] == '2') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta mengetik jawaban.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-text-select-icon lucide-text-select\"><path d=\"M14 21h1\"/><path d=\"M14 3h1\"/><path d=\"M19 3a2 2 0 0 1 2 2\"/><path d=\"M21 14v1\"/><path d=\"M21 19a2 2 0 0 1-2 2\"/><path d=\"M21 9v1\"/><path d=\"M3 14v1\"/><path d=\"M3 9v1\"/><path d=\"M5 21a2 2 0 0 1-2-2\"/><path d=\"M5 3a2 2 0 0 0-2 2\"/><path d=\"M7 12h10\"/><path d=\"M7 16h6\"/><path d=\"M7 8h8\"/><path d=\"M9 21h1\"/><path d=\"M9 3h1\"/></svg>"
                        }'>Essai</option>
                    </select>
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->
              </div>
            </div>

            <!-- Footer -->
            <div class="p-6 pt-0 flex justify-end gap-x-2">
              <div class="w-full flex justify-end items-center gap-x-2">
                <a href="{{ route('operator.'.$page.'.list', $data['id_paket_soal']) }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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

        @if ($data['tipe_jawaban'] == 2)
            <!-- Card -->
            <div class="p-6 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <!-- List Group -->
                <ul>
                  <div class="py-3">
                    <svg class="w-48 mx-auto my-4 text-gray-800 dark:text-neutral-200" width="178" height="90" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-text-select-icon lucide-text-select"><path d="M14 21h1"/><path d="M14 3h1"/><path d="M19 3a2 2 0 0 1 2 2"/><path d="M21 14v1"/><path d="M21 19a2 2 0 0 1-2 2"/><path d="M21 9v1"/><path d="M3 14v1"/><path d="M3 9v1"/><path d="M5 21a2 2 0 0 1-2-2"/><path d="M5 3a2 2 0 0 0-2 2"/><path d="M7 12h10"/><path d="M7 16h6"/><path d="M7 8h8"/><path d="M9 21h1"/><path d="M9 3h1"/></svg>

                    <div class="max-w-sm mx-auto text-center">
                      <p class="mt-2 font-medium text-gray-800 dark:text-neutral-200">
                        Tipe jawaban essai
                      </p>
                      <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                        Silahkan menuju menu evaluasi soal untuk koreksi manual seluruh jawaban peserta.
                      </p>
                      <div>
                        <a href="{{ route('operator.invalid') }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                          Koreksi jawaban
                        </a>
                      </div>
                    </div>
                  </div>
                </ul>
                <!-- End List Group -->
              </form>
            </div>
            <!-- End Card -->
        @else
          <!-- Card -->
          <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div class="p-6 w-full flex justify-between">
                  <div class="w-full text-sm">
                      <p class="font-semibold text-gray-800 dark:text-neutral-200">Tambah pilihan jawaban</p>
                      <p class="text-xs text-gray-500 dark:text-neutral-500">Menambahkan pilihan jawaban ke dalam butir soal</p>
                  </div>
                <div>
                  <a href="{{ route('operator.soal.pj.create', [$data['id_paket_soal'], $data['id_soal']]) }}" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                    Tambah
                  </a>
                </div>
              </div>
            </form>
          </div>
          <!-- End Card -->

          <!-- Card -->
          <div class="p-6 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
              <div class=" w-full flex justify-between">
                  <div class="w-full text-sm">
                      <p class="font-semibold text-gray-800 dark:text-neutral-200">Daftar pilihan jawaban</p>
                      <p class="text-xs text-gray-500 dark:text-neutral-500">{{ empty($data['pilihan']) ? 'Tidak ada pilihan jawaban' : 'Total '.count($data['pilihan']).' pilihan jawaban' }}</p>
                  </div>
              </div>

              <!-- List Group -->
              <ul>

                @if (empty($data['pilihan']))
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
                        Tidak ada pilihan jawaban
                      </p>
                      <p class="mb-5 text-sm text-gray-500 dark:text-neutral-500">
                        Daftar pilihan jawaban akan tampil disini
                      </p>
                    </div>
                  </div>
                @else
                  <div class="grid pt-7 gap-y-5">
                    @foreach ($data['pilihan'] as $pilihan)
                        <div class="p-4 relative flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <div>
                                <div>
                                    <div class="escape-container prose max-w-none dark:prose-invert text-sm grid gap-y-1 text-gray-800 dark:text-neutral-200">
                                      {!! $pilihan['teks_jawaban'] !!}
                                    </div>
                                </div>

                                <div>
                                  <div class="mt-2 flex items-start gap-x-2 text-gray-500 dark:text-neutral-400">
                                      <p class="text-xs">
                                        Pilihan jawaban {{ $loop->iteration }}
                                      </p>
                                  </div>
                                </div>

                                <div>
                                    <div class="flex lg:flex-col justify-end items-center gap-2 pt-3 lg:pt-0">
                                        <div class="lg:order-2 lg:ms-auto">
                                            <a href="{{ route('operator.soal.pj.update', [$data['id_paket_soal'], $data['id_soal'], $pilihan['id_pilihan_jawaban']]) }}" type="button" class="py-2 px-3 text-xs inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-chhdl">
                                                Edit
                                            </a>
                                            <button data-pilihan="{{ $loop->iteration }}" data-pilihan-id="{{ $pilihan['id_pilihan_jawaban'] }}" type="button" class="btn-hapus-pj py-2 px-3 text-xs inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-red-700 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-600 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-scale-confirm-modal-pj" data-hs-overlay="#hs-scale-confirm-modal-pj">
                                              Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($pilihan['benar'] == 1)
                              <span class="absolute top-0 start-0 inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Benar</span>
                            @else
                              <span class="absolute top-0 start-0 inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded-full text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">Salah</span>
                            @endif
                        </div>
                    @endforeach
                  </div>
                @endif

              </ul>
              <!-- End List Group -->
            </form>
          </div>
          <!-- End Card -->
        @endif

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
  const quill = new Quill('#editor', {
    modules: {
      toolbar: {
        container: [
          ['bold', 'italic', 'underline', 'strike'],
          [{ header: 1 }, { header: 2 }, { header: 3 }],
          ['image', 'code-block', 'blockquote'],
          [{ script: 'sub' }, { script: 'super' }],
          [{ color: [] }, { background: [] }],
          [
            { align: '' },
            { align: 'center' },
            { align: 'right' },
            { align: 'justify' }
          ],
          [{ indent: '-1' }, { indent: '+1' }],
          [{ list: 'ordered' }, { list: 'bullet' }],
          [{ direction: 'rtl' }],
          ['clean']  
        ],
        handlers: {
          image: imageHandler
        }
      }
    },
    theme: 'snow'
  });

  function imageHandler() {
    const overlay = document.getElementById("overlayInit");
    if (!overlay) return;
    const showOverlay = () => overlay.classList.remove("hidden");
    const hideOverlay = () => overlay.classList.add("hidden");

    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.click();

    input.onchange = async () => {
      const file = input.files[0];

      if (!file) {
        console.warn('⚠️ No file selected');
        return;
      }

      const formData = new FormData();
      formData.append('image', file);
      showOverlay()

      try {
        const response = await fetch("{{ route('upload') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document
              .querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });

        const text = await response.text();

        if (!response.ok) {
          console.error('❌ Upload failed');
          alert('Gagal mengungah gambar, coba lagi...');
          hideOverlay()
          return;
        }

        const data = JSON.parse(text);

        if (!data.url) {
          console.error('❌ URL not found in response');
          alert('Response tidak mengandung URL');
          hideOverlay()
          return;
        }

        const range = quill.getSelection(true);
        quill.insertEmbed(range.index, 'image', data.url);
        hideOverlay()

      } catch (error) {
        console.error('🔥 Exception:', error);
        alert('Exception terjadi, cek console');
        hideOverlay()
      }
    };
  }

  document.querySelector('form').addEventListener('submit', function () {
    document.getElementById('contentEditor').value =
      document.querySelector('.ql-editor').innerHTML;
  });

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-hapus-pj')
    if (!btn) return

    const pilihan = btn.dataset.pilihan
    const idps = {{ $data['id_paket_soal']  }}
    const ids = {{ $data['id_soal'] }}
    const id = btn.dataset.pilihanId
    const action = `/operator/soal/delete/${idps}/${ids}/${id}`

    document.getElementById('pilihanIteration').innerText = pilihan
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
                    <form method="post" action="{{ route('operator.'.$page.'.delete.action', [$data['id_paket_soal'], $action_param]) }}">
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

<!-- Confirm Modal PJ -->
<div id="hs-scale-confirm-modal-pj" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-confirm-modal-label-pj">
    <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-7">
                <div class="flex justify-between items-center  ">
                    <h3 class="font-bold text-gray-800 dark:text-white">
                    Hapus pilihan jawaban?
                    </h3>
                </div>
                <div class="pb-3 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                    Yakin ingin mengapus <strong>pilihan jawaban <span id="pilihanIteration"></span></strong> secara permanen? Aksi ini tidak dapat dikembalikan.
                    </p>
                </div>
                <div class="flex justify-end items-center gap-x-2  ">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-confirm-modal-pj">
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
<!-- End Confirm Modal PJ -->                