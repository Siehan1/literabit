@props(['bukus'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex min-h-screen">
        <script>
            const bukuDibaca = @json($dibacaSlugs); // jadi array JS
        </script>
        <x-utama.navside></x-utama.navside>

        <main class="w-[60%] ml-[20%] mr-[20%] bg-primary-100">
            <div class="px-8 py-6">
                <h1 class="font-poppins text-3xl font-bold text-teks text-center
                           bg-gradient-to-r from-primary-100 to-primary-50
                           p-6 rounded-xl shadow-sm
                           animate-fade-in">
                    Selamat datang kembali 
                    <span class="text-primary-600">{{ Auth::user()->name }}</span>
                    di Pulau Kelinci! <span class="animate-bounce inline-block">🐇</span>
                    <p class="text-xl mt-2 font-medium text-gray-600">
                        Ayo lanjutkan Progress Membaca mu
                    </p>
                </h1>
            </div>
        
            <div class="mx-3 mt-2 bg-white p-4 rounded-2xl">
                <div class="flex flex-row gap-4 items-center" >
                    <div class=" bg-secondary-200 flex items-center justify-center h-10 w-10 rounded-full">
                        <i class="bi bi-star-fill text-secondary-600 text-[24px] w-full text-center"></i>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="text-[18px] font-poppins text-teks font-medium">Level Penjelajah huruf</h1>
                        <p class="text-[14px] text-sec font-poppins">Baru mulai mengenal dunia membaca. Setiap kata adalah petualangan baru.</p>
                    </div>
                    <div class="ml-auto flex items-center gap-4">
                        <div class="px-4 py-2 bg-gradient-to-r from-green-50 to-green-100 
                                  rounded-full shadow-sm hover:shadow-md transition-all duration-300
                                  flex items-center gap-2">
                            <i class="bi bi-book text-green-600"></i>
                            <div class="text-sm font-poppins font-medium text-gray-700">
                                {{ Auth::user()->bukus ? Auth::user()->bukus->where('level_required', 0)->count() : 0 }}
                                <span class="text-green-600 font-semibold">/</span>
                                {{ $bukus->where('level_required', 0)->count() }}
                                <span class="text-gray-600">Buku</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel container -->
                <div class="relative mt-6 px-4">
                    <!-- Carousel track -->
                    <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                        <div class="flex gap-6 transition-transform duration-300 min-w-full p-4" style="-webkit-overflow-scrolling: touch;">
                            @foreach ($bukus as $buku)
                                @if ($buku->level_required == 0)
                                    <div class="flex-none w-64">
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
                                @endif
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

            <!-- level 1 -->
            <div class="mx-3 mt-2 {{ Auth::user()->level >= 1 ? 'bg-white' : 'bg-white/50' }} p-4 rounded-2xl relative">
                <!-- Locked overlay -->
                <div class="absolute inset-0 bg-gray-100/80 backdrop-blur-[2px] rounded-2xl 
                           flex flex-col items-center justify-center z-20
                           {{ Auth::user()->level >= 1 ? 'hidden' : '' }}">
                    <i class="bi bi-lock-fill text-4xl text-yellow-400 mb-3"></i>
                    <p class="text-gray-600 font-poppins text-center px-4">
                        Selesaikan level sebelumnya untuk membuka konten ini
                    </p>
                </div>

                <div class="flex flex-row gap-4 items-center opacity-50 {{ Auth::user()->level >= 1 ? 'opacity-100' : '' }}">
                    <div class="bg-yellow-100 flex items-center justify-center h-10 w-10 rounded-full">
                        <i class="bi bi-star-fill text-yellow-300 text-[24px] w-full text-center"></i>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="text-[18px] font-poppins text-teks font-medium">Pembaca pemula</h1>
                        <p class="text-[14px] text-sec font-poppins">Mulai menyelami halaman demi halaman. Buku-buku tipis jadi sahabat setia.</p>
                    </div>
                    <div class="ml-auto flex items-center gap-4">
                        <div class="px-4 py-2 bg-gradient-to-r from-yellow-50 to-yellow-100 
                                  rounded-full shadow-sm hover:shadow-md transition-all duration-300
                                  flex items-center gap-2">
                            <i class="bi bi-book text-yellow-600"></i>
                            <div class="text-sm font-poppins font-medium text-gray-700">
                                {{ Auth::user()->bukus ? Auth::user()->bukus->where('level_required', 1)->count() : 0 }}
                                <span class="text-yellow-600 font-semibold">/</span>
                                {{ $bukus->where('level_required', 1)->count() }}
                                <span class="text-gray-600">Buku</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel container -->
                <div class="relative mt-6 px-4">
                    <!-- Carousel track -->
                    <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                        <div class="flex gap-6 transition-transform duration-300 min-w-full p-4" style="-webkit-overflow-scrolling: touch;">
                            @foreach ($bukus as $buku)
                                @if ($buku->level_required == 1)
                                    <div class="flex-none w-64">
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
                                                <img src="{{asset('storage/'. $buku->cover_path)}}" alt="Book Cover" class="w-full h-full object-cover filter {{ Auth::user()->level >= 1 ? '' : 'grayscale' }}">
                                            </div>
                                            <div class="p-4">
                                                <h3 class="font-poppins font-semibold text-lg text-teks mb-2 truncate">{{$buku->judul}}</h3>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="bg-yellow-50 text-yellow-400 text-xs px-2 py-1 rounded-full">{{$buku->genre->nama_genre}}</span>
                                                </div>
                                                <p class="text-sec text-sm font-poppins">{{$buku->penulis}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                

            <!-- level 2 -->
            <div class="mx-3 mt-2 {{ Auth::user()->level >= 2 ? 'bg-white' : 'bg-white/50' }} p-4 rounded-2xl relative">
                <!-- Locked overlay -->
                <div class="absolute inset-0 bg-gray-100/80 backdrop-blur-[2px] rounded-2xl 
                           flex flex-col items-center justify-center z-20
                           {{ Auth::user()->level >= 2 ? 'hidden' : '' }}">
                    <i class="bi bi-lock-fill text-4xl text-blue-400 mb-3"></i>
                    <p class="text-gray-600 font-poppins text-center px-4">
                        Selesaikan level sebelumnya untuk membuka konten ini
                    </p>
                </div>

                <div class="flex flex-row gap-4 items-center opacity-50 {{ Auth::user()->level >= 2 ? 'opacity-100' : '' }}">
                    <div class="bg-blue-100 flex items-center justify-center h-10 w-10 rounded-full">
                        <div class="flex -gap-2">
                            <i class="bi bi-star-fill text-blue-300 text-[24px]"></i>
                            <i class="bi bi-star-fill text-blue-300 text-[24px]"></i>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="text-[18px] font-poppins text-teks font-medium">Pembaca pemula</h1>
                        <p class="text-[14px] text-sec font-poppins">Mulai menyelami halaman demi halaman. Buku-buku tipis jadi sahabat setia.</p>
                    </div>
                    <div class="ml-auto flex items-center gap-4">
                        <div class="px-4 py-2 bg-gradient-to-r from-blue-50 to-blue-100 
                                  rounded-full shadow-sm hover:shadow-md transition-all duration-300
                                  flex items-center gap-2">
                            <i class="bi bi-book text-blue-600"></i>
                            <div class="text-sm font-poppins font-medium text-gray-700">
                                {{ Auth::user()->bukus ? Auth::user()->bukus->where('level_required', 2)->count() : 0 }}
                                <span class="text-blue-600 font-semibold">/</span>
                                {{ $bukus->where('level_required', 2)->count() }}
                                <span class="text-gray-600">Buku</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel container -->
                <div class="relative mt-6 px-4">
                    <!-- Carousel track -->
                    <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                        <div class="flex gap-6 transition-transform duration-300 min-w-full p-4" style="-webkit-overflow-scrolling: touch;">
                            @foreach ($bukus as $buku)
                                @if ($buku->level_required == 2)
                                    <div class="flex-none w-64">
                                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                                            <div class="h-48 overflow-hidden">
                                                <img src="{{asset('storage/'. $buku->cover_path)}}" alt="Book Cover" class="w-full h-full object-cover filter {{ Auth::user()->level >= 2 ? '' : 'grayscale' }}">
                                            </div>
                                            <div class="p-4">
                                                <h3 class="font-poppins font-semibold text-lg text-teks mb-2 truncate">{{$buku->judul}}</h3>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="bg-blue-50 text-blue-400 text-xs px-2 py-1 rounded-full">{{$buku->genre->nama_genre}}</span>
                                                </div>
                                                <p class="text-sec text-sm font-poppins">{{$buku->penulis}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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


        <x-utama.navsideRight/>
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