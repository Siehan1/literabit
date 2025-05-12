<!DOCTYPE html>
<html lang="en" class="scroll-pt-20 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css','resources/js/navbar.js','resources/js/app.js'])
</head>
<body>
    <x-nav-bar-l-p></x-nav-bar-l-p>
    <main class="pt-24">
        {{-- hero --}}
        <section id="beranda" class="min-h-auto mb-4">
            <x-herolp></x-herolp>
        </section>

        {{-- buku section --}}
        <x-popular-l-p :buku="$buku"></x-popular-l-p>

        {{-- tentang section --}}
        

    </main>
    <x-Footer></x-Footer>
</body>
</html>