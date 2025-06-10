<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History | LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex min-h-screen">
    
    <x-utama.navside></x-utama.navside>
    
    <main class="w-[60%] ml-[20%] mr-[20%] bg-primary-100">
        <div class="px-8 py-6">
            <h1 class="font-poppins text-3xl font-bold text-teks text-center
                    bg-gradient-to-r from-primary-100 to-primary-50
                    p-6 rounded-xl shadow-sm animate-fade-in">
                Wah, <span class="text-primary-600">{{ Auth::user()->name }}</span>, kamu sudah membaca banyak buku! 
                <span class="animate-spin inline-block">🌟</span>
                <p class="text-xl mt-2 font-medium text-gray-600">
                    Yuk lihat kembali jejak petualanganmu di Pulau Kelinci 📖🐇  
                    Setiap cerita adalah langkah menuju dunia baru.
                </p>
            </h1>
        </div>

        <div class="px-8 py-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-teks font-poppins">Terakhir Dibaca</h2>
                <a href="#" class="text-primary-500 hover:underline font-medium">Lihat Semua</a>
            </div>
        
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                <!-- Buku Card -->
                
                @foreach ($histories as $history)
                    @php 
                        $buku = $history->buku;
                        $colorPairs = [
                            ['bg-red-100', 'text-red-600'],
                            ['bg-green-100', 'text-green-600'],
                            ['bg-blue-100', 'text-blue-600'],
                            ['bg-yellow-100', 'text-yellow-600'],
                            ['bg-purple-100', 'text-purple-600'],
                            ['bg-pink-100', 'text-pink-600'],
                            ['bg-indigo-100', 'text-indigo-600'],
                        ];
                        $selected = $colorPairs[array_rand($colorPairs)];
                    @endphp
                    <div class="bg-white rounded-xl shadow-md transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:shadow-lg cursor-pointer"
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
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $buku->cover_path) }}" alt="Book Cover" class="rounded-xl w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">{{ $buku->judul }}</h3>
                            <span class="{{ $selected[0] }} {{ $selected[1] }} text-xs px-2 py-1 rounded-full">{{ $buku->genre->nama_genre ?? '-' }}</span>
                            <p class="text-sec text-sm mt-2 font-poppins">{{ $buku->penulis }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="px-8 py-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-teks font-poppins">Selesai Dibaca</h2>
                <a href="#" class="text-primary-500 hover:underline font-medium">Lihat Semua</a>
            </div>
        
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                <!-- Buku Card -->
                @foreach ($bukusDone as $done)
                    @php $buku = $done->buku; @endphp
                    <div class="bg-white rounded-xl shadow-md transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:shadow-lg cursor-pointer"
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
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $buku->cover_path) }}" alt="Book Cover" class="rounded-xl w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">{{ $buku->judul }}</h3>
                            <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">{{ $buku->genre->nama_genre ?? '-' }}</span>
                            <p class="text-sec text-sm mt-2 font-poppins">{{ $buku->penulis }}</p>
                        </div>
                    </div>
                @endforeach
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
            <span id="modalGenre" class="bg-green-100 text-green-600 text-sm rounded-full inline-block px-3 py-1">
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
                LANJUT BACA
            </a>
        </div>
    </div>
    </div>
    <x-utama.navsideRight></x-utama.navsideRight>

    <script>
        function openModalDetailBuku(el) {
            document.getElementById('modalJudul').innerText = el.dataset.judul;
            document.getElementById('modalPenulis').innerText = el.dataset.penulis;
            document.getElementById('modalSinopsis').innerText = el.dataset.sinopsis;
            document.getElementById('modalCover').src = el.dataset.cover;
            let status = el.dataset.status;

            // Genre tag
            let modalgenre = document.getElementById('modalGenre');
            modalgenre.innerText = el.dataset.genre;

            

            const tombol = document.getElementById('modalLinkBaca');
            tombol.classList.remove('bg-[#34A853]', 'bg-[#FBB45E]', 'shadow-[0_6px_0_#2C8E46]', 'shadow-[0_6px_0_#D9963D]');

            if (status == "completed") {
                tombol.innerText = "BACA ULANG";
                tombol.classList.add('bg-[#FBB45E]', 'shadow-[0_6px_0_#D9963D]');
            } else {
                tombol.innerText = "LANJUT BACA";
                tombol.classList.add('bg-[#34A853]', 'shadow-[0_6px_0_#2C8E46]');
            }

            // Link baca
            let slug = el.dataset.slug;
            let bacaUrl = `{{ url('baca-buku') }}/${slug}`;
            document.getElementById('modalLinkBaca').href = bacaUrl;

            
            // Tampilkan modal
            document.getElementById('modalBuku').classList.remove('hidden');
        }
        
        function closeModalDetailBuku() {
            document.getElementById('modalBuku').classList.add('hidden');
        }
    </script>
</body>
</html>