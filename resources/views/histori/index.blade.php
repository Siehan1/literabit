<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History | LittleRabbit</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- Tambahkan CDN untuk Bootstrap Icons jika belum ada di app.css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Custom Keyframes for fade-in effect on greeting */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Custom scrollbar for modal sinopsis */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Basic transitions for modal for smoother appearance */
        .modal-transition-enter {
            opacity: 0;
            transform: translateY(20px);
        }
        .modal-transition-enter-active {
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }
        .modal-transition-leave-active {
            transition: opacity 0.3s ease-in, transform 0.3s ease-in;
            opacity: 0;
            transform: translateY(20px);
        }

        /* Custom styles for horizontal carousel using scroll-snap */
        .carousel-container {
            overflow-x: auto;
            scrollbar-width: none; /* For Firefox */
            -ms-overflow-style: none; /* For IE/Edge */
            scroll-snap-type: x mandatory; /* Enable scroll snapping */
            -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
        }

        /* Hide scrollbar for Webkit browsers (Chrome, Safari) */
        .carousel-container::-webkit-scrollbar {
            display: none;
        }

        .carousel-item {
            scroll-snap-align: start; /* Snap to the start of each item */
            flex-shrink: 0; /* Prevent items from shrinking */
        }

    </style>
</head>
<body class="flex flex-col lg:flex-row min-h-screen font-poppins text-teks">

    {{-- Navigasi Samping Kiri --}}
    <x-utama.navside></x-utama.navside>

    <main class="flex-grow pb-20 px-4 py-4 md:px-8 md:py-6 bg-primary-100
                 md:ml-[20%] md:mr-[20%] md:w-[60%] md:pb-0">
        {{-- Warna background main dipertahankan di sini --}}

        @php
            $hour = now()->hour;

            if ($hour < 12) {
                $greeting = "Selamat pagi";
                $messages = [
                    "Awali harimu dengan petualangan seru di Pulau Kelinci! 🌞📖",
                    "Hari baru, cerita baru menantimu di setiap halaman. 🐇✨",
                    "Semangat pagi! Ayo lanjutkan bacaanmu dan temukan keajaiban. 📚🌤️"
                ];
            } elseif ($hour < 17) {
                $greeting = "Selamat siang";
                $messages = [
                    "Istirahat sejenak yuk, dan lanjutkan petualanganmu membaca! 📖☕",
                    "Waktu yang pas untuk membuka halaman baru! 📘🌼",
                    "Kisah-kisah di Pulau Kelinci siap menemanimu siang ini. 🐰🌞"
                ];
            } else {
                $greeting = "Selamat malam";
                $messages = [
                    "Tenangkan diri dengan satu bab penuh keajaiban. 🌙📖",
                    "Hari yang panjang layak ditutup dengan kisah indah. 📚💫",
                    "Malam yang hening, waktu sempurna untuk membaca dan bermimpi. 🐇🌌"
                ];
            }

            $message = $messages[array_rand($messages)];

            $HistoryMessageSubs = [
                "Belum ada jejak cerita di Pulau Kelinci. Saatnya membuat yang pertama! ✨📖",
                "Ayo buka halaman pertama dari kisah serumu. Buku-buku sedang menunggu! 🐰📘",
                "Belum ada petualangan yang tercatat. Siap memulai kisah pertama? 🐇✨",
                "Setiap petualangan dimulai dari satu langkah... atau satu halaman. Yuk mulai! 🌟📖",
            ];
            $HistoryMessageSub = $HistoryMessageSubs[array_rand($HistoryMessageSubs)];

            $emptyHistoryMessages = [
                "Pulau Kelinci masih sepi tanpa ceritamu... Yuk mulai membaca dan isi kisahmu! 🏝️📖",
                "Wah, rak bukumu masih kosong... Yuk mulai petualangan pertamamu 📚🐇",
                "Setiap pahlawan punya awal cerita—yuk mulai bab pertamamu sekarang! 📚🛡️",
                "Halaman kosong menantimu untuk diisi dengan kisah-kisah seru. Mulai baca, yuk! 📝📘",
                "Masih putih bersih seperti salju! Saatnya ukir jejak petualanganmu di sini ⛄📖",
                "Rak ini merindukan cerita-ceritamu. Yuk pilih satu buku dan mulai membaca! 📚💫",
                "Tak ada kisah tanpa langkah pertama. Yuk jelajahi dunia buku sekarang! 🌍📕",
            ];
            $emptyHistoryMessage = $emptyHistoryMessages[array_rand($emptyHistoryMessages)];
        @endphp

        {{-- Greeting Section --}}
        <div class="mb-2 px-4 py-6 md:px-8 md:py-8">
            <h1 class="font-poppins text-2xl md:text-3xl lg:text-4xl font-bold text-teks text-center
                        bg-gradient-to-r from-primary-100 to-primary-50
                        p-6 rounded-2xl shadow-lg animate-fade-in">
                {{ $greeting }}, <span class="text-primary-600">{{ Auth::user()->name }}</span>!
                <span class="inline-block mt-2 text-xl md:text-2xl font-medium text-gray-700 block">
                    Selamat datang di jejak petualangan membacamu! <span class="animate-spin inline-block">🌟</span>
                </span>
                <p class="text-base md:text-lg mt-2 font-normal text-gray-600">
                    @if ($histories->isEmpty() && $bukusDone->isEmpty())
                    {{ $HistoryMessageSub }}
                    @else
                    {{ $message }}
                    @endif
                </p>
            </h1>
        </div>

        @if ($histories->isEmpty() && $bukusDone->isEmpty())
        <div class="text-center mt-6 text-gray-600">
            <h2 class="text-xl font-semibold text-primary-600 mb-2">Belum ada histori bacaan</h2>
            <div class="flex justify-center my-6">
                <img src="{{ asset('asset/images/kelinci_histori_notfound.png') }}"
                alt="Tidak ditemukan"
                class="w-28 md:w-36 lg:w-40 max-w-full h-auto">
            </div>
            <p class="text-xl font-semibold mb-2">{{ $emptyHistoryMessage }}</p>
            {{-- <a href="{{ route('buku.beranda') }}"
            class="mt-6 inline-block px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl shadow transition-all">
                Jelajahi Buku Sekarang
            </a> --}}
            <div class="flex justify-center">
                <a id="" href="{{ route('buku.beranda') }}"
                    class="px-4 py-2 rounded-lg text-white font-bold text-lg bg-[#FBB45E] shadow-[0_6px_0_#D9963D]
                        transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105">
                        Jelajahi Buku Sekarang
                </a>
            </div>
        </div>
        @else
        <div class="px-2 {{ $histories->isEmpty() ? 'hidden' : '' }}">
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-md mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-teks font-poppins">Lanjutkan Membaca</h2>
                    <a href="{{ route('histori.list', ['type' => 'reading']) }}" class="text-primary-500 hover:text-primary-700 font-semibold flex items-center gap-1 transition-colors duration-200 text-sm md:text-base">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @if($histories->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <p class="text-lg mb-4">Belum ada buku yang sedang kamu baca. Yuk mulai petualangan baru!</p>
                        <a href="{{ route('buku.beranda') }}" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 transition-colors">
                            Mulai Baca <i class="bi bi-book-half ml-2"></i>
                        </a>
                    </div>
                @else
                    <div class="relative mt-4">
                        <div class="carousel-container px-2 md:px-0">
                            <div class="carousel-wrapper flex gap-4 transition-transform duration-300 min-w-full p-2 md:gap-6 md:p-4">
                                @foreach ($histories as $history)
                                    @php $buku = $history->buku; @endphp
                                    <div class="carousel-item flex-none w-40 md:w-48 lg:w-56 xl:w-64 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:shadow-lg cursor-pointer overflow-hidden bg-white rounded-xl shadow
                                        flex flex-col"
                                        onclick="openModalDetailBuku(this)"
                                        data-slug="{{ $buku->slug }}"
                                        data-level="{{ $buku->level_required }}"
                                        data-judul="{{ $buku->judul }}"
                                        data-penulis="{{ $buku->penulis }}"
                                        data-genre="{{ $buku->genre->nama_genre }}"
                                        data-cover="{{ asset('storage/' . $buku->cover_path) }}"
                                        data-sinopsis="{{ $buku->sinopsis }}"
                                        data-status="{{ $history->status }}"
                                    >
                                        <div class="h-40 md:h-48 lg:h-56 xl:h-64 overflow-hidden flex-shrink-0">
                                            <img src="{{ asset('storage/' . $buku->cover_path) }}" alt="Book Cover" class="w-full h-full object-cover rounded-t-xl">
                                        </div>
                                        <div class="p-3 md:p-4 flex flex-col flex-grow">
                                            <h3 class="font-poppins font-semibold text-sm md:text-base text-teks mb-2 truncate">{{ $buku->judul }}</h3>
                                            <span class="text-xs px-2 py-1 rounded-full inline-block mb-1 max-w-[120px] md:max-w-[140px] lg:max-w-[160px] truncate"
                                                id="genre-tag-{{ $buku->slug }}-reading"
                                                data-genre-name="{{ $buku->genre->nama_genre ?? 'Umum' }}">
                                                {{ $buku->genre->nama_genre ?? '-' }}
                                            </span>
                                            <p class="text-sec text-xs md:text-sm mt-auto font-poppins truncate">{{ $buku->penulis }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button onclick="scrollCarousel(event, 'left')" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -ml-1
                            hidden md:block md:p-2 md:-ml-2">
                            <i class="bi bi-chevron-left text-lg md:text-xl text-gray-600"></i>
                        </button>
                        <button onclick="scrollCarousel(event, 'right')" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -mr-1
                            hidden md:block md:p-2 md:-mr-2">
                            <i class="bi bi-chevron-right text-lg md:text-xl text-gray-600"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="px-2 {{ $bukusDone->isEmpty() ? 'hidden' : '' }}">
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-md mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold text-teks font-poppins">Selesai Dibaca</h2>
                    <a href="{{ route('histori.list', ['type' => 'completed']) }}" class="text-primary-500 hover:text-primary-700 font-semibold flex items-center gap-1 transition-colors duration-200 text-sm md:text-base">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @if($bukusDone->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        <p class="text-lg mb-4">Belum ada buku yang selesai kamu baca. Ayo selesaikan bacaanmu!</p>
                        <a href="{{ route('buku.beranda') }}" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 transition-colors">
                            Mulai Baca <i class="bi bi-book-half ml-2"></i>
                        </a>
                    </div>
                @else
                    <div class="relative mt-4">
                        <div class="carousel-container px-2 md:px-0">
                            <div class="carousel-wrapper flex gap-4 transition-transform duration-300 min-w-full p-2 md:gap-6 md:p-4">
                                @foreach ($bukusDone as $done)
                                    @php $buku = $done->buku; @endphp
                                    <div class="carousel-item flex-none w-40 md:w-48 lg:w-56 xl:w-64 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:shadow-lg cursor-pointer overflow-hidden bg-white rounded-xl shadow
                                        flex flex-col"
                                        onclick="openModalDetailBuku(this)"
                                        data-slug="{{ $buku->slug }}"
                                        data-level="{{ $buku->level_required }}"
                                        data-judul="{{ $buku->judul }}"
                                        data-penulis="{{ $buku->penulis }}"
                                        data-genre="{{ $buku->genre->nama_genre }}"
                                        data-cover="{{ asset('storage/' . $buku->cover_path) }}"
                                        data-sinopsis="{{ $buku->sinopsis }}"
                                        data-status="{{ $done->status }}"
                                    >
                                        <div class="h-40 md:h-48 lg:h-56 xl:h-64 overflow-hidden flex-shrink-0">
                                            <img src="{{ asset('storage/' . $buku->cover_path) }}" alt="Book Cover" class="w-full h-full object-cover rounded-t-xl">
                                        </div>
                                        <div class="p-3 md:p-4 flex flex-col flex-grow">
                                            <h3 class="font-poppins font-semibold text-sm md:text-base text-teks mb-2 truncate">{{ $buku->judul }}</h3>
                                            <span class="text-xs px-2 py-1 rounded-full inline-block mb-1 max-w-[120px] md:max-w-[140px] lg:max-w-[160px] truncate"
                                                id="genre-tag-{{ $buku->slug }}-done"
                                                data-genre-name="{{ $buku->genre->nama_genre ?? 'Umum' }}">
                                                {{ $buku->genre->nama_genre ?? '-' }}
                                            </span>
                                            <p class="text-sec text-xs md:text-sm mt-auto font-poppins truncate">{{ $buku->penulis }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button onclick="scrollCarousel(event, 'left')" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -ml-1
                                hidden md:block md:p-2 md:-ml-2">
                            <i class="bi bi-chevron-left text-lg md:text-xl text-gray-600"></i>
                        </button>
                        <button onclick="scrollCarousel(event, 'right')" class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 -mr-1
                                hidden md:block md:p-2 md:-mr-2">
                            <i class="bi bi-chevron-right text-lg md:text-xl text-gray-600"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </main>

    {{-- Modal Buku Detail --}}
    <div id="modalBuku"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
        onclick="closeModalDetailBuku()">
        <div id="modalContentBuku"
            class="relative rounded-2xl p-6 md:p-8 w-full max-w-lg bg-white shadow-xl transform transition-all duration-300 modal-transition-enter"
            onclick="event.stopPropagation()">

            {{-- Close Button --}}
            <button onclick="closeModalDetailBuku()"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-3xl font-bold leading-none transition-transform duration-200 hover:rotate-90"
                aria-label="Tutup">
                &times;
            </button>

            {{-- Book Info --}}
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
                <img id="modalCover" src="" alt="Cover Buku"
                    class="w-32 h-48 md:w-40 md:h-60 object-cover rounded-md shadow-md flex-shrink-0">
                <div class="text-center md:text-left flex-grow">
                    <h2 id="modalJudul" class="text-xl md:text-2xl font-bold text-teks mb-2 leading-tight"></h2>
                    <p class="text-gray-600 font-medium mb-1 text-sm md:text-base">
                        Penulis: <span id="modalPenulis" class="font-normal"></span>
                    </p>
                    <p class="mb-4">
                        <span id="modalGenre" class="text-xs md:text-sm rounded-full inline-block px-3 py-1 font-semibold">
                        </span>
                    </p>
                    <div class="flex items-center justify-center md:justify-start gap-2 text-sm text-gray-600">
                        <i class="bi bi-award-fill text-yellow-500"></i>
                        Level Dibutuhkan: <span id="modalLevel" class="font-semibold"></span>
                    </div>
                </div>
            </div>

            {{-- Sinopsis --}}
            <div class="text-justify text-gray-700 mb-6 max-h-48 md:max-h-60 overflow-y-auto custom-scrollbar pr-2">
                <h3 class="font-bold text-lg mb-2 text-teks">Sinopsis:</h3>
                <p id="modalSinopsis" class="text-sm md:text-base leading-relaxed"></p>
            </div>

            {{-- Read Button --}}
            <div class="flex justify-center">
                <a id="modalLinkBaca" href="#"
                    class="px-6 py-3 rounded-xl text-white font-bold text-base md:text-lg
                            shadow-[0_6px_0_rgba(0,0,0,0.2)]
                            hover:-translate-y-0.5 active:translate-y-1 active:shadow-none transition-all duration-200">
                    LANJUT BACA
                </a>
            </div>
        </div>
    </div>

    {{-- Navigasi Samping Kanan --}}
    <x-utama.navsideRight></x-utama.navsideRight>

    <script>
        // Fungsi untuk menggulir carousel
        function scrollCarousel(event, direction) {
            event.preventDefault(); // Mencegah perilaku default tombol
            // Cari elemen .carousel-container yang paling dekat dari tombol yang diklik
            let carouselContainer = event.target.closest('.relative').querySelector('.carousel-container');
            // Check if carouselContainer exists before trying to scroll
            if (!carouselContainer) {
                console.error("Carousel container not found for scrolling.");
                return;
            }
            const scrollAmount = carouselContainer.offsetWidth / 2; // Gulir setengah lebar container

            if (direction === 'left') {
                carouselContainer.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            } else {
                carouselContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }

        // Object untuk mapping warna genre
        const genreColors = {
            'Fantasi': { bg: 'bg-purple-100', text: 'text-purple-600' },
            'Petualangan': { bg: 'bg-yellow-100', text: 'text-yellow-600' },
            'Misteri': { bg: 'bg-gray-100', text: 'text-gray-600' },
            'Horor': { bg: 'bg-red-100', text: 'text-red-600' },
            'Fiksi Ilmiah': { bg: 'bg-blue-100', text: 'text-blue-600' },
            'Romansa': { bg: 'bg-pink-100', text: 'text-pink-600' },
            'Edukasi': { bg: 'bg-green-100', text: 'text-green-600' },
            'Drama': { bg: 'bg-orange-100', text: 'text-orange-600' },
            'Sejarah': { bg: 'bg-amber-100', text: 'text-amber-600' },
            'Biografi': { bg: 'bg-cyan-100', text: 'text-cyan-600' },
            'Umum': { bg: 'bg-indigo-100', text: 'text-indigo-600' }, // Default fallback
        };

        // Fungsi untuk apply warna genre ke tag span
        function applyGenreColors() {
            document.querySelectorAll('[data-genre-name]').forEach(tag => {
                const genreName = tag.dataset.genreName;
                const selectedGenreColor = genreColors[genreName] || genreColors['Umum'];
                tag.classList.add(selectedGenreColor.bg, selectedGenreColor.text);
            });
        }

        // Panggil fungsi saat DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', applyGenreColors);


        function openModalDetailBuku(el) {
            document.getElementById('modalJudul').innerText = el.dataset.judul;
            document.getElementById('modalPenulis').innerText = el.dataset.penulis;
            document.getElementById('modalSinopsis').innerText = el.dataset.sinopsis;
            document.getElementById('modalCover').src = el.dataset.cover;
            document.getElementById('modalLevel').innerText = el.dataset.level; // Set level

            let status = el.dataset.status;
            let genreName = el.dataset.genre;
            let modalGenre = document.getElementById('modalGenre');

            modalGenre.innerText = genreName;
            // Clear existing classes and add default ones
            modalGenre.className = 'text-xs md:text-sm rounded-full inline-block px-3 py-1 font-semibold';

            const selectedGenreColor = genreColors[genreName] || genreColors['Umum'];
            modalGenre.classList.add(selectedGenreColor.bg, selectedGenreColor.text);


            const tombol = document.getElementById('modalLinkBaca');
            // Remove existing specific color/shadow classes before adding new ones
            tombol.classList.remove('bg-[#34A853]', 'bg-[#FBB45E]', 'shadow-[0_6px_0_#2C8E46]', 'shadow-[0_6px_0_#D9963D]');

            if (status === "completed") {
                tombol.innerText = "BACA ULANG";
                tombol.classList.add('bg-[#FBB45E]', 'shadow-[0_6px_0_#D9963D]'); // Orange color for replay
            } else {
                tombol.innerText = "LANJUT BACA";
                tombol.classList.add('bg-[#34A853]', 'shadow-[0_6px_0_#2C8E46]'); // Green color for continue
            }

            let slug = el.dataset.slug;
            let bacaUrl = `{{ url('baca-buku') }}/${slug}`;
            document.getElementById('modalLinkBaca').href = bacaUrl;

            // Show modal with transition
            const modal = document.getElementById('modalBuku');
            const modalContent = document.getElementById('modalContentBuku');

            modal.classList.remove('hidden');
            modalContent.classList.remove('modal-transition-leave-active');
            modalContent.classList.add('modal-transition-enter-active', 'modal-transition-enter');

            // Trigger reflow to apply initial state before transition
            void modalContent.offsetWidth;
            modalContent.classList.remove('modal-transition-enter');
        }

        function closeModalDetailBuku() {
            const modal = document.getElementById('modalBuku');
            const modalContent = document.getElementById('modalContentBuku');

            modalContent.classList.remove('modal-transition-enter-active');
            modalContent.classList.add('modal-transition-leave-active');

            setTimeout(() => {
                modal.classList.add('hidden');
                modalContent.classList.remove('modal-transition-leave-active'); // Clean up class after animation
            }, 300); // Matches transition duration
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !document.getElementById('modalBuku').classList.contains('hidden')) {
                closeModalDetailBuku();
            }
        });
    </script>
</body>
</html>
