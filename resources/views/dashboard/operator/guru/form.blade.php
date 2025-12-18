@php
    $page = 'guru';
    $page_title = 'tambah guru';
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
          <form action="{{ route('operator.guru.create.action') }}" method="post">
            @csrf
            <div class="py-2 sm:py-4 px-2">
              <div class="p-4 space-y-5">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Username
                    </label>
                  </div>

                  <div class="sm:col-span-9">
                    <input type="text" name="username" value="{{ old('username') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan username" autocomplete="off">
                  </div>
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Nama guru
                    </label>
                  </div>

                  <div class="sm:col-span-9">
                    <input type="text" name="nama" value="{{ old('nama') }}" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan nama guru" autocomplete="off">
                  </div>
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                  <div class="sm:col-span-3">
                    <label class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                      Password
                    </label>
                  </div>

                  <div class="sm:col-span-9 relative">
                    <input id="hs-toggle-password" type="password" name="password" class="py-1.5 sm:py-2 px-3 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Masukan password" autocomplete="off">
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
