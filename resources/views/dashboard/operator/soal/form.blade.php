@php
    $page = 'soal';
    $page_title = 'tambah soal';
@endphp
<x-app-op :page='$page'>
    <div class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5">
      <!-- Card Form -->
      <div class="flex flex-col gap-y-5 max-w-3xl mx-auto">
        <!-- Header -->
        <div class="flex gap-x-3">
          <div class="grow">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-neutral-200">
                {{ ucfirst($page_title) }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-neutral-500">
               Membuat {{ $page }} baru pada paket soal <span class="font-medium underline">{{ $data['nama'] }}</span> 
            </p>
          </div>
        </div>
        <!-- End Header -->

        <!-- Card -->
        <div class="bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
          <form action="{{ route('operator.soal.create.action', $data['id_paket_soal']) }}" method="post">
            @csrf
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- WYSIWYG Editor -->
                <div id="editor">
                  {!! old('teks_soal') ? old('teks_soal') : '' !!}
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
                      <option value="1" {{ ((old('tipe_jawaban') == '1') ? 'selected=""' : '') }} data-hs-select-option='{
                          "description": "Peserta menjawab berdasarkan pilihan yang tersedia.",
                          "icon": "<svg class=\"shrink-0 size-4 text-gray-800 dark:text-neutral-200 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-circle-slash-icon lucide-circle-slash\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><line x1=\"9\" x2=\"15\" y1=\"15\" y2=\"9\"/></svg>"
                        }'>Pilihan ganda</option>
                      <option value="2" {{ ((old('tipe_jawaban') == '2') ? 'selected=""' : '') }} data-hs-select-option='{
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
</script>










                