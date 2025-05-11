<div class="w-52 bg-white rounded-3xl p-4 shadow-prim font-poppins">
    <div class="relative">
        <div class="absolute top-2 -right-[5.5px] z-10">
            <img src="{{ asset('asset/images/label_buku.svg') }}" alt="label" class="w-24">
            <span class="absolute -top-[1px] right-[5px] text-[14px]">{{$genre}}</span>
        </div>
        <img src="{{ asset($cover) }}" alt="buku" class="rounded-2xl w-full h-48 object-cover">
    </div>

    <div class="mt-3">
        <h1 class="text-xl font-semibold text-teks">{{ $judul }}</h1>
        <div class="flex items-center gap-2 mt-2">
            <img src="{{ asset($profile) }}" alt="penulis" class="w-8 h-8 rounded-full">
            <p class="text-sm text-sec">By {{$penulis}}</p>
        </div>
    </div>
</div>