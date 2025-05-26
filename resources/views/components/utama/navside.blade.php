

    <div id="navside" class="text-teks font-poppins px-4 w-[250px] min-h-screen fixed top-0 shadow-[2px_0_5px_0_rgba(0,0,0,0.05)] transition-all duration-300 bg-white">

        <div class="flex flex-row items-center gap-2 pt-8 pb-3 border-b-2 border-b-gray-300">
            <img src="{{ asset('asset/images/icon.svg') }}" alt="" class="w-10">
            <div id="brandText" class="flex flex-col gap-0 transition-opacity duration-300">
                <span class="text-primary font-bold text-[20px]">LittleRabbit</span>
                <span class="text-primary font-medium text-[14px]">Little Reading Habbit</span>
            </div>
        </div>
        
        <div class="flex flex-col justify-between h-[calc(100vh-88px)] gap-2">
                <!-- profile dan level -->
            <div class="border-b-2 border-gray-300 py-3">
                <!-- profile -->
                <div class="flex flex-row gap-4 justify-start items-center ">
                    <img src="{{ asset('profile_penulis/pro1.svg') }}" alt="foto_pengguna" class="w-17">
                    <div class="flex flex-col">
                        <span class="text-teks">{{ Auth::user()->name }}</span>
                        <span class="text-sec text-[14px]">Level {{Auth::user()->level}}</span>
                    </div>
                </div>
                <!-- level -->
                    <div class="mt-3.5">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-primary h-2.5 rounded-full" style="width: 45%"></div>
                        </div>
                        <div class="flex justify-between text-xs mt-1">
                            <span class="text-sec">Level {{Auth::user()->level}}</span>
                            <span class="text-sec">{{Auth::user()->xp}} XP</span>
                        </div>
                    </div>
            </div>


            <!-- nav item -->
            <div class="flex flex-col flex-grow gap-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-teks hover:bg-primary/10 rounded-lg transition-colors duration-200">
                    <i class="bi bi-house-door-fill text-2xl text-primary"></i>
                    <span>Beranda</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-teks hover:bg-primary/10 rounded-lg transition-colors duration-200">
                    <i class="bi bi-clock-history text-2xl text-primary"></i>
                    <span>Riwayat Membaca</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-teks hover:bg-primary/10 rounded-lg transition-colors duration-200">
                    <i class="bi bi-award-fill text-2xl text-primary"></i>
                    <span>Pencapaian</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-teks hover:bg-primary/10 rounded-lg transition-colors duration-200">
                    <i class="bi bi-person-fill text-2xl text-primary"></i>
                    <span>Profile</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-teks hover:bg-primary/10 rounded-lg transition-colors duration-200">
                    <i class="bi bi-gear-fill text-2xl text-primary"></i>
                    <span>Pengaturan</span>
                </a>
            </div>
            <div class="pb-12">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-lg transition-colors duration-200">
                    <i class="bi bi-box-arrow-left text-2xl"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
        
