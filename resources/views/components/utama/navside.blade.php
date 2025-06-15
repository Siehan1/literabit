<div id="navside" class="text-teks font-poppins transition-all duration-300 bg-white/95 backdrop-blur-sm shadow-lg fixed bottom-0 left-0 right-0 w-full h-[80px] py-2 z-40 lg:w-1/5 lg:fixed lg:px-6 lg:top-0 lg:shadow-lg lg:h-screen lg:py-0 lg:z-50">

    <div class="hidden lg:flex flex-row items-center gap-3 pt-8 pb-4 border-b-2 border-b-gray-200">
        <img src="{{ asset('asset/images/icon.svg') }}" alt="" class="w-12 hover:scale-105 transition-transform">
        <div id="brandText" class="flex flex-col gap-0.5 transition-opacity duration-300">
            <span class="text-primary font-bold text-[22px] tracking-tight">LittleRabbit</span>
            <span class="text-primary/80 font-medium text-[14px]">Little Reading Habbit</span>
        </div>
    </div>

    <div class="flex flex-row justify-around items-center h-full lg:flex-col lg:justify-between lg:h-[calc(100vh-100px)] lg:gap-4">

        <div class="hidden lg:block border-b-2 border-gray-200 py-4 w-full">
            <div class="flex flex-row gap-4 justify-start items-center group">
                <img src="{{ asset(Auth::user()->profil ? 'storage/' . Auth::user()->profil : 'profile_penulis/pro1.svg') }}" alt="foto_pengguna" class="w-17 h-17 rounded-full ring-2 ring-primary/20 group-hover:ring-primary/40 transition-all object-cover">
                <div class="flex flex-col">
                    <span class="text-teks font-medium">{{ Auth::user()->name }}</span>
                    <span class="text-sec text-[14px] opacity-75">Level {{$user->level}}</span>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-100 rounded-full h-3">
                    <div class="bg-primary h-3 rounded-full transition-all duration-500 ease-out" style="width: {{ $progress }}%"></div>
                </div>
                <div class="flex justify-between text-xs mt-2">
                    <span class="text-sec font-medium">Level {{$user->level}}</span>
                    <span class="text-sec">{{$user->xp}} / {{$nextThreshold->required_xp ?? 'MAX'}} XP</span>
                </div>
            </div>
        </div>

            <!-- search bar -->
            <form action="{{ route('buku.beranda') }}" method="GET">
                <div class="relative group hidden lg:block w-full">
                    <input type="text" placeholder="Cari buku atau Penulis" name="search" value="{{ request('search') }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/20 transition-all">
                    <i class="bi bi-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-primary/70 transition-colors"></i>
                </div>
            </form>

        <div class="flex flex-row justify-around items-center w-full lg:flex-col lg:flex-grow lg:gap-1.5">
            <a href="{{ route('buku.beranda') }}" class="flex flex-col items-center gap-1 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-1 active:scale-95 active:bg-primary/20 lg:w-full lg:flex-row lg:gap-3.5 lg:px-4 lg:py-3 lg:hover:pl-5">
                <i class="bi bi-house-door-fill text-xl text-primary/80 lg:text-2xl"></i>
                <span class="font-medium text-xs lg:text-base">Beranda</span>
            </a>
            <a href="{{ route('histori') }}" class="flex flex-col items-center gap-1 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-1 active:scale-95 active:bg-primary/20 lg:w-full lg:flex-row lg:gap-3.5 lg:px-4 lg:py-3 lg:hover:pl-5">
                <i class="bi bi-clock-history text-xl text-primary/80 lg:text-2xl"></i>
                <span class="font-medium text-xs lg:text-base">Riwayat</span>
            </a>
            <a href="{{route('pencapaian.index')}}" class="flex flex-col items-center gap-1 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-1 active:scale-95 active:bg-primary/20 lg:w-full lg:flex-row lg:gap-3.5 lg:px-4 lg:py-3 lg:hover:pl-5">
                <i class="bi bi-award-fill text-xl text-primary/80 lg:text-2xl"></i>
                <span class="font-medium text-xs lg:text-base">Pencapaian</span>
            </a>
            <a href="{{ route('profil') }}" class="flex flex-col items-center gap-1 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-1 active:scale-95 active:bg-primary/20 lg:w-full lg:flex-row lg:gap-3.5 lg:px-4 lg:py-3 lg:hover:pl-5">
                <i class="bi bi-person-fill text-xl text-primary/80 lg:text-2xl"></i>
                <span class="font-medium text-xs lg:text-base">Profil</span>
            </a>

            <a href="{{route('leaderboard')}}" class="hidden lg:flex flex-col items-center gap-1 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-1 active:scale-95 active:bg-primary/20 lg:w-full lg:flex-row lg:gap-3.5 lg:px-4 lg:py-3 lg:hover:pl-5">
                <i class="bi bi-trophy-fill text-xl text-primary/80 lg:text-2xl"></i>
                <span class="font-medium text-xs lg:text-base">Leaderboard</span>
            </a>

            <button onclick="toggleMobileMenu()" id="mobileMenuButton" class="flex flex-col items-center gap-1 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-1 active:scale-95 active:bg-primary/20 lg:hidden">
                <i id="mobileMenuIcon" class="bi bi-three-dots text-xl text-primary/80 transition-transform duration-200"></i>
                <span class="font-medium text-xs">More</span>
            </button>

            <div class="hidden lg:block pb-8 w-full">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3.5 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-all duration-200 hover:pl-5 group w-full text-left active:scale-95 active:bg-red-100">
                        <i class="bi bi-box-arrow-left text-2xl group-hover:rotate-12 transition-transform"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="mobileMenuOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden opacity-0 pointer-events-none lg:hidden items-center justify-center transition-opacity duration-300 ease-out">
    <div id="mobileMenuContent" class="bg-white rounded-lg shadow-xl p-4 mx-4 w-[90%] max-w-[280px] relative flex flex-col items-center gap-3 transform translate-y-full opacity-0 transition-all duration-300 ease-out">
        <button onclick="toggleMobileMenu()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl active:scale-90">&times;</button>

        <div class="flex flex-col items-center gap-2 pt-2 pb-3 border-b-2 border-b-gray-200 w-full">
            <img src="{{ asset('asset/images/icon.svg') }}" alt="" class="w-12 hover:scale-105 transition-transform">
            <div class="flex flex-col gap-0.5 text-center">
                <span class="text-primary font-bold text-lg tracking-tight">LittleRabbit</span>
                <span class="text-primary/80 font-medium text-xs">Little Reading Habbit</span>
            </div>
        </div>

        <div class="border-b-2 border-gray-200 py-3 w-full text-center">
            <div class="flex flex-col items-center gap-1.5">
                <img src="{{ asset('profile_penulis/pro1.svg') }}" alt="foto_pengguna" class="w-16 rounded-full ring-2 ring-primary/20">
                <div class="flex flex-col">
                    <span class="text-teks font-medium text-base">{{ Auth::user()->name }}</span>
                    <span class="text-sec text-xs opacity-75">Level {{$user->level}}</span>
                </div>
            </div>
            <div class="mt-3 px-2">
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                </div>
                <div class="flex justify-between text-[10px] mt-1.5">
                    <span class="text-sec font-medium">Level {{$user->level}}</span>
                    <span class="text-sec">{{$user->xp}} / {{$nextThreshold->required_xp ?? 'MAX'}} XP</span>
                </div>
            </div>
        </div>

        <div class="relative group w-full px-2">
            <input type="text" placeholder="Search..." class="w-full px-3 py-2 text-sm rounded-xl border border-gray-200 focus:outline-none focus:border-primary/50 focus:ring-2 focus:ring-primary/20 transition-all">
            <i class="bi bi-search absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
        </div>

        <a href="{{route('leaderboard')}}" class="w-full flex items-center justify-center gap-2 text-teks hover:bg-primary/10 rounded-xl transition-all duration-200 px-2 py-2 active:scale-95 active:bg-primary/20">
            <i class="bi bi-trophy-fill text-lg text-primary/80"></i>
            <span class="font-medium text-sm">Leaderboard</span>
        </a>

        <div class="w-full px-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 py-2 text-red-500 hover:bg-red-50 rounded-xl transition-all duration-200 group w-full active:scale-95 active:bg-red-100">
                    <i class="bi bi-box-arrow-left text-lg group-hover:rotate-12 transition-transform"></i>
                    <span class="font-medium text-sm">Logout</span>
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function toggleMobileMenu() {
        const overlay = document.getElementById('mobileMenuOverlay');
        const content = document.getElementById('mobileMenuContent');
        const buttonIcon = document.getElementById('mobileMenuIcon');

        if (overlay.classList.contains('hidden')) {
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            setTimeout(() => {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                content.classList.remove('translate-y-full', 'opacity-0');
            }, 10);

            buttonIcon.classList.remove('bi-three-dots');
            buttonIcon.classList.add('bi-x-lg', 'rotate-90');
        } else {
            content.classList.add('translate-y-full', 'opacity-0');
            overlay.classList.add('opacity-0', 'pointer-events-none');

            buttonIcon.classList.remove('bi-x-lg', 'rotate-90');
            buttonIcon.classList.add('bi-three-dots');

            setTimeout(() => {
                overlay.classList.remove('flex');
                overlay.classList.add('hidden');
            }, 300);
        }
    }

    document.getElementById('mobileMenuOverlay').addEventListener('click', function(event) {
        if (event.target === this) {
            toggleMobileMenu();
        }
    });
</script>
