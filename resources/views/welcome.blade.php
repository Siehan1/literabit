<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Tailwind Test</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Hello, Tailwind!</h1>
        <p class="text-lg">Jika kamu melihat ini dengan styling biru dan rapi, Tailwind CSS berhasil dimuat 🎉</p>
        <a href="/index"><button class="mt-6 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Tes Tombol
        </button></a>
    </div>
</body>
</html>
