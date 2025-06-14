<x-dashboardComponent.kuis>
    <x-slot name="header">Kuis Literabit</x-slot>
    <x-slot name="icon">
        <img src="{{ asset('asset/icons/icon-quiz.svg') }}" alt="Quiz Icon" class="w-6 h-6">
    </x-slot>
    <x-slot name="title">Hasil Kuis</x-slot>

    @section('content')
    <div class="min-h-screen bg-[#FEE8CD] flex flex-col items-center justify-center font-poppins p-4">
        <div class="bg-white rounded-[20px] shadow-[0_6px_0px_#D48D3C] w-full max-w-[500px] px-8 py-10 text-center">
            <!-- Judul -->
            <h1 class="text-[#1F2E40] text-3xl font-bold mb-6">Nilai Sempurna! 🎉</h1>

            <!-- Gambar Kelinci -->
            <img src="{{ asset('asset/images/kelinci-skor.svg') }}" 
                 alt="Kelinci Skor" 
                 class="w-40 mx-auto mb-6 animate-float">

            <!-- Subjudul -->
            <p class="text-[#1F2E40] text-lg mb-8">
                Pejuang hebat seperti Kamu layak mendapatkan poin
            </p>

            <!-- Kotak XP -->
            <div class="bg-white border-4 border-[#FBB45E] rounded-xl px-6 py-4 flex items-center justify-center gap-3 mb-8 shadow-md">
                <img src="{{ asset('asset/images/wortel.svg') }}" 
                     alt="XP Icon" 
                     class="w-7 h-7">
                <div class="flex items-baseline gap-2">
                    <span id="xpSkor" class="text-[#1F2E40] text-3xl font-bold">{{ $xp }}</span>
                    <span class="text-[#1F2E40] text-xl font-semibold">XP</span>
                </div>
            </div>

            <!-- Tombol Lanjut -->
            <a href="/beranda" class="inline-block">
                <button class="bg-[#FBB45E] hover:bg-[#f9a13b] text-white px-8 py-3 rounded-xl 
                          text-lg font-semibold shadow-[0_4px_0_#e0913a] transition-all 
                          hover:-translate-y-0.5 active:translate-y-0">
                    LANJUT
                </button>
            </a>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        // Jika perlu mempertahankan slider
        function updateXP(jumlahBenar) {
            document.getElementById('xpSkor').textContent = jumlahBenar * 10;
        }
    </script>
    @endsection
</x-dashboardComponent.kuis>