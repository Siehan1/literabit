<x-dashboardComponent.kuis>
    <x-slot name="title">Kuis Literabit</x-slot>
    <x-slot name="header">Kuis Literabit</x-slot>
    <x-slot name="icon">
        <img src="{{ asset('asset/icons/icon-quiz.svg') }}" alt="Quiz Icon" class="w-6 h-6">
    </x-slot>

    @section('content')
    <!-- Kontainer Utama (Simulasi Tampilan Soal Terakhir) -->
    <div class="fixed inset-0 bg-[#FFB066] flex items-center justify-center font-poppins">
        <!-- Konten Soal Terakhir yang Diblur -->
        <div class="blur-sm bg-white w-full max-w-[1140px] rounded-[30px] px-8 py-8 relative shadow-[0_20px_50px_rgba(0,0,0,0.15)]">
            <!-- Konten soal disini (dummy) -->
            <div class="h-96 flex items-center justify-center text-gray-500">
                [Tampilan Soal Terakhir yang Diblur]
            </div>
        </div>

        <!-- Overlay Modal -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 flex items-center justify-center p-4">
            <!-- Modal Content -->
            <div class="relative z-50 bg-[#FB5E5E] rounded-2xl shadow-xl p-8 w-full max-w-[320px] text-center overflow-hidden">
                <!-- Dekorasi Sudut -->
                <div class="absolute -top-16 -right-16 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-white/10 rounded-full"></div>

                <!-- Judul -->
                <h2 class="text-[#1F2E40] text-2xl font-bold mb-6 pt-4">Kamu Kehabisan Hati</h2>
                
                <!-- Gambar Kelinci -->
                <div class="mb-8 mx-auto w-[140px] h-[140px] flex items-center justify-center">
                    <img src="{{ asset('asset/images/kelinci-salah.svg') }}" 
                        alt="Kelinci Sedih" 
                        class="w-full h-full object-contain animate-bounce">
                </div>

                <!-- Tombol Ulang -->
                <div class="flex justify-center">
                    <a href="{{ route('kuis.soal', ['slug' => 'tari-gantar-kebanggaanku', 'nomor' => 1]) }}" class="block w-full">
                        <button class="w-full bg-white text-[#1F2E40] font-bold py-4 
                                rounded-xl shadow-[0_6px_0_#E0913A] hover:-translate-y-0.5 
                                active:translate-y-1 active:shadow-none transition-all">
                            ULANG
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        // Optional: Auto-scroll ke tengah saat modal muncul
        window.onload = () => {
            window.scrollTo({
                top: document.documentElement.scrollHeight/2,
                behavior: 'smooth'
            });
        }
    </script>
    @endsection
</x-dashboardComponent.kuis>