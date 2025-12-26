<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav.png') }}" >
    <title>SOAL {{ strtoupper($data['nama']) }}</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="p-10">
        <h1 class="text-xl">{{ strtoupper($data['nama']) }} - {{ count($data['soal']) }} SOAL</h1>

        <div class="grid mt-7 gap-y-5">
            @foreach ($acak_soal == 'true' ? collect($data['soal'])->shuffle() : $data['soal'] as $item)
                <div class="flex items-start">
                    <div class="mr-5">
                        {{ $loop->iteration }}.
                    </div>
                    <div>
                        <div class="q-escape-container grid gap-y-1">
                            {!! $item['teks_soal'] !!}
                        </div>           
                        <div class="grid mt-3 gap-y-1">
                            @if ($item['tipe_jawaban'] == 2)
                                <div class="mr-2">
                                    @for ($i = 1; $i <= 150; $i++)
                                        .
                                    @endfor
                                </div>
                            @elseif (empty($item['pilihan']))
                                <div class="mr-2">
                                    Tidak ada pilihan jawaban
                                </div>
                            @else
                                @foreach ($acak_soal == 'true' ? collect($item['pilihan'])->shuffle() : $item['pilihan'] as $p)
                                    <div class="flex {{ $jawaban == 'true' ? $p['benar'] ? 'text-green-600' : '' : '' }}">
                                        <div class="mr-2">
                                            {{ chr(64 + $loop->iteration) }}.
                                        </div>
                                        <div class="escape-container">
                                            {!! $p['teks_jawaban'] !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>      
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
<script>
    window.print()
</script>
</html>