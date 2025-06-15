<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile | LittleRabbit</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="min-h-screen bg-[#FFF8F0] font-poppins flex flex-col lg:flex-row">
        {{-- On small screens, this will be at the top --}}
        @include('components.utama.navside')

        {{-- Adjust margins for different screen sizes --}}
        <div class="flex-1 p-4 md:p-8 w-full lg:ml-[20%] lg:mr-[20%]">
            @if(session('success'))
                <div id="flash-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5 transition-opacity duration-500 ease-in-out">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-8">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative group mb-4 sm:mb-0">
                        <div
                            class="w-24 h-24 bg-[#FFD8B8] rounded-2xl flex items-center justify-center overflow-hidden">
                            <img id="avatar-preview"
                                src="{{ asset(Auth::user()->profil ? 'storage/' . Auth::user()->profil : 'profile_penulis/pro1.svg')}}"
                                class="w-20 h-20 object-cover rounded-full" alt="Avatar Pengguna">
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 bg-[#FFB066] text-white px-3 py-1 rounded-full text-sm font-medium">
                            Level {{ Auth::user()->level }}
                        </div>
                        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data"
                            class="absolute inset-0">
                            @csrf
                            @method('POST')

                            <label for="avatar-input"
                                class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity cursor-pointer">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <input type="file" id="avatar-input" name="avatar" class="hidden" accept="image/*"
                                onchange="this.form.submit()">
                        </form>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-col text-center sm:text-left gap-1">
                            {{-- Always flex-col, but text alignment changes based on breakpoint --}}
                            <div class="flex items-center gap-2 mb-1 sm:mb-0 justify-center sm:justify-start">
                                {{-- Name and Edit Button --}}
                                <h1 id="name-display" class="text-3xl font-bold text-[#8B4513]">{{ Auth::user()->name }}
                                </h1>
                                <button id="edit-name-btn"
                                    class="text-[#8B4513] hover:text-[#FFB066] transition-colors flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
                            {{-- Email address --}}
                            <p class="text-[#8B4513]/80 mb-1">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2 text-[#8B4513]/80">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Bergabung {{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="name-edit-form"
                class="hidden bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-8">
                <form id="update-name-form" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-[#8B4513]/80 mb-2">Nama Baru</label>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                            class="w-full px-4 py-3 border border-[#FFD8B8] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFB066] focus:border-transparent">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" id="cancel-edit-btn"
                            class="px-4 py-2 text-[#8B4513] hover:bg-gray-100 rounded-xl">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#FFB066] text-white rounded-xl hover:bg-[#FF8E4F] transition-colors">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)] text-center md:text-left">
                    {{-- Center text on mobile --}}
                    <div class="text-2xl font-bold text-[#8B4513] mb-1">{{ Auth::user()->xp }}</div>
                    <div class="text-sm text-[#8B4513]/80">Total XP</div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)] text-center md:text-left">
                    {{-- Center text on mobile --}}
                    <div class="text-2xl font-bold text-[#8B4513] mb-1">{{ $totalBuku }}</div>
                    <div class="text-sm text-[#8B4513]/80">Buku Dibaca</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-20">
                <h2 class="text-lg sm:text-xl font-semibold text-[#8B4513] mb-3 sm:mb-4 text-center">🔥 Streak Harian
                </h2>

                {{-- Info teks --}}
                <p id="streak-info" class="text-sm sm:text-base text-center text-[#8B4513] font-medium mb-3 sm:mb-4">
                    Loading...
                </p>

                {{-- Diagram 7 hari --}}
                <div id="streak-visual" class="grid grid-cols-7 gap-1 sm:gap-2 justify-items-center">
                </div>
            </div>
        </div>
        @include('components.utama.navside-right')
    </div>
    <script>

        // Tampilkan form edit nama
        document.getElementById('edit-name-btn').addEventListener('click', function () {
            document.getElementById('name-edit-form').classList.remove('hidden');
            document.getElementById('name').focus();
        });

        // Sembunyikan form edit nama
        document.getElementById('cancel-edit-btn').addEventListener('click', function () {
            document.getElementById('name-edit-form').classList.add('hidden');
        });

        // Fungsi untuk menampilkan notifikasi
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.classList.add('opacity-0');
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);


        // streak fetch
        document.addEventListener('DOMContentLoaded', function () {
            // Function to determine box size based on screen width
            function getBoxSize() {
                const width = window.innerWidth;
                if (width < 640) { // Mobile
                    return 'w-10 h-10';
                } else if (width < 768) { // Tablet
                    return 'w-14 h-14';
                }
                return 'w-20 h-20'; // Desktop
            }

            // Update box sizes when window resizes
            window.addEventListener('resize', function () {
                const boxes = document.querySelectorAll('.streak-box');
                const newSize = getBoxSize();
                boxes.forEach(box => {
                    // Remove old size classes and add new one
                    box.className = box.className.replace(/w-\d+ h-\d+/, '').replace(/\s+/g, ' ').trim(); // Remove previous w-X h-Y
                    box.classList.add(...newSize.split(' ')); // Add new w-X h-Y
                });
            });

            fetch('{{route("streak")}}')
                .then(res => {
                    if (!res.ok) { // Check if response was successful
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(data => {
                    const container = document.getElementById('streak-visual');
                    const info = document.getElementById('streak-info');
                    container.innerHTML = ''; // Clear previous content

                    const today = new Date();
                    const activeDates = data.date; // Assuming data.date is an array of date strings
                    const streak = data.streak;

                    info.innerHTML = `🔥 Kamu aktif selama <span class="font-bold">${streak}</span> hari berturut-turut`;

                    for (let i = 6; i >= 0; i--) { // Loop for the last 7 days
                        const date = new Date(today);
                        date.setDate(today.getDate() - i);
                        const dateStr = date.toISOString().split('T')[0]; // Format to YYYY-MM-DD
                        const isActive = activeDates.includes(dateStr);

                        const div = document.createElement('div');
                        div.className = `
                    streak-box ${getBoxSize()} rounded-md flex items-center justify-center
                    text-xs sm:text-sm font-semibold
                    border shadow-sm
                    hover:scale-105 transition transform duration-200 ease-out
                    ${isActive ? 'is-active bg-orange-400 text-white border-orange-500' : 'bg-gray-200 text-gray-500 border-gray-300'}
                `;
                        div.title = date.toLocaleDateString('id-ID', {
                            weekday: 'short',
                            day: 'numeric',
                            month: 'short'
                        });
                        div.textContent = date.getDate();

                        // Add flame SVG for active boxes
                        if (isActive) {
                            const flameSvg = `
                        <svg class="flame-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C9 2 6 5 6 9c0 3.99 3.01 7 6 7s6-3.01 6-7c0-4-3-7-6-7zM12 14c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/>
                        </svg>
                    `;
                            div.innerHTML += flameSvg; // Append the SVG to the div's inner HTML
                        }


                        container.appendChild(div);
                    }
                })
                .catch(err => {
                    document.getElementById('streak-info').textContent = '⚠️ Gagal mengambil data streak';
                    console.error('Error fetching streak:', err);
                });
        });

    </script>
</body>

</html>
