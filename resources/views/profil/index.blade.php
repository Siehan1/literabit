<x-dashboardComponent.kuis>
    <x-slot name="header">LittleRabbit</x-slot>
    <x-slot name="icon">
        <img src="{{ asset('assets/icons/book-icon.svg') }}" alt="Book Icon" class="w-6 h-6">
    </x-slot>
    <x-slot name="subtitle">Little Reading Habbit</x-slot>

    @section('content')
    <div class="min-h-screen bg-[#FFF8F0] font-poppins flex">
        <!-- Sidebar Kiri -->
        <div class="w-64 bg-white shadow-[4px_0_20px_rgba(0,0,0,0.05)] p-6 space-y-8">
            <!-- Profil Mini -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#FFD8B8] rounded-xl flex items-center justify-center">
                    <span class="text-xl font-bold text-[#8B4513]">Lv.1</span>
                </div>
                <div>
                    <h2 class="font-bold text-[#8B4513]">achmad</h2>
                    <p class="text-xs text-[#8B4513]/80">achmad9277934</p>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 p-3 text-[#8B4513] hover:bg-[#FFF5E9] rounded-xl">
                    <div class="w-6 h-6 bg-[#FFB066]/20 rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-[#FFB066] rounded-full"></div>
                    </div>
                    Beranda
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-[#8B4513] hover:bg-[#FFF5E9] rounded-xl">
                    <div class="w-6 h-6 bg-[#FFB066]/20 rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-[#FFB066] rounded-full"></div>
                    </div>
                    Riwayat Membaca
                </a>
                <a href="#" class="flex items-center gap-3 p-3 bg-[#FFF5E9] text-[#8B4513] rounded-xl font-bold">
                    <div class="w-6 h-6 bg-[#FFB066] rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    </div>
                    Pencapaian
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-[#8B4513] hover:bg-[#FFF5E9] rounded-xl">
                    <div class="w-6 h-6 bg-[#FFB066]/20 rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-[#FFB066] rounded-full"></div>
                    </div>
                    Profil
                </a>
                <a href="#" class="flex items-center gap-3 p-3 text-[#8B4513] hover:bg-[#FFF5E9] rounded-xl">
                    <div class="w-6 h-6 bg-[#FFB066]/20 rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-[#FFB066] rounded-full"></div>
                    </div>
                    Pengaturan
                </a>
            </nav>

            <!-- Logout -->
            <div class="pt-6 border-t border-[#FFE4C4]">
                <button class="w-full flex items-center gap-3 p-3 text-[#8B4513] hover:bg-[#FFF5E9] rounded-xl">
                    <div class="w-6 h-6 bg-[#FFB066]/20 rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-[#FFB066] rounded-full"></div>
                    </div>
                    Logout
                </button>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="flex-1 p-8">
            <!-- Header Profil -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-8">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div class="w-24 h-24 bg-[#FFD8B8] rounded-2xl flex items-center justify-center">
                            <img src="{{ asset('assets/images/avatar-user.png') }}" 
                                 class="w-20 h-20 object-cover rounded-xl"
                                 alt="Avatar Pengguna">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-[#FFB066] text-white px-3 py-1 rounded-full text-sm font-medium">
                            Level 1
                        </div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-[#8B4513] mb-1">achmad</h1>
                        <p class="text-[#8B4513]/80 mb-4">achmad9277934@example.com</p>
                        
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 text-[#8B4513]/80">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Bergabung Mei 2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                    <div class="text-2xl font-bold text-[#8B4513] mb-1">20</div>
                    <div class="text-sm text-[#8B4513]/80">Total XP</div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                    <div class="text-2xl font-bold text-[#8B4513] mb-1">7</div>
                    <div class="text-sm text-[#8B4513]/80">Hari Beruntun</div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                    <div class="text-2xl font-bold text-[#8B4513] mb-1">42</div>
                    <div class="text-sm text-[#8B4513]/80">Buku Dibaca</div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                    <div class="text-2xl font-bold text-[#8B4513] mb-1">3</div>
                    <div class="text-sm text-[#8B4513]/80">Liga</div>
                </div>
            </div>

            <!-- Progress Harian -->
            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-[#8B4513]">Baca Buku Hari Ini</h2>
                    <span class="text-sm text-[#8B4513]/80">45% Complete</span>
                </div>
                <div class="relative pt-1">
                    <div class="h-3 bg-[#FFE4C4] rounded-full">
                        <div class="h-3 bg-[#FFB066] rounded-full w-[45%]"></div>
                    </div>
                </div>
            </div>

            <!-- Lencana & Pencapaian -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Lencana -->
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-[#8B4513]">Lencana</h2>
                        <span class="text-sm text-[#8B4513]/80">0/2 Unlocked</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="border-2 border-[#FFE4C4] rounded-xl p-4 text-center opacity-50">
                            <div class="w-16 h-16 bg-[#FFF5E9] rounded-xl mx-auto mb-3 flex items-center justify-center">
                                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                            </div>
                            <h3 class="font-semibold text-[#8B4513] mb-1">Book Worm</h3>
                            <p class="text-sm text-[#8B4513]/80">Baca 5 buku</p>
                        </div>
                        
                        <div class="border-2 border-[#FFE4C4] rounded-xl p-4 text-center opacity-50">
                            <div class="w-16 h-16 bg-[#FFF5E9] rounded-xl mx-auto mb-3 flex items-center justify-center">
                                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                            </div>
                            <h3 class="font-semibold text-[#8B4513] mb-1">Pembaca Aktif</h3>
                            <p class="text-sm text-[#8B4513]/80">7 hari beruntun</p>
                        </div>
                    </div>
                </div>

                <!-- Pencapaian -->
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                    <h2 class="text-xl font-semibold text-[#8B4513] mb-6">Pencapaian</h2>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 p-3 bg-[#FFF5E9] rounded-xl">
                            <div class="w-8 h-8 bg-[#FFB066] rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-[#8B4513]">Membaca buku pertama</span>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-[#FFF5E9] rounded-xl">
                            <div class="w-8 h-8 bg-[#FFB066] rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-[#8B4513]">Menyelesaikan level 1</span>
                        </div>
                        
                        <div class="flex items-center gap-3 p-3 bg-[#FFF5E9] rounded-xl opacity-50">
                            <div class="w-8 h-8 bg-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-[#8B4513]">7 hari beruntun</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <style>
        .shadow-book {
            box-shadow: 5px 5px 0 rgba(139, 69, 19, 0.1);
        }
    </style>
</x-dashboardComponent.kuis>