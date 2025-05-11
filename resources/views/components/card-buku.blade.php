<div class="w-36 md:w-44 lg:w-52 bg-white rounded-3xl p-2 md:p-3 lg:p-4 shadow-prim font-poppins">
    <div class="relative">
        <div class="absolute top-2 -right-[5.5px] z-10 flex items-center">
            <img src="{{ asset('asset/images/label_buku.svg') }}" alt="label" class="w-20 md:w-22 lg:w-24">
            <span class="absolute text-teks w-full text-center -top-0 text-[12px] md:text-[13px] lg:text-[14px]">{{$genre}}</span>
        </div>
        <img src="{{ asset($cover) }}" alt="buku" class="rounded-2xl w-full h-40 md:h-44 lg:h-48 object-cover">
    </div>

    <div class="mt-3">
        <h1 class="text-lg md:text-xl lg:text-xl font-semibold text-teks truncate">{{ $judul }}</h1>
        <div class="flex items-center gap-2 mt-2">
            <img src="{{ asset($profile) }}" alt="penulis" class="w-6 md:w-7 lg:w-8 h-6 md:h-7 lg:h-8 rounded-full">
            <p class="text-xs md:text-sm lg:text-sm text-sec">By {{$penulis}}</p>
        </div>
    </div>
</div>