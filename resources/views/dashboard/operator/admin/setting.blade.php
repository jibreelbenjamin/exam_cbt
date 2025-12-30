@php
    $page = 'admin';
    $page_title = 'admin';
    $action_param = $data['id_admin'];
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
                      Nama admin
                    </label>
                  </div>
                  <!-- End Col -->

                  <div class="sm:col-span-9">
                    <input type="text" name="nama" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600"
                    placeholder="Masukan nama admin" value="{{ $data['nama'] }}" autocomplete="off">
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
