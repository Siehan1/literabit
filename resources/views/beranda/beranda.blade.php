<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="flex flex-col sm:flex-row">
        <!-- Navside -->
        <x-utama.navside></x-utama.navside>
        
        <!-- Main Content -->
        <main id="mainContent" class="sm:ml-[250px] ml-0 flex-1 min-h-screen p-4 sm:p-6 pb-24 sm:pb-6 transition-all duration-300">
            
        </main>
    </div>
</body>
</html>