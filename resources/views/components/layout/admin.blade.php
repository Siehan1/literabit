<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LittleRabbit | Admin Dashboard</title>
    @vite(['resources/css/app.css','resources/js/navbar.js','resources/js/app.js'])
</head>
<body class="bg-gray-100 font-poppins">
    <div class="min-h-screen flex">
        {{-- aside navbar --}}
        <aside class="bg-primary-600 text-white w-64 space-y-6 px-3 py-4 fixed h-full">
            <div class="px-4 py-2 mt-7" >
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="flex flex-col px-1.5 py-2.5 gap-3.5 text-[18px]">
                <a href="#" class="block hover:bg-primary gap-2 p-2 rounded w-full" >Dashboard</a>
                <a href="#" class="block hover:bg-primary gap-2 p-2 rounded w-full">Buku</a>
                <a href="#" class="block hover:bg-primary gap-2 p-2 rounded w-full">Genre</a>
                <a href="#" class="block hover:bg-primary gap-2 p-2 rounded w-full">Kuis dan Jawaban</a>
                <a href="#" class="block hover:bg-primary gap-2 p-2 rounded w-full">Badges</a>
                <a href="#" class="block hover:bg-primary gap-2 p-2 rounded w-full">Level Treshold</a>
            </nav>
        </aside>

        <main class="flex-1 p-8 ml-70">
            {{-- navbar --}}
            <!-- judul halaman -->
            <h1 class="text-3xl font-bold my-2 py-3">
                {{ $header ?? 'Dashboard Overview'}}
            </h1>

            {{ $slot }}
        </main>
    </div>


</body>
</html>