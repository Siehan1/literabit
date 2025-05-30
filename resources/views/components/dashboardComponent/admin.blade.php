<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LittleRabbit | Admin Dashboard</title>
    @vite(['resources/css/app.css','resources/js/navbar.js','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-gray-100 font-poppins">
    <div class="min-h-screen flex">
        {{-- aside navbar --}}
        <aside class="bg-primary-600 text-white w-64 px-4 py-6 fixed h-full shadow-xl">
            <div class="mb-8">
                <div class="flex items-center gap-3 px-2">
                    <h1 class="text-2xl font-bold">Admin Panel</h1>
                </div>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 {{ request()->is('admin') ? 'bg-primary-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('tableBuku') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 {{ request()->is('tableBuku') || request()->is('buku/*') ? 'bg-primary-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Daftar Buku</span>
                </a>
                <a href="{{ route('tableGenre')}} " class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 {{ request()->is('tableGenre') || request()->is('genre/*') ? 'bg-primary-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Genre</span>
                </a>
                <a href="{{route('tableKuis')}}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 {{ request()->is('tableKuis') || request()->is('kuis/*') ? 'bg-primary-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Kuis dan Jawaban</span>
                </a>
                <a href="{{ route('tableBadges') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 {{ request()->is('tableBadges') || request()->is('badge/*') ? 'bg-primary-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <span>Badges</span>
                </a>
                <a href="{{route('tableLevel')}}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 {{ request()->is('tableLevel') || request()->is('level/*') ? 'bg-primary-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>Level Threshold</span>
                </a>

                {{-- Missions Dropdown --}}
                <div class="relative">
                    <button id="missions-dropdown-toggle" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-primary-500 w-full text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>
                        <span>Missions</span>
                        {{-- Dropdown arrow --}}
                        <svg id="missions-arrow" class="w-4 h-4 ml-auto transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="missions-dropdown-menu" class="hidden pl-8 space-y-2">
                        <a href="{{ route('missionTemplate.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors hover:bg-primary-500 {{ request()->routeIs('missionTemplate.index') ? 'bg-primary-700' : '' }}">
                            <span>Template Mision</span>
                        </a>
                        <a href="{{ route('tableDaily') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors hover:bg-primary-500 {{ request()->routeIs('tableDaily') ? 'bg-primary-700' : '' }}">
                            <span>Daily Mision</span>
                        </a>
                    </div>
                </div>
                {{-- Logout (POST Method) --}}
                <form action="{{ route('logout') }}" method="POST" class="pt-4">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-red-500 hover:bg-red-50 rounded-lg transition-colors text-left">
                        <i class="bi bi-box-arrow-left text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-8 ml-64">
        @if(!empty($header))
            <h1 class="text-3xl font-bold mb-6">
                {{ $header }}
            </h1>
        @endif


            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>
</html>