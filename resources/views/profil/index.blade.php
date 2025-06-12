<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile | LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    
<div class="min-h-screen bg-[#FFF8F0] font-poppins flex">
    <!-- Sidebar Kiri -->
    @include('components.utama.navside')
    <!-- Konten Utama -->
    <div class="flex-1 p-8 ml-[20%] mr-[20%]">
        <!-- Header Profil -->
        @if(session('success'))
            <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3    rounded mb-4 flex flex-row gap-1.5 transition-opacity duration-500 ease-in-out">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-8">
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <div class="w-24 h-24 bg-[#FFD8B8] rounded-2xl flex items-center justify-center overflow-hidden">
                        <img id="avatar-preview" src="{{ asset('profile_penulis/pro1.svg') }}" 
                             class="w-20 h-20 object-cover rounded-xl"
                             alt="Avatar Pengguna">
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-[#FFB066] text-white px-3 py-1 rounded-full text-sm font-medium">
                        Level {{ Auth::user()->level }}
                    </div>
                    <button onclick="document.getElementById('avatar-input').click()" 
                            class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                    <input type="file" id="avatar-input" class="hidden" accept="image/*" onchange="previewAvatar(event)">
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 id="name-display" class="text-3xl font-bold text-[#8B4513] mb-1">{{ Auth::user()->name }}</h1>
                            <p class="text-[#8B4513]/80 mb-4">{{ Auth::user()->email }}</p>
                        </div>
                        <button id="edit-name-btn" class="text-[#8B4513] hover:text-[#FFB066] transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-[#8B4513]/80">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Bergabung {{ Auth::user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Edit Nama (Hidden by default) -->
        <div id="name-edit-form" class="hidden bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)] mb-8">
            <!-- <form id="update-name-form" action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT') -->
                <form id="update-name-form" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('POST')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-[#8B4513]/80 mb-2">Nama Baru</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" 
                           class="w-full px-4 py-3 border border-[#FFD8B8] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FFB066] focus:border-transparent">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" id="cancel-edit-btn" class="px-4 py-2 text-[#8B4513] hover:bg-gray-100 rounded-xl">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#FFB066] text-white rounded-xl hover:bg-[#FF8E4F] transition-colors">Simpan</button>
                </div>
            </form>
        </div>
        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                <div class="text-2xl font-bold text-[#8B4513] mb-1">{{ Auth::user()->xp }}</div>
                <div class="text-sm text-[#8B4513]/80">Total XP</div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
                <div class="text-2xl font-bold text-[#8B4513] mb-1">{{ $totalBuku }}</div>
                <div class="text-sm text-[#8B4513]/80">Buku Dibaca</div>
            </div>
        </div>
        <!-- Pencapaian -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(139,69,19,0.08)]">
            <h2 class="text-xl font-semibold text-[#8B4513] mb-6">Pencapaian</h2>
            <div class="space-y-4">
                <div class="flex items-center gap-3 p-3 bg-[#FFF5E9] rounded-xl">
                    <div class="w-8 h-8 bg-[#FFB066] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-[#8B4513]">Membaca buku pertama</span>
                </div>
                
                <div class="flex items-center gap-3 p-3 bg-[#FFF5E9] rounded-xl">
                    <div class="w-8 h-8 bg-[#FFB066] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-[#8B4513]">Menyelesaikan level {{ Auth::user()->level }}</span>
                </div>
                
                <div class="flex items-center gap-3 p-3 bg-[#FFF5E9] rounded-xl">
                    <div class="w-8 h-8 bg-[#FFB066] rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-[#8B4513]">Mengumpulkan {{ Auth::user()->xp }} XP</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar Kanan -->
    @include('components.utama.navside-right')
</div>
<script>
    // Fungsi untuk preview avatar yang dipilih
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('avatar-preview');
            preview.src = reader.result;
            
            // Kirim form secara otomatis
            uploadAvatar(event.target.files[0]);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    
    // Fungsi untuk upload avatar ke server
    function uploadAvatar(file) {
        const formData = new FormData();
        formData.append('avatar', file);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');
        
        fetch('{{ route("profile.avatar") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Jika berhasil, tampilkan notifikasi
                showNotification('Foto profil berhasil diubah!', 'success');
            } else {
                showNotification('Gagal mengubah foto profil', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan saat mengunggah', 'error');
        });
    }
    
    // Tampilkan form edit nama
    document.getElementById('edit-name-btn').addEventListener('click', function() {
        document.getElementById('name-edit-form').classList.remove('hidden');
        document.getElementById('name').focus();
    });
    
    // Sembunyikan form edit nama
    document.getElementById('cancel-edit-btn').addEventListener('click', function() {
        document.getElementById('name-edit-form').classList.add('hidden');
    });
    
    // Handle form submit untuk update nama
    
    
    // Fungsi untuk menampilkan notifikasi
    setTimeout(() => {
        const flash = document.getElementById('flash-message');
        if (flash) {
            flash.classList.add('opacity-0'); 
            setTimeout(() => flash.remove(), 500);
            }
        }, 3000); 
    
</script>
    </body>
    </html>