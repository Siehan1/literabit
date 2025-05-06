<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiteraBit - Platform Literasi Digital</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <!-- Header/Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">LiteraBit</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-blue-600">Beranda</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Tentang</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Kontak</a>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-600">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Tingkatkan Literasi Digitalmu
                </h2>
                <p class="mt-4 text-xl text-blue-100">
                    Platform pembelajaran digital yang membantu Anda mengembangkan keterampilan literasi digital
                </p>
                <div class="mt-8">
                    <a href="#" class="bg-white text-blue-600 px-8 py-3 rounded-full font-medium hover:bg-gray-100">
                        Mulai Belajar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Pembelajaran Interaktif</h3>
                <p class="mt-2 text-gray-600">Materi pembelajaran yang interaktif dan mudah dipahami</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Sertifikasi</h3>
                <p class="mt-2 text-gray-600">Dapatkan sertifikat setelah menyelesaikan kursus</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Komunitas</h3>
                <p class="mt-2 text-gray-600">Bergabung dengan komunitas pembelajar digital</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400">&copy; 2024 LiteraBit. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>