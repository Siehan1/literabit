@props(['bukus'])
@props(['userMissions'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beranda | LittleRabbit</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="flex flex-col min-h-screen md:flex-row bg-primary-100"> {{-- Base is flex-col for mobile, md:flex-row for larger screens, added bg-primary-100 to body --}}
    <script>
        const bukuDibaca = @json($dibacaSlugs); // jadi array JS
    </script>

    {{-- Sidebar component (will act as bottom nav on mobile) --}}
    {{-- Ensure this component itself has classes like 'fixed bottom-0 left-0 w-full md:relative md:block' for responsive bottom nav on mobile --}}
    <x-utama.navside></x-utama.navside>

    <main class="flex-1 w-full px-4 py-6 md:px-8 md:py-8 lg:w-[calc(100%-250px)] lg:ml-[250px] lg:mr-[250px] max-w-7xl mx-auto"> {{-- Adjusted main width and centering for larger screens --}}
        @if(session('success'))
            <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded my-4 mx-auto flex flex-row gap-1.5 transition-opacity duration-500 ease-in-out max-w-md">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            </div>
        @endif
        @php
            $hour = now()->hour;

            if ($hour < 12) {
                $greeting = "Selamat pagi";
                $messages = [
                    "Yuk mulai pagi ini dengan cerita seru 📖🌞",
                    "Pagi yang cerah untuk membuka halaman baru. Siap petualangan baru? 🐰✨",
                    "Awali hari dengan semangat membaca! Banyak kisah seru menantimu 🌤️📚"
                ];
            } elseif ($hour < 17) {
                $greeting = "Selamat siang";
                $messages = [
                    "Yuk lanjutkan menjelajah dunia buku 📚☀️",
                    "Siang yang pas buat baca buku sambil bersantai. Pilih ceritamu! 🐇🕶️",
                    "Cerita baru siap ditemukan. Ayo eksplor Pulau Kelinci! 📘🌼"
                ];
            } else {
                $greeting = "Selamat malam";
                $messages = [
                    "Waktunya bersantai sambil tenggelam dalam cerita yang hangat 🌙📖",
                    "Pulau Kelinci masih menyimpan kisah-kisah ajaib 🌌🐇",
                    "Hari belum lengkap tanpa satu bab penuh keajaiban. Yuk lanjut baca 💫📚"
                ];
            }

            $message = $messages[array_rand($messages)];
        @endphp

        <div class="px-2 py-4 md:px-4 md:py-6"> {{-- Adjusted padding for greeting section --}}
            <h1 class="font-poppins text-2xl font-bold text-teks text-center bg-gradient-to-r from-primary-100 to-primary-50 p-4 rounded-xl shadow-sm animate-fade-in md:text-3xl lg:p-6">

                {{ $greeting }}, <span class="text-primary-600">{{ Auth::user()->name }}</span>!
                Selamat datang kembali
                di Pulau Kelinci! <span class="animate-bounce inline-block">🐇</span>
                <p class="text-base mt-2 font-medium text-gray-600 md:text-xl"> {{-- Adjusted font size for message --}}
                    {{ $message }}
                </p>
            </h1>
        </div>

        {{-- Level 0 section --}}
        <div class="mx-auto mt-4 bg-white p-4 rounded-2xl md:p-6 max-w-full lg:max-w-4xl"> {{-- Centered and added max-width --}}
            <div class="flex flex-col gap-3 items-start md:flex-row md:gap-4 md:items-center"> {{-- Adjusted flex direction for mobile --}}
                <div class="bg-secondary-200 flex items-center justify-center h-9 w-9 rounded-full flex-shrink-0 md:h-10 md:w-10"> {{-- Adjusted size --}}
                    <i class="bi bi-star-fill text-secondary-600 text-2xl w-full text-center md:text-[24px]"></i> {{-- Adjusted size --}}
                </div>
                <div class="flex flex-col justify-center">
                    <h1 class="text-base font-poppins text-teks font-medium md:text-[18px]">Level Penjelajah huruf</h1> {{-- Adjusted font size --}}
                    <p class="text-xs text-sec font-poppins md:text-[14px]">Baru mulai mengenal dunia membaca. Setiap kata adalah petualangan baru.</p> {{-- Adjusted font size --}}
                </div>
                <div class="ml-auto flex items-center gap-2 mt-2 md:mt-0 md:gap-4"> {{-- Adjusted margin-top for mobile --}}
                    <div class="px-3 py-1.5 bg-gradient-to-r from-green-50 to-green-100
                                 rounded-full shadow-sm hover:shadow-md transition-all duration-300
                                 flex items-center gap-1.5 md:px-4 md:py-2 md:gap-2"> {{-- Adjusted padding and gap --}}
                        <i class="bi bi-book text-green-600 text-sm md:text-base"></i> {{-- Adjusted font size --}}
                        <div class="text-xs font-poppins font-medium text-gray-700 md:text-sm"> {{-- Adjusted font size --}}
                            {{ Auth::user()->histories()->where('status', 'completed')->count() }}
                            <span class="text-green-600 font-semibold">/</span>
                            {{ $bukus->where('level_required', 0)->count() }}
                            <span class="text-gray-600">Buku</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative mt-4 px-2 md:px-4"> {{-- Adjusted padding for carousel container --}}
                <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                    <div class="flex gap-4 transition-transform duration-300 min-w-full p-2 md:gap-6 md:p-4" style="-webkit-overflow-scrolling: touch;"> {{-- Adjusted padding and gap --}}
                        @foreach ($bukus as $buku)
                            @if ($buku->level_required == 0)
                                <div class="flex-none w-40 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 md:w-64"> {{-- Adjusted width for mobile --}}
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
                                        <div class="h-32 overflow-hidden md:h-48"> {{-- Adjusted height for mobile --}}
                                            <img src="{{asset('storage/'. $buku->cover_path)}}" alt="Book Cover" class="w-full h-full object-cover">
                                        </div>
                                        <div class="p-2 md:p-4"> {{-- Adjusted padding --}}
                                            <h3 class="font-poppins font-semibold text-sm text-teks mb-1 truncate md:text-lg md:mb-2">{{$buku->judul}}</h3> {{-- Adjusted font size --}}
                                            <div class="flex items-center gap-1 mb-1 md:gap-2 md:mb-2"> {{-- Adjusted gap and margin-bottom --}}
                                                <span class="bg-green-100 text-green-600 text-xs px-1.5 py-0.5 rounded-full md:px-2 md:py-1">{{$buku->genre->nama_genre}}</span> {{-- Adjusted padding and font size --}}
                                            </div>
                                            <p class="text-sec text-xs font-poppins md:text-sm">{{$buku->penulis}}</p> {{-- Adjusted font size --}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <button onclick="scrollCarousel(event, 'left')" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -ml-1
                                 md:p-2 md:-ml-2 hidden md:block"> {{-- Hidden on mobile --}}
                    <i class="bi bi-chevron-left text-lg md:text-xl text-gray-600"></i>
                </button>
                <button onclick="scrollCarousel(event, 'right')" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -mr-1
                                 md:p-2 md:-mr-2 hidden md:block"> {{-- Hidden on mobile --}}
                    <i class="bi bi-chevron-right text-lg md:text-xl text-gray-600"></i>
                </button>
            </div>
        </div>

        {{-- Level 1 section --}}
        <div class="mx-auto mt-4 {{ Auth::user()->level >= 1 ? 'bg-white' : 'bg-white/50' }} p-4 rounded-2xl relative mb-4 md:p-6 max-w-full lg:max-w-4xl"> {{-- Centered and added max-width --}}
            <div class="absolute inset-0 bg-gray-100/80 backdrop-blur-[2px] rounded-2xl
                        flex flex-col items-center justify-center z-20
                        {{ Auth::user()->level >= 1 ? 'hidden' : '' }}">
                <i class="bi bi-lock-fill text-3xl mb-2 md:text-4xl md:mb-3 text-yellow-400"></i>
                <p class="text-sm text-gray-600 font-poppins text-center px-4 md:text-base">
                    Selesaikan level sebelumnya untuk membuka konten ini
                </p>
            </div>

            <div class="flex flex-col gap-2 items-start opacity-50 {{ Auth::user()->level >= 1 ? 'opacity-100' : '' }}
                        md:flex-row md:gap-4 md:items-center">
                <div class="bg-yellow-100 flex items-center justify-center h-8 w-8 rounded-full flex-shrink-0 md:h-10 md:w-10">
                    <i class="bi bi-star-fill text-yellow-300 text-[20px] md:text-[24px]"></i>
                </div>
                <div class="flex flex-col justify-center">
                    <h1 class="text-base font-poppins text-teks font-medium md:text-[18px]">Pembaca pemula</h1>
                    <p class="text-xs text-sec font-poppins md:text-[14px]">Mulai menyelami halaman demi halaman. Buku-buku tipis jadi sahabat setia.</p>
                </div>
                <div class="ml-auto flex items-center gap-2 mt-2 md:gap-4 md:mt-0">
                    <div class="px-3 py-1 bg-gradient-to-r from-yellow-50 to-yellow-100
                                 rounded-full shadow-sm hover:shadow-md transition-all duration-300
                                 flex items-center gap-1 md:px-4 md:py-2 md:gap-2">
                        <i class="bi bi-book text-yellow-600 text-sm md:text-base"></i>
                        <div class="text-xs font-poppins font-medium text-gray-700 md:text-sm">
                            {{ Auth::user()->histories()->where('status', 'completed')->whereHas('buku', function($query) { $query->where('level_required', 1); })->count() }}
                            <span class="text-yellow-600 font-semibold">/</span>
                            {{ $bukus->where('level_required', 1)->count() }}
                            <span class="text-gray-600">Buku</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative mt-4 px-2 md:px-4">
                <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                    <div class="flex gap-4 transition-transform duration-300 min-w-full p-2 md:gap-6 md:p-4" style="-webkit-overflow-scrolling: touch;">
                        @foreach ($bukus as $buku)
                            @if ($buku->level_required == 1)
                                <div class="flex-none w-40 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 md:w-64">
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
                                        <div class="h-32 overflow-hidden md:h-48">
                                            <img src="{{asset('storage/'. $buku->cover_path)}}" alt="Book Cover" class="w-full h-full object-cover filter {{ Auth::user()->level >= 1 ? '' : 'grayscale' }}">
                                        </div>
                                        <div class="p-2 md:p-4">
                                            <h3 class="font-poppins font-semibold text-sm text-teks mb-1 truncate md:text-lg md:mb-2">{{$buku->judul}}</h3>
                                            <div class="flex items-center gap-1 mb-1 md:gap-2 md:mb-2">
                                                <span class="bg-yellow-100 text-yellow-400 text-xs px-1.5 py-0.5 rounded-full md:px-2 md:py-1">{{$buku->genre->nama_genre}}</span>
                                            </div>
                                            <p class="text-sec text-xs font-poppins md:text-sm">{{$buku->penulis}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <button onclick="scrollCarousel(event, 'left')" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -ml-1
                                 md:p-2 md:-ml-2 hidden md:block">
                    <i class="bi bi-chevron-left text-lg md:text-xl text-gray-600"></i>
                </button>
                <button onclick="scrollCarousel(event, 'right')" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -mr-1
                                 md:p-2 md:-mr-2 hidden md:block">
                    <i class="bi bi-chevron-right text-lg md:text-xl text-gray-600"></i>
                </button>
            </div>
        </div>

        {{-- Level 2 section --}}
        <div class="mx-auto mt-4 mb-4 bg-white p-4 rounded-2xl relative
                     md:p-6 max-w-full lg:max-w-4xl {{ Auth::user()->level >= 2 ? 'bg-white' : 'bg-white/50' }}"> {{-- Centered and added max-width --}}
            <div class="absolute inset-0 bg-gray-100/80 backdrop-blur-[2px] rounded-2xl
                        flex flex-col items-center justify-center z-20
                        {{ Auth::user()->level >= 2 ? 'hidden' : '' }}">
                <i class="bi bi-lock-fill text-3xl mb-2 md:text-4xl md:mb-3 text-blue-400"></i>
                <p class="text-sm text-gray-600 font-poppins text-center px-4 md:text-base">
                    Selesaikan level sebelumnya untuk membuka konten ini
                </p>
            </div>

            <div class="flex flex-col gap-2 items-start opacity-50 {{ Auth::user()->level >= 2 ? 'opacity-100' : '' }}
                        md:flex-row md:gap-4 md:items-center">
                <div class="bg-blue-100 flex items-center justify-center h-8 w-8 rounded-full flex-shrink-0 md:h-10 md:w-10">
                    <div class="flex -gap-1 md:-gap-2">
                        <i class="bi bi-star-fill text-blue-300 text-[20px] md:text-[24px]"></i>
                        <i class="bi bi-star-fill text-blue-300 text-[20px] md:text-[24px]"></i>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h1 class="text-base font-poppins text-teks font-medium md:text-[18px]">Pembaca ahli</h1>
                    <p class="text-xs text-sec font-poppins md:text-[14px]">Mulai menyelami halaman demi halaman. Buku-buku tebal jadi sahabat setia.</p>
                </div>
                <div class="ml-auto flex items-center gap-2 mt-2 md:gap-4 md:mt-0">
                    <div class="px-3 py-1 bg-gradient-to-r from-blue-50 to-blue-100
                                 rounded-full shadow-sm hover:shadow-md transition-all duration-300
                                 flex items-center gap-1 md:px-4 md:py-2 md:gap-2">
                        <i class="bi bi-book text-blue-600 text-sm md:text-base"></i>
                        <div class="text-xs font-poppins font-medium text-gray-700 md:text-sm">
                            {{ Auth::user()->histories()->where('status', 'completed')->whereHas('buku', function($query) { $query->where('level_required', 2); })->count() }}
                            <span class="text-blue-600 font-semibold">/</span>
                            {{ $bukus->where('level_required', 2)->count() }}
                            <span class="text-gray-600">Buku</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative mt-4 px-2 md:px-4">
                <div class="overflow-x-auto scrollbar-hide" style="-ms-overflow-style: none; scrollbar-width: none;">
                    <div class="flex gap-4 transition-transform duration-300 min-w-full p-2 md:gap-6 md:p-4" style="-webkit-overflow-scrolling: touch;">
                        @foreach ($bukus as $buku)
                            @if ($buku->level_required == 2)
                                <div class="flex-none w-40 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 md:w-64">
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
                                        <div class="h-32 overflow-hidden md:h-48">
                                            <img src="{{asset('storage/'. $buku->cover_path)}}" alt="Book Cover" class="w-full h-full object-cover filter {{ Auth::user()->level >= 2 ? '' : 'grayscale' }}">
                                        </div>
                                        <div class="p-2 md:p-4">
                                            <h3 class="font-poppins font-semibold text-sm text-teks mb-1 truncate md:text-lg md:mb-2">{{$buku->judul}}</h3>
                                            <div class="flex items-center gap-1 mb-1 md:gap-2 md:mb-2">
                                                <span class="bg-blue-50 text-blue-400 text-xs px-1.5 py-0.5 rounded-full md:px-2 md:py-1">{{$buku->genre->nama_genre}}</span>
                                            </div>
                                            <p class="text-sec text-xs font-poppins md:text-sm">{{$buku->penulis}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <button onclick="scrollCarousel(event, 'left')" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -ml-1
                                 md:p-2 md:-ml-2 hidden md:block">
                    <i class="bi bi-chevron-left text-lg md:text-xl text-gray-600"></i>
                </button>
                <button onclick="scrollCarousel(event, 'right')" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -mr-1
                                 md:p-2 md:-mr-2 hidden md:block">
                    <i class="bi bi-chevron-right text-lg md:text-xl text-gray-600"></i>
                </button>
            </div>
        </div>
    </main>

    {{-- Modal Buku Detail --}}
    <div id="modalBuku"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">

        <div id="modalContentBuku" class="relative rounded-2xl p-6 w-full max-w-sm bg-white shadow-xl overflow-y-auto max-h-[90vh]
                                          md:p-8 md:max-w-xl lg:max-w-2xl"> {{-- Added lg:max-w-2xl for even larger screens --}}

            <button onclick="closeModalDetailBuku()"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl font-bold
                       md:top-4 md:right-4 md:text-2xl">
                &times;
            </button>

            <div class="flex justify-center mb-3 md:mb-4">
                <img id="modalCover" src="" alt="Cover Buku" class="w-32 h-48 object-cover rounded-md shadow-md md:w-40 md:h-60 lg:w-48 lg:h-72"> {{-- Adjusted image size for larger screens --}}
            </div>

            <h2 id="modalJudul" class="text-xl font-bold text-center text-teks mb-1 leading-tight md:text-2xl md:mb-2 lg:text-3xl"></h2> {{-- Adjusted font size for larger screens --}}

            <p class="text-center text-gray-600 font-medium text-sm mb-1 md:text-base md:mb-2 lg:text-lg"> {{-- Adjusted font size for larger screens --}}
                Penulis: <span id="modalPenulis"></span>
            </p>
            <p class="text-center mb-3 md:mb-4">
                <span id="modalGenre" class="text-white bg-green-500 text-xs rounded-full inline-block px-2 py-0.5 md:text-sm md:px-3 md:py-1">
                </span>
            </p>

            <div class="text-justify text-gray-700 text-sm mb-4 max-h-32 overflow-y-auto md:text-base md:mb-6 md:max-h-40 lg:max-h-60"> {{-- Adjusted max-height for larger screens --}}
                <p id="modalSinopsis"></p>
            </div>

            <div class="flex justify-center">
                <a id="modalLinkBaca" href="#"
                    class="px-5 py-2 rounded-xl text-white font-bold text-base bg-[#34A853] shadow-[0_4px_0_#2C8E46]
                           hover:-translate-y-0.5 active:translate-y-1 active:shadow-none transition-all
                           md:px-6 md:py-3 md:text-lg md:shadow-[0_6px_0_#2C8E46] lg:px-8 lg:py-4 lg:text-xl"> {{-- Adjusted button padding and font size for larger screens --}}
                    MULAI BACA
                </a>
            </div>
        </div>
    </div>

    {{-- NavsideRight component --}}
    {{-- Assuming navsideRight is only for desktop, or has its own responsive logic --}}
    <x-utama.navsideRight />

    <script>
        function scrollCarousel(event, direction) {
            event.preventDefault();
            // Find the closest parent with 'relative' and then its child with 'overflow-x-auto > div'
            let carouselTrack = event.target.closest('.relative').querySelector('.overflow-x-auto > div');
            const scrollAmount = 300; // Increased scroll amount for smoother scroll

            if (direction === 'left') {
                carouselTrack.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            } else {
                carouselTrack.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }

        function openModalDetailBuku(el) {
            document.getElementById('modalJudul').innerText = el.dataset.judul;
            document.getElementById('modalPenulis').innerText = el.dataset.penulis;
            document.getElementById('modalSinopsis').innerText = el.dataset.sinopsis;
            document.getElementById('modalCover').src = el.dataset.cover;

            let modalgenre = document.getElementById('modalGenre');
            modalgenre.innerText = el.dataset.genre;

            // Remove all existing background classes before adding the correct one
            modalgenre.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-blue-500');

            let level = el.dataset.level;
            if (level == "1") {
                modalgenre.classList.add('bg-yellow-500');
            } else if (level == "2") {
                modalgenre.classList.add('bg-blue-500');
            } else {
                modalgenre.classList.add('bg-green-500');
            }

            let slug = el.dataset.slug;
            let bacaUrl = `{{ url('baca-buku') }}/${slug}`;
            document.getElementById('modalLinkBaca').href = bacaUrl;

            const tombol = document.getElementById('modalLinkBaca');
            // Remove existing button style classes before adding new ones
            tombol.classList.remove('bg-[#34A853]', 'shadow-[0_4px_0_#2C8E46]', 'bg-[#FBB45E]', 'shadow-[0_4px_0_#D9963D]');
            tombol.classList.remove('md:shadow-[0_6px_0_#2C8E46]', 'md:shadow-[0_6px_0_#D9963D]'); // Also remove md shadows

            if (bukuDibaca.includes(slug)) {
                tombol.innerText = "LANJUT BACA";
                tombol.classList.add('bg-[#FBB45E]', 'shadow-[0_4px_0_#D9963D]', 'md:shadow-[0_6px_0_#D9963D]');
            } else {
                tombol.innerText = "MULAI BACA";
                tombol.classList.add('bg-[#34A853]', 'shadow-[0_4px_0_#2C8E46]', 'md:shadow-[0_6px_0_#2C8E46]');
            }
            document.getElementById('modalBuku').classList.remove('hidden');
        }

        function closeModalDetailBuku() {
            document.getElementById('modalBuku').classList.add('hidden');
        }

        // Flash message fade out
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.classList.add('opacity-0');
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);
    </script>
</body>
</html>
