@props(['buku'])

<section class="min-h-screen mb-4 font-poppins text-teks">
    <img src="{{ asset('asset/images/waveP.svg') }}" alt="" class="w-full">
    <div class="bg-wave -mt-4 px-4 pb-16" id="buku" >
        <div class="flex flex-col items-center text-center gap-3 mb-8">
            <span class="px-4 py-2 bg-celadon rounded-full lg:text-2xl">Buku Populer</span>
            <h3 class="text-[20px]">Temukan kisah seru dari buku anak-anak favorit</h3>
            <p class="text-sec text-[18px] lg:w-[800px]">Biarkan si kecil menikmati cerita-cerita seru, membangkitkan imajinasi dan menumbuhkan cinta membaca setiap hari.</p>
        </div>
        <div class="px-7 flex flex-wrap gap-7 lg:gap-12 justify-center">
            @php
                $rotate = ['rotate-3', '-rotate-2', 'rotate-2', '-rotate-3','rotate-6']
            @endphp


            @foreach (array_slice($buku, 0, 4) as $index => $books)
                <div class="transform {{ $rotate[$index] }}">
                    <x-card-buku
                        :cover="$books['cover']"
                        :judul="$books['judul']"
                        :penulis="$books['penulis']"
                        :profile="$books['profile']"
                        :genre="$books['genre']"
                    ></x-card-buku>
                </div>
            @endforeach
        </div>
    </div>
    <img src="{{ asset('asset/images/waveP.svg') }}" alt="" class="w-full rotate-180 -mt-2">
</section>