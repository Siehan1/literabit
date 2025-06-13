<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian | LittleRabbit</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen">
    <x-utama.navside></x-utama.navside>
    <main class="w-[60%] ml-[20%] mr-[20%] bg-primary-100 ">

        <!-- ini adalah informasi level pengguna -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] m-8">
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <div class="w-24 h-24 bg-[#FFD8B8] rounded-2xl flex items-center justify-center overflow-hidden">
                        <img id="avatar-preview" src="{{ asset('profile_penulis/pro1.svg') }}"
                            class="w-20 h-20 object-cover rounded-xl" alt="Avatar Pengguna">
                    </div>
                    <div
                        class="absolute -bottom-2 -right-2 bg-[#FFB066] text-white px-3 py-1 rounded-full text-sm font-medium">
                        Level {{ Auth::user()->level }}
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 id="name-display" class="text-3xl font-bold text-[#8B4513] mb-1">
                                {{ Auth::user()->name }}
                            </h1>

                            <!-- progress bar level -->
                            <div class="w-2xl mt-2">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-[#8B4513]" id="progress-label"></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div id="progress-bar" class="bg-[#FFB066] h-3 rounded-full transition-all duration-300" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- badges -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mx-8">
            <!-- judul -->
            <div class="flex flex-row items-center justify-between">
                <div>
                    <h1 class="text-2xl font-poppins font-bold text-teks">Lencana Kehormatan</h1>
                    <p class="text-sm text-[#8B4513] mb-4">Kumpulkan lencana kehormatan untuk menunjukkan pencapaianmu!
                    </p>
                </div>
                <div class="bg-primary-200 p-2 rounded-full">
                    <h2 class="text-[14px] text-teks font-poppins">Badge dimiliki
                        <span id="badge-owned-count">0</span> / <span id="badge-total-count">0</span>
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-6">
                <!-- Contoh badge, ulangi sesuai jumlah badge -->
                <div class="flex flex-col items-center bg-primary-50 rounded-xl p-4 shadow hover:shadow-lg transition"
                    id="badge-container">

                </div>

                <!-- Tambahkan badge lain sesuai kebutuhan -->
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
                            div.className = 'flex flex-col items-center bg-primary-50 rounded-xl p-2 shadow text-center' +
                                (badge.unlocked ? ' hover:shadow-lg transition' : '');

                            const grayscaleClass = badge.unlocked ? '' : 'grayscale opacity-50';

                            div.innerHTML = `
                            <img src="${badge.icon_path}" alt="${badge.nama_badge}" class="w-60 h-32 mb-2 object-contain ${grayscaleClass}">
                            <span class="text-sm font-semibold text-[#8B4513] ${grayscaleClass}">${badge.nama_badge}</span>
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
