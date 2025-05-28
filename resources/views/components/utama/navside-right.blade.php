<aside class="w-1/5 text-teks font-poppins px-6 fixed top-0 right-0 min-h-screen z-10 bg-white/95 backdrop-blur-sm shadow-[-3px_0_12px_0_rgba(0,0,0,0.08)]">
    {{-- Header Section --}}
    <div class="pt-10 pb-6 text-center">
        <h2 class="text-2xl font-bold text-teks tracking-wide">Pencapaian</h2>
    </div>

    {{-- Daily Missions Section --}}
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-teks font-semibold text-lg">Misi Harian</h3>
            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium">1/3</span>
        </div>
        
        <div class="p-4 bg-wave rounded-2xl hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-[15px] font-medium">Baca Buku</h3>
                <span class="text-sec text-xs px-2 py-1 bg-sec/10 rounded-full">Hari ini</span>
            </div>
            
            <div class="text-sm text-sec mb-3">
                <p class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                    Reward 10xp
                </p>
            </div>
            
            <div class="space-y-2">
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-celadon h-2 rounded-full transition-all duration-300" style="width: 45%"></div>
                </div>
                <p class="text-xs text-gray-500">45% Complete</p>
            </div>
        </div>
    </div>

    {{-- Badges Section --}}
    <div class="mt-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-teks font-semibold text-lg">Lencana</h3>
            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium">
                {{ count(auth()->user()->badges) }}/{{ \App\Models\Badge::count() }}
            </span>
        </div>
        
        <div class="grid grid-cols-2 gap-3">
            @foreach (auth()->user()->badges as $badge)
            <div class="p-3 bg-wave rounded-2xl hover:shadow-md transition-all duration-300">
                <div class="flex flex-col items-center" data-bs-toggle="tooltip" title="{{ $badge->nama_badge }}">
                    <img 
                        src="{{ asset('storage/' . $badge->icon_path) }}" 
                        alt="{{ $badge->nama_badge }}"
                        class="w-16 h-16 object-contain mb-2">
                    <p class="text-xs text-gray-600 font-medium text-center line-clamp-1">
                        {{$badge->nama_badge}}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</aside>
