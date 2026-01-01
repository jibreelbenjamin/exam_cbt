@php
    $page = 'konfirmasi ujian';
@endphp
<x-app :page='$page'>
    <!-- Cards -->
    <div class="mt-5 xl:p-5 space-y-4 flex flex-col xl:bg-white xl:border xl:border-gray-200 xl:shadow-2xs xl:rounded-xl dark:xl:bg-neutral-800 dark:xl:border-neutral-700">
        <!-- Card Grid -->
        <div class="">

            <!-- Card -->
            <div class="bg-white border border-gray-200 rounded-2xl dark:bg-neutral-900 dark:border-neutral-700">
                <!-- Body -->
                <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-200 dark:divide-neutral-700">
                <div class="p-5 sm:p-8">
                    <!-- Heading -->
                    <div class="mb-3">
                        <h2 class="font-medium text-sm text-gray-800 dark:text-neutral-200">
                            Identitas peserta
                        </h2>
                    </div>
                    <!-- End Heading -->

                    <!-- Timeline -->
                    <div>
                        <!-- Item -->
                        <div class="group flex gap-x-3">
                            <!-- Icon -->
                            <div class="relative group-last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
                            <div class="relative z-10 size-7 flex justify-center items-center">
                                <svg class="shrink-0 size-3 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-1 pb-4">
                            <p class="mb-1 text-sm text-gray-500 dark:text-neutral-400">
                                Nama Lengkap
                            </p>
                            <p class="text-sm text-gray-700 dark:text-neutral-300">
                                {{ Auth::guard('peserta')->user()->nama }}
                            </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="group flex gap-x-3">
                            <!-- Icon -->
                            <div class="relative group-last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
                            <div class="relative z-10 size-7 flex justify-center items-center">
                                <svg class="shrink-0 size-3 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card-icon lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                            </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-1 pb-4">
                            <p class="mb-1 text-sm text-gray-500 dark:text-neutral-400">
                                ID Peserta
                            </p>
                            <p class="text-sm text-gray-700 dark:text-neutral-300">
                                {{ Auth::guard('peserta')->user()->username }}
                            </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="group flex gap-x-3">
                            <!-- Icon -->
                            <div class="relative group-last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
                            <div class="relative z-10 size-7 flex justify-center items-center">
                                <svg class="shrink-0 size-3 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8h20"></path><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="M6 16h12"></path></svg>
                            </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-1 pb-4">
                            <p class="mb-1 text-sm text-gray-500 dark:text-neutral-400">
                                Kelas
                            </p>
                            <p class="text-sm text-gray-700 dark:text-neutral-300">
                                {{ Auth::guard('peserta')->user()->kelas->nama }}
                            </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="group flex gap-x-3">
                            <!-- Icon -->
                            <div class="relative group-last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
                            <div class="relative z-10 size-7 flex justify-center items-center">
                                <svg class="shrink-0 size-3 text-gray-800 dark:text-neutral-200" mlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-door-open-icon lucide-door-open"><path d="M11 20H2"/><path d="M11 4.562v16.157a1 1 0 0 0 1.242.97L19 20V5.562a2 2 0 0 0-1.515-1.94l-4-1A2 2 0 0 0 11 4.561z"/><path d="M11 4H8a2 2 0 0 0-2 2v14"/><path d="M14 12h.01"/><path d="M22 20h-3"/></svg>
                            </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-1 pb-4">
                            <p class="mb-1 text-sm text-gray-500 dark:text-neutral-400">
                                Ruangan
                            </p>
                            <p class="text-sm text-gray-700 dark:text-neutral-300">
                                {{ Auth::guard('peserta')->user()->ruangan->nama ?? '-' }}
                            </p>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->
                    </div>
                    <!-- End Timeline -->
                </div>
                <!-- End Col -->

                <!-- Card -->
                <div class="px-5 sm:px-8 relative">
                    <!-- Body -->
                    <div class="divide-y divide-dashed divide-gray-300 dark:divide-neutral-700">
                    <!-- Item -->
                    <div class="py-5 sm:py-8">
                        <!-- Heading -->
                        <div class="mb-3">
                        <h2 class="font-medium text-sm text-gray-800 dark:text-neutral-200">
                            Informasi ujian
                        </h2>
                        </div>
                        <!-- End Heading -->

                        <!-- List -->
                        <dl class="grid grid-cols-1 sm:grid-cols-2 sm:gap-y-2 gap-x-4">
                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Nama ujian:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 font-bold text-sm text-gray-800 dark:text-neutral-200">
                            {{ $data['nama'] }}
                        </dd>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Masa ujian:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 text-sm text-gray-800 dark:text-neutral-200">
                            {{ $data['paket_ujian']['nama'] }}
                        </dd>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Durasi ujian:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 text-sm text-gray-800 dark:text-neutral-200">
                            {{ $data['durasi'] }} Menit
                        </dd>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Soal yang diuji:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 text-sm text-gray-800 dark:text-neutral-200">
                            {{ $data['paket_soal']['nama'] }}
                        </dd>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Total soal:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 text-sm text-gray-800 dark:text-neutral-200">
                            {{ count($data['paket_soal']['soal']) }} Soal
                        </dd>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Jadwal mulai:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 text-sm text-gray-800 dark:text-neutral-200">
                            {{ \Carbon\Carbon::parse($data['jadwal_mulai'])->locale('id')->translatedFormat('d F Y, H:i:s')  }}
                        </dd>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                            Jadwal selesai:
                        </dt>
                        <dd class="pb-3 sm:py-0.5 text-sm text-gray-800 dark:text-neutral-200">
                            {{ \Carbon\Carbon::parse($data['jadwal_selesai'])->locale('id')->translatedFormat('d F Y, H:i:s')  }}
                        </dd>
                        </dl>
                        <!-- End List -->
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="py-5 sm:py-8">
                        <!-- Heading -->
                        <div class="mb-3">
                        <h2 class="font-medium text-sm text-gray-800 dark:text-neutral-200">
                            Persyaratan ujian
                        </h2>
                        </div>
                        <!-- End Heading -->

                        <!-- List -->
                        <dl class="grid grid-cols-1 sm:grid-cols-2 sm:gap-y-2 gap-x-4">

                        @if ($data['token'] === 1)
                            
                        <dt class="sm:py-0.5 sm:col-span-2 text-sm text-gray-500 dark:text-neutral-500">
                            <div class="relative">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" id="hs-floating-input-email-value" class="peer p-4 block w-full border-gray-200 rounded-lg sm:text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                focus:pt-6
                                focus:pb-2
                                not-placeholder-shown:pt-6
                                not-placeholder-shown:pb-2
                                autofill:pt-6
                                autofill:pb-2" placeholder="..." autocomplete="OFF">
                                <label for="hs-floating-input-email-value" class="absolute top-0 start-0 p-4 h-full sm:text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                peer-focus:scale-90
                                peer-focus:translate-x-0.5
                                peer-focus:-translate-y-1.5
                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                peer-not-placeholder-shown:scale-90
                                peer-not-placeholder-shown:translate-x-0.5
                                peer-not-placeholder-shown:-translate-y-1.5
                                peer-not-placeholder-shown:text-gray-500 dark:peer-not-placeholder-shown:text-neutral-500 dark:text-neutral-500">Masukan token ujian</label>
                            </div>
                        </dt>
                        @endif

                        <dt class="pt-2 sm:py-0.5 sm:col-span-2 text-sm text-gray-500 dark:text-neutral-500">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5 mt-1">
                                    <input id="hs-checkbox-delete" name="hs-checkbox-delete" type="checkbox" class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" aria-describedby="hs-checkbox-delete-description">
                                </div>
                                <label for="hs-checkbox-delete" class="ms-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-300">Saya siap mengikuti ujian</span>
                                    <span id="hs-checkbox-delete-description" class="block text-xs text-gray-600 dark:text-neutral-500">Saya telah memahami & mengikuti peraturan ujian yang berlaku.</span>
                                </label>
                            </div>
                        </dt>

                        <dt class="sm:py-0.5 text-sm text-gray-500 dark:text-neutral-500">
                          
                        </dt>
                        <dd class="pt-3 sm:pt-3 text-sm text-gray-800 dark:text-neutral-200">
                            <div class="w-full flex justify-end items-center gap-x-2">
                                <a href="{{ route('onexam.home') }}" class="py-2 px-3 inline-flex justify-center items-center text-start text-xs bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Kembali
                                </a>

                                <button type="submit" class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start text-xs bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-2xs align-middle hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-500">
                                Kerjakan
                                </button>
                            </div>
                        </dd>

                        </dl>
                        <!-- End List -->
                    </div>
                    <!-- End Item -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
                </div>
                <!-- End Body -->
            </div>
            <!-- End Card -->

        </div>
        <!-- End Card Grid -->
    </div>
    <!-- End Cards -->
</x-app>