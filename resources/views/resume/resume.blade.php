<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kreasikan Cerita</title>
  <meta name="csrf-token" content="{{ csrf_token() }}"><link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    body {
      background-color: #FEE8CD;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center">

  <div class="w-full max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between p-8">
    {{-- <div class="bg-white w-full max-w-4xl rounded-[30px] shadow-[0_20px_50px_rgba(0,0,0,0.15)] relative overflow-hidden px-8 py-12">
        <!-- Gambar kelinci -->
        <div class="w-1/3 flex justify-center mb-6 md:mb-0">
        <img src="{{asset('asset/images/kelinci_resume.png')}}" alt="Kelinci" class="w-40 h-auto drop-shadow-md">
        </div>

        <!-- Konten kanan -->
        <div class="w-full md:w-2/3">
        <h1 class="text-2xl md:text-3xl font-bold text-green-900 text-center md:text-left mb-4">
            Kreasikan Cerita Versimu, Yuk
        </h1>

        <!-- Text area -->
        <textarea
            class="w-full h-40 p-4 rounded-lg shadow-md text-orange-500 placeholder-orange-400 text-lg"
            placeholder="Ketik di sini …"
        ></textarea>

        <!-- Tombol -->
        <div class="flex justify-end mt-4">
            <button class="bg-white text-orange-500 font-bold px-6 py-2 rounded shadow-md hover:translate-y-0.5 active:translate-y-1 transition-all">
            Lanjut
            </button>
        </div>
        </div>
    </div> --}}
    <div class="bg-white w-full max-w-4xl rounded-[30px] shadow-[0_20px_50px_rgba(0,0,0,0.15)] relative overflow-hidden px-8 py-12">

        <!-- Dekorasi Sudut -->
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#FBB45E]/20 rounded-full"></div>
        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-[#FBB45E]/20 rounded-full"></div>
        <button onclick="window.history.back()"
        class="cancel absolute top-3 left-3 bg-red-500 hover:bg-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">
            ×
        </button>

        <a href="{{ route('bacaBuku', $buku->slug) }}" class="cancel absolute top-3 left-3 bg-red-500 hover:bg-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">
            x
        </a>
        <!-- Content Grid -->
        <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
            <!-- Image Section -->
            <div class="flex-1 max-w-[400px]">
                <img src="{{ asset('asset/images/kelinci_resume.png') }}"
                     alt="Kelinci"
                     class="w-full animate-float">
            </div>

            <!-- Text Section -->
            <div class="flex-1 text-center lg:text-left">
                <h1 class="text-[#1F2E40] text-3xl lg:text-4xl font-bold mb-6 leading-tight">
                    Kreasikan Cerita Versimu,
                    <span class="text-[#FBB45E]">Yuk!</span>
                </h1>

                {{-- <a href="{{ route('kuis.soal', ['slug' => $buku->slug, 'nomor' => 1]) }}" class="inline-block">
                    <button class="bg-[#FBB45E] hover:bg-[#F9A13B] text-white px-8 py-3.5 rounded-xl
                              text-lg font-bold shadow-[0_6px_0_#E0913A] hover:-translate-y-0.5
                              active:translate-y-1 active:shadow-none transition-all">
                        Mulai Bermain
                    </button>
                </a> --}}
                <!-- Text area -->
                <form action="{{ route('resume.store', $buku->slug) }}" method="post">
                    @csrf
                    <textarea
                    class="w-full h-40 p-4 mb-3 rounded-lg shadow-md text-orange-500 placeholder-orange-400 text-md"
                    placeholder="Ketik di sini …" name="resume"
                    ></textarea>

                    <!-- Tombol -->
                        <button class="bg-[#FBB45E] hover:bg-[#F9A13B] text-white px-8 py-3.5 rounded-xl
                        text-lg font-bold shadow-[0_6px_0_#E0913A] hover:-translate-y-0.5
                        active:translate-y-1 active:shadow-none transition-all" type="submit">
                        Kirim Ceritamu
                        </button>
                </form>

            </div>


        </div>
    </div>
  </div>

</body>
</html>
