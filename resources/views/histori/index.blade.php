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
                    @php $buku = $history->buku; @endphp
                    @php
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
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
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
                {{-- <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{asset('storage/cover/1748561651.pdf.jpg')}}" alt="Book Cover" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">Judul Buku 1</h3>
                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Petualangan</span>
                        <p class="text-sec text-sm mt-2 font-poppins">Penulis Buku</p>
                    </div>
                </div>
        
                <!-- Salin beberapa card lain -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/200x300/?storybook" alt="Book Cover" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">Kisah Kelinci Ajaib</h3>
                        <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-1 rounded-full">Fantasi</span>
                        <p class="text-sec text-sm mt-2 font-poppins">Nadia Putri</p>
                    </div>
                </div>
        
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/200x300/?education" alt="Book Cover" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">Belajar Angka</h3>
                        <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">Edukasi</span>
                        <p class="text-sec text-sm mt-2 font-poppins">Andi Saputra</p>
                    </div>
                </div> --}}
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
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 cursor-pointer">
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
                {{-- <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{asset('storage/cover/1748561651.pdf.jpg')}}" alt="Book Cover" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">Judul Buku 1</h3>
                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Petualangan</span>
                        <p class="text-sec text-sm mt-2 font-poppins">Penulis Buku</p>
                    </div>
                </div>
        
                <!-- Salin beberapa card lain -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/200x300/?storybook" alt="Book Cover" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">Kisah Kelinci Ajaib</h3>
                        <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-1 rounded-full">Fantasi</span>
                        <p class="text-sec text-sm mt-2 font-poppins">Nadia Putri</p>
                    </div>
                </div>
        
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/200x300/?education" alt="Book Cover" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-poppins font-semibold text-base text-teks mb-2 truncate">Belajar Angka</h3>
                        <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">Edukasi</span>
                        <p class="text-sec text-sm mt-2 font-poppins">Andi Saputra</p>
                    </div>
                </div> --}}
            </div>
        </div>
        
    </main>

    <x-utama.navsideRight></x-utama.navsideRight>
</body>
</html>