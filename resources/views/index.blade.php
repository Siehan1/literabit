<!DOCTYPE html>
<html lang="en" class="scroll-pt-20 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css','resources/js/navbar.js'])
</head>
<body>
    <x-nav-bar-l-p></x-nav-bar-l-p>
    <main class="pt-24">
        <section id="beranda" class="min-h-auto mb-4">
            <x-herolp></x-herolp>
        </section>
        <section class="bg-primary-300 p-4">
            @foreach (array_slice($buku,0,1) as $bukuItem)
                <x-card-buku 
                    :cover="$bukuItem['cover']"
                    :judul="$bukuItem['judul']"
                    :penulis="$bukuItem['penulis']"
                    :profile="$bukuItem['profile']"
                    :genre="$bukuItem['genre']"
                ></x-card-buku>
            @endforeach
        </section>
        
    </main>
    <x-Footer></x-Footer>
</body>
</html>