<x-layout.kuis>
    <x-slot name="header">Kuis Literabit</x-slot>
    <x-slot name="icon">
        <img src="{{ asset('asset/icons/icon-quiz.svg') }}" alt="Quiz Icon" class="w-6 h-6">
    </x-slot>
    <x-slot name="title">Mulai Kuis</x-slot>

    @section('content')
    <div class="min-h-screen bg-[#FEE8CD] flex items-center justify-center font-poppins p-4">
        <!-- Main Container -->
        <div class="bg-white w-full max-w-4xl rounded-[30px] shadow-[0_20px_50px_rgba(0,0,0,0.15)] relative overflow-hidden px-8 py-12">
            
            <!-- Dekorasi Sudut -->
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#FBB45E]/20 rounded-full"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-[#FBB45E]/20 rounded-full"></div>

            <!-- Content Grid -->
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
                <!-- Text Section -->
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="text-[#1F2E40] text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                        Mari Bermain<br>
                        <span class="text-[#FBB45E]">Bersama!</span>
                    </h1>
                    
                    <p class="text-[#1F2E40]/80 text-lg lg:text-xl mb-8 max-w-[400px] mx-auto lg:mx-0">
                        Tunjukkan kemampuan literasimu dan kumpulkan XP sebanyak-banyaknya!
                    </p>

                    <a href="{{ route('kuis.soal', ['id_buku' => 1, 'nomor' => 1]) }}" class="inline-block">
                        <button class="bg-[#FBB45E] hover:bg-[#F9A13B] text-white px-8 py-3.5 rounded-xl 
                                  text-lg font-bold shadow-[0_6px_0_#E0913A] hover:-translate-y-0.5 
                                  active:translate-y-1 active:shadow-none transition-all">
                            Mulai Bermain
                        </button>
                    </a>

                </div>

                <!-- Image Section -->
                <div class="flex-1 max-w-[400px]">
                    <img src="{{ asset('asset/images/kelinci-kuis.svg') }}" 
                         alt="Kelinci" 
                         class="w-full animate-float">
                </div>
            </div>
        </div>
    </div>
    @endsection

    <x-slot name="footer">
        <p class="text-center text-sm text-[#1F2E40]/60 mt-8 pb-4">
            © 2025 Literabit. All rights reserved.
        </p>
    </x-slot>
</x-layout.kuis>