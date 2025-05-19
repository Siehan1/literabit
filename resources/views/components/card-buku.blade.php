<div class="w-32 md:w-44 lg:w-64 bg-white rounded-3xl p-1.5 md:p-3 lg:p-5 shadow-prim font-poppins waves waves-effect cursor-pointer hover:scale-105 transition-transform duration-200" style="--wave-color: rgba(249, 149, 26, 0.3);">
    <div class="relative">
        <div class="absolute top-2 -right-[5.5px] z-10 flex items-center">
            <img src="{{ asset('asset/images/label_buku.svg') }}" alt="label" class="w-16 md:w-22 lg:w-28">
            <span class="absolute text-teks w-full text-center -top-0 text-[10px] md:text-[13px] lg:text-base">{{$genre}}</span>
        </div>
        <img src="{{ asset('storage/' . $cover)}}" alt="buku" class="rounded-2xl w-full h-36 md:h-44 lg:h-56 object-containt">
    </div>

    <div class="mt-2 md:mt-3">
        <h1 class="text-base md:text-xl lg:text-2xl font-semibold text-teks">{{ $judul }}</h1>
        <div class="flex items-center gap-1.5 md:gap-2 mt-1.5 md:mt-2">
            <img src="{{ asset('profile_penulis/pro1.svg') }}" alt="penulis" class="w-5 md:w-7 lg:w-10 h-5 md:h-7 lg:h-10 rounded-full">
            <p class="text-[10px] md:text-sm lg:text-base text-sec">By {{$penulis}}</p>
        </div>
    </div>
</div>