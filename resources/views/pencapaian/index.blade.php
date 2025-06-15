<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian | LittleRabbit</title>
    <link rel="icon" href="{{ asset('asset/images/icon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen">
    <x-utama.navside></x-utama.navside>
    <main class="w-full sm:w-[90%] md:w-[80%] lg:w-[60%] sm:mx-[5%] md:mx-[10%] lg:ml-[20%] lg:mr-[20%] bg-primary-100">

        <!-- ini adalah informasi level pengguna -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 md:p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] m-4 sm:m-6 md:m-8">
            <div class="flex flex-col sm:flex-row md:flex-row items-center gap-4 sm:gap-5 md:gap-6">
                <div class="relative group">
                    <div class="w-20 h-20 sm:w-22 sm:h-22 md:w-24 md:h-24 bg-[#FFD8B8] rounded-2xl flex items-center justify-center overflow-hidden">
                        <img id="avatar-preview" src="{{ asset('profile_penulis/pro1.svg') }}"
                            class="w-16 h-16 sm:w-18 sm:h-18 md:w-20 md:h-20 object-cover rounded-xl" alt="Avatar Pengguna">
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-[#FFB066] text-white px-2 sm:px-2.5 md:px-3 py-1 rounded-full text-xs sm:text-[13px] md:text-sm font-medium">
                        Level {{ Auth::user()->level }}
                    </div>
                </div>
                <div class="flex-1 text-center sm:text-left md:text-left">
                    <div class="flex justify-between items-start">
                        <div class="w-full">
                            <h1 id="name-display" class="text-2xl sm:text-2.5xl md:text-3xl font-bold text-[#8B4513] mb-1">
                                {{ Auth::user()->name }}
                            </h1>

                            <!-- progress bar level -->
                            <div class="w-full sm:w-2xl md:w-2xl mt-2">
                                <div class="flex justify-between mb-1">
                                    <span class="text-xs sm:text-[13px] md:text-sm font-medium text-[#8B4513]" id="progress-label"></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 sm:h-2 md:h-2.5 lg:h-3">
                                    <div id="progress-bar" class="bg-[#FFB066] h-1.5 sm:h-2 md:h-2.5 lg:h-3 rounded-full transition-all duration-300 ease-in-out">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- badges -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 md:p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mx-4 sm:mx-6 md:mx-8">
            <!-- judul -->
            <div class="flex flex-col sm:flex-row md:flex-row items-center justify-between gap-2 sm:gap-1 md:gap-0">
                <div class="text-center sm:text-left md:text-left">
                    <h1 class="text-xl sm:text-1.5xl md:text-2xl font-poppins font-bold text-teks">Lencana Kehormatan</h1>
                    <p class="text-xs sm:text-[13px] md:text-sm text-[#8B4513] mb-4">Kumpulkan lencana kehormatan untuk menunjukkan pencapaianmu!</p>
                </div>
                <div class="bg-primary-200 p-2 rounded-full">
                    <h2 class="text-[12px] sm:text-[13px] md:text-[14px] text-teks font-poppins">Badge dimiliki
                        <span id="badge-owned-count">0</span> / <span id="badge-total-count">0</span>
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 md:gap-6 mt-4 sm:mt-5 md:mt-6">
                <!-- Contoh badge, ulangi sesuai jumlah badge -->
                <div class="flex flex-col items-center bg-primary-50 rounded-xl p-2 sm:p-3 md:p-4 shadow hover:shadow-lg transition"
                    id="badge-container">
                </div>
            </div>
        </div>

    </main>

    <x-utama.navsideRight />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route("pencapaian.show") }}')
                .then(response => response.json())
                .then(data => {
                    const badgeGrid = document.querySelector('.grid.grid-cols-2');
                    badgeGrid.innerHTML = '';

                    const progress = data.badge_progress;
                    document.getElementById('progress-label').textContent = `Progress: ${progress.unlocked} dari ${progress.total} badge (${progress.percent}%)`;
                    document.getElementById('progress-bar').style.width = `${progress.percent}%`;
                    document.getElementById('badge-owned-count').textContent = progress.unlocked;
                    document.getElementById('badge-total-count').textContent = progress.total;


                    if (Array.isArray(data.badges) && data.badges.length > 0) {
                        data.badges.forEach(badge => {
                            const div = document.createElement('div');
                            div.className = 'flex flex-col items-center bg-primary-50 rounded-xl p-2 sm:p-3 md:p-4 shadow text-center' +
                                (badge.unlocked ? ' hover:shadow-lg transition' : '');

                            const grayscaleClass = badge.unlocked ? '' : 'grayscale opacity-50';

                            div.innerHTML = `
                            <img src="${badge.icon_path}" alt="${badge.nama_badge}" class="w-40 h-24 sm:w-50 sm:h-28 md:w-60 md:h-32 mb-2 object-contain ${grayscaleClass}">
                            <span class="text-xs sm:text-[13px] md:text-sm font-semibold text-[#8B4513] ${grayscaleClass}">${badge.nama_badge}</span>
                        `;
                            badgeGrid.appendChild(div);
                        });
                    } else {
                        badgeGrid.innerHTML = '<div class="col-span-full text-center text-[#8B4513]">Belum ada lencana.</div>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching badges:', error);
                });
        });
    </script>

</body>

</html>
