<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard | LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen md:flex-row bg-[#FFF8F0]">
    <x-utama.navside></x-utama.navside>

    <main class="flex-grow pb-20 px-4 py-6 md:px-8 md:py-8 md:ml-[20%] md:mr-[20%] md:w-[60%] md:pb-0 font-poppins">
        <div class="bg-white p-4 rounded-3xl flex items-center justify-around shadow-md mb-6" id="user-info" data-user-id="{{ $user_id }}">
            <div class="flex flex-col items-center text-center text-[#8B4513]">
                <img src="{{asset('asset/icons/trophy.png')}}" alt="Top 1 Icon" class="w-10 h-10 md:w-12 md:h-12 mb-1">
                <p class="text-lg md:text-xl font-semibold" id="juara">0</p>
            </div>
            <div class="border-l-2 border-[#8B4513] h-12"></div>
            <div class="flex flex-col items-center text-center text-[#8B4513]">
                <img src="{{asset('asset/icons/xp.png')}}" alt="XP Icon" class="w-10 h-10 md:w-12 md:h-12 mb-1">
                <p class="text-lg md:text-xl font-semibold" id="xp">0</p>
            </div>
        </div>

        <div class="bg-white mt-6 p-6 rounded-3xl shadow-md">
            <h2 class="text-xl font-semibold text-[#8B4513] text-center mb-6">Papan Peringkat</h2>
            <div class="flex justify-center items-end gap-4 md:gap-8 lg:gap-12 p-2" id="top-3-container">
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-[#8B4513] mb-4">Peringkat Lain</h3>
                <ul class="space-y-3" id="other-ranks">
                    <li class="bg-gray-100 p-3 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-4">
                            <span class="font-semibold text-gray-700">4</span>
                            <div class="w-8 h-8 rounded-full overflow-hidden">
                                <img src="{{ asset('dev_foto/Achmad Soewardi (2).jpg') }}" alt="User 4" class="w-full h-full object-cover">
                            </div>
                            <span class="text-gray-800">Nama User 4</span>
                        </div>
                        <span class="text-sm text-gray-600">2100 XP</span>
                    </li>
                    <li class="bg-gray-100 p-3 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-4">
                            <span class="font-semibold text-gray-700">5</span>
                            <div class="w-8 h-8 rounded-full overflow-hidden">
                                <img src="{{ asset('dev_foto/Achmad Soewardi (2).jpg') }}" alt="User 5" class="w-full h-full object-cover">
                            </div>
                            <span class="text-gray-800">Nama User 5</span>
                        </div>
                        <span class="text-sm text-gray-600">2050 XP</span>
                    </li>
                </ul>
            </div>
        </div>
    </main>

    <x-utama.navsideRight />

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const userId = document.getElementById('user-info').dataset.userId;

    fetch('{{ route("getLeaderboard") }}')
        .then(response => response.json())
        .then(data => {
            const juara = document.getElementById('juara');
            const totalXP = document.getElementById('xp');
            const trophyIcon = document.getElementById('trophy-icon');

            let userRank = null;
            let userXP = 0;

            if (data && data.top_10 && Array.isArray(data.top_10)) {
                const currentUser = data.top_10.find(u => u.id === userId);
                if (currentUser) {
                    userRank = currentUser.ranking;
                    userXP = currentUser.xp;
                }
            }

            // Set juara text and trophy icon
            if (userRank && userRank <= 3 && userXP > 0) {
                juara.textContent = `Juara ${userRank}`;
                if (trophyIcon) {
                    trophyIcon.src = "{{ asset('asset/icons/trophy.png') }}";
                }
            } else {
                juara.textContent = `🔥 Semangat!`;
                if (trophyIcon) {
                    trophyIcon.src = "{{ asset('asset/icons/fire.png') }}";
                }
            }

            // Display XP
            totalXP.textContent = userXP ? `${userXP} XP` : '0 XP';
        })
        .catch(error => {
            console.error('Gagal ambil leaderboard:', error);
            // Set default values on error
            document.getElementById('juara').textContent = '🔥 Semangat!';
            document.getElementById('xp').textContent = '0 XP';
        });
});












        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch("{{route('getLeaderboard')}}");
                const data = await response.json();

                const top3 = data.top_3;
                const otherRanks = data.other_ranks;

                // Urutkan top3: pastikan ranking 1 di tengah (indeks 1)
                const top3Sorted = [top3[1], top3[0], top3[2]];

                // Mapping warna berdasarkan ranking
                const colorClasses = {
                    1: {
                        bg: 'bg-yellow-500',
                        border: 'border-yellow-600',
                        borderInner: 'border-yellow-300',
                    },
                    2: {
                        bg: 'bg-gray-500',
                        border: 'border-gray-600',
                        borderInner: 'border-gray-300',
                    },
                    3: {
                        bg: 'bg-amber-500',
                        border: 'border-amber-600',
                        borderInner: 'border-amber-300',
                    },
                };

                // Top 3 render
                const top3Container = document.getElementById('top-3-container');
                top3Container.innerHTML = '';


                top3Sorted.forEach((user, index) => {
                    const rank = index === 1 ? 1 : (index === 0 ? 2 : 3);
                    const classes = colorClasses[rank];

                    const html = `
                <div class="flex flex-col p-2 items-center rounded-xl ${rank === 1 ? '-mb-2 md:-mb-3 lg:-mb-4' : rank === 3 ? 'mt-2' : ''}">
                    <div class="relative w-14 h-14 md:w-16 md:h-16 lg:w-20 lg:h-20 mb-1 rounded-full overflow-hidden border-2 ${classes.border}">
                        <img src="${user.profil}" alt="Peringkat ${rank}" class="w-full h-full object-cover">
                    </div>
                    <div class="${classes.bg} text-white px-2 py-0.5 -mt-2 z-10 rounded-full text-xs font-semibold shadow-md">
                        ${user.xp} XP
                    </div>
                    <div class="${classes.bg} text-white w-14 h-14 md:w-16 md:h-16 lg:w-20 lg:h-20 mt-1 rounded-full flex items-center justify-center font-extrabold text-lg md:text-xl lg:text-2xl border-2 ${classes.borderInner} shadow-md">
                        ${rank}
                    </div>
                    <p class="text-xs md:text-sm text-gray-700 mt-1">${user.name.length > 10 ? user.name.substring(0,8) + '...' : user.name}</p>
                </div>
            `;
                    top3Container.innerHTML += html;
                });

                // Other ranks (4–10)
                const otherRanksContainer = document.getElementById('other-ranks');
                otherRanksContainer.innerHTML = '';

                otherRanks.forEach((user, i) => {
                    const html = `
                <li class="bg-gray-100 p-3 rounded-xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-gray-700">${i + 4}</span>
                        <div class="w-8 h-8 rounded-full overflow-hidden">
                            <img src="${user.photo_url}" alt="User ${i + 4}" class="w-full h-full object-cover">
                        </div>
                        <span class="text-gray-800">${user.name}</span>
                    </div>
                    <span class="text-sm text-gray-600">${user.xp} XP</span>
                </li>
            `;
                    otherRanksContainer.innerHTML += html;
                });

            } catch (error) {
                console.error("Gagal memuat leaderboard:", error);
            }
        });
    </script>
</body>

</html>