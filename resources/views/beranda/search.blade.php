@props(['bukus'])
@props(['userMisions'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beranda | LittleRabbit</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex min-h-screen">
        <script>
            const bukuDibaca = @json($dibacaSlugs); // jadi array JS
        </script>
        <x-utama.navside></x-utama.navside>

        <main class="w-[60%] ml-[20%] mr-[20%] bg-primary-100">

            <div class="px-8 py-6">
                <h1 class="font-poppins text-3xl font-bold text-teks text-center bg-gradient-to-r from-primary-100 to-primary-50 p-6 rounded-xl shadow-sm animate-fade-in">
                    Hasil pencarian untuk
                    <span class="text-primary-600">{{$keyword}}</span>
                    <span class="animate-bounce inline-block">🔍</span>

                </h1>
            </div>

            @php
                $notFoundMessages = [
                    "Hmm... buku yang kamu cari belum ditemukan 🧐",
                    "Sepertinya rak buku belum menyimpan cerita itu. Mau coba petualangan baru? 📚🐇",
                    "Ups! Buku itu mungkin sedang bersembunyi... coba cari dengan kata lain ya! 🔍",
                    "Tidak ketemu, tapi jangan menyerah! Dunia Pulau Kelinci penuh kejutan! ✨🐰"
                ];
                $randomNotFound = $notFoundMessages[array_rand($notFoundMessages)];
            @endphp
            @if($bukus->isEmpty())
                <div class="text-center mt-6 text-gray-600">
                    <p class="text-xl font-semibold mb-2">{{ $randomNotFound }}</p>
                    <div class="flex justify-center my-6">
                        <img src="{{ asset('asset/images/kelinci_search.png') }}"
                             alt="Tidak ditemukan"
                             class="w-36 md:w-44 lg:w-56 max-w-full h-auto">
                    </div>
                    <p class="text-gray-500">Coba periksa kembali kata kuncimu atau telusuri cerita lainnya.</p>
                </div>
            @else
            <div class="mx-3 mt-2 bg-white p-4 rounded-2xl">

                <!-- Carousel container -->
                <div class="relative mt-6 px-4">
                    <!-- Carousel track -->
                    <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                        <div class="flex gap-6 transition-transform duration-300 min-w-full p-4" style="-webkit-overflow-scrolling: touch;">
                            @foreach ($bukus as $buku)
                                    <div class="flex-none w-64 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer"
                                        onclick="openModalDetailBuku(this)"
                                        data-slug="{{ $buku->slug }}"
                                        data-level="{{ $buku->level_required }}"
                                        data-judul="{{ $buku->judul }}"
                                        data-penulis="{{ $buku->penulis }}"
                                        data-genre="{{ $buku->genre->nama_genre }}"
                                        data-cover="{{ asset('storage/' . $buku->cover_path) }}"
                                        data-sinopsis="{{ $buku->sinopsis }}"
                                        >
                                            <div class="h-48 overflow-hidden">
                                                <img src="{{asset('storage/'. $buku->cover_path)}}" alt="Book Cover" class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-4">
                                                <h3 class="font-poppins font-semibold text-lg text-teks mb-2 truncate">{{$buku->judul}}</h3>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">{{$buku->genre->nama_genre}}</span>
                                                </div>
                                                <p class="text-sec text-sm font-poppins">{{$buku->penulis}}</p>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation buttons -->
                    <button onclick="scrollCarousel('left')" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-md z-10 -ml-2">
                        <i class="bi bi-chevron-left text-xl text-gray-600"></i>
                    </button>
                    <button onclick="scrollCarousel('right')" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-md z-10 -mr-2">
                        <i class="bi bi-chevron-right text-xl text-gray-600"></i>
                    </button>
                </div>
            </div>
            @endif

        </main>
        <!-- Modal Buku Detail -->
        <div id="modalBuku"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">

        <div id="modalContentBuku" class="relative rounded-2xl p-8 w-[90%] max-w-xl bg-white shadow-xl">

            <!-- Tombol close -->
            <button onclick="closeModalDetailBuku()"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold">
                &times;
            </button>

            <!-- Gambar Cover -->
            <div class="flex justify-center mb-4">
                <img id="modalCover" src="" alt="Cover Buku" class="w-40 h-60 object-cover rounded-md shadow-md">
            </div>

            <!-- Judul Buku -->
            <h2 id="modalJudul" class="text-2xl font-bold text-center text-teks mb-2"></h2>

            <!-- Penulis dan Genre -->
            <p class="text-center text-gray-600 font-medium mb-2">
                Penulis: <span id="modalPenulis"></span>
            </p>
            <p class="text-center mb-4">
                <span id="modalGenre" class="text-white bg-green-500 text-sm rounded-full inline-block px-3 py-1">
                </span>
            </p>

            <!-- Sinopsis -->
            <div class="text-justify text-gray-700 mb-6 max-h-40 overflow-y-auto">
                <p id="modalSinopsis"></p>
            </div>

            <!-- Tombol Baca -->
            <div class="flex justify-center">
                <a id="modalLinkBaca" href="#"
                    class="px-6 py-3 rounded-xl text-white font-bold text-lg bg-[#34A853] shadow-[0_6px_0_#2C8E46]
                        hover:-translate-y-0.5 active:translate-y-1 active:shadow-none transition-all">
                    MULAI BACA
                </a>
            </div>
        </div>
        </div>

        <x-utama.navsideRight />
        <script>
            function openModalDetailBuku(el) {
                document.getElementById('modalJudul').innerText = el.dataset.judul;
                document.getElementById('modalPenulis').innerText = el.dataset.penulis;
                document.getElementById('modalSinopsis').innerText = el.dataset.sinopsis;
                document.getElementById('modalCover').src = el.dataset.cover;

                // Genre tag
                let modalgenre = document.getElementById('modalGenre');
                modalgenre.innerText = el.dataset.genre;

                // Reset kelas warna sebelumnya
                modalgenre.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-blue-500');

                let level = el.dataset.level;
                if (level == "1") {
                    modalgenre.classList.add('bg-yellow-500');
                } else if (level == "2") {
                    modalgenre.classList.add('bg-blue-500');
                } else {
                    modalgenre.classList.add('bg-green-500');
                }

                // Link baca
                let slug = el.dataset.slug;
                let bacaUrl = `{{ url('baca-buku') }}/${slug}`;
                document.getElementById('modalLinkBaca').href = bacaUrl;

                const tombol = document.getElementById('modalLinkBaca');
                tombol.classList.remove('bg-[#34A853]', 'bg-[#FBB45E]', 'shadow-[0_6px_0_#2C8E46]', 'shadow-[0_6px_0_#D9963D]');

                if (bukuDibaca.includes(slug)) {
                    tombol.innerText = "LANJUT BACA";
                    tombol.classList.add('bg-[#FBB45E]', 'shadow-[0_6px_0_#D9963D]');
                } else {
                    tombol.innerText = "MULAI BACA";
                    tombol.classList.add('bg-[#34A853]', 'shadow-[0_6px_0_#2C8E46]');
                }
                // Tampilkan modal
                document.getElementById('modalBuku').classList.remove('hidden');
            }

            function closeModalDetailBuku() {
                document.getElementById('modalBuku').classList.add('hidden');
            }
        </script>


</body>
</html>
