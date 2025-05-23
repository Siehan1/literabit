<x-layout.kuis>
    <x-slot name="header">Kuis Literabit</x-slot>
    <x-slot name="icon">
        <img src="{{ asset('assets/icons/icon-quiz.svg') }}" alt="Quiz Icon" class="w-6 h-6">
    </x-slot>
    <x-slot name="title">Kuis Literabit</x-slot>
    <x-slot name="subtitle">Kuis Literabit</x-slot>

    @section('content')
    <div class="min-h-screen bg-[#FFB066] flex items-center justify-center font-poppins px-4 py-10 relative">
        <!-- Kontainer Utama -->
        <div class="bg-white w-full max-w-[1140px] rounded-[30px] px-8 py-8 relative shadow-[0_20px_50px_rgba(0,0,0,0.15)]">
            <!-- Dekorasi Sudut -->
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#FBB45E]/20 rounded-full"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-[#FBB45E]/20 rounded-full"></div>

            <!-- Header -->
            <div class="w-full flex justify-between items-center mb-8">
                <button class="p-2 hover:scale-110 transition-transform">
                    <img src="{{ asset('asset/icons/close-icon.svg') }}" alt="Close" class="w-6 h-6">
                </button>

                <!-- Progress Bar -->
                <div class="w-full px-6">
                    <div class="h-3 bg-gray-200 rounded-full shadow-inner">
                        <div class="h-3 bg-[#FBB45E] rounded-full transition-all duration-500 ease-out" 
                             style="width: 40%; box-shadow: 0 2px 8px rgba(251,180,94,0.3)"></div>
                    </div>
                </div>

                <!-- Nyawa -->
                <div class="flex items-center gap-2">
                    <div class="bg-red-500/20 p-2 rounded-full">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-red-500 text-xl font-bold">5</span>
                </div>
            </div>

            <!-- Pertanyaan -->
            <div class="mt-6 flex items-center justify-center gap-6">
                <img src="{{ asset('asset/images/kelinci-maskot.svg') }}" 
                     class="w-[140px] animate-float" alt="Maskot">
                <div class="relative bg-[#FBB45E] text-white p-6 rounded-2xl text-xl max-w-[500px] shadow-md">
                    <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-0 h-0 
                              border-t-[16px] border-t-transparent 
                              border-b-[16px] border-b-transparent 
                              border-r-[24px] border-r-[#FBB45E]"></div>
                    Siapa tokoh utama dalam cerita ini?
                </div>
            </div>

            <!-- Jawaban -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-12 max-w-2xl mx-auto">
                @foreach (['Bima', 'Dito', 'Raka', 'Satria'] as $nama)
                <button onclick="selectOption(this)"
                    class="jawaban-btn group border-2 border-[#FBB45E] rounded-xl py-4 px-6 
                           bg-white text-[#1F2E40] font-bold text-lg 
                           shadow-[0_6px_0_#FBB45E] hover:shadow-[0_8px_0_#FBB45E] 
                           transition-all duration-200 hover:-translate-y-0.5 
                           active:translate-y-1 active:shadow-none">
                    <div class="flex items-center justify-between">
                        <span>{{ $nama }}</span>
                        <div class="w-6 h-6 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </button>
                @endforeach
            </div>

            <!-- Tombol Periksa -->
            <div class="mt-12 text-center">
                <button id="periksaBtn" onclick="tampilkanFeedback()"
                    class="px-10 py-4 rounded-xl text-white font-bold text-lg 
                           bg-[#D4D6D7] shadow-[0_6px_0_#AEAEAE] cursor-not-allowed
                           transition-transform disabled:opacity-75 disabled:hover:translate-y-0
                           hover:-translate-y-0.5 active:translate-y-1 active:shadow-none">
                    PERIKSA
                </button>
            </div>
        </div>

        <!-- Modal Feedback -->
        <div id="modalFeedback"
            class="hidden fixed inset-0 flex flex-col items-center justify-center bg-black/50 z-50 backdrop-blur-sm">
            <div id="modalContent" class="rounded-2xl p-8 max-w-md w-[90%] relative overflow-hidden shadow-xl transition-colors">
                <!-- Gambar -->
                <div class="flex justify-center items-center h-40 mb-4">
                    <img id="maskotFeedback" src="{{ asset('asset/images/kelinci-salah.svg') }}" 
                        alt="Feedback" class="w-32 animate-bounce">
                </div>

                <!-- Text -->
                <h2 id="textFeedback" class="text-2xl font-bold mb-8 text-center text-white">
                    Yah Jawabanmu Salah
                </h2>
                
                <!-- Tombol -->
                <div class="flex justify-center">
                    <a href="{{ url('/kuis/soal') }}" class="block w-full max-w-[200px]">
                        <button class="w-full bg-white text-[#1F2E40] font-bold py-3 rounded-xl 
                                    shadow-[0_4px_0_#E0913A] hover:-translate-y-0.5 
                                    active:translate-y-1 active:shadow-none transition-all">
                            LANJUT
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        let selectedBtn = null;

        function selectOption(btn) {
            document.querySelectorAll('.jawaban-btn').forEach(b => {
                b.classList.remove('bg-[#A0DAA9]', 'text-white', 'border-[#A0DAA9]');
                b.classList.add('bg-white', 'text-[#1F2E40]', 'border-[#FBB45E]');
                b.style.boxShadow = '0 6px 0 #FBB45E';
            });

            if (selectedBtn === btn) {
                selectedBtn = null;
                togglePeriksa(false);
            } else {
                selectedBtn = btn;
                btn.classList.add('bg-[#A0DAA9]', 'text-white', 'border-[#A0DAA9]');
                btn.classList.remove('bg-white', 'text-[#1F2E40]', 'border-[#FBB45E]');
                btn.style.boxShadow = '0 6px 0 #7BBF84';
                togglePeriksa(true);
            }
        }

        function togglePeriksa(state) {
            const periksa = document.getElementById('periksaBtn');
            if (state) {
                periksa.disabled = false;
                periksa.classList.remove('bg-[#D4D6D7]', 'cursor-not-allowed');
                periksa.classList.add('bg-[#FBB45E]', 'cursor-pointer', 'hover:bg-[#F9A13B]');
                periksa.style.boxShadow = '0 6px 0 #E0913A';
            } else {
                periksa.disabled = true;
                periksa.classList.remove('bg-[#FBB45E]', 'cursor-pointer', 'hover:bg-[#F9A13B]');
                periksa.classList.add('bg-[#D4D6D7]', 'cursor-not-allowed');
                periksa.style.boxShadow = '0 6px 0 #AEAEAE';
            }
        }

        function tampilkanFeedback() {
            const modal = document.getElementById('modalFeedback');
            const modalContent = document.getElementById('modalContent');
            const image = document.getElementById('maskotFeedback');
            const text = document.getElementById('textFeedback');

            const isCorrect = selectedBtn?.innerText === "Bima";

            if (isCorrect) {
                modalContent.classList.remove('bg-red-500');
                modalContent.classList.add('bg-[#5EB4FB]');
                image.src = "{{ asset('asset/images/kelinci-benar.svg') }}";
                text.innerText = "Yeay Jawabanmu Benar";
            } else {
                modalContent.classList.remove('bg-[#5EB4FB]');
                modalContent.classList.add('bg-red-500');
                image.src = "{{ asset('asset/images/kelinci-salah.svg') }}";
                text.innerText = "Yah Jawabanmu Salah";
            }

            modal.classList.remove('hidden');
        }

        window.onload = () => togglePeriksa(false);
    </script>
    @endsection
</x-layout.kuis>