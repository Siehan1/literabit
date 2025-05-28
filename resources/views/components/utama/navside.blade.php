<div id="navside" class="text-teks font-poppins w-1/5 fixed px-6 top-0 shadow-lg transition-all duration-300 bg-white/95 backdrop-blur-sm h-screen">

        <div class="flex flex-row items-center gap-3 pt-8 pb-4 border-b-2 border-b-gray-200">
            <img src="{{ asset('asset/images/icon.svg') }}" alt="" class="w-12 hover:scale-105 transition-transform">
            <div id="brandText" class="flex flex-col gap-0.5 transition-opacity duration-300">
                <span class="text-primary font-bold text-[22px] tracking-tight">LittleRabbit</span>
                <span class="text-primary/80 font-medium text-[14px]">Little Reading Habbit</span>
            </div>
        </div>
        
        <div class="flex flex-col justify-between h-[calc(100vh-100px)] gap-4">
                <!-- profile dan level -->
            <div class="border-b-2 border-gray-200 py-4">
                <!-- profile -->
                <div class="flex flex-row gap-4 justify-start items-center group">
                    <img src="{{ asset('profile_penulis/pro1.svg') }}" alt="foto_pengguna" class="w-17 rounded-full ring-2 ring-primary/20 group-hover:ring-primary/40 transition-all">
                    <div class="flex flex-col">
                        <span class="text-teks font-medium">{{ Auth::user()->name }}</span>
                        <span class="text-sec text-[14px] opacity-75">Level {{Auth::user()->level}}</span>
                    </div>
                </div>
                <!-- level -->
                    <div class="mt-4">
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-primary h-3 rounded-full transition-all duration-500 ease-out" style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs mt-2">
                            <span class="text-sec font-medium">Level {{$user->level}}</span>
                            <span class="text-sec">{{$user->xp}} / {{$nextThreshold->required_xp ?? 'MAX'}}XP</span>
                        </div>
                    </div>
            </div>

            <!-- search bar -->
            <div class="relative group">
                <input type="text" placeholder="Search..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/20 transition-all">
                <i class="bi bi-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-primary/70 transition-colors"></i>
            </div>

            <!-- nav item -->
            <div class="flex flex-col flex-grow gap-1.5">
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 hover:pl-5">
                    <i class="bi bi-house-door-fill text-2xl text-primary/80"></i>
                    <span class="font-medium">Beranda</span>
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 hover:pl-5">
                    <i class="bi bi-clock-history text-2xl text-primary/80"></i>
                    <span class="font-medium">Riwayat Membaca</span>
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 hover:pl-5">
                    <i class="bi bi-award-fill text-2xl text-primary/80"></i>
                    <span class="font-medium">Pencapaian</span>
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 hover:pl-5">
                    <i class="bi bi-person-fill text-2xl text-primary/80"></i>
                    <span class="font-medium">Profile</span>
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 hover:pl-5">
                    <i class="bi bi-gear-fill text-2xl text-primary/80"></i>
                    <span class="font-medium">Pengaturan</span>
                </a>
            </div>
            <div class="pb-8">
                <a href="{{ route('logout') }}" class="flex items-center gap-3.5 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-all duration-200 hover:pl-5 group">
                    <i class="bi bi-box-arrow-left text-2xl group-hover:rotate-12 transition-transform"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </div>
</div>
