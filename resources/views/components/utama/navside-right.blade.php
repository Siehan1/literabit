<aside
    class="w-1/5 text-teks font-poppins px-6 fixed top-0 right-0 min-h-screen z-10 bg-white/95 backdrop-blur-sm shadow-[-3px_0_12px_0_rgba(0,0,0,0.08)]">
    {{-- Header Section --}}
    <div class="pt-10 pb-6 text-center">
        <h2 class="text-2xl font-bold text-teks tracking-wide">Pencapaian</h2>
    </div>

    {{-- Daily Missions Section --}}
    <div class="mb-6 flex flex-col gap-3">
        <div class="flex items-center justify-between">
            <h3 class="text-teks font-semibold text-lg">Misi Harian</h3>
            @php
                $todayMissions = $userMissions->filter(function ($mision) {
                    $missionDate = \Carbon\Carbon::parse($mision->dailyMission->tanggal);
                    $today = now()->startOfDay();
                    return $missionDate->eq($today) || (!$mision->is_done && $missionDate->eq($today->copy()->subDay()));
                });
                $completedToday = $todayMissions->where('is_done', true)->count();
            @endphp
            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium">
                {{ $completedToday }}/{{ $todayMissions->count() }}
            </span>
        </div>

        @foreach ($userMissions as $mision)
            @php
                $target = $mision->dailyMission->template->jumlah_target;
                $completed = $mision->jumlah_selesai;
                $progress = $target > 0 ? min(100, ($completed / $target) * 100) : 0;

                $progressColor = 'bg-celadon';
                if ($mision->is_done) {
                    $progressColor = 'bg-green-500';
                } elseif ($progress < 30) {
                    $progressColor = 'bg-red-400';
                } elseif ($progress < 70) {
                    $progressColor = 'bg-yellow-400';
                }

                $missionDate = \Carbon\Carbon::parse($mision->dailyMission->tanggal);
                $today = now()->startOfDay();
                $yesterday = $today->copy()->subDay();

                // Hanya tampilkan misi hari ini atau misi kemarin yang belum selesai
                $showMission = $missionDate->eq($today) ||
                    (!$mision->is_done && $missionDate->eq($yesterday));
            @endphp

            @if($showMission)
                <div class="p-4 bg-wave rounded-2xl hover:shadow-md transition-shadow duration-300">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-[15px] font-medium">{{ $mision->judul }}</h3>
                        @if($mision->is_done)
                            <span class="text-green-600 text-xs px-2 py-1 bg-green-200 rounded-full">Selesai</span>
                        @elseif(!$mision->is_done && $missionDate->eq($today))
                            <span class="text-sec text-xs px-2 py-1 bg-sec/10 rounded-full">Hari ini</span>
                        @else
                            <span class="text-red-500 text-xs px-2 py-1 bg-red-300/50 rounded-full">Kadaluarsa</span>
                        @endif
                    </div>

                    <div class="text-sm text-sec mb-3">
                        <p class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                            </svg>
                            Reward {{ $mision->dailyMission->template->xp_reward ?? 0 }} xp
                        </p>
                    </div>

                    <div class="space-y-2">
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="{{ $progressColor }} h-2 rounded-full transition-all duration-300"
                                style="width: {{ $progress }}%"></div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-500">
                                {{ round($progress) }}% Complete
                            </p>
                            <p class="text-xs font-medium">
                                {{ $completed }}/{{ $target }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Badges Section --}}
        <div class="mt-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-teks font-semibold text-lg">Lencana</h3>
                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-medium">
                    {{ count(auth()->user()->badges) }}/{{ \App\Models\Badge::count() }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-3">
                @foreach (auth()->user()->badges as $badge)
                    <div class="p-3 bg-wave rounded-2xl hover:shadow-md transition-all duration-300">
                        <div class="flex flex-col items-center" data-bs-toggle="tooltip" title="{{ $badge->nama_badge }}">
                            <img src="{{ asset('storage/' . $badge->icon_path) }}" alt="{{ $badge->nama_badge }}"
                                class="w-20 h-20 object-contain mb-2">
                            <p class="text-xs text-gray-600 font-medium text-center line-clamp-1">
                                {{ $badge->nama_badge }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Contoh pemanggilan ketika tombol "Selesai Baca" diklik
            document.getElementById('completeBookBtn')?.addEventListener('click', function () {
                const bookId = this.dataset.bookId;
                recordBookRead(bookId);
            });

            // Fungsi untuk memanggil API
            async function recordBookRead(bookId) {
                try {
                    const response = await fetch(`/api/books/${bookId}/record-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: "{{ auth()->id() }}",
                            book_id: bookId
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Trigger event untuk update UI
                        window.dispatchEvent(new CustomEvent('missionsUpdated', {
                            detail: data.data.updated_missions
                        }));

                        // Tampilkan notifikasi
                        showToast('Buku berhasil dicatat! XP bertambah');
                    } else {
                        showToast(data.message, 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan', 'error');
                }
            }

            // Fungsi toast notification
            function showToast(message, type = 'success') {
                // Implementasi toast sesuai library yang Anda gunakan
                // Contoh sederhana:
                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 px-4 py-2 rounded-md text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'
                    }`;
                toast.textContent = message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }

            // Event listener untuk update misi
            window.addEventListener('missionsUpdated', function (e) {
                // Lakukan refresh atau update komponen misi
                // Contoh sederhana:
                location.reload(); // Atau gunakan AJAX untuk update spesifik

                // Untuk implementasi lebih advanced bisa menggunakan Alpine.js atau Livewire
                // untuk update komponen tanpa reload
            });
        });
    </script>
</aside>